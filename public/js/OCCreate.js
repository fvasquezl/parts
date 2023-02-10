
let $brandSelected=""
let $modelSelected =""
let $partNumberSelected=""
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

/// Select Model from brand and reload grid
document.getElementById('brand').addEventListener('change', async (e) => {
    $brandSelected= e.target.value
    const models = await manageData('/oc/getModels', 'POST', $brandSelected)
    let modelOptions = `<option value="0">Model</option>`;
    document.getElementById('model').innerHTML = ""
    models.forEach((e) => {
        modelOptions += `<option value="${e.model}">${e.model}</option>`
    })

    document.getElementById('model').innerHTML = modelOptions
    document.getElementById('partNumber').innerHTML = `<option value="0">PartNumber</option>`
    document.getElementById('manufacturer').value = ''

    $("#mitSku").val(0).trigger('change');
    // document.getElementById('mitSku').value = 0


})


async function getPNFromModel(element){
    $modelSelected = element
    const part_numbers = await manageData('/oc/getOCPartNumbers', 'POST', {'brand':$brandSelected,'model':$modelSelected})
    let parModelOptions = `<option value="0">PartNumber</option>`;
    document.getElementById('partNumber').innerHTML = ""
    part_numbers.forEach((e) => {
        parModelOptions += `<option value="${e.id}">${e.part_number}</option>`
    })
    document.getElementById('partNumber').innerHTML = parModelOptions
    document.getElementById('manufacturer').value = ''

    $("#mitSku").val(0).trigger('change');
    // document.getElementById('mitSku').value = 0
}

async function getMITSKUFromPartNumber(element){
    $partNumberSelected = element
    const data = await manageData('/oc/getManufacturer', 'POST', {$partNumberSelected})

    document.getElementById('manufacturer').value = data['manufacturer']
}




