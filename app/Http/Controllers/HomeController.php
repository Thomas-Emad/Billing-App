<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    function get_static($val_status)
    {
      $status = [];
      $days_array = [];
      if ($val_status != 'all') {
        $dates = Invoices::whereYear("date_invoice", date("Y"))->where("val_status", $val_status)->select("date_invoice")->get();
      } else {
        $dates = Invoices::whereYear("date_invoice", date("Y"))->select("date_invoice")->get();
      }
      foreach ($dates as $invoice) {
        $time = Carbon::create($invoice->date_invoice);
        $day = ($time->toArray())["day"];
        if (!in_array($day, $days_array)) {
          $days_array[] = $day;
          $status[$day] = 10;
        } else {
          ++$status[$day];
        }
      }
      return implode(",", $status);
    }
    $static_line_all = get_static('all');
    $static_line_paid = get_static(1);
    $static_line_unpaid = get_static(2);
    $static_line_partpaid = get_static(3);
    $invoices = Invoices::select("id", "section_id", "product", "created_at")->orderBy("created_at", "DESC")->get();
    return view('home', compact("invoices", "static_line_all", "static_line_paid", "static_line_unpaid", "static_line_partpaid"));
  }
}
