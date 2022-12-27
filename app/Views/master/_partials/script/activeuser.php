<script>
const btn = document.querySelectorAll('.activeUser')
const bntApproveUser = document.querySelector('.approveUser');

for(let i=0; i<btn.length; i++) {
    btn[i].addEventListener('click',function(e,dt){
        let t1 = $('#datatable-buttons').DataTable();
        $('#datatable-buttons tbody').on( 'click', 'tr', function (e) {
            let idx = t1.row( this ).data()[1]
            let nama = t1.row( this ).data()[2]
            if(e.target.classList.contains('activeUser') || (e.target.classList.contains('fa-check'))) {
                const data = {id:idx}
                Swal.fire({
                    title: '<?=lang('Files.are_you_sure?')?>',
                    text: `<?=lang('Files.Approval_Activation_User')?> ${nama}`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '<?=lang('Files.Activate')?>',
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return fetch('<?=base_url()?>/users/activated',{
                            method:'POST',
                            mode: 'cors',
                            cache: 'no-cache',
                            creadentials: 'same-origin',
                            headers: {
                                'Content-Type':'application/json',
                                "X-Requested-With": "XMLHttpRequest"
                            },
                            body: JSON.stringify(data)
                        })
                        .then(response => {
                            if (!response.ok) {
                            throw new Error(response.statusText)
                            }
                            return response.json()
                        })
                        .catch(error => {
                            Swal.showValidationMessage(
                            `Request failed: ${error}`
                            )
                        })
                    },
                    allowOutsideClick: false,
                }).then((result) => {
                if (result.isConfirmed) {
                    
                    // .then((data) => {
                    //     // swal.showLoading();
                    //     if(data.success)
                        Swal.fire(
                        'Success!',
                        '<?=lang('Files.User_Activated')?>',
                        'success'    
                        ).then(function(){
                            location.reload()
                        })
                    // })
                    // .catch((err) => {
                    //     console.log("Erorr : ",err)
                    // })
                    //     Swal.fire(
                    //     'Deleted!',
                    //     'Your file has been deleted.',
                    //     'success'
                    //     )
                }
                })
            }
        })
    })
}

// $('#datatable-buttons tbody').on( 'click', 'tr', function (e) {
//     console.log(e)
//     let rowData = $('#datatable-buttons').DataTable().row( this ).data();
//     if(e.target.classList.contains('<?=$class?>') || e.target.classList.contains('fas fa-check')) {
//         let nama = rowData[2]
//         const title = document.querySelector('.confirmtext')
//         title.innerText = `Apakah Anda yakin untuk aktivasi akun ${nama} ini ?`
//     }
// })
</script>