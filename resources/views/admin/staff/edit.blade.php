@extends('admin/layout')
@section('title', 'Edit Staff')
@section('content')


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Editing Staff: {{ $data->name }}</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Staff
            <a href="{{ url('admin/staff/'.$data->id) }}" class="float-right btn btn-success btn-sm"> <i class="fa fa-arrow-left"></i> View All </a> </h6>
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
            <form method="POST" action="{{ route('admin.staff.update',$data->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tbody>
                    <tr>
                            <th>Select Department</th>
                            <td>
                                <select required name="department_id" class="form-control">
                                    <option value="0">--- Select Department ---</option>
                                    @foreach ($departs as $dp)
                                    <option @if ($data->department_id==$dp->id)
                                        @selected(true)
                                    @endif
                                     value="{{$dp->id}}">{{$dp->title}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    <tr><tr>
                        <th>Photo</th>
                        <td>
                            <table class="table table-bordered">
                                <td>
                                    <input name="photo" type="file">
                                </td>
                            <td> <img width="100" src="{{$data->photo ? asset('storage/'.$data->photo) : ''}}" >
                            </td>
                            <input name="prev_photo" type="hidden" value="{{ $data->photo }}"></table>
                            
                    </tr>
                    <tr>
                        <th>Full Name <span class="text-danger">*</span></th>
                        <td><input required name="name" type="text" class="form-control" value="{{ $data->name }}"></td>
                    </tr><tr>
                        <th>Bio</th>
                        <td><textarea name="bio" class="form-control">{{ $data->bio }}</textarea></td>
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

