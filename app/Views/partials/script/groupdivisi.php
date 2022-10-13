<script>
    $(document).ready(function() {
        $('#datatable').DataTable();

        //Buttons examples
        var table = $('#datatable-buttons').DataTable({
            lengthChange: false,
            buttons: [
            {
                text: '<?= lang('Files.Add')?>',
                action: function ( e, dt, node, config ) {
                    let str = document.querySelector('#static<?=$menuname?>Label')
                    str.innerHTML = '<?=  lang('Files.Add'),' ',lang('Files.Divisi')  ?>'
                    var_dump()
                    document.getElementById("id").value = '';
                    document.getElementById("kode").value = '';
                    document.getElementById("namadivisi").value = '';
                    $('#editDivisi').modal('show')
                }
            },
            'excel', 'pdf', 'colvis',
            ]
        });

        // var column = table.column('ID'.attr('data-column'));
        table.buttons().container()
            .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

        // table.columns(1).visible(false)
        $(".dataTables_length select").addClass('form-select form-select-sm');
    })

    // const table = $('#datatable').DataTable()
    async function deleteData(url='',data={}) {
        const response = await fetch(url, {
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
    const editButton = document.querySelectorAll(".edit<?=$menuname?>");
    const deleteButton = document.querySelectorAll('.delete<?=$menuname?>')
    const saveButton = document.querySelector('.save');
    const selected = document.querySelectorAll("input#kode");
    //const $select = document.querySelector('#idgroup')
    //const $option = Array.from($select.options)

    for (let i = 0; i < editButton.length; i++) {
        // console.log(editButton[i])
        editButton[i].addEventListener("click", function() {
            
            let id = document.querySelector('table.<?=$menuname?>').rows.item(i+1).cells.item(1).innerHTML
            let group = document.querySelector('table.<?=$menuname?>').rows.item(i+1).cells.item(2).innerHTML
            let kode = document.querySelector('table.<?=$menuname?>').rows.item(i+1).cells.item(3).innerHTML
            let nama = document.querySelector('table.<?=$menuname?>').rows.item(i+1).cells.item(4).innerHTML
            // console.log(group)
            //let selectedOpt = $option.find(item => item.text == group)
            //selectedOpt.selected = true

            let str = document.querySelector('#static<?=$menuname?>Label')
                    // console.log(str.html)
            str.innerHTML = '<?=lang('Files.Edit'),' ',lang('Files.Divisi')?>'
            document.getElementById("id").value = id;
            document.getElementById("kode").value = kode;
            document.getElementById("namadivisi").value = nama;
        });
    }

    for(let i=0; i< deleteButton.length; i++) {
        deleteButton[i].addEventListener("click", function() {
        let kode = document.querySelector('table.<?=$menuname?>').rows.item(i+1).cells.item(2).innerHTML
        Swal.fire({
            title: "<?=lang('Files.Deleted_Confirm')?>",
            text: "",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#2ab57d",
            cancelButtonColor: "#fd625e",
            confirmButtonText: "<?=lang('Files.Yes')?>"
        }).then(function (result) {
            const reqbody = {'kode':kode}
            if (result.value) {
                deleteData('<?=base_url()?>/divisi/delete', {'kode':kode})
                .then(data => {
                    // console.log(data)
                    if(data.code === 200) 
                    Swal.fire("Deleted!", data.message, data.status)
                    // table.ajax.reload()
                    // Swal.clickConfirm()
                    setTimeout(() => location.reload(), 1500)
                })
                .catch(err => {
                    console.log('Error',err)
                })
                // console.log(table)
            }
        });
        });
    }

    saveButton.addEventListener("click", function(){
        // console.log('click')
        const id =  document.forms["<?=$menuname?>"]["id"].value;
        const kode =  document.forms["<?=$menuname?>"]["kode"].value;
        const nama =  document.forms["<?=$menuname?>"]["namadivisi"].value;
        const data = [id, kode, nama]
        postData('<?=base_url()?>/divisi/post',{'data':data})
        .then(data => {
            // console.log(data)
            if(data.code === 200) {
                $('#editDivisi').modal('hide'); 
                Swal.fire("Success!", data.message, data.status);
            }
                    // table.ajax.reload()
                    // Swal.clickConfirm()
            //setTimeout(() => location.reload(), 1500)
        })
    })
</script>