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
use Phpml\Clustering\KMeans;

class RecommendationController3 extends Controller
{
    /**
     * Display a listing of the resource.
     */


    // public function data2DArrayAll()
    // {
    //     $mData = Movie::all();
    //     $uData = MovieCountry::all();
    //     $vData = MoviePcompany::all();
    //     $wData = MovieDirector::all();
    //     $xData = MovieLanguage::all();
    //     $yData = MovieGenre::all();
    //     $zData = MovieCast::all();
    //     $resultArray = [];
    //     foreach ($mData as $mItem) {
    //         foreach ($uData as $uItem) {
    //             if ($uItem->movie_id == $mItem->id) {
    //                 foreach ($vData as $vItem) {
    //                     if ($vItem->movie_id == $mItem->id) {
    //                         foreach ($wData as $wItem) {
    //                             if ($wItem->movie_id == $mItem->id) {
    //                                 foreach ($xData as $xItem) {
    //                                     if ($xItem->movie_id == $mItem->id) {
    //                                         foreach ($yData as $yItem) {
    //                                             if ($yItem->movie_id == $mItem->id) {
    //                                                 foreach ($zData as $zItem) {
    //                                                     if ($zItem->movie_id == $mItem->id) {
    //                                                         $resultArray[] = [
    //                                                             0 => $mItem->id,
    //                                                             1 => $uItem->country_id,
    //                                                             2 => $vItem->pcompany_id,
    //                                                             3 => $wItem->director_id,
    //                                                             4 => $xItem->language_id,
    //                                                             5 => $yItem->genre_id,
    //                                                             6 => $zItem->cast_id,
    //                                                         ];
    //                                                     }
    //                                                 }
    //                                             }
    //                                         }
    //                                     }
    //                                 }
    //                             }
    //                         }
    //                     }
    //                 }
    //             }
    //         }
    //     }
    //     //User Array
    //     $user = Auth::user();
    //     $data = Interest::all()->where('user_id', '=', $user->id)->first();
    //     $id = $data->id;
    //     //IF any interest Added
    //     // $resultArray2 = [];
    //     //IF any interest Added
    //     $data = Interest::find($id);
    //     $InterestGenredata = InterestGenre::all()->where('interest_id', '=', $id);
    //     $InterestCastdata = InterestCast::all()->where('interest_id', '=', $id);
    //     $InterestDirectordata = InterestDirector::all()->where('interest_id', '=', $id);
    //     $InterestLanguagedata = InterestLanguage::all()->where('interest_id', '=', $id);
    //     $InterestPcompanydata = InterestPcompany::all()->where('interest_id', '=', $id);
    //     $InterestCountrydata = InterestCountry::all()->where('interest_id', '=', $id);
    //     foreach ($InterestCountrydata as $uItem) {
    //         foreach ($InterestPcompanydata as $vItem) {
    //             foreach ($InterestDirectordata as $wItem) {
    //                 foreach ($InterestLanguagedata as $xItem) {
    //                     foreach ($InterestGenredata as $yItem) {
    //                         foreach ($InterestCastdata as $zItem) {
    //                             $resultArray[] = [
    //                                 0 => '-1',
    //                                 1 => $uItem->country_id,
    //                                 2 => $vItem->pcompany_id,
    //                                 3 => $wItem->director_id,
    //                                 4 => $xItem->language_id,
    //                                 5 => $yItem->genre_id,
    //                                 6 => $zItem->cast_id,
    //                             ];
    //                         }
    //                     }
    //                 }
    //             }
    //         }
    //     }
    //     // dd($resultArray2);
    //     return $resultArray;
    // }
    public function data2DArrayAll()
    {
        $mData = Movie::all();
        $uData = MovieCountry::all();
        $vData = MoviePcompany::all();
        $wData = MovieDirector::all();
        $xData = MovieLanguage::all();
        $yData = MovieGenre::all();
        $zData = MovieCast::all();
        $resultArray = [];

        foreach ($mData as $mItem) {
            foreach ($uData as $uItem) {
                if ($uItem->movie_id == $mItem->id) {
                    foreach ($vData as $vItem) {
                        if ($vItem->movie_id == $mItem->id) {
                            foreach ($wData as $wItem) {
                                if ($wItem->movie_id == $mItem->id) {
                                    foreach ($xData as $xItem) {
                                        if ($xItem->movie_id == $mItem->id) {
                                            foreach ($yData as $yItem) {
                                                if ($yItem->movie_id == $mItem->id) {
                                                    foreach ($zData as $zItem) {
                                                        if ($zItem->movie_id == $mItem->id) {
                                                            $resultArray[] = [
                                                                0 => $mItem->id,
                                                                1 => $uItem->country_id,
                                                                2 => $vItem->pcompany_id,
                                                                3 => $wItem->director_id,
                                                                4 => $xItem->language_id,
                                                                5 => $yItem->genre_id,
                                                                6 => $zItem->cast_id,
                                                            ];
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        // User Interests
        $user = Auth::user();
        $data = Interest::where('user_id', '=', $user->id)->first();
        if ($data) {
            $id = $data->id;

            $InterestGenredata = InterestGenre::where('interest_id', '=', $id)->get();
            $InterestCastdata = InterestCast::where('interest_id', '=', $id)->get();
            $InterestDirectordata = InterestDirector::where('interest_id', '=', $id)->get();
            $InterestLanguagedata = InterestLanguage::where('interest_id', '=', $id)->get();
            $InterestPcompanydata = InterestPcompany::where('interest_id', '=', $id)->get();
            $InterestCountrydata = InterestCountry::where('interest_id', '=', $id)->get();

            foreach ($InterestCountrydata as $uItem) {
                foreach ($InterestPcompanydata as $vItem) {
                    foreach ($InterestDirectordata as $wItem) {
                        foreach ($InterestLanguagedata as $xItem) {
                            foreach ($InterestGenredata as $yItem) {
                                foreach ($InterestCastdata as $zItem) {
                                    $resultArray[] = [
                                        0 => '-1',
                                        1 => $uItem->country_id,
                                        2 => $vItem->pcompany_id,
                                        3 => $wItem->director_id,
                                        4 => $xItem->language_id,
                                        5 => $yItem->genre_id,
                                        6 => $zItem->cast_id,
                                    ];
                                }
                            }
                        }
                    }
                }
            }
        }

        return $resultArray;
    }

    public function data2DArrayold()
    {
        $user = Auth::user();
        $data = Interest::all()->where('user_id', '=', $user->id)->first();
        $id = $data->id;
        //IF any interest Added
        $data = Interest::find($id);
        $InterestGenredata = InterestGenre::all()->where('interest_id', '=', $id);
        $InterestLanguagedata = InterestLanguage::all()->where('interest_id', '=', $id);
        //
        $mData = Movie::all();
        $xData = MovieLanguage::all();
        $yData = MovieGenre::all();
        $resultArray = [];
        $i = 0;
        foreach ($mData as $mItem) {
            foreach ($xData as $xItem) {
                foreach ($InterestLanguagedata as $InterestLanguage) {
                    if ($InterestLanguage->language_id == $xItem->language_id) {
                        if ($mItem->id == $xItem->movie_id) {
                            foreach ($yData as $yItem) {
                                foreach ($InterestGenredata as $InterestGenre) {
                                    if ($InterestGenre->genre_id == $yItem->genre_id) {
                                        if ($mItem->id == $yItem->movie_id) {
                                            $resultArray[] = [
                                                0 => $mItem->id,
                                                1 => $xItem->language_id,
                                                2 => $mItem->id,
                                            ];
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        dd($resultArray);
        return $resultArray;
    }
    public function data2DArray()
    {
        $user = Auth::user();
        $data = Interest::all()->where('user_id', '=', $user->id)->first();
        $id = $data->id;
        //IF any interest Added
        $data = Interest::find($id);
        $InterestGenredata = InterestGenre::all()->where('interest_id', '=', $id);
        $InterestLanguagedata = InterestLanguage::all()->where('interest_id', '=', $id);
        //
        $mData = Movie::all();
        $xData = MovieLanguage::all();
        $yData = MovieGenre::all();
        $resultArray = [];
        $i = 0;
        foreach ($mData as $mItem) {
            foreach ($xData as $xItem) {
                foreach ($InterestLanguagedata as $InterestLanguage) {
                    if ($InterestLanguage->language_id == $xItem->language_id) {
                        if ($mItem->id == $xItem->movie_id) {
                            $resultArray[] = [
                                0 => $mItem->id,
                                1 => $xItem->language_id,
                                2 => $mItem->id,
                            ];
                        }
                    }
                }
            }
        }
        $resultArray1 = [];
        foreach ($mData as $mItem) {
            foreach ($yData as $yItem) {
                foreach ($InterestGenredata as $InterestGenre) {
                    if ($InterestGenre->genre_id == $yItem->genre_id) {
                        if ($mItem->id == $yItem->movie_id) {
                            foreach ($xData as $xItem) {
                                foreach ($InterestLanguagedata as $InterestLanguage) {
                                    if ($InterestLanguage->language_id == $xItem->language_id) {
                                        if ($mItem->id == $xItem->movie_id) {
                                            $resultArray[] = [
                                                0 => $mItem->id,
                                                1 => $xItem->language_id,
                                                2 => $yItem->genre_id,
                                            ];
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $resultArray;
    }

    // public function index()
    // {

    //     $user = Auth::user();
    //     $data = Interest::all()->where('user_id', '=', $user->id)->first();
    //     if ($data == null) {
    //         //IF no interest Added
    //         $genres = Genre::all();
    //         $casts = Cast::all();
    //         $languages = Language::all();
    //         $pcompanys = ProductionCompany::all();
    //         $directors = Director::all();
    //         $countries = Country::all();
    //         return view('profile.interest.interest', ['genres' => $genres, 'casts' => $casts, 'languages' => $languages, 'pcompanys' => $pcompanys, 'directors' => $directors, 'countries' => $countries, 'user' => $user]);
    //     }
    //     //
    //     // cluster
    //     $data = $this->data2DArrayAll();
    //     // Number of clusters
    //     $numberOfClusters = 10;

    //     // Kmean for Language
    //     $result = $this->KmeansControl($numberOfClusters, $data);
    //     //
    //     $data = [];
    //     foreach ($result[0] as $r) {
    //         $data[] = Movie::find($r);
    //     }
    //     shuffle($data);
    //     return view('pages.recom3', ['data' => $data, 'time' => $result[1]]);
    // }

    public function index()
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
        }
        // Data preparation
        $data = $this->data2DArrayAll();

        // Filter out entries with null values to avoid issues during training
        $filteredData = array_filter($data, function ($row) {
            return !in_array(null, $row, true);
        });

        // Extract features (excluding the first column which is the movie ID)
        $samples = array_map(function ($row) {
            return array_slice($row, 1);
        }, $filteredData);

        // Measure time before clustering
        $startTime = microtime(true);

        // Implement K-Means clustering
        $kmeans = new KMeans(10); // Correct usage without Euclidean
        $clusters = $kmeans->cluster($samples);

        // Measure time after clustering
        $endTime = microtime(true);

        // Calculate elapsed time
        $elapsedTime = $endTime - $startTime;

        // Collect movie IDs from clusters
        $recommendedMovieIds = [];
        foreach ($clusters as $cluster) {
            foreach ($cluster as $sample) {
                $index = array_search($sample, $samples);
                if ($index !== false) {
                    $recommendedMovieIds[] = $filteredData[$index][0];
                }
            }
        }

        // Ensure we recommend at least 10 unique movies
        $recommendedMovieIds = array_unique($recommendedMovieIds);
        $numRecommendations = 10;
        if (count($recommendedMovieIds) < $numRecommendations) {
            $additionalMovies = Movie::inRandomOrder()->take($numRecommendations - count($recommendedMovieIds))->pluck('id')->toArray();
            $recommendedMovieIds = array_merge($recommendedMovieIds, $additionalMovies);
        }

        // Fetch movie details for recommendations
        $recommendedMoviesDetails = [];
        foreach ($recommendedMovieIds as $movieId) {
            $movie = Movie::find($movieId);
            if ($movie) {
                $recommendedMoviesDetails[] = $movie;
            }
        }

        // Shuffle the recommended movies (optional)
        shuffle($recommendedMoviesDetails);

        return view('pages.recom3', ['data' => $recommendedMoviesDetails, 'time' => $elapsedTime]);
    }



    public function KmeansControl($numberOfClusters, $data)
    {
        // Function to check if data exists in the array
        function isDataExist($dataArray, $newData)
        {
            return in_array($newData, $dataArray);
        }
        //$flag
        $flag = 0;
        //
        $numbers = 0;
        $numbers2 = 0;
        // Starting clock time in seconds 
        $start_time = microtime(true);
        // Create a KMeans instance
        $kmeans = new KMeans($numberOfClusters);

        // Perform clustering
        $clusters = $kmeans->cluster($data);
        // End clock time in seconds 
        $end_time = microtime(true);
        // Display the clusters of Language
        foreach ($clusters as $index => $cluster) {
            $flag = 0;
            // Example array to store previous data
            $previousDataArray = array();
            // Number of points in the cluster
            $numberOfPoints = count($cluster);
            $numbers = $numbers + $numberOfPoints;
            // echo "Cluster " . ($index + 1) . ": ($numberOfPoints) <br>";

            foreach ($cluster as $point) {
                // echo "[" . implode(", ", $point) . "]\n";
                foreach ($point as $key => $pointData) {
                    if ($key == 0) {
                        $Movie = Movie::find($pointData);
                        if ($pointData == '-1') {
                            $mDAta = 'User and Combination Number ' . $numbers2;
                            $flag = 1;
                        } else {
                            $mDAta = $Movie->title;
                        }
                    } elseif ($key == 1) {
                        $Country = Country::find($pointData);
                        if ($Country == null) {
                            $uDAta = 'Missing';
                        } else {
                            $uDAta = $Country->title;
                        }
                    } elseif ($key == 2) {
                        $ProductionCompany = ProductionCompany::find($pointData);
                        if ($ProductionCompany == null) {
                            $vDAta = 'Missing';
                        } else {
                            $vDAta = $ProductionCompany->title;
                        }
                    } elseif ($key == 3) {
                        $Director = Director::find($pointData);
                        if ($Director == null) {
                            $wDAta = 'Missing';
                        } else {
                            $wDAta = $Director->name;
                        }
                    } elseif ($key == 4) {
                        $Language = Language::find($pointData);
                        if ($Language == null) {
                            $xDAta = 'Missing';
                        } else {
                            $xDAta = $Language->title;
                        }
                    } elseif ($key == 5) {
                        $Genre = Genre::find($pointData);
                        if ($Genre == null) {
                            $yDAta = 'Missing';
                        } else {
                            $yDAta = $Genre->title;
                        }
                    } elseif ($key == 6) {
                        $Cast = Cast::find($pointData);
                        if ($Cast == null) {
                            $zDAta = 'Missing';
                        } else {
                            $zDAta = $Cast->name;
                        }
                    }
                } // Check if data exists in the array
                if (!isDataExist($previousDataArray, $mDAta)) {
                    // // Data doesn't exist, so process and store in the array
                    // echo "[" . $mDAta . " ," . $uDAta . " ," . $vDAta . " ," . $wDAta . " ," . $xDAta . " ," . $yDAta . " ," . $zDAta . "] <br>";
                    // Store data in the array
                    $previousDataArray[] = $mDAta;
                    $numbers2 = $numbers2 + 1;
                }
            }
            if ($flag == 1) {
                $movie = $index;
            }
            // echo " <br>";
        }
        // echo " <br> Total Data Combination - " . $numbers . ' and Total Movies ' . $numbers2 . ' <br>   ';
        // Calculate script execution time 
        $execution_time = ($end_time - $start_time);
        $Movie = $clusters[$movie];
        //
        $previousDataArray2 = array();
        foreach ($Movie as $key => $data) {
            // Check if data exists in the array
            if (!isDataExist($previousDataArray2, $data)) {
                $previousDataArray2[] = $data;
            }
        }
        $previousDataArray3 = array();
        foreach ($previousDataArray2 as $data) {
            if (!isDataExist($previousDataArray3, $data[0]) && $data[0] != -1) {
                $previousDataArray3[] = $data[0];
            }
        }
        //
        $dataReply = [];
        $dataReply[] = $previousDataArray3;
        $dataReply[] = $execution_time;

        return $dataReply;
    }
    public function KmeansControl2($numberOfClusters, $data)
    {
        $numbers = 0;
        // Create a KMeans instance
        $kmeans = new KMeans($numberOfClusters);

        // Perform clustering
        $clusters = $kmeans->cluster($data);

        // Display the clusters of Language
        foreach ($clusters as $index => $cluster) {
            // Number of points in the cluster
            $numberOfPoints = count($cluster);
            $numbers = $numbers + $numberOfPoints;
            echo "Cluster " . ($index + 1) . ": ($numberOfPoints) <br>";

            foreach ($cluster as $point) {
                // echo "[" . implode(", ", $point) . "]\n";
                foreach ($point as $key => $pointData) {
                    if ($key == 0) {
                        $Movie = Movie::find($pointData);
                        $mDAta = $Movie->title;
                    } elseif ($key == 1) {
                        $Language = Language::find($pointData);
                        if ($Language == null) {
                            $xDAta = 'Missing';
                        } else {
                            $xDAta = $Language->title;
                        }
                    } elseif ($key == 2) {
                        $Genre = Genre::find($pointData);
                        if ($Genre == null) {
                            $yDAta = 'Missing';
                        } else {
                            $yDAta = $Genre->title;
                        }
                    }
                }
                echo "[" . $mDAta . " ," . $xDAta . " ," . $yDAta . "] <br>";
            }

            echo " <br>";
        }
        echo " <br> Total Data Combination - " . $numbers . ' <br>   ';
    }
    public function indexMain()
    {
        //

        // Starting clock time in seconds 
        $start_time = microtime(true);
        //
        // cluster
        $data = $this->data2DArray();

        // Number of clusters
        $numberOfClusters = 5;

        // Kmean for Language
        $result = $this->KmeansControlMain($numberOfClusters, $data);
        // End clock time in seconds 
        $end_time = microtime(true);
        // Calculate script execution time 
        $execution_time = ($end_time - $start_time);
        $data = [];
        foreach ($result as $r) {
            $data[] = Movie::find($r[0]);
        }
        shuffle($data);
        return view('pages.recom3', ['data' => $data, 'time' => $execution_time]);
    }
    public function KmeansControlMain($numberOfClusters, $data)
    {
        $numbers = 0;
        // Create a KMeans instance
        $kmeans = new KMeans($numberOfClusters);

        // Perform clustering
        $clusters = $kmeans->cluster($data);

        // Display the clusters of Language
        foreach ($clusters as $index => $cluster) {
            // Number of points in the cluster
            $numberOfPoints = count($cluster);
            $numbers = $numbers + $numberOfPoints;
            // echo "Cluster " . ($index + 1) . ": ($numberOfPoints) <br>";

            if ($index == 0) {
                return $cluster;
            }
        }
    }
    // public function index2()
    // {
    //     // Starting clock time in seconds 
    //     $start_time = microtime(true);
    //     //
    //     $user = Auth::user();
    //     $data = Interest::all()->where('user_id', '=', $user->id)->first();
    //     if ($data == null) {
    //         //IF no interest Added
    //         $genres = Genre::all();
    //         $casts = Cast::all();
    //         $languages = Language::all();
    //         $pcompanys = ProductionCompany::all();
    //         $directors = Director::all();
    //         $countries = Country::all();
    //         return view('profile.interest.interest', ['genres' => $genres, 'casts' => $casts, 'languages' => $languages, 'pcompanys' => $pcompanys, 'directors' => $directors, 'countries' => $countries, 'user' => $user]);
    //     } else {
    //         $id = $data->id;
    //         //IF any interest Added
    //         $data = Interest::find($id);
    //         $InterestGenredata = InterestGenre::all()->where('interest_id', '=', $id);
    //         $InterestCastdata = InterestCast::all()->where('interest_id', '=', $id);
    //         $InterestDirectordata = InterestDirector::all()->where('interest_id', '=', $id);
    //         $InterestLanguagedata = InterestLanguage::all()->where('interest_id', '=', $id);
    //         $InterestPcompanydata = InterestPcompany::all()->where('interest_id', '=', $id);
    //         $InterestRatingData = InterestRating::all()->where('interest_id', '=', $id);
    //         $InterestCountrydata = InterestCountry::all()->where('interest_id', '=', $id);
    //     }
    //     // Genre Weight & Prediction
    //     $genreId = [];
    //     foreach ($InterestGenredata as $genreData) { //change here
    //         $genreId[] = $genreData->genre_id; //change here
    //     }
    //     $genrePredict = $this->genrePredict($genreId);
    //     //
    //     // Language Weight & Prediction
    //     $languageId = [];
    //     foreach ($InterestLanguagedata as $genreData) { //change here
    //         $languageId[] = $genreData->language_id; //change here
    //     }
    //     $languagePredict = $this->languagePredict($languageId);
    //     // Cast Weight & Prediction
    //     $castId = [];
    //     foreach ($InterestCastdata as $genreData) { //change here
    //         $castId[] = $genreData->cast_id; //change here
    //     }
    //     $castPredict = $this->castPredict($castId);
    //     // Director Weight & Prediction
    //     $directorId = [];
    //     foreach ($InterestDirectordata as $genreData) { //change here
    //         $directorId[] = $genreData->director_id; //change here
    //     }
    //     $directorPredict = $this->directorPredict($directorId);
    //     // Country Weight & Prediction
    //     $countryId = [];
    //     foreach ($InterestCountrydata as $genreData) { //change here
    //         $countryId[] = $genreData->country_id; //change here
    //     }
    //     $countryPredict = $this->countryPredict($countryId);
    //     //
    //     // Prduction Company Weight & Prediction
    //     $pcompanyId = [];
    //     foreach ($InterestPcompanydata as $genreData) { //change here
    //         $pcompanyId[] = $genreData->pcompany_id; //change here
    //     }
    //     $pcompanyPredict = $this->pcompanyPredict($pcompanyId);
    //     //
    //     // Weight Merge 
    //     $calculation = $this->calculation($languagePredict, $genrePredict, $castPredict, $directorPredict, $countryPredict, $pcompanyPredict);
    //     //Sorting Weight
    //     asort($calculation);
    //     // End clock time in seconds 
    //     $end_time = microtime(true);
    //     // Calculate script execution time 
    //     $execution_time = ($end_time - $start_time);
    //     // dd($calculation, $languagePredict, $genrePredict, $castPredict, $directorPredict, $countryPredict, $pcompanyPredict);
    //     //Sending Data To Front
    //     $RecomendedMovies = [];
    //     $i = 1;
    //     $totalMovies = 6; // Set Value of movies to show here
    //     foreach ($calculation as $key => $MoviE) {
    //         $movieData = Movie::all()->where('id', $key)->first();
    //         $RecomendedMovies[] = $movieData;
    //         if ($i >= $totalMovies) {
    //             break;
    //         }
    //         $i += 1;
    //     }
    //     shuffle($RecomendedMovies);
    //     return view('pages.recom3', ['calculation' => $calculation, 'data' => $RecomendedMovies, 'time' => $execution_time]);
    // }

    // //Calculation
    // public function calculation(array $languagePredict, array $genrePredict, array $castPredict, array $directorPredict, array $countryPredict, array $pcompanyPredict)
    // {
    //     $mergeWeight = [];
    //     //genre
    //     foreach ($languagePredict as $key => $weight) {
    //         // Explode Movie and its weight
    //         $parts = explode("@", $weight);
    //         foreach ($parts as $keyPart => $part) {
    //             if ($keyPart == 0) {
    //                 $movie_id = $part;
    //             } else {
    //                 $movie_weight = $part;
    //             }
    //         }
    //         $mergeWeight[$movie_id] = $movie_weight;
    //     }
    //     //language
    //     foreach ($genrePredict as $key => $weight) {
    //         // Explode Movie and its weight
    //         $parts = explode("@", $weight);
    //         foreach ($parts as $keyPart => $part) {
    //             if ($keyPart == 0) {
    //                 $movie_id = $part;
    //             } else {
    //                 $movie_weight = $part;
    //             }
    //         }
    //         $mergeWeight[$movie_id] = $mergeWeight[$movie_id] + $movie_weight;
    //     }
    //     //cast
    //     foreach ($castPredict as $key => $weight) {
    //         // Explode Movie and its weight
    //         $parts = explode("@", $weight);
    //         foreach ($parts as $keyPart => $part) {
    //             if ($keyPart == 0) {
    //                 $movie_id = $part;
    //             } else {
    //                 $movie_weight = $part;
    //             }
    //         }
    //         $mergeWeight[$movie_id] = $mergeWeight[$movie_id] + $movie_weight;
    //     }
    //     //Director
    //     foreach ($directorPredict as $key => $weight) {
    //         // Explode Movie and its weight
    //         $parts = explode("@", $weight);
    //         foreach ($parts as $keyPart => $part) {
    //             if ($keyPart == 0) {
    //                 $movie_id = $part;
    //             } else {
    //                 $movie_weight = $part;
    //             }
    //         }
    //         $mergeWeight[$movie_id] = $mergeWeight[$movie_id] + $movie_weight;
    //     }
    //     //Country
    //     foreach ($countryPredict as $key => $weight) {
    //         // Explode Movie and its weight
    //         $parts = explode("@", $weight);
    //         foreach ($parts as $keyPart => $part) {
    //             if ($keyPart == 0) {
    //                 $movie_id = $part;
    //             } else {
    //                 $movie_weight = $part;
    //             }
    //         }
    //         $mergeWeight[$movie_id] = $mergeWeight[$movie_id] + $movie_weight;
    //     }
    //     //Production company 
    //     foreach ($pcompanyPredict as $key => $weight) {
    //         // Explode Movie and its weight
    //         $parts = explode("@", $weight);
    //         foreach ($parts as $keyPart => $part) {
    //             if ($keyPart == 0) {
    //                 $movie_id = $part;
    //             } else {
    //                 $movie_weight = $part;
    //             }
    //         }
    //         $mergeWeight[$movie_id] = $mergeWeight[$movie_id] + $movie_weight;
    //     }
    //     // dd($movie_id, $movie_weight);
    //     return $mergeWeight;
    // }
    // public function displayAdjacencyMatrix(string $language1, string $language2)
    // {
    //     // Example languages
    //     $languages = ['English', 'German', 'Swedish', 'Icelandic', 'Italian', 'French', 'Portuguese', 'Spanish', 'Czech', 'Polish', 'Russian', 'Hindi', 'Arabic', 'Chinese', 'Finninsh', 'Indonesian', 'Japanese', 'Korean', 'Thai', 'Turkish'];

    //     // Example distances between languages (replace these with actual distances)
    //     $distances = [
    //         // English, Spanish, French, German, Chinese
    //         [0, 5.06, 4.28, 7.64, 5.63, 6.20, 5.08, 5.72, 6.10, 6.08, 6.02, 7.41, 6.69, 7.90, 6.26, 5.24, 11.63, 7.21, 8.72, 6.80],  // English
    //         [5.06, 0, 5.61, 8.15, 6.25, 6.50, 5.91, 6.28, 6.36, 6.51, 6.46, 8.50, 7.42, 8.39, 6.72, 6.36, 12.33, 7.70, 9.23, 7.20],  // German
    //         [4.28, 5.61, 0, 6.95, 6.74, 7.16, 6.33, 6.70, 5.69, 5.79, 5.79, 7.84, 6.37, 7.93, 5.66, 5.19, 12.26, 6.78, 8.44, 6.32],   // Swedish
    //         [7.64, 8.15, 6.95, 0, 9.11, 9.24, 8.69, 8.88, 7.32, 7.31, 7.41, 9.37, 7.80, 8.91, 7.10, 7.24, 12.40, 7.65, 9.44, 7.58], // Icelandic
    //         [5.63, 6.25, 6.74, 9.11, 0, 5.49, 4.61, 5.18, 7.14, 7.08, 7.24, 8.51, 7.76, 9.33, 8.05, 7.01, 11.72, 8.70, 9.67, 7.82], // Italian
    //         [6.20, 6.50, 7.16, 9.24, 5.49, 0, 5.16, 5.80, 7.78, 7.64, 7.50, 8.67, 8.18, 9.44, 8.55, 7.52, 11.92, 9.11, 9.83, 8.41], //French
    //         [5.08, 5.91, 6.33, 8.69, 4.61, 5.16, 0, 4.35, 6.99, 6.88, 6.80, 8.11, 7.27, 9.08, 7.84, 6.69, 11.69, 8.42, 9.42, 7.63], //Portuguese
    //         [5.72, 6.28, 6.70, 8.88, 5.18, 5.80, 4.35, 0, 7.28, 7.03, 7.07, 8.21, 7.27, 9.12, 8.03, 7.04, 11.55, 8.39, 9.37, 7.62], //spanish
    //         [6.10, 6.36, 5.69, 7.32, 7.14, 7.78, 6.99, 7.28, 0, 4.60, 5.10, 8.41, 6.29, 8.01, 5.49, 5.84, 11.96, 6.88, 8.92, 6.18], //czech
    //         [6.08, 6.51, 5.79, 7.31, 7.08, 7.64, 6.88, 7.03, 4.60, 0, 4.79, 8.21, 6.07, 8.08, 5.58, 5.66, 11.75, 6.92, 8.80, 6.13], //polish
    //         [6.02, 6.46, 5.79, 7.41, 7.24, 7.50, 6.80, 7.07, 5.10, 4.79, 0, 8.19, 6.02, 8.02, 5.77, 5.65, 11.74, 7.17, 8.89, 6.40], //russian
    //         [7.41, 8.50, 7.84, 9.37, 8.51, 8.67, 8.11, 8.21, 8.41, 8.21, 8.19, 0, 7.98, 9.33, 8.85, 8.19, 10.38, 8.96, 9.42, 8.59], //hindi
    //         [6.69, 7.42, 6.37, 7.80, 7.76, 8.18, 7.27, 7.27, 6.29, 6.07, 6.02, 7.98, 0, 8.44, 6.92, 6.20, 11.19, 7.58, 8.93, 6.69], //arabic
    //         [7.90, 8.39, 7.93, 8.91, 9.33, 9.44, 9.08, 9.12, 8.01, 8.08, 8.02, 9.33, 8.44, 0, 7.83, 7.69, 11.36, 7.21, 9.13, 8.12], //chinese
    //         [6.26, 6.72, 5.66, 7.10, 8.05, 8.55, 7.84, 8.03, 5.49, 5.58, 5.77, 8.85, 6.92, 7.83, 0, 5.59, 12.65, 6.13, 8.89, 5.64], //finnish
    //         [5.24, 6.36, 5.19, 7.24, 7.01, 7.52, 6.69, 7.04, 5.84, 5.66, 5.65, 8.19, 6.20, 7.69, 5.59, 0, 11.77, 6.75, 8.39, 6.03], //indonesian
    //         [11.63, 12.33, 12.26, 12.40, 11.72, 11.92, 11.69, 11.55, 11.96, 11.75, 11.74, 10.38, 11.19, 11.36, 12.65, 11.77, 0, 11.52, 12.07, 11.90], //japanese
    //         [7.21, 7.70, 6.78, 7.65, 8.70, 9.11, 8.42, 8.39, 6.88, 6.92, 7.17, 8.96, 7.58, 7.21, 6.13, 6.75, 11.52, 0, 8.45, 6.25], //korean
    //         [8.72, 9.23, 8.44, 9.44, 9.67, 9.83, 9.42, 9.37, 8.92, 8.80, 8.89, 9.42, 8.93, 9.13, 8.89, 8.39, 12.07, 8.45, 0, 8.82], //thai
    //         [6.80, 7.20, 6.32, 7.58, 7.82, 8.41, 7.63, 7.62, 6.18, 6.13, 6.40, 8.59, 6.69, 8.12, 5.64, 6.03, 11.90, 6.25, 8.82, 0] //turkiah

    //     ];
    //     $numLanguages = count($languages);

    //     // Display column headers
    //     // echo "   ";
    //     for ($i = 0; $i < $numLanguages; $i++) {
    //         // echo str_pad($languages[$i], 10);
    //     }
    //     // echo "<br>";

    //     // Display matrix
    //     for ($i = 0; $i < $numLanguages; $i++) {
    //         // echo $languages[$i] . ' ';
    //         for ($j = 0; $j < $numLanguages; $j++) {
    //             // echo str_pad($distances[$i][$j], 10);
    //         }
    //     }
    //     $keyOfLang1 = array_search($language1, $languages);
    //     $keyOfLang2 = array_search($language2, $languages);
    //     return $distances[$keyOfLang1][$keyOfLang2];
    // }
    public function KmeansControl4($numberOfClusters, $data)
    {
        $numbers = 0;
        $numbers2 = 0;
        // Starting clock time in seconds 
        $start_time = microtime(true);
        // Create a KMeans instance
        $kmeans = new KMeans($numberOfClusters);

        // Perform clustering
        $clusters = $kmeans->cluster($data);
        // End clock time in seconds 
        $end_time = microtime(true);
        // Display the clusters of Language
        foreach ($clusters as $index => $cluster) {
            // Number of points in the cluster
            $numberOfPoints = count($cluster);
            $numbers = $numbers + $numberOfPoints;
            echo "<br>Cluster " . ($index + 1) . ": ($numberOfPoints) <br>";

            foreach ($cluster as $point) {
                echo "[" . implode(", ", $point) . "], <br>";
                $numbers2 = $numbers2 + 1;
            }
        }
        $execution_time = ($end_time - $start_time);
        //
        echo 'Combinations ' . $numbers2 . ' , Calculatuion Time' . $execution_time . 's ';
    }
    public function index4()
    {
        //
        // cluster
        $data = $this->data2DArrayAll();
        // Number of clusters
        $numberOfClusters = 20;

        // Kmean for Language
        $this->KmeansControl4($numberOfClusters, $data);
    }
}
