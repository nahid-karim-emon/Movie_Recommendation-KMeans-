@extends('admin/layout')
@section('title', ' Cast Details | Admin Dashboard')

@section('content')
<!-- Page Heading -->

    <div class="container py-5">
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
      <h1 class="border border-secondary rounded h3 mb-2 text-gray-800 p-2 bg-white"> {{ $data->name }} </h1> 
      

      <div class="row">
        <div class="col-lg-4">
          <div class="card mb-4">
            <div class="card-body text-center">
                <img src="{{$data->photo ? asset('storage/'.$data->photo) : url('images/data.png')}}" alt="data Photo" class="rounded-circle img-fluid" style="width: 250px;height:250px;">
                <hr>
                <h5 class="m-1 text-justify">{{ $data->bio }}</h5>
              
            </div>
          </div>
          
        </div>
        <div class="col-lg-8">
          <div class="card mb-4">
            <div class="card-body">
                
             <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Full Name</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-bold mb-0">{{ $data->name }}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Birthday </p>
                </div>
                <div class="col-sm-9">
                  <p class="text-bold mb-0">{{ $data->dob }}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Spouse</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{ $data->spouse ? $data->spouse : 'Single' }}</p>
                </div>
              </div>
              <hr>
              @if($data->spouse)
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Childrens</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">{{ $data->children ? $data->children : 'N/A' }}</p>
                    </div>
                    </div>
                <hr>
                @endif
                @if($data->deathd)
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Died on</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">{{ $data->deathd }}</p>
                    </div>
                    </div>
                <hr>
                @endif
                @if($data->education)
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Education</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">{{ $data->education }}</p>
                    </div>
                    </div>
                <hr>
                @endif
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Artist</p>
                    </div>
                    <div class="col-sm-9">
                        
                @if ($data->gender=='male')
                <p class="bg-info text-white mb-0 p-1"> Actor </p>
                @else
                <p class="bg-primary text-white mb-0 p-1"> Actress</p>
                @endif
                    </div>
                </div>
                <hr>
                @isset($data->status)
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Status</p>
                    </div>
                    <div class="col-sm-9">
                        @if ($data->status==1)
                        <p class="bg-success text-white p-1"> Active </p>
                        @else
                        <p class="bg-danger text-white p-1"> Disabled </p>
                        @endif
                    </div>
                    </div>
                <hr>
                @endisset
              <div class="row">
                <div class="col-sm-3 float-left">
                  <a href="{{ route('admin.cast.edit',$data->id) }}"><button type="button" class="btn btn-primary">Edit Cast</button></a>
                </div>
                <div class="col-sm-3 float-right">
                  @if ($data->status==0)
                  <a href="{{ route('admin.cast.edit',$data->id) }}"><button type="button" class="btn btn-warning">Make Active</button></a>
                  @else
                  <a href="{{ route('admin.cast.edit',$data->id) }}"><button type="button" class="btn btn-danger">Make Disable</button></a>
                  @endif
                  
                </div>
                
              </div>
            </div>
          </div>
          
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