<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>How to Generate QR Code in Laravel 8</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" rel="stylesheet"/>

    <style>
        body,html {
            height: 100%;
        }
    </style>
</head>

<body onload="window.print()">

@foreach ($parts as $part)
    <span class="font-mono float-left"><i class="fas fa-check-square"></i>{{$part->PartName}}</span>
@endforeach
<br/>
    <div>
        <span class="float-left">{{$kitlcn}}</span>
        <span class="float-left"> {!! QrCode::size(40)->generate($kitlcn);!!}</span>
    </div>

</body>
</html>
