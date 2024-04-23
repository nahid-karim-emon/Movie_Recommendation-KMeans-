<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Language::all();
        return view('admin.language.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.language.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
        ]);
        //Data save to Database 
        $data = new Language();
        $data->title = $request->title;

        // PHOTO for language
        if ($request->hasFile('photo')) {
            $data->photo = $request->file('photo')->store('languagePhoto', 'public');
        }

        $data->save();
        //Data Saved
        return redirect()->route('admin.language.index')->with('success', 'Language Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Language::find($id);
        return view('admin.language.show', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = Language::find($id);
        return view('admin.language.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = Language::find($id);
        $request->validate([
            'title' => 'required',
        ]);
        //Data save to Database 
        $data->title = $request->title;

        // PHOTO for language
        if ($request->hasFile('photo')) {
            $data->photo = $request->file('photo')->store('languagePhoto', 'public');
        } else {
            $formFields['photo'] = $request->prev_photo;
        }
        $data->save();
        //Data Saved
        return redirect()->route('admin.language.index')->with('success', 'Language Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = Language::find($id);
        $data->delete();
        //Path of Photo from storage
        $pathPhoto = 'storage/' . $data->photo;
        //Delete File from storage
        if (File::exists($pathPhoto)) {
            //Delete the photo cover  file
            File::delete($pathPhoto);
        }
        return redirect()->route('admin.language.index')->with('danger', 'Language has been deleted Successfully!');
    }
}
