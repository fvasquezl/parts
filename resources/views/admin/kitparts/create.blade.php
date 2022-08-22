@extends('adminlte::page')

@section('title', 'Kit Show')

@section('content_header')
    <h1>Show Kit number {{$kit->KitID}}</h1>
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
                    <div class="card-header">{{ __('Check with parts exists in Kit')}}</div>

                    <div class="card-body">

                        <form method="POST" action="">
                            @csrf
                            @foreach($parts as $part)
                                <div class="row mb-3">


                                    <div class="col-md-6">
                                        <div class="form-check mt-1">
                                            <input class="form-check-input" type="checkbox" name="PartValue"
                                                   id="PartElement" {{ old('PartElement') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="PartValue">
                                                {{ $part->PartName}}
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

                            @endforeach

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
@stop

@section('css')

    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop


