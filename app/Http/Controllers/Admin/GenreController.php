<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Genre::all();
        return view('admin.genre.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.genre.create');
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
        $data = new Genre();
        $data->title = $request->title;

        // PHOTO for genre
        if ($request->hasFile('photo')) {
            $data->photo = $request->file('photo')->store('genrePhoto', 'public');
        }

        $data->save();
        //Data Saved
        return redirect()->route('admin.genre.index')->with('success', 'Genre Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Genre::find($id);
        return view('admin.genre.show', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = Genre::find($id);
        return view('admin.genre.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = Genre::find($id);
        $request->validate([
            'title' => 'required',
        ]);
        //Data save to Database 
        $data->title = $request->title;

        // PHOTO for genre
        if ($request->hasFile('photo')) {
            $data->photo = $request->file('photo')->store('genrePhoto', 'public');
        } else {
            $data->photo = $request->prev_photo;
        }
        $data->save();
        //Data Saved
        return redirect()->route('admin.genre.index')->with('success', 'Genre Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = Genre::find($id);
        $data->delete();
        //Path of Photo from storage
        $pathPhoto = 'storage/' . $data->photo;
        //Delete File from storage
        if (File::exists($pathPhoto)) {
            //Delete the photo cover  file
            File::delete($pathPhoto);
        }
        return redirect()->route('admin.genre.index')->with('danger', 'Genre has been deleted Successfully!');
    }
}
