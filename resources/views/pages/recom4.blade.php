<!-- Header -->
@section('title', 'Movie')
@include('../layouts/homeHeader')
<!-- End of Header -->

<!-- Modal for User Prompt -->
<div class="modal fade" id="recommendationPrompt" tabindex="-1" aria-labelledby="recommendationPromptLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="recommendationPromptLabel">Recommendation Feedback</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Do you like this recommendation?</p>
        <div class="d-flex justify-content-between">
          <a href="#" id="yesLink" class="btn btn-success w-45">Yes</a>
          <a href="{{ route('recommendations.regenerate') }}" class="btn btn-danger w-45">No</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Movies Section -->
<section id="movies" class="p-3 pb-5">
  <style>
    .badge-secondary {
      color: #333 !important;
      background-color: #E2E3E5 !important;
    }

    #movies {
      background-color: #F8F9FA;
      /* font-family: 'Arial, sans-serif'; */
    }

    .line {
      width: 60px;
      height: 4px;
      background-color: #6c757d;
      margin: 10px auto 20px;
    }

    .table th {
      background-color: #343a40;
      color: #fff;
    }

    .table thead th, .table td {
      text-align: center;
      vertical-align: middle;
    }

    .badge {
      margin: 0 2px;
    }

    .table-responsive {
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
      border-radius: 8px;
      overflow: auto;
      background: #fff;
      padding: 15px;
    }

    .movie-poster {
      max-width: 80px;
      height: auto;
      border-radius: 5px;
      object-fit: cover;
    }

    @media (max-width: 768px) {
      .movie-poster {
        max-width: 60px;
      }

      .table th, .table td {
        font-size: 14px;
      }

      .badge {
        font-size: 12px;
      }
    }

    /* Two-column table layout */
    .movie-tables {
     position: relative;
    }

    .sticky-watched {
    position: -webkit-sticky;
    position: sticky;
    top: 60px;
    z-index: 1;
    max-height: 100vh;
    overflow-y: auto; 
  }

    /* .movie-tables .table-responsive {
      width: 48%;
    } */

    /* Recommendation details link */
    .recommendation-details {
      text-align: right;
      margin-bottom: 10px;
    }

    /* Style for the show count input */
    #recommendedMovieCount {
      width: 60px;
      text-align: center;
      margin-left: 10px;
    }

    .movie-count-wrap{
    
    /* margin-bottom: 20px !important; */

    }
    .movie-count-label {
    font-size: 24px;
}
.movie-count-input {
    border: 1px solid black;
}
ul li{
  list-style-type: none !important;
}
li{
  list-style-type: none !important;
}

.filter-type{
    border: 1px solid #d4cfcf;
    padding: 10px 25px;
    background-color: #00000014;
    border-radius: 8px;
    color: black;

}
.movie-count-wrap{
    display: flex;
    align-items: center;
    gap: 12px;
    border: 1px solid #d4cfcf;
    padding: 6px 20px;
    background-color: #00000014;
    border-radius: 8px;
    color: black;
    font-size: 8px;

}

  .movie-count-wrap label{
    font-size: 17px;
    margin-bottom: 0;
 }
  </style>

  <div class="container-xl">
    <div class="row text-center">
      <div class="col-md-12">
        <h3 class="mb-0">Hybrid Movie Recommendation</h3>
        <hr class="line">
      </div>
    </div>
    <!-- Recommendation Details Link -->
    <div class="recommendation-details me-2">
      <button id="feedbackButton" class="nav-link button">Give Feedback</button>
      <a href="{{route('weights.index')}}" class="nav-link button">Update Weights</a>
      <a href="{{route('user.recommendationDetails')}}" class="nav-link button">Recommendation Details</a>
    </div>
    <!-- Movie Tables -->
   <section class="movie-tables">
    <div class="container">
      <div class="row">
        <div class="col-lg-5">
          <!-- Watched Movies Table (Left) -->
          <div class="table-responsive sticky-watched ">
            <h5 class="text-center">Watched Movies</h5>
            <table class="table table-bordered table-striped" width="100%" cellspacing="0">
              <thead class="thead-dark">
                <tr>
                  <th>#</th>
                  <th>Poster</th>
                  <th>Name</th>
                  <th>Genre</th>
                  <th>Release Date</th>
                </tr>
              </thead>
              <tbody>
                @php $i = 0; @endphp
                @foreach ($watchedMovies as $movie)
                  <tr>
                    <td>{{ ++$i }}</td>
                    <td>
                      <img src="{{ $movie->photo ? asset('storage/'.$movie->photo) : asset('images/default_poster.jpg') }}" class="movie-poster" alt="{{ $movie->title }}">
                    </td>
                    <td><a href="{{ route('movie.show', $movie->id) }}">{{ $movie->title }}</a></td>
                    <td>
                      @foreach ($movie->MovieGenre as $genre)
                        <span class="badge badge-secondary">{{ $genre->genre->title }}</span>
                      @endforeach
                    </td>
                    @php
                      $date = \Illuminate\Support\Carbon::create($movie->release);
                      $formattedDate = $date->formatLocalized('%B %d, %Y');
                    @endphp
                    <td>{{ $formattedDate }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
              
        </div>
        <div class="col-lg-7">
          <div class="table-responsive">
            <h5 class="text-center">Recommended Movies
              @if(request()->routeIs('user.recommendations.show'))
              (
              @if($filter == 'content_based')
                Content Based
              @elseif($filter == 'collaborative')
                Collaborative Based On Ratings
              @elseif($filter == 'collaborative_likes')
                Collaborative Based On Likes
              @elseif($filter == 'bothCollaborativeAndLikes')
                Collaborative Based On Both Ratings & Likes
              @elseif($filter == 'bothCollaborativeAndContent')
                Based On Both Collaborative & Content
              @elseif($filter == 'demographic')
                Based On Demographic Information
              @elseif($filter == 'dislike_recommend')
                User Disliked But Recommended
              @endif
              )

            @else
              (All)
            @endif
            </h5>

            <!-- Filter Form with Redirect -->
            <div class="row mt-3 justify-content-center">
             
            </div>

            <div class="d-flex align-items-center justify-content-between">
              <div class=" movie-count-wrap mb-0 ">
                <label for="recommendedMovieCount" class="movie-count-label mr-2 mb-0">Show:</label>
                <input type="number" id="recommendedMovieCount" class="form-control movie-count-input" value="all" min="1" max="30">
              </div>
              <div class=" ">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle filter-type" href="#" id="filterDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Filter By Type
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                    <li><a class="dropdown-item" href="{{ route('user.recommendation.view9')  }}">All</a></li>
                    <li><a class="dropdown-item" href="{{ route('user.recommendations.show','bothCollaborativeAndContent')}}">Both Collaborative & Content</a></li>
                    <li><a class="dropdown-item" href="{{ route('user.recommendations.show','content_based')}}">Content Based </a></li>
                    <li><a class="dropdown-item" href="{{ route('user.recommendations.show','collaborative')}}">Collaborative Based On Ratings</a></li>
                    <li><a class="dropdown-item" href="{{ route('user.recommendations.show','collaborative_likes')}}">Collaborative Based On Likes</a></li>
                    <li><a class="dropdown-item" href="{{ route('user.recommendations.show','bothCollaborativeAndLikes')}}">Collaborative Based On Both Ratings & Likes</a></li>
                    <li><a class="dropdown-item" href="{{ route('user.recommendations.show','demographic')}}">Demographic Recommendation</a></li>
                    <li><a class="dropdown-item" href="{{ route('user.recommendations.show','dislike_recommend')}}">Dislike</a></li>
                  </ul>
                </li>                
              </div>
            </div>

            <!-- Show Count Options -->
            <div class="row mt-3 d-flex justify-content-between">
             
              {{--  --}}
              
              {{--  --}}
            </div>
      
            <table class="table table-bordered table-striped" width="100%" cellspacing="0">
              <thead class="thead-dark">
                <tr>
                  <th>#</th>
                  <th>Poster</th>
                  <th>Name</th>
                  {{-- <th>Recommendation Type</th> --}}
                  <th>Genre</th>
                  <th>Language</th>
                  <th>Casts</th>
                  <th>Directors</th>
                  <th>Production Company</th>
                  <th>Country</th>
                  <th>Release Date</th>
                </tr>
              </thead>
              <tbody id="recommendedTableBody">
                @php $i = 0; @endphp
                @foreach ($recommendedMovies as $movie)
                  <tr class="recommended-row">
                    <td>{{ ++$i }}</td>
                    <td>
                      <img src="{{ $movie->photo ? asset('storage/'.$movie->photo) : asset('images/default_poster.jpg') }}" class="movie-poster" alt="{{ $movie->title }}">
                    </td>
                    <td><a href="{{ route('movie.show', $movie->id) }}">{{ $movie->title }}</a></td>
                    {{-- <td>{{ $movie->recommendation_type }}</td> --}}
                    <td>
                      @foreach ($movie->MovieGenre as $genre)
                        <span class="badge badge-secondary">{{ $genre->genre->title }}</span>
                      @endforeach
                    </td>
                    <td>
                      @foreach ($movie->MovieLanguage as $language)
                        <span class="badge badge-secondary">{{ $language->language->title }}</span>
                      @endforeach
                    </td>
                    <td>
                      @foreach ($movie->MovieCast as $cast)
                        <span class="badge badge-secondary">{{ $cast->cast->name }}</span>
                      @endforeach
                    </td>
                    <td>
                      @foreach ($movie->MovieDirector as $director)
                        <span class="badge badge-secondary">{{ $director->director->name }}</span>
                      @endforeach
                    </td>
                    <td>
                      @foreach ($movie->MoviePcompany as $pcompany)
                        <span class="badge badge-secondary">{{ $pcompany->pcompany->title }}</span>
                      @endforeach
                    </td>
                    <td>
                      @foreach ($movie->MovieCountry as $country)
                        <span class="badge badge-secondary">{{ $country->country->title }}</span>
                      @endforeach
                    </td>
                    @php
                      $date = \Illuminate\Support\Carbon::create($movie->release);
                      $formattedDate = $date->formatLocalized('%B %d, %Y');
                    @endphp
                    <td>{{ $formattedDate }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div> 
   </section>
  </div>
</section>
<!-- End Movies Section -->

<!-- Footer -->
@include('../layouts/homeFooter')
<!-- End Footer -->

<script>
  // Function to display recommended movies based on user input
  function displayRecommendedMovies(count) {
    const rows = document.querySelectorAll('.recommended-row');
    rows.forEach(function(row, index) {
      if (count === 'all' || index < count) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  }

  // Event listener for movie count input
  document.getElementById('recommendedMovieCount').addEventListener('input', function() {
    let selectedCount = this.value;

    if (selectedCount === '' || selectedCount === 'all') {
      selectedCount = 'all';
    } else {
      selectedCount = parseInt(selectedCount);
    }

    displayRecommendedMovies(selectedCount);
  });

  // Initialize with all movies displayed
  document.getElementById('recommendedMovieCount').dispatchEvent(new Event('input'));

  document.addEventListener('DOMContentLoaded', function () {
    // Initialize Bootstrap Modal
    const modal = new bootstrap.Modal(document.getElementById('recommendationPrompt'));

    // Show modal when feedback button is clicked
    document.getElementById('feedbackButton').addEventListener('click', function () {
      modal.show();
    });
        // Close modal when "Yes" is clicked
        document.getElementById('yesLink').addEventListener('click', function (event) {
      event.preventDefault(); // Prevent default anchor behavior
      modal.hide(); // Close the modal
    });
  });
</script>