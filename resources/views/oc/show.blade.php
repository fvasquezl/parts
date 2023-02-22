@extends('adminlte::page')
@section('title', 'Kits Creation')

@section('content_header')
    <h4>Open Cell Configration</h4>
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
            <div class="col-lg-6 ">
                <div class="card shadow-sm card-outline card-primary">
                    <div class="card-header ">
                        <h3 class="card-title mt-1 days">
                            {{ __('Open Cell Configuration')}}
                        </h3>
                    </div>

                    <div class="card-body">
                        <form name="accForm" role="form" method="POST" id="accForm" action="{{route('oc.store')}}">
                            @csrf
                            <div class="form-group row">
                                <label for="brand" class="col-sm-2 col-form-label">Brand</label>
                                <div class="col-sm-10">
                                    <input name="brand" class="form-control" id="brand"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="model" class="col-sm-2 col-form-label">Model</label>
                                <div class="col-sm-10">
                                    <input name="model" class="form-control" id="model"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <hr/>
                            <h5>OC Details</h5>

                            <div class="form-group row">
                                <label for="manufacturer" class="col-sm-2 col-form-label">Manufacturer</label>
                                <div class="col-sm-10">
                                    <input name="manufacturer" class="form-control" id="manufacturer"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="partNumber" class="col-sm-2 col-form-label">Part Number</label>
                                <div class="col-sm-10">
                                    <input name="partNumber" class="form-control" id="partNumber"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="MITSKU" class="col-sm-2 col-form-label">MITSKU</label>
                                <div class="col-sm-10">
                                    <input name="MITSKU" class="form-control" id="MITSKU"/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="QOH" class="col-sm-2 col-form-label">QOH</label>
                                <div class="col-sm-10">
                                    <input name="QOH" class="form-control" id="QOH"/>
                                </div>
                            </div>


                            <hr/>
                            <h5>Assembly Details</h5>
                            <div class="form-group row">
                                <label for="instructions" class="col-sm-2 col-form-label">Instructions</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="instructions" id="instructions" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="instructions" class="col-sm-2 col-form-label">Assembly Guide</label>
                                <div class="col-sm-10">
                                    <input name="instructions" class="form-control" id="instructions"/>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-lg-6 ">
                <div class="card shadow-sm card-outline card-primary">
                    <div class="card-header ">
                        <h3 class="card-title mt-1 days">
                            {{ __('Assembly Components')}}
                        </h3>

                    </div>

                    <div class="card-body">
                        <div>
                            <table class="table table-striped table-hover table-bordered nowrap" id="OCAccessoriesTable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Part Name</th>
                                    <th>MITSKU</th>
                                    <th>Qty Required</th>
                                    <th>Notes</th>
                                    <th>QOH</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('oc.shared.OCAccessoriesModal')
@endsection


@section('css')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

@stop

@section('js')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('js/OCCreate.js')}}"></script>

{{--    <script>--}}
{{--        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');--}}
{{--        let $openCells--}}
{{--        let $OCAccessoriesTable--}}
{{--        let $componentsTable--}}
{{--        let OcConfigId--}}
{{--        let headers = {--}}
{{--            "Content-Type": "application/json",--}}
{{--            "Accept": "application/json, text-plain, */*",--}}
{{--            "X-Requested-With": "XMLHttpRequest",--}}
{{--            "X-CSRF-TOKEN": token--}}
{{--        }--}}

{{--        $(document).ready(function () {--}}
{{--            $.ajaxSetup({--}}
{{--                headers: {--}}
{{--                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                }--}}
{{--            });--}}
{{--            $openCells = $('#openCells').DataTable({--}}
{{--                order: [[0, 'desc']],--}}
{{--                pageLength: 100,--}}
{{--                lengthMenu: [--}}
{{--                    [100,500, -1],--}}
{{--                    [100,500,'All']--}}
{{--                ],--}}
{{--                processing: true,--}}
{{--                serverSide: true,--}}
{{--                scrollY: "20vh",--}}
{{--                // scrollX: true,--}}
{{--                scrollCollapse: true,--}}
{{--                stateSave: true,--}}
{{--                dom: 'rt',--}}
{{--                ajax: {--}}
{{--                    url: "/oc/getOCList",--}}
{{--                    data: function (d) {--}}
{{--                        d.brand = $('select[name=brand]').val();--}}
{{--                        d.model = $('select[name=model]').val();--}}
{{--                    },--}}
{{--                },--}}
{{--                columns: [--}}
{{--                    {data: 'id', name: 'id'},--}}
{{--                    {data: 'OC_Manufacturer', name: 'OC_Manufacturer'},--}}
{{--                    {data: 'OC_PartNumber', name: 'OC_PartNumber'},--}}
{{--                    {data: 'OC_MITSKU', name: 'OC_MITSKU'},--}}
{{--                ],--}}
{{--                columnDefs: [--}}
{{--                    {--}}
{{--                        targets: [0],--}}
{{--                        searchable: true,--}}
{{--                        // visible: false,--}}
{{--                    },--}}
{{--                ]--}}

{{--            })--}}
{{--            $OCAccessoriesTable = $('#OCAccessoriesTable').DataTable({--}}
{{--                order: [[0, 'desc']],--}}
{{--                pageLength: 100,--}}
{{--                lengthMenu: [--}}
{{--                    [100,500, -1],--}}
{{--                    [100,500,'All']--}}
{{--                ],--}}
{{--                processing: true,--}}
{{--                serverSide: true,--}}
{{--                scrollY: "53vh",--}}
{{--                // scrollX: true,--}}
{{--                scrollCollapse: true,--}}
{{--                stateSave: true,--}}
{{--                dom: 'rt',--}}
{{--                ajax: {--}}
{{--                    url: "/oc/accessories",--}}
{{--                    data: function (d) {--}}
{{--                        d.OcConfigId= OcConfigId;--}}
{{--                    },--}}
{{--                },--}}
{{--                columns: [--}}
{{--                    {data: 'id', name: 'id'},--}}
{{--                    {data: 'part_name', name: 'part_name'},--}}
{{--                    {data: 'MITSKU', name: 'MITSKU'},--}}
{{--                    {data: 'qty_required', name: 'qty_required'},--}}
{{--                    {data: 'Notes', name: 'Notes'},--}}
{{--                ],--}}
{{--                columnDefs: [--}}
{{--                    {--}}
{{--                        targets: [0],--}}
{{--                        searchable: true,--}}
{{--                        // visible: false,--}}
{{--                    },--}}
{{--                ]--}}

{{--            })--}}
{{--        });--}}


{{--        $('#model').select2({--}}
{{--            theme: 'bootstrap4',--}}
{{--        }).on("change", function() {--}}
{{--            $openCells.ajax.reload()--}}
{{--            getPNFromModel($(this).val());--}}
{{--        });--}}

{{--        $('#partNumber').select2({--}}
{{--            theme: 'bootstrap4',--}}
{{--        }).on("change",function (){--}}
{{--            getManufacturerFromPartNumber($(this).val());--}}
{{--        })--}}

{{--        $('#mitSku').select2({--}}
{{--            theme: 'bootstrap4',--}}
{{--        }).on("change",function (){--}}
{{--            clearForm(4)--}}
{{--        })--}}

{{--        let $mitSKU= $('#aMitSKU')--}}

{{--        $(document).on('click', '#btnOCAccessories', function (e) {--}}
{{--            $('#ocAccModal')--}}
{{--                .on('shown.bs.modal', function () {--}}
{{--                    $('#ocId').val(OcConfigId)--}}
{{--                    getMPartName()--}}
{{--                    $mitSKU.select2({theme: 'bootstrap4'})--}}
{{--                }).on('hidden.bs.modal', function () {--}}
{{--                $mitSKU.html('<option value="">MITSKU</option>')--}}
{{--                $('#accDataForm').trigger("reset");--}}
{{--            }).modal('show');--}}
{{--        })--}}

{{--        $('#aPartName').on("change", function(e) {--}}
{{--            getMitSKUFromPartName($(this).val());--}}
{{--        });--}}



{{--    </script>--}}

{{--    <script>--}}
{{--        document.querySelector('.custom-file-input').addEventListener('change', function (e) {--}}
{{--            let name = document.getElementById("assemblyGuide").files[0].name;--}}
{{--            let nextSibling = e.target.nextElementSibling--}}
{{--            nextSibling.innerText = name--}}
{{--        })--}}

{{--        document.getElementById('resetAndContinue').addEventListener('click',(e)=>{--}}
{{--            window.location.reload();--}}
{{--        })--}}
{{--    </script>--}}

@stop
