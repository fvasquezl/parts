@extends('adminlte::page')

@section('title', 'AddInv')

@section('content_header')
    <h1>Add Inv</h1>
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
                        {{ __('Add Inv ')}}
                    </h3>
                    <div class="card-tools">
                    </div>
                </div>

                <div class="card-body" id="mainForm">
                    <div class="row mb-3">
                        <div class="col-md-6">

                                <label for="el" class="col-form-label text-md-end">{{ __('Scan') }}</label>
                                <input id="el" type="text" class="form-control" name="el" autofocus>

                        </div>

                        <div class="col-md-6 mt-5">
                            <p id="message"></p>
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
    // BOX10022
    // MTC7ST0799-KIT
    // MTBACT0284-KIT
    <script>
        let aux='';
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let headers = {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
        }

        async function postData(box,kits){

            const response = await fetch('/add-inv',{
                method: 'POST',
                body: JSON.stringify({box:box.id,kits:kits}),
                headers:headers
            })
            const data = await response.json()
            console.log(data)

        }



        async function getData(value){
            const response = await fetch('/validate/box-kits',{
                method: 'POST',
                body: JSON.stringify({data:value}),
                headers:headers
            })
            const data = await response.json()
            console.log(data)
            const {id,type,created_at} = data
            if(!id){
                document.getElementById('message').innerHTML = 'Check The Information'
            }else {
                if(i===0 && type !== 'box'){
                    document.getElementById('message').innerHTML = 'You need to add a box first'
                }else {
                    if (i === 1 && type === 'box') {
                        document.getElementById('message').innerHTML = 'Need add kits'
                    }else{
                        if (i >= 2 && id === box.id && created_at === box.created_at && type === 'box') {
                            document.getElementById('message').innerHTML = 'Submited'
                            await postData(box,kits)
                            box.id=''
                            box.created_at =''
                            kits =[];
                        }else{
                            if (i === 0 && type === 'box') {
                                box.id = id
                                box.created_at = created_at
                                document.getElementById('message').innerHTML = 'Box ' + box.id
                                i++
                            } else {
                                kits[j] = Object.create(kit)
                                kits[j].id = id
                                kits[j].created_at = created_at
                                document.getElementById('message').innerHTML = 'Kit ' + kits[j].id
                                i++
                                j++
                            }
                        }
                    }
                }
            }
            document.getElementById('el').value = ''
            document.getElementById('el').focus()
        }


        let box = {
            id:null,
            created_at:null
        };
        const kit = {
            id:null,
            created_at:null
        };
        let kits =[]
        let i=0
        let j=0


        document.querySelector('input[name="el"]').addEventListener("keyup", (e) => {

            let myValue = e.target.value;
            if (e.key === "Enter") {

                getKitData()
                async function getKitData() {
                    await getData(myValue)
                }


            }

        });





    </script>
@stop


