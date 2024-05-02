@extends('admin/layout')
@section('title', 'User Details')
@section('content')


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"> User Details </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User Details of {{ $data->name }} 
            <a href="{{ route('admin.user.index') }}" class="float-right btn btn-success btn-sm"> <i class="fa fa-arrow-left"></i> View All </a> </h6>
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
                <table class="table table-bordered" width="100%">
                        <tr>
                            <th>Full Name </th>
                            <td>{{ $data->name }}</td>
                        </tr>
                        <tr>
                            <th>Age</th>
                            <td>{{ $data->age }}</td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td>{{ $data->gender }}</td>
                        </tr>
                        <tr>
                            <th>Nationality</th>
                            <td>{{ $data->nationality }}</td>
                        </tr>
                        <tr>
                            <th>Educational Level</th>
                            <td>{{ $data->educational_level }}</td>
                        </tr>
                        <tr>
                            <th>Language</th>
                            <td>{{ $data->language }}</td>
                        </tr>
                        <tr>
                            <th>Religion</th>
                            <td>{{ $data->religion }}</td>
                        </tr>
                        <tr>
                            <th>Maritial Status</th>
                            <td>{{ $data->maritial_status }}</td>
                        </tr>
                        <tr>
                            <th>Occupation</th>
                            <td>{{ $data->occupation }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $data->email }}</td>
                        </tr><tr>
                            <th>Mobile No </th>
                            <td>{{ $data->mobile }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $data->address }}</td>
                        </tr>
                        
                        <tr>
                            <td colspan="2">
                                <a href="{{ route('admin.user.edit',$data->id) }}" class="float-right btn btn-info btn-sm"><i class="fa fa-edit"> Edit User: {{ $data->name }}  </i></a>
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

