@extends('adminlte::page')

@section('title', 'Kits Listing')

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
                                <th>ID</th>
                                <th>Kit LCN</th>
                                <th>BoxID</th>
                                <th>Actions</th>
                                <th>SKU Count</th>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Ref SKU</th>
                                <th>Images Qty</th>
                                <th>Parts Qty</th>
                                <th>Url</th>
                                <th>Keywords</th>
                                <th>CapturedBy</th>
                                <th>Created At</th>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap4.min.css">


@stop

@section('js')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
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

            $kitsTable = $('#kitsTable').DataTable({
                order: [[0, 'desc']],
                pageLength: 100,
                lengthMenu: [
                    [100,500, -1],
                    [100,500,'All']
                ],
                processing: true,
                serverSide: true,
                scrollY: "53vh",
                scrollX: true,
                scrollCollapse: true,
                stateSave: true,
                dom: '"<\'row\'<\'col-md-6\'B><\'col-md-6\'f>>" +\n' +
                    '"<\'row\'<\'col-sm-12\'tr>>" +\n' +
                    '"<\'row\'<\'col-sm-12 col-md-5\'i ><\'col-sm-12 col-md-7\'p>>"',
                buttons: {
                    dom: {
                        container: {
                            tag: 'div',
                            className: 'flexcontent'
                        },
                        buttonLiner: {
                            tag: null
                        }
                    },
                    buttons: [{
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        title: 'Kits to Excel',
                        titleAttr: 'Excel',
                        className: 'btn btn-success',
                        init: function (api, node, config) {
                            $(node).removeClass('btn-secondary buttons-html5 buttons-excel')
                        },
                    },
                        {
                            extend: 'pageLength',
                            titleAttr: 'Show Records',
                            className: 'btn btn-secondary buttons-collection dropdown-toggle buttons-colvis',
                        }
                    ],
                },

                ajax: "{{route('kits.index')}}",
                columns: [
                    {data: 'kitid', name: 'kitid'},
                    {data: 'kitlcn', name: 'kitlcn'},
                    {data: 'boxname', name: 'boxname'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false},
                    {data: 'SKU_count', name: 'SKU_count'},
                    {data: 'brand', name: 'brand'},
                    {data: 'model', name: 'model'},
                    {data: 'ref_sku', name: 'ref_sku'},
                    {data: 'image_count', name: 'image_count'},
                    {data: 'noofparts', name: 'noofparts'},
                    {data: 'url', name: 'url'},
                    {data: 'keywords', name: 'keywords'},
                    {data: 'name', name: 'name'},
                    {data: 'created_at', name: 'created_at'},
                ],
                columnDefs: [
                    {
                        targets: [0],
                        searchable: true,
                        // visible: false,

                    },
                    {
                        targets: [9],
                        searchable: false,
                        // visible: false,
                    },
                    {
                        targets: [10],
                        searchable: true,
                        visible: false
                    },
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



