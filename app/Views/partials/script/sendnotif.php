<script>
    $('table.Notification').on('click','.sendNotif', function(){
        let tr = $(this).closest('tr')
        let row = $('table.Notification').DataTable().row(tr)
        let id = row.data()[1]
        const url = 'notification/send'
        Swal.fire({
            title:'Are you sure?',
            text:'Apakah anda yakin akan kirim notifikasi ini?',
            icon:'warning',
            showCancelButton:true,
            confirmButtonText:'Yes, send it!'
        })
        .then(result => {
            if(result.isConfirmed) {
                fetch(url,{
                    method:'POST',
                    mode:'cors',
                    cache:'no-cache',
                    headers: {
                        'Content-Type':'application/json',
                        "X-Requested-With":"XMLHttpRequest"
                    },
                    body:JSON.stringify({id:id})
                })
                .then(resp => resp.json())
                .then(data => {
                    console.log(data)
                })
            }
        })
        // .then(resp => {
        //     console.log(resp)
        // })
    })
</script>