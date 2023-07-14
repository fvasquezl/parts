@extends('adminlte::page')

@section('title', 'Edit Kit Orders')

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
                            Kit Orders Details
                        </h3>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm border-right">
                                <div class="form-group row">
                                    <label for="orderNo" class="col-sm-2 col-form-label">Order#</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="{{$kitOrder->order_id}}" class="form-control"
                                               name="orderNo" id="orderNo" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="orderRef" class="col-sm-2 col-form-label">Reference Order #</label>
                                    <div class="col-sm-10">
                                        <input type="id" value="{{$kitOrder->reforder_id}}" class="form-control"
                                               name="orderRef" id="orderRef">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group row">
                                    <label for="orderDate" class="col-sm-2 col-form-label">Order Date</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="{{$kitOrder->created_at}}" class="form-control"
                                               name="orderDate" id="orderDate" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="orderStatus" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="{{$kitOrder->order_status}}" class="form-control"
                                               name="orderStatus" id="orderStatus" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="mt-0">

                        <div class="row">
                            <div class="col-sm border-right">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th>Sku/LCN</th>
                                        <th>Qty</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($kitOrder->kitOrderDetails as $detail)
                                        <tr>
                                            <td>{{$detail->kit_lcn}}{{$detail->ref_sku}}</td>
                                            <td class="text-center">{{$detail->qty}}</td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm">
                                <input type="text" class="form-control mb-3" name="addlcn" id="addLcn"
                                       placeholder="Scan LCN">

                                <form>
                                    <div class="row">
                                        <div class="col-lg-7" id="lcn_inputs">
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <button class="btn btn-success save-order">Save Order</button>
                                        <button class="btn btn-danger save-order">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('kitOrder.shared.kitOrderModal')
        @stop

        @section('css')
{{--            <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">--}}
{{--            <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.css">--}}
{{--            <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap4.min.css">--}}
{{--            <link rel="stylesheet" href="https://cdn.datatables.net/select/1.5.0/css/select.dataTables.min.css">--}}
{{--            <link rel="stylesheet"--}}
{{--                  href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css"/>--}}
{{--            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"/>--}}
{{--            <link--}}
{{--                href="https://cdn.jsdelivr.net/npm/jquery-datatables-checkboxes@1.2.13/css/dataTables.checkboxes.min.css"--}}
{{--                rel="stylesheet">--}}

            <style>
                .verybigmodal {
                    max-width: 80%;
                }

                input[type=checkbox] {
                    width: 17px;
                    height: 17px;
                }

                .linea {
                    margin: 0px 20px;
                    width: 90px;
                    border-top: 1px solid #999;
                    position: relative;
                    top: 10px;
                    float: left;
                }

                .leyenda {
                    font-weight: bold;
                    float: left;
                }
            </style>
        @stop

        @section('js')
{{--            <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>--}}
{{--            <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>--}}
{{--            <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>--}}
{{--            <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap4.min.js"></script>--}}
{{--            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>--}}
{{--            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>--}}
{{--            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>--}}
{{--            <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>--}}
{{--            <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>--}}
{{--            <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>--}}
{{--            <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.js"></script>--}}
{{--            <script src="https://cdn.datatables.net/select/1.5.0/js/dataTables.select.min.js"></script>--}}
{{--            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>--}}
{{--            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>--}}
{{--            <script--}}
{{--                src="https://cdn.jsdelivr.net/npm/jquery-datatables-checkboxes@1.2.13/js/dataTables.checkboxes.min.js"></script>--}}
{{--            <script src="{{ asset('js/orderDetails.js') }}"></script>--}}

        <script>

            let i=0
            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            let headers = {
                "Content-Type": "application/json",
                "Accept": "application/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": token
            }
            window.addEventListener('load', function() {
                console.log('All assets are loaded')
                document.getElementById('addLcn').focus()
            })

            $("#addLcn").on('keyup', function (e) {
                if (e.key === 'Enter' || e.keyCode === 13) {
                    i++
                    $('#lcn_inputs').append(`<div class="d-flex flex-row mt-2">
                                                <input type="text" name=lcn[${i}] class="form-control" value="${e.target.value}">
                                                <button  type="button" class="btn btn-danger btn-sm ml-2 remove-btn-row">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                             </div>`)
                    e.target.value=''
                }
            });



    {{--        function checkSelectedOption() {--}}
    {{--            const radios = document.getElementsByName("optionType");--}}
    {{--            let selectedOption = "";--}}
    {{--            for (let i = 0; i < radios.length; i++) {--}}
    {{--                if (radios[i].checked) {--}}
    {{--                    selectedOption = radios[i].value;--}}
    {{--                    break;--}}
    {{--                }--}}
    {{--            }--}}
    {{--            return selectedOption--}}
    {{--        }--}}

    {{--        let i=0;--}}
    {{--        $('#addOrderDetails').click(function(){--}}
    {{--            let res = checkSelectedOption()--}}
    {{--            if(res==='lcn'){--}}
    {{--                lcn()--}}
    {{--            }else{--}}
    {{--                sku()--}}
    {{--            }--}}
    {{--        })--}}

            $(document).on('click','.remove-btn-row',function(e){
                e.preventDefault()
                $(this).closest('div').remove();
                 // $(this).parents('div').remove();
                 $("#addLcn").focus()
            })


    {{--        document.getElementById('orderDetailsForm').addEventListener('submit',async(e)=>{--}}
    {{--            e.preventDefault()--}}

    {{--            const fd = new FormData(e.target);--}}
    {{--            let formData = {};--}}
    {{--            for (let [key, prop] of fd) {--}}
    {{--                formData[key] = prop;--}}
    {{--            }--}}

    {{--            const refOrder= document.getElementById('orderRef').value--}}
    {{--            const myData  = await manageData('/kit-order/{{$kitOrder->order_id}}','PATCH', {formData,refOrder})--}}


    {{--            if(myData){--}}
    {{--                Swal.fire({--}}
    {{--                    icon: 'success',--}}
    {{--                    title: 'Success',--}}
    {{--                    text: myData.success,--}}
    {{--                    confirmButtonColor: '#3085d6',--}}
    {{--                    confirmButtonText: 'Ok!'--}}
    {{--                }).then((result) => {--}}
    {{--                    if (result.isConfirmed) {--}}
    {{--                        window.location.replace("/kit-order");--}}
    {{--                    }--}}
    {{--                })--}}
    {{--            }--}}

    {{--        })--}}



        </script>

@stop
