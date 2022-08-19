@extends('adminlte::page')

@section('title', 'Dashboard')

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
        <div class="col-lg-12 my-3">
            <div class="card mb-4 shadow-sm card-outline card-primary">
                <div class="card-header ">
                    <h3 class="card-title mt-1">
                        Kits Listing
                    </h3>
                    <div class="card-tools">

{{--                        @can('create',$kits->first())--}}

                        <a class="btn btn-primary" href="{{ route('kits.create') }}">
                            <i class="fa fa-plus"></i> Create Kit
                        </a>
{{--                        @endcan--}}
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-hover table-bordered" id="kitsTable">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>WorkCenter</th>
                            <th>LCN</th>
                            <th>Kit LCN</th>
                            <th>Brand</th>
                            <th>Model</th>
                            <th>Category</th>
                            <th>Subcategory</th>
                            <th>Serial Number</th>
                            <th>Country</th>
                            <th>Manufactured At</th>

                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($kits as $kit)
                            <tr>
                                <td>{{$kit->KitID}}</td>
                                <td>{{$kit->workCenter->WorkCenterName}}</td>
                                <td>{{$kit->LCN}}</td>
                                <td>{{$kit->KitLCN}}</td>
                                <td>{{$kit->Brand}}</td>
                                <td>{{$kit->Model}}</td>
                                <td>{{$kit->category->CategoryName}}</td>
                                <td>{{$kit->subCategory->SubCategoryName}}</td>
                                <td>{{$kit->ProductSerialNumber}}</td>
                                <td>{{$kit->country->CountryName}}</td>
                                <td>{{$kit->DateManufactured}}</td>
                                <td>
                                    <a href="#" class="qrcode btn btn-sm btn-dark">
                                        <i class="fas fa-print"></i>
                                    </a>

                                    <a href="{{ route('kits.show',$kit) }}" class="btn btn-sm btn-default"
                                       target="_blank">
                                        <i class="fas fa-eye"></i>
                                    </a>
{{--                                    @can('update', $kit)--}}
                                        <a href="{{ route('kits.edit',$kit) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
{{--                                    @endcan--}}

{{--                                    @can('delete',$kit)--}}
{{--                                        <form  method="POST" action="{{ route('kits.destroy', $kit) }}"--}}
{{--                                               style="display:inline">--}}
{{--                                            @csrf @method('DELETE')--}}
{{--                                            <button class="btn btn-sm btn-danger"--}}
{{--                                                    onclick="return confirm('¿Estas seguro de eliminar esta publicacion?')">--}}
{{--                                                <i class="fas fa-trash-alt"></i></button>--}}
{{--                                        </form>--}}
{{--                                    @endcan--}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<iframe id="printf" name="printf"  style="visibility: hidden;" src="about:blank"></iframe>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready( function () {
            let table = $('#kitsTable').DataTable({
                order: [[0, 'desc']],
            });

            $('#kitsTable tbody').on('click', '.qrcode', function () {
                let data = table.row($(this).parents('tr')).data();
                let id = data[0];
                let url = "{{route('qrcode',':id')}}"
                url = url.replace(':id',id);
                document.getElementById('printf').src = url;
            });

        });
    </script>
@stop




