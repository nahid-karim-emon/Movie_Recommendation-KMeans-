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
    <div class="card mb-4">
        <div class="card-header">
            <h2 class="h5 mb-0">Cosine Similarity Matrix</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>User ID</th>
                            <th>Cosine Similarity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($cosineSimilarityMatrix))
                            @foreach($cosineSimilarityMatrix as $userId1 => $similarities)
                                <tr>
                                    <td>{{ $userId1 }}</td>
                                    <td>{{ number_format($cosineSimilarityMatrix[$userId1], 4) }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h2 class="h5 mb-0">Collaborative Users watched_movies</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>User ID</th>
                            <th>Movie ID</th>
                            <th>Movie Title</th>
                            <th>Movie Poster</th>
                            <th>Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($collaborativeUsers as $collabUser)
                            @foreach($collabUser['ratings'] as $movieId => $rating)
                                @php
                                    $movie = \App\Models\Movie::find($movieId); // Assuming Movie model exists
                                @endphp
                                @if($movie)
                                    <tr>
                                        <td>{{ $collabUser['user_id'] }}</td>
                                        <td>{{ $movie->id }}</td>
                                        <td><a href="{{ route('movie.show', $movie->id) }}">{{ $movie->title }}</a></td>
                                        <td>
                                            <img src="{{ $movie->photo ? asset('storage/'.$movie->photo) : asset('images/default_poster.jpg') }}" class="movie-poster" alt="{{ $movie->title }}">
                                        </td>
                                        <td>{{ $rating }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h2 class="h5 mb-0">Content-Based Users Watched Movies</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>User ID</th>
                            <th>Movie Title</th>
                            <th>Movie Poster</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clusterUsers as $clusterUser)
                            @foreach($clusterUser['watched_movies'] as $watchedMovieId)
                                @php
                                    $watchedMovie = \App\Models\Movie::find($watchedMovieId); // Assuming Movie model exists
                                @endphp
                                @if($watchedMovie)
                                    <tr>
                                        <td>{{ $clusterUser['user_id'] }}</td>
                                        <td><a href="{{ route('movie.show', $watchedMovie->id) }}">{{ $watchedMovie->title }}</a></td>
                                        <td>
                                            <img src="{{ $watchedMovie->photo ? asset('storage/'.$watchedMovie->photo) : asset('images/default_poster.jpg') }}" class="movie-poster" alt="{{ $watchedMovie->title }}">
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
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
        background-color: #007bff;
        color: white;
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
        border-radius: 5px; /* Optional: for better appearance */
    }
</style>
