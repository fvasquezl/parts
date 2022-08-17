@extends('adminlte::page')
@section('title', 'Kits Creation')

@section('content_header')
    <h2>Kit {{$kitID}}, Creating Part No {{$editPart}}/{{$totalParts}}</h2>
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
                    <div class="card-header">{{ __('Kits')}}</div>

                    <div class="card-body">



                        <form method="POST" action="{{ route('parts.update',$part) }}">
                            @method('PATCH')
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="PartName" class="col-form-label text-md-end">{{ __('PartName') }}</label>

                                    <input id="PartName" type="text" class="form-control @error('PartName') is-invalid @enderror"
                                           name="PartName" value="{{ old('PartName',$part->PartName) }}"  autocomplete="PartName" autofocus readonly>

                                    @error('PartName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="PartValue" class="col-form-label text-md-end">{{ __('PartValue') }}</label>



                                    <div class="form-check mt-1">
                                        <input class="form-check-input" type="checkbox" name="PartValue"
                                               id="PartValue" {{ old('PartValue') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="PartValue">
                                            {{ __('Has Part') }}
                                        </label>
                                    </div>


{{--                                    <input id="PartValue" type="text" class="form-control @error('PartValue') is-invalid @enderror"--}}
{{--                                           name="PartValue" value="{{ old('PartValue',$part->PartValue) }}"  autocomplete="PartValue" autofocus>--}}

                                    @error('PartValue')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="PartWeight"
                                           class="col-form-label text-md-end">{{ __('Part Weight') }}</label>

                                    <input id="PartWeight" type="number" step="0.01"
                                           class="form-control @error('PartWeight') is-invalid @enderror" name="PartWeight"
                                           value="{{ old('PartWeight') }}"   >

                                    @error('PartWeight')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="PartRef1" class="col-form-label text-md-end">{{ __('PartRef1') }}</label>

                                    <input id="PartRef1" type="text"
                                           class="form-control @error('PartRef1') is-invalid @enderror" name="PartRef1"
                                           value="{{ old('PartRef1') }}"  autocomplete="PartRef1" autofocus >

                                    @error('PartRef1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="PartRef2" class="col-form-label text-md-end">{{ __('PartRef2') }}</label>

                                    <input id="PartRef2" type="text"
                                           class="form-control @error('PartRef2') is-invalid @enderror" name="PartRef2"
                                           value="{{ old('PartRef2') }}"  autocomplete="PartRef2" autofocus >

                                    @error('PartRef2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="PartRef3" class="col-form-label text-md-end">{{ __('PartRef3') }}</label>

                                    <input id="PartRef3" type="text"
                                           class="form-control @error('PartRef3') is-invalid @enderror" name="PartRef3"
                                           value="{{ old('PartRef3') }}"  autocomplete="PartRef3" autofocus >

                                    @error('PartRef3')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
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

{{--    <script>--}}
{{--        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');--}}
{{--        let headers = {--}}
{{--            "Content-Type": "application/json",--}}
{{--            "Accept": "application/json, text-plain, */*",--}}
{{--            "X-Requested-With": "XMLHttpRequest",--}}
{{--            "X-CSRF-TOKEN": token--}}
{{--        }--}}

{{--        document.getElementById('category_id').addEventListener('change', (e)=>{--}}
{{--            fetch('/subcategories', {--}}
{{--                method: 'POST',--}}
{{--                body: JSON.stringify({text: e.target.value}),--}}
{{--                headers:headers--}}
{{--            }).then(response=>{--}}
{{--                return response.json()--}}
{{--            }).then(data =>{--}}
{{--                let options = "";--}}
{{--                for (let i in data.list){--}}
{{--                    options += '<option value="'+data.list[i].PartSubCategoryID+'">'+data.list[i].SubCategoryName+'</option>';--}}
{{--                }--}}
{{--                document.getElementById('sub_category_id').innerHTML = options--}}
{{--            }).catch(error => console.log(error))--}}
{{--        })--}}

{{--        document.getElementById('LCN').addEventListener('change', (e)=>{--}}
{{--            fetch('/lcn', {--}}
{{--                method: 'POST',--}}
{{--                body: JSON.stringify({text: e.target.value}),--}}
{{--                headers:headers--}}
{{--            }).then(response=>{--}}
{{--                return response.json()--}}
{{--            }).then(data =>{--}}
{{--                console.log(data)--}}
{{--                document.getElementById('partsLCN').setAttribute('value',data.fields.partsLcn)--}}
{{--                document.getElementById('brand').setAttribute('value',data.fields.brand)--}}
{{--                document.getElementById('model').setAttribute('value',data.fields.model)--}}
{{--            }).catch(error => console.log(error))--}}
{{--        })--}}



{{--    </script>--}}
@stop
