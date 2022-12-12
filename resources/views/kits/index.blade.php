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
                            <input id="search_sku" class="form-control" type="search" placeholder="Filter by Sku">
                        </h3>
                        <div class="card-tools">
                            <a class="btn btn-primary" href="{{ route('kits.create') }}">
                                <i class="fa fa-plus"></i> Create Kit
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped table-hover table-bordered nowrap hover" id="kitsTable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>LCN</th>
                                <th>Kit LCN</th>
                                <th>BoxID</th>
                                <th>Actions</th>
                                <th>SKU Count</th>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>DMG Qty</th>
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
    @include('skus.shared.kitsModal')
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.5.0/css/select.dataTables.min.css">

    <style>
        .verybigmodal {
            max-width: 80%;
            margin-left: 10%;
        }
        .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
            background-color: #94eed3;
        }
        input.larger {
            width: 20px;
            height: 20px;
        }

        .table-condensed{
            font-size: 25px;
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

    <script>
        let $kitsTable;
        let $skusTable;
        let $kit
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let $sku
        let $sku_selected
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

            $kitsTable = $('#kitsTable').DataTable({
                order: [[0, 'desc']],
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
                    {data: 'lcn', name: 'lcn'},
                    {data: 'kitlcn', name: 'kitlcn'},
                    {data: 'boxname', name: 'boxname'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false},
                    {data: 'SKU_count', name: 'SKU_count'},
                    {data: 'brand', name: 'brand'},
                    {data: 'model', name: 'model'},
                    {data: 'QtyDamageTV', name: 'QtyDamageTV'},
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
                        targets: [12],
                        searchable: true,
                        visible: false
                    },
                    {
                        targets: [5,9,10,11],
                        searchable: false,
                    },
                    {
                        targets: [5,6,8,9,10],
                        className: "text-center",
                    }
                ]
            });

            $('#search_sku').on('search keyup', function() {
                    $kitsTable
                        .column(7)
                        .search(this.value)
                        .draw();
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

        $(document).on('click', '.sku-btn', function (e) {
            e.stopPropagation();
            let $tr = $(this).closest('tr');
            $kitsTable.$('tr.selected').removeClass('selected');
            $tr.addClass('selected');
            let rowId = $tr.attr('id');
            let row = $kitsTable.row($tr).data();
            $kit = row['kitlcn'];
            $('#ajaxModalKits')
                .on('shown.bs.modal', function () {
                    $(this).find(".modal-title").html(function (){
                        return showGetResult(rowId)
                    })
                    $(this).find(".modal-body").html('<table class="table table-striped table-hover table-bordered nowrap hover" id="skusTable"><thead><tr>' +
                        '<th></th>' +
                        '<th>Ref Sku</th>' +
                        '<th>Brand</th>' +
                        '<th>Model</th>' +
                        '<th>Version</th>' +
                        '<th>Country Manufactured</th>' +
                        '<th>Open Cell</th>' +
                        '<th>Main Board</th>' +
                        '<th>T-Con Board  </th>' +
                        '<th>Power Supply</th>' +
                        '<th>WiFi Module</th>' +
                        '<th>IR Sensor</th>' +
                        '<th>Button Set</th> ' +
                        '<th>Blutooth Module</th>' +
                        '<th>Chasis</th> ' +
                        '<th>product_version_number</th>' +
                        '</tr> </thead></table>')
                    $(this).find(".modal-footer").html('<button type="button" id="update-sku" class="btn btn-primary" disabled>Save changes</button> ' +
                        '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>')

                    $skusTable = $('#skusTable').DataTable({
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
                            buttons: [
                                {
                                    extend: 'pageLength',
                                    titleAttr: 'Show Records',
                                    className: 'btn btn-secondary buttons-collection dropdown-toggle buttons-colvis',
                                }
                            ],
                        },

                            ajax: {
                                url: "/sku/getSkuToKit",
                                data: function (d) {
                                    d.brand = row['brand'];
                                    d.model = row['model'];
                                    d.ref_sku = row['ref_sku'];
                                },
                            },
                        columns: [
                            {data: 'select',name:'select'},
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
                        columnDefs: [

                            {
                                targets: 0,
                                orderable: false,
                                searchable: false,
                                className: 'dt-body-center',
                                render: function(data, type, full, meta) {
                                    if(data === "disable"){
                                        return '<input type="checkbox" name="chkbx'+meta.row+'" class="larger">';
                                    }else{
                                        $sku = data
                                        return '<input type="checkbox" checked name="chkbx'+meta.row+'" class="larger">';
                                    }
                                },
                            },{
                                targets: [3,4,5],
                                className: "text-center",
                            }
                        ],
                        order: [[1, 'desc']],
                    });

                }).on('hidden.bs.modal', function (e) {
                $(this).find(".modal-title").html('');
                $(this).find(".modal-body").html("");
                $skusTable.ajax.reload()
                $skusTable='';
                $kit = '';
                $kitsTable.$('tr.selected').removeClass('selected');
            }).modal('show');

        });


        $(document).on('click', '#update-sku', function (e) {
            e.stopPropagation();
            fetch('/sku/kitUpdate', {
                method: 'POST',
                body: JSON.stringify({
                    kit: $kit,
                    sku: $sku_selected
                }),
                headers:headers
            }).then(response=>{
                return response.json()
            }).then(data =>{
               console.log(data)
               $kitsTable.ajax.reload();
               $('#ajaxModalKits').modal('hide')

            }).catch(error => console.log(error))
        });

        $(document).on('click','input[type="checkbox"]', function (e){

            let name = this.name

            $skusTable.rows(function (idx,data, node) {
                return $(node).find('input[type="checkbox"][name="chkbx'+idx+'"]').prop('checked',false);
            })

            $skusTable.rows(function (idx,data, node) {
                $(node).find('input[type="checkbox"][name="'+name+'"]').prop('checked',true).val(data.ref_sku);
            })


             if($sku !== this.value ){
                 $(document).find('#update-sku').removeAttr("disabled")
             }else {
                 $(document).find('#update-sku').prop("disabled",true);
             }

            $sku_selected = this.value

        })


        function showGetResult( rowId )
        {
            let result = null;
            let scriptUrl = "/sku/getKitData/"+rowId ;
            $.ajax({
                url: scriptUrl,
                type: 'get',
                dataType: 'json',
                contentType: "application/json",
                async: false,
                success: function(data) {
                    result = data;
                }
            });

            return '<table class="table table-bordered table-condensed"><thead><tr><th>Brand</th><th>Model</th><th>Keywords</th></tr> </thead><tbody><tr><th>'+result.Brand+'</th><td>'+result.Model+'</td><td>'+result.Keywords+'</td></tr></tbody></table>';
        }


    </script>
@stop
{{--15656--}}
{{--15683--}}
{{--15690--}}
