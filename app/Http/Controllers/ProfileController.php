<?php

namespace App\Http\Controllers;


use App\Models\Cast;
use App\Models\User;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Director;
use App\Models\Interest;
use App\Models\Language;
use Illuminate\View\View;
use App\Models\InterestCast;
use Illuminate\Http\Request;
use App\Models\InterestGenre;
use App\Models\InterestRating;
use App\Models\InterestCountry;
use App\Models\InterestDirector;
use App\Models\InterestLanguage;
use App\Models\InterestPcompany;
use App\Models\ProductionCompany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{

    public function index()
    {
        return view('profile.dashboard');
    }
    /**
     * Display the user's profile form.
     */
    public function view(Request $request): View
    {
        return view('profile.partials.view', [
            'user' => $request->user(),
        ]);
    }


    public function edit(Request $request): View
    {
        return view('profile.partials.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $data = User::find($request->userid);
        $formFields = $request->validate([
            'name' => 'required',
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

        $data->name = $request->name;
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        $data->photo = $formFields['photo'];

        $data->save();

        return Redirect::route('user.profile.view')->with('success', 'Profile Updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    // User Interest Section
    public function interest()
    {
        $user = Auth::user();
        $data = Interest::all()->where('user_id', '=', $user->id)->first();
        if ($data == null) {
            //IF no interest Added
            $genres = Genre::all();
            $casts = Cast::all();
            $languages = Language::all();
            $pcompanys = ProductionCompany::all();
            $directors = Director::all();
            $countries = Country::all();
            return view('profile.interest.interest', ['genres' => $genres, 'casts' => $casts, 'languages' => $languages, 'pcompanys' => $pcompanys, 'directors' => $directors, 'countries' => $countries, 'user' => $user]);
        } else {
            $id = $data->id;
            //IF any interest Added
            $data = Interest::find($id);
            $InterestGenredata = InterestGenre::all()->where('interest_id', '=', $id);
            $InterestCastdata = InterestCast::all()->where('interest_id', '=', $id);
            $InterestDirectordata = InterestDirector::all()->where('interest_id', '=', $id);
            $InterestLanguagedata = InterestLanguage::all()->where('interest_id', '=', $id);
            $InterestPcompanydata = InterestPcompany::all()->where('interest_id', '=', $id);
            $InterestRatingData = InterestRating::all()->where('interest_id', '=', $id);
            $InterestCountryData = InterestCountry::all()->where('interest_id', '=', $id);
            return view('profile.interest.interestshow', ['data' => $data, 'InterestGenredata' => $InterestGenredata, 'InterestCastdata' => $InterestCastdata, 'InterestDirectordata' => $InterestDirectordata, 'InterestLanguagedata' => $InterestLanguagedata, 'InterestPcompanydata' => $InterestPcompanydata, 'InterestCountryData' => $InterestCountryData, 'InterestRatingData' => $InterestRatingData]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function intereststore(Request $request)
    {
        //
        $request->validate([
            'user_id' => 'required',
            'country' => 'required',
            'genre' => 'required',
            'cast' => 'required',
            'director' => 'required',
            'language' => 'required',
            'pcompany' => 'required',
        ]);
        //Data save to Database 
        $data = new Interest();
        $data->user_id = $request->user_id;
        $data->save();
        //Movie Country relation save
        if (count($request->country) >= 1) {
            foreach ($request->country as $country) {
                //Interest Data save to Genre 
                $InterestCountryData = new InterestCountry();
                $InterestCountryData->interest_id = $data->id;
                $InterestCountryData->country_id = $country;
                $InterestCountryData->save();
            }
        }
        //Genre relation save
        if (count($request->genre) >= 1) {
            foreach ($request->genre as $genre) {
                //Interest Data save to Genre 
                $InterestGenreData = new InterestGenre();
                $InterestGenreData->interest_id = $data->id;
                $InterestGenreData->genre_id = $genre;
                $InterestGenreData->save();
            }
        }
        //Cast relation save 
        if (count($request->cast) >= 1) {
            foreach ($request->cast as $cast) {
                //Interest Data relation to Cast 
                $InterestCastData = new InterestCast();
                $InterestCastData->interest_id = $data->id;
                $InterestCastData->cast_id = $cast;
                $InterestCastData->save();
            }
        }
        //Director relation save 
        if (count($request->director) >= 1) {
            foreach ($request->director as $director) {
                //Interest Data relation to Genre 
                $InterestDirectorData = new InterestDirector();
                $InterestDirectorData->interest_id = $data->id;
                $InterestDirectorData->director_id = $director;
                $InterestDirectorData->save();
            }
        }
        //Production Company relation save 
        if (count($request->pcompany) >= 1) {
            foreach ($request->pcompany as $pcompany) {
                //Interest Data relation to Production Company 
                $InterestPcompanyData = new InterestPcompany();
                $InterestPcompanyData->interest_id = $data->id;
                $InterestPcompanyData->pcompany_id = $pcompany;
                $InterestPcompanyData->save();
            }
        }
        //Language relation save 
        if (count($request->language) >= 1) {
            foreach ($request->language as $language) {
                //Interest Data relation to Language 
                $InterestLanguageData = new InterestLanguage();
                $InterestLanguageData->interest_id = $data->id;
                $InterestLanguageData->language_id = $language;
                $InterestLanguageData->save();
            }
        }
        //Ratings relation save always 
        if (true) {
            if (isset($request->rating0)) {
                //Interest Data relation to Rating 1 
                $InterestRatingData = new InterestRating();
                $InterestRatingData->interest_id = $data->id;
                $InterestRatingData->rating_id = 1;
                $InterestRatingData->ratings = $request->rating0;
                $InterestRatingData->save();
            } else {
                //Interest Data relation to Rating 1 
                $InterestRatingData = new InterestRating();
                $InterestRatingData->interest_id = $data->id;
                $InterestRatingData->rating_id = 1;
                $InterestRatingData->ratings = 0;
                $InterestRatingData->save();
            }
            if (isset($request->rating1)) {
                //Interest Data relation to Rating 1 
                $InterestRatingData = new InterestRating();
                $InterestRatingData->interest_id = $data->id;
                $InterestRatingData->rating_id = 2;
                $InterestRatingData->ratings = $request->rating1;
                $InterestRatingData->save();
            } else {
                //Interest Data relation to Rating 1 
                $InterestRatingData = new InterestRating();
                $InterestRatingData->interest_id = $data->id;
                $InterestRatingData->rating_id = 2;
                $InterestRatingData->ratings = 0;
                $InterestRatingData->save();
            }
            if (isset($request->rating2)) {
                //Interest Data relation to Rating 1 
                $InterestRatingData = new InterestRating();
                $InterestRatingData->interest_id = $data->id;
                $InterestRatingData->rating_id = 3;
                $InterestRatingData->ratings = $request->rating2;
                $InterestRatingData->save();
            } else {
                //Interest Data relation to Rating 1 
                $InterestRatingData = new InterestRating();
                $InterestRatingData->interest_id = $data->id;
                $InterestRatingData->rating_id = 3;
                $InterestRatingData->ratings = 0;
                $InterestRatingData->save();
            }
        }
        //Data Saved
        return redirect()->route('user.interest.add')->with('success', 'Interests Added Successfully!');
    }
    //Interest Update
    public function editinterest(string $id)
    {
        //
        $user = Auth::user();
        $data = Interest::find($id);
        $genres = Genre::all();
        $casts = Cast::all();
        $languages = Language::all();
        $pcompanys = ProductionCompany::all();
        $directors = Director::all();
        $countries = Country::all();
        return view('profile.interest.edit', ['data' => $data, 'genres' => $genres, 'casts' => $casts, 'languages' => $languages, 'pcompanys' => $pcompanys, 'directors' => $directors, 'countries' => $countries, 'user' => $user]);
    }
    public function editUpdate(Request $request, string $id)
    {
        //
        $request->validate([
            'user_id' => 'required',
        ]);
        $data = Interest::find($id);
        if ($data->user_id != $request->user_id) {
            return redirect()->back();
        }
        //Country relation Update
        if (count($request->country) >= 1) {
            $oldInterestCountryData = InterestCountry::all()->where('interest_id', '=', $data->id);
            $status = 0;
            //Delete Removed Country
            foreach ($oldInterestCountryData as $oldcountry) {
                foreach ($request->country as $country) {
                    if ($country == $oldcountry->country_id) {
                        $status = 1;
                        break;
                    } else {
                        $status = 0;
                    }
                }
                if ($status == 0) {
                    $dataoldGenre = DB::table('interest_countries')
                        ->where('country_id', '=', $oldcountry->country_id)
                        ->delete();
                }
            }
            //Add If not existed in relation
            foreach ($request->country as $country) {
                foreach ($oldInterestCountryData as $oldcountry) {
                    if ($country == $oldcountry->country_id) {
                        $status = 1;
                        break;
                    } else {
                        $status = 0;
                    }
                }
                if ($status != 1) {
                    //Movie Data save to New Genre 
                    $InterestCountryData = new InterestCountry();
                    $InterestCountryData->interest_id = $data->id;
                    $InterestCountryData->country_id = $country;
                    $InterestCountryData->save();
                }
            }
        }
        //Genre relation Update
        if (count($request->genre) >= 1) {
            $oldInterestGenreData = InterestGenre::all()->where('interest_id', '=', $data->id);
            $status = 0;
            //Delete Removed Genre
            foreach ($oldInterestGenreData as $oldgenre) {
                foreach ($request->genre as $genre) {
                    if ($genre == $oldgenre->genre_id) {
                        $status = 1;
                        break;
                    } else {
                        $status = 0;
                    }
                }
                if ($status == 0) {
                    $dataoldGenre = DB::table('interest_genres')
                        ->where('genre_id', '=', $oldgenre->genre_id)
                        ->delete();
                }
            }
            //Add If not existed in relation
            foreach ($request->genre as $genre) {
                foreach ($oldInterestGenreData as $oldgenre) {
                    if ($genre == $oldgenre->genre_id) {
                        $status = 1;
                        break;
                    } else {
                        $status = 0;
                    }
                }
                if ($status != 1) {
                    //Interest Data save to New Genre 
                    $InterestGenreData = new InterestGenre();
                    $InterestGenreData->interest_id = $data->id;
                    $InterestGenreData->genre_id = $genre;
                    $InterestGenreData->save();
                }
            }
        }

        //Cast relation Update 
        if (count($request->cast) >= 1) {
            $status = 0;
            $oldInterestCastData = InterestCast::all()->where('interest_id', '=', $data->id);
            //Delete Removed Cast
            foreach ($oldInterestCastData as $oldCast) {
                foreach ($request->cast as $cast) {
                    if ($cast == $oldCast->cast_id) {
                        $status = 1;
                        break;
                    } else {
                        $status = 0;
                    }
                }
                if ($status == 0) {
                    $dataOldCast = DB::table('interest_casts')
                        ->where('cast_id', '=', $oldCast->cast_id)
                        ->delete();
                }
            }
            //Add If not existed in relation
            foreach ($request->cast as $cast) {
                foreach ($oldInterestCastData as $oldCast) {
                    if ($cast == $oldCast->cast_id) {
                        $status = 1;
                        break;
                    } else {
                        $status = 0;
                    }
                }
                if ($status != 1) {
                    //Interest Data relation to Cast 
                    $InterestCastData = new InterestCast();
                    $InterestCastData->interest_id = $data->id;
                    $InterestCastData->cast_id = $cast;
                    $InterestCastData->save();
                }
            }
        }
        //Director relation Update 
        if (count($request->director) >= 1) {
            $status = 0;
            $oldInterestDirectorData = InterestDirector::all()->where('interest_id', '=', $data->id);
            //Delete Removed Director
            foreach ($oldInterestDirectorData as $oldDirector) {
                foreach ($request->director as $director) {
                    if ($director == $oldDirector->director_id) {
                        $status = 1;
                        break;
                    } else {
                        $status = 0;
                    }
                }
                if ($status == 0) {
                    $dataoldDirector = DB::table('interest_directors')
                        ->where('director_id', '=', $oldDirector->director_id)
                        ->delete();
                }
            }
            //Add If not existed in relation
            foreach ($request->director as $director) {
                foreach ($oldInterestDirectorData as $oldDirector) {
                    if ($director == $oldDirector->director_id) {
                        $status = 1;
                        break;
                    } else {
                        $status = 0;
                    }
                }
                if ($status != 1) {
                    //Interest Data relation to Director 
                    $InterestDirectorData = new InterestDirector();
                    $InterestDirectorData->interest_id = $data->id;
                    $InterestDirectorData->director_id = $director;
                    $InterestDirectorData->save();
                }
            }
        }
        //Production Company relation Update 
        if (count($request->pcompany) >= 1) {
            $status = 0;
            $oldInterestPcompanyData = InterestPcompany::all()->where('interest_id', '=', $data->id);
            //Delete Removed Production Company
            foreach ($oldInterestPcompanyData as $oldPcompanyData) {
                foreach ($request->pcompany as $pcompany) {
                    if ($pcompany == $oldPcompanyData->pcompany_id) {
                        $status = 1;
                        break;
                    } else {
                        $status = 0;
                    }
                }
                if ($status == 0) {
                    $dataoldDirector = DB::table('interest_pcompanies')
                        ->where('pcompany_id', '=', $oldPcompanyData->pcompany_id)
                        ->delete();
                }
            }
            //Add If not existed in relation
            foreach ($request->pcompany as $pcompany) {
                foreach ($oldInterestPcompanyData as $oldPcompany) {
                    if ($pcompany == $oldPcompany->pcompany_id) {
                        $status = 1;
                        break;
                    } else {
                        $status = 0;
                    }
                }
                if ($status != 1) {
                    //Interest Data relation to Cast 
                    $InterestPcompanyData = new InterestPcompany();
                    $InterestPcompanyData->interest_id = $data->id;
                    $InterestPcompanyData->pcompany_id = $pcompany;
                    $InterestPcompanyData->save();
                }
            }
        }
        //Language relation Update 
        if (count($request->language) >= 1) {
            $status = 0;
            $oldInterestLanguageData = InterestLanguage::all()->where('interest_id', '=', $data->id);
            //Delete Removed Language
            foreach ($oldInterestLanguageData as $oldLanguageData) {
                foreach ($request->language as $language) {
                    if ($language == $oldLanguageData->language_id) {
                        $status = 1;
                        break;
                    } else {
                        $status = 0;
                    }
                }
                if ($status == 0) {
                    $dataoldDirector = DB::table('interest_languages')
                        ->where('language_id', '=', $oldLanguageData->language_id)
                        ->delete();
                }
            }
            //Add If not existed in relation
            foreach ($request->language as $language) {
                foreach ($oldInterestLanguageData as $oldLanguage) {
                    if ($language == $oldLanguage->language_id) {
                        $status = 1;
                        break;
                    } else {
                        $status = 0;
                    }
                }
                if ($status != 1) {
                    //Interest Data relation to Language 
                    $InterestLanguageData = new InterestLanguage();
                    $InterestLanguageData->interest_id = $data->id;
                    $InterestLanguageData->language_id = $language;
                    $InterestLanguageData->save();
                }
            }
        }
        //Data Saved
        return redirect()->route('user.interest.add')->with('success', 'Interest Updated Successfully!');
    }

    // Interest Rating
    public function editinterestrating(string $id)
    {
        //
        $data = Interest::find($id);
        $InterestRatingData = InterestRating::all()->where('interest_id', '=', $id);
        return view('profile.interest.rating', ['data' => $data, 'InterestRatingData' => $InterestRatingData]);
    }
    public function ratingUpdate(Request $request, string $id)
    {
        $InterestRatingdata = InterestRating::all()->where('interest_id', '=', $id);
        //Ratings relation Update 
        if (isset($request->rating1) || isset($request->rating2) || isset($request->rating3)) {
            if (isset($request->rating1)) {
                //Interest Data relation to Rating 1 
                $InterestRatingData = InterestRating::all()
                    ->where('interest_id', '=', $id)
                    ->where('rating_id', '=', 1)->first();
                $InterestRatingData->ratings = $request->rating1;
                $InterestRatingData->save();
            }
            if (isset($request->rating2)) {
                //Interest Data relation to Rating 2
                $InterestRatingData = InterestRating::all()
                    ->where('interest_id', '=', $id)
                    ->where('rating_id', '=', 2)->first();
                $InterestRatingData->ratings = $request->rating2;
                $InterestRatingData->save();
            }
            if (isset($request->rating3)) {
                //Interest Data relation to Rating 1 
                $InterestRatingData = InterestRating::all()
                    ->where('interest_id', '=', $id)
                    ->where('rating_id', '=', 3)->first();
                $InterestRatingData->ratings = $request->rating3;
                $InterestRatingData->save();
            }
        }
        return redirect()->route('user.interest.add')->with('success', 'Interest Rating Updated Successfully!');
    }
}
