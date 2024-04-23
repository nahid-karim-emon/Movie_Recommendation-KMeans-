@extends('admin/layout')
@section('title', 'Add New Director | Admin Dashboard')
@section('content')


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Add New Director</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> New User
            <a href="{{ route('admin.director.index') }}" class="float-right btn btn-success btn-sm"> <i class="fa fa-arrow-left"></i> View All </a> </h6>
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                   <p class="text-danger"> {{ $error }} </p>
                @endforeach
                @endif
            <form method="POST" action="{{ route('admin.director.store') }}" enctype="multipart/form-data">
                @csrf
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tbody>
                    <tr>
                        <th>Gender</th>
                        <td>
                            <select name="gender" class="form-control">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Photo</th>
                        <td><input name="photo" type="file" required></td>
                    </tr>
                    <tr>
                        <th> Name <span class="text-danger">*</span></th>
                        <td><input required name="name" type="text" class="form-control"></td>
                    </tr>
                    <tr>
                        <th>Date of Birth <span class="text-danger">*</span></th>
                        <td><input required name="dob" type="date" class="form-control" ></td>
                    </tr>
                    <tr>
                        <th>Bio<span class="text-danger">*</span></th>
                        <td><textarea name="bio" class="form-control"></textarea></td>
                    </tr>
                    <tr>
                        <th>Country <span class="text-danger">*</span></th>
                        <td><input required name="country" type="text" class="form-control"></td>
                    </tr>
                    <tr>
                        <th>Education</th>
                        <td><input name="education" type="text" class="form-control"></td>
                    </tr>
                    <tr>
                        <th>Spouse </th>
                        <td><input name="spouse" type="text" class="form-control" value=""></td>
                    </tr>
                    <tr>
                        <th>Children</th>
                        <td><input  name="children" type="text" class="form-control" value=""></td>
                    </tr>
                    <tr>
                        <th>Date of Death </th>
                        <td><input  name="deathd" type="date" class="form-control" value=""></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <select name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Disabled</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
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

