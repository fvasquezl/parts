@extends('adminlte::page')
@section('title', 'SKUS Creation')

@section('content_header')
    <h2>SKUS Creation</h2>
@stop

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-sm card-outline card-primary">
                    <div class="card-header ">
                        <h3 class="card-title mt-1">
                            {{ __('Step2')}}
                        </h3>
                        <div class="card-tools">
                            <b>SKU: {{$sku->ref_sku}}</b>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('steps.update', $sku) }}" enctype="multipart/form-data" id="myForm">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="brand" class="col-form-label text-md-end">{{ __('Brand') }}</label>

                                    <input id="brand" type="text"
                                           class="form-control @error('brand') is-invalid @enderror" name="brand"
                                           value="{{ old('brand',$sku->brand) }}"  autocomplete="off" autofocus>

                                    @error('brand')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="model" class="col-form-label text-md-end">{{ __('Model') }}</label>

                                    <input id="model" type="text"
                                           class="form-control @error('model') is-invalid @enderror" name="model"
                                           value="{{ old('model',$sku->model) }}"  autocomplete="off" autofocus >

                                    @error('model')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="partName" class="col-form-label text-md-end">{{ __('Part Name') }}</label>

                                    <input id="partName" type="text"
                                           class="form-control @error('partName') is-invalid @enderror" name="partName"
                                           value="{{ old('partName') }}"  autocomplete="off" autofocus>

                                    @error('partName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="partRef1" class="col-form-label text-md-end">{{ __('PartRef1') }}</label>

                                    <input id="partRef1" type="text"
                                           class="form-control @error('partRef1') is-invalid @enderror" name="partRef1"
                                           value="{{ old('partRef1') }}"  autocomplete="off" autofocus >

                                    @error('partRef1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="partRef2" class="col-form-label text-md-end">{{ __('Part Ref2') }}</label>

                                    <input id="partRef2" type="text"
                                           class="form-control @error('partRef2') is-invalid @enderror" name="partRef2"
                                           value="{{ old('partRef2') }}"  autocomplete="off" autofocus>

                                    @error('partRef2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="partRef3" class="col-form-label text-md-end">{{ __('Part Ref3') }}</label>

                                    <input id="partRef3" type="text"
                                           class="form-control @error('partRef3') is-invalid @enderror" name="partRef3"
                                           value="{{ old('partRef3') }}"  autocomplete="off" autofocus >

                                    @error('partRef3')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="partRef4" class="col-form-label text-md-end">{{ __('Part Ref4') }}</label>

                                    <input id="partRef4" type="text"
                                           class="form-control @error('partRef4') is-invalid @enderror" name="partRef4"
                                           value="{{ old('partRef4') }}"  autocomplete="off" autofocus>

                                    @error('partRef4')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="partRef5" class="col-form-label text-md-end">{{ __('Part Ref5') }}</label>

                                    <input id="partRef5" type="text"
                                           class="form-control @error('partRef5') is-invalid @enderror" name="partRef5"
                                           value="{{ old('partRef5') }}"  autocomplete="off" autofocus >

                                    @error('partRef5')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <button type="submit" class="btn btn-block btn-primary">
                                    {{ __('Create [F12]') }}
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <a href="" id="msearch"></a>
    </div>

    <div class="row">
        <div class="col-lg-12 ">
            <div class="card mb-4 shadow-sm card-outline card-primary">
                <div class="card-header ">
                    <h3 class="card-title mt-1">
                        Skus Listing
                    </h3>
                    <div class="card-tools">

                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-hover table-bordered nowrap" id="skusTable">
                        <thead>
                        <tr>
                            <th>Ref Sku</th>
                            <th>Actions</th>
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
    <div class="row">
        <div class="col-lg-12 ">
            <div class="card mb-4 shadow-sm card-outline card-primary">
                <div class="card-header ">
                    <h3 class="card-title mt-1">
                        Kits Listing
                    </h3>
                    <div class="card-tools">
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

            let $skusTable = $('#skusTable').DataTable({
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
                        }
                    ],
                },

                ajax: "{{route('skus.index')}}",
                columns: [
                    {data: 'ref_sku',name:'ref_sku'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false},
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
                columnDefs: [
                    {
                        targets: [0],
                        searchable: true,
                        // visible: false,

                    },
                    {
                        targets: [3],
                        searchable: false,
                        // visible: false,
                    },
                ]
            });

            let $kitsTable = $('#kitsTable').DataTable({
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

        });


    </script>
@stop
