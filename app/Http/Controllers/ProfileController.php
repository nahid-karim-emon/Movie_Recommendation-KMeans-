<?php

namespace App\Http\Controllers;


use App\Models\Cast;
use App\Models\User;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Country;
use App\Models\Director;
use App\Models\Interest;
use App\Models\Language;
use Illuminate\View\View;
use App\Models\WatchMovie;
use App\Models\InterestCast;
use Illuminate\Http\Request;
use Phpml\Clustering\KMeans;
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
use Phpml\Preprocessing\LabelEncoder;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{

    public function index()
    {
        return view('profile.dashboard');
    }
    public function view1()
    {
        $user = Auth::user();
        //dd($user);
        //watch movie
        $watch = WatchMovie::where('user_id', $user->id)->get();
        //dd($watch);
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
        return view('admin.user.watch', ['user' => $user, 'data' => $data, 'genres' => $genres, 'languages' => $languages, 'countries' => $countries, 'pcompanys' => $pcompanys]);
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
    // public function update(Request $request)
    // {
    //     $data = User::find($request->userid);
    //     $formFields = $request->validate([
    //         'name' => 'required',
    //         'mobile' => 'required',
    //     ]);
    //     //If user Gieven address
    //     if ($request->has('address')) {
    //         $formFields['address'] = $request->address;
    //     }
    //     //If user Gieven any PHOTO
    //     if ($request->hasFile('photo')) {
    //         $formFields['photo'] = $request->file('photo')->store('UserPhoto', 'public');
    //     } else {
    //         $formFields['photo'] = $request->prev_photo;
    //     }
    //     if ($request->has('age')) {
    //         $formFields['age'] = $request->age;
    //     }
    //     if ($request->has('gender')) {
    //         $formFields['gender'] = $request->gender;
    //     }
    //     if ($request->has('nationality')) {
    //         $formFields['nationality'] = $request->nationality;
    //     }
    //     if ($request->has('educational_level')) {
    //         $formFields['educational_level'] = $request->educational_level;
    //     }
    //     if ($request->has('language')) {
    //         $formFields['language'] = $request->language;
    //     }
    //     if ($request->has('religion')) {
    //         $formFields['religion'] = $request->religion;
    //     }
    //     if ($request->has('maritial_status')) {
    //         $formFields['maritial_status'] = $request->maritial_status;
    //     }
    //     if ($request->has('occupation')) {
    //         $formFields['occupation'] = $request->occupation;
    //     }

    //     $data->name = $request->name;
    //     $data->mobile = $request->mobile;
    //     $data->address = $request->address;
    //     $data->photo = $formFields['photo'];
    //     $data->age = $request->age;
    //     $data->gender = $request->gender;
    //     $data->nationality = $request->nationality;
    //     $data->educational_level = $request->educational_level;
    //     $data->language = $request->language;
    //     $data->religion = $request->religion;
    //     $data->maritial_status = $request->maritial_status;
    //     $data->occupation = $request->occupation;
    //     $data->updated_at = now();

    //     $data->save();

    //     return Redirect::route('user.profile.view')->with('success', 'Profile Updated');
    // }

    private function determineClusterGroup(User $user)
    {
        $defaultClusterCenters = [
            // Bangladesh
            [25, crc32('Male'), crc32('Bangladeshi'), crc32('BSc'), crc32('Bangla'), crc32('Islam'), crc32('Single'), crc32('Engineer')],
            [30, crc32('Female'), crc32('Bangladeshi'), crc32('MSc'), crc32('Bangla'), crc32('Hindu'), crc32('Married'), crc32('Teacher')],
            [35, crc32('Male'), crc32('Bangladeshi'), crc32('PhD'), crc32('Bangla'), crc32('Buddhist'), crc32('Single'), crc32('Scientist')],
            // India
            [50, crc32('Female'), crc32('Indian'), crc32('BSc'), crc32('Hindi'), crc32('Hindu'), crc32('Single'), crc32('Lawyer')],
            [55, crc32('Male'), crc32('Indian'), crc32('MSc'), crc32('English'), crc32('Islam'), crc32('Married'), crc32('Engineer')],
            [60, crc32('Female'), crc32('Indian'), crc32('PhD'), crc32('Bengali'), crc32('Christian'), crc32('Widowed'), crc32('Teacher')],
            // Pakistan
            [65, crc32('Male'), crc32('Pakistani'), crc32('BSc'), crc32('Urdu'), crc32('Islam'), crc32('Single'), crc32('Scientist')],
            [70, crc32('Female'), crc32('Pakistani'), crc32('MSc'), crc32('Punjabi'), crc32('Muslim'), crc32('Widowed'), crc32('Nurse')],
            // England
            [80, crc32('Female'), crc32('English'), crc32('BSc'), crc32('English'), crc32('Christian'), crc32('Single'), crc32('Lawyer')],
            [85, crc32('Male'), crc32('English'), crc32('MSc'), crc32('English'), crc32('Christian'), crc32('Divorced'), crc32('Doctor')],
            // USA
            [95, crc32('Male'), crc32('American'), crc32('BSc'), crc32('English'), crc32('Christian'), crc32('Single'), crc32('Engineer')],
            [100, crc32('Female'), crc32('American'), crc32('MSc'), crc32('Spanish'), crc32('Christian'), crc32('Married'), crc32('Teacher')],
            // China
            [110, crc32('Female'), crc32('Chinese'), crc32('BSc'), crc32('Chinese'), crc32('Buddhist'), crc32('Single'), crc32('Engineer')],
            [115, crc32('Male'), crc32('Chinese'), crc32('MSc'), crc32('Mandarin'), crc32('Atheist'), crc32('Married'), crc32('Doctor')],
            [120, crc32('Female'), crc32('Chinese'), crc32('PhD'), crc32('Cantonese'), crc32('Buddhist'), crc32('Divorced'), crc32('Teacher')],
        ];

        // Convert user's categorical data using crc32
        $userSample = [
            (float) $user->age,
            (float) crc32($user->gender),
            (float) crc32($user->nationality),
            (float) crc32($user->educational_level),
            (float) crc32($user->language),
            (float) crc32($user->religion),
            (float) crc32($user->maritial_status),
            (float) crc32($user->occupation)
        ];

        // Find the closest cluster
        $weights = [
            'age' => 0.5,         // Assigning more weight to age
            'gender' => 1.0,      // Assigning moderate weight to gender
            'nationality' => 0.1, // Lower weight to nationality
            'educational_level' => 0.2, // Higher importance for education
            'language' => 0.1,    // Lesser weight for language
            'religion' => 0.6,    // Less weight for religion
            'marital_status' => 0.9, // Moderate weight for marital status
            'occupation' => 0.3   // Assigning more importance to occupation
        ];

        $closestClusterIndex = $this->findClosestWeightedCluster($userSample, $defaultClusterCenters, $weights);
        return $closestClusterIndex;
    }

    private function findClosestWeightedCluster(array $userSample, array $clusterCenters, array $weights)
    {
        $closestClusterIndex = 0;
        $closestDistance = PHP_FLOAT_MAX;
        //dd($clusterCenters);
        //$tem = [];
        foreach ($clusterCenters as $index => $center) {
            $distance = $this->weightedEuclideanDistance($userSample, $center, $weights);
            $tem[] = $distance;
            if ($distance < $closestDistance) {
                $closestDistance = $distance;
                $closestClusterIndex = $index;
            }
        }
        //dd($tem);
        return $closestClusterIndex + 1;
    }

    private function weightedEuclideanDistance(array $point1, array $point2, array $weights)
    {
        $sum = 0;
        $keys = ['age', 'gender', 'nationality', 'educational_level', 'language', 'religion', 'marital_status', 'occupation'];
        for ($i = 0; $i < count($point1); $i++) {
            $weight = $weights[$keys[$i]] ?? 1; // Default weight of 1 if not specified
            $sum += pow($point1[$i] - $point2[$i], 2);
        }

        return sqrt($sum);
    }

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

        // Clustering logic
        $clusterGroupNumber = $this->determineClusterGroup($data);

        // Insert into cluster table
        \DB::table('clusters')->updateOrInsert(
            ['user_id' => $data->id],
            ['cluster' => $clusterGroupNumber, 'updated_at' => now()]
        );

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
