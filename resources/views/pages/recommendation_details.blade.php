@section('title', 'Movie')
@include('../layouts/homeHeader')

<div class="container mt-5">
    <div class="container-xl">
        <div class="row text-center">
            <div class="col-md-12">
                <h3 class="mb-0">Recommendation Details</h3>
                <hr class="line">
            </div>
        </div>

        <!-- Cosine Similarity Matrix Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="h5 mb-0">Cosine Similarity Matrix</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>Cosine Similarity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @if (!empty($cosineSimilarityMatrix))
                                @foreach($cosineSimilarityMatrix as $userId => $similarity)
                                    @php $user = App\Models\User::find($userId); @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ number_format($similarity, 4) }}</td>
                                    </tr>
                                    @php $i++; @endphp
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="text-center">No data available</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Combined Score Table: Initial Weights, PageRank, and Final Weights -->
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="h5 mb-0">Movie Scores Overview</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Movie Title</th>
                                <th>Initial Weighted Score</th>
                                <th>PageRank Score</th>
                                <th>Final Weighted Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @if (!empty($finalWeightedScores))
                                @foreach($finalWeightedScores as $movie)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td><a href="{{ route('movie.show', $movie->id) }}">{{ $movie->title }}</a></td>
                                        <td>{{ number_format($movie->weighted_score, 4) }}</td>
                                        <td>{{ number_format($pageRankScores[$movie->id] ?? 0, 4) }}</td>
                                        <td>{{ number_format($movie->final_weighted_score ?? 0, 4) }}</td>
                                    </tr>
                                    @php $i++; @endphp
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">No movie scores available</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- Movies Recommended by Both Collaborative and Content-Based Methods -->
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="h5 mb-0">Movies Recommended by Both Collaborative and Content-Based Methods</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Movie Title</th>
                                <th>Movie Poster</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($bothCollaborativeAndContent as $movie)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td><a href="{{ route('movie.show', $movie->id) }}">{{ $movie->title }}</a></td>
                                    <td>
                                        <img src="{{ $movie->photo ? asset('storage/'.$movie->photo) : asset('images/default_poster.jpg') }}" class="movie-poster" alt="{{ $movie->title }}">
                                    </td>
                                </tr>
                                @php $i++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Collaborative Users Watched Movies Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="h5 mb-0">Movies Recommended by Collaborative Methods</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Movie Title</th>
                                <th>Movie Poster</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($collaborativeUsers as $movie)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td><a href="{{ route('movie.show', $movie->id) }}">{{ $movie->title }}</a></td>
                                    <td>
                                        <img src="{{ $movie->photo ? asset('storage/'.$movie->photo) : asset('images/default_poster.jpg') }}" class="movie-poster" alt="{{ $movie->title }}">
                                    </td>
                                </tr>
                                @php $i++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Content-Based Users Watched Movies Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="h5 mb-0">Movies Recommended by Content-Based Methods</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Movie Title</th>
                                <th>Movie Poster</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($contentBasedUsers as $movie)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td><a href="{{ route('movie.show', $movie->id) }}">{{ $movie->title }}</a></td>
                                    <td>
                                        <img src="{{ $movie->photo ? asset('storage/'.$movie->photo) : asset('images/default_poster.jpg') }}" class="movie-poster" alt="{{ $movie->title }}">
                                    </td>
                                </tr>
                                @php $i++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Interested Movies Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="h5 mb-0">Movies You Might Like</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Movie Title</th>
                                <th>Movie Poster</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($interestedMovies as $movie)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td><a href="{{ route('movie.show', $movie->id) }}">{{ $movie->title }}</a></td>
                                    <td>
                                        <img src="{{ $movie->photo ? asset('storage/'.$movie->photo) : asset('images/default_poster.jpg') }}" class="movie-poster" alt="{{ $movie->title }}">
                                    </td>
                                </tr>
                                @php $i++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom styles for the recommendation details page */
    h1 {
        font-weight: bold;
        color: #343a40;
    }
    .line {
        width: 60px;
        height: 4px;
        background-color: #6c757d;
        margin: 10px auto 20px;
    }
    .card-header {
        background-color: #000000;
        text-align: center;
        font-size: 24px;
        color: white;
        padding: 20px 0;
    }
    .thead-dark th {
        background-color: #343a40;
        color: white;
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f8f9fa;
    }
    .movie-poster {
        max-width: 60px;
    }
    img {
        border-radius: 5px;
    }
</style>