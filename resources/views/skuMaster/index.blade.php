@extends('adminlte::page')

@section('title', 'Skus Master')

@section('content_header')
    <h1>Skus Master</h1>
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
{{--                        <div class="row">--}}
{{--                            <div class="col-md-12">--}}
{{--                                <div class="form-row align-items-left mt-1">--}}
{{--                                    <div class="col-md-2">--}}
{{--                                        <select name="brand" aria-label="select brand" id="search_brand"--}}
{{--                                                class=" form-control ">--}}
{{--                                            <option value="0">Brand</option>--}}
{{--                                            @foreach ($brands as $brand)--}}
{{--                                                <option value="{{ $brand->Brand }}"--}}
{{--                                                    {{ old('brand') ? 'selected':''}}>--}}
{{--                                                    {{ $brand->Brand }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-2">--}}
{{--                                        <select name="model" aria-label="select model" id="search_model"--}}
{{--                                                class="form-control mySelect2">--}}
{{--                                            <option value='0'>Model</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-2">--}}
{{--                                        <select name="images" aria-label="select images" id="search_images"--}}
{{--                                                class="form-control">--}}
{{--                                            <option value='0'>Has Images? All</option>--}}
{{--                                            <option value='1'>Yes</option>--}}
{{--                                            <option value='2'>No</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-2">--}}
{{--                                        <button class="btn btn-success ml-2" id="btn-reset-form">Reset form</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>

                    <div class="card-body">
                        <table class="table table-striped table-hover table-bordered nowrap" id="skuMasterTable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Actions</th>
                                <th>Notes</th>
                                <th>Ref ParentID</th>
                                <th>Ref Sku</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--    <iframe id="printf" name="printf"  style="visibility: hidden;" src="about:blank"></iframe>--}}
    @include('skuMaster.shared.modal')
{{--    @include('skus.shared.skuModalEditForm')--}}
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.5.0/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/jquery-datatables-checkboxes@1.2.13/css/dataTables.checkboxes.min.css" rel="stylesheet">

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
    <script src="https://cdn.datatables.net/select/1.5.0/js/dataTables.select.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-datatables-checkboxes@1.2.13/js/dataTables.checkboxes.min.js"></script>

    <script src="{{ asset('js/SkuMaster.js') }}"></script>

    <script>
        let $skuMasterTable;
        let $skusTable;
        // let $kitsBulkTable
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        // let selBrand = '0'
        // let selModel
        // let selImages
        let headers = {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
        }



        $(document).ready( function () {
            $.ajaxSetup({
                headers
            });

            $skuMasterTable = $('#skuMasterTable').DataTable({
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
                        text: '<i class="fas fa-plus-circle"></i> Create SkuMaster',
                        title: 'Create SKU Master',
                        titleAttr: 'Create New SKU Master',
                        className: 'btn btn-primary',
                        attr: {
                            id: 'create-sku-master-btn'
                        },
                        init: function (api, node, config) {
                            $(node).removeClass('btn-secondary buttons-html5')
                        },
                        // action: function ( e, dt, node, config ) {
                        //     window.location = '/skus/create';
                        // }
                    }
                    ],
                },

                ajax: {
                    url: "{{route('sku-master.index')}}",
                    // data: function (d) {
                    //     d.images = $('select[name=images]').val();
                    // },
                },

                // columnDefs: [
                //     {
                //         // targets: [3,4,5,6,8,9,10],
                //         targets: [4,5,6,7,9,10,11],
                //         className: "text-center",
                //     },
                //     {
                //         targets: [4,5],
                //         searchable: false,
                //     },{
                //         targets: [3],
                //         searchable: true,
                //         exactvalue:true
                //     }
                //
                // ],

                columns: [

                    {data: 'id',name:'id'},
                    {data: 'actions',name:'actions'},
                    {data: 'notes',name:'notes'},
                    {data: 'ref_parentid',name:'ref_parentid'},
                    {data: 'ref_sku',name:'ref_sku'},
                    {data: 'updated_at',name:'updated_at'},
                    {data: 'created_at',name:'created_at'},

                ]
            });
        });

        $(document).on('click', '#create-sku-master-btn', async function (e) {

            //create MasterSKU
            let data = await manageData('/sku-master/createSKUMaster')
                $('#ModalSkuMaster')
                    .on('shown.bs.modal', function () {
                        $(this).find(".modal-title").html('Sku Master: <b>'+data['MasterSku']+'</b> randomly generated')
                         $(this).find(".modal-body").html('<table class="table table-striped table-hover table-bordered nowrap" id="skusTable"><thead><tr><th></th><th>Ref Sku</th><th>BTS Sku</th><th>Brand</th><th>Model</th><th>Kits Count</th><th>DMG Qty</th><th>Kits %</th><th>OC SKU</th><th>OC Qty</th><th>Version</th><th>Country Mfr</th><th>Open Cell</th><th>Main Board</th><th>T-Con Board</th><th>Power Supply</th><th>WiFi Module</th><th>IR Sensor</th><th>Button Set</th><th>Blutooth Module</th><th>Chasis</th><th>Product Version Number</th> </tr> </thead> </table>')
                        $skusTable = $('#skusTable').DataTable({
                            pageLength: 100,
                            lengthMenu: [
                                [100,500,5000, -1],
                                [100,500,5000,'All']
                            ],
                            processing: true,
                            serverSide: true,
                            scrollY: "53vh",
                            scrollX: true,
                            scrollCollapse: true,
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
                                    extend: 'pageLength',
                                    titleAttr: 'Show Records',
                                    className: 'btn btn-secondary buttons-collection dropdown-toggle buttons-colvis',
                                },{
                                    text: '<i class="fas fa-check-circle"></i> Update SKUMaster',
                                    title: 'Update SKUMaster',
                                    titleAttr: 'Update SKUMaster',
                                    className: 'btn btn-success',
                                    attr: {
                                        id: 'create-sku-master-btn'
                                    },
                                    init: function (api, node, config) {
                                        $(node).removeClass('btn-secondary buttons-html5')
                                    },
                                    action:  async function ( e, dt, node, config ) {
                                        let MSArray = [];
                                        if(dt.column(0).checkboxes.selected().count()){
                                            $.each(dt.column(0).checkboxes.selected(), function(index, rowId){
                                                MSArray.push(rowId);
                                            });

                                            const res  = await manageData('/sku-master/store','POST',{'skus':MSArray,'MSku':data['MasterSku']})
                                            if(res.success){
                                                Swal.fire({
                                                    position: 'top-end',
                                                    icon: 'success',
                                                    title: res.success,
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                })
                                                $('#ModalSkuMaster').modal('toggle');
                                            }
                                        }else{
                                            alert("Please select some kits")
                                        }

                                    }
                                }
                                ],
                            },

                            ajax: {
                                url: "{{route('sku-master.getSkus')}}",
                            },

                            {{--ajax: "{{route('skus.index')}}",--}}
                            columns: [
                                {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
                                {data: 'ref_sku',name:'ref_sku'},
                                {data: 'bts_sku',name:'bts_sku'},
                                {data: 'brand',name:'brand'},
                                {data: 'model',name:'model'},
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
                                    targets: 0,
                                    checkboxes: {
                                        selectRow: true,
                                        className: 'larger'
                                    },

                                },{
                                    targets: [5],
                                    searchable: false,
                                }
                            ],
                            select: {
                                style: 'multi'
                            },
                            order: [[1, 'asc']]
                        });
                    }).on('hidden.bs.modal', function (e) {
                    // $(this).find(".modal-title").html('');
                    // $(this).find(".modal-body").html("");
                    $skuMasterTable.ajax.reload();
                }).modal('show');
        })

        function closeModal(){

        }

    </script>
@stop


