@extends('admin/layout')
@section('title', 'Production Company | Admin Dashboard')

@section('content')


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Production Companys</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Production Company Data
            <a href="{{ route('admin.pcompany.create') }}" class="float-right btn btn-success btn-sm" target="_self">Add New</a> </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Title</th>
                            <th>Founded</th>
                            <th>Founders</th>
                            <th>Genre</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Title</th>
                            <th>Founded</th>
                            <th>Founders</th>
                            <th>Genre</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if($data)
                        @foreach ($data as $key => $d)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td><img width="150px" height="150px"
                                src="{{$d->photo ? asset('storage/'.$d->photo) : asset('images/productioncompany.jpg')}}"
                                alt="{{ $d->title }}'s Photo"
                            />
                            </td>
                            <td>{{ $d->title }}</td>
                            @php
                                $date = \Illuminate\Support\Carbon::create($d->founded);
                                $formattedDate = $date->formatLocalized('%B %d, %Y');
                            @endphp
                            <td>{{ $formattedDate }}</td>
                            <td>{{ $d->founders }}</td>
                            <td>{{ $d->genre->title }}</td>
                            
                            <td class="text-center">
                                <a href="{{ route('admin.pcompany.show',$d->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('admin.pcompany.edit',$d->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                <a onclick="return confirm('Are You Sure?')" href="{{ url('admin/pcompany/'.$d->id.'/delete') }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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

