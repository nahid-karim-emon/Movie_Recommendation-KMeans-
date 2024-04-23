@extends('staff/layout')
@section('title', 'Edit Cast | Staff Dashboard')
@section('content')


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Editing Cast : {{ $data->name }}</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Cast Data
            <a href="{{ route('staff.cast.index') }}" class="float-right btn btn-success btn-sm"> <i class="fa fa-arrow-left"></i> View All </a> </h6>
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
            <form method="POST" action="{{ route('staff.cast.update',$data->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tbody>
                    <tr>
                        <th>Gender</th>
                        <td>
                            <select name="gender" class="form-control">
                                <option @if ($data->gender='male') @selected(true) @endif value="male">Male</option>
                                <option @if ($data->gender='female') @selected(true) @endif value="female">Female</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Photo</th>
                        <td><input name="photo" type="file">
                            <input name="prev_photo" type="hidden" value="{{ $data->photo }}">
                            <img width="100" src="{{$data->photo ? asset('storage/'.$data->photo) : ''}}" >
                        </td>
                    </tr>
                    <tr>
                        <th>Name <span class="text-danger">*</span></th>
                        <td><input required name="name" type="text" class="form-control" value="{{ $data->name }}"></td>
                    </tr>
                    <tr>
                        <th>Date of Birth <span class="text-danger">*</span></th>
                        <td><input required name="dob" type="date" class="form-control" value="{{ $data->dob }}"></td>
                    </tr>
                    <tr>
                        <th>Bio</th>
                        <td><textarea name="bio" class="form-control">{{ $data->bio }}</textarea></td>
                    </tr>
                    <tr>
                        <th>Country <span class="text-danger">*</span></th>
                        <td><input required name="country" type="text" class="form-control" value="{{ $data->country }}"></td>
                    </tr>
                    <tr>
                        <th>Education</th>
                        <td><input name="education" type="text" class="form-control" value="{{ $data->education }}"></td>
                    </tr>
                    <tr>
                        <th>Spouse </th>
                        <td><input name="spouse" type="text" class="form-control" value="{{ $data->spouse }}"></td>
                    </tr>
                    <tr>
                        <th>Children</th>
                        <td><input name="children" type="text" class="form-control" value="{{ $data->children }}"></td>
                    </tr>
                    <tr>
                        <th>Date of Death </th>
                        <td><input name="deathd" type="date" class="form-control" value="{{ $data->deathd }}"></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <select name="status" class="form-control">
                                <option @if ($data->status=1) @selected(true) @endif value="1">Active</option>
                                <option @if ($data->status=0) @selected(true) @endif value="0">Disable</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit" class="btn btn-primary">Update</button>
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

