@extends('adminlte::page')
@section('title', 'SKUS Creation')

@section('content_header')
    <h2>SKUS Creation Step1</h2>
@stop

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm card-outline card-primary">
                    <div class="card-header ">
                        <h3 class="card-title mt-1">
                            {{ __('SKUS')}}
                        </h3>
                        <div class="card-tools">
                            <b>Press [F12] to SAVE</b>
                        </div>
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{ route('skus.store') }}" enctype="multipart/form-data" id="myForm">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="brand" class="col-form-label text-md-end">{{ __('brand') }}</label>

                                    <input id="brand" type="text"
                                           class="form-control @error('brand') is-invalid @enderror" name="brand"
                                           value="{{ old('brand',$brand) }}"  autocomplete="off" autofocus>

                                    @error('brand')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="model" class="col-form-label text-md-end">{{ __('model') }}</label>

                                    <input id="model" type="text"
                                           class="form-control @error('model') is-invalid @enderror" name="model"
                                           value="{{ old('model',$model) }}"  autocomplete="off" autofocus >

                                    @error('model')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="CountryID"
                                           class="col-form-label text-md-end">{{ __('Country Origin') }}</label>

                                    <select name="CountryID" aria-label="select country" id="CountryID"
                                            class="form-control @error('CountryID') is-invalid @enderror" >
                                        {{--                                        @foreach ($countries as $country)--}}
                                        {{--                                            <option value="{{ $country->CountryID }}"--}}
                                        {{--                                                {{ old('CountryID',$kit->CountryID)==$country->CountryID ? 'selected':''}}>--}}
                                        {{--                                                {{ $country->CountryName}}</option>--}}
                                        {{--                                        @endforeach--}}
                                    </select>

                                    @error('CountryID')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="ProductVersionNumber"
                                           class="col-form-label text-md-end">{{ __('Product Version Number') }}</label>

                                    <input id="ProductVersionNumber" type="text"
                                           class="form-control @error('ProductVersionNumber') is-invalid @enderror"
                                           name="ProductVersionNumber" value="{{ old('ProductVersionNumber') }}"
                                           autocomplete="off" autofocus>

                                    @error('ProductVersionNumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">


                                <div class="col-md-6">
                                    <label for="Chasis"
                                           class="col-form-label text-md-end">{{ __('Chasis') }}</label>
                                    <select name="Chasis" aria-label="select subCategory" id="Chasis"
                                            class="form-control @error('Chasis') is-invalid @enderror">
                                        @if (old('Chasis'))
{{--                                            @foreach ($subCategories as $subCategory)--}}
{{--                                                <option value="{{ $subCategory->PartSubCategoryID }}"--}}
{{--                                                    {{ old('PartSubCategoryID',$kit->category_id)==$subCategory->PartSubCategoryID ? 'selected':''}}>--}}
{{--                                                    {{ $subCategory->SubCategoryName }}</option>--}}
{{--                                            @endforeach--}}
                                        @endif
                                    </select>

                                    @error('PartSubCategoryID')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row">
                                <button type="submit" class="btn btn-block btn-primary">
                                    {{ __('Create [F12]') }}
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <a href="" id="msearch"></a>
    </div>

@endsection


@section('css')
    <style>
        .modal-body{
            height: 500px;
            width: 100%;
            overflow-y: auto;
        }
    </style>


@stop

@section('js')

    <script>
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let headers = {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
        }


        window.addEventListener("load", function() {
            let e =document.getElementById('PartCategoryID');
            fetch('/subcategories', {
                method: 'POST',
                body: JSON.stringify({text: e.value}),
                headers:headers
            }).then(response=>{
                return response.json()
            }).then(data =>{
                let options = "";
                for (let i in data.list){
                    options += '<option value="'+data.list[i].PartSubCategoryID+'">'+data.list[i].SubCategoryName+'</option>';
                }
                document.getElementById('PartSubCategoryID').innerHTML = options
            }).catch(error => console.log(error))
        });



        document.getElementById('PartCategoryID').addEventListener('change', (e)=>{
            fetch('/subcategories', {
                method: 'POST',
                body: JSON.stringify({text: e.target.value}),
                headers:headers
            }).then(response=>{
                return response.json()
            }).then(data =>{
                let options = "";
                for (let i in data.list){
                    options += '<option value="'+data.list[i].PartSubCategoryID+'">'+data.list[i].SubCategoryName+'</option>';
                }
                document.getElementById('PartSubCategoryID').innerHTML = options
            }).catch(error => console.log(error))
        })


        document.querySelector('input[name="LCN"]').addEventListener("keyup", (e) => {
            if (e.key === "Enter") {
                e.target.value = e.target.value.replace('http://support.mitechnologiesinc.com/Item/LicensePlate/','');
                fetch('/lcn', {
                    method: 'POST',
                    body: JSON.stringify({data: e.target.value}),
                    headers:headers
                }).then(response=>{
                    return response.json()
                }).then(data =>{
                    if (data.fields['exist'] === '1') {
                        exists = 1
                    }
                    console.log(data)
                    document.getElementById('KitLCN').setAttribute('value',data.fields.partsLcn)
                    document.getElementById('Brand').setAttribute('value',data.fields.brand)
                    document.getElementById('Model').setAttribute('value',data.fields.model)
                    document.getElementById("Brand").focus();

                }).catch(error => console.log(error))
            }
        });

        document.querySelector('input[name="Brand"]').addEventListener("keyup", (e) => {
            if (e.key === "Enter") {
                document.getElementById("Model").focus();
            }
        });
        document.querySelector('input[name="Model"]').addEventListener("keyup", (e) => {
            if (e.key === "Enter") {
                document.getElementById("ProductSerialNumber").focus();
            }
        });


        $(document).ready(function() {
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });

        });


        window.onhelp = function() {
            return false;
        };

        window.onkeydown = evt => {
            switch (evt.keyCode) {
                //F12
                case 123:

                    document.getElementById("myForm").submit();
                    break;
                default:
                    return true;
            }
            //Returning false overrides default browser event
            return false;
        };

    </script>
@stop
