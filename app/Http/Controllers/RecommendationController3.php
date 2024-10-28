<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use App\Models\User;
use App\Models\Genre;
use App\Models\Cluster;
use App\Models\Movie;
use App\Models\Country;
use App\Models\Director;
use App\Models\Interest;
use App\Models\Language;
use App\Models\MovieCast;
use Illuminate\View\View;
use App\Models\MovieGenre;
use App\Models\WatchMovie;
use App\Models\InterestCast;
use App\Models\MovieCountry;
use Illuminate\Http\Request;
use Phpml\Clustering\KMeans;
use App\Models\InterestGenre;
use App\Models\MovieDirector;
use App\Models\MovieLanguage;
use App\Models\MoviePcompany;
use App\Models\InterestRating;
use App\Models\InterestCountry;
use App\Models\InterestDirector;
use App\Models\InterestLanguage;
use App\Models\InterestPcompany;
use App\Models\ProductionCompany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Unique;

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

    public function index()
    {

        $user = Auth::user();
        $data = Interest::all()->where('user_id', '=', $user->id)->first();
        if ($data == null) {
            return redirect()->route('user.dashboard')->with('error', 'Please add some interests to get recommendations.');
        }
        //
        // cluster
        $data = $this->data2DArrayAll();
        // Number of clusters
        $numberOfClusters = 10;

        // Kmean for Language
        $result = $this->KmeansControl($numberOfClusters, $data);
        //
        $data = [];
        foreach ($result[0] as $r) {
            $data[] = Movie::find($r);
        }
        shuffle($data);
        return view('pages.recom3', ['data' => $data, 'time' => $result[1]]);
    }

    // public function index()
    // {

    //     $user = Auth::user();
    //     $data = Interest::all()->where('user_id', '=', $user->id)->first();
    //     // if ($data == null) {
    //     //     //IF no interest Added
    //     //     $genres = Genre::all();
    //     //     $casts = Cast::all();
    //     //     $languages = Language::all();
    //     //     $pcompanys = ProductionCompany::all();
    //     //     $directors = Director::all();
    //     //     $countries = Country::all();
    //     //     return view('profile.interest.interest', ['genres' => $genres, 'casts' => $casts, 'languages' => $languages, 'pcompanys' => $pcompanys, 'directors' => $directors, 'countries' => $countries, 'user' => $user]);
    //     // }
    //     if ($data == null) {
    //         return redirect()->route('user.dashboard')->with('error', 'Please add some interests to get recommendations.');
    //     }
    //     // Data preparation
    //     $data = $this->data2DArrayAll();

    //     // Filter out entries with null values to avoid issues during training
    //     $filteredData = array_filter($data, function ($row) {
    //         return !in_array(null, $row, true);
    //     });

    //     // Extract features (excluding the first column which is the movie ID)
    //     $samples = array_map(function ($row) {
    //         return array_slice($row, 1);
    //     }, $filteredData);

    //     // Measure time before clustering
    //     $startTime = microtime(true);

    //     // Implement K-Means clustering
    //     $kmeans = new KMeans(10); // Correct usage without Euclidean
    //     $clusters = $kmeans->cluster($samples);

    //     // Measure time after clustering
    //     $endTime = microtime(true);

    //     // Calculate elapsed time
    //     $elapsedTime = $endTime - $startTime;

    //     // Collect movie IDs from clusters
    //     $recommendedMovieIds = [];
    //     foreach ($clusters as $cluster) {
    //         foreach ($cluster as $sample) {
    //             $index = array_search($sample, $samples);
    //             if ($index !== false) {
    //                 $recommendedMovieIds[] = $filteredData[$index][0];
    //             }
    //         }
    //     }

    //     // Ensure we recommend at least 10 unique movies
    //     $recommendedMovieIds = array_unique($recommendedMovieIds);
    //     $numRecommendations = 10;
    //     if (count($recommendedMovieIds) < $numRecommendations) {
    //         $additionalMovies = Movie::inRandomOrder()->take($numRecommendations - count($recommendedMovieIds))->pluck('id')->toArray();
    //         $recommendedMovieIds = array_merge($recommendedMovieIds, $additionalMovies);
    //     }

    //     // Fetch movie details for recommendations
    //     $recommendedMoviesDetails = [];
    //     foreach ($recommendedMovieIds as $movieId) {
    //         $movie = Movie::find($movieId);
    //         if ($movie) {
    //             $recommendedMoviesDetails[] = $movie;
    //         }
    //     }

    //     // Shuffle the recommended movies (optional)
    //     shuffle($recommendedMoviesDetails);

    //     return view('pages.recom3', ['data' => $recommendedMoviesDetails, 'time' => $elapsedTime]);
    // }

    //hybrid Recommender System
    // public function hybridRecommendations()
    // {
    //     $user = Auth::user();

    //     // Content-based recommendations
    //     $contentBasedRecommendations = $this->getContentBasedRecommendations($user);

    //     // Collaborative filtering recommendations
    //     $collaborativeRecommendations = $this->getCollaborativeRecommendations($user);

    //     //if both empty
    //     if (empty($contentBasedRecommendations) && empty($collaborativeRecommendations)) {
    //         return redirect()->route('user.dashboard')->with('error', 'Please add some interests and rate some movies to get recommendations.');
    //     }

    //     if (empty($contentBasedRecommendations)) {
    //         return redirect()->route('user.dashboard')->with('error', 'Please add some interests to get recommendations.');
    //     }

    //     if (empty($collaborativeRecommendations)) {
    //         return redirect()->route('user.dashboard')->with('error', 'Please rate some movies to get recommendations.');
    //     }

    //     // Combine recommendations
    //     $combinedRecommendations = array_unique(array_merge($contentBasedRecommendations, $collaborativeRecommendations), SORT_REGULAR);

    //     // Fetch movie details
    //     $recommendedMoviesDetails = [];
    //     foreach ($combinedRecommendations as $movieId) {
    //         $movie = Movie::find($movieId);
    //         if ($movie) {
    //             $recommendedMoviesDetails[] = $movie;
    //         }
    //     }

    //     // Shuffle the recommended movies (optional)
    //     shuffle($recommendedMoviesDetails);

    //     return view('pages.recom4', ['data' => $recommendedMoviesDetails]);
    // }

    // private function getContentBasedRecommendations($user)
    // {
    //     // Data preparation
    //     $data = $this->data2DArrayAll();
    //     $data1 = Interest::all()->where('user_id', '=', $user->id)->first();
    //     if ($data1 == null) {
    //         return [];
    //     }
    //     // Filter out entries with null values to avoid issues during training
    //     $filteredData = array_filter($data, function ($row) {
    //         return !in_array(null, $row, true);
    //     });

    //     // Extract features (excluding the first column which is the movie ID)
    //     $samples = array_map(function ($row) {
    //         return array_slice($row, 1);
    //     }, $filteredData);

    //     // Implement K-Means clustering
    //     $kmeans = new KMeans(10);
    //     $clusters = $kmeans->cluster($samples);

    //     // Collect movie IDs from clusters
    //     $recommendedMovieIds = [];
    //     foreach ($clusters as $cluster) {
    //         foreach ($cluster as $sample) {
    //             $index = array_search($sample, $samples);
    //             if ($index !== false) {
    //                 $recommendedMovieIds[] = $filteredData[$index][0];
    //             }
    //         }
    //     }

    //     // Ensure we recommend at least 10 unique movies
    //     $recommendedMovieIds = array_unique($recommendedMovieIds);
    //     $numRecommendations = 10;
    //     if (count($recommendedMovieIds) < $numRecommendations) {
    //         $additionalMovies = Movie::inRandomOrder()->take($numRecommendations - count($recommendedMovieIds))->pluck('id')->toArray();
    //         $recommendedMovieIds = array_merge($recommendedMovieIds, $additionalMovies);
    //     }

    //     return $recommendedMovieIds;
    // }

    // private function getCollaborativeRecommendations($user)
    // {
    //     // Get user-item rating matrix
    //     $ratings = DB::table('watch_movies')
    //         ->select('user_id', 'movie_id', 'rating')
    //         ->get();

    //     // Create rating matrix
    //     $ratingMatrix = [];
    //     foreach ($ratings as $rating) {
    //         $ratingMatrix[$rating->user_id][$rating->movie_id] = $rating->rating;
    //     }

    //     // Calculate cosine similarity
    //     $similarity = [];
    //     $userRatings = $ratingMatrix[$user->id] ?? [];
    //     if (empty($userRatings)) {
    //         return [];
    //     }
    //     foreach ($ratingMatrix as $other_user_id => $other_user_ratings) {
    //         if ($other_user_id != $user->id) {
    //             $similarity[$other_user_id] = $this->cosineSimilarity($userRatings, $other_user_ratings);
    //         }
    //     }

    //     arsort($similarity);
    //     // Get the most similar user's ID
    //     $topUsers = array_keys(array_slice($similarity, 0, 1, true));
    //     $top_id = $topUsers[0];

    //     // Get recommended movies
    //     $recommendedMovieIds = [];
    //     $watch = WatchMovie::where('user_id', '=', $top_id)->get();
    //     foreach ($watch as $w) {
    //         $recommendedMovieIds[] = $w->movie_id;
    //     }

    //     return $recommendedMovieIds;
    // }

    // private function cosineSimilarity($vec1, $vec2)
    // {
    //     $dotProduct = 0.0;
    //     $normA = 0.0;
    //     $normB = 0.0;

    //     foreach ($vec1 as $key => $value) {
    //         $dotProduct += $value * ($vec2[$key] ?? 0);
    //         $normA += pow($value, 2);
    //     }

    //     foreach ($vec2 as $value) {
    //         $normB += pow($value, 2);
    //     }

    //     if ($normA == 0.0 || $normB == 0.0) {
    //         return 0.0;
    //     }

    //     return $dotProduct / (sqrt($normA) * sqrt($normB));
    // }

    public function hybridRecommendations()
    {
        $user = Auth::user();
        $watchedMovies = WatchMovie::where('user_id', $user->id)->pluck('movie_id')->toArray();
        $recommendedMoviesDetails = $this->getRecommendations($user, $watchedMovies);

        // Prioritize and sort recommendations
        $finalRecommendations = $this->prioritizeRecommendations($recommendedMoviesDetails, $watchedMovies);

        // Fetch remaining movies not recommended by any method
        $remainingMovieIds = array_diff(Movie::pluck('id')->toArray(), array_keys($finalRecommendations));
        foreach ($remainingMovieIds as $movieId) {
            if (!in_array($movieId, $watchedMovies)) {
                $movie = Movie::find($movieId);
                if ($movie) {
                    $movie->weighted_score = 0; // Assign weight 0 to non-recommended movies
                    $finalRecommendations[$movieId] = $movie;
                }
            }
        }

        // Apply PageRank to adjust scores
        $this->applyPageRank($finalRecommendations, $this->buildMovieGraph());

        // Sort recommendations by weighted score in descending order
        uasort($finalRecommendations, fn($a, $b) => $b->weighted_score <=> $a->weighted_score);

        if (empty($finalRecommendations)) {
            return redirect()->route('user.dashboard')->with('error', 'Sorry, no recommendations available.');
        }

        return view('pages.recom4', [
            'watchedMovies' => Movie::findMany($watchedMovies), // Fetch watched movies
            'recommendedMovies' => $finalRecommendations,
            'recommendationTypes' => $recommendedMoviesDetails,
        ]);
    }

    private function getRecommendations($user, $watchedMovies)
    {
        $recommendedMoviesDetails = [];

        // Content-Based Recommendation
        $contentBasedMovies = $this->contentBasedRecommendations($user, $watchedMovies);
        $recommendedMoviesDetails['content_based'] = $contentBasedMovies;

        // Collaborative Filtering
        $collaborativeMovies = $this->collaborativeFilteringRecommendations($user, $watchedMovies);
        $recommendedMoviesDetails['collaborative'] = $collaborativeMovies;

        // Demographic Recommendations
        $demographicMovies = $this->demographicRecommendations($user, $watchedMovies);
        $recommendedMoviesDetails['demographic'] = $demographicMovies;

        return $recommendedMoviesDetails;
    }

    private function contentBasedRecommendations($user, $watchedMovies)
    {
        // Get user's interest data
        $interestData = Interest::where('user_id', $user->id)->first();
        if (!$interestData) {
            return [];
        }

        // Get 2D array of movie features
        $data = $this->data2DArrayAll();

        // Dynamic number of clusters based on data size
        $numClusters = min(15, max(5, intdiv(count($data), 10))); // Adjust clusters based on dataset size

        // Perform K-Means clustering
        $clusters = $this->KmeansControl($numClusters, $data);

        $recommendedMovies = [];

        // Gather movies from clusters
        foreach ($clusters[0] as $movieId) {
            if (!in_array($movieId, $watchedMovies)) {
                $recommendedMovies[$movieId] = Movie::find($movieId);
            }
        }

        // Add more similar movies based on additional criteria
        $similarMovies = $this->getAdditionalSimilarMovies($recommendedMovies, $watchedMovies);

        // Merge additional similar movies with initial recommendations
        $recommendedMovies = array_merge($recommendedMovies, $similarMovies);

        // Limit the number of recommendations to avoid excessive results
        $recommendedMovies = array_slice($recommendedMovies, 0, 50, true);
        //unique
        //$recommendedMovies = array_unique($recommendedMovies, SORT_REGULAR);

        return $recommendedMovies;
    }

    private function getAdditionalSimilarMovies($recommendedMovies, $watchedMovies)
    {
        $similarMovies = [];
        $moviesWithSimilarGenres = collect();
        $moviesWithSimilarCasts = collect();
        $moviesWithSimilarDirectors = collect();
        $moviesWithSimilarCountries = collect();
        $moviesWithSimilarLanguages = collect();
        $moviesWithSimilarPcompanies = collect();

        // Loop through each recommended movie to find similar movies
        foreach ($recommendedMovies as $movie) {
            if ($movie) {
                // Get movies with similar casts
                $moviesWithSimilarCasts = Movie::whereHas('MovieCast', function ($query) use ($movie) {
                    $query->whereIn('cast_id', $movie->MovieCast->pluck('cast_id'));
                })->whereNotIn('id', array_merge([$movie->id], $watchedMovies))->limit(5)->get();

                // Get movies with similar directors
                $moviesWithSimilarDirectors = Movie::whereHas('MovieDirector', function ($query) use ($movie) {
                    $query->whereIn('director_id', $movie->MovieDirector->pluck('director_id'));
                })->whereNotIn('id', array_merge([$movie->id], $watchedMovies))->limit(5)->get();

                // Get movies with similar countries
                $moviesWithSimilarCountries = Movie::whereHas('MovieCountry', function ($query) use ($movie) {
                    $query->whereIn('country_id', $movie->MovieCountry->pluck('country_id'));
                })->whereNotIn('id', array_merge([$movie->id], $watchedMovies))->limit(5)->get();

                // Get movies with similar languages
                $moviesWithSimilarLanguages = Movie::whereHas('MovieLanguage', function ($query) use ($movie) {
                    $query->whereIn('language_id', $movie->MovieLanguage->pluck('language_id'));
                })->whereNotIn('id', array_merge([$movie->id], $watchedMovies))->limit(5)->get();

                // Get movies with similar production companies
                $moviesWithSimilarPcompanies = Movie::whereHas('MoviePcompany', function ($query) use ($movie) {
                    $query->whereIn('pcompany_id', $movie->MoviePcompany->pluck('pcompany_id'));
                })->whereNotIn('id', array_merge([$movie->id], $watchedMovies))->limit(5)->get();

                // Merge all similar movies
                $allSimilarMovies = $moviesWithSimilarGenres
                    ->merge($moviesWithSimilarCasts)
                    ->merge($moviesWithSimilarDirectors)
                    ->merge($moviesWithSimilarCountries)
                    ->merge($moviesWithSimilarLanguages)
                    ->merge($moviesWithSimilarPcompanies);

                // Add similar movies to recommendations
                foreach ($allSimilarMovies as $similarMovie) {
                    $similarMovies[$similarMovie->id] = $similarMovie;
                }
            }
        }

        return $similarMovies;
    }

    private function collaborativeFilteringRecommendations($user, $watchedMovies)
    {
        $ratings = DB::table('watch_movies')->select('user_id', 'movie_id', 'rating')->get();
        $ratingMatrix = $this->createRatingMatrix($ratings);
        $userRatings = $ratingMatrix[$user->id] ?? [];

        if (empty($userRatings)) {
            return [];
        }

        $similarityScores = $this->calculateSimilarities($userRatings, $ratingMatrix);
        $topUsers = array_keys(array_slice($similarityScores, 0, 1, true));

        $recommendedMovies = [];
        foreach ($topUsers as $topUserId) {
            $watchedMoviesByTopUser = WatchMovie::where('user_id', $topUserId)->pluck('movie_id')->toArray();
            foreach ($watchedMoviesByTopUser as $movieId) {
                if (!in_array($movieId, $watchedMovies)) {
                    $recommendedMovies[$movieId] = Movie::find($movieId);
                }
            }
        }

        return $recommendedMovies;
    }

    private function demographicRecommendations($user, $watchedMovies)
    {
        $userCluster = Cluster::where('user_id', $user->id)->first();
        if (!$userCluster) {
            return [];
        }

        $clusterUsers = Cluster::where('cluster', $userCluster->cluster)
            ->where('user_id', '!=', $user->id)
            ->pluck('user_id')
            ->toArray();

        $recommendedMovies = [];
        foreach ($clusterUsers as $clusterUserId) {
            $watchedMoviesByClusterUser = WatchMovie::where('user_id', $clusterUserId)->pluck('movie_id')->toArray();
            foreach ($watchedMoviesByClusterUser as $movieId) {
                if (!in_array($movieId, $watchedMovies)) {
                    $recommendedMovies[$movieId] = Movie::find($movieId);
                }
            }
        }

        return $recommendedMovies;
    }

    private function createRatingMatrix($ratings)
    {
        $ratingMatrix = [];
        foreach ($ratings as $rating) {
            $ratingMatrix[$rating->user_id][$rating->movie_id] = $rating->rating;
        }
        return $ratingMatrix;
    }

    private function calculateSimilarities($userRatings, $ratingMatrix)
    {
        $similarity = [];
        foreach ($ratingMatrix as $otherUserId => $otherUserRatings) {
            if ($otherUserId != Auth::id()) {
                $similarity[$otherUserId] = $this->cosineSimilarity($userRatings, $otherUserRatings);
            }
        }
        arsort($similarity);
        return $similarity;
    }

    private function prioritizeRecommendations($recommendedMoviesDetails, $watchedMovies)
    {
        $finalRecommendations = [];
        $weights = [
            'content_based' => 0.8,
            'collaborative' => 0.5,
            'demographic' => 0.3,
        ];

        foreach ($recommendedMoviesDetails as $type => $movies) {
            foreach ($movies as $movie) {
                if (!in_array($movie->id, $watchedMovies)) {
                    $isInContentBased = isset($recommendedMoviesDetails['content_based'][$movie->id]);
                    $isInCollaborative = isset($recommendedMoviesDetails['collaborative'][$movie->id]);

                    if ($isInContentBased && $isInCollaborative) {
                        $movie->weighted_score += 1; // Set weight to 1 if both conditions are met
                    } else {
                        // Add weight based on the recommendation type
                        $movie->weighted_score += $weights[$type];
                    }
                    $finalRecommendations[$movie->id] = $movie;
                }
            }
        }

        return $finalRecommendations;
    }

    private function buildMovieGraph()
    {
        $ratings = DB::table('watch_movies')->select('user_id', 'movie_id', 'rating')->get();
        $graph = [];
        foreach ($ratings as $rating) {
            foreach ($ratings as $otherRating) {
                if ($rating->movie_id != $otherRating->movie_id && abs($rating->user_id - $otherRating->user_id) <= 1) {
                    $graph[$rating->movie_id][$otherRating->movie_id] = 1; // Create edge between movies
                }
            }
        }
        return $graph;
    }

    private function pageRank($graph, $d = 0.85, $maxIterations = 100, $tol = 0.0001)
    {
        $numMovies = count($graph);
        $pageRank = array_fill_keys(array_keys($graph), 1 / $numMovies);
        $newPageRank = [];

        for ($i = 0; $i < $maxIterations; $i++) {
            foreach ($graph as $movieId => $edges) {
                $newPageRank[$movieId] = (1 - $d) / $numMovies;
                foreach ($edges as $outgoingMovieId => $weight) {
                    $outgoingLinksCount = count($graph[$outgoingMovieId]);
                    $newPageRank[$movieId] += $d * ($pageRank[$outgoingMovieId] / $outgoingLinksCount);
                }
            }

            // Check for convergence
            $diff = 0;
            foreach ($pageRank as $movieId => $rank) {
                $diff += abs($newPageRank[$movieId] - $rank);
            }
            if ($diff < $tol) {
                break;
            }
            $pageRank = $newPageRank;
        }

        return $pageRank;
    }

    private function applyPageRank(&$movies, $graph)
    {
        $pageRankScores = $this->pageRank($graph);
        foreach ($movies as $movie) {
            $pageRankScore = $pageRankScores[$movie->id] ?? 0;
            //random value between 0.01 and 0.03
            if ($movie->weighted_score == 1) {
                $tem = mt_rand(90, 99) / 1000;
                $pageRankScore = $tem;
            }
            if ($pageRankScore == 0) {
                if ($movie->weighted_score == 0.8) {
                    $tem = mt_rand(80, 89) / 1000;
                    $pageRankScore = $tem;
                } else if ($movie->weighted_score == 0.5) {
                    $tem = mt_rand(70, 79) / 1000;
                    $pageRankScore = $tem;
                } else if ($movie->weighted_score == 0.3) {
                    $tem = mt_rand(60, 69) / 1000;
                    $pageRankScore = $tem;
                }
            }
            $pageRankScores[$movie->id] = $pageRankScore;
            $movie->weighted_score *= $pageRankScore;
        }
    }

    private function cosineSimilarity($vec1, $vec2)
    {
        $dotProduct = 0.0;
        $normA = 0.0;
        $normB = 0.0;

        foreach ($vec1 as $key => $value) {
            $dotProduct += $value * ($vec2[$key] ?? 0);
            $normA += $value * $value;
        }

        foreach ($vec2 as $value) {
            $normB += $value * $value;
        }

        return ($normA && $normB) ? ($dotProduct / (sqrt($normA) * sqrt($normB))) : 0.0;
    }


    public function recommendationDetails()
    {
        $user = Auth::user();
        $watchedMovies = WatchMovie::where('user_id', $user->id)->pluck('movie_id')->toArray();
        $recommendedMoviesDetails = $this->getHybridRecommendations($user, $watchedMovies);

        // Separate recommendations by category
        $collaborativeUsers = $recommendedMoviesDetails['collaborative'] ?? [];
        $contentBasedUsers = $recommendedMoviesDetails['content_based'] ?? [];
        $demographicUsers = $recommendedMoviesDetails['demographic'] ?? [];

        // Find movies recommended by both collaborative and content-based methods
        $bothCollaborativeAndContent = array_intersect_key($collaborativeUsers, $contentBasedUsers);
        $bothCollaborativeAndContent = $this->uniqueMovies($bothCollaborativeAndContent);

        // Refine the demographic recommendations by excluding overlaps
        $interestedMovies = array_diff_key($demographicUsers, $bothCollaborativeAndContent, $collaborativeUsers, $contentBasedUsers);
        $interestedMovies = $this->uniqueMovies($interestedMovies);

        // Calculate initial weighted scores for movies
        $initialWeightedScores = $this->calculateWeightedScores($recommendedMoviesDetails);
        $initialWeightedScores = $this->uniqueMovies($initialWeightedScores);

        // Calculate PageRank scores for movies
        $movieGraph = $this->buildMovieGraph();  // Generate the movie graph
        $pageRankScores = $this->pageRank($movieGraph);

        // Adjust weights by applying PageRank
        $finalWeightedScores = $this->applyPageRankToWeights($initialWeightedScores, $pageRankScores);
        $finalWeightedScores = $this->uniqueMovies($finalWeightedScores);

        return view('pages.recommendation_details', [
            'cosineSimilarityMatrix' => $recommendedMoviesDetails['similarity'] ?? [],
            'bothCollaborativeAndContent' => $bothCollaborativeAndContent,
            'collaborativeUsers' => $this->uniqueMovies($collaborativeUsers),
            'contentBasedUsers' => $this->uniqueMovies($contentBasedUsers),
            'interestedMovies' => $interestedMovies,
            'pageRankScores' => $pageRankScores,
            'initialWeightedScores' => $initialWeightedScores,
            'finalWeightedScores' => $finalWeightedScores,
        ]);
    }

    // Function to ensure unique movies in an array
    private function uniqueMovies($movies)
    {
        // Ensure movies are unique based on movie ID
        $uniqueMovies = [];
        foreach ($movies as $movie) {
            if (is_object($movie) && !isset($uniqueMovies[$movie->id])) {
                $uniqueMovies[$movie->id] = $movie;
            }
        }

        return $uniqueMovies;
    }


    private function applyPageRankToWeights($initialWeightedScores, &$pageRankScores)
    {
        foreach ($initialWeightedScores as $movieId => $movie) {
            $pageRankScore = $pageRankScores[$movieId] ?? 0;
            //random value between 0.015 and 0.021
            if ($movie->weighted_score == 1) {
                $tem = mt_rand(90, 99) / 1000;
                $pageRankScore = $tem;
            }
            if ($pageRankScore == 0) {
                if ($movie->weighted_score == 0.8) {
                    $tem = mt_rand(80, 89) / 1000;
                    $pageRankScore = $tem;
                } else if ($movie->weighted_score == 0.5) {
                    $tem = mt_rand(70, 79) / 1000;
                    $pageRankScore = $tem;
                } else if ($movie->weighted_score == 0.3) {
                    $tem = mt_rand(60, 69) / 1000;
                    $pageRankScore = $tem;
                }
            }
            $pageRankScores[$movieId] = $pageRankScore;
            $movie->final_weighted_score = $movie->weighted_score * $pageRankScore; // Apply PageRank
        }

        // Sort movies by final weighted score in descending order
        uasort($initialWeightedScores, function ($a, $b) {
            return $b->final_weighted_score <=> $a->final_weighted_score;
        });

        return $initialWeightedScores;
    }

    private function calculateSimilarityMatrix($user)
    {
        // Fetch all ratings from the database
        $ratings = DB::table('watch_movies')->select('user_id', 'movie_id', 'rating')->get();

        // Create the rating matrix
        $ratingMatrix = $this->createRatingMatrix($ratings);

        // Get user ratings
        $userRatings = $ratingMatrix[$user->id] ?? [];

        // Calculate cosine similarity with other users
        $similarities = $this->calculateSimilarities($userRatings, $ratingMatrix);

        return $similarities;
    }

    private function getHybridRecommendations($user, $watchedMovies)
    {
        $recommendedMoviesDetails = [];

        // 1. Content-Based Recommendations
        $contentBasedMovies = $this->contentBasedRecommendations($user, $watchedMovies);
        $recommendedMoviesDetails['content_based'] = $contentBasedMovies;

        // 2. Collaborative Filtering Recommendations
        $collaborativeMovies = $this->collaborativeFilteringRecommendations($user, $watchedMovies);
        $recommendedMoviesDetails['collaborative'] = $collaborativeMovies;

        // 3. Demographic Recommendations
        $demographicMovies = $this->demographicRecommendations($user, $watchedMovies);
        $recommendedMoviesDetails['demographic'] = $demographicMovies;

        // 4. Cosine Similarity Calculation
        $recommendedMoviesDetails['similarity'] = $this->calculateSimilarityMatrix($user);

        return $recommendedMoviesDetails;
    }

    private function calculateWeightedScores($recommendedMoviesDetails)
    {
        $weights = [
            'content_based' => 0.8,
            'collaborative' => 0.5,
            'demographic' => 0.3,
        ];

        $finalRecommendations = [];

        foreach ($recommendedMoviesDetails as $type => $movies) {
            if ($type === 'similarity') {
                continue; // Skip the 'similarity' key
            }

            foreach ($movies as $movie) {
                // Check if the movie is recommended by both content-based and collaborative filtering
                $isInContentBased = isset($recommendedMoviesDetails['content_based'][$movie->id]);
                $isInCollaborative = isset($recommendedMoviesDetails['collaborative'][$movie->id]);

                if ($isInContentBased && $isInCollaborative) {
                    $movie->weighted_score += 1; // Set weight to 1 if both conditions are met
                } else {
                    // Add weight based on the recommendation type
                    $movie->weighted_score += $weights[$type];
                }
                $finalRecommendations[$movie->id] = $movie;
            }
        }
        return $finalRecommendations;
    }


    private function calculatePageRank($recommendedMoviesDetails)
    {
        $graph = $this->buildMovieGraph($recommendedMoviesDetails);
        return $this->pageRank($graph);
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
        $movie = 0;
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
