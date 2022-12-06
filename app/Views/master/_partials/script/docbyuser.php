<script>
   
    if ($.fn.dataTable.isDataTable('#datatable-buttons')) {
        console.log('ada')
        table = $('#datatable-buttons').DataTable();
    }
    // else {
    //      table = $('#datatable-buttons').DataTable();
    // }
    // console.log(table)
    const multiUserbyDoc = $('#search')
    multiUserbyDoc.multiselect({
        search: {
            left: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
            right: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
        },
        fireSearch: function(value) {
            return value.length > 3;
        }
    });

    const button1 = document.querySelectorAll('.<?=$class?>');
    // for(let i=0; i<button1.length; i++) {
        // button1[i].addEventListener('click', function(){
            // let t2 = $('#datatable-buttons').DataTable();
            $('#datatable-buttons tbody').on( 'click', 'tr', function (e) {
                let rowData = $('#datatable-buttons').DataTable().row( this ).data();
                // console.log(rowData[3])
                if(e.target.classList.contains('<?=$class?>') || e.target.classList.contains('dripicons-document')) {
                    // console.log(rowData[1])
                    const nmuser = document.querySelector('#namauser')
                    const selectDoc = document.querySelector('.fromdocbyuser')
                    const select2Doc = document.querySelector('.todocbyuser')
                    // const op1 =  new Option('Option Text1 ','Option Value 1');
                    // selectUser.add(op1,null)
                    // selectUser.add(op2,null)
                    $.ajax({
                        url: '<?=base_url()?>/users/docbyuser',
                        dataType:'json',
                        type:'POST',
                        data: {'username':rowData[2]},
                        success: function(data) {
                            if(data.status=='success') {
                                nmuser.innerHTML = data.nmuser 
                                $('.fromdocbyuser').find('option').remove()
                                $('.todocbyuser').find('option').remove()
                                if(data.data != null) {
                                    for(let i of data.data) {
                                        if(i.username != null) {
                                            let optTo =  new Option(i.dok_nosop,i.iddokumen);
                                            select2Doc.add(optTo,null)
                                        }
                                        if(i.username==null) {
                                            let optFrom = new Option(i.dok_nosop,i.iddokumen);
                                            selectDoc.add(optFrom,null)
                                        }
                                    }
                                }
                            }
                        },
                        cache:false,
                    });
                }
            })
        // })
    // }
    function savedata(){ 
        let obj = {}
        let values = Array.from(document.querySelector('#search_to').options).map(e => e.value);
        obj.iddokumen = values
        obj.nmuser = document.querySelector('#namauser').innerText
        // console.log(obj)
        postDocByUser('<?=base_url()?>/<?=$route?>/postDoc',{'data':obj})
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

    async function postDocByUser(url='',data={}) {
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