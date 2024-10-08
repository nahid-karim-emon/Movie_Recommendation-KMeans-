<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\WatchMovie;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::all();
        return view('admin.user.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $formFields = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users|regex:/(.+)@(.+)\.(.+)/i',
            'password' => 'required | min:6',
            'mobile' => 'required',
        ]);

        //If user Gieven address
        if ($request->has('address')) {
            $formFields['address'] = $request->address;
        }
        //If user Gieven any PHOTO
        if ($request->hasFile('photo')) {
            $formFields['photo'] = $request->file('photo')->store('UserPhoto', 'public');
        }
        //Hash Password
        $formFields['password'] = bcrypt(($formFields['password']));

        User::create($formFields);
        $ref = $request->ref;
        if ($ref == 'front') {
            return redirect('welcome')->with('success', 'Registration Successful!' . $request->name);
        } else {
            return redirect('admin/user')->with('success', 'Data has been added Successfully!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $user = User::find($id);
        //watch movie
        $watch = WatchMovie::where('user_id', $id)->get();
        //movie list that user watched
        $data = [];
        $genres = [];
        $languages = [];
        $countries = [];
        $pcompanys = [];
        //$rating = [];
        foreach ($watch as $w) {
            $data[] = Movie::find($w->movie_id);
            $genres[] = Movie::find($w->movie_id)->genre;
            $languages[] = Movie::find($w->movie_id)->language;
            $countries[] = Movie::find($w->movie_id)->country;
            $pcompanys[] = Movie::find($w->movie_id)->production_company;
            //$rating[] = $w->rating;
        }
        return view('admin.user.show', ['user' => $user, 'data' => $data, 'genres' => $genres, 'languages' => $languages, 'countries' => $countries, 'pcompanys' => $pcompanys]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = User::find($id);
        return view('admin.user.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $data = User::find($id);
        $formFields = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
        ]);

        //If user Gieven address
        if ($request->has('address')) {
            $formFields['address'] = $request->address;
        }
        //If user Gieven any PHOTO
        if ($request->hasFile('photo')) {
            $formFields['photo'] = $request->file('photo')->store('UserPhoto', 'public');
        } else {
            $formFields['photo'] = $request->prev_photo;
        }

        //add age,gender,nationality,educational level,language,religion,maritial status,occupation
        if ($request->has('age')) {
            $formFields['age'] = $request->age;
        }
        if ($request->has('gender')) {
            $formFields['gender'] = $request->gender;
        }
        if ($request->has('nationality')) {
            $formFields['nationality'] = $request->nationality;
        }
        if ($request->has('educational_level')) {
            $formFields['educational_level'] = $request->educational_level;
        }
        if ($request->has('language')) {
            $formFields['language'] = $request->language;
        }
        if ($request->has('religion')) {
            $formFields['religion'] = $request->religion;
        }

        if ($request->has('maritial_status')) {
            $formFields['maritial_status'] = $request->maritial_status;
        }
        if ($request->has('occupation')) {
            $formFields['occupation'] = $request->occupation;
        }

        $data->name = $request->name;
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        $data->photo = $formFields['photo'];
        $data->age = $request->age;
        $data->gender = $request->gender;
        $data->nationality = $request->nationality;
        $data->educational_level = $request->educational_level;
        $data->language = $request->language;
        $data->religion = $request->religion;
        $data->maritial_status = $request->maritial_status;
        $data->occupation = $request->occupation;
        $data->updated_at = now();

        $data->save();

        //$data->update($formFields);
        return redirect('admin/user')->with('success', 'Data has been updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect('admin/user')->with('danger', 'Data has been deleted Successfully!');
    }
}
