@extends('admin/layout')
@section('title', 'Support Ticket Details')
@section('content')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Support Ticket Details of {{ $data->student->name }} - {{ $data->student->rollno }} 
            <a href="{{ url('admin/support') }}" class="float-right btn btn-success btn-sm"> <i class="fa fa-arrow-left"></i> View All </a> </h6>
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
                <table class="table table-bordered" width="100%">
                    <tr>
                        <th>Ticket No</th>
                        <td>{{ $data->id }}</td>
                    </tr>
                    <tr>
                        <th>Ticket By</th>
                        <td>{{ $data->student->name }} - {{ $data->student->rollno }} </td>
                    </tr>
                    <tr>
                        <th>Subject</th>
                        <td>{{ $data->subject }}</td>
                    </tr><tr>
                        <th>Details</th>
                        <td>{{ $data->message }}</td>
                    </tr>
                    <tr>
                        <th>Reply</th>
                        <td>
                            @if($data->reply)
                            {{ $data->reply }}
                            @else
                            No Reply Yet!
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Replied By</th>
                        <td>
                            @if($data->reply)
                            {{ $data->staff->name }}
                            @else
                            No Reply Yet!
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Ticket Creation Date</th>
                        <td>{{ $data->created_at }}</td>
                    </tr>
                    <tr>
                        <th>Ticket Replied Date</th>
                        <td>{{ $data->updated_at }}</td>
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

