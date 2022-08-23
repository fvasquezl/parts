<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>How to Generate QR Code in Laravel 8</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" rel="stylesheet"/>

    <style>
        body {
            width: 2in;
            /*margin: 1in .1in;*/
        }

        .label {
            /* Avery 5160 labels -- CSS and HTML by MM at Boulder Information Services */
            width: 2.025in; /* plus .6 inches from padding */
            height: 1in; /* plus .125 inches from padding */
            /*padding: .125in .3in 0;*/
            margin-right: 0in; /* the gutter */

            float: left;
            /*font-size: small;*/
            /*font-size: xx-small*/

            /*text-align: center;*/
            /*overflow: hidden;*/

            /*outline: 1px dotted; !* outline doesn't occupy space like border does *!*/
        }

        .page-break {
            clear: left;
            display: block;
            page-break-after: always;
        }
    </style>
</head>

<body onload="window.print()">

<div class="label">
    @foreach ($label1 as $label)
        <div class="font-mono float-left"><i class="fas fa-check-square"></i>&nbsp;{{$label}}</div>
    @endforeach
</div>

@if ($label2)
    <div class="page-break"></div>
    <div class="label">
        @foreach ($label2 as $label)
            <div class="font-mono float-left"><i class="fas fa-check-square"></i>&nbsp;{{$label}}</div>
        @endforeach
    </div>
@endif
<div class="page-break"></div>

<div class="label">
    <span class="float-left">{{$kitlcn}}</span>
    <span class="float-left"> {!! QrCode::size(40)->generate($kitlcn);!!}</span>
</div>

</body>
</html>
