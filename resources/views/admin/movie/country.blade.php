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
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="m-0 font-weight-bold text-primary">Movies of Country: {{ $country->title }}</h3>
                <a href="{{ route('admin.movie.create') }}" class="btn btn-success btn-sm" target="_self">Add New</a>
            </div>
            <div class="d-flex align-items-center mt-3">
                <form action="{{ route('admin.movie.country')}}" method="post" class="d-flex">
                    @csrf 
                    <select name="id" class="form-control mr-2">
                        @foreach ($countries as $g)
                        <option @if ($g->id==$country->id) selected @endif value="{{$g->id}}">{{$g->title}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
        
    
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Genre</th>
                            <th>Language</th>
                            <th>Casts</th>
                            <th>Directors</th>
                            <th>Production Company</th>
                            <th>Country</th>
                            <th>Release Date</th>
                            <th>Movie Rating</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=0; @endphp
                        @if($data)
                        @foreach ($data as $key => $d)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td><a href="{{ route('movie.show', $d->movie->id) }}">{{$d->movie->title}}</td>
                            <td>
                                @foreach ($d->movie->MovieGenre as $MovieGenre)
                                <span class="badge badge-secondary">{{ $MovieGenre->genre->title }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($d->movie->MovieLanguage as $MovieLanguage)
                                <span class="badge badge-secondary">{{ $MovieLanguage->language->title }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($d->movie->MovieCast as $MovieCast)
                                <span class="badge badge-secondary">{{ $MovieCast->cast->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($d->movie->MovieDirector as $MovieDirector)
                                <span class="badge badge-secondary">{{ $MovieDirector->director->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($d->movie->MoviePcompany as $MoviePcompany)
                                <span class="badge badge-secondary">{{ $MoviePcompany->pcompany->title }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($d->movie->MovieCountry as $MovieCountry)
                                <span class="badge badge-secondary">{{ $MovieCountry->country->title }}</span>
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
                                    <span class="badge badge-info">IMDB: {{ $MovieRating->ratings }}/10</span>
                                    @break
                                @case(2)
                                    <span class="badge badge-danger">Rotten Tomatoes: {{ $MovieRating->ratings }}/100</span>
                                    @break
                                @case(3)
                                    <span class="badge badge-warning">Extra: {{ $MovieRating->ratings }}/5</span>
                                    @break
                                @default
                                    <span class="badge badge-secondary">{{ $MovieRating->ratings }}</span>
                                @endswitch
                                @endforeach
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.movie.show1',$d->movie->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('admin.movie.edit',$d->movie->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
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

