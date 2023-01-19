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
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-row align-items-left mt-1">
                                    <div class="col-md-3">
                                        <select name="brand" aria-label="select brand" id="search_brand"
                                                class=" form-control ">
                                            <option value="0">Brand</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->Brand }}"
                                                    {{ old('brand') ? 'selected':''}}>
                                                    {{ $brand->Brand }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="model" aria-label="select model" id="search_model"
                                                class="form-control mySelect2">
                                            <option value='0'>Model</option>
                                        </select>

                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-success ml-2" id="btn-reset-form">Reset form</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped table-hover table-bordered nowrap" id="skusTable">
                            <thead>
                            <tr>
                                <th>Ref Sku</th>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Actions</th>
                                <th>Kits Count</th>
                                <th>DMG Qty</th>
                                <th>Kits %</th>
                                <th>OC SKU</th>
                                <th>OC Qty</th>
                                <th>Version</th>
                                <th>Country Mfr</th>
                                <th>Open Cell</th>
                                <th>Main Board</th>
                                <th>T-Con Board</th>
                                <th>Power Supply</th>
                                <th>WiFi Module</th>
                                <th>IR Sensor</th>
                                <th>Button Set</th>
                                <th>Blutooth Module</th>
                                <th>Chasis</th>
                                <th>Product Version Number</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <iframe id="printf" name="printf"  style="visibility: hidden;" src="about:blank"></iframe>
    @include('skus.shared.kitsModal')
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"/>
    <link type="text/css" href="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css" rel="stylesheet" />

    <style>
        .verybigmodal {
            max-width: 80%;
        }
        input[type=checkbox]{
            width: 17px;
            height: 17px;
        }
    </style>

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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>

    <script src="{{ asset('js/filterSkus.js') }}"></script>

    <script>
        let $skusTable;
        let $kitsTable;
        let $kitsBulkTable
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let selBrand = '0'
        let selModel
        let headers = {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
        }

        async function deleteData(url) {
            try {
                const response = await fetch(`${url}`, {
                    method: 'DELETE',
                    headers: headers,
                })
                const data = await response.json()
                return data
            } catch (err) {
                console.log(err);
            }
        }


        $(document).ready( function () {
            $.ajaxSetup({
                headers
            });

            $skusTable = $('#skusTable').DataTable({
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
                        title: 'Skus to Excel',
                        titleAttr: 'Excel',
                        className: 'btn btn-success',
                        init: function (api, node, config) {
                            $(node).removeClass('btn-secondary buttons-html5 buttons-excel')
                            },
                        },{
                            extend: 'pageLength',
                            titleAttr: 'Show Records',
                            className: 'btn btn-secondary buttons-collection dropdown-toggle buttons-colvis',
                        },{
                            text: '<i class="fas fa-plus-circle"></i> Create SKU',
                            title: 'Create SKU',
                            titleAttr: 'Create New SKU',
                            className: 'btn btn-primary',
                            attr: {
                                id: 'create-sku-btn'
                            },
                            init: function (api, node, config) {
                                $(node).removeClass('btn-secondary buttons-html5')
                            },
                            action: function ( e, dt, node, config ) {
                                window.location = '/skus/create';
                            }
                        }
                    ],
                },

                ajax: "{{route('skus.index')}}",
                columns: [
                    {data: 'ref_sku',name:'ref_sku'},
                    {data: 'brand',name:'brand'},
                    {data: 'model',name:'model'},
                    {data: 'image_count',name:'image_count'},
                    {data: 'kits_count',name:'kits_count'},
                    {data: 'QtyDamageTV',name:'QtyDamageTV'},
                    {data: 'kits_percent',name:'kits_percent'},
                    {data: 'OCSKU',name:'OCSKU'},
                    {data: 'OCQty',name:'OCQty'},
                    {data: 'version',name:'version'},
                    {data: 'country_manufactured',name:'country_manufactured'},
                    {data: 'Open Cell',name:'Open Cell'},
                    {data: 'Main Board',name:'Main Board'},
                    {data: 'T-Con Board',name:'T-Con Board'},
                    {data: 'Power Supply',name:'Power Supply'},
                    {data: 'WiFi Module',name:'WiFi Module'},
                    {data: 'IR Sensor',name:'IR Sensor'},
                    {data: 'Button Set',name:'Button Set'},
                    {data: 'Blutooth Module',name:'Blutooth Module'},
                    {data: 'chasis',name:'chasis'},
                    {data: 'product_version_number',name:'product_version_number'},
                ],
                columnDefs: [
                    {
                        targets: [3,4,5,6,8,9,10],
                        className: "text-center",
                    },
                    {
                        targets: [3,4],
                        searchable: false,
                    },{
                        targets: [2],
                        searchable: true,
                        exactvalue:true
                    }

                ]
            });
        });

        $(document).on('click', '.kits-count', function (e) {
            e.stopPropagation();
            let $tr = $(this).closest('tr');
            let rowId = $tr.attr('id');
            let row = $skusTable.row($tr).data();
            $('#ajaxModalKits')
                .on('shown.bs.modal', function () {
                    $(this).find(".modal-title").html(row['qty']+' Kits related to SKU: '+rowId)
                    $(this).find(".modal-body").html('<table class="table table-striped table-hover table-bordered nowrap" id="kitsTable"> <thead> <tr> <th>ID</th> <th>Kit LCN</th> <th>BoxID</th> <th>SKU Count</th> <th>Brand</th> <th>Model</th> <th>Ref SKU</th> <th>Images Qty</th> <th>Parts Qty</th> <th>Keywords</th> <th>CapturedBy</th> <th>Created At</th> </tr> </thead> </table>')
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
                    ajax: {
                        url: "/sku/getKitsBySku",
                        data: function (d) {
                            d.sku = rowId;
                        },
                    },
                    columns: [
                        {data: 'kitid', name: 'kitid'},
                        {data: 'kitlcn', name: 'kitlcn'},
                        {data: 'boxname', name: 'boxname'},
                        {data: 'SKU_count', name: 'SKU_count'},
                        {data: 'brand', name: 'brand'},
                        {data: 'model', name: 'model'},
                        {data: 'ref_sku', name: 'ref_sku'},
                        {data: 'image_count', name: 'image_count'},
                        {data: 'noofparts', name: 'noofparts'},
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
                    ]
                });
                }).on('hidden.bs.modal', function (e) {
                    $(this).find(".modal-title").html('');
                    $(this).find(".modal-body").html("");
                    $kitsTable='';
                }).modal('show');
        });

        $(document).on('click', '.kits-delete', function (e) {
            let $tr = $(this).closest('tr');
            let rowId = $tr.attr('id');
            // console.log(rowId)

            Swal.fire({
                title: 'Password to delete SKU',
                input: 'password',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Submit',
            }).then((result) => {
                if (result.value === 'pLa13t1B') {

                    deleteData(`/skus/${rowId}`)

                    Swal.fire({
                        title: 'The SKU!',
                        html: `
                        <h3>${rowId}</h3>
                        <h3><b>Has been deleted</b></h3>
                      `,
                        confirmButtonText: 'Exit'
                    })
                    $skusTable.ajax.reload()
                }else{
                    Swal.fire({
                        title: 'Sorry!',
                        html: `<h3><b>The password is not correct</b></h3>`,
                        confirmButtonText: 'Exit'
                    })
                }

            });
        });

        document.getElementById('search_brand').addEventListener('change', (e)=>{
            e.preventDefault();
            selModel = document.getElementById('search_model');

            if (selModel.value !== '0' && selModel.value !== ''){
                $skusTable.columns([1,2]).search('').draw();
                selModel.value ='0';
            }


            fetch('/sku/getSKUModels', {
                method: 'POST',
                body: JSON.stringify({text: e.target.value}),
                headers:headers
            }).then(response=>{
                return response.json()
            }).then(data =>{
                let options = "<option value='0'>Model</option>";
                for (let i in data){
                    options += '<option value="'+data[i].model+'">'+data[i].model+'</option>';
                }
                document.getElementById('search_model').innerHTML = options
            }).catch(error => console.log(error))


            manageBrand($skusTable)
        })

        document.getElementById('btn-reset-form').addEventListener('click', (e)=>{
            document.getElementById('search_brand').selectedIndex = 0;
            document.querySelectorAll('#search_model option').forEach(o =>{if (o.value !=0){ o.remove()}});
            $skusTable.columns([1,2]).search("").draw();
        });


        $('.mySelect2').select2({
            theme: 'bootstrap4',
            width: 'resolve'
        }).on('select2:select', function(e) {
             manageModel($skusTable)
        });

        window.onload = function (){
            $skusTable.columns().search("").draw();
        }



    </script>
@stop


