<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Http\Controllers\Controller;

class StaffDepartmentController extends Controller
{
   //
   public function index()
   {
       $data = Department::all();
       return view('admin.department.index',['data'=>$data]);
   }

   /**
    * Show the form for creating a new resource.
    */
   public function create(){
       return view('admin.department.create');
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(Request $request)
   {
       //
       $data = new Department;
       $request->validate([
        'title' => 'required',
        'detail' => 'required',
        ]);
       $data->title = $request->title;
       $data->detail = $request->detail;
       $data->save();

       return redirect('admin/department')->with('success','Staff Department Data has been added Successfully!');
       
   }

   /**
    * Display the specified resource.
    */
   public function show(string $id)
   {
       //
       $data = Department::find($id);
       return view('admin.department.show',['data'=>$data]);
   }

   /**
    * Show the form for editing the specified resource.
    */
   public function edit(string $id)
   {
       $data = Department::find($id);
       return view('admin.department.edit',['data'=>$data]);
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(Request $request, $id)
   {
       //
       $data = Department::find($id);
       $request->validate([
        'title' => 'required',
        'detail' => 'required',
        ]);
       $data->title = $request->title;
       $data->detail = $request->detail;
       $data->save();

       return redirect('admin/department')->with('success','Staff Department Data has been updated Successfully!');
       
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy($id)
   {
       $data = Department::find($id);
       $data->delete();
       return redirect('admin/department')->with('danger','Staff Department Data has been deleted Successfully!');

   }
}
