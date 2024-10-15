<!-- Header -->
@section('title', 'Movie')
@include('../layouts/homeHeader')
<!-- End of Header -->

<!-- Movies Section -->
<section id="movies" class="p-3 pb-5">
  <style>
    .badge-secondary {
      color: #333 !important;
      background-color: #E2E3E5 !important;
    }

    #movies {
      background-color: #F8F9FA;
      font-family: 'Arial, sans-serif';
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

    .table thead th {
      vertical-align: middle;
      text-align: center;
    }

    .table td {
      vertical-align: middle;
      text-align: center;
    }

    .badge {
      margin: 0 2px;
    }

    /* Styling for responsive and professional look */
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
  </style>

  <div class="container-xl">
    <div class="row text-center">
      <div class="col-md-12">
        <h3 class="mb-0">Hybrid Movie Recommendation</h3>
        <hr class="line">
      </div>
    </div>

    <!-- Show Count Options -->
    <div class="row mt-3 justify-content-center">
      <div class="form-group mb-0 d-flex align-items-center">
        <label for="movieCount" class="mr-2 mb-0">Show:</label>
        <select id="movieCount" class="form-control" style="width: auto;">
          <option value="all">All</option>
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="15">15</option>
          <option value="20">20</option>
          <option value="25">25</option>
          <option value="30">30</option>
        </select>
      </div>
    </div>
    

    <!-- Movie Table -->
    <div class="row mt-4 justify-content-center">
      <div class="table-responsive">
        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
          <thead class="thead-dark">
            <tr>
              <th>#</th>
              <th>Poster</th>
              <th>Name</th>
              <th>Genre</th>
              <th>Language</th>
              <th>Casts</th>
              <th>Directors</th>
              <th>Production Company</th>
              <th>Country</th>
              <th>Release Date</th>
            </tr>
          </thead>
          <tbody id="movieTableBody">
            @php $i = 0; @endphp
            @foreach ($data as $key => $movie)
              <tr class="movie-row">
                <td>{{ ++$i }}</td>
                <td>
                  <img src="{{ $movie->photo ? asset('storage/'.$movie->photo) : asset('images/default_poster.jpg') }}" class="movie-poster" alt="{{ $movie->title }}">
                </td>
                <td><a href="{{ route('movie.show', $movie->id) }}">{{ $movie->title }}</a></td>
                <td>
                  @foreach ($movie->MovieGenre as $MovieGenre)
                    <span class="badge badge-secondary">{{ $MovieGenre->genre->title }}</span>
                  @endforeach
                </td>
                <td>
                  @foreach ($movie->MovieLanguage as $MovieLanguage)
                    <span class="badge badge-secondary">{{ $MovieLanguage->language->title }}</span>
                  @endforeach
                </td>
                <td>
                  @foreach ($movie->MovieCast as $MovieCast)
                    <span class="badge badge-secondary">{{ $MovieCast->cast->name }}</span>
                  @endforeach
                </td>
                <td>
                  @foreach ($movie->MovieDirector as $MovieDirector)
                    <span class="badge badge-secondary">{{ $MovieDirector->director->name }}</span>
                  @endforeach
                </td>
                <td>
                  @foreach ($movie->MoviePcompany as $MoviePcompany)
                    <span class="badge badge-secondary">{{ $MoviePcompany->pcompany->title }}</span>
                  @endforeach
                </td>
                <td>
                  @foreach ($movie->MovieCountry as $MovieCountry)
                    <span class="badge badge-secondary">{{ $MovieCountry->country->title }}</span>
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
</section>
<!-- End Movies Section -->

<!-- Footer -->
@include('../layouts/homeFooter')
<!-- End Footer -->

<script>
  // Function to display movie rows based on selected count
  function displayMovies(count) {
    const rows = document.querySelectorAll('.movie-row');
    rows.forEach(function(row, index) {
      if (count === 'all' || index < count) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  }

  // Event listener for movie count selection
  document.getElementById('movieCount').addEventListener('change', function() {
    const selectedCount = this.value;
    displayMovies(selectedCount);
  });

  // Initialize with default value of all movies displayed
  document.getElementById('movieCount').dispatchEvent(new Event('change'));
</script>


{{-- <!-- Header -->
@section('title', 'Movie')
@include('../layouts/homeHeader')
<!-- End of Header -->

<!-- Movies Section -->
<section id="events" class="p-3 pb-5">
  <style>
    #events {
      background-color: #F8F9FA;
      font-family: 'Arial, sans-serif';
    }

    .movie-card {
      box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
      transition: all 0.3s;
      border-radius: 10px;
      overflow: hidden;
      background-color: #ffffff;
      display: flex;
      flex-direction: column;
      height: 100%;
      width: 100%;
      max-width: 280px;
      min-height: 450px;
      margin: 0 auto;
    }

    .movie-card:hover {
      box-shadow: rgba(0, 0, 0, 0.2) 0px 8px 24px;
      transform: translateY(-5px);
    }

    .movie-card img {
      border-bottom: 1px solid #ddd;
      transition: transform 0.3s ease;
      object-fit: cover;
      height: 280px;
      width: 100%;
    }

    .movie-card:hover img {
      transform: scale(1.05);
    }

    .events_1i2 {
      padding: 15px;
      text-align: left;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .events_1i2 h5 {
      margin: 10px 0;
      font-size: 18px;
      font-weight: bold;
      color: #333;
    }

    .events_1i2 h6 {
      color: #666;
      font-size: 14px;
      margin-bottom: 10px;
    }

    .price {
      font-size: 14px;
      color: #444;
    }

    .line {
      width: 50px;
      height: 4px;
      background-color: #6c757d;
      margin: 10px auto 20px;
    }

    @media (max-width: 768px) {
      .movie-card {
        margin-bottom: 20px;
        max-width: 100%;
      }
    }
  </style>
  <div class="container-xl">
    <div class="row text-center">
      <div class="col-md-12">
        <h3 class="mb-0">Recommended Movies</h3>
        <hr class="line me-auto ms-auto">
      </div>
    </div>
    <div class="row mt-3 justify-content-center">
      <div id="carouselExampleCaptions3" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions3" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions3" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>
        <div class="carousel-inner">
          <!-- First Carousel Item -->
          <div class="carousel-item active">
            <div class="row justify-content-center">
              @foreach ($data as $movie)
              @if ($loop->index < 6)
              <div class="col-md-3 mb-4 d-flex justify-content-center">
                <div class="card movie-card shadow-sm">
                  <img src="{{ $movie->photo ? asset('storage/'.$movie->photo) : asset('images/productioncompany.jpg') }}" class="card-img-top" alt="{{ $movie->title }}">
                  <div class="card-body events_1i2">
                    <h5 class="card-title text-uppercase"><a href="{{ route('movie.show', $movie->id) }}">{{ $movie->title }}</a></h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                      @foreach ($movie->MovieGenre as $MovieGenre)
                      {{ $MovieGenre->genre->title }}
                      @endforeach
                    </h6>
                    <hr>
                    @foreach ($movie->MovieRating as $rating)
                    @switch($rating->rating_id)
                    @case(1)
                    <p class="badge bg-info">IMDB: {{ $rating->ratings }} / 10</p>
                    @break
                    @case(2)
                    <p class="badge bg-danger">Rotten Tomatoes: {{ $rating->ratings }} / 100</p>
                    @break
                    @case(3)
                    <p class="badge bg-warning">Extra: {{ $rating->ratings }} / 5</p>
                    @break
                    @default
                    <p class="badge bg-secondary">{{ $rating->ratings }}</p>
                    @endswitch
                    @endforeach
                  </div>
                </div>
              </div>
              @endif
              @endforeach
            </div>
          </div>
          <!-- Second Carousel Item -->
          <div class="carousel-item">
            <div class="row justify-content-center">
              @foreach ($data as $movie)
              @if ($loop->index >= 6)
              <div class="col-md-3 mb-4 d-flex justify-content-center">
                <div class="card movie-card shadow-sm">
                  <img src="{{ $movie->photo ? asset('storage/'.$movie->photo) : asset('images/productioncompany.jpg') }}" class="card-img-top" alt="{{ $movie->title }}">
                  <div class="card-body events_1i2">
                    <h5 class="card-title text-uppercase"><a href="{{ route('movie.show', $movie->id) }}">{{ $movie->title }}</a></h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                      @foreach ($movie->MovieGenre as $MovieGenre)
                      {{ $MovieGenre->genre->title }}
                      @endforeach
                    </h6>
                    <hr>
                    @foreach ($movie->MovieRating as $rating)
                    @switch($rating->rating_id)
                    @case(1)
                    <p class="badge bg-info">IMDB: {{ $rating->ratings }} / 10</p>
                    @break
                    @case(2)
                    <p class="badge bg-danger">Rotten Tomatoes: {{ $rating->ratings }} / 100</p>
                    @break
                    @case(3)
                    <p class="badge bg-warning">Extra: {{ $rating->ratings }} / 5</p>
                    @break
                    @default
                    <p class="badge bg-secondary">{{ $rating->ratings }}</p>
                    @endswitch
                    @endforeach
                  </div>
                </div>
              </div>
              @endif
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
    <br><br>
  </div>
</section>
<!-- End Movies Section -->


<!-- Footer -->
@include('../layouts/homeFooter')
<!-- End Footer -->
 --}}
