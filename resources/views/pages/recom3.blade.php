<!-- Header -->
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
    <div class="row mt-3">
      <div id="carouselExampleCaptions3" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions3" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions3" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>
        <div class="carousel-inner">
          <!-- First Carousel Item -->
          <div class="carousel-item active">
            <div class="row">
              @foreach ($data as $movie)
              @if ($loop->index < 6)
              <div class="col-md-3 mb-4">
                <div class="card movie-card shadow-sm">
                  <img src="{{ $movie->photo ? asset('storage/'.$movie->photo) : asset('images/productioncompany.jpg') }}" class="card-img-top" alt="{{ $movie->title }}" style="height: 280px; object-fit: cover;">
                  <div class="card-body">
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
            <div class="row">
              @foreach ($data as $movie)
              @if ($loop->index >= 6)
              <div class="col-md-3 mb-4">
                <div class="card movie-card shadow-sm">
                  <img src="{{ $movie->photo ? asset('storage/'.$movie->photo) : asset('images/productioncompany.jpg') }}" class="card-img-top" alt="{{ $movie->title }}" style="height: 280px; object-fit: cover;">
                  <div class="card-body">
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
    <p>Execution Time {{ $time }}s</p>
  </div>
</section>
<!-- End Movies Section -->

<!-- Footer -->
@include('../layouts/homeFooter')
<!-- End Footer -->
