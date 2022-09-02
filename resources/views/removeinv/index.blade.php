@extends('adminlte::page')

@section('title', 'AddInv')

@section('content_header')
    <h1>Remove Inventory</h1>
@stop

@section('content')

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        </div>
    @endif

    @if (session('danger'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('danger') }}
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        </div>
    @endif


    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">
                <div class="card-header ">
                    <h3 class="card-title mt-1">
                        {{ __('Remove Inventory')}}
                    </h3>
                    <div class="card-tools">
                        <button class="btn btn-info btn-sm" id="reset">Reset</button>
                    </div>
                </div>

                <div class="card-body" id="mainForm">
                    <div class="row mb-3">
                        <div class="col-md-6">

                            <label for="el" class="col-form-label text-md-end">{{ __('Scan Kit') }}</label>
                            <input id="el" type="text" class="form-control" name="el" autofocus>
                            <div class="mt-2">
                                <ul id="message"></ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop

@section('css')

@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let aux='';
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let headers = {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
        }

        async function deleteData(url){
            try {
                const response = await fetch(`${url}`,{
                    method: 'DELETE',
                    headers:headers
                })

                const data = await response.json()
                return data
            }
            catch(err) {
                console.log(err);
                addElementList(`Error: ${err}`)
            }
        }


        async function getData(value,url){
            try {
                const response = await fetch(`${url}`,{
                    method: 'POST',
                    body: JSON.stringify({data:value}),
                    headers:headers
                })
                const data = await response.json()
                return data

            }
            catch(err) {
                console.log(err);
                addElementList(`Error: ${err}`)
            }
        }


        let kit = {};

        document.querySelector('input[name="el"]').addEventListener("keyup", (e) => {
            // MTC8CT1016-KIT
            let myValue = e.target.value;

            if (e.key === "Enter") {

                getKitData()
                async function getKitData() {
                    await getData(myValue,'/validate/kit').then(
                        data => {
                            if (!data.errors) {
                                kit = {'id': data.id, 'name': data.name}
                                addElementList(`Kit: ${data.name}`)
                            }else{
                                addElementList(`Error: ${data.message}`)
                            }
                        }
                    );
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.value) {
                            deleteKit()
                            async function deleteKit() {
                            await deleteData(`/kits/${kit.id}`).then(
                                    data => {
                                        if (!data.errors){
                                            Swal.fire(
                                                'Deleted!',
                                                data.message,
                                                'success'
                                            );
                                        }else {
                                            Swal.fire('Failed!', `${data.errors}`, "warning");
                                        }
                                    }
                                )
                            }
                        }
                    });

                }
            }
        });


        function addElementList(content) {
            const ul = document.getElementById("message");
            const li = document.createElement("li");
            li.appendChild(document.createTextNode(content));
            ul.appendChild(li);
            document.getElementById('el').value = ''
            document.getElementById('el').focus()
        }


        document.getElementById('reset').addEventListener("click", (e) => {
            location.reload();
        });


    </script>
@stop



