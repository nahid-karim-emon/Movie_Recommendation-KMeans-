<!-- Header -->
@section('title', 'Home')
@include('../layouts/homeHeader')
<!-- End of Header -->

<section id="center" class="center_home">
    <style>
        body {
        /* font-family: 'Arial, sans-serif'; */
        background-color: #F8F9FA;
      }
    </style>
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2" class="" aria-current="true"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('assets/img/1.jpg') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-md-block">
                    <ul class="mb-0 mt-3">
                        <!-- Add any content here if needed -->
                    </ul>
                </div>
            </div>
        </div>
</section>

<section id="upcome" class="p-3 bg-light">
    <div class="container-xl">
        <div class="row upcome_1 text-center">
            <div class="col-md-12">
                <h3 class="mb-0">UPCOMING MOVIES</h3>
                <hr class="line mx-auto">
            </div>
        </div>
        @isset($upcoming)
        <div class="row upcome_2 mt-4">
            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <div class="upcome_2i row">
                        @foreach ($upcoming as $key => $movie)
                        @if ($loop->index < 8)
                        <div class="col-md-3 mb-4">
                            <div class="upcome_2i1 position-relative">
                                <div class="upcome_2i1i">
                                    <img src="{{$movie->photo ? asset('storage/'.$movie->photo) : asset('images/productioncompany.jpg')}}" class="img-fluid"
                                        alt="abc">
                                </div>
                                <div class="upcome_2i1i1 position-absolute top-0 start-50 translate-middle-x">
                                    <h6 class="text-uppercase mb-0"><a class="button_2 btn btn-primary btn-sm"
                                            href="{{ route('movie.show',$movie->id) }}">View
                                            Details</a></h6>
                                </div>
                            </div>
                            <div class="upcome_2i_last bg-white p-3">
                                <div class="upcome_2i_lasti">
                                    <h5><a href="{{ route('movie.show',$movie->id) }}">{{ $movie->title }}</a></h5>
                                    <h6 class="text-muted">
                                        @foreach ($movie->MovieGenre as $MovieGenre)
                                        {{ $MovieGenre->genre->title }}
                                        @endforeach
                                    </h6>
                                    @foreach ($movie->MovieRating as $rating)
                                    @switch($rating->rating_id)
                                    @case(1)
                                    <p class="price align-self-start bg-info mb-0">IMDB : {{ $rating->ratings }}
                                        / 10</p>
                                    @break
                                    @case(2)
                                    <p class="price align-self-start bg-danger mb-0">Rotten Tomatoes : {{
                                        $rating->ratings }} / 100</p>
                                    @break
                                    @case(3)
                                    <p class="price align-self-start bg-warning mb-0">Extra : {{
                                        $rating->ratings }} / 5</p>
                                    @break
                                    @default
                                    <div class="price align-self-start">{{ $rating->ratings }}</div>
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
        @else
        <div>NO Upcoming Movies</div>
        @endisset
    </div>
</section>

<!-- ======= Footer ======= -->
@include('../layouts/homeFooter')
<!-- ======= End Footer ======= -->
