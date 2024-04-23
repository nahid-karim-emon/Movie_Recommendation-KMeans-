@extends('staff/layout')
@section('title', 'Production Company Details | Staff Dashboard')
@section('content')


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"> Production Company Details </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Production Company Details of <span class="bg-warning"> {{ $data->title }} </span> 
            <a href="{{ route('staff.pcompany.index') }}" class="float-right btn btn-success btn-sm"> <i class="fa fa-arrow-left"></i> View All </a> </h6>
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
                <table class="table table-bordered" width="100%">
                    <tr>
                        <th>Photo</th>
                        <td><img width="150px" src="{{$data->photo ? asset('storage/'.$data->photo) : asset('images/productioncompany.jpg')}}" alt="{{ $data->name }}'s Photo"></td>
                    </tr>
                    <tr>
                        <th>Title</th>
                        <td>{{ $data->title }}</td>
                    </tr>
                    <tr>
                        <th>Genre</th>
                        <td>{{ $data->genre->title }}</td>
                    </tr>
                    <tr>
                        <th>Founded</th>
                            @php
                                $date = \Illuminate\Support\Carbon::create($data->founded);
                                $formattedDate = $date->formatLocalized('%B %d, %Y');
                            @endphp
                        <td>{{ $formattedDate }}</td>
                    </tr>
                    <tr>
                        <th>Founders</th>
                        <td>{{ $data->founders }}</td>
                    </tr>
                    <tr>
                        <th>President</th>
                        <td>{{ $data->president }}</td>
                    </tr>
                    <tr>
                        <th>Parent Organizations</th>
                        <td>{{ $data->parentorganizations }}</td>
                    </tr>
                    <tr>
                        <th>Info</th>
                        <td>{{ $data->info }}</td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <a href="{{ route('staff.pcompany.edit',$data->id) }}" class="float-right btn btn-info btn-sm"><i class="fa fa-edit"> Edit {{ $data->title }}  </i></a>
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

