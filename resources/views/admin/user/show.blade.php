@extends('admin/layout')
@section('title', 'User Details')
@section('content')
<style>
    .movie-poster {
        max-width: 80px;
        height: auto;
        border-radius: 5px;
        object-fit: cover;
    }
    </style>

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"> User Watched Movie List </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Watched Movies 
            <a href="{{ route('admin.user.index') }}" class="float-right btn btn-success btn-sm"> <i class="fa fa-arrow-left"></i> View All </a> </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Poster</th>
                            <th>Name</th>
                            <th>Genre</th>
                            <th>Language</th>
                            <th>Casts</th>
                            <th>Directors</th>
                            <th>Production Company</th>
                            <th>Country</th>
                            <th>Release Date</th>
                            <th>Movie Rating</th>
                            <th>User Given Rating</th>
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
                            <td>
                                <img src="{{ $d->photo ? asset('storage/'.$d->photo) : asset('images/default_poster.jpg') }}" class="movie-poster" alt="{{ $d->title }}">
                              </td>
                            <td><a href="{{ route('movie.show', $d->id) }}">{{$d->title}}</td>
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
                        <td>
                            @php
                            $rating = DB::table('watch_movies')->where('movie_id', $d->id)->where('user_id', $user->id)->first();
                            @endphp
                            @if ($rating)
                            {{ $rating->rating }}
                            @else
                            Not Rated By User
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.movie.show1',$d->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
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

    @section('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endsection
@endsection

