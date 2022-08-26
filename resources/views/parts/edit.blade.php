@extends('adminlte::page')
@section('title', 'Kits Creation')

@section('content_header')
    <h2>Kit {{$kitID}}, "{{$part->PartName}}"-{{$editPart}}/{{$totalParts}}</h2>
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
                    <div class="card-header ">
                        <h3 class="card-title mt-1">
                            {{ __('Kit - ').$part->PartName}}
                        </h3>
                        <div class="card-tools">

                            {{--                        @can('create',$kits->first())--}}

{{--                            <a class="btn btn-primary" href="{{ route('kits.create') }}">--}}
{{--                                <i class="fa fa-plus"></i> Create Kit--}}
{{--                            </a>--}}
                            {{--                        @endcan--}}
                            @if( ! $part->IsRequired )
                            <b>Press [ESC] to SKIP</b>
                            @endif
                        </div>
                    </div>

{{--                    <div class="card-header"> </div>--}}

                    <div class="card-body">



                        <form method="POST" action="{{ route('parts.update',$part) }}" id="myForm">
                            @method('PATCH')
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="PartName" class="col-form-label text-md-end">{{ __('PartName') }}</label>

                                    <input id="PartName" type="text" class="form-control @error('PartName') is-invalid @enderror"
                                           name="PartName" value="{{ old('PartName',$part->PartName) }}"  autocomplete="off" autofocus readonly>

                                    @error('PartName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="PartWeight"
                                           class="col-form-label text-md-end">{{ __('Part Weight (oz)') }}</label>

                                    <input id="PartWeight" type="number" step="0.01"
                                           class="form-control @error('PartWeightOz') is-invalid @enderror" name="PartWeightOz"
                                           value="{{ old('PartWeightOz',$part->PartWeightOz) }}"   >

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
                                           value="{{ old('PartRef1',$part->PartRef1) }}"  autocomplete="off" autofocus >

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
                                           value="{{ old('PartRef2',$part->PartRef2) }}"  autocomplete="off" autofocus >

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
                                           value="{{ old('PartRef3',$part->PartRef3) }}"  autocomplete="off" autofocus >

                                    @error('PartRef3')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <input name="IsRequired" type="hidden" value="{{$part->IsRequired}}">
                            <input name="isSkipped" id="isSkipped" type="hidden" value="0">


                            @if ($part->IsRequired)
                                <div class="row">
                                    <button type="submit" class="btn btn-block btn-primary">
                                        {{ __('Save Part') }}
                                    </button>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-block btn-primary">
                                            {{ __('Save Part') }}
                                        </button>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-block btn-danger skip-btn">
                                            {{ __('Skip') }}
                                        </button>
                                    </div>
                                </div>
                            @endif

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
        document.querySelector('input[name="PartRef1"]').addEventListener("keyup", (e) => {
            if (e.key === "Enter") {
                document.getElementById("PartRef2").focus();
            }
        });

        document.querySelector('input[name="PartRef2"]').addEventListener("keyup", (e) => {
            if (e.key === "Enter") {
                document.getElementById("PartRef3").focus();
            }
        });
        // document.querySelector('input[name="PartRef3"]').addEventListener("keyup", (e) => {
        //     if (e.key === "Enter") {
        //         document.getElementById("PartRef3").focus();
        //     }
        // });


        $(document).ready(function() {
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        });

        $(document).on('keydown', function(event) {
            if (event.key == "Escape") {
                document.getElementById("isSkipped").value = 1;
                document.getElementById("myForm").submit();
            }
        });


        $(document).on('click', '.skip-btn', function (e) {
            e.stopPropagation();
            document.getElementById("isSkipped").value = 1;
            document.getElementById("myForm").submit();
        });


    </script>
@stop
