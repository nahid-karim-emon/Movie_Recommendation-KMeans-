<!-- Header -->
@section('title', 'Movie : ' . $data->title)
@include('../layouts/homeHeader')
<!-- End of Header -->


  <main id="main ">

    <!-- ======= Events Section ======= -->
    <section id="events" class="events mt-3">
        <style>

.card-body {
    width: 80%;
    margin: 0 auto;
    box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;
}
.genre-text{
    background-color: #DCBFFF;
    padding: 5px 20px !important;
    border-radius: 5px;
}

        </style>
      <div class="card shadow m-2">
        <div class="card-header py-3">
            <h2 class="m-0 font-weight-bold text-primary text-center">{{ $data->title }} </h2>
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
                <table class="table table-bordered" width="80%">
                    <tr>
                        <th>Movie Poster</th>
                        <td class="d-flex justify-content-center"><img width="250px" class="img-fluid" src="{{$data->photo ? asset('storage/'.$data->photo) : asset('images/productioncompany.jpg')}}" alt="{{ $data->name }}'s Photo"></td>
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
                        <td class="d-flex gap-3">
                            @foreach ($MovieGenredata as $MovieGenred)
                           <div class="m-1 p-1 text-black genre-text"> {{ $MovieGenred->genre->title }} </div>  
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Cast</th>
                        <td class="d-flex gap-3">
                            @foreach ($MovieCastdata as $MovieCastd)
                           <div class="m-1 p-1 text-black genre-text"> {{ $MovieCastd->cast->name }} </div>  
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Director</th>
                        <td>
                            @foreach ($MovieDirectordata as $MovieDirector)
                           <span class="m-1 p-1 text-black"> {{ $MovieDirector->director->name }} </span>  
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Language</th>
                        <td>
                            @foreach ($MovieLanguagedata as $MovieLanguage)
                           <span class="m-1 p-1  text-black"> {{ $MovieLanguage->language->title }} </span>  
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Production Company</th>
                        <td class="d-flex gap-3">
                            @foreach ($MoviePcompanydata as $MoviePcompany)
                           <div class="m-1 p-1 text-black genre-text"> {{ $MoviePcompany->pcompany->title }} </div>  
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Movie Ratings</th>
                        <td>
                            @foreach ($MovieRatingData as $MovieRating)
                            @switch($MovieRating->rating_id)
                            @case(1)
                                <div class="m-1 p-1 text-black "> IMDB RATING : {{ $MovieRating->ratings }} / 10 </div>  
                                
                                @break
                            @case(2)
                            <div class="m-1 p-1  text-black"> Rotten Tommetoes RATING : {{ $MovieRating->ratings }} / 100 </div>  
                                @break
                            @case(3)
                            <div class="m-1 p-1  text-black"> Extra RATING : {{ $MovieRating->ratings }} / 5 </div>  
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
                            <a href="{{ route('staff.movie.rating',$data->id) }}" class="float-left btn btn-warning btn-sm m-1"><i class="fa fa-edit"> Change Rating of {{ $data->title }}  </i></a> <a href="{{ route('staff.movie.edit',$data->id) }}" class="float-right btn btn-info btn-sm"><i class="fa fa-edit"> Edit {{ $data->title }}  </i></a>
                        </td>
                        
                    </tr>
                    @endauth
                </table>
            </div>
        </div>
    </div>
    </section><!-- End Events Section -->
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  @include('../layouts/homeFooter')
  <!-- ======= End Footer ======= -->
