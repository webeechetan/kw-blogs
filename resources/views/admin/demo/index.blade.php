@extends('admin.layouts.app')
@section('title', 'Demo')

@section('styles')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Customer List for Demo Bookings</h5>
        </div>
        <div class="table-responsive text-nowrap">
            <div class="container">
                <table class="table" id="datatable-demo">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($demos as $demo)
                        <tr>
                            <td>{{$demo->name}}</td>
                            <td>{{$demo->email}}</td>
                            <td>{{$demo->phone}}</td>
                            {{-- <td>{{$demo->message}}</td> --}}
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$demo->id}}">
                                    View Message
                                </button>
                            </td>
                            <td>
                                <form action="{{ route('demo.destroy' , $demo->id) }}" method="POST" class="d-inline" id="deleteForm{{$demo->id}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete({{$demo->id}})" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>

                        
                    <div class="modal fade" id="exampleModal{{$demo->id}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$demo->id}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel{{$demo->id}}">Message</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="contact-message">
                                            {{$demo->message}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                        @endforeach
                    </tbody>
                 
                  

                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#datatable-demo').DataTable();
        } );

        function confirmDelete(contactUs) 
        {
            if (confirm('Are you sure you want to delete this contact?')) {
                document.getElementById('deleteForm'+contactUs).submit();
            }
        }
    </script>
@endsection