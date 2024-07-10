<!-- Header -->
@section('title', 'Movie')
@include('../layouts/homeHeader')
<!-- End of Header -->

<!-- Movies Section -->
<section id="events" class="p-3 pb-5">
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
  </div>
</section>
<!-- End Movies Section -->

<!-- Footer -->
@include('../layouts/homeFooter')
<!-- End Footer -->

<!-- Custom CSS for Hover Effect -->
<style>
  .movie-card {
    transition: transform 0.3s, box-shadow 0.3s;
  }

  .movie-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
  }

  .card-img-top {
    transition: transform 0.3s;
  }

  .movie-card:hover .card-img-top {
    transform: scale(1.05);
  }
</style>
