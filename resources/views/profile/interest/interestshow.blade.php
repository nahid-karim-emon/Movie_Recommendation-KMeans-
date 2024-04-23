@extends('layout')
@section('title', 'Interest Details | User Dashboard')
@section('content')


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"> Interest Details </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">My Interests
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
                <table class="table table-bordered" width="100%">
                    <tr>
                        <th>Genre</th>
                        <td>
                            @foreach ($InterestGenredata as $InterestGenre)
                           <span class="m-1 p-1 bg-secondary text-white"> {{ $InterestGenre->genre->title }} </span>  
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Interested Country Films</th>
                        <td>
                            @foreach ($InterestCountryData as $InterestCountry)
                           <span class="m-1 p-1 bg-secondary text-white"> {{ $InterestCountry->country->title }} </span>  
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Cast</th>
                        <td>
                            @foreach ($InterestCastdata as $InterestCastd)
                           <span class="m-1 p-1 bg-secondary text-white"> {{ $InterestCastd->cast->name }} </span>  
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Director</th>
                        <td>
                            @foreach ($InterestDirectordata as $InterestDirector)
                           <span class="m-1 p-1 bg-secondary text-white"> {{ $InterestDirector->director->name }} </span>  
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Language</th>
                        <td>
                            @foreach ($InterestLanguagedata as $InterestLanguage)
                           <span class="m-1 p-1 bg-secondary text-white"> {{ $InterestLanguage->language->title }} </span>  
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Production Company</th>
                        <td>
                            @foreach ($InterestPcompanydata as $InterestPcompany)
                           <span class="m-1 p-1 bg-secondary text-white"> {{ $InterestPcompany->pcompany->title }} </span>  
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Interest Ratings</th>
                        <td>
                            @foreach ($InterestRatingData as $InterestRating)
                            @switch($InterestRating->rating_id)
                            @case(1)
                                <div class="m-1 p-1 bg-info text-white"> IMDB RATING : {{ $InterestRating->ratings }} / 10 </div>  
                                
                                @break
                            @case(2)
                            <div class="m-1 p-1 bg-danger text-white"> Rotten Tommetoes RATING : {{ $InterestRating->ratings }} / 100 </div>  
                                @break
                            @case(3)
                            <div class="m-1 p-1 bg-warning text-white"> Extra RATING : {{ $InterestRating->ratings }} / 5 </div>  
                                @break
                            @default
                                
                            @endswitch 
                            @endforeach
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <a href="{{ route('user.interest.rating',$data->id) }}" class="float-left btn btn-warning btn-sm m-1"><i class="fa fa-edit"> Change Rating Interest </i></a> <a href="{{ route('user.interest.edit',$data->id) }}" class="float-right btn btn-info btn-sm"><i class="fa fa-edit"> Edit Interest  </i></a>
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

