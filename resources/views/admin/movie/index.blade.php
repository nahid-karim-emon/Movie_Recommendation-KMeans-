@extends('admin/layout')
@section('title', 'Movie | Admin Dashboard')

@section('content')


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Movies</h1>
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
                <h3 class="m-0 font-weight-bold text-primary">Movie Data</h3>
                <a href="{{ route('admin.movie.create') }}" class="btn btn-success btn-sm ml-auto" target="_self">Add New</a>
            </div>
            <div class="mt-3">
                <form action="{{ route('admin.movie.genre')}}" method="post" class="form-inline">
                    @csrf 
                    <div class="form-group mr-2">
                        <select name="id" class="form-control">
                            @foreach ($genres as $g)
                            <option value="{{$g->id}}">{{$g->title}}</option>
                            @endforeach
                        </select>
                    </div>
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
                            {{-- <th>Photo</th> --}}
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
                    <tbody>
                        @php $i=0; @endphp
                        @if($data)
                        @foreach ($data as $key => $d)
                        <tr>
                            <td>{{ ++$i }}</td>
                            {{-- <td><img width="150px" height="150px"
                                src="{{$d->photo ? asset('storage/'.$d->photo) : asset('images/productioncompany.jpg')}}"
                                alt="{{ $d->title }}'s Photo"
                            />
                            </td> --}}
                            <td>{{ $d->title }}</td>
                            <td>
                                @if (count($d->MovieGenre)>=1)
                                @foreach ($d->MovieGenre as $MovieGenre)
                                <span class="badge badge-secondary">{{ $MovieGenre->genre->title }}</span>
                                @endforeach
                                @endif
                            </td>
                            <td>
                                @if (count($d->MovieLanguage)>=1)
                                @foreach ($d->MovieLanguage as $MovieLanguage)
                                <span class="badge badge-secondary">{{ $MovieLanguage->language->title }}</span>
                                @endforeach
                                @endif
                            </td>
                            <td>
                                @if (count($d->MovieCast)>=1)
                                @foreach ($d->MovieCast as $MovieCast)
                                <span class="badge badge-secondary">{{ $MovieCast->cast->name }}</span>
                                @endforeach
                                @endif
                            </td>
                            <td>
                                @if (count($d->MovieDirector)>=1)
                                @foreach ($d->MovieDirector as $MovieDirector)
                                <span class="badge badge-secondary">{{ $MovieDirector->director->name }}</span>
                                @endforeach
                                @endif
                            </td>
                            <td>
                                @if (count($d->MoviePcompany)>=1)
                                @foreach ($d->MoviePcompany as $MoviePcompany)
                                <span class="badge badge-secondary">{{ $MoviePcompany->pcompany->title }}</span>
                                @endforeach
                                @endif
                            </td>
                            <td>
                                @if (count($d->MovieCountry)>=1)
                                @foreach ($d->MovieCountry as $MovieCountry)
                                <span class="badge badge-secondary">{{ $MovieCountry->country->title }}</span>
                                @endforeach
                                @endif
                            </td>
                            @php
                            $date = \Illuminate\Support\Carbon::create($d->release);
                            $formattedDate = $date->formatLocalized('%B %d, %Y');
                        @endphp
                        <td>{{ $formattedDate }}</td>
                        <td>
                            @if (count($d->MovieRating)>=1)
                            @foreach ($d->MovieRating as $MovieRating)
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
                            @endif
                        </td>
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

