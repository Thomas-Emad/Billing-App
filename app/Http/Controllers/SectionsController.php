<?php

namespace App\Http\Controllers;

use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionsController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $sections = sections::get();
    return view("invoices.sections", compact('sections'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(Request $request)
  {
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    // validate
    $validated = $request->validate([
      'section_name' => ['required', 'unique:sections', 'min:3', 'max:98'],
      'description' => ["max:254"]
    ], [
      'section_name.required' => 'يجب ادخال اسم القسم',
      'section_name.unique' => 'اسم القسم مسجل مسبقا',
      'section_name.min' => 'الحد الادني 3 حروف في اسم القسم',
      'section_name.max' => 'الحد الاقصي 98 حروف في اسم القسم',
      'description.max' => 'الحد الاقصي 254 حروف في الملاحظات'
    ]);

    // Check From Exist Section Or Not
    sections::create([
      'section_name' => $request->section_name,
      'description' => $request->description,
      'create_by' => Auth::user()->name,
    ]);
    session()->flash('message', 'تم اضافة القسم بنجاح');
    return redirect("/sections");
  }

  /**
   * Display the specified resource.
   */
  public function show(sections $sections)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(sections $sections)
  {
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, sections $sections)
  {
    $section = sections::find($request->id);

    $this->validate($request, [
      'section_name' => ['required', 'unique:sections,section_name', 'min:3', 'max:98'],
      'description' => ["max:254"]
    ], [
      'section_name.required' => 'يجب ادخال اسم القسم',
      'section_name.unique' => 'اسم القسم مسجل مسبقا',
      'section_name.min' => 'الحد الادني 3 حروف في اسم القسم',
      'section_name.max' => 'الحد الاقصي 98 حروف في اسم القسم',
      'description.max' => 'الحد الاقصي 254 حروف في الملاحظات'
    ]);

    $section->update([
      'section_name' => $request->section_name,
      'description' => $request->description,
    ]);
    session()->flash("message", "تم تحديث بنجاح");
    return redirect("/sections");
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Request $request)
  {
    sections::destroy($request->id);
    session()->flash("message", 'تم حذف هذا القسم بنجاح');
    return redirect("/sections");
  }
}
