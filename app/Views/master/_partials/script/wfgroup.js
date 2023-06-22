<script>
$('#wfgroup_wfname_dttable').on('keyup', function() {
    let table = $('#datatable-buttons').DataTable();
    table.column(2).search(this.value).draw();
});

$('#wfgroup_groupname_dttable').on('keyup', function() {
    let table = $('#datatable-buttons').DataTable();
    table.column(3).search(this.value).draw();
});
</script>