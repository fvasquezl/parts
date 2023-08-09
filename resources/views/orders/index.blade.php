@extends('adminlte::page')

@section('title', 'Kit Orders')

@section('content_header')
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
                            <div class="form-group form-inline mb-">
                                <label for="kitLcn">Scan LCN: </label>
                                <input type="text" class="form-control mr-3 ml-3" name="kitLcn" id="kitLcn"/>
                            </div>
                        </div>

                        <div class="card-body">
                            <table class="table table-striped table-hover table-bordered" id="kitOrdersTable">
                                <thead>
                                <tr>
                                    <th>Scanned LCN</th>
                                    <th>Order ID</th>
                                    <th>SKU/LCN</th>
                                    <th>Type</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--    @include('kitOrder.shared.kitOrderModal')--}}
        @stop

        @section('css')
            <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.css">
        @stop

        @section('js')
            <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.js"></script>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <script>
                let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                let headers = {
                    "Content-Type": "application/json",
                    "Accept": "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": token
                }

                const inputLCN = document.getElementById("kitLcn");

                window.onload = function () {
                    inputLCN.focus();
                }

                async function getData(value){
                    try {
                        const response = await fetch("{{route('orders.getLCN')}}", {
                            method: 'POST',
                            body:JSON.stringify({lcn: value}),
                            headers: headers
                        })
                        const data = await response.json()
                        return data
                    } catch (err) {
                        console.log("Error:",err)
                    }

                }



                inputLCN.addEventListener('keyup',async (e)=>{
                      e.preventDefault();
                    if (e.key === 'Enter' || e.keyCode === 13) {
                        const res = await getData(e.target.value)

                        if(res){
                        const tableRef = document.getElementById('kitOrdersTable').getElementsByTagName('tbody')[0];
                        const newRow = tableRef.insertRow(tableRef.rows.length)
                        newRow.innerHTML = `<tr id=${e.target.value}>
                                                <td>${e.target.value}</td>
                                                <td>${res.order_id}</td>
                                                <td>${res.ref_sku}</td>
                                                <td>${res.sku_optiontype}</td>
                                                <td><button class="btn btn-danger delete"><i class="fa-trash-alt"></i></button></td>
                                            </tr>`;
                        }else{
                            Swal.fire({
                                position: 'top-end',
                                icon: 'warning',
                                title: 'Error',
                                text: "No Information",
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }

                        e.target.value=''
                    }

                })




            </script>

@stop

