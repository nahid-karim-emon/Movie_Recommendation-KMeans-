@extends('staff/layout')
@section('title', 'Movie Details | Staff Dashboard')
@section('content')


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"> Movie Details </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Movie Details of <span class="bg-warning"> {{ $data->title }} </span> 
            <a href="{{ route('staff.movie.index') }}" class="float-right btn btn-success btn-sm"> <i class="fa fa-arrow-left"></i> View All </a> </h6>
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
                <table class="table table-bordered" width="100%">
                    <tr>
                        <th>Movie Poster</th>
                        <td><img width="250px" src="{{$data->photo ? asset('storage/'.$data->photo) : asset('images/productioncompany.jpg')}}" alt="{{ $data->name }}'s Photo"></td>
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
                            @foreach ($MovieGenredata as $MovieGenred)
                           <span class="m-1 p-1 bg-secondary text-white"> {{ $MovieGenred->genre->title }} </span>  
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Origin Country</th>
                        <td>
                            @foreach ($MovieCountryData as $MovieCountry)
                           <span class="m-1 p-1 bg-secondary text-white"> {{ $MovieCountry->country->title }} </span>  
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Cast</th>
                        <td>
                            @foreach ($MovieCastdata as $MovieCastd)
                           <span class="m-1 p-1 bg-secondary text-white"> {{ $MovieCastd->cast->name }} </span>  
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Director</th>
                        <td>
                            @foreach ($MovieDirectordata as $MovieDirector)
                           <span class="m-1 p-1 bg-secondary text-white"> {{ $MovieDirector->director->name }} </span>  
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Language</th>
                        <td>
                            @foreach ($MovieLanguagedata as $MovieLanguage)
                           <span class="m-1 p-1 bg-secondary text-white"> {{ $MovieLanguage->language->title }} </span>  
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Production Company</th>
                        <td>
                            @foreach ($MoviePcompanydata as $MoviePcompany)
                           <span class="m-1 p-1 bg-secondary text-white"> {{ $MoviePcompany->pcompany->title }} </span>  
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Movie Ratings</th>
                        <td>
                            @foreach ($MovieRatingData as $MovieRating)
                            @switch($MovieRating->rating_id)
                            @case(1)
                                <div class="m-1 p-1 bg-info text-white"> IMDB RATING : {{ $MovieRating->ratings }} / 10 </div>  
                                
                                @break
                            @case(2)
                            <div class="m-1 p-1 bg-danger text-white"> Rotten Tommetoes RATING : {{ $MovieRating->ratings }} / 100 </div>  
                                @break
                            @case(3)
                            <div class="m-1 p-1 bg-warning text-white"> Extra RATING : {{ $MovieRating->ratings }} / 5 </div>  
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

                    <tr>
                        <td colspan="2">
                            <a href="{{ route('staff.movie.rating',$data->id) }}" class="float-left btn btn-warning btn-sm m-1"><i class="fa fa-edit"> Change Rating of {{ $data->title }}  </i></a> <a href="{{ route('staff.movie.edit',$data->id) }}" class="float-right btn btn-info btn-sm"><i class="fa fa-edit"> Edit {{ $data->title }}  </i></a>
                        </td>
                        
                    </tr>
                    
                </table>
            </div>
        </div>
    </div>

    @section('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endsection
@endsection

