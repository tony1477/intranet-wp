<script>
    // const userbydoc = document.querySelector('#exampleModal')
    // new bootstrap.Modal(document.getElementById('exampleModal'))
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
                if(e.target.classList.contains('<?=$class?>') || e.target.classList.contains('mdi-file-compare')) {
                    // console.log(rowData[1])
                    const selectUser = document.querySelector('.fromuserbydoc')
                    const select2User = document.querySelector('.touserbydoc')
                    // const op1 =  new Option('Option Text1 ','Option Value 1');
                    // selectUser.add(op1,null)
                    // selectUser.add(op2,null)
                    $.ajax({
                        url: '<?=base_url()?>/dokumen-sop/userbydoc',
                        dataType:'json',
                        type:'POST',
                        data: {'dok_nosop':rowData[3]},
                        success: function(data) {
                            if(data.status=='success') {
                                $('.fromuserbydoc').find('option').remove()
                                $('.touserbydoc').find('option').remove()
                                if(data.data != null) {
                                    for(let i of data.data) {
                                        if(i.dok_nosop != null) {
                                            let optTo =  new Option(i.username,i.id);
                                            select2User.add(optTo,null)
                                        }
                                        if(i.dok_nosop==null) {
                                            let optFrom = new Option(i.username,i.id);
                                            selectUser.add(optFrom,null)
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
        obj.usersid = values
        obj.dok_nosop = 'AA'
        console.log(obj)
    }
</script>