<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laravel 8 Generate PDF From View</title>
    <style>
        .myTable{width:100%;}
        .myTable td{
            text-align:center;
        }
        .myTable th{
            text-align:center;
        }
        header
        .header h1{
           text-align:center;
        }


    </style>
</head>
<body>
<div style="margin-bottom: 10px">
    <div style="float: left; width: 50%;font-weight: bold; font-size: 20px">Order PickList All</div>
    <div style="margin-left: 50%; width: 50%; font-weight: bold; font-size: 20px; text-align: right">{{$date}}</div>
</div>

    <table class="myTable">
        <thead>
            <tr>
                <th>SKU</th>
                <th>ShelfName</th>
                <th>BoxName</th>
                <th>QtyInBox</th>
                <th>KitLCN</th>
                <th>QP</th>
            </tr>
        </thead>
        <tbody>

        @foreach($data as $item)
            <tr>
                <td> {{$item->SKU}}</td>
                <td> {{$item->ShelfName}}</td>
                <td> {{$item->BoxName}}</td>
                <td> {{$item->QtyInBox}}</td>
                <td> {{$item->KitLCN}}</td>
                <td> {{$item->QP}}</td>
            </tr>

        @endforeach
        </tbody>
    </table>

</body>
</html>
