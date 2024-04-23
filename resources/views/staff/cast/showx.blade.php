@extends('staff/layout')
@section('title', 'Cast Details')
@section('content')


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"> Cast Details </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Cast Details of <span class="bg-warning">-- {{ $data->name }} -- </span> 
            <a href="{{ route('staff.cast.index') }}" class="float-right btn btn-success btn-sm"> <i class="fa fa-arrow-left"></i> View All </a> </h6>
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
                <table class="table table-bordered" width="100%">
                    <tr>
                        <th>Type</th>
                        @if ($data->gender=='male')
                        <td class="bg-info text-white"> Actor </td>
                        @else
                        <td class="bg-primary text-white"> Actress</td>
                        @endif
                    </tr>
                    <tr>
                        <th>Photo</th>
                        <td><img width="100" src="{{$data->photo ? asset('storage/'.$data->photo) : url('images/user.png')}}" alt="{{ $data->name }}'s Photo"></td>
                    </tr>
                    <tr>
                        <th> Name </th>
                        <td>{{ $data->name }}</td>
                    </tr>
                    <tr>
                        <th> Bio </th>
                        <td>{{ $data->bio }}</td>
                    </tr>
                    <tr>
                        <th>Country</th>
                        <td>{{ $data->country }}</td>
                    </tr>
                    <tr>
                        <th>Spouse </th>
                        <td>{{ $data->spouse ? $data->spouse : 'Single' }}</td>
                    </tr>
                    @if($data->spouse)
                    <tr>
                        <th>Children </th>
                        <td>{{ $data->children ? $data->children : 'N/A' }}</td>
                    </tr>
                    @endif
                    <tr>
                        <th>Date of Birth</th>
                        <td>{{ $data->dob }}</td>
                    </tr>
                    @if($data->deathd)
                    <tr>
                        <th>Died on</th>
                        <td>{{ $data->deathd }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td colspan="2">
                            <a href="{{ route('staff.cast.edit',$data->id) }}" class="float-right btn btn-info btn-sm"><i class="fa fa-edit"> Edit Cast: {{ $data->name }}  </i></a>
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

