@extends('adminlte::page')

@section('title', 'Sku Images')

@section('content_header')
    <h1>Images to Sku {{$sku->ref_sku}}</h1>
@stop

@section('content')
    <div class="container-fluid">
     @foreach($images as $image)

            <div class="card mb-3">
                <img class="card-img-top" src="{{$image->image_url}}" alt="{{$image->part_name}}">
                <div class="card-body">
                    <h1 class="card-text">{{$image->part_name}}</h1>
                </div>
            </div>

     @endforeach
    </div>

@endsection

@section('css')

@stop

@section('js')

@stop
