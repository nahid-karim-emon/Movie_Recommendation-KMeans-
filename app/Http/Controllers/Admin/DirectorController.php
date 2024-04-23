<?php

namespace App\Http\Controllers\Admin;

use App\Models\Director;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Director::all();
        return view('admin.director.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.director.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'bio' => 'required',
            'country' => 'required',
            'dob' => 'required',
            'photo' => 'required',
            'gender' => 'required',
            'status' => 'required',
        ]);
        //Data save to Database 
        $data = new Director();
        $data->name = $request->name;
        $data->bio = $request->bio;
        $data->country = $request->country;
        $data->dob = $request->dob;
        $data->status = $request->status;
        $data->gender = $request->gender;

        // PHOTO for Director
        if ($request->hasFile('photo')) {
            $data->photo = $request->file('photo')->store('DirectorPhoto', 'public');
        }
        //If Given spouse for Director
        if ($request->spouse != null) {
            $data->spouse = $request->spouse;
            //If Given children for Director
            if ($request->children != null) {
                $data->children = $request->children;
            }
        }
        //If Given education for Director
        if ($request->education != null) {
            $data->education = $request->education;
        }
        //If Given Date of Death for Director
        if ($request->deathd != null) {
            $data->deathd = $request->deathd;
        }

        $data->save();
        //Data Saved
        return redirect()->route('admin.director.index')->with('success', 'Director Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Director::find($id);
        return view('admin.director.show', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = Director::find($id);
        return view('admin.director.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = Director::find($id);
        $request->validate([
            'name' => 'required',
            'bio' => 'required',
            'country' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'status' => 'required',
        ]);
        //Data save to Database 
        $data->name = $request->name;
        $data->bio = $request->bio;
        $data->country = $request->country;
        $data->dob = $request->dob;
        $data->gender = $request->gender;
        $data->status = $request->status;

        // PHOTO for Director
        if ($request->hasFile('photo')) {
            $data->photo = $request->file('photo')->store('DirectorPhoto', 'public');
        } else {
            $formFields['photo'] = $request->prev_photo;
        }
        //If Given spouse for Director
        if ($request->spouse != null) {
            $data->spouse = $request->spouse;
            //If Given children for Director
            if ($request->children != null) {
                $data->children = $request->children;
            }
        }
        //If Given education for Director
        if ($request->education != null) {
            $data->education = $request->education;
        }
        //If Given Date of Death for Director
        if ($request->deathd != null) {
            $data->deathd = $request->deathd;
        }

        $data->save();
        //Data Saved
        return redirect()->route('admin.director.index')->with('success', 'Director Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = Director::find($id);
        $data->delete();
        //Path of Photo from storage
        $pathPhoto = 'storage/' . $data->photo;
        //Delete File from storage
        if (File::exists($pathPhoto)) {
            //Delete the photo cover  file
            File::delete($pathPhoto);
        }
        return redirect()->route('admin.director.index')->with('danger', 'Director has been deleted Successfully!');
    }
}
