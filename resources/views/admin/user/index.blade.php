@extends('admin/layout')
@section('title', 'Users')

@section('content')


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Users</h1>
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
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User Data
            <a href="{{ route('admin.user.create') }}" class="float-right btn btn-success btn-sm" target="_self">Add New </a> </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Nationality</th>
                            <th>Educational Level</th>
                            <th>Language</th>
                            <th>Religion</th>
                            <th>Marital Status</th>
                            <th>Occupation</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($data)
                        @foreach ($data as $key=> $d)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->age }}</td>
                            <td>{{ $d->gender }}</td>
                            <td>{{ $d->nationality }}</td>
                            <td>{{ $d->educational_level }}</td>
                            <td>{{ $d->language }}</td>
                            <td>{{ $d->religion }}</td>
                            <td>{{ $d->maritial_status }}</td>
                            <td>{{ $d->occupation }}</td>
                            <td>{{ $d->email }}</td>
                            <td>{{ $d->mobile }}</td>
                            
                            <td class="text-center">
                                <a href="{{ route('admin.user.show',$d->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('admin.user.edit',$d->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                <a onclick="return confirm('Are You Sure?')" href="{{ url('admin/user/'.$d->id.'/delete') }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
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

