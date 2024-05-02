@extends('admin/layout')
@section('title', 'Movie | Admin Dashboard')

@section('content')

            <!-- Session Messages Starts -->
            @if(Session::has('success'))
            <div class="p-3 mb-2 bg-success text-white">
                <p>{{ session('success') }} </p>
            </div>
            @endif
            @if(Session::has('danger'))
            <div class="p-3 mb-2 bg-danger text-white">
                <p>{{ session('danger') }} </p>
            </div>
            @endif
            <!-- Session Messages Ends -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">Movies of Genre : {{ $genre->title }} 
            <a href="{{ route('admin.movie.create') }}" class="float-right btn btn-success btn-sm p-2" target="_self">Add New</a> 
            <div class=" float-right  d-inline mx-1">
                <form action="{{ route('admin.movie.genre')}}" method="post">
                    @csrf 
                <select name="id" class="form-control">
                    @foreach ($genres as $g)
                    <option @if ($g->id==$genre->id) selected @endif value="{{$g->id}}">{{$g->title}}</option>
                    @endforeach
                </select>
                <button type="submit">Search</button>
                </form>
            </div>
        </h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Genre</th>
                            <th>Language</th>
                            <th>Actor</th>
                            <th>Directors</th>
                            <th>Production Company</th>
                            <th>Country</th>
                            <th>Release Date</th>
                            <th>Movie Rating</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Genre</th>
                            <th>Language</th>
                            <th>Actor</th>
                            <th>Directors</th>
                            <th>Production Company</th>
                            <th>Country</th>
                            <th>Release Date</th>
                            <th>Movie Rating</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php $i=0; @endphp

                        @if($data)
                        @foreach ($data as $key => $d)

                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $d->movie->title }}</td>
                            <td>
                                @foreach ($d->movie->MovieGenre as $MovieGenre)
                                <span class="m-1 p-1 bg-secondary text-white"> {{ $MovieGenre->genre->title }} </span>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($d->movie->MovieLanguage as $MovieLanguage)
                                <span class="m-1 p-1 bg-secondary text-white"> {{ $MovieLanguage->language->title }} </span>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($d->movie->MovieCast as $MovieCast)
                                <span class="m-1 p-1 bg-secondary text-white"> {{ $MovieCast->cast->name }} </span>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($d->movie->MovieDirector as $MovieDirector)
                                <span class="m-1 p-1 bg-secondary text-white"> {{ $MovieDirector->director->name }} </span>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($d->movie->MoviePcompany as $MoviePcompany)
                                <span class="m-1 p-1 bg-secondary text-white"> {{ $MoviePcompany->pcompany->title }} </span>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($d->movie->MovieCountry as $MovieCountry)
                                <span class="m-1 p-1 bg-secondary text-white"> {{ $MovieCountry->country->title }} </span>
                                @endforeach
                            </td>
                            @php
                                $date = \Illuminate\Support\Carbon::create($d->movie->release);
                                $formattedDate = $date->formatLocalized('%B %d, %Y');
                            @endphp
                            <td>{{ $formattedDate }}</td>
                            <td>
                                @foreach ($d->movie->MovieRating as $MovieRating)
                                @switch($MovieRating->rating_id)
                                @case(1)
                                    <div class="m-1 p-1 text-black "> IMDB RATING : {{ $MovieRating->ratings }} / 10 </div>
                                    @break
                                @case(2)
                                    <div class="m-1 p-1 text-black "> Rotten Tomatoes : {{ $MovieRating->ratings }} / 100 </div>
                                    @break
                                @case(3)
                                    <div class="m-1 p-1 text-black "> Extra : {{ $MovieRating->ratings }} / 5 </div>
                                    @break
                                @default
                                    <div class="m-1 p-1 text-black "> {{ $MovieRating->ratings }} </div>
                                @endswitch
                                @endforeach
                            <td class="text-center">
                                <a href="{{ route('admin.movie.show',$d->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('admin.movie.edit',$d->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                <a onclick="return confirm('Are You Sure?')" href="{{ url('admin/movie/'.$d->id.'/delete') }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
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

