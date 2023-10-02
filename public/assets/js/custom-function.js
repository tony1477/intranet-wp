async function deleteData(url='',data={}) {
    const response = await fetch(url, {
        method:'DELETE',
        mode:'cors',
        cache:'no-cache',
        creadentials:'same-origin',
        headers: {
            'Content-Type':'application/json',
            "X-Requested-With": "XMLHttpRequest"
        },
        body: JSON.stringify(data)
    })        
    return response.json()
}

async function postData(url='',data={}) {
    const response = await fetch(url,{
        method:'POST',
        mode:'cors',
        cache:'no-cache',
        creadentials:'same-origin',
        headers: {
            'Content-Type':'application/json',
            "X-Requested-With": "XMLHttpRequest"
        },
        body: JSON.stringify(data)
    })

    return response.json()
}

async function putData(url='',data={})
{
    const response = await fetch(url,{
        method:'PUT',
        mode:'cors',
        cache:'no-cache',
        creadentials:'same-origin',
        headers: {
            'Content-Type':'application/json',
            "X-Requested-With": "XMLHttpRequest"
        },
        body: JSON.stringify(data)
    })

    return response.json()
}

async function patchData(url='',data={})
{
    const response = await fetch(url,{
        method:'PATCH',
        mode:'cors',
        cache:'no-cache',
        creadentials:'same-origin',
        headers: {
            'Content-Type':'application/json',
            "X-Requested-With": "XMLHttpRequest"
        },
        body: JSON.stringify(data)
    })

    return response.json()
}

async function uploadFile(url='',data={}) {
    const response = await fetch(url, {
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache',
        creadentials: 'same-origin',
        body: data
    })

    return response.json()
}

const saveButton = document.querySelector('.save');
const updateButton = document.querySelector('.update');

saveButton.addEventListener('click', function(e) {
    e.preventDefault()
    const data = getFormData()

    postData(url,{'data':data})
    .then(data => {
        if(data.status=='success') {
            closeModal();
            Swal.fire("Success!", data.message, data.status)
            .then(function() {
                location.reload()
            })
        }
    })
})

updateButton.addEventListener('click', function(e) {
    e.preventDefault()
    const data = getFormData()

    putData(url+'/'+data.id,{'data':data})
    .then(data => {
        if(data.status=='success') {
            closeModal();
            Swal.fire("Success!", data.message, data.status)
            .then(function() {
                location.reload()
            })
        }
    })
})