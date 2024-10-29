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

    public function hybridRecommendations()
    {
        $user = Auth::user();
        $watchedMovies = WatchMovie::where('user_id', $user->id)->pluck('movie_id')->toArray();
        $recommendedMoviesDetails = $this->getRecommendations($user, $watchedMovies);
        $contentBasedMovie = $recommendedMoviesDetails['content_based'];
        $collaborativeMovie = $recommendedMoviesDetails['collaborative'];
        $likesCollaborativeMovie = $recommendedMoviesDetails['collaborative_likes'];
        $demographicMovies = $recommendedMoviesDetails['demographic'];

        // Apply union for bothCollaborativeAndLikes
        $bothCollaborativeAndLikes = array_merge($collaborativeMovie, $likesCollaborativeMovie);

        // dd($bothCollaborativeAndLikes);

        // Find the union of content-based and bothCollaborativeAndLikes
        $bothCollaborativeAndContent = array_intersect_key($contentBasedMovie, $bothCollaborativeAndLikes);
        //dd($bothCollaborativeAndContent);

        // Prioritize and sort recommendations
        $finalRecommendations = $this->prioritizeRecommendations($recommendedMoviesDetails, $watchedMovies);
        $finalRecommendations = $this->uniqueMovies($finalRecommendations);

        // Fetch disliked recommendations
        $dislikeRecommendMovies = $this->filterDislikedGenres($finalRecommendations, $user);
        //dd($dislikeRecommendMovies);

        // Fetch remaining movies not recommended by any method
        $remainingMovieIds = array_diff(Movie::pluck('id')->toArray(), array_keys($finalRecommendations));
        foreach ($remainingMovieIds as $movieId) {
            if (!in_array($movieId, $watchedMovies)) {
                $movie = Movie::find($movieId);
                if ($movie) {
                    $movie->weighted_score = 0.1; // Assign weight 0 to non-recommended movies
                    $finalRecommendations[$movieId] = $movie;
                }
            }
        }

        // Update weighted score for disliked movies
        foreach ($dislikeRecommendMovies as $movie) {
            $movie->weighted_score = 0.0;
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
            'bothCollaborativeAndContent' => $bothCollaborativeAndContent,
            'bothCollaborativeAndLikes' => $bothCollaborativeAndLikes,
            'contentBasedMovies' => $contentBasedMovie,
            'collaborativeMovies' => $collaborativeMovie,
            'likesCollaborativeMovies' => $likesCollaborativeMovie,
            'demographicMovies' => $demographicMovies,
            'dislikeRecommendMovies' => $dislikeRecommendMovies,
            'recommendationTypes' => [
                'bothCollaborativeAndContent',
                'content_based',
                'collaborative',
                'collaborative_likes',
                'bothCollaborativeAndLikes',
                'demographic',
                'dislike_recommend'
            ],
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

        // Collaborative Filtering based on likes
        $likesCollaborativeMovies = $this->collaborativeFilteringByLikes($user, $watchedMovies);
        $recommendedMoviesDetails['collaborative_likes'] = $likesCollaborativeMovies;

        // Demographic Recommendations
        $demographicMovies = $this->demographicRecommendations($user, $watchedMovies);
        $recommendedMoviesDetails['demographic'] = $demographicMovies;

        return $recommendedMoviesDetails;
    }
    private function filterDislikedGenres($recommendedMovies, $user)
    {
        // Fetch disliked genres by the user
        $dislikedGenres = DB::table('movies')
            ->join('movie_likes', 'movies.id', '=', 'movie_likes.movie_id')
            ->join('movie_genres', 'movies.id', '=', 'movie_genres.movie_id')
            ->where('movie_likes.user_id', $user->id)
            ->where('movie_likes.like', 0) // Disliked movies
            ->pluck('movie_genres.genre_id')
            ->toArray();

        // Fetch disliked casts by the user
        $dislikedCasts = DB::table('movies')
            ->join('movie_likes', 'movies.id', '=', 'movie_likes.movie_id')
            ->join('movie_casts', 'movies.id', '=', 'movie_casts.movie_id')
            ->where('movie_likes.user_id', $user->id)
            ->where('movie_likes.like', 0) // Disliked movies
            ->pluck('movie_casts.cast_id')
            ->toArray();

        // Initialize an array for storing movies with disliked genres or casts
        $dislikeRecommendMovies = [];

        // Check each recommended movie for disliked genres or casts
        foreach ($recommendedMovies as $movie) {
            //$hasDislikedGenre = $movie->MovieGenre->pluck('genre_id')->intersect($dislikedGenres)->isNotEmpty();
            $hasDislikedCast = $movie->MovieCast->pluck('cast_id')->intersect($dislikedCasts)->isNotEmpty();

            // If the movie contains a disliked genre or cast, add it to the list
            if ($hasDislikedCast) {
                $dislikeRecommendMovies[$movie->id] = $movie;
            }
        }

        return $dislikeRecommendMovies;
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

    private function collaborativeFilteringByLikes($user, $watchedMovies)
    {
        // Fetch likes/dislikes data from the database
        $likesData = DB::table('movie_likes')->select('user_id', 'movie_id', 'like')->get();

        // Create the likes matrix
        $likesMatrix = $this->createLikesMatrix($likesData);

        // Get user likes/dislikes
        $userLikes = $likesMatrix[$user->id] ?? [];

        // Return an empty array if no likes/dislikes are found for the user
        if (empty($userLikes)) {
            return [];
        }

        // Calculate cosine similarity with other users based on likes
        $similarityScores = $this->calculateSimilarities($userLikes, $likesMatrix);

        // Find the top similar users
        $topUsers = array_keys(array_slice($similarityScores, 0, 1, true));

        $recommendedMovies = [];
        foreach ($topUsers as $topUserId) {
            $likedMoviesByTopUser = DB::table('movie_likes')
                ->where('user_id', $topUserId)
                ->where('like', 1) // Only consider liked movies
                ->pluck('movie_id')
                ->toArray();

            foreach ($likedMoviesByTopUser as $movieId) {
                if (!in_array($movieId, $watchedMovies)) {
                    $recommendedMovies[$movieId] = Movie::find($movieId);
                }
            }
        }

        return $recommendedMovies;
    }

    private function createLikesMatrix($likesData)
    {
        $likesMatrix = [];
        foreach ($likesData as $like) {
            $likesMatrix[$like->user_id][$like->movie_id] = $like->like ? 1 : -1;
        }
        return $likesMatrix;
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
            'collaborative_likes' => 0.5,
            'demographic' => 0.3,
        ];
        $collab = $recommendedMoviesDetails['collaborative'] ?? [];
        $likesCol = $recommendedMoviesDetails['collaborative_likes'] ?? [];
        $content = $recommendedMoviesDetails['content_based'] ?? [];

        $bothColla = array_merge($collab, $likesCol);
        $temMovie = array_intersect_key($content, $bothColla);

        foreach ($recommendedMoviesDetails as $type => $movies) {
            foreach ($movies as $movie) {
                if (!in_array($movie->id, $watchedMovies)) {

                    if (isset($temMovie[$movie->id])) {
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

    public function view10($filter)
    {
        $user = Auth::user();
        $watchedMovies = WatchMovie::where('user_id', $user->id)->pluck('movie_id')->toArray();
        $recommendedMoviesDetails = $this->getRecommendations($user, $watchedMovies);
        $contentBasedMovie = $recommendedMoviesDetails['content_based'];
        $collaborativeMovie = $recommendedMoviesDetails['collaborative'];
        $likesCollaborativeMovie = $recommendedMoviesDetails['collaborative_likes'];
        $demographicMovies = $recommendedMoviesDetails['demographic'];

        // Apply union for bothCollaborativeAndLikes
        $bothCollaborativeAndLikes = array_merge($collaborativeMovie, $likesCollaborativeMovie);

        // dd($bothCollaborativeAndLikes);

        // Find the union of content-based and bothCollaborativeAndLikes
        $bothCollaborativeAndContent = array_intersect_key($contentBasedMovie, $bothCollaborativeAndLikes);
        //dd($bothCollaborativeAndContent);

        // Prioritize and sort recommendations
        $finalRecommendations = $this->prioritizeRecommendations($recommendedMoviesDetails, $watchedMovies);
        $finalRecommendations = $this->uniqueMovies($finalRecommendations);

        // Fetch disliked recommendations
        $dislikeRecommendMovies = $this->filterDislikedGenres($finalRecommendations, $user);
        //dd($dislikeRecommendMovies);
        $recommendedMovies = [];
        switch ($filter) {
            case 'content_based':
                $recommendedMovies = $this->uniqueMovies($contentBasedMovie);
                break;
            case 'collaborative':
                $recommendedMovies = $this->uniqueMovies($collaborativeMovie);
                break;
            case 'collaborative_likes':
                $recommendedMovies = $this->uniqueMovies($likesCollaborativeMovie);
                break;
            case 'demographic':
                $recommendedMovies = $this->uniqueMovies($demographicMovies);
                break;
            case 'bothCollaborativeAndContent':
                $recommendedMovies = $this->uniqueMovies($bothCollaborativeAndContent);
                break;
            case 'bothCollaborativeAndLikes':
                $recommendedMovies = $this->uniqueMovies($bothCollaborativeAndLikes);
                break;
            case 'dislike_recommend':
                $recommendedMovies = $this->uniqueMovies($dislikeRecommendMovies);
                break;
            default:
                $recommendedMovies = $this->uniqueMovies($finalRecommendations);
        }
        return view('pages.recom4', ['recommendedMovies' => $recommendedMovies, 'watchedMovies' => Movie::findMany($watchedMovies), 'filter' => $filter]);
    }


    public function recommendationDetails()
    {
        $user = Auth::user();
        $watchedMovies = WatchMovie::where('user_id', $user->id)->pluck('movie_id')->toArray();
        $recommendedMoviesDetails = $this->getHybridRecommendations($user, $watchedMovies);

        // Separate recommendations by category
        $collaborativeUsers = $recommendedMoviesDetails['collaborative'] ?? [];
        $likesCollaborativeMovie = $recommendedMoviesDetails['collaborative_likes'] ?? [];
        $contentBasedUsers = $recommendedMoviesDetails['content_based'] ?? [];
        $demographicUsers = $recommendedMoviesDetails['demographic'] ?? [];

        $bothCollaborativeAndLikes = array_merge($collaborativeUsers, $likesCollaborativeMovie);

        // Find movies recommended by both collaborative and content-based methods
        $bothCollaborativeAndContent = array_intersect_key($bothCollaborativeAndLikes, $contentBasedUsers);
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
            'collaborativeUsers' => $this->uniqueMovies($bothCollaborativeAndLikes),
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
        $collab = $recommendedMoviesDetails['collaborative'] ?? [];
        $likesCol = $recommendedMoviesDetails['collaborative_likes'] ?? [];
        $content = $recommendedMoviesDetails['content_based'] ?? [];

        $bothColla = array_merge($collab, $likesCol);
        $temMovie = array_intersect_key($content, $bothColla);
        //dd($temMovie);

        foreach ($recommendedMoviesDetails as $type => $movies) {
            if ($type === 'similarity') {
                continue; // Skip the 'similarity' key
            }
            foreach ($movies as $movie) {
                // Check if the movie is recommended by both content-based and collaborative filtering
                if (isset($temMovie[$movie->id])) {
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
