<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>How to Generate QR Code in Laravel 8</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>

<body onload="window.print()">

<div class="visible-print text-center">
    {!! QrCode::size(100)->generate($lcn); !!}
</div>
<div class="text-center">{{$lcn}}</div>

</body>
</html>
