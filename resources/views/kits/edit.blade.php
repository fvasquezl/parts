@extends('adminlte::page')
@section('title', 'Kits Creation')

@section('content_header')
    <h2>Kits Creation</h2>
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
                <div class="card">
                    <div class="card-header">{{ __('Kits') }}</div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('kits.update',$kit) }}">
                            @csrf
                            @method('PATCH')

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="work_center_id"
                                           class="col-form-label text-md-end">{{ __('Work Center') }}</label>

                                    <select name="work_center_id" aria-label="select workCenter"
                                            class="select2 form-control @error('work_center_id') is-invalid @enderror" >

                                        @foreach ($workCenters as $workCenter)
                                            <option value="{{ $workCenter->WorkCenterID }}"
                                                {{ old('work_center_id',$kit->work_center_id)==$workCenter->WorkCenterID ? 'selected':''}}>
                                                {{ $workCenter->WorkCenterName }}</option>
                                        @endforeach
                                    </select>


                                    @error('work_center_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="LCN" class="col-form-label text-md-end">{{ __('LCN') }}</label>

                                    <input id="LCN" type="text" class="form-control @error('LCN') is-invalid @enderror"
                                           name="LCN" value="{{ old('LCN',$kit->LCN) }}"  autocomplete="LCN" autofocus>

                                    @error('LCN')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="partsLCN"
                                           class="col-form-label text-md-end">{{ __('Kit LCN') }}</label>

                                    <input id="partsLCN" type="text"
                                           class="form-control @error('partsLCN') is-invalid @enderror" name="partsLCN"
                                           value="{{ old('partsLCN',$kit->KitLCN) }}"  autocomplete="partsLCN" autofocus readonly>

                                    @error('partsLCN')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="brand" class="col-form-label text-md-end">{{ __('Brand') }}</label>

                                    <input id="brand" type="text"
                                           class="form-control @error('brand') is-invalid @enderror" name="brand"
                                           value="{{ old('brand',$kit->Brand) }}"  autocomplete="brand" autofocus readonly>

                                    @error('brand')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="model" class="col-form-label text-md-end">{{ __('Model') }}</label>

                                    <input id="model" type="text"
                                           class="form-control @error('model') is-invalid @enderror" name="model"
                                           value="{{ old('model',$kit->Model) }}"  autocomplete="model" autofocus readonly>

                                    @error('model')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            {{--Categories and Subcategories--}}
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="category_id"
                                           class="col-form-label text-md-end">{{ __('Category') }}</label>

                                    <select name="category_id" aria-label="select category" id="category_id"
                                            class="select2 form-control @error('category_id') is-invalid @enderror" readonly>


                                        <option value="{{ $kit->PartCategoryID }}"
                                            {{ old('category_id',$kit->category_id)==$kit->category->PartCategoryID ? 'selected':''}}>
                                            {{ $kit->category->CategoryName }}</option>

                                    </select>

                                    @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="sub_category_id"
                                           class="col-form-label text-md-end">{{ __('Sub Category') }}</label>
                                    <select name="sub_category_id" aria-label="select subCategory" id="sub_category_id"
                                            class="form-control @error('sub_category_id') is-invalid @enderror">
                                        @if (old('sub_category_id'))
                                            @foreach ($subCategories as $subCategory)
                                                <option value="{{ $subCategory->PartSubCategoryID }}"
                                                    {{ old('sub_category_id',$kit->category_id)==$subCategory->PartSubCategoryID ? 'selected':''}}>
                                                    {{ $subCategory->SubCategoryName }}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                    @error('sub_category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            {{--Product Serial Number and Country Origin--}}
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="productSerialNumber"
                                           class="col-form-label text-md-end">{{ __('Product Serial Number') }}</label>

                                    <input id="productSerialNumber" type="text"
                                           class="form-control @error('productSerialNumber') is-invalid @enderror"
                                           name="productSerialNumber" value="{{ old('productSerialNumber',$kit->ProductSerialNumber) }}"
                                           autocomplete="productSerialNumber" autofocus>

                                    @error('productSerialNumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="country_id"
                                           class="col-form-label text-md-end">{{ __('Country Origin') }}</label>

                                    <select name="country_id" aria-label="select country"
                                            class="form-control @error('country_id') is-invalid @enderror" >
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->CountryID }}"
                                                {{ old('country_id',$kit->country_id)==$country->CountryID ? 'selected':''}}>
                                                {{ $country->CountryName}}</option>
                                        @endforeach
                                    </select>

                                    @error('country_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            {{--Date Manufactured and Is completed--}}
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="dateManufactured"
                                           class="col-form-label text-md-end">{{ __('Date Manufactured') }}</label>

                                    <input id="dateManufactured" type="date"
                                           class="form-control @error('dateManufactured') is-invalid @enderror"
                                           name="dateManufactured" value="{{ old('dateManufactured',$kit->DateManufactured) }}"
                                           autocomplete="dateManufactured" autofocus>

                                    @error('dateManufactured')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>


                                <div class="col-md-6 mt-2">
                                    <label for="notes" class="form-label">Notes</label>
                                    <textarea name=notes class="form-control @error('notes') is-invalid @enderror" id="notes"
                                              placeholder="Add notes" rows="3">{!! old('notes', $kit->Comments) !!}</textarea>

                                    @error('notes')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <button type="submit" class="btn btn-block btn-primary">
                                    {{ __('Update Kit') }}
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('css')

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
            let e =document.getElementById('category_id');
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
                document.getElementById('sub_category_id').innerHTML = options
            }).catch(error => console.log(error))
        });

        function getData(e){
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
                document.getElementById('sub_category_id').innerHTML = options
            }).catch(error => console.log(error))
        }




        document.getElementById('category_id').addEventListener('change', (e)=>{
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
                document.getElementById('sub_category_id').innerHTML = options
            }).catch(error => console.log(error))
        })




        document.getElementById('LCN').addEventListener('change', (e)=>{
            fetch('/lcn', {
                method: 'POST',
                body: JSON.stringify({text: e.target.value}),
                headers:headers
            }).then(response=>{
                return response.json()
            }).then(data =>{
                console.log(data)
                document.getElementById('partsLCN').setAttribute('value',data.fields.partsLcn)
                document.getElementById('brand').setAttribute('value',data.fields.brand)
                document.getElementById('model').setAttribute('value',data.fields.model)
            }).catch(error => console.log(error))
        })


    </script>
@stop