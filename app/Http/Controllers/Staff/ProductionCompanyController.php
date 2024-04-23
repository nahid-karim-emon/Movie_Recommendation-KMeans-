<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Models\ProductionCompany;
use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Support\Facades\File;


class ProductionCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = ProductionCompany::all();
        return view('staff.pcompany.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $genres = Genre::all();
        return view('staff.pcompany.create', ['genres' => $genres]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'genre_id' => 'required',
            'title' => 'required',
            'founded' => 'required',
            'founders' => 'required',
            'photo' => 'required',
        ]);
        //Data save to Database 
        $data = new ProductionCompany();
        $data->title = $request->title;
        $data->genre_id = $request->genre_id;
        $data->founded = $request->founded;
        $data->founders = $request->founders;
        $data->info = $request->info;
        $data->president = $request->president;
        $data->parentorganizations = $request->parentorganizations;

        // PHOTO for ProductionCompany
        if ($request->hasFile('photo')) {
            $data->photo = $request->file('photo')->store('ProductionCompanyPhoto', 'public');
        }
        $data->save();
        //Data Saved
        return redirect()->route('staff.pcompany.index')->with('success', 'Production Company Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = ProductionCompany::find($id);
        return view('staff.pcompany.show', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $genres = Genre::all();
        $data = ProductionCompany::find($id);
        return view('staff.pcompany.edit', ['data' => $data, 'genres' => $genres]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = ProductionCompany::find($id);
        $request->validate([
            'genre_id' => 'required',
            'title' => 'required',
            'founded' => 'required',
            'founders' => 'required',
        ]);
        //Data save to Database 
        $data->title = $request->title;
        $data->genre_id = $request->genre_id;
        $data->founded = $request->founded;
        $data->founders = $request->founders;
        $data->info = $request->info;
        $data->president = $request->president;
        $data->parentorganizations = $request->parentorganizations;

        // PHOTO for ProductionCompany
        if ($request->hasFile('photo')) {
            $data->photo = $request->file('photo')->store('ProductionCompanyPhoto', 'public');
        } else {
            $formFields['photo'] = $request->prev_photo;
        }

        $data->save();
        //Data Saved
        return redirect()->route('staff.pcompany.index')->with('success', 'Production Company Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = ProductionCompany::find($id);
        $data->delete();
        //Path of Photo from storage
        $pathPhoto = 'storage/' . $data->photo;
        //Delete File from storage
        if (File::exists($pathPhoto)) {
            //Delete the photo cover  file
            File::delete($pathPhoto);
        }
        return redirect()->route('staff.pcompany.index')->with('danger', 'Production Company has been deleted Successfully!');
    }
}
