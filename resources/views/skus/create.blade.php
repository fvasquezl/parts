@extends('adminlte::page')

@section('title', 'Skus Listing')

@section('content_header')
    <h1>Skus</h1>
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
                        <form>
                            <div class="form-row align-items-center">
                                <div class="col-sm-3 my-1">
                                    <select name="brand" aria-label="select brand" id="brand"
                                            class="myselect2 form-control">
                                        <option value="0">Brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->Brand }}"
                                                {{ old('brand') ? 'selected':''}}>
                                                {{ $brand->Brand }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3 my-1">

                                    <select name="model" aria-label="select model" id="model"
                                            class="myselect2 form-control">
                                        <option value="0">Model</option>
                                        @foreach ($models as $model)
                                            <option value="{{ $model->Model }}"
                                                {{ old('model') ? 'selected':''}}>
                                                {{ $model->Model }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-body">

                        <table class="table table-striped table-hover table-bordered nowrap" id="kitsTable">
                            <thead>
                            <tr>
                                <th>Ref_SKU</th>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Version</th>
                                <th>Country Manufactured</th>
                                <th>Chasis</th>
                                <th>Product Version Number</th>
                                <th>Open Cell</th>
                                <th>Main Board</th>
                                <th>T-Con Board</th>
                                <th>Power Supply</th>
                                <th>WiFi Module</th>
                                <th>IR Sensor</th>
                                <th>Button Set</th>
                                <th>Blutooth Module</th>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap4.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"/>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let $kitsTable;
        let brand;
        let model;

        $('.myselect2').select2({
            theme: 'bootstrap4',
        });

        $(document).ready( function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let $kitsTable = $('#kitsTable').DataTable({
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
                        title: 'Skus to Excel',
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
                        },{
                            text: '<i class="fas fa-bolt"></i> Add SKU',
                            title: 'Create New Sku',
                            titleAttr: 'Create New Sku',
                            className: 'btn btn-primary',
                            attr: {
                                id: 'create-sku-btn'
                            },
                            init: function (api, node, config) {
                                $(node).removeClass('btn-secondary buttons-html5')
                            },
                            action: function ( e, dt, node, config ) {
                                brand = $( "#brand option:selected" ).text().trim();
                                model = $( "#model option:selected" ).text().trim();
                                window.location = '/sku/step1?brand='+brand+'&model='+model;

                            }
                        }
                    ],
                },

                ajax: "{{route('skus.create')}}",
                columns: [
                    {data: 'ref_sku',name:'ref_sku'},
                    {data: 'brand',name:'brand'},
                    {data: 'model',name:'model'},
                    {data: 'version',name:'version'},
                    {data: 'country_manufactured',name:'country_manufactured'},
                    {data: 'chasis',name:'chasis'},
                    {data: 'product_version_number',name:'product_version_number'},
                    {data: 'Open Cell',name:'Open Cell'},
                    {data: 'Main Board',name:'Main Board'},
                    {data: 'T-Con Board',name:'T-Con Board'},
                    {data: 'Power Supply',name:'Power Supply'},
                    {data: 'WiFi Module',name:'WiFi Module'},
                    {data: 'IR Sensor',name:'IR Sensor'},
                    {data: 'Button Set',name:'Button Set'},
                    {data: 'Blutooth Module',name:'Blutooth Module'},


                ],
                // columnDefs: [
                //     {
                //         targets: [0],
                //         searchable: true,
                //         // visible: false,
                //
                //     },
                //     {
                //         targets: [3],
                //         searchable: false,
                //         // visible: false,
                //     },
                // ]
            });
            step1.index


            {{--$(document).on('click', '.qrcode', function (e) {--}}
            {{--    e.stopPropagation();--}}
            {{--    let $tr = $(this).closest('tr');--}}
            {{--    let rowId = $tr.attr('ID');--}}
            {{--    let url = "{{route('qrcode',':id')}}"--}}
            {{--    url = url.replace(':id',rowId);--}}
            {{--    document.getElementById('printf').src = url;--}}
            {{--});--}}

            // $(document).on('click', '.show-btn', function (e) {
            //     e.stopPropagation();
            //     let $tr = $(this).closest('tr');
            //     let rowId = $tr.attr('ID');
            //     $(location).attr('href', 'kits/'+rowId);
            // });
            //
            // $(document).on('click', '.edit-btn', function (e) {
            //     e.stopPropagation();
            //     let $tr = $(this).closest('tr');
            //     let rowId = $tr.attr('ID');
            //     $(location).attr('href', 'kits/'+rowId+'/edit');
            // });

            // $(document).on('click', '.del-btn', function (e) {
            //
            //     e.stopPropagation();
            //     e.stopImmediatePropagation();
            //
            //     let $tr = $(this).closest('tr');
            //     let rowId = $tr.attr('ID');
            //     let url = 'kits/'+rowId;
            //
            //     Swal.fire({
            //         title: 'Are you sure?',
            //         text: "You won't be able to revert this!",
            //         icon: 'warning',
            //         showCancelButton: true,
            //         confirmButtonColor: '#3085d6',
            //         cancelButtonColor: '#d33',
            //         confirmButtonText: 'Yes, delete it!'
            //     }).then((result) => {
            //         if (result.value) {
            //             let request = $.ajax({
            //                 url: url,
            //                 type: 'delete',
            //                 dataType: 'json',
            //             });
            //             request.done(function (data) {
            //                 Swal.fire(
            //                     'Deleted!',
            //                     data.message,
            //                     'success'
            //                 );
            //                 $kitsTable.draw();
            //             });
            //             request.fail(function (jqXHR, textStatus, errorThrown) {
            //                 Swal.fire('Failed!', "There was something wrong", "warning");
            //             });
            //         }
            //     });
            //
            //
            //     // e.stopPropagation();
            //     // let $tr = $(this).closest('tr');
            //     // let rowId = $tr.attr('ID');
            //     // $(location).attr('href', 'kits/'+rowId+'/edit');
            // });
        });


    </script>
@stop



