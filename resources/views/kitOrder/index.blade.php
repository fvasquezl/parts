@extends('adminlte::page')

@section('title', 'Kit Orders')

@section('content_header')
    <h1>Kir Orders</h1>
@stop

@section('content')
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

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 my-3">
                <div class="card mb-4 shadow-sm card-outline card-success">
                    <div class="card-header ">
                        <h3 class="card-title mt-1">
                            Kit Orders
                        </h3>
                        <div class="card-tools">
                            <button class="btn btn-success" id="create_order" ><i class="fa fa-plus"></i> Create Order</button>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped table-hover table-bordered" id="kitOrdersTable">
                            <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Actions</th>
                                <th>Reference Order #</th>
                                <th>Order Date</th>
                                <th>Fulfilled Date</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('kitOrder.shared.kitOrderModal')
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.css">
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.js"></script>

    <script>
        let $kitOrdersTable;
        let order

        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let headers = {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
        }

        async function createOrder(){
            try {
                const response = await fetch("{{route('kit-order.store')}}", {
                    method: 'POST',
                    headers: headers
                })
                const data = await response.json()
                // $('#kitOrdersTable').DataTable().ajax.reload();
                return data
            } catch (err) {
                console.log("Error:",err)
            }

        }

        $(document).on('click', '#create_order',  async function (e) {

             const order = await createOrder();
             const {order_id} = order
             window.location.replace(`kit-order/${order_id}/edit`);


            // $('#kitOrderModal')
            //     .on('shown.bs.modal', function () {
            //
            //
            //         // $('#ocId').val(OcConfigId)
            //         // getMPartName()
            //         // $aPartName.select2({theme: 'bootstrap4'})
            //         // $mitSKU.select2({theme: 'bootstrap4'})
            //         // $aQtyRequired.keydown(function(e){
            //         //     if(e.keyCode === 13) {
            //         //         e.preventDefault();
            //         //         $aNotes.focus()
            //         //         return false;
            //         //     }
            //         // })
            //
            //     }).on('hidden.bs.modal', function () {
            //     // $mitSKU.html('<option value="">MITSKU</option>')
            //     // $('#accDataForm').trigger("reset");
            // }).modal('show');
        })



        $(document).ready( function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

             $kitOrdersTable = $('#kitOrdersTable').DataTable({
                responsive: true,
                serverSide: true,
                scrollY: "53vh",
                scrollX: false,

                ajax: "{{route('kit-order.index')}}",
                columns: [
                    {data: 'order_id',name: 'order_id'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false},
                    {data: 'reforder_id',name: 'reforder_id'},
                    {data: 'created_at',name: 'created_at'},
                    {data: 'fulfilled_at',name: 'fulfilled_at'},
                    {data: 'order_status',name: 'order_status'},
                ]
            });
        });

    </script>
@stop

