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

                            <form method="POST" action="{{ route('kits.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="WorkCenterID"
                                               class="col-form-label text-md-end">{{ __('Work Center') }}</label>

                                        <select name="WorkCenterID" aria-label="select workCenter"
                                                class="select2 form-control @error('WorkCenterID') is-invalid @enderror" >

                                            @foreach ($workCenters as $workCenter)
                                                <option value="{{ $workCenter->WorkCenterID }}"
                                                    {{ old('WorkCenterID',$kit->WorkCenterID)==$workCenter->WorkCenterID ? 'selected':''}}>
                                                    {{ $workCenter->WorkCenterName }}</option>
                                            @endforeach
                                        </select>


                                        @error('WorkCenterID')
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
                                               name="LCN" value="{{ old('LCN') }}"  autocomplete="LCN" autofocus>

                                        @error('LCN')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="KitLCN"
                                               class="col-form-label text-md-end">{{ __('Parts LCN') }}</label>

                                        <input id="KitLCN" type="text"
                                               class="form-control @error('KitLCN') is-invalid @enderror" name="KitLCN"
                                               value="{{ old('KitLCN') }}"  autocomplete="KitLCN" autofocus readonly>

                                        @error('KitLCN')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="Brand" class="col-form-label text-md-end">{{ __('Brand') }}</label>

                                        <input id="Brand" type="text"
                                               class="form-control @error('Brand') is-invalid @enderror" name="Brand"
                                               value="{{ old('Brand') }}"  autocomplete="Brand" autofocus readonly>

                                        @error('Brand')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="Model" class="col-form-label text-md-end">{{ __('Model') }}</label>

                                        <input id="Model" type="text"
                                               class="form-control @error('Model') is-invalid @enderror" name="Model"
                                               value="{{ old('Model') }}"  autocomplete="Model" autofocus readonly>

                                        @error('Model')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                {{--Categories and Subcategories--}}
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="PartCategoryID"
                                               class="col-form-label text-md-end">{{ __('Category') }}</label>

                                        <select name="PartCategoryID" aria-label="select category" id="PartCategoryID"
                                                class="select2 form-control @error('PartCategoryID') is-invalid @enderror">

                                            @foreach ($categories as $category)
                                                <option value="{{ $category->PartCategoryID }}"
                                                    {{ old('PartCategoryID',$kit->PartCategoryID)==$category->PartCategoryID ? 'selected':''}}>
                                                    {{ $category->CategoryName }}</option>
                                            @endforeach

                                        </select>

                                        @error('PartCategoryID')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="PartSubCategoryID"
                                               class="col-form-label text-md-end">{{ __('Sub Category') }}</label>
                                        <select name="PartSubCategoryID" aria-label="select subCategory" id="PartSubCategoryID"
                                        class="form-control @error('PartSubCategoryID') is-invalid @enderror">
                                            @if (old('PartSubCategoryID'))
                                                @foreach ($subCategories as $subCategory)
                                                    <option value="{{ $subCategory->PartSubCategoryID }}"
                                                        {{ old('PartSubCategoryID',$kit->category_id)==$subCategory->PartSubCategoryID ? 'selected':''}}>
                                                        {{ $subCategory->SubCategoryName }}</option>
                                                @endforeach
                                            @endif
                                        </select>

                                        @error('PartSubCategoryID')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                {{--Product Serial Number and Country Origin--}}
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="ProductSerialNumber"
                                               class="col-form-label text-md-end">{{ __('Product Serial Number') }}</label>

                                        <input id="ProductSerialNumber" type="text"
                                               class="form-control @error('ProductSerialNumber') is-invalid @enderror"
                                               name="ProductSerialNumber" value="{{ old('ProductSerialNumber') }}"
                                               autocomplete="ProductSerialNumber" autofocus>

                                        @error('ProductSerialNumber')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="CountryID"
                                               class="col-form-label text-md-end">{{ __('Country Origin') }}</label>

                                        <select name="CountryID" aria-label="select country"
                                                class="form-control @error('CountryID') is-invalid @enderror" >
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->CountryID }}"
                                                    {{ old('CountryID',$kit->CountryID)==$country->CountryID ? 'selected':''}}>
                                                    {{ $country->CountryName}}</option>
                                            @endforeach
                                        </select>

                                        @error('CountryID')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                {{--Date Manufactured and Is completed--}}
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="DateManufactured"
                                               class="col-form-label text-md-end">{{ __('Date Manufactured') }}</label>

                                        <input id="DateManufactured" type="date"
                                               class="form-control @error('DateManufactured') is-invalid @enderror"
                                               name="DateManufactured" value="{{ old('DateManufactured') }}"
                                               autocomplete="DateManufactured" autofocus>

                                        @error('DateManufactured')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>


                                    <div class="col-md-6 mt-2">
                                        <label for="Comments" class="form-label">Notes</label>
                                        <textarea name=Comments class="form-control @error('Comments') is-invalid @enderror" id="Comments"
                                                  placeholder="Add Comments" rows="3">{!! old('Comments', $kit->Comments) !!}</textarea>

                                        @error('Comments')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <button type="submit" class="btn btn-block btn-primary">
                                        {{ __('Create') }}
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
                document.getElementById('PartSubCategoryID').innerHTML = options
            }).catch(error => console.log(error))
        }




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



        document.getElementById('LCN').addEventListener('change', (e)=>{
            e.target.value = e.target.value.replace('http://support.mitechnologiesinc.com/Item/LicensePlate/','');

            fetch('/lcn', {
                method: 'POST',
                body: JSON.stringify({text: e.target.value}),
                headers:headers
            }).then(response=>{
                return response.json()
            }).then(data =>{
                console.log(data)
                document.getElementById('KitLCN').setAttribute('value',data.fields.partsLcn)
                 document.getElementById('Brand').setAttribute('value',data.fields.brand)
                 document.getElementById('Model').setAttribute('value',data.fields.model)
            }).catch(error => console.log(error))
        })



        // const form = document.querySelector('form')
        // form.onsubmit = (e) => {
        //     e.preventDefault()
        //     const confirmSubmit = confirm('Are you sure you want to submit this form?');
        //     if (confirmSubmit) {
        //         console.log('submitted')
        //     }
        // }

        {{--$('#kitsTable tbody').on('click', '.qrcode', function () {--}}
        {{--    let data = table.row($(this).parents('tr')).data();--}}
        {{--    let id = data[0];--}}
        {{--    let url = "{{route('qrcode',':id')}}"--}}
        {{--    url = url.replace(':id',id);--}}
        {{--    document.getElementById('printf').src = url;--}}
        {{--});--}}

    </script>
@stop
