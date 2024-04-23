<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class CastController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Cast::all();
        return view('admin.cast.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.cast.create');
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
        $data = new Cast();
        $data->name = $request->name;
        $data->bio = $request->bio;
        $data->country = $request->country;
        $data->dob = $request->dob;
        $data->gender = $request->gender;
        $data->status = $request->status;

        // PHOTO for Cast
        if ($request->hasFile('photo')) {
            $data->photo = $request->file('photo')->store('CastPhoto', 'public');
        }
        //If Given spouse for Cast
        if ($request->spouse != null) {
            $data->spouse = $request->spouse;
            //If Given children for Cast
            if ($request->children != null) {
                $data->children = $request->children;
            }
        }
        //If Given education for Cast
        if ($request->education != null) {
            $data->education = $request->education;
        }
        //If Given Date of Death for Cast
        if ($request->deathd != null) {
            $data->deathd = $request->deathd;
        }

        $data->save();
        //Data Saved
        return redirect()->route('admin.cast.index')->with('success', 'Cast Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Cast::find($id);
        return view('admin.cast.show', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = Cast::find($id);
        return view('admin.cast.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = Cast::find($id);
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

        // PHOTO for Cast
        if ($request->hasFile('photo')) {
            $data->photo = $request->file('photo')->store('CastPhoto', 'public');
        } else {
            $formFields['photo'] = $request->prev_photo;
        }
        //If Given spouse for Cast
        if ($request->spouse != null) {
            $data->spouse = $request->spouse;
            //If Given children for Cast
            if ($request->children != null) {
                $data->children = $request->children;
            }
        }
        //If Given education for Cast
        if ($request->education != null) {
            $data->education = $request->education;
        }
        //If Given Date of Death for Cast
        if ($request->deathd != null) {
            $data->deathd = $request->deathd;
        }

        $data->save();
        //Data Saved
        return redirect()->route('admin.cast.index')->with('success', 'Cast Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = Cast::find($id);
        $data->delete();
        //Path of Photo from storage
        $pathPhoto = 'storage/' . $data->photo;
        //Delete File from storage
        if (File::exists($pathPhoto)) {
            //Delete the photo cover  file
            File::delete($pathPhoto);
        }
        return redirect()->route('admin.cast.index')->with('danger', 'Cast has been deleted Successfully!');
    }
}
