@extends('layout')
@section('title', 'Edit Interest | User Dashboard')
@section('content')


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Editing Interest </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Interest
        </div>
        <div class="card-body">
            <div class="container">
                <form method="POST" action="{{ route('user.interest.editUpdate',$data->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                   
                    {{-- Country  --}}
                <div class="row border p-2 border-light">
                  <div class="col-md-4">
                    <label for="selectedItems">Interested Country <span class="text-danger">*</span></label>
                  </div>
                  {{-- Country --}}
                  <div class="col-md-8">
                    <select name="country[]" class="form-select" id="country-field" data-placeholder="Choose Country" multiple>
                        @foreach ($countries as $cr)
                        <option
                        @foreach ($data->InterestCountry as $InterestCountry) 
                        @if ($InterestCountry->country->id == $cr->id)
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
                          @foreach ($data->InterestGenre as $InterestGenre) 
                          @if ($InterestGenre->genre->id == $gr->id)
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
                            @foreach ($data->InterestCast as $InterestCast) 
                            @if ($InterestCast->cast->id == $cast->id)
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
                            @foreach ($data->InterestDirector as $InterestDirector) 
                            @if ($InterestDirector->director->id == $director->id)
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
                            @foreach ($data->InterestPcompany as $InterestPcompany) 
                            @if ($InterestPcompany->pcompany->id == $pcompany->id)
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
                          @foreach ($data->InterestLanguage as $InterestLanguage) 
                          @if ($InterestLanguage->language->id == $language->id)
                          @selected(true)
                          @endif
                          @endforeach
                          value="{{$language->id}}">{{$language->title}}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
                {{-- Submit Button --}}
                <div class="row">
                    <div class="col-md-12 mt-2">
                      <input name="user_id" type="hidden" value="{{ $user->id }}">
                <button type="submit" class="btn btn-block btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
    {{-- Multi Data --}}
    <script>
        $( '#genre-field' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '50%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: false,
        } );
        $( '#country-field' ).select2( {
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

