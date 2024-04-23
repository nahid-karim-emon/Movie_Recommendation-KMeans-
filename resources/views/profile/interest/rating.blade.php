@extends('layout')
@section('title', 'Edit Interest | Staff Dashboard')
@section('content')


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Editing Rating Interest </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Rating Interest</h6>
        </div>
        <div class="card-body">
            <div class="container">
                <form method="POST" action="{{ route('user.interest.ratingUpdate',$data->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                  {{-- Genre  --}}
                  @foreach ($InterestRatingData as $key => $InterestRating)
                <div class="row border p-2 border-light">
                    <div class="col-md-4 ">
                      @switch($InterestRating->rating_id)
                        @case(1)
                            <div class="m-1 p-1 bg-info text-white form-control"> IMDB RATING (?/10)</div>  
                            @break
                        @case(2)
                            <div class="m-1 p-1 bg-danger text-white form-control"> Rotten Tommetoes RATING (?/100)</div>  
                            @break
                        @case(3)
                            <div class="m-1 p-1 bg-warning text-white form-control"> Extra RATING (?/5)</div>  
                            @break
                        @default
                            
                        @endswitch
                    </div>
                    
                    <div class="col-md-8">
                        <input type="number" required class="form-control" name={{ 'rating'.$InterestRating->rating_id }}
                        @switch($InterestRating->rating_id)
                        @case(1)
                            max='10'
                            @break
                        @case(2)
                            max='100'
                            @break
                        @case(3)
                            max='5'
                            @break
                        @default
                            max='100'
                        @endswitch
                       value="{{ $InterestRating->ratings }}">
                      </div>
                    </div>
                    
                    @endforeach
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
    @section('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endsection
@endsection

