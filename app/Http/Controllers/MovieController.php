<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieCast;
use App\Models\MovieGenre;
use App\Models\MovieRating;
use Illuminate\Http\Request;
use App\Models\MovieDirector;
use App\Models\MovieLanguage;
use App\Models\MoviePcompany;
use Illuminate\Support\Carbon;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        //
        $data = Movie::all();
        $currentDateData = Carbon::now();
        $currentDate = $currentDateData->format('Y-m-d');
        $upcoming = Movie::all()->where('release', '>', $currentDate);
        if (count($upcoming) != null) {
            return view('welcome', ['data' => $data->sortByDesc("id"), 'upcoming' => $upcoming]);
        } else {
            return view('welcome', ['data' => $data->sortByDesc("id")]);
        }
    }
    public function index()
    {
        //
        $data = Movie::all();
        return view('pages.movie', ['data' => $data->sortByDesc("id")]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Movie::find($id);
        $MovieGenredata = MovieGenre::all()->where('movie_id', '=', $id);
        $MovieCastdata = MovieCast::all()->where('movie_id', '=', $id);
        $MovieDirectordata = MovieDirector::all()->where('movie_id', '=', $id);
        $MovieLanguagedata = MovieLanguage::all()->where('movie_id', '=', $id);
        $MoviePcompanydata = MoviePcompany::all()->where('movie_id', '=', $id);
        $MovieRatingData = MovieRating::all()->where('movie_id', '=', $id);
        return view('pages.movieSingle', ['data' => $data, 'MovieGenredata' => $MovieGenredata, 'MovieCastdata' => $MovieCastdata, 'MovieDirectordata' => $MovieDirectordata, 'MovieLanguagedata' => $MovieLanguagedata, 'MoviePcompanydata' => $MoviePcompanydata, 'MovieRatingData' => $MovieRatingData]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
