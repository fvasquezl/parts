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


displayErrors = (err) => {
     let errors = ""
    // for (const property in err) {
    //     errors += `<b>${property}</b>: ${err[property]}<br>`
    // }
    Object.keys(err).forEach(key=>{
        errors += `${key}:${err[key][0]}<br>`
    })

    Swal.fire({
        position: 'top-end',
        icon: 'error',
        title: 'Oops...',
        html: errors,
        showConfirmButton: false,
        timer: 2000
    })
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
document.getElementById('brand').addEventListener('change', async (e) => {
    $brandSelected = e.target.value
    const models = await manageData('/oc/getModels', 'POST', $brandSelected)
    let modelOptions = `<option value="">Model</option>`;
    document.getElementById('model').innerHTML = ""
    models.forEach((e) => {
        modelOptions += `<option value="${e.model}">${e.model}</option>`
    })
    document.getElementById('model').innerHTML = modelOptions
    clearForm(1)
})


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


$('#accForm').on('submit', (e) => {
    e.preventDefault();
    const assemblyGuide = document.getElementById('assemblyGuide').files[0]
    let fd = new FormData(e.target);
    fd.append('assemblyGuide', assemblyGuide)
    fd.append('_token', token);

    let request = $.ajax({
        url: "/oc/store",
        method: 'post',
        data: fd,
        dataType: "json",
        processData: false,
        contentType: false
    });
    request.done(function (msg) {
        console.log(msg)
        displayMsg(msg)
    });
    request.fail(function (jqXHR, textStatus) {
         displayErrors(jqXHR.responseJSON.errors)
    });
})








