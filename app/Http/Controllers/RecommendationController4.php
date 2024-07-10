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
use Phpml\Clustering\KMeans2;
use Phpml\Classification\KNearestNeighbors;
use Phpml\Dataset\ArrayDataset;
use Phpml\Metric\Accuracy;
use Phpml\CrossValidation\RandomSplit;


class RecommendationController4 extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //new

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
                                                                1 => $uItem->country_id ?? null,
                                                                2 => $vItem->pcompany_id ?? null,
                                                                3 => $wItem->director_id ?? null,
                                                                4 => $xItem->language_id ?? null,
                                                                5 => $yItem->genre_id ?? null,
                                                                6 => $zItem->cast_id ?? null,
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

        //User Array
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
                                        1 => $uItem->country_id ?? null,
                                        2 => $vItem->pcompany_id ?? null,
                                        3 => $wItem->director_id ?? null,
                                        4 => $xItem->language_id ?? null,
                                        5 => $yItem->genre_id ?? null,
                                        6 => $zItem->cast_id ?? null,
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
    //     // Data preparation
    //     $data = $this->data2DArray();

    //     // Split data into features and labels
    //     $samples = [];
    //     $labels = [];
    //     foreach ($data as $row) {
    //         $samples[] = [$row[1], $row[2]]; // Features: Language ID and Genre ID (adjust based on your data)
    //         $labels[] = $row[0]; // Label: Movie ID
    //     }
    //     // KNN classification
    //     $classifier = new KNearestNeighbors();
    //     $dataset = new ArrayDataset($samples, $labels);
    //     $split = new RandomSplit($dataset, 0.1);

    //     // Train the classifier
    //     $classifier->train($split->getTrainSamples(), $split->getTrainLabels());

    //     // Make predictions on the test set
    //     $predictions = $classifier->predict($split->getTestSamples());

    //     // Calculate accuracy (optional)
    //     $accuracy = Accuracy::score($split->getTestLabels(), $predictions);

    //     // Retrieve recommended movies (choose one approach)
    //     $recommendedMovies = [];

    //     // Option 1: Recommend all predicted movies (uncomment this block)
    //     /*
    //     foreach ($predictions as $index => $predictedMovieId) {
    //       $recommendedMovies[] = $predictedMovieId;
    //     }
    //     */

    //     // Option 2: Recommend limited number of unique movies (uncomment this block)
    //     $numRecommendations = 20; // Adjust this value for desired number
    //     $count = 0;
    //     foreach ($predictions as $index => $predictedMovieId) {
    //         if (!in_array($predictedMovieId, $recommendedMovies)) {
    //             $recommendedMovies[] = $predictedMovieId;
    //             $count++;
    //         }
    //         if ($count >= $numRecommendations) {
    //             break; // Stop recommending once desired number is reached
    //         }
    //     }

    //     // Fetch movie details for recommendations
    //     $data = [];
    //     foreach ($recommendedMovies as $r) {
    //         $data[] = Movie::find($r);
    //     }

    //     // Shuffle the recommended movies (optional)
    //     shuffle($data);

    //     return view('pages.recom3', ['data' => $data, 'time' => $accuracy]);
    // }

    public function index()
    {
        // Data preparation
        $data = $this->data2DArrayAll();

        // Filter out entries with null values to avoid issues during training
        $filteredData = array_filter($data, function ($row) {
            return !in_array(null, $row, true);
        });

        // Split data into features and labels
        $samples = [];
        $labels = [];
        foreach ($filteredData as $row) {
            if ($row[0] != '-1') {
                $samples[] = [
                    $row[1],
                    $row[2],
                    $row[3],
                    $row[4],
                    $row[5],
                    $row[6]
                ];
                $labels[] = $row[0];
            }
        }

        // KNN classification
        $classifier = new KNearestNeighbors();
        $dataset = new ArrayDataset($samples, $labels);
        $split = new RandomSplit($dataset, 0.1);

        // Train the classifier
        $classifier->train($split->getTrainSamples(), $split->getTrainLabels());

        // Make predictions on the test set
        $predictions = $classifier->predict($split->getTestSamples());

        // Calculate accuracy (optional)
        $accuracy = Accuracy::score($split->getTestLabels(), $predictions);

        // Retrieve recommended movies
        $recommendedMovies = [];

        // Recommend limited number of unique movies
        $numRecommendations = 10; // Limit to 10 recommendations
        $count = 0;
        foreach ($predictions as $predictedMovieId) {
            if (!in_array($predictedMovieId, $recommendedMovies)) {
                $recommendedMovies[] = $predictedMovieId;
                $count++;
            }
            if ($count >= $numRecommendations) {
                break; // Stop recommending once the desired number is reached
            }
        }

        // Fetch movie details for recommendations
        $recommendedMoviesDetails = [];
        foreach ($recommendedMovies as $movieId) {
            $movie = Movie::find($movieId);
            if ($movie) {
                $recommendedMoviesDetails[] = $movie;
            }
        }

        // Shuffle the recommended movies (optional)
        shuffle($recommendedMoviesDetails);

        return view('pages.recom3', ['data' => $recommendedMoviesDetails, 'time' => $accuracy]);
    }



    // public function index()
    // {
    //     // cluster
    //     $data = $this->data2DArray();

    //     // Split data into features and labels
    //     $samples = [];
    //     $labels = [];
    //     foreach ($data as $row) {
    //         $samples[] = [$row[1], $row[2]]; // Features: Language ID and Genre ID
    //         $labels[] = $row[0]; // Label: Movie ID
    //     }

    //     // Initialize KNN classifier
    //     $classifier = new KNearestNeighbors();

    //     // Prepare dataset
    //     $dataset = new ArrayDataset($samples, $labels);

    //     // Split dataset into training and testing sets
    //     $split = new RandomSplit($dataset, 0.8);

    //     // Train the classifier
    //     $classifier->train($split->getTrainSamples(), $split->getTrainLabels());

    //     // Make predictions on the test set
    //     $predictions = $classifier->predict($split->getTestSamples());

    //     // Calculate accuracy
    //     $accuracy = Accuracy::score($split->getTestLabels(), $predictions);

    //     // Retrieve recommended movies based on predictions
    //     $recommendedMovies = [];
    //     foreach ($predictions as $index => $predictedMovieId) {
    //         if (!in_array($predictedMovieId, $recommendedMovies)) {
    //             $recommendedMovies[] = $predictedMovieId;
    //         }
    //     }
    //     $data = [];
    //     foreach ($recommendedMovies as $r) {
    //         $data[] = Movie::find($r);
    //     }
    //     shuffle($data);

    //     // // Fetch movie details for recommended movie IDs
    //     // $data = Movie::whereIn('id', $recommendedMovies)->get();

    //     // // Shuffle the recommended movies
    //     // $data = $data->shuffle();

    //     return view('pages.recom3', ['data' => $data, 'time' => $accuracy]);
    // }

    //end new
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
    // public function data2DArrayold()
    // {
    //     $user = Auth::user();
    //     $data = Interest::all()->where('user_id', '=', $user->id)->first();
    //     $id = $data->id;
    //     //IF any interest Added
    //     $data = Interest::find($id);
    //     $InterestGenredata = InterestGenre::all()->where('interest_id', '=', $id);
    //     $InterestLanguagedata = InterestLanguage::all()->where('interest_id', '=', $id);
    //     //
    //     $mData = Movie::all();
    //     $xData = MovieLanguage::all();
    //     $yData = MovieGenre::all();
    //     $resultArray = [];
    //     $i = 0;
    //     foreach ($mData as $mItem) {
    //         foreach ($xData as $xItem) {
    //             foreach ($InterestLanguagedata as $InterestLanguage) {
    //                 if ($InterestLanguage->language_id == $xItem->language_id) {
    //                     if ($mItem->id == $xItem->movie_id) {
    //                         foreach ($yData as $yItem) {
    //                             foreach ($InterestGenredata as $InterestGenre) {
    //                                 if ($InterestGenre->genre_id == $yItem->genre_id) {
    //                                     if ($mItem->id == $yItem->movie_id) {
    //                                         $resultArray[] = [
    //                                             0 => $mItem->id,
    //                                             1 => $xItem->language_id,
    //                                             2 => $mItem->id,
    //                                         ];
    //                                     }
    //                                 }
    //                             }
    //                         }
    //                     }
    //                 }
    //             }
    //         }
    //     }
    //     dd($resultArray);
    //     return $resultArray;
    // }
    // public function data2DArray()
    // {
    //     $user = Auth::user();
    //     $data = Interest::all()->where('user_id', '=', $user->id)->first();
    //     $id = $data->id;
    //     //IF any interest Added
    //     $data = Interest::find($id);
    //     $InterestGenredata = InterestGenre::all()->where('interest_id', '=', $id);
    //     $InterestLanguagedata = InterestLanguage::all()->where('interest_id', '=', $id);
    //     //
    //     $mData = Movie::all();
    //     $xData = MovieLanguage::all();
    //     $yData = MovieGenre::all();
    //     $resultArray = [];
    //     $i = 0;
    //     foreach ($mData as $mItem) {
    //         foreach ($xData as $xItem) {
    //             foreach ($InterestLanguagedata as $InterestLanguage) {
    //                 if ($InterestLanguage->language_id == $xItem->language_id) {
    //                     if ($mItem->id == $xItem->movie_id) {
    //                         $resultArray[] = [
    //                             0 => $mItem->id,
    //                             1 => $xItem->language_id,
    //                             2 => $mItem->id,
    //                         ];
    //                     }
    //                 }
    //             }
    //         }
    //     }
    //     $resultArray1 = [];
    //     foreach ($mData as $mItem) {
    //         foreach ($yData as $yItem) {
    //             foreach ($InterestGenredata as $InterestGenre) {
    //                 if ($InterestGenre->genre_id == $yItem->genre_id) {
    //                     if ($mItem->id == $yItem->movie_id) {
    //                         foreach ($xData as $xItem) {
    //                             foreach ($InterestLanguagedata as $InterestLanguage) {
    //                                 if ($InterestLanguage->language_id == $xItem->language_id) {
    //                                     if ($mItem->id == $xItem->movie_id) {
    //                                         $resultArray[] = [
    //                                             0 => $mItem->id,
    //                                             1 => $xItem->language_id,
    //                                             2 => $yItem->genre_id,
    //                                         ];
    //                                     }
    //                                 }
    //                             }
    //                         }
    //                     }
    //                 }
    //             }
    //         }
    //     }
    //     return $resultArray;
    // }
    // public function index()
    // {
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
    // public function KmeansControl($numberOfClusters, $data)
    // {
    //     // Function to check if data exists in the array
    //     function isDataExist($dataArray, $newData)
    //     {
    //         return in_array($newData, $dataArray);
    //     }
    //     //$flag
    //     $flag = 0;
    //     //
    //     $numbers = 0;
    //     $numbers2 = 0;
    //     // Starting clock time in seconds 
    //     $start_time = microtime(true);
    //     // Create a KMeans instance
    //     $kmeans = new KMeans2($numberOfClusters);

    //     // Perform clustering
    //     $clusters = $kmeans->cluster($data);
    //     // End clock time in seconds 
    //     $end_time = microtime(true);
    //     // Display the clusters of Language
    //     foreach ($clusters as $index => $cluster) {
    //         $flag = 0;
    //         // Example array to store previous data
    //         $previousDataArray = array();
    //         // Number of points in the cluster
    //         $numberOfPoints = count($cluster);
    //         $numbers = $numbers + $numberOfPoints;
    //         // echo "Cluster " . ($index + 1) . ": ($numberOfPoints) <br>";

    //         foreach ($cluster as $point) {
    //             // echo "[" . implode(", ", $point) . "]\n";
    //             foreach ($point as $key => $pointData) {
    //                 if ($key == 0) {
    //                     $Movie = Movie::find($pointData);
    //                     if ($pointData == '-1') {
    //                         $mDAta = 'User and Combination Number ' . $numbers2;
    //                         $flag = 1;
    //                     } else {
    //                         $mDAta = $Movie->title;
    //                     }
    //                 } elseif ($key == 1) {
    //                     $Country = Country::find($pointData);
    //                     if ($Country == null) {
    //                         $uDAta = 'Missing';
    //                     } else {
    //                         $uDAta = $Country->title;
    //                     }
    //                 } elseif ($key == 2) {
    //                     $ProductionCompany = ProductionCompany::find($pointData);
    //                     if ($ProductionCompany == null) {
    //                         $vDAta = 'Missing';
    //                     } else {
    //                         $vDAta = $ProductionCompany->title;
    //                     }
    //                 } elseif ($key == 3) {
    //                     $Director = Director::find($pointData);
    //                     if ($Director == null) {
    //                         $wDAta = 'Missing';
    //                     } else {
    //                         $wDAta = $Director->name;
    //                     }
    //                 } elseif ($key == 4) {
    //                     $Language = Language::find($pointData);
    //                     if ($Language == null) {
    //                         $xDAta = 'Missing';
    //                     } else {
    //                         $xDAta = $Language->title;
    //                     }
    //                 } elseif ($key == 5) {
    //                     $Genre = Genre::find($pointData);
    //                     if ($Genre == null) {
    //                         $yDAta = 'Missing';
    //                     } else {
    //                         $yDAta = $Genre->title;
    //                     }
    //                 } elseif ($key == 6) {
    //                     $Cast = Cast::find($pointData);
    //                     if ($Cast == null) {
    //                         $zDAta = 'Missing';
    //                     } else {
    //                         $zDAta = $Cast->name;
    //                     }
    //                 }
    //             }
    //             if (!isDataExist($previousDataArray, $mDAta)) {
    //                 $previousDataArray[] = $mDAta;
    //                 $numbers2 = $numbers2 + 1;
    //             }
    //         }
    //         if ($flag == 1) {
    //             $movie = $index;
    //         }
    //     }
    //     $execution_time = ($end_time - $start_time);
    //     $Movie = $clusters[$movie];
    //     //
    //     $previousDataArray2 = array();
    //     foreach ($Movie as $key => $data) {
    //         // Check if data exists in the array
    //         if (!isDataExist($previousDataArray2, $data)) {
    //             $previousDataArray2[] = $data;
    //         }
    //     }
    //     $previousDataArray3 = array();
    //     foreach ($previousDataArray2 as $data) {
    //         if (!isDataExist($previousDataArray3, $data[0]) && $data[0] != -1) {
    //             $previousDataArray3[] = $data[0];
    //         }
    //     }
    //     //
    //     $dataReply = [];
    //     $dataReply[] = $previousDataArray3;
    //     $dataReply[] = $execution_time;

    //     return $dataReply;
    // }


    // start
    // public function KmeansControl2($numberOfClusters, $data)
    // {
    //     $numbers = 0;
    //     $numbers2 = 0;
    //     // Starting clock time in seconds 
    //     $start_time = microtime(true);
    //     // Create a KMeans instance
    //     $kmeans = new KMeans2($numberOfClusters);

    //     // Perform clustering
    //     $clusters = $kmeans->cluster($data);
    //     // End clock time in seconds 
    //     $end_time = microtime(true);
    //     // Display the clusters of Language
    //     foreach ($clusters as $index => $cluster) {
    //         // Number of points in the cluster
    //         $numberOfPoints = count($cluster);
    //         $numbers = $numbers + $numberOfPoints;
    //         echo "<br>Cluster " . ($index + 1) . ": ($numberOfPoints) <br>";

    //         foreach ($cluster as $point) {
    //             echo "[" . implode(", ", $point) . "], <br>";
    //             $numbers2 = $numbers2 + 1;
    //         }
    //     }
    //     $execution_time = ($end_time - $start_time);
    //     //
    //     echo 'Combinations ' . $numbers2 . ' , Calculatuion Time' . $execution_time . 's ';
    // }
    // public function index2()
    // {
    //     //
    //     // cluster
    //     $data = $this->data2DArrayAll();
    //     // Number of clusters
    //     $numberOfClusters = 10;

    //     // Kmean for Language
    //     $this->KmeansControl2($numberOfClusters, $data);
    // }
}
