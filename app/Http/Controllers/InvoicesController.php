<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\invoices_attchments;
use App\Models\invoices_dateils;
use App\Models\items;
use App\Models\sections;
use App\Models\User;
use App\Notifications\invoiceDB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\Invoice;
use Illuminate\Validation\Rule;
use Storage;
use App\Exports\InvoicesExport;
use Maatwebsite\Excel\Facades\Excel;

class InvoicesController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $invoices = invoices::all();
    return view('invoices.invoices', compact("invoices"));
  }
  public function paid()
  {
    $invoices = invoices::where("val_status", 1)->get();
    return view('invoices.invoices_paid', compact("invoices"));
  }
  public function unpaid()
  {
    $invoices = invoices::where("val_status", 2)->get();
    return view('invoices.invoices_unpaid', compact("invoices"));
  }
  public function partpaid()
  {
    $invoices = invoices::where("val_status", 3)->get();
    return view('invoices.invoices_partpaid', compact("invoices"));
  }


  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $sections = sections::all();
    return view("invoices.invoice_create", compact("sections"));
  }
  // Get Items By Section Id
  public function getItems($section_id)
  {
    $item_db = DB::table("items")->where('section_id', $section_id)->pluck("id", "item_name");
    $items = json_encode($item_db);
    return $items;
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      "invoice_number" => ['required', 'unique:invoices', 'min:3', "max:90"],
      "date_invoice" => ['required', 'min:3', "max:90"],
      "pay_invoice" => ['required', 'min:3', "max:90"],
      "section_id" => ['required'],
      "product" => ['required'],
      "value_get" => ['required', "max:90"],
      "value_work" => ['required', "max:90"],
      "discount" => ['required', "max:90"],
      "rate_vat" => ['required', "max:90"],
      "value_get_vat" => ['required', "max:90"],
      "total" => ['required', "max:90"],
      "note" => ["nullable"],
    ], [
      "invoice_number.required" => "يجب ادخال رقم الفاتورة",
      "invoice_number.unique" => "رقم الفاتورة موجود بالفعل",
      "invoice_number.min" => "يجب ان لا يقل رقم الفاتورة عن 3 احرف",
      "invoice_number.max" => "يجب ان لا يزيد رقم الفاتورة عن 90 احرف",
      "date_invoice.required" => "يجب تحديد يوم اصدار الفاتورة",
      "pay_invoice.required" => "يجب تحديد يوم تحصيل الفاتورة",
      "section_id.required" => "قم باختيار قسم من الاقسام",
      "value_get.required" => "قم بادخل المبلغ التحصيل",
      "value_work.required" => "قم بادخل المبلغ العمولة",
      "discount.required" => "الا يوجد خصم؟ ادخل 0 حتي تكمل..",
      "rate_vat.required" => "يجب اختيار نسبة الضريبة",
    ]);

    invoices::create([
      "invoice_number" => $request->invoice_number,
      "date_invoice" => Carbon::createFromFormat('m/d/Y', $request->date_invoice)->format('Y-m-d'),
      "pay_invoice" => Carbon::createFromFormat('m/d/Y', $request->pay_invoice)->format('Y-m-d'),
      "section_id" => $request->section_id,
      "product" => $request->product,
      "value_get" => $request->value_get,
      "value_work" => $request->value_work,
      "discount" => $request->discount,
      "rate_vat" => $request->rate_vat,
      "value_get_vat" => $request->value_get_vat,
      "total" => $request->total,
      "val_status" => 2,
      "status" => "غير مدفوعة",
      "user" => Auth::user()->name,
      "note" => $request->note,
    ]);

    // insert in dateils
    $invoice_id = invoices::latest()->first()->id;
    invoices_dateils::create([
      'id_invoice' => $invoice_id,
      'section' => $request->section_id,
      'product' => $request->product,
      'val_status' => 2,
      'status' => "غير مدفوعة",
      'note' => $request->note,
      'user' => Auth::user()->name,
    ]);

    // insert in attchment and move files
    if ($request->hasFile("attch")) {
      $files = $request->file("attch");
      $file_name = $files->getClientOriginalName();

      invoices_attchments::create([
        'id_invoice' => $invoice_id,
        'name_file' => $file_name,
        'user_add' => Auth::user()->name,
      ]);

      $request->attch->move(public_path("Attachments/" . $request->invoice_number), $file_name);
    }

    $users = User::get();
    // Notification::send(Auth::user(), new Invoice($invoice_id));
    Notification::send($users, new invoiceDB($invoice_id));
    session()->flash("message", "تم اضافة الفاتورة بنجاح..");
    return back();
  }

  /**
   * Display the specified resource.
   */
  public function show($id)
  {
    $invoice = invoices::findOrFail($id);
    return view("invoices.print_invoice", compact("invoice"));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit($id)
  {
    $invoice = invoices::findOrFail($id);
    $items = items::where("section_id", $invoice->section_id)->get();
    $sections = sections::all();
    return view("invoices.edit_invoice", compact(["sections", "invoice", "items"]));
  }
  public function status_invoice($id)
  {
    $invoice = invoices::findOrFail($id);
    return view("invoices.status_invoice", compact(["invoice"]));
  }

  public function status_invoice_save(Request $request)
  {
    $invoice = invoices::findOrFail($request->id);
    $request->validate([
      "note" => ['nullable'],
      "payment_date" => ["required"]
    ]);
    if ($request->status == 1) {
      $invoice->update([
        "val_status" => 1,
        "status" => "مدفوعة",
      ]);

      // insert in dateils
      invoices_dateils::create([
        'id_invoice' => $request->id,
        'section' => $request->section_id,
        'product' => $request->product,
        'val_status' => 1,
        'status' => "مدفوعة",
        'note' => $request->note,
        'payment_date' => Carbon::createFromFormat('m/d/Y', $request->payment_date)->format('Y-m-d'),
        'user' => Auth::user()->name,
      ]);
      session()->flash("message", "تم تعديل الحالة الفاتورة..");
      return redirect("invoicesPaid");
    } elseif ($request->status == 3) {
      $invoice->update([
        "val_status" => 3,
        "status" => "مدفوعة جزئيا",
      ]);

      // insert in dateils
      invoices_dateils::create([
        'id_invoice' => $request->id,
        'section' => $request->section_id,
        'product' => $request->product,
        'note' => $request->note,
        'status' => "مدفوعة جزئيا",
        'val_status' => 3,
        'payment_date' => Carbon::createFromFormat('m/d/Y', $request->payment_date)->format('Y-m-d'),
        'user' => Auth::user()->name,
      ]);
      session()->flash("message", "تم تعديل الحالة الفاتورة..");
      return redirect("invoicesPartpaid");
    } elseif ($request->status == 2) {
      $invoice->update([
        "val_status" => 2,
        "status" => "غير مدفوعة",
      ]);

      // insert in dateils
      invoices_dateils::create([
        'id_invoice' => $request->id,
        'section' => $request->section_id,
        'product' => $request->product,
        'note' => $request->note,
        'status' => "غير مدفوعة",
        'val_status' => 2,
        'payment_date' => Carbon::createFromFormat('m/d/Y', $request->payment_date)->format('Y-m-d'),
        'user' => Auth::user()->name,
      ]);
      session()->flash("message", "تم تعديل الحالة الفاتورة..");
      return redirect("invoicesUnpaid");
    }
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, $id)
  {
    $invoice = invoices::findOrFail($id);

    // Vaildate Date
    $request->validate([
      "invoice_number" => ['required', Rule::unique('invoices')->ignore($request->invoice_number, "invoice_number"), 'min:3', "max:90"],
      "date_invoice" => ['required', 'min:3', "max:90"],
      "pay_invoice" => ['required', 'min:3', "max:90"],
      "section_id" => ['required'],
      "product" => ['required'],
      "value_get" => ['required', "max:90"],
      "value_work" => ['required', "max:90"],
      "discount" => ['required', "max:90"],
      "rate_vat" => ['required', "max:90"],
      "value_get_vat" => ['required', "max:90"],
      "total" => ['required', "max:90"],
      "note" => ["nullable"],
    ], [
      "invoice_number.required" => "يجب ادخال رقم الفاتورة",
      "invoice_number.unique" => "رقم الفاتورة موجود بالفعل",
      "invoice_number.min" => "يجب ان لا يقل رقم الفاتورة عن 3 احرف",
      "invoice_number.max" => "يجب ان لا يزيد رقم الفاتورة عن 90 احرف",
      "date_invoice.required" => "يجب تحديد يوم اصدار الفاتورة",
      "pay_invoice.required" => "يجب تحديد يوم تحصيل الفاتورة",
      "section_id.required" => "قم باختيار قسم من الاقسام",
      "value_get.required" => "قم بادخل المبلغ التحصيل",
      "value_work.required" => "قم بادخل المبلغ العمولة",
      "discount.required" => "الا يوجد خصم؟ ادخل 0 حتي تكمل..",
      "rate_vat.required" => "يجب اختيار نسبة الضريبة",
    ]);

    // rename Folder To New invoice_number
    if ($invoice->invoice_number != $request->invoice_number) {
      Storage::disk("attch")->move($invoice->invoice_number, $request->invoice_number);
    }

    $invoice->update([
      "invoice_number" => $request->invoice_number,
      "date_invoice" => $request->date_invoice,
      "pay_invoice" => $request->pay_invoice,
      "section_id" => $request->section_id,
      "product" => $request->product,
      "value_get" => $request->value_get,
      "value_work" => $request->value_work,
      "discount" => $request->discount,
      "rate_vat" => $request->rate_vat,
      "value_get_vat" => $request->value_get_vat,
      "total" => $request->total,
      "val_status" => 2,
      "status" => "غير مدفوعة",
      "note" => $request->note,
    ]);

    // insert in dateils
    invoices_dateils::create([
      'id_invoice' => $id,
      'section' => $request->section_id,
      'product' => $request->product,
      'val_status' => 2,
      'status' => "غير مدفوعة",
      'note' => $request->note,
      'user' => Auth::user()->name,
    ]);

    session()->flash("message", "تم تحديث الفاتورة بنجاح..");
    return redirect("invoiceDateils/" . $id);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Request $request)
  {
    if ($request->page == 2) {
      $invoice = invoices::findOrFail($request->id);
      Storage::disk("attch")->deleteDirectory($invoice->invoice_number);
      $invoice->forceDelete();

      session()->flash("message");
      return back();
    } elseif ($request->page == 1) {
      $invoice = invoices::findOrFail($request->id);
      $invoice->delete();

      session()->flash("message");
      return redirect("archive");
    }
  }

  public function export()
  {
    return Excel::download(new InvoicesExport, 'invoices.xlsx');
  }

  public function readAllNot()
  {
    Auth::user()->unreadNotifications->markAsRead();
    return back();
  }
}
