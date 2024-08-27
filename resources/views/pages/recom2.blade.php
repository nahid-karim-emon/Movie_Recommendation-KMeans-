<!-- Header -->
@section('title', 'Movie')
@include('../layouts/homeHeader')
<!-- End of Header -->

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
    }

    .movie-card:hover {
      box-shadow: rgba(0, 0, 0, 0.2) 0px 8px 24px;
      transform: translateY(-5px);
    }

    .movie-card img {
      border-bottom: 1px solid #ddd;
      transition: transform 0.3s ease;
    }

    .movie-card:hover img {
      transform: scale(1.05);
    }

    .events_1i2 {
      padding: 15px;
      text-align: center;
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
      font-size: 16px;
      border-bottom: none;
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
      }
    }
  </style>
  
  <div class="container-xl">
    <div class="row upcome_1 text-center">
      <div class="col-md-12">
        <h3 class="mb-0">Recommended Movies (Manhattan)</h3>
        <hr class="line me-auto ms-auto">
      </div>
    </div>

    <div class="row events_1 mt-3">
      <div id="carouselExampleCaptions3" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions3" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions3" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>

        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="events_1i row">
              @foreach ($data as $movie)
                @if ($loop->index <= 2) 
                  <div class="col-md-4">
                    <div class="movie-card">
                      <div class="events_1i1 clearfix position-relative">
                        <div class="events_1i1i clearfix text-center">
                          <a href="{{ route('movie.show', $movie->id) }}">
                            <img src="{{ $movie->photo ? asset('storage/'.$movie->photo) : asset('images/productioncompany.jpg') }}" alt="{{ $movie->title }}" width="355px" height="280px">
                          </a>
                        </div>
                      </div>
                      <div class="events_1i2 clearfix p-3 pt-4 pb-4 bg-light">
                        <h5 class="text-uppercase"><a href="{{ route('movie.show', $movie->id) }}">{{ $movie->title }}</a></h5>
                        <h6>
                          @foreach ($movie->MovieGenre as $MovieGenre)
                            {{ $MovieGenre->genre->title }}
                          @endforeach
                        </h6>
                        <hr>
                        @foreach ($movie->MovieRating as $rating)
                          @switch($rating->rating_id)
                            @case(1)
                              <p class="price bg-info p-1">IMDB: {{ $rating->ratings }} / 10</p>
                              @break
                            @case(2)
                              <p class="price bg-danger p-1">Rotten Tomatoes: {{ $rating->ratings }} / 100</p>
                              @break
                            @case(3)
                              <p class="price bg-warning p-1">Extra: {{ $rating->ratings }} / 5</p>
                              @break
                            @default
                              <p class="price p-1">{{ $rating->ratings }}</p>
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
            <div class="events_1i row">
              @foreach ($data as $movie)
                @if ($loop->index > 2)
                  <div class="col-md-4">
                    <div class="movie-card">
                      <div class="events_1i1 clearfix position-relative">
                        <div class="events_1i1i clearfix text-center">
                          <a href="{{ route('movie.show', $movie->id) }}">
                            <img src="{{ $movie->photo ? asset('storage/'.$movie->photo) : asset('images/productioncompany.jpg') }}" alt="{{ $movie->title }}" width="355px" height="280px">
                          </a>
                        </div>
                      </div>
                      <div class="events_1i2 clearfix p-3 pt-4 pb-4 bg-light">
                        <h5 class="text-uppercase"><a href="{{ route('movie.show', $movie->id) }}">{{ $movie->title }}</a></h5>
                        <h6>
                          @foreach ($movie->MovieGenre as $MovieGenre)
                            {{ $MovieGenre->genre->title }}
                          @endforeach
                        </h6>
                        <hr>
                        @foreach ($movie->MovieRating as $rating)
                          @switch($rating->rating_id)
                            @case(1)
                              <p class="price bg-info p-1">IMDB: {{ $rating->ratings }} / 10</p>
                              @break
                            @case(2)
                              <p class="price bg-danger p-1">Rotten Tomatoes: {{ $rating->ratings }} / 100</p>
                              @break
                            @case(3)
                              <p class="price bg-warning p-1">Extra: {{ $rating->ratings }} / 5</p>
                              @break
                            @default
                              <p class="price p-1">{{ $rating->ratings }}</p>
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

<!-- ======= Footer ======= -->
@include('../layouts/homeFooter')
<!-- ======= End Footer ======= -->
