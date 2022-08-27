@extends('adminlte::page')

@section('title', 'Shelves')

@section('content_header')
    <h1>Shelves</h1>
@stop

@section('content')
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        </div>
    @endif
    @if (session('info'))
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-exclamation-triangle"></i> {{ session('info') }}!</h5>
        </div>
    @endif

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 my-3">
                <div class="card mb-4 shadow-sm card-outline card-primary">
                    <div class="card-header ">
                        <h3 class="card-title mt-1">
                            Shelves Listing
                        </h3>
                        <div class="card-tools">
                            <a class="btn btn-primary" href="{{ route('shelves.create') }}">
                                <i class="fa fa-plus"></i> Create Shelf
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped table-hover table-bordered" id="boxTable">
                            <thead>
                            <tr>
                                <th>Shelf ID</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <iframe id="printf" name="printf"  style="visibility: hidden;" src="about:blank"></iframe>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.css">
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.js"></script>

    <script>
        let $boxTable;
        $(document).ready( function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let $boxTable = $('#boxTable').DataTable({
                responsive: true,
                serverSide: true,
                ajax: "{{route('shelves.index')}}",
                columns: [
                    {data: 'shelf_id',name: 'shelf_id'},
                    {data: 'created_at',name: 'created_at'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false},
                ]
            });


            $(document).on('click', '.qrcode', function (e) {
                e.stopPropagation();
                let $tr = $(this).closest('tr');
                let rowId = $tr.attr('ID');
                let url = "{{route('qrcode',':id')}}"
                url = url.replace(':id',rowId);
                document.getElementById('printf').src = url;
            });

            $(document).on('click', '.show-btn', function (e) {
                e.stopPropagation();
                let $tr = $(this).closest('tr');
                let rowId = $tr.attr('ID');
                $(location).attr('href', 'box/'+rowId);
            });

            $(document).on('click', '.edit-btn', function (e) {
                e.stopPropagation();
                let $tr = $(this).closest('tr');
                let rowId = $tr.attr('ID');
                $(location).attr('href', 'box/'+rowId+'/edit');
            });

        });
    </script>
@stop

