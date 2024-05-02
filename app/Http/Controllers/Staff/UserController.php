<?php

namespace App\Http\Controllers\Staff;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::all();
        return view('staff.user.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('staff.user.create');
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
            return redirect()->route('staff.user.index')->with('success', 'User has been added Successfully!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = User::find($id);
        return view('staff.user.show', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = User::find($id);
        return view('staff.user.edit', ['data' => $data]);
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
        return redirect()->route('staff.user.index')->with('success', 'Data has been updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect()->route('staff.user.index')->with('danger', 'User has been deleted Successfully!');
    }
}
