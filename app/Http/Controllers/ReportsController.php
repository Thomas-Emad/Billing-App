<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\invoices;
use Illuminate\Support\Carbon;

class ReportsController extends Controller
{
  public function invoices_reports()
  {
    return view("reports.invoices_reports");
  }
  public function invoices_search(Request $request)
  {
    $type_search = $request->type_search;
    $start_at = ($request->start_at == null) ? Carbon::now()->sub("1", "year")->format("Y") . "-01-01" : ((Carbon::hasFormat($request->start_at, "m/d/Y")) ? Carbon::createFromFormat('m/d/Y', $request->start_at)->format('Y-m-d') : $request->start_at);
    $end_at = ($request->end_at == null) ? Carbon::now()->add("1", "year")->format("Y") . "-01-01" : ((Carbon::hasFormat($request->end_at, "m/d/Y")) ? Carbon::createFromFormat('m/d/Y', $request->end_at)->format('Y-m-d') : $request->end_at);
    $invoice_number = $request->invoice_number;
    $type_invoice = $request->type_invoice;

    if ($type_search == 1) {
      $invoices = invoices::where("val_status", '=', $request->type_invoice)
        ->whereBetween("date_invoice", [$start_at, $end_at])->get();
    } elseif ($type_search == 2) {
      $invoices = invoices::where("invoice_number", '=', $request->number_invoice)->get();
    }

    return view("reports.invoices_reports", compact("invoices", "start_at", "end_at", 'invoice_number', "type_invoice", "type_search"));
  }

  public function users_reports()
  {
    return view("reports.users_reports");
  }
  public function users_search(Request $request)
  {
    $users = User::where("name", $request->name)->get();

    return view("reports.users_reports", compact("users"));
  }
}
