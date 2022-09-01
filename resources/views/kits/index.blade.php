@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Kits</h1>
@stop

@section('content')
    <div class="container-fluid">
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

        <div class="row">
            <div class="col-lg-12 ">
                <div class="card mb-4 shadow-sm card-outline card-primary">
                    <div class="card-header ">
                        <h3 class="card-title mt-1">
                            Kits Listing
                        </h3>
                        <div class="card-tools">

                            <a class="btn btn-primary" href="{{ route('kits.create') }}">
                                <i class="fa fa-plus"></i> Create Kit
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped table-hover table-bordered nowrap" id="kitsTable">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Actions</th>
                                <th>LCN</th>
                                <th>WorkCenter</th>
                                <th>Kit LCN</th>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>Serial Number</th>
                                <th>Country</th>
                                <th>Manuf. At</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <iframe id="printf" name="printf"  style="visibility: hidden;" src="about:blank"></iframe>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.css">


@stop

@section('js')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let $kitsTable;
        $(document).ready( function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let $kitsTable = $('#kitsTable').DataTable({
                order: [[0, 'desc']],
                responsive: true,

                scrollY: "53vh",
                ajax: "{{route('kits.index')}}",
                columns: [
                    {data: 'KitID',name: 'KitID'},
                    {data: 'Actions', name: 'Actions', orderable: false, searchable: false},
                    {data: 'LCN',name: 'LCN'},
                    {data: 'WorkCenter',name: 'WorkCenter'},
                    {data: 'KitLCN',name: 'KitLCN'},
                    {data: 'Brand',name: 'Brand'},
                    {data: 'Model',name: 'Model'},
                    {data: 'CategoryName',name: 'CategoryName'},
                    {data: 'SubCategoryName',name: 'SubCategoryName'},
                    {data: 'ProductSerialNumber',name: 'ProductSerialNumber'},
                    {data: 'Country',name: 'Country'},
                    {data: 'DateManufactured',name: 'DateManufactured'}
                ],
                columnDefs: [
                    {
                        targets: [1],width: 100
                    }

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
                $(location).attr('href', 'kits/'+rowId);
            });

            $(document).on('click', '.edit-btn', function (e) {
                e.stopPropagation();
                let $tr = $(this).closest('tr');
                let rowId = $tr.attr('ID');
                $(location).attr('href', 'kits/'+rowId+'/edit');
            });

            $(document).on('click', '.del-btn', function (e) {

                e.stopPropagation();
                e.stopImmediatePropagation();

                let $tr = $(this).closest('tr');
                let rowId = $tr.attr('ID');
                let url = 'kits/'+rowId;

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        let request = $.ajax({
                            url: url,
                            type: 'delete',
                            dataType: 'json',
                        });
                        request.done(function (data) {
                            Swal.fire(
                                'Deleted!',
                                data.message,
                                'success'
                            );
                            $kitsTable.draw();
                        });
                        request.fail(function (jqXHR, textStatus, errorThrown) {
                            Swal.fire('Failed!', "There was something wrong", "warning");
                        });
                    }
                });


                // e.stopPropagation();
                // let $tr = $(this).closest('tr');
                // let rowId = $tr.attr('ID');
                // $(location).attr('href', 'kits/'+rowId+'/edit');
            });
        });


    </script>
@stop



