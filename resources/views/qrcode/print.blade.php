<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>How to Generate QR Code in Laravel 8</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <style>
        body,html {
            height: 100%;
        }
    </style>
</head>

<body onload="window.print()">

    <div class="d-flex flex-column min-vh-100  align-items-center mt-1">
        {!! QrCode::size(50)->generate($lcn);!!}
        <div>{{$lcn}}</div>
    </div>

</body>
</html>
