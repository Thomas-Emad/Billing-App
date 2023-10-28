<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;
use Storage;

class InvoicesArchiveController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $invoices = invoices::onlyTrashed()->get();
    return view("invoices.archive", compact("invoices"));
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
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Request $request)
  {
    if ($request->page == 1) {
      $invoice = invoices::onlyTrashed()->findOrFail($request->id);
      Storage::disk("attch")->deleteDirectory($invoice->invoice_number);
      $invoice->restore();

      session()->flash("message");
      return redirect("invoices");
    } elseif ($request->page == 2) {
      $invoice = invoices::onlyTrashed()->findOrFail($request->id);
      $invoice->forceDelete();

      session()->flash("message");
      return back();
    }
  }
}
