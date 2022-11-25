<script>
    // const userbydoc = document.querySelector('#exampleModal')
    // new bootstrap.Modal(document.getElementById('exampleModal'))
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
    for(let i=0; i<button1.length; i++) {
        button1[i].addEventListener('click', function(){
            let t2 = $('#datatable-buttons').DataTable();
            $('#datatable-buttons tbody').on( 'click', 'tr', function (e) {
                if(e.target.classList.contains('<?=$class?>') || e.target.classList.contains('mdi-file-compare')) {
                    console.log('tes')
                    const selectUser = document.querySelector('.fromuserbydoc')
                    const op1 =  new Option('Option Text1 ','Option Value 1');
                    const op2 =  new Option('Option Text2 ','Option Value 2');
                    selectUser.add(op1,null)
                    selectUser.add(op2,null)
                }
            })
        })
    }
</script>