<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Movie;
use App\Models\SiteOption;
use App\Models\WatchMovie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    //
    public function index()
    {
        return view('admin.dashboard');
    }
    public function editSetting()
    {
        $datas = SiteOption::all();
        return view('admin.settings.edit', ['datas' => $datas]);
    }
    public function updateSetting(Request $request, $id)
    {
        //
        $data = SiteOption::find($id);
        $request->validate([
            'value' => 'required',
        ]);
        $data->value = $request->value;
        $data->save();

        return redirect('admin/settings')->with('success', 'Settings has been updated Successfully!');
    }
    public function view()
    {
        return view('admin.layouts.view', [
            'user' => Auth::guard('admin')->user(),
        ]);
    }

    public function edit()
    {
        return view('admin.layouts.edit', [
            'user' => Auth::guard('admin')->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $data = Admin::find($request->userid);
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $data->name = $request->name;
        $data->email = $request->email;

        $data->save();
        return Redirect::route('admin.profile.view')->with('success', 'Profile Updated');
    }
    public function showUsers(string $id)
    {
        //
        $movie = Movie::find($id);
        $data = [];
        $users = WatchMovie::where('movie_id', $id)->get()->unique('user_id');
        foreach ($users as $user) {
            $data[] = User::where('id', $user->user_id)->first();
        }
        //dd($data);
        return view('admin.movie.show', ['data' => $data, 'movie' => $movie]);
    }
}
