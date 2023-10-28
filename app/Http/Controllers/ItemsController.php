<?php

namespace App\Http\Controllers;

use App\Models\items;
use App\Models\sections;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $sections = sections::all();
    $items = items::all();
    return view("invoices.items", compact(["sections", "items"]));
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
    // validate
    $request->validate([
      "item_name" => ["required", "min:3", "max:254"],
      "section_id" => ["required"],
      "description" => ["max:255"]
    ], [
      'item_name.required' => 'يجب ادخال اسم المنتج',
      'item_name.min' => 'الحد الادني 3 حروف في اسم المنتج',
      'item_name.max' => 'الحد الاقصي 98 حروف في اسم المنتج',
      'description.max' => 'الحد الاقصي 254 حروف في الملاحظات'
    ]);

    // Create Item And Redirect To view
    items::create([
      "item_name" => $request->item_name,
      "section_id" => $request->section_id,
      "description" => $request->description
    ]);
    session()->flash("message", "تم اضافة المنتج بنجاح..");
    return redirect("/items");
  }

  /**
   * Display the specified resource.
   */
  public function show(items $items)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(items $items)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request)
  {
    $item = items::findOrFail(($request->id));

    // validate
    $request->validate([
      "item_name" => ["required", "min:3", "max:254"],
      "description" => ["max:255"]
    ], [
      'item_name.required' => 'يجب ادخال اسم المنتج',
      'item_name.min' => 'الحد الادني 3 حروف في اسم المنتج',
      'item_name.max' => 'الحد الاقصي 98 حروف في اسم المنتج',
      'description.max' => 'الحد الاقصي 254 حروف في الملاحظات'
    ]);

    // Edit Item And Redirect To view
    $item->update([
      "item_name" => $request->item_name,
      "description" => $request->description
    ]);
    session()->flash("message", 'تم تحديث البيانات بنجاح..');
    return redirect("/items");
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Request $request)
  {
    items::destroy($request->id);
    session()->flash("message", 'تم حذف هذا المنتج بنجاح..');
    return redirect("/items");
  }
}
