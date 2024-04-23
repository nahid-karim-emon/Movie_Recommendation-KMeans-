<!-- Header -->
@section('title', 'Movie')
@include('../layouts/homeHeader')

<!-- End of Header -->
<section id="events" class="p_3 pb-5">
  <div class="container-xl">
   <div class="row upcome_1 text-center">
    <div class="col-md-12">
      <h3 class="mb-0">Recommended Movies</h3>
    <hr class="line me-auto ms-auto">
    </div>
   </div>
   <div class="row events_1 mt-3">
    <div id="carouselExampleCaptions3" class="carousel slide" data-bs-ride="carousel">
   <div class="carousel-indicators">
     <button type="button" data-bs-target="#carouselExampleCaptions3" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
     <button type="button" data-bs-target="#carouselExampleCaptions3" data-bs-slide-to="1" aria-label="Slide 2" class="" aria-current="true"></button>
   </div>
   <div class="carousel-inner">
     <div class="carousel-item active">
        <div class="events_1i row">
       @foreach ($data as $movie)
       @if ( $loop->index <=5) 
     <div class="col-md-4">
      <div class="events_1i1 clearfix position-relative">
       <div class="events_1i1i clearfix text-center">
        <a href="{{ route('movie.show',$movie->id) }}"><img src="{{$movie->photo ? asset('storage/'.$movie->photo) : asset('images/productioncompany.jpg')}}" alt="abc" width="355px" height="280px"></a>
       </div>
       {{-- <div class="events_1i1i1 clearfix position-absolute bottom-0 text-center w-100">
         <h6 class="mb-0"><a class="button_1" href="#">Book Now </a></h6>
       </div> --}}
      </div>
      <div class="events_1i2 clearfix p-3 pt-4 pb-4 bg-light text-center">
       <h5 class="text-uppercase "><a href="{{ route('movie.show',$movie->id) }}">{{ $movie->title }}</a></h5>
       <h6>@foreach ($movie->MovieGenre as $MovieGenre)
        {{ $MovieGenre->genre->title }}
        @endforeach </h6>
        <hr>
        @foreach ($movie->MovieRating as $rating)
                @switch($rating->rating_id)
                @case(1)
                    <p class=" price align-self-start p-1 bg-info" style="font-size: 16px;border-bottom: none;"> IMDB : {{ $rating->ratings }} / 10 </p>
                    @break
                @case(2)
                    <p class=" price align-self-start p-1 bg-danger" style="font-size: 16px;border-bottom: none;"> Rotten Tommetoes : {{ $rating->ratings }} / 100 </p>  
                    @break
                @case(3)
                    <p class="price align-self-start p-1 bg-warning" style="font-size: 16px;border-bottom: none;"> Extra : {{ $rating->ratings }} / 5 </p>  
                    @break
                @default
                  <div class="price align-self-start" style="font-size: 16px;border-bottom: none;">{{ $rating->ratings }}</div>
                    
                @endswitch 
          @endforeach
      </div>
     </div>
    @endif
     @endforeach
      </div>

     </div>
     <div class="carousel-item">
         <div class="events_1i row">
          @foreach ($data as $movie)
       @if ($loop->index >5 ) 
     <div class="col-md-4">
      <div class="events_1i1 clearfix position-relative">
       <div class="events_1i1i clearfix text-center">
        <a href="{{ route('movie.show',$movie->id) }}"><img src="{{$movie->photo ? asset('storage/'.$movie->photo) : asset('images/productioncompany.jpg')}}" alt="abc" width="355px" height="280px"></a>
       </div>
       {{-- <div class="events_1i1i1 clearfix position-absolute bottom-0 text-center w-100">
         <h6 class="mb-0"><a class="button_1" href="#">Book Now </a></h6>
       </div> --}}
      </div>
      <div class="events_1i2 clearfix p-3 pt-4 pb-4 bg-light text-center">
       <h5 class="text-uppercase "><a href="{{ route('movie.show',$movie->id) }}">{{ $movie->title }}</a></h5>
       <h6>@foreach ($movie->MovieGenre as $MovieGenre)
        {{ $MovieGenre->genre->title }}
        @endforeach </h6>
        <hr>
        @foreach ($movie->MovieRating as $rating)
                @switch($rating->rating_id)
                @case(1)
                    <p class=" price align-self-start p-1 bg-info" style="font-size: 16px;border-bottom: none;"> IMDB : {{ $rating->ratings }} / 10 </p>
                    @break
                @case(2)
                    <p class=" price align-self-start p-1 bg-danger" style="font-size: 16px;border-bottom: none;"> Rotten Tommetoes : {{ $rating->ratings }} / 100 </p>  
                    @break
                @case(3)
                    <p class="price align-self-start p-1 bg-warning" style="font-size: 16px;border-bottom: none;"> Extra : {{ $rating->ratings }} / 5 </p>  
                    @break
                @default
                  <div class="price align-self-start" style="font-size: 16px;border-bottom: none;">{{ $rating->ratings }}</div>
                    
                @endswitch 
          @endforeach
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
   <p> Execution Time {{ $time }}s</p>
  </div>
 </section>
<!-- ======= Footer ======= -->
@include('../layouts/homeFooter')
<!-- ======= End Footer ======= -->