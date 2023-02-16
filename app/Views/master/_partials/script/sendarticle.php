<script>
   
    if ($.fn.dataTable.isDataTable('#datatable-buttons')) {
        console.log('ada')
        table = $('#datatable-buttons').DataTable();
    }
    $('#datatable-buttons tbody').on( 'click', 'tr', function (e) {
        let id = $('#datatable-buttons').DataTable().row(this).data();
        document.querySelector('input[name="idarticle"]').value = id[1]
    })
    
    const formCheck = document.querySelectorAll('input[name="formRadios"]')
    for (const radioButton of formCheck) {
        radioButton.addEventListener('change', showSelected);
    }

    function showSelected(e) {
        const showform = document.querySelector('.customemail')
        if (this.value=='custom') showform.style.display = "block";
        else showform.style.display = "none";
    }

    new Choices(document.getElementById("custom-email"),{delimiter:",",editItems:!0,duplicateItemsAllowed:!1,removeItemButton:!0,placeholderValue:"Masukkan email, dan tekan enter untuk memisahkan"});
    
    function savedata(){
        
        let list = document.querySelector('#custom-email')
        let id = document.querySelector('input[name="idarticle"]').value
        let radios = document.querySelectorAll('input[name="formRadios"]')
        let email;
        radios.forEach((e,i) => {
            if(e.checked==true && e.value=='custom') {
                email = list.value
            }

            if(e.checked==true && e.value == 'subs') {
                email = 'all';
            }
        })

        const data = {
            'id':id,
            'email': email
        }
        sendEmailSubs('<?=base_url()?>/<?=$route?>/sendsubs',{'data':data})
            .then(data => {
                if(data.code === 200) {
                    $('#<?=$id?>').modal('hide'); 
                    Swal.fire("Success!", data.message, data.status);
                }
                // table.ajax.reload()
                // Swal.clickConfirm()
                // setTimeout(() => location.reload(), 1500)
            })
    }

    async function sendEmailSubs(url='',data={}) {
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
</script>