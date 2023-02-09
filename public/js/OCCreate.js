

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
    const models = await manageData('/oc/getModels', 'POST', e.target.value)
    let modelOptions = `<option value="0">Model</option>`;
    document.getElementById('model').innerHTML = ""
    models.forEach((e) => {
        modelOptions += `<option value="${e.model}">${e.model}</option>`
    })
    document.getElementById('model').innerHTML = modelOptions

})

document.getElementById('model').addEventListener('change',  (e) => {
    $openCells.ajax.reload()
})


