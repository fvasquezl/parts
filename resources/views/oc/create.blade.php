@extends('adminlte::page')
@section('title', 'Kits Creation')

@section('content_header')
    <h2>Open Cell Configuration</h2>
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
                <div class="card shadow-sm card-outline card-primary">
                    <div class="card-header ">
                        <h3 class="card-title mt-1 days">
                            {{ __('Open Cell Configuration')}}
                        </h3>
                    </div>

                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label for="brand" class="col-sm-2 col-form-label">Brand</label>
                                <div class="col-sm-10">
                                    <select name="brand" aria-label="select brand" id="brand"
                                            class=" form-control">
                                        <option value="0">Brand</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->brand }}"
                                                    {{ old('brand') ? 'selected':''}}>
                                                    {{ $brand->brand }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="model" class="col-sm-2 col-form-label">Model</label>
                                <div class="col-sm-10">
                                    <select name="model" aria-label="select model" id="model"
                                            class=" form-control modelSelect2">
                                        <option value="0">Model</option>
                                    </select>
                                </div>
                            </div>

                            <hr>
                                <h4>Configured Open Cells (list of configured open cells)</h4>
                            <hr>
                        <table class="table table-striped table-hover table-bordered nowrap" id="openCells">
                            <thead>
                            <tr>
                                <th>CompatibleID</th>
                                <th>Manufacturer</th>
                                <th>Part Number</th>
                                <th>MITSKU</th>
                            </tr>
                            </thead>
                        </table>

                            <hr>
                                <h4>Open Cell Details</h4>
                            <hr>

                            <div class="form-group row">
                                <label for="partNumber" class="col-sm-2 col-form-label">Part Number</label>
                                <div class="col-sm-10">
                                    <select name="partNumber" aria-label="select model" id="partNumber"
                                            class=" form-control">
                                        <option value="0">PartNumber</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="manufacturer" class="col-sm-2 col-form-label">Manufacturer</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="manufacturer" placeholder="Manufacturer" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mitSku" class="col-sm-2 col-form-label">MITSKU</label>
                                <div class="col-sm-10">
                                    <select name="mitSku" aria-label="select model" id="mitSku"
                                            class=" form-control ">
                                        <option value="0">MITSKU</option>
                                            @foreach ($mitSkus as $mitsku)
                                                <option value="{{ $mitsku->MITSKU }}"
                                                    {{ old('ProductSKU') ? 'selected':''}}>
                                                    {{ $mitsku->ProductSKU }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="instructions" class="col-sm-2 col-form-label">Instructions</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="instructions" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="instructions" class="col-sm-2 col-form-label">Assembly Guide</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="assambleGuide">
                                        <label class="custom-file-label" for="assambleGuide">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary mb-4 float-right ">Add Components</button>
                            </div>

                        </form>
                        <div>
                            <table class="table table-striped table-hover table-bordered nowrap" id="componentsTable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Part Name</th>
                                    <th>MITSKU</th>
                                    <th>Qty Required</th>
                                    <th>Notes</th>
                                </tr>
                                </thead>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('css')
    <style>
        .modal-body{
            height: 500px;
            width: 100%;
            overflow-y: auto;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.css"/>
    /*<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap4.min.css"/>*/
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css" />
    /*<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"/>*/
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

@stop

@section('js')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
{{--    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap4.min.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>--}}
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.js"></script>
{{--    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script src="{{asset('js/OCCreate.js')}}"></script>

    <script>

        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let $openCells
        let $componentsTable
        let headers = {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
        }

        $(document).ready(function () {
            $.ajaxSetup({
                headers
            });

            $openCells = $('#openCells').DataTable({
                order: [[0, 'desc']],
                pageLength: 100,
                lengthMenu: [
                    [100,500, -1],
                    [100,500,'All']
                ],
                processing: true,
                serverSide: true,
                scrollY: "53vh",
                // scrollX: true,
                scrollCollapse: true,
                stateSave: true,
                dom: '"<\'row\'<\'col-md-6\'B><\'col-md-6\'f>>" +\n' +
                    '"<\'row\'<\'col-sm-12\'tr>>" +\n' +
                    '"<\'row\'<\'col-sm-12 col-md-5\'i ><\'col-sm-12 col-md-7\'p>>"',
                ajax: {
                    url: "/oc/getOCList",
                    data: function (d) {
                        d.brand = $('select[name=brand]').val();
                        d.model = $('select[name=model]').val();
                    },
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'OC_Manufacturer', name: 'OC_Manufacturer'},
                    {data: 'OC_PartNumber', name: 'OC_PartNumber'},
                    {data: 'OC_MITSKU', name: 'OC_MITSKU'},
                ],
                columnDefs: [
                    {
                        targets: [0],
                        searchable: true,
                        // visible: false,
                    },
                ]

            })

            // $componentsTable = $('#componentsTable').DataTable({
            //     order: [[0, 'desc']],
            //     pageLength: 100,
            //     lengthMenu: [
            //         [100,500, -1],
            //         [100,500,'All']
            //     ],
            //     processing: true,
            //     serverSide: true,
            //     scrollY: "53vh",
            //     scrollX: true,
            //     scrollCollapse: true,
            //     stateSave: true,
            //     dom: '"<\'row\'<\'col-md-6\'B><\'col-md-6\'f>>" +\n' +
            //         '"<\'row\'<\'col-sm-12\'tr>>" +\n' +
            //         '"<\'row\'<\'col-sm-12 col-md-5\'i ><\'col-sm-12 col-md-7\'p>>"'
            // })

        });


        $('#model').select2({
            theme: 'bootstrap4',
        }).on("change", function() {
            $openCells.ajax.reload()
            getPNFromModel($(this).val());
        });

        $('#partNumber').select2({
            theme: 'bootstrap4',
        }).on("change",function (){
            getMITSKUFromPartNumber($(this).val());
        })

        $('#mitSku').select2({
            theme: 'bootstrap4',
        })

    </script>

@stop
