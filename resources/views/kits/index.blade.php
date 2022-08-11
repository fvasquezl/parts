@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Kits</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Kits List</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('kits.create') }}"> Create New Kit</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($kits as $kit)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $kit->name }}</td>
                <td>{{ $kit->detail }}</td>
                <td>
                    <form action="{{ route('kits.destroy',$kit->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('kits.show',$kit->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('kits.edit',$kit->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $kits->links() !!}
@endsection




