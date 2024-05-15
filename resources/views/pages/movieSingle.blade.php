<!-- Header -->
@section('title', 'Movie : ' . $data->title)
@include('../layouts/homeHeader')
<!-- End of Header -->

<main id="main">
  <!-- ======= Events Section ======= -->
  <section id="events" class="events mt-3">
    <style>
      body {
        font-family: 'Arial, sans-serif';
        background-color: #F8F9FA;
      }

      .card {
        border: none;
        border-radius: 10px;
        background-color: #ffffff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s;
      }

      .card:hover {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
      }

      .card-header {
        background-color: #6c757d;
        color: #fff;
        border-bottom: none;
        border-radius: 10px 10px 0 0;
        text-align: center;
      }

      .card-header h2 {
        margin: 0;
        font-size: 24px;
        font-weight: bold;
      }

      .card-body {
        padding: 20px;
      }

      .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
      }

      .table th, .table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
      }

      .table th {
        width: 30%;
        background-color: #f1f1f1;
        font-weight: bold;
        text-align: left;
      }

      .table td {
        width: 70%;
        text-align: left;
      }

      .table-responsive {
        display: block;
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
      }

      .genre-text, .cast-text, .pcompany-text {
        background-color: #DCBFFF;
        padding: 5px 15px;
        border-radius: 20px;
        margin: 5px;
        font-size: 14px;
      }

      .img-fluid {
        border-radius: 10px;
      }

      .btn-custom {
        font-size: 14px;
        padding: 10px 20px;
        border-radius: 20px;
        text-transform: uppercase;
        transition: background-color 0.3s;
      }

      .btn-warning {
        background-color: #FFC107;
        color: #fff;
        border: none;
      }

      .btn-warning:hover {
        background-color: #e0a800;
      }

      .btn-info {
        background-color: #17A2B8;
        color: #fff;
        border: none;
      }

      .btn-info:hover {
        background-color: #138496;
      }

      @media (max-width: 768px) {
        .table th, .table td {
          display: block;
          width: 100%;
          text-align: left;
        }

        .table th {
          background-color: transparent;
          padding-top: 10px;
        }
      }
    </style>
    <div class="container">
      <div class="card shadow m-2">
        <div class="card-header py-3">
          <h2 class="m-0 font-weight-bold text-center">{{ $data->title }}</h2>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered">
              <tr>
                <th>Movie Poster</th>
                <td class="d-flex justify-content-center">
                  <img width="250px" class="img-fluid" src="{{$data->photo ? asset('storage/'.$data->photo) : asset('images/productioncompany.jpg')}}" alt="{{ $data->name }}'s Photo">
                </td>
              </tr>
              <tr>
                <th>Released Date</th>
                @php
                $date = \Illuminate\Support\Carbon::create($data->release);
                $formattedDate = $date->formatLocalized('%B %d, %Y');
                @endphp
                <td>{{ $formattedDate }}</td>
              </tr>
              <tr>
                <th>Title</th>
                <td>{{ $data->title }}</td>
              </tr>
              <tr>
                <th>Genre</th>
                <td>
                  <div class="d-flex flex-wrap">
                    @foreach ($MovieGenredata as $MovieGenred)
                    <div class="genre-text">{{ $MovieGenred->genre->title }}</div>
                    @endforeach
                  </div>
                </td>
              </tr>
              <tr>
                <th>Cast</th>
                <td>
                  <div class="d-flex flex-wrap">
                    @foreach ($MovieCastdata as $MovieCastd)
                    <div class="cast-text">{{ $MovieCastd->cast->name }}</div>
                    @endforeach
                  </div>
                </td>
              </tr>
              <tr>
                <th>Director</th>
                <td>
                  @foreach ($MovieDirectordata as $MovieDirector)
                  <span class="m-1 p-1 text-black">{{ $MovieDirector->director->name }}</span>
                  @endforeach
                </td>
              </tr>
              <tr>
                <th>Language</th>
                <td>
                  @foreach ($MovieLanguagedata as $MovieLanguage)
                  <span class="m-1 p-1 text-black">{{ $MovieLanguage->language->title }}</span>
                  @endforeach
                </td>
              </tr>
              <tr>
                <th>Production Company</th>
                <td>
                  <div class="d-flex flex-wrap">
                    @foreach ($MoviePcompanydata as $MoviePcompany)
                    <div class="pcompany-text">{{ $MoviePcompany->pcompany->title }}</div>
                    @endforeach
                  </div>
                </td>
              </tr>
              <tr>
                <th>Movie Ratings</th>
                <td>
                  @foreach ($MovieRatingData as $MovieRating)
                  @switch($MovieRating->rating_id)
                  @case(1)
                  <div class="m-1 p-1 text-black">IMDB RATING: {{ $MovieRating->ratings }} / 10</div>
                  @break
                  @case(2)
                  <div class="m-1 p-1 text-black">Rotten Tomatoes RATING: {{ $MovieRating->ratings }} / 100</div>
                  @break
                  @case(3)
                  <div class="m-1 p-1 text-black">Extra RATING: {{ $MovieRating->ratings }} / 5</div>
                  @break
                  @default
                  @endswitch
                  @endforeach
                </td>
              </tr>
              <tr>
                <th>Info</th>
                <td>{{ $data->info }}</td>
              </tr>
              @auth('staff')
              <tr>
                <td colspan="2">
                  <a href="{{ route('staff.movie.rating', $data->id) }}" class="btn btn-warning btn-sm m-1 btn-custom float-left"><i class="fa fa-edit"></i> Change Rating of {{ $data->title }}</a>
                  <a href="{{ route('staff.movie.edit', $data->id) }}" class="btn btn-info btn-sm btn-custom float-right"><i class="fa fa-edit"></i> Edit {{ $data->title }}</a>
                </td>
              </tr>
              @endauth
            </table>
          </div>
        </div>
      </div>
    </div>
  </section><!-- End Events Section -->
</main><!-- End #main -->

<!-- ======= Footer ======= -->
@include('../layouts/homeFooter')
<!-- ======= End Footer ======= -->
