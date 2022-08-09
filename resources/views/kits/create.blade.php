@extends('layouts.app')

@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Parts') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('kits.store') }}">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="workCenter_id"
                                           class="col-form-label text-md-end">{{ __('Work Center') }}</label>

                                    <select name="workCenter_id" aria-label="select workCenter"
                                            class="form-select @error('workCenter_id') is-invalid @enderror" required>
                                        <option value="">--Select Work Center</option>
                                        @foreach ($workCenters as $workCenter)
                                            <option value="{{ $workCenter->id }}"
                                                {{ old('workCenter_id',$kit->workCenter_id)==$workCenter->id ? 'selected':''}}>
                                                {{ $workCenter->name }}</option>
                                        @endforeach
                                    </select>


                                    @error('workCenter_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="lcn" class="col-form-label text-md-end">{{ __('LCN') }}</label>

                                    <input id="lcn" type="text" class="form-control @error('lcn') is-invalid @enderror"
                                           name="lcn" value="{{ old('lcn') }}" required autocomplete="lcn" autofocus>

                                    @error('lcn')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="partsLcn"
                                           class="col-form-label text-md-end">{{ __('Parts LCN') }}</label>

                                    <input id="partsLcn" type="text"
                                           class="form-control @error('partsLcn') is-invalid @enderror" name="partsLcn"
                                           value="{{ old('partsLcn') }}" required autocomplete="partsLcn" autofocus>

                                    @error('partsLcn')
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
                                           value="{{ old('brand') }}" required autocomplete="brand" autofocus>

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
                                           value="{{ old('model') }}" required autocomplete="model" autofocus>

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
                                            class="form-select @error('category_id') is-invalid @enderror" required>
                                        <option value="">--Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id',$kit->category_id)==$category->id ? 'selected':''}}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="subCategory_id"
                                           class="col-form-label text-md-end">{{ __('Sub Category') }}</label>

                                    <select name="subCategory_id" aria-label="select subCategory" class="form-select" id="subCategory_id">

{{--                                    <select name="subCategory_id" aria-label="select subCategory"--}}
{{--                                            class="form-select @error('subCategory_id') is-invalid @enderror" required>--}}
{{--                                        <option value="">--Select Sub Category</option>--}}
{{--                                        @foreach ($subCategories as $subCategory)--}}
{{--                                            <option value="{{ $subCategory->id }}"--}}
{{--                                                {{ old('subCategory_id',$kit->subCategory_id)==$subCategory->id ? 'selected':''}}>--}}
{{--                                                {{ $subCategory->name }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
                                    </select>

                                    @error('subCategory')
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
                                           name="productSerialNumber" value="{{ old('productSerialNumber') }}" required
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
                                            class="form-select @error('country_id') is-invalid @enderror" required>
                                        <option value="">--Select Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}"
                                                {{ old('country_id',$kit->country_id)==$country->id ? 'selected':''}}>
                                                {{ $country->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('country_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
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
                                           name="dateManufactured" value="{{ old('dateManufactured') }}" required
                                           autocomplete="dateManufactured" autofocus>

                                    @error('dateManufactured')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <div class="mt-3">&nbsp;</div>
                                    <div class="form-check mt-1">
                                        <input class="form-check-input" type="checkbox" name="isCompleted"
                                               id="isCompleted" {{ old('isCompleted') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="isCompleted">
                                            {{ __('Is Completed') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{--Estimated Retail Price and Notes--}}
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <label for="estimatedPriceRetail"
                                           class="col-form-label text-md-end">{{ __('Estimated Retail Price') }}</label>

                                    <input id="estimatedPriceRetail" type="number"
                                           class="form-control @error('estimatedPriceRetail') is-invalid @enderror"
                                           name="estimatedPriceRetail" value="{{ old('estimatedPriceRetail') }}"
                                           required autocomplete="estimatedPriceRetail" autofocus>

                                    @error('estimatedPriceRetail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="notes" class="form-label">Notes</label>
                                    <textarea class="form-control" id="notes" rows="3"></textarea>
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

@push('scripts')
<script>
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    document.getElementById('category_id').addEventListener('change', (e)=>{
        fetch('/subcategories', {
            method: 'POST',
            body: JSON.stringify({text: e.target.value}),
            headers:{
                "Content-Type": "application/json",
                "Accept": "application/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": token
            }
        }).then(response=>{
            return response.json()
        }).then(data =>{
            let options = "";
            for (let i in data.list){
                options += '<option value="'+data.list[i].id+'">'+data.list[i].name+'</option>';
            }
            document.getElementById('subCategory_id').innerHTML = options
        }).catch(error => console.log(error))
    })
</script>
@endpush
