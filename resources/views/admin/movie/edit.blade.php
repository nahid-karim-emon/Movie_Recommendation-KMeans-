@extends('admin/layout')
@section('title', 'Edit Movie | Admin Dashboard')
@section('content')


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Editing Movie : {{ $data->title }}</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Movie
            <a href="{{ route('admin.movie.index') }}" class="float-right btn btn-success btn-sm"> <i class="fa fa-arrow-left"></i> View All </a> </h6>
        </div>
        <div class="card-body">
            @error('country') <div class="alert alert-danger">{{ $message }}</div> @enderror
            @error('genre') <div class="alert alert-danger">{{ $message }}</div> @enderror
            @error('cast') <div class="alert alert-danger">{{ $message }}</div> @enderror
            @error('director') <div class="alert alert-danger">{{ $message }}</div> @enderror
            @error('language') <div class="alert alert-danger">{{ $message }}</div> @enderror
            @error('pcompany') <div class="alert alert-danger">{{ $message }}</div> @enderror
            <div class="container">
                <form method="POST" action="{{ route('admin.movie.update',$data->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    {{-- Poster  --}}
                <div class="row border p-2 border-light">
                  <div class="col-md-4">
                    <label for="selectedItems">Poster <span class="text-danger">*</span></label>
                  </div>
                  <div class="col-md-8">
                    <input name="photo" type="file">
                    <input name="prev_photo" type="hidden" value="{{ $data->photo }}">
                    <img width="100" src="{{$data->photo ? asset('storage/'.$data->photo) : ''}}" >
                  </div>
                </div>
                {{-- Title  --}}
                <div class="row border p-2 border-light">
                    <div class="col-md-4">
                      <label for="selectedItems">Movie Title <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-8">
                        <input required name="title" type="text" class="form-control" value="{{ $data->title }}">
                    </div>
                  </div>
                  {{-- Release  --}}
                <div class="row border p-2 border-light">
                    <div class="col-md-4">
                      <label for="selectedItems">Release Date <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-8">
                        <input required name="release" type="date" class="form-control" value="{{ $data->release }}">
                    </div>
                  </div>
                  {{-- Country  --}}
                <div class="row border p-2 border-light">
                  <div class="col-md-4">
                    <label for="selectedItems">Country <span class="text-danger">*</span></label>
                  </div>
                  
                  <div class="col-md-8">
                    <select name="country[]" class="form-select" id="country-field" data-placeholder="Choose Country" multiple>
                        @foreach ($countries as $cr)
                        <option
                        @foreach ($data->MovieCountry as $MovieCountry) 
                        @if ($MovieCountry->country->id == $cr->id)
                        @selected(true)
                        @endif
                        @endforeach
                        value="{{$cr->id}}">{{$cr->title}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                  {{-- Genre  --}}
                <div class="row border p-2 border-light">
                    <div class="col-md-4">
                      <label for="selectedItems">Genre <span class="text-danger">*</span></label>
                    </div>
                    
                    <div class="col-md-8">
                      <select name="genre[]" class="form-select" id="genre-field" data-placeholder="Choose Genre" multiple>
                          @foreach ($genres as $gr)
                          <option
                          @foreach ($data->MovieGenre as $MovieGenre) 
                          @if ($MovieGenre->genre->id == $gr->id)
                          @selected(true)
                          @endif
                          @endforeach
                          value="{{$gr->id}}">{{$gr->title}}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                  {{-- Cast  --}}
                <div class="row border p-2 border-light">
                    <div class="col-md-4">
                      <label for="selectedItems">Cast <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-8">
                        <select multiple required name="cast[]" class="form-select" id="cast-field" data-placeholder="Choose Cast">
                            @foreach ($casts as $cast)
                            <option 
                            @foreach ($data->MovieCast as $MovieCast) 
                            @if ($MovieCast->cast->id == $cast->id)
                            @selected(true)
                            @endif
                            @endforeach
                            value="{{$cast->id}}">{{$cast->name}}</option>
                            @endforeach
                        </select>
                    </div>
                  </div>
                  {{-- Director  --}}
                <div class="row border p-2 border-light">
                    <div class="col-md-4">
                      <label for="selectedItems">Director <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-8">
                        <select multiple required name="director[]" class="form-select" id="director-field" data-placeholder="Choose Director">
                            @foreach ($directors as $director)
                            <option
                            @foreach ($data->MovieDirector as $MovieDirector) 
                            @if ($MovieDirector->director->id == $director->id)
                            @selected(true)
                            @endif
                            @endforeach
                            value="{{$director->id}}">{{$director->name}}</option>
                            @endforeach
                        </select>
                    </div>
                  </div>
                  {{-- Production Company  --}}
              <div class="row border p-2 border-light">
                    <div class="col-md-4">
                      <label for="selectedItems">Production Company <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-8">
                        <select multiple required name="pcompany[]" class="form-select" id="pcompany-field" data-placeholder="Choose Production Company">
                            @foreach ($pcompanys as $pcompany)
                            <option
                            @foreach ($data->MoviePcompany as $MoviePcompany) 
                            @if ($MoviePcompany->pcompany->id == $pcompany->id)
                            @selected(true)
                            @endif
                            @endforeach
                            value="{{$pcompany->id}}">{{$pcompany->title}}</option>
                            @endforeach
                        </select>
                    </div>
                  </div>
                  {{-- Language  --}}
                <div class="row border p-2 border-light">
                  <div class="col-md-4">
                    <label for="selectedItems">Language <span class="text-danger">*</span></label>
                  </div>
                  <div class="col-md-8">
                      <select multiple required name="language[]" class="form-select" id="language-field" data-placeholder="Choose Language">
                          @foreach ($languages as $language)
                          <option
                          @foreach ($data->MovieLanguage as $MovieLanguage) 
                          @if ($MovieLanguage->language->id == $language->id)
                          @selected(true)
                          @endif
                          @endforeach
                          value="{{$language->id}}">{{$language->title}}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
                
                  {{-- Info  --}}
                <div class="row border p-2 border-light">
                    <div class="col-md-4">
                      <label for="selectedItems">Info <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-8">
                        <textarea name="info" class="form-control">{{ $data->info }}</textarea>
                    </div>
                  </div>
                {{-- Submit Button --}}
                <div class="row">
                    <div class="col-md-12 mt-2">
                <button type="submit" class="btn btn-block btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
    {{-- Multi Data --}}
    <script>
        $( '#country-field' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '50%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: false,
        } );
        $( '#genre-field' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '50%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: false,
        } );
        $( '#cast-field' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '50%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: false,
        } );
        $( '#director-field' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '50%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: false,
        } );
        $( '#language-field' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '50%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: false,
        } );
        $( '#pcompany-field' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '50%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: false,
        } );
    </script>
    @section('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endsection
@endsection

