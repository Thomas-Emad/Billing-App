<?php

namespace App\Http\Controllers;

use App\Models\invoices_attchments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;


class InvoicesAttchmentsController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    //
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
    $request->validate([
      "file" => ['required', File::types(['pdf', 'png', 'jpg', 'jpeg'])],
    ], [
      "required" => "",
    ]);
    if ($request->hasFile("file")) {
      $files = $request->file("file");
      $file_name = $files->getClientOriginalName();

      invoices_attchments::create([
        'id_invoice' => $request->invoice_id,
        'name_file' => $file_name,
        'user_add' => Auth::user()->name,
      ]);

      $request->file->move(public_path("Attachments/" . $request->invoice_number), $file_name);
    }

    session()->flash("message", "تم اضافة الملف بنجاح..");
    return back();
  }

  /**
   * Display the specified resource.
   */
  public function show(invoices_attchments $invoices_attchments)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(invoices_attchments $invoices_attchments)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, invoices_attchments $invoices_attchments)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(invoices_attchments $invoices_attchments)
  {
    //
  }

}