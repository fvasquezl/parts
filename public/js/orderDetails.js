function lcn(){
    $('#kitOrderModal')
        .on('shown.bs.modal', function () {
            $(this).find(".modal-title").html("Add LCN")
            $(this).find(".modal-body").html(

                '<table class="table table-striped table-hover table-bordered nowrap" id="lcnTable">\n' +
                '<thead>\n' +
                '<tr>\n' +
                '<th></th>\n'+
                '<th>KitID</th>\n'+
                '<th>LCN</th>\n'+
                '<th>Kit LCN</th>\n'+
                '<th>SKU Count</th>\n'+
                '<th>Brand</th>\n'+
                '<th>Model</th>\n'+
                '<th>DMG Qty</th>\n'+
                '<th>Ref SKU</th>\n'+
                '<th>Images Qty</th>\n'+
                '<th>Parts Qty</th>\n'+
                '<th>Url</th>\n'+
                '<th>Keywords</th>\n'+
                '<th>CapturedBy</th>\n'+
                '<th>Created At</th>\n'+
                '</tr>\n' +
                '</thead>\n' +
                '</table>')
            $kitsBulkTable = $('#lcnTable').DataTable({
                order: [[0, 'desc']],
                pageLength: 100,
                lengthMenu: [
                    [50,100, -1],
                    [50,100,'All']
                ],
                processing: true,
                serverSide: true,
                scrollY: "45vh",
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
                    buttons: [
                        {
                            extend: 'pageLength',
                            titleAttr: 'Show Records',
                            className: 'btn btn-secondary buttons-collection dropdown-toggle buttons-colvis',
                        },{
                            text: '<i class="fas fa-plus-circle"></i> Add LCN to Order',
                            title: 'Add LCN to Order',
                            titleAttr: 'Add LCN to Order',
                            className: 'btn btn-success',
                            attr: {
                                id: 'create-lcn-btn'
                            },
                            init: function (api, node, config) {
                                $(node).removeClass('btn-secondary buttons-html5')
                                // this.disable();
                            },
                            action: function ( e, dt, node, config ) {
                                let lcnArray = [];
                                if(dt.column(0).checkboxes.selected().count()){
                                    $.each(dt.column(0).checkboxes.selected(), function(index, rowId){
                                        lcnArray.push(rowId);
                                    });
                                    addItemsToForm(lcnArray)

                                    // updateBulkKits('/sku/kitBulkUpdate',kitsArray,rowId)

                                    // $skusTable.ajax.reload();

                                }else{
                                    alert("Please select some kits")
                                }

                                // window.location = '/skus/create';
                            }
                        }
                    ],
                },


                ajax: {
                    url:'/kit-order/getKits',
                    // data: function (d) {
                    //     // d.brand1 = $('select[name=brand]').val();
                    //     // d.model1 = $('select[name=model]').val();
                    //     // d.brand = brand;
                    //     // d.model = model;
                    //     // console.log(d.model)
                    // }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'kitid', name: 'kitid'},
                    {data: 'lcn', name: 'lcn'},
                    {data: 'kitlcn', name: 'kitlcn'},
                    {data: 'SKU_count', name: 'SKU_count'},
                    {data: 'brand', name: 'brand'},
                    {data: 'model', name: 'model'},
                    {data: 'QtyDamageTV', name: 'QtyDamageTV'},
                    {data: 'ref_sku_display', name: 'ref_sku_display'},
                    {data: 'image_count', name: 'image_count'},
                    {data: 'noofparts', name: 'noofparts'},
                    {data: 'url', name: 'url'},
                    {data: 'keywords', name: 'keywords'},
                    {data: 'name', name: 'name'},
                    {data: 'created_at', name: 'created_at'},
                ],
                columnDefs: [
                    {
                        targets: 0,
                        checkboxes: {
                            selectRow: true
                        },
                    },
                ],
                select: {
                    style: 'multi'
                },
            });

        }).on('hidden.bs.modal', function (e) {
        $(this).find(".modal-title").html('');
        $(this).find(".modal-body").html("");
        $kitsBulkTable='';
    }).modal('show');
}


function sku(){
    $('#kitOrderModal')
        .on('shown.bs.modal', function () {
            $(this).find(".modal-title").html("Add SKUS")
            $(this).find(".modal-body").html(

                '<table class="table table-striped table-hover table-bordered nowrap" id="skusTable">\n' +
               ' <thead>\n' +
               ' <tr>\n' +
               ' <th></th>\n'+
               ' <th>Ref Sku</th>\n'+
               ' <th>BTS Sku</th>\n'+
               ' <th>Brand</th>\n'+
               ' <th>Model</th>\n'+
               ' <th>DMG Qty</th>\n'+
               ' <th>Kits %</th>\n'+
               ' <th>OC SKU</th>\n'+
               ' <th>OC Qty</th>\n'+
               ' <th>Version</th>\n'+
               ' <th>Country Mfr</th>\n'+
               ' <th>Open Cell</th>\n'+
               ' <th>Main Board</th>\n'+
               ' <th>T-Con Board</th>\n'+
               ' <th>Power Supply</th>\n'+
               ' <th>WiFi Module</th>\n'+
               ' <th>IR Sensor</th>\n'+
               ' <th>Button Set</th>\n'+
               ' <th>Blutooth Module</th>\n'+
               ' <th>Chasis</th>\n'+
               ' <th>Product Version Number</th>\n'+
                '</tr>\n' +
                '</thead>\n' +
                '</table>')
            $kitsBulkTable = $('#skusTable').DataTable({
                order: [[0, 'desc']],
                pageLength: 100,
                lengthMenu: [
                    [50,100, -1],
                    [50,100,'All']
                ],
                processing: true,
                serverSide: true,
                scrollY: "45vh",
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
                    buttons: [
                        {
                            extend: 'pageLength',
                            titleAttr: 'Show Records',
                            className: 'btn btn-secondary buttons-collection dropdown-toggle buttons-colvis',
                        },{
                            text: '<i class="fas fa-plus-circle"></i> Add SKU to Order',
                            title: 'Add SKU to Order',
                            titleAttr: 'Add SKU to Order',
                            className: 'btn btn-success',
                            attr: {
                                id: 'create-sku-btn'
                            },
                            init: function (api, node, config) {
                                $(node).removeClass('btn-secondary buttons-html5')
                                // this.disable();
                            },
                            action: function ( e, dt, node, config ) {
                                let kitsArray = [];
                                if(dt.column(0).checkboxes.selected().count()){
                                    $.each(dt.column(0).checkboxes.selected(), function(index, rowId){
                                        kitsArray.push(rowId);
                                    });

                                     addItemsToForm(kitsArray)

                                    // $skusTable.ajax.reload();

                                }else{
                                    alert("Please select some kits")
                                }

                                // window.location = '/skus/create';
                            }
                        }
                    ],
                },


                ajax: {
                    url:'/kit-order/getSkus',
                    // data: function (d) {
                    //     // d.brand1 = $('select[name=brand]').val();
                    //     // d.model1 = $('select[name=model]').val();
                    //     // d.brand = brand;
                    //     // d.model = model;
                    //     // console.log(d.model)
                    // }
                },
                columns: [
                    // {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
                    {data: 'id', name: 'id'},
                    {data: 'ref_sku',name:'ref_sku'},
                    {data: 'bts_sku',name:'bts_sku'},
                    {data: 'brand',name:'brand'},
                    {data: 'model',name:'model'},
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
                            selectRow: true
                        },
                    },
                ],
                select: {
                    style: 'multi'
                },
            });

        }).on('hidden.bs.modal', function (e) {
        $(this).find(".modal-title").html('');
        $(this).find(".modal-body").html("");
        $kitsBulkTable='';
    }).modal('show');
}


function addItemsToForm(itemsArray){
    ++i
    itemsArray.map(item =>(
        $('#orderDetailsTable').append(
            `<tr>
                 <td>
                     <input type="text" name="od[`+i+`][name]" class="form-control" value="${item}">
                 </td>
                 <td>
                     <input type="number" name="od[`+i+`][qty]" class="form-control" value=1>
                 </td>
                 <td>
                     <button class="btn btn-danger remove-table-row" type="button" ><i class="fa fa-trash-alt"></i></button>
                 </td>
             </tr>`
        )
  ))
    // ++i
    // $('#orderDetailsTable').append(
    //     ` <tr>
    //             <td>
    //                 <input type="text" name="od[`+i+`][name]" class="form-control" value="`[]``">
    //             </td>
    //             <td>
    //                 <input type="number" name="od[`+i+`][qty]" class="form-control" value=1>
    //             </td>
    //             <td>
    //                 <button class="btn btn-danger remove-table-row" type="button" ><i class="fa fa-trash-alt"></i></button>
    //             </td>
    //         </tr>`
    // )
}

