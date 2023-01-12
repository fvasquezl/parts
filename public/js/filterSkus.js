

function manageBrand($table) {
    selBrand = document.getElementById('search_brand');
    selModel = document.getElementById('search_model');

    if(selBrand.value !== '0'){
        $table.column(1).search(`${selBrand.value}`).draw()
    }
}
function manageModel($table) {
    selBrand = document.getElementById('search_brand');
    selModel = document.getElementById('search_model');

    if(selModel.value !== '0'){
        $table.column([2]).search(`${selModel.value}`).draw();
    }
    if(selModel.value === '0'){
        $table.columns([2]).search("").draw();
        document.querySelectorAll('#search_model option').forEach(o =>{if (o.value !=0){ o.remove()}});
    }
}

$(document).on('click', '.kits-bulk', function (e) {
    e.stopPropagation();
    let $tr = $(this).closest('tr');
    let rowId = $tr.attr('id');
    let row = $skusTable.row($tr).data();
    $('#ajaxModalKits')
        .on('shown.bs.modal', function () {
            $(this).find(".modal-title").html(' Add Kits on bulk to SKU: '+rowId)
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
