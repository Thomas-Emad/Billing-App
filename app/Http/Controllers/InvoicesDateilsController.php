<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\invoices_attchments;
use App\Models\invoices_dateils;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Response;
use Storage;

class InvoicesDateilsController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index($id)
  {
    $invoice = invoices::where("id", $id)->firstOrFail();
    $invoice_details = invoices_dateils::where("id_invoice", $id)->get();
    $invoice_attchments = invoices_attchments::where("id_invoice", $id)->get();

    $notification = Auth::user()->notifications()->where("data->id", $id)->first();
    if (!empty($notification)) {
      $notification->markAsRead();
    }

    return view("invoices.InvoiceDateils", compact(["invoice", "invoice_details", "invoice_attchments"]));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(invoices_dateils $invoices_dateils)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(invoices_dateils $invoices_dateils)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, invoices_dateils $invoices_dateils)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(invoices_dateils $invoices_dateils)
  {
    //
  }

  public function showFile($invoice_number, $file_name)
  {
    $file = Storage::disk("attch")->path($invoice_number . "/" . $file_name);
    return response()->file($file);
  }
  public function download($invoice_number, $file_name)
  {
    return Storage::disk("attch")->download($invoice_number . "/" . $file_name);
  }
  public function destroyFile($id)
  {
    $attch = invoices_attchments::findOrFail($id);
    Storage::disk("attch")->delete($attch->invoice->invoice_number . "/" . $attch->name_file);
    invoices_attchments::destroy($attch->id);
    session()->flash("message", "لقد تم حذف هذا الملف بنجاح..");
    return back();
  }
}
