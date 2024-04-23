<?php

namespace App\Http\Controllers\Staff;

use App\Models\Cast;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Country;
use App\Models\Director;
use App\Models\Language;
use App\Models\MovieCast;
use App\Models\MovieGenre;
use App\Models\MovieRating;
use App\Models\MovieCountry;
use Illuminate\Http\Request;
use App\Models\MovieDirector;
use App\Models\MovieLanguage;
use App\Models\MoviePcompany;
use App\Models\ProductionCompany;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;


class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Movie::all();
        return view('staff.movie.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $genres = Genre::all();
        $casts = Cast::all();
        $languages = Language::all();
        $pcompanys = ProductionCompany::all();
        $directors = Director::all();
        $countries = Country::all();
        return view('staff.movie.create', ['genres' => $genres, 'casts' => $casts, 'languages' => $languages, 'pcompanys' => $pcompanys, 'directors' => $directors, 'countries' => $countries]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'photo' => 'required',
            'release' => 'required',
            'country' => 'required',
            'genre' => 'required',
            'cast' => 'required',
            'director' => 'required',
            'language' => 'required',
            'pcompany' => 'required',
        ]);
        //Data save to Database 
        $data = new Movie();
        $data->title = $request->title;
        $data->release = $request->release;
        $data->info = $request->info;
        // PHOTO for Movie
        if ($request->hasFile('photo')) {
            $data->photo = $request->file('photo')->store('MoviePhoto', 'public');
        }
        $data->save();
        //Country relation save
        if (count($request->country) >= 1) {
            foreach ($request->country as $country) {
                //Movie Data save to Genre 
                $MovieCountryData = new MovieCountry();
                $MovieCountryData->movie_id = $data->id;
                $MovieCountryData->country_id = $country;
                $MovieCountryData->save();
            }
        }
        //Genre relation save
        if (count($request->genre) >= 1) {
            foreach ($request->genre as $genre) {
                //Movie Data save to Genre 
                $MovieGenreData = new MovieGenre();
                $MovieGenreData->movie_id = $data->id;
                $MovieGenreData->genre_id = $genre;
                $MovieGenreData->save();
            }
        }
        //Cast relation save 
        if (count($request->cast) >= 1) {
            foreach ($request->cast as $cast) {
                //Movie Data relation to Cast 
                $MovieCastData = new MovieCast();
                $MovieCastData->movie_id = $data->id;
                $MovieCastData->cast_id = $cast;
                $MovieCastData->save();
            }
        }
        //Director relation save 
        if (count($request->director) >= 1) {
            foreach ($request->director as $director) {
                //Movie Data relation to Genre 
                $MovieDirectorData = new MovieDirector();
                $MovieDirectorData->movie_id = $data->id;
                $MovieDirectorData->director_id = $director;
                $MovieDirectorData->save();
            }
        }
        //Production Company relation save 
        if (count($request->pcompany) >= 1) {
            foreach ($request->pcompany as $pcompany) {
                //Movie Data relation to Production Company 
                $MoviePcompanyData = new MoviePcompany();
                $MoviePcompanyData->movie_id = $data->id;
                $MoviePcompanyData->pcompany_id = $pcompany;
                $MoviePcompanyData->save();
            }
        }
        //Language relation save 
        if (count($request->language) >= 1) {
            foreach ($request->language as $language) {
                //Movie Data relation to Language 
                $MovieLanguageData = new MovieLanguage();
                $MovieLanguageData->movie_id = $data->id;
                $MovieLanguageData->language_id = $language;
                $MovieLanguageData->save();
            }
        }
        //Ratings relation save always 
        if (true) {
            if (isset($request->rating0)) {
                //Movie Data relation to Rating 1 
                $MovieRatingData = new MovieRating();
                $MovieRatingData->movie_id = $data->id;
                $MovieRatingData->rating_id = 1;
                $MovieRatingData->ratings = $request->rating0;
                $MovieRatingData->save();
            } else {
                //Movie Data relation to Rating 1 
                $MovieRatingData = new MovieRating();
                $MovieRatingData->movie_id = $data->id;
                $MovieRatingData->rating_id = 1;
                $MovieRatingData->ratings = 0;
                $MovieRatingData->save();
            }
            if (isset($request->rating1)) {
                //Movie Data relation to Rating 1 
                $MovieRatingData = new MovieRating();
                $MovieRatingData->movie_id = $data->id;
                $MovieRatingData->rating_id = 2;
                $MovieRatingData->ratings = $request->rating1;
                $MovieRatingData->save();
            } else {
                //Movie Data relation to Rating 1 
                $MovieRatingData = new MovieRating();
                $MovieRatingData->movie_id = $data->id;
                $MovieRatingData->rating_id = 2;
                $MovieRatingData->ratings = 0;
                $MovieRatingData->save();
            }
            if (isset($request->rating2)) {
                //Movie Data relation to Rating 1 
                $MovieRatingData = new MovieRating();
                $MovieRatingData->movie_id = $data->id;
                $MovieRatingData->rating_id = 3;
                $MovieRatingData->ratings = $request->rating2;
                $MovieRatingData->save();
            } else {
                //Movie Data relation to Rating 1 
                $MovieRatingData = new MovieRating();
                $MovieRatingData->movie_id = $data->id;
                $MovieRatingData->rating_id = 3;
                $MovieRatingData->ratings = 0;
                $MovieRatingData->save();
            }
        }
        //Data Saved
        return redirect()->route('staff.movie.index')->with('success', 'Movie Added Successfully!');
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
        $MovieCountryData = MovieCountry::all()->where('movie_id', '=', $id);
        $MovieRatingData = MovieRating::all()->where('movie_id', '=', $id);
        return view('staff.movie.show', ['data' => $data, 'MovieGenredata' => $MovieGenredata, 'MovieCountryData' => $MovieCountryData, 'MovieCastdata' => $MovieCastdata, 'MovieDirectordata' => $MovieDirectordata, 'MovieLanguagedata' => $MovieLanguagedata, 'MoviePcompanydata' => $MoviePcompanydata, 'MovieRatingData' => $MovieRatingData]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = Movie::find($id);
        $genres = Genre::all();
        $casts = Cast::all();
        $languages = Language::all();
        $pcompanys = ProductionCompany::all();
        $directors = Director::all();
        $countries = Country::all();
        return view('staff.movie.edit', ['data' => $data, 'genres' => $genres, 'casts' => $casts, 'languages' => $languages, 'pcompanys' => $pcompanys, 'directors' => $directors, 'countries' => $countries]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = Movie::find($id);

        $request->validate([
            'title' => 'required',
            'release' => 'required',
            'genre' => 'required',
            'cast' => 'required',
            'director' => 'required',
            'language' => 'required',
            'country' => 'required',
            'pcompany' => 'required',
        ]);
        //Data save to Database 
        $data->title = $request->title;
        $data->release = $request->release;
        $data->info = $request->info;
        // PHOTO for Movie
        if ($request->hasFile('photo')) {
            $data->photo = $request->file('photo')->store('MoviePhoto', 'public');
        } else {
            $data->photo = $request->prev_photo;
        }
        $data->save();
        //Country relation Update
        if (count($request->country) >= 1) {
            $oldMovieCountryData = MovieCountry::all()->where('movie_id', '=', $data->id);
            $status = 0;
            //Delete Removed Genre
            foreach ($oldMovieCountryData as $oldcountry) {
                foreach ($request->country as $country) {
                    if ($country == $oldcountry->country_id) {
                        $status = 1;
                        break;
                    } else {
                        $status = 0;
                    }
                }
                if ($status == 0) {
                    $dataoldGenre = DB::table('movie_countries')
                        ->where('country_id', '=', $oldcountry->country_id)
                        ->delete();
                }
            }
            //Add If not existed in relation
            foreach ($request->country as $country) {
                foreach ($oldMovieCountryData as $oldcountry) {
                    if ($country == $oldcountry->country_id) {
                        $status = 1;
                        break;
                    } else {
                        $status = 0;
                    }
                }
                if ($status != 1) {
                    //Movie Data save to New Genre 
                    $MovieCountryData = new MovieCountry();
                    $MovieCountryData->movie_id = $data->id;
                    $MovieCountryData->country_id = $country;
                    $MovieCountryData->save();
                }
            }
        }
        //Genre relation Update
        if (count($request->genre) >= 1) {
            $oldMovieGenreData = MovieGenre::all()->where('movie_id', '=', $data->id);
            $status = 0;
            //Delete Removed Genre
            foreach ($oldMovieGenreData as $oldgenre) {
                foreach ($request->genre as $genre) {
                    if ($genre == $oldgenre->genre_id) {
                        $status = 1;
                        break;
                    } else {
                        $status = 0;
                    }
                }
                if ($status == 0) {
                    $dataoldGenre = DB::table('movie_genres')
                        ->where('genre_id', '=', $oldgenre->genre_id)
                        ->delete();
                }
            }
            //Add If not existed in relation
            foreach ($request->genre as $genre) {
                foreach ($oldMovieGenreData as $oldgenre) {
                    if ($genre == $oldgenre->genre_id) {
                        $status = 1;
                        break;
                    } else {
                        $status = 0;
                    }
                }
                if ($status != 1) {
                    //Movie Data save to New Genre 
                    $MovieGenreData = new MovieGenre();
                    $MovieGenreData->movie_id = $data->id;
                    $MovieGenreData->genre_id = $genre;
                    $MovieGenreData->save();
                }
            }
        }

        //Cast relation Update 
        if (count($request->cast) >= 1) {
            $status = 0;
            $oldMovieCastData = MovieCast::all()->where('movie_id', '=', $data->id);
            //Delete Removed Cast
            foreach ($oldMovieCastData as $oldCast) {
                foreach ($request->cast as $cast) {
                    if ($cast == $oldCast->cast_id) {
                        $status = 1;
                        break;
                    } else {
                        $status = 0;
                    }
                }
                if ($status == 0) {
                    $dataOldCast = DB::table('movie_casts')
                        ->where('cast_id', '=', $oldCast->cast_id)
                        ->delete();
                }
            }
            //Add If not existed in relation
            foreach ($request->cast as $cast) {
                foreach ($oldMovieCastData as $oldCast) {
                    if ($cast == $oldCast->cast_id) {
                        $status = 1;
                        break;
                    } else {
                        $status = 0;
                    }
                }
                if ($status != 1) {
                    //Movie Data relation to Cast 
                    $MovieCastData = new MovieCast();
                    $MovieCastData->movie_id = $data->id;
                    $MovieCastData->cast_id = $cast;
                    $MovieCastData->save();
                }
            }
        }
        //Director relation Update 
        if (count($request->director) >= 1) {
            $status = 0;
            $oldMovieDirectorData = MovieDirector::all()->where('movie_id', '=', $data->id);
            //Delete Removed Director
            foreach ($oldMovieDirectorData as $oldDirector) {
                foreach ($request->director as $director) {
                    if ($director == $oldDirector->director_id) {
                        $status = 1;
                        break;
                    } else {
                        $status = 0;
                    }
                }
                if ($status == 0) {
                    $dataoldDirector = DB::table('movie_directors')
                        ->where('director_id', '=', $oldDirector->director_id)
                        ->delete();
                }
            }
            //Add If not existed in relation
            foreach ($request->director as $director) {
                foreach ($oldMovieDirectorData as $oldDirector) {
                    if ($director == $oldDirector->director_id) {
                        $status = 1;
                        break;
                    } else {
                        $status = 0;
                    }
                }
                if ($status != 1) {
                    //Movie Data relation to Director 
                    $MovieDirectorData = new MovieDirector();
                    $MovieDirectorData->movie_id = $data->id;
                    $MovieDirectorData->director_id = $director;
                    $MovieDirectorData->save();
                }
            }
        }
        //Production Company relation Update 
        if (count($request->pcompany) >= 1) {
            $status = 0;
            $oldMoviePcompanyData = MoviePcompany::all()->where('movie_id', '=', $data->id);
            //Delete Removed Production Company
            foreach ($oldMoviePcompanyData as $oldPcompanyData) {
                foreach ($request->pcompany as $pcompany) {
                    if ($pcompany == $oldPcompanyData->pcompany_id) {
                        $status = 1;
                        break;
                    } else {
                        $status = 0;
                    }
                }
                if ($status == 0) {
                    $dataoldDirector = DB::table('movie_pcompanies')
                        ->where('pcompany_id', '=', $oldPcompanyData->pcompany_id)
                        ->delete();
                }
            }
            //Add If not existed in relation
            foreach ($request->pcompany as $pcompany) {
                foreach ($oldMoviePcompanyData as $oldPcompany) {
                    if ($pcompany == $oldPcompany->pcompany_id) {
                        $status = 1;
                        break;
                    } else {
                        $status = 0;
                    }
                }
                if ($status != 1) {
                    //Movie Data relation to Cast 
                    $MoviePcompanyData = new MoviePcompany();
                    $MoviePcompanyData->movie_id = $data->id;
                    $MoviePcompanyData->pcompany_id = $pcompany;
                    $MoviePcompanyData->save();
                }
            }
        }
        //Language relation Update 
        if (count($request->language) >= 1) {
            $status = 0;
            $oldMovieLanguageData = MovieLanguage::all()->where('movie_id', '=', $data->id);
            //Delete Removed Language
            foreach ($oldMovieLanguageData as $oldLanguageData) {
                foreach ($request->language as $language) {
                    if ($language == $oldLanguageData->language_id) {
                        $status = 1;
                        break;
                    } else {
                        $status = 0;
                    }
                }
                if ($status == 0) {
                    $dataoldDirector = DB::table('movie_languages')
                        ->where('language_id', '=', $oldLanguageData->language_id)
                        ->delete();
                }
            }
            //Add If not existed in relation
            foreach ($request->language as $language) {
                foreach ($oldMovieLanguageData as $oldLanguage) {
                    if ($language == $oldLanguage->language_id) {
                        $status = 1;
                        break;
                    } else {
                        $status = 0;
                    }
                }
                if ($status != 1) {
                    //Movie Data relation to Language 
                    $MovieLanguageData = new MovieLanguage();
                    $MovieLanguageData->movie_id = $data->id;
                    $MovieLanguageData->language_id = $language;
                    $MovieLanguageData->save();
                }
            }
        }
        //Data Saved
        return redirect()->route('staff.movie.index')->with('success', 'Movie Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = Movie::find($id);
        $MovieGenredata = MovieGenre::all()->where('movie_id', '=', $id);
        foreach ($MovieGenredata as $MovieGenre) {
            $deleteData = DB::table('movie_genres')
                ->where('movie_id', '=', $id)
                ->delete();
        }
        $MovieCastdata = MovieCast::all()->where('movie_id', '=', $id);
        foreach ($MovieCastdata as $MovieCast) {
            $deleteData = DB::table('movie_casts')
                ->where('movie_id', '=', $id)
                ->delete();
        }
        $MovieDirectordata = MovieDirector::all()->where('movie_id', '=', $id);
        foreach ($MovieDirectordata as $MovieDirector) {
            $deleteData = DB::table('movie_directors')
                ->where('movie_id', '=', $id)
                ->delete();
        }
        $MovieLanguagedata = MovieLanguage::all()->where('movie_id', '=', $id);
        foreach ($MovieLanguagedata as $MovieLanguage) {
            $deleteData = DB::table('movie_languages')
                ->where('movie_id', '=', $id)
                ->delete();
        }
        $MoviePcompanydata = MoviePcompany::all()->where('movie_id', '=', $id);
        foreach ($MoviePcompanydata as $MoviePcompany) {
            $deleteData = DB::table('movie_pcompanies')
                ->where('movie_id', '=', $id)
                ->delete();
        }
        $MovieRatingData = MovieRating::all()->where('movie_id', '=', $id);
        foreach ($MovieRatingData as $MovieRating) {
            $deleteData = DB::table('movie_ratings')
                ->where('movie_id', '=', $id)
                ->delete();
        }
        $data->delete();
        //Path of Photo from storage
        $pathPhoto = 'storage/' . $data->photo;
        //Delete File from storage
        if (File::exists($pathPhoto)) {
            //Delete the photo cover  file
            File::delete($pathPhoto);
        }
        return redirect()->route('staff.movie.index')->with('danger', 'Movie has been deleted and Related Data Removed Successfully!');
    }

    //Movie Rating
    public function rating(string $id)
    {
        //
        $data = Movie::find($id);
        $MovieRatings = MovieRating::all()->where('movie_id', '=', $id);
        if (count($MovieRatings) == 0) {
            for ($i = 1; $i <= 3; $i++) {
                $MovieRating = new MovieRating();
                $MovieRating->movie_id = $data->id;
                $MovieRating->rating_id = $i;
                $MovieRating->ratings = 0;
                $MovieRating->save();
            }
        }
        $MovieRatingData = MovieRating::all()->where('movie_id', '=', $id);
        return view('staff.movie.rating', ['data' => $data, 'MovieRatingData' => $MovieRatingData]);
    }
    public function ratingUpdate(Request $request, string $id)
    {
        $MovieRatingdata = MovieRating::all()->where('movie_id', '=', $id);
        //Ratings relation Update 
        if (isset($request->rating1) || isset($request->rating2) || isset($request->rating3)) {
            if (isset($request->rating1)) {
                //Movie Data relation to Rating 1 
                $MovieRatingData = MovieRating::all()
                    ->where('movie_id', '=', $id)
                    ->where('rating_id', '=', 1)->first();
                $MovieRatingData->ratings = $request->rating1;
                $MovieRatingData->save();
            }
            if (isset($request->rating2)) {
                //Movie Data relation to Rating 2
                $MovieRatingData = MovieRating::all()
                    ->where('movie_id', '=', $id)
                    ->where('rating_id', '=', 2)->first();
                $MovieRatingData->ratings = $request->rating2;
                $MovieRatingData->save();
            }
            if (isset($request->rating3)) {
                //Movie Data relation to Rating 1 
                $MovieRatingData = MovieRating::all()
                    ->where('movie_id', '=', $id)
                    ->where('rating_id', '=', 3)->first();
                $MovieRatingData->ratings = $request->rating3;
                $MovieRatingData->save();
            }
        }
        return redirect()->route('staff.movie.index')->with('success', 'Movie Rating Updated Successfully!');
    }
}
