let $brandSelected = ""
let $modelSelected = ""
let $partNumberSelected = ""

async function manageData(url, method, item) {
    try {
        const response = await fetch(`${url}`, {
            method: method,
            body: JSON.stringify({
                data: item
            }),
            headers: headers
        })
        const data = await response.json()
        return data
    } catch (err) {
        console.log(`Error: ${err}`)
    }
}

clearErrors=(myform)=>{
    const form = document.getElementById(myform);
    const formElements = Array.from(form.elements);
    formElements.forEach(element => {
        if(element.classList.contains('is-invalid')){
            element.classList.remove('is-invalid')
        }
    })
}

displayErrors = (err, myForm) => {
    const form = document.getElementById(myForm);
    const formElements = Array.from(form.elements);
    formElements.forEach(element => {
        let name = element.getAttribute("name")
        // if(element.classList.contains('is-invalid')){
        //     element.classList.remove('is-invalid')
        // }
        if(name in err){
            element.classList.add('is-invalid')
            const div= element.parentNode.closest('div')
            if (div.children.length === 2){
                div.children[1].firstElementChild.innerHTML=err[name][0]
            }else{
                div.children[2].firstElementChild.innerHTML=err[name][0]
            }
        }
    });
}

displayMsg=(msg) =>{
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: msg,
        showConfirmButton: false,
        timer: 1500
    })
}

clearForm = (input) => {
    if (input === 1) {
        document.getElementById('partNumber').innerHTML = `<option value="">PartNumber</option>`
        document.getElementById('manufacturer').value = ''
        $("#mitSku").val(0).trigger('change');
    } else if (input === 2) {
        document.getElementById('manufacturer').value = ''
        $("#mitSku").val(0).trigger('change');
    } else if (input === 3) {
        $("#mitSku").val(0).trigger('change');
    }

    document.getElementById('instructions').value = ''
    const selectedFile = document.querySelector(".custom-file-input")
    selectedFile.value = ""
    selectedFile.nextElementSibling.innerText = ""
    selectedFile.nextElementSibling.innerText = "Select a file"
}



/// Select Model from brand and reload grid


async function getModelFromBrand(e) {
    $brandSelected = e
    const models = await manageData('/oc/getModels', 'POST', $brandSelected)
    let modelOptions = `<option value="">Model</option>`;
    document.getElementById('model').innerHTML = ""
    models.forEach((e) => {
        modelOptions += `<option value="${e.model}">${e.model}</option>`
    })
    document.getElementById('model').innerHTML = modelOptions
    clearForm(1)
}

async function getPNFromModel(element) {
    $modelSelected = element
    const part_numbers = await manageData('/oc/getOCPartNumbers', 'POST', {
        'brand': $brandSelected,
        'model': $modelSelected
    })

    let parModelOptions = `<option value="">PartNumber</option>`;
    document.getElementById('partNumber').innerHTML = ""
    part_numbers.forEach((e) => {
        parModelOptions += `<option value="${e.id}">${e.part_number}</option>`
    })
    document.getElementById('partNumber').innerHTML = parModelOptions
    clearForm(2)

}

async function getManufacturerFromPartNumber(element) {
    $partNumberSelected = element
    const data = await manageData('/oc/getManufacturer', 'POST', {$partNumberSelected})

    document.getElementById('manufacturer').value = data['OC_Manufacturer']
    clearForm(3)
}

disableFormElements = (myForm) => {
    const form = document.getElementById(myForm);
    const formElements = Array.from(form.elements);
    formElements.forEach(element => {
      element.disabled = true
    });
}

enableFormElements = (myForm) => {
    const form = document.getElementById(myForm);
    const formElements = Array.from(form.elements);
    formElements.forEach(element => {
        element.disabled = false
    });
}


$('#accForm').on('submit', (e) => {
    e.preventDefault();
    const assemblyGuide = document.getElementById('assemblyGuide').files[0]
    let fd = new FormData(e.target);
    let method='POST'
    let url = "/oc/store"

    fd.append('assemblyGuide', assemblyGuide)
    // fd.append('_token', token);
    // console.log(OcConfigId)

    if(OcConfigId){

        $("updateAccForm").appendTo(inputs)
        console.log(inputs)
        fd = new FormData($("updateAccForm"));

        method='PUT'
        url = "/oc/update/"+OcConfigId
    }

    let request = $.ajax({
        url: url,
        method: method,
        data: fd,
        dataType: "json",
        processData: false,
        contentType: false
    });
    request.done(function (msg) {

        OcConfigId = msg.data.accessory_id
        clearErrors('accForm')


         disableFormElements('accForm')


        displayMsg(msg.message)
        $('#idOCConfig').val(OcConfigId)
        $('#btnOCAccessories').prop('disabled', false);
        $('#btnOCConfig').prop('disabled', true);


    });
    request.fail(function (jqXHR, textStatus) {
         clearErrors('accForm')
         displayErrors(jqXHR.responseJSON.errors, 'accForm')
    });
})



$("#enableUpdate").on('click',(e)=>{
    e.preventDefault();
    enableFormElements('accForm')
})




///////////////////////  Modal /////////////////////



async function getMPartName() {
    const partNames = await manageData('/oc/getAPartName', 'POST', 'notting')
    let parModelOptions = `<option value="">PartName</option>`;
    document.getElementById('aPartName').innerHTML = ""
    partNames.forEach((e) => {
        parModelOptions += `<option value="${e.PartName}">${e.PartName}</option>`
    })
    document.getElementById('aPartName').innerHTML = parModelOptions
}

async function getMitSKUFromPartName(partName) {

    const mitSkus = await manageData('/oc/getAMitSKu', 'POST', partName)

    let mitSkuOptions = `<option value="">MITSKU</option>`;
    document.getElementById('aMitSKU').innerHTML = ""
    mitSkus.forEach((e) => {
        mitSkuOptions += `<option value="${e.MITSKU}">${e.ProductSKU}</option>`
    })
    document.getElementById('aMitSKU').innerHTML = mitSkuOptions
}


$('#accDataForm').on('submit', (e) => {
    e.preventDefault();
    let fd = new FormData(e.target);

    let request = $.ajax({
        url: "/oc/accessories/store",
        method: 'post',
        data: fd,
        dataType: "json",
        processData: false,
        contentType: false
    });

    request.done(function (msg) {
        clearErrors('accDataForm')
        displayMsg(msg.message)
        $('#ocAccModal').modal('hide')
        $OCAccessoriesTable.ajax.reload()
    });
    request.fail(function (jqXHR, textStatus) {

        clearErrors('accDataForm')
        displayErrors(jqXHR.responseJSON.errors, 'accDataForm')
    });
})






