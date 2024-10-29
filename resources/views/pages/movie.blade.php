<!-- Header -->
@section('title', 'Movie')
@include('../layouts/homeHeader')
<!-- End of Header -->

<section id="events" class="p-3 pb-5">
  <style>
    #events {
      background-color: #F8F9FA;
      /* font-family: 'Arial, sans-serif'; */
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
      text-align: left;
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
      }
    }
  </style>
  <div class="container-xl">
    <div class="row upcome_1 text-center">
      <div class="col-md-12">
        <h3 class="mb-0">Latest Movies</h3>
        <hr class="line me-auto ms-auto">
      </div>
    </div>
    <div class="row events_1 mt-3">
      @foreach ($data as $movie)
      <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
        <div class="movie-card">
          <div class="events_1i1 clearfix position-relative">
            <div class="events_1i1i clearfix">
              <a href="{{ route('movie.show', $movie->id) }}">
                <img width="100%" height="350px" src="{{ $movie->photo ? asset('storage/'.$movie->photo) : asset('images/productioncompany.jpg') }}" alt="{{ $movie->title }}">
              </a>
            </div>
          </div>
          <div class="events_1i2 clearfix p-3">
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
            <p class="price align-self-start p-1" style="font-size: 16px; border-bottom: none;">IMDB : {{ $rating->ratings }} / 10</p>
            @break
            @endswitch
            @endforeach
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- ======= Footer ======= -->
@include('../layouts/homeFooter')
<!-- ======= End Footer ======= -->
