@extends('adminlte::page')
@section('title', 'Kits Creation')

@section('content_header')
    <h4>Open Cell Configration: {{$ocConfig["id"]}}</h4>
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
                                    <input name="brand" class="form-control" id="brand" value="{{$ocConfig["Brand"]}}"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="model" class="col-sm-2 col-form-label">Model</label>
                                <div class="col-sm-10">
                                    <input name="model" class="form-control" id="model" value="{{$ocConfig["Model"]}}" />
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
                                    <input name="manufacturer" class="form-control" id="manufacturer" value="{{$ocConfig["OC_Manufacturer"]}}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="partNumber" class="col-sm-2 col-form-label">Part Number</label>
                                <div class="col-sm-10">
                                    <input name="partNumber" class="form-control" id="partNumber" value="{{$ocConfig["OC_PartNumber"]}}"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="MITSKU" class="col-sm-2 col-form-label">MITSKU</label>
                                <div class="col-sm-10">
                                    <input name="MITSKU" class="form-control" id="MITSKU" value="{{$ocConfig["OC_MITSKU"]}}"/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="QOH" class="col-sm-2 col-form-label">QOH</label>
                                <div class="col-sm-10">
                                    <input name="QOH" class="form-control" id="QOH" value="{{$ocConfig["Qty"]}}"/>
                                </div>
                            </div>


                            <hr/>
                            <h5>Assembly Details</h5>
                            <div class="form-group row">
                                <label for="instructions" class="col-sm-2 col-form-label">Instructions</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="instructions" id="instructions" rows="3">{{$ocConfig["notes"]}}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="instructions" class="col-sm-2 col-form-label">Assembly Guide</label>
                                <div class="col-sm-10 mt-2">
                                    <a href="{{$ocConfig["attachments"]}}">{{$ocConfig["attachments"]}}</a>
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
                                <tbody>
                                @foreach ($ocAccessories as $accessory)
                                    <tr>
                                        <td>{{ $accessory->id }}</td>
                                        <td>{{ $accessory->part_name }}</td>
                                        <td>{{ $accessory->MITSKU }}</td>
                                        <td>{{ $accessory->qty_required }}</td>
                                        <td>{{ $accessory->Notes }}</td>
                                        <td>{{ $accessory->QOH }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
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

    <script>

        let $OCAccessoriesTable

        $(document).ready(function () {
            $OCAccessoriesTable = $('#OCAccessoriesTable').DataTable({
                order: [[0, 'desc']],
                pageLength: 100,
                processing: true,
                scrollY: "53vh",
                // scrollX: true,
                scrollCollapse: true,
                stateSave: true,
            })
        });

    </script>

@stop
