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
use App\Models\MovieCast;
use Illuminate\View\View;
use App\Models\MovieGenre;
use App\Models\InterestCast;
use Illuminate\Http\Request;
use App\Models\InterestGenre;
use App\Models\MovieDirector;
use App\Models\MovieLanguage;
use App\Models\InterestRating;
use App\Models\InterestCountry;
use App\Models\InterestDirector;
use App\Models\InterestLanguage;
use App\Models\InterestPcompany;
use App\Models\MovieCountry;
use App\Models\MoviePcompany;
use App\Models\ProductionCompany;
use Illuminate\Support\Facades\Auth;

class RecommendationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Starting clock time in seconds 
        $start_time = microtime(true);
        //
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
            $InterestCountrydata = InterestCountry::all()->where('interest_id', '=', $id);
        }
        // Genre Weight & Prediction
        $genreId = [];
        foreach ($InterestGenredata as $genreData) { //change here
            $genreId[] = $genreData->genre_id; //change here
        }
        $genrePredict = $this->genrePredict($genreId);
        //
        // Language Weight & Prediction
        $languageId = [];
        foreach ($InterestLanguagedata as $genreData) { //change here
            $languageId[] = $genreData->language_id; //change here
        }
        $languagePredict = $this->languagePredict($languageId);
        // Cast Weight & Prediction
        $castId = [];
        foreach ($InterestCastdata as $genreData) { //change here
            $castId[] = $genreData->cast_id; //change here
        }
        $castPredict = $this->castPredict($castId);
        // Director Weight & Prediction
        $directorId = [];
        foreach ($InterestDirectordata as $genreData) { //change here
            $directorId[] = $genreData->director_id; //change here
        }
        $directorPredict = $this->directorPredict($directorId);
        // Country Weight & Prediction
        $countryId = [];
        foreach ($InterestCountrydata as $genreData) { //change here
            $countryId[] = $genreData->country_id; //change here
        }
        $countryPredict = $this->countryPredict($countryId);
        //
        // Prduction Company Weight & Prediction
        $pcompanyId = [];
        foreach ($InterestPcompanydata as $genreData) { //change here
            $pcompanyId[] = $genreData->pcompany_id; //change here
        }
        $pcompanyPredict = $this->pcompanyPredict($pcompanyId);
        //
        // Weight Merge 
        $calculation = $this->calculation($languagePredict, $genrePredict, $castPredict, $directorPredict, $countryPredict, $pcompanyPredict);
        //Sorting Weight
        asort($calculation);
        // End clock time in seconds 
        $end_time = microtime(true);
        // Calculate script execution time 
        $execution_time = ($end_time - $start_time);
        // dd($calculation, $languagePredict, $genrePredict, $castPredict, $directorPredict, $countryPredict, $pcompanyPredict);
        //Sending Data To Front
        $RecomendedMovies = [];
        $i = 1;
        $totalMovies = 10; // Set Value of movies to show here
        foreach ($calculation as $key => $MoviE) {
            $movieData = Movie::all()->where('id', $key)->first();
            $RecomendedMovies[] = $movieData;
            if ($i >= $totalMovies) {
                break;
            }
            $i += 1;
        }
        shuffle($RecomendedMovies);
        return view('pages.recom', ['calculation' => $calculation, 'data' => $RecomendedMovies, 'time' => $execution_time]);
    }
    //Genre
    public function genrePredict(array $genreId)
    {
        //User Genres Sorted
        $genreUserMD = array_values($genreId);
        //All Movies
        $data = Movie::all();
        //KNN Selection Array
        $selectedMovie = [];
        // Check Match
        foreach ($data as $key => $movie) {
            $weight = 0;
            //reseting the value
            $genreM = MovieGenre::all()->where('movie_id', $movie->id);
            $genreUser = $genreUserMD;
            //Normalizing key
            $genreMovie = [];
            foreach ($genreM as $movieGenre) {
                $genreMovie[] = $movieGenre->genre_id;
            }

            array_values($genreMovie);
            $matchDiff = array_diff($genreUser, $genreMovie);
            $matchDiff2 = array_diff($genreMovie, $genreUser);
            if (empty($matchDiff) && empty($matchDiff2)) {
                $selectedMovie['movie' . $key] = $movie->id . '@' . '0';
            } else {
                // dd($genreMovie, $genreUser, $movie->id);
                //Remove matched values
                foreach ($genreUser as $genreData) {
                    $valueToRemove = $genreData;
                    while (($keyOfUser = array_search($valueToRemove, $genreMovie)) !== false) {
                        unset($genreMovie[$keyOfUser]);
                        $keyOfUserRemove = array_search($valueToRemove, $genreUser);
                        unset($genreUser[$keyOfUserRemove]);
                    }
                }
                //

                if (count($genreUser) == 0 && count($genreMovie) != 0) {
                    // // Movie to User Distance
                    // //Euclidean distance of values
                    // $nWeight = 0;
                    // foreach ($genreMovie as $genreData) {
                    //     $nWeight = $nWeight + ($genreData * $genreData);
                    // }
                    // $weight = sqrt($nWeight);
                    // $selectedMovie['movie' . $key] = $movie->id . '@' . $weight;
                    $selectedMovie['movie' . $key] = $movie->id . '@0';
                } elseif (count($genreMovie) == 0 && count($genreUser) != 0) {

                    //Euclidean distance of values
                    $nWeight = 0;
                    foreach ($genreUser as $genreData) {
                        $nWeight = $nWeight + ($genreData * $genreData);
                    }
                    $weight = sqrt($nWeight);
                    $selectedMovie['movie' . $key] = $movie->id . '@' . $weight;
                } elseif (count($genreMovie) != 0 && count($genreUser) != 0) {
                    //Normalizing Movie Genre Values
                    $genreMovieD = [];
                    foreach ($genreMovie as $movieGenre) {
                        $genreMovieD[] = $movieGenre;
                    }
                    array_values($genreMovieD);
                    //Normalizing User Genre Values
                    $genreUserD = [];
                    foreach ($genreUser as $movieGenre) {
                        $genreUserD[] = $movieGenre;
                    }
                    array_values($genreUserD);
                    //
                    //counter 
                    $counterUser = count($genreUser);
                    $counterMovie = count($genreMovie);

                    if ($counterUser == $counterMovie) {
                        $nWeight = 0;
                        for ($i = 0; $i < $counterUser; $i++) {
                            //Euclidean distance of values
                            $nWeight = $nWeight + ($genreUserD[$i] - $genreMovieD[$i]) * ($genreUserD[$i] - $genreMovieD[$i]);
                        }
                        $weight = sqrt($nWeight);
                        $selectedMovie['movie' . $key] = $movie->id . '@' . $weight;
                    } elseif ($counterMovie > $counterUser) {

                        $nWeight = 0;
                        for ($i = 0; $i < $counterUser; $i++) {
                            //Euclidean distance of values
                            $nWeight = $nWeight + ($genreUserD[$i] - $genreMovieD[$i]) * ($genreUserD[$i] - $genreMovieD[$i]);
                            unset($genreUserD[$i]);
                            unset($genreMovieD[$i]);
                        }
                        foreach ($genreUserD as $genreUserData) {
                            $nWeight = $nWeight + $genreUserData * $genreUserData;
                        }
                        $weight = sqrt($nWeight);
                        $selectedMovie['movie' . $key] = $movie->id . '@' . $weight;
                    } elseif ($counterUser > $counterMovie) {

                        $nWeight = 0;
                        for ($i = 0; $i < $counterMovie; $i++) {
                            //Euclidean distance of values
                            $nWeight = $nWeight + ($genreUserD[$i] - $genreMovieD[$i]) * ($genreUserD[$i] - $genreMovieD[$i]);
                            unset($genreUserD[$i]);
                            unset($genreMovieD[$i]);
                        }
                        foreach ($genreUserD as $genreUserData) {
                            $nWeight = $nWeight + $genreUserData * $genreUserData;
                        }

                        $weight = sqrt($nWeight);
                        $selectedMovie['movie' . $key] = $movie->id . '@' . $weight;
                    }
                }
            }
        }
        return $selectedMovie;
    }
    //Language
    public function languagePredict(array $languageId)
    {
        //User Genres Sorted
        $genreUserMD = array_values($languageId);
        //All Movies
        $data = Movie::all();
        //KNN Selection Array
        $selectedMovie = [];
        // Check Match
        foreach ($data as $key => $movie) {
            $weight = 0;
            //reseting the value
            $genreM = MovieLanguage::all()->where('movie_id', $movie->id); // change here
            $genreUser = $genreUserMD;
            //Normalizing key
            $genreMovie = [];
            foreach ($genreM as $movieGenre) {
                $genreMovie[] = $movieGenre->language_id; // change here
            }
            array_values($genreMovie);
            //
            $matchDiff = array_diff($genreUser, $genreMovie);
            $matchDiff2 = array_diff($genreMovie, $genreUser);
            if (empty($matchDiff) && empty($matchDiff2)) {
                $selectedMovie['movie' . $key] = $movie->id . '@' . '0';
            } else {
                // dd($genreMovie, $genreUser, $movie->id);
                //Remove matched values
                foreach ($genreUser as $genreData) {
                    $valueToRemove = $genreData;
                    while (($keyOfUser = array_search($valueToRemove, $genreMovie)) !== false) {
                        unset($genreMovie[$keyOfUser]);
                        $keyOfUserRemove = array_search($valueToRemove, $genreUser);
                        unset($genreUser[$keyOfUserRemove]);
                    }
                }
                //


                if (count($genreUser) == 0 && count($genreMovie) != 0) {
                    $selectedMovie['movie' . $key] = $movie->id . '@0';
                } elseif (count($genreMovie) == 0 && count($genreUser) != 0) {

                    //Euclidean distance of values
                    $nWeight = 0;
                    foreach ($genreUser as $genreData) {
                        $nWeight = $nWeight + ($genreData * $genreData);
                    }
                    $weight = sqrt($nWeight);
                    $selectedMovie['movie' . $key] = $movie->id . '@' . $weight;
                } elseif (count($genreMovie) != 0 && count($genreUser) != 0) {
                    //Normalizing Movie Genre Values
                    $genreMovieD = [];
                    foreach ($genreMovie as $movieGenre) {
                        $genreMovieD[] = $movieGenre;
                    }
                    array_values($genreMovieD);
                    //Normalizing User Genre Values
                    $genreUserD = [];
                    foreach ($genreUser as $movieGenre) {
                        $genreUserD[] = $movieGenre;
                    }
                    array_values($genreUserD);
                    //
                    //counter 
                    $counterUser = count($genreUser);
                    $counterMovie = count($genreMovie);

                    if ($counterUser == $counterMovie) {
                        $nWeight = 0;
                        for ($i = 0; $i < $counterUser; $i++) {
                            //Get Language
                            $lang1 = Language::all()->where('id', $genreUserD[$i])->first();
                            $lang2 = Language::all()->where('id', $genreMovieD[$i])->first();
                            $distanceR = $this->displayAdjacencyMatrix($lang1->title, $lang2->title);
                            //
                            //Euclidean distance of values
                            $nWeight = $nWeight + ($distanceR * $distanceR);
                        }
                        $weight = sqrt($nWeight);
                        $selectedMovie['movie' . $key] = $movie->id . '@' . $weight;
                    } elseif ($counterMovie > $counterUser) {

                        $nWeight = 0;
                        for ($i = 0; $i < $counterUser; $i++) {
                            //Get Language
                            $lang1 = Language::all()->where('id', $genreUserD[$i])->first();
                            $lang2 = Language::all()->where('id', $genreMovieD[$i])->first();
                            $distanceR = $this->displayAdjacencyMatrix($lang1->title, $lang2->title);
                            //
                            //Euclidean distance of values
                            $nWeight = $nWeight + ($distanceR * $distanceR);
                            unset($genreUserD[$i]);
                            unset($genreMovieD[$i]);
                        }
                        foreach ($genreUserD as $genreUserData) {
                            $nWeight = $nWeight + $genreUserData * $genreUserData;
                        }
                        $weight = sqrt($nWeight);
                        $selectedMovie['movie' . $key] = $movie->id . '@' . $weight;
                    } elseif ($counterUser > $counterMovie) {

                        $nWeight = 0;
                        for ($i = 0; $i < $counterMovie; $i++) {
                            //Get Language
                            $lang1 = Language::all()->where('id', $genreUserD[$i])->first();
                            $lang2 = Language::all()->where('id', $genreMovieD[$i])->first();
                            $distanceR = $this->displayAdjacencyMatrix($lang1->title, $lang2->title);
                            //
                            //Euclidean distance of values
                            $nWeight = $nWeight + ($distanceR * $distanceR);
                            unset($genreUserD[$i]);
                            unset($genreMovieD[$i]);
                        }
                        foreach ($genreUserD as $genreUserData) {
                            $nWeight = $nWeight + $genreUserData * $genreUserData;
                        }

                        $weight = sqrt($nWeight);
                        $selectedMovie['movie' . $key] = $movie->id . '@' . $weight;
                    }
                }
            }
        }
        return $selectedMovie;
    }
    //Cast
    public function castPredict(array $castId)
    {
        //User Genres Sorted
        $genreUserMD = array_values($castId);
        //All Movies
        $data = Movie::all();
        //KNN Selection Array
        $selectedMovie = [];
        // Check Match
        foreach ($data as $key => $movie) {
            $weight = 0;
            //reseting the value
            $genreM = MovieCast::all()->where('movie_id', $movie->id); // change here
            $genreUser = $genreUserMD;
            //Normalizing key
            $genreMovie = [];
            foreach ($genreM as $movieGenre) {
                $genreMovie[] = $movieGenre->cast_id; // change here
            }
            array_values($genreMovie);
            //
            $matchDiff = array_diff($genreUser, $genreMovie);
            $matchDiff2 = array_diff($genreMovie, $genreUser);
            if (empty($matchDiff) && empty($matchDiff2)) {
                $selectedMovie['movie' . $key] = $movie->id . '@' . '0';
            } else {
                // dd($genreMovie, $genreUser, $movie->id);
                //Remove matched values
                foreach ($genreUser as $genreData) {
                    $valueToRemove = $genreData;
                    while (($keyOfUser = array_search($valueToRemove, $genreMovie)) !== false) {
                        unset($genreMovie[$keyOfUser]);
                        $keyOfUserRemove = array_search($valueToRemove, $genreUser);
                        unset($genreUser[$keyOfUserRemove]);
                    }
                }
                //


                if (count($genreUser) == 0 && count($genreMovie) != 0) {
                    $selectedMovie['movie' . $key] = $movie->id . '@0';
                } elseif (count($genreMovie) == 0 && count($genreUser) != 0) {

                    //Euclidean distance of values
                    $nWeight = 0;
                    foreach ($genreUser as $genreData) {
                        $nWeight = $nWeight + ($genreData * $genreData);
                    }
                    $weight = sqrt($nWeight);
                    $selectedMovie['movie' . $key] = $movie->id . '@' . $weight;
                } elseif (count($genreMovie) != 0 && count($genreUser) != 0) {
                    //Normalizing Movie Genre Values
                    $genreMovieD = [];
                    foreach ($genreMovie as $movieGenre) {
                        $genreMovieD[] = $movieGenre;
                    }
                    array_values($genreMovieD);
                    //Normalizing User Genre Values
                    $genreUserD = [];
                    foreach ($genreUser as $movieGenre) {
                        $genreUserD[] = $movieGenre;
                    }
                    array_values($genreUserD);
                    //
                    //counter 
                    $counterUser = count($genreUser);
                    $counterMovie = count($genreMovie);

                    if ($counterUser == $counterMovie) {
                        $nWeight = 0;
                        for ($i = 0; $i < $counterUser; $i++) {
                            //Euclidean distance of values
                            $nWeight = $nWeight + ($genreUserD[$i] - $genreMovieD[$i]) * ($genreUserD[$i] - $genreMovieD[$i]);
                        }
                        $weight = sqrt($nWeight);
                        $selectedMovie['movie' . $key] = $movie->id . '@' . $weight;
                    } elseif ($counterMovie > $counterUser) {

                        $nWeight = 0;
                        for ($i = 0; $i < $counterUser; $i++) {
                            //Euclidean distance of values
                            $nWeight = $nWeight + ($genreUserD[$i] - $genreMovieD[$i]) * ($genreUserD[$i] - $genreMovieD[$i]);
                            unset($genreUserD[$i]);
                            unset($genreMovieD[$i]);
                        }
                        foreach ($genreUserD as $genreUserData) {
                            $nWeight = $nWeight + $genreUserData * $genreUserData;
                        }
                        $weight = sqrt($nWeight);
                        $selectedMovie['movie' . $key] = $movie->id . '@' . $weight;
                    } elseif ($counterUser > $counterMovie) {

                        $nWeight = 0;
                        for ($i = 0; $i < $counterMovie; $i++) {
                            //Euclidean distance of values
                            $nWeight = $nWeight + ($genreUserD[$i] - $genreMovieD[$i]) * ($genreUserD[$i] - $genreMovieD[$i]);
                            unset($genreUserD[$i]);
                            unset($genreMovieD[$i]);
                        }
                        foreach ($genreUserD as $genreUserData) {
                            $nWeight = $nWeight + $genreUserData * $genreUserData;
                        }

                        $weight = sqrt($nWeight);
                        $selectedMovie['movie' . $key] = $movie->id . '@' . $weight;
                    }
                }
            }
        }
        return $selectedMovie;
    }
    //Director
    public function directorPredict(array $directorId)
    {
        //User Genres Sorted
        $genreUserMD = array_values($directorId);
        //All Movies
        $data = Movie::all();
        //KNN Selection Array
        $selectedMovie = [];
        // Check Match
        foreach ($data as $key => $movie) {
            $weight = 0;
            //reseting the value
            $genreM = MovieDirector::all()->where('movie_id', $movie->id); // change here
            $genreUser = $genreUserMD;
            //Normalizing key
            $genreMovie = [];
            foreach ($genreM as $movieGenre) {
                $genreMovie[] = $movieGenre->director_id; // change here
            }
            array_values($genreMovie);
            //
            $matchDiff = array_diff($genreUser, $genreMovie);
            $matchDiff2 = array_diff($genreMovie, $genreUser);
            if (empty($matchDiff) && empty($matchDiff2)) {
                $selectedMovie['movie' . $key] = $movie->id . '@' . '0';
            } else {
                // dd($genreMovie, $genreUser, $movie->id);
                //Remove matched values
                foreach ($genreUser as $genreData) {
                    $valueToRemove = $genreData;
                    while (($keyOfUser = array_search($valueToRemove, $genreMovie)) !== false) {
                        unset($genreMovie[$keyOfUser]);
                        $keyOfUserRemove = array_search($valueToRemove, $genreUser);
                        unset($genreUser[$keyOfUserRemove]);
                    }
                }
                //


                if (count($genreUser) == 0 && count($genreMovie) != 0) {
                    $selectedMovie['movie' . $key] = $movie->id . '@0';
                } elseif (count($genreMovie) == 0 && count($genreUser) != 0) {

                    //Euclidean distance of values
                    $nWeight = 0;
                    foreach ($genreUser as $genreData) {
                        $nWeight = $nWeight + ($genreData * $genreData);
                    }
                    $weight = sqrt($nWeight);
                    $selectedMovie['movie' . $key] = $movie->id . '@' . $weight;
                } elseif (count($genreMovie) != 0 && count($genreUser) != 0) {
                    //Normalizing Movie Genre Values
                    $genreMovieD = [];
                    foreach ($genreMovie as $movieGenre) {
                        $genreMovieD[] = $movieGenre;
                    }
                    array_values($genreMovieD);
                    //Normalizing User Genre Values
                    $genreUserD = [];
                    foreach ($genreUser as $movieGenre) {
                        $genreUserD[] = $movieGenre;
                    }
                    array_values($genreUserD);
                    //
                    //counter 
                    $counterUser = count($genreUser);
                    $counterMovie = count($genreMovie);

                    if ($counterUser == $counterMovie) {
                        $nWeight = 0;
                        for ($i = 0; $i < $counterUser; $i++) {
                            //Euclidean distance of values
                            $nWeight = $nWeight + ($genreUserD[$i] - $genreMovieD[$i]) * ($genreUserD[$i] - $genreMovieD[$i]);
                        }
                        $weight = sqrt($nWeight);
                        $selectedMovie['movie' . $key] = $movie->id . '@' . $weight;
                    } elseif ($counterMovie > $counterUser) {

                        $nWeight = 0;
                        for ($i = 0; $i < $counterUser; $i++) {
                            //Euclidean distance of values
                            $nWeight = $nWeight + ($genreUserD[$i] - $genreMovieD[$i]) * ($genreUserD[$i] - $genreMovieD[$i]);
                            unset($genreUserD[$i]);
                            unset($genreMovieD[$i]);
                        }
                        foreach ($genreUserD as $genreUserData) {
                            $nWeight = $nWeight + $genreUserData * $genreUserData;
                        }
                        $weight = sqrt($nWeight);
                        $selectedMovie['movie' . $key] = $movie->id . '@' . $weight;
                    } elseif ($counterUser > $counterMovie) {

                        $nWeight = 0;
                        for ($i = 0; $i < $counterMovie; $i++) {
                            //Euclidean distance of values
                            $nWeight = $nWeight + ($genreUserD[$i] - $genreMovieD[$i]) * ($genreUserD[$i] - $genreMovieD[$i]);
                            unset($genreUserD[$i]);
                            unset($genreMovieD[$i]);
                        }
                        foreach ($genreUserD as $genreUserData) {
                            $nWeight = $nWeight + $genreUserData * $genreUserData;
                        }

                        $weight = sqrt($nWeight);
                        $selectedMovie['movie' . $key] = $movie->id . '@' . $weight;
                    }
                }
            }
        }
        return $selectedMovie;
    }
    //Country
    public function countryPredict(array $countryId)
    {
        //User Genres Sorted
        $genreUserMD = array_values($countryId);
        //All Movies
        $data = Movie::all();
        //KNN Selection Array
        $selectedMovie = [];
        // Check Match
        foreach ($data as $key => $movie) {
            $weight = 0;
            //reseting the value
            $genreM = MovieCountry::all()->where('movie_id', $movie->id); // change here
            $genreUser = $genreUserMD;
            //Normalizing key
            $genreMovie = [];
            foreach ($genreM as $movieGenre) {
                $genreMovie[] = $movieGenre->country_id; // change here
            }
            array_values($genreMovie);
            //
            $matchDiff = array_diff($genreUser, $genreMovie);
            $matchDiff2 = array_diff($genreMovie, $genreUser);
            if (empty($matchDiff) && empty($matchDiff2)) {
                $selectedMovie['movie' . $key] = $movie->id . '@' . '0';
            } else {
                // dd($genreMovie, $genreUser, $movie->id);
                //Remove matched values
                foreach ($genreUser as $genreData) {
                    $valueToRemove = $genreData;
                    while (($keyOfUser = array_search($valueToRemove, $genreMovie)) !== false) {
                        unset($genreMovie[$keyOfUser]);
                        $keyOfUserRemove = array_search($valueToRemove, $genreUser);
                        unset($genreUser[$keyOfUserRemove]);
                    }
                }
                //


                if (count($genreUser) == 0 && count($genreMovie) != 0) {
                    $selectedMovie['movie' . $key] = $movie->id . '@0';
                } elseif (count($genreMovie) == 0 && count($genreUser) != 0) {

                    //Euclidean distance of values
                    $nWeight = 0;
                    foreach ($genreUser as $genreData) {
                        $nWeight = $nWeight + ($genreData * $genreData);
                    }
                    $weight = sqrt($nWeight);
                    $selectedMovie['movie' . $key] = $movie->id . '@' . $weight;
                } elseif (count($genreMovie) != 0 && count($genreUser) != 0) {
                    //Normalizing Movie Genre Values
                    $genreMovieD = [];
                    foreach ($genreMovie as $movieGenre) {
                        $genreMovieD[] = $movieGenre;
                    }
                    array_values($genreMovieD);
                    //Normalizing User Genre Values
                    $genreUserD = [];
                    foreach ($genreUser as $movieGenre) {
                        $genreUserD[] = $movieGenre;
                    }
                    array_values($genreUserD);
                    //
                    //counter 
                    $counterUser = count($genreUser);
                    $counterMovie = count($genreMovie);

                    if ($counterUser == $counterMovie) {
                        $nWeight = 0;
                        for ($i = 0; $i < $counterUser; $i++) {
                            //Euclidean distance of values
                            $nWeight = $nWeight + ($genreUserD[$i] - $genreMovieD[$i]) * ($genreUserD[$i] - $genreMovieD[$i]);
                        }
                        $weight = sqrt($nWeight);
                        $selectedMovie['movie' . $key] = $movie->id . '@' . $weight;
                    } elseif ($counterMovie > $counterUser) {

                        $nWeight = 0;
                        for ($i = 0; $i < $counterUser; $i++) {
                            //Euclidean distance of values
                            $nWeight = $nWeight + ($genreUserD[$i] - $genreMovieD[$i]) * ($genreUserD[$i] - $genreMovieD[$i]);
                            unset($genreUserD[$i]);
                            unset($genreMovieD[$i]);
                        }
                        foreach ($genreUserD as $genreUserData) {
                            $nWeight = $nWeight + $genreUserData * $genreUserData;
                        }
                        $weight = sqrt($nWeight);
                        $selectedMovie['movie' . $key] = $movie->id . '@' . $weight;
                    } elseif ($counterUser > $counterMovie) {

                        $nWeight = 0;
                        for ($i = 0; $i < $counterMovie; $i++) {
                            //Euclidean distance of values
                            $nWeight = $nWeight + ($genreUserD[$i] - $genreMovieD[$i]) * ($genreUserD[$i] - $genreMovieD[$i]);
                            unset($genreUserD[$i]);
                            unset($genreMovieD[$i]);
                        }
                        foreach ($genreUserD as $genreUserData) {
                            $nWeight = $nWeight + $genreUserData * $genreUserData;
                        }

                        $weight = sqrt($nWeight);
                        $selectedMovie['movie' . $key] = $movie->id . '@' . $weight;
                    }
                }
            }
        }
        return $selectedMovie;
    }
    //Production Company
    public function pcompanyPredict(array $pcompanyId)
    {
        //User Genres Sorted
        $genreUserMD = array_values($pcompanyId);
        //All Movies
        $data = Movie::all();
        //KNN Selection Array
        $selectedMovie = [];
        // Check Match
        foreach ($data as $key => $movie) {
            $weight = 0;
            //reseting the value
            $genreM = MoviePcompany::all()->where('movie_id', $movie->id); // change here
            $genreUser = $genreUserMD;
            //Normalizing key
            $genreMovie = [];
            foreach ($genreM as $movieGenre) {
                $genreMovie[] = $movieGenre->pcompany_id; // change here
            }
            array_values($genreMovie);
            //
            $matchDiff = array_diff($genreUser, $genreMovie);
            $matchDiff2 = array_diff($genreMovie, $genreUser);
            if (empty($matchDiff) && empty($matchDiff2)) {
                $selectedMovie['movie' . $key] = $movie->id . '@' . '0';
            } else {
                // dd($genreMovie, $genreUser, $movie->id);
                //Remove matched values
                foreach ($genreUser as $genreData) {
                    $valueToRemove = $genreData;
                    while (($keyOfUser = array_search($valueToRemove, $genreMovie)) !== false) {
                        unset($genreMovie[$keyOfUser]);
                        $keyOfUserRemove = array_search($valueToRemove, $genreUser);
                        unset($genreUser[$keyOfUserRemove]);
                    }
                }
                //


                if (count($genreUser) == 0 && count($genreMovie) != 0) {
                    // // Movie to User Distance
                    // //Euclidean distance of values
                    // $nWeight = 0;
                    // foreach ($genreMovie as $genreData) {
                    //     $nWeight = $nWeight + ($genreData * $genreData);
                    // }
                    // $weight = sqrt($nWeight);
                    // $selectedMovie['movie' . $key] = $movie->id . '@' . $weight;
                    $selectedMovie['movie' . $key] = $movie->id . '@0';
                } elseif (count($genreMovie) == 0 && count($genreUser) != 0) {

                    //Euclidean distance of values
                    $nWeight = 0;
                    foreach ($genreUser as $genreData) {
                        $nWeight = $nWeight + ($genreData * $genreData);
                    }
                    $weight = sqrt($nWeight);
                    $selectedMovie['movie' . $key] = $movie->id . '@' . $weight;
                } elseif (count($genreMovie) != 0 && count($genreUser) != 0) {
                    //Normalizing Movie Genre Values
                    $genreMovieD = [];
                    foreach ($genreMovie as $movieGenre) {
                        $genreMovieD[] = $movieGenre;
                    }
                    array_values($genreMovieD);
                    //Normalizing User Genre Values
                    $genreUserD = [];
                    foreach ($genreUser as $movieGenre) {
                        $genreUserD[] = $movieGenre;
                    }
                    array_values($genreUserD);
                    //
                    //counter 
                    $counterUser = count($genreUser);
                    $counterMovie = count($genreMovie);

                    if ($counterUser == $counterMovie) {
                        $nWeight = 0;
                        for ($i = 0; $i < $counterUser; $i++) {
                            //Euclidean distance of values
                            $nWeight = $nWeight + ($genreUserD[$i] - $genreMovieD[$i]) * ($genreUserD[$i] - $genreMovieD[$i]);
                        }
                        $weight = sqrt($nWeight);
                        $selectedMovie['movie' . $key] = $movie->id . '@' . $weight;
                    } elseif ($counterMovie > $counterUser) {

                        $nWeight = 0;
                        for ($i = 0; $i < $counterUser; $i++) {
                            //Euclidean distance of values
                            $nWeight = $nWeight + ($genreUserD[$i] - $genreMovieD[$i]) * ($genreUserD[$i] - $genreMovieD[$i]);
                            unset($genreUserD[$i]);
                            unset($genreMovieD[$i]);
                        }
                        foreach ($genreUserD as $genreUserData) {
                            $nWeight = $nWeight + $genreUserData * $genreUserData;
                        }
                        $weight = sqrt($nWeight);
                        $selectedMovie['movie' . $key] = $movie->id . '@' . $weight;
                    } elseif ($counterUser > $counterMovie) {

                        $nWeight = 0;
                        for ($i = 0; $i < $counterMovie; $i++) {
                            //Euclidean distance of values
                            $nWeight = $nWeight + ($genreUserD[$i] - $genreMovieD[$i]) * ($genreUserD[$i] - $genreMovieD[$i]);
                            unset($genreUserD[$i]);
                            unset($genreMovieD[$i]);
                        }
                        foreach ($genreUserD as $genreUserData) {
                            $nWeight = $nWeight + $genreUserData * $genreUserData;
                        }

                        $weight = sqrt($nWeight);
                        $selectedMovie['movie' . $key] = $movie->id . '@' . $weight;
                    }
                }
            }
        }
        return $selectedMovie;
    }
    //Calculation
    public function calculation(array $languagePredict, array $genrePredict, array $castPredict, array $directorPredict, array $countryPredict, array $pcompanyPredict)
    {
        $mergeWeight = [];
        //genre
        foreach ($languagePredict as $key => $weight) {
            // Explode Movie and its weight
            $parts = explode("@", $weight);
            foreach ($parts as $keyPart => $part) {
                if ($keyPart == 0) {
                    $movie_id = $part;
                } else {
                    $movie_weight = $part;
                }
            }
            $mergeWeight[$movie_id] = $movie_weight;
        }
        //language
        foreach ($genrePredict as $key => $weight) {
            // Explode Movie and its weight
            $parts = explode("@", $weight);
            foreach ($parts as $keyPart => $part) {
                if ($keyPart == 0) {
                    $movie_id = $part;
                } else {
                    $movie_weight = $part;
                }
            }
            $mergeWeight[$movie_id] = $mergeWeight[$movie_id] + $movie_weight;
        }
        //cast
        foreach ($castPredict as $key => $weight) {
            // Explode Movie and its weight
            $parts = explode("@", $weight);
            foreach ($parts as $keyPart => $part) {
                if ($keyPart == 0) {
                    $movie_id = $part;
                } else {
                    $movie_weight = $part;
                }
            }
            $mergeWeight[$movie_id] = $mergeWeight[$movie_id] + $movie_weight;
        }
        //Director
        foreach ($directorPredict as $key => $weight) {
            // Explode Movie and its weight
            $parts = explode("@", $weight);
            foreach ($parts as $keyPart => $part) {
                if ($keyPart == 0) {
                    $movie_id = $part;
                } else {
                    $movie_weight = $part;
                }
            }
            $mergeWeight[$movie_id] = $mergeWeight[$movie_id] + $movie_weight;
        }
        //Country
        foreach ($countryPredict as $key => $weight) {
            // Explode Movie and its weight
            $parts = explode("@", $weight);
            foreach ($parts as $keyPart => $part) {
                if ($keyPart == 0) {
                    $movie_id = $part;
                } else {
                    $movie_weight = $part;
                }
            }
            $mergeWeight[$movie_id] = $mergeWeight[$movie_id] + $movie_weight;
        }
        //Production company 
        foreach ($pcompanyPredict as $key => $weight) {
            // Explode Movie and its weight
            $parts = explode("@", $weight);
            foreach ($parts as $keyPart => $part) {
                if ($keyPart == 0) {
                    $movie_id = $part;
                } else {
                    $movie_weight = $part;
                }
            }
            $mergeWeight[$movie_id] = $mergeWeight[$movie_id] + $movie_weight;
        }
        // dd($movie_id, $movie_weight);
        return $mergeWeight;
    }
    public function displayAdjacencyMatrix(string $language1, string $language2)
    {
        // Example languages
        $languages = ['English', 'German', 'Swedish', 'Icelandic', 'Italian', 'French', 'Portuguese', 'Spanish', 'Czech', 'Polish', 'Russian', 'Hindi', 'Arabic', 'Chinese', 'Finninsh', 'Indonesian', 'Japanese', 'Korean', 'Thai', 'Turkish'];

        // Example distances between languages (replace these with actual distances)
        $distances = [
            // English, Spanish, French, German, Chinese
            [0, 5.06, 4.28, 7.64, 5.63, 6.20, 5.08, 5.72, 6.10, 6.08, 6.02, 7.41, 6.69, 7.90, 6.26, 5.24, 11.63, 7.21, 8.72, 6.80],  // English
            [5.06, 0, 5.61, 8.15, 6.25, 6.50, 5.91, 6.28, 6.36, 6.51, 6.46, 8.50, 7.42, 8.39, 6.72, 6.36, 12.33, 7.70, 9.23, 7.20],  // German
            [4.28, 5.61, 0, 6.95, 6.74, 7.16, 6.33, 6.70, 5.69, 5.79, 5.79, 7.84, 6.37, 7.93, 5.66, 5.19, 12.26, 6.78, 8.44, 6.32],   // Swedish
            [7.64, 8.15, 6.95, 0, 9.11, 9.24, 8.69, 8.88, 7.32, 7.31, 7.41, 9.37, 7.80, 8.91, 7.10, 7.24, 12.40, 7.65, 9.44, 7.58], // Icelandic
            [5.63, 6.25, 6.74, 9.11, 0, 5.49, 4.61, 5.18, 7.14, 7.08, 7.24, 8.51, 7.76, 9.33, 8.05, 7.01, 11.72, 8.70, 9.67, 7.82], // Italian
            [6.20, 6.50, 7.16, 9.24, 5.49, 0, 5.16, 5.80, 7.78, 7.64, 7.50, 8.67, 8.18, 9.44, 8.55, 7.52, 11.92, 9.11, 9.83, 8.41], //French
            [5.08, 5.91, 6.33, 8.69, 4.61, 5.16, 0, 4.35, 6.99, 6.88, 6.80, 8.11, 7.27, 9.08, 7.84, 6.69, 11.69, 8.42, 9.42, 7.63], //Portuguese
            [5.72, 6.28, 6.70, 8.88, 5.18, 5.80, 4.35, 0, 7.28, 7.03, 7.07, 8.21, 7.27, 9.12, 8.03, 7.04, 11.55, 8.39, 9.37, 7.62], //spanish
            [6.10, 6.36, 5.69, 7.32, 7.14, 7.78, 6.99, 7.28, 0, 4.60, 5.10, 8.41, 6.29, 8.01, 5.49, 5.84, 11.96, 6.88, 8.92, 6.18], //czech
            [6.08, 6.51, 5.79, 7.31, 7.08, 7.64, 6.88, 7.03, 4.60, 0, 4.79, 8.21, 6.07, 8.08, 5.58, 5.66, 11.75, 6.92, 8.80, 6.13], //polish
            [6.02, 6.46, 5.79, 7.41, 7.24, 7.50, 6.80, 7.07, 5.10, 4.79, 0, 8.19, 6.02, 8.02, 5.77, 5.65, 11.74, 7.17, 8.89, 6.40], //russian
            [7.41, 8.50, 7.84, 9.37, 8.51, 8.67, 8.11, 8.21, 8.41, 8.21, 8.19, 0, 7.98, 9.33, 8.85, 8.19, 10.38, 8.96, 9.42, 8.59], //hindi
            [6.69, 7.42, 6.37, 7.80, 7.76, 8.18, 7.27, 7.27, 6.29, 6.07, 6.02, 7.98, 0, 8.44, 6.92, 6.20, 11.19, 7.58, 8.93, 6.69], //arabic
            [7.90, 8.39, 7.93, 8.91, 9.33, 9.44, 9.08, 9.12, 8.01, 8.08, 8.02, 9.33, 8.44, 0, 7.83, 7.69, 11.36, 7.21, 9.13, 8.12], //chinese
            [6.26, 6.72, 5.66, 7.10, 8.05, 8.55, 7.84, 8.03, 5.49, 5.58, 5.77, 8.85, 6.92, 7.83, 0, 5.59, 12.65, 6.13, 8.89, 5.64], //finnish
            [5.24, 6.36, 5.19, 7.24, 7.01, 7.52, 6.69, 7.04, 5.84, 5.66, 5.65, 8.19, 6.20, 7.69, 5.59, 0, 11.77, 6.75, 8.39, 6.03], //indonesian
            [11.63, 12.33, 12.26, 12.40, 11.72, 11.92, 11.69, 11.55, 11.96, 11.75, 11.74, 10.38, 11.19, 11.36, 12.65, 11.77, 0, 11.52, 12.07, 11.90], //japanese
            [7.21, 7.70, 6.78, 7.65, 8.70, 9.11, 8.42, 8.39, 6.88, 6.92, 7.17, 8.96, 7.58, 7.21, 6.13, 6.75, 11.52, 0, 8.45, 6.25], //korean
            [8.72, 9.23, 8.44, 9.44, 9.67, 9.83, 9.42, 9.37, 8.92, 8.80, 8.89, 9.42, 8.93, 9.13, 8.89, 8.39, 12.07, 8.45, 0, 8.82], //thai
            [6.80, 7.20, 6.32, 7.58, 7.82, 8.41, 7.63, 7.62, 6.18, 6.13, 6.40, 8.59, 6.69, 8.12, 5.64, 6.03, 11.90, 6.25, 8.82, 0] //turkiah

        ];
        $numLanguages = count($languages);

        // Display column headers
        // echo "   ";
        for ($i = 0; $i < $numLanguages; $i++) {
            // echo str_pad($languages[$i], 10);
        }
        // echo "<br>";

        // Display matrix
        for ($i = 0; $i < $numLanguages; $i++) {
            // echo $languages[$i] . ' ';
            for ($j = 0; $j < $numLanguages; $j++) {
                // echo str_pad($distances[$i][$j], 10);
            }
        }
        $keyOfLang1 = array_search($language1, $languages);
        $keyOfLang2 = array_search($language2, $languages);
        return $distances[$keyOfLang1][$keyOfLang2];
    }
}
