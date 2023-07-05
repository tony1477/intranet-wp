  const getDtTable = (id) => {
    const type = id.slice(6)
    let str = 'open'
    switch(type) {
      case 'CloseTicket':
        str = 'close'
        break;        
    }
    return showDtTable(type,str)
  }

  let dataTableInstances = {};
  const showDtTable = (accordionId,url) => {
    const columns = [
      { data: 'null', render: function(data,type,row,meta){
        return meta.row+1;
      }},
      // { data: 'id', render:'display', visible:false},
      { data: 'ticketno' },
      { data: 'ticketdate' },
      { data: 'category' },
      { 
        data: 'urgencytype',
        defaultContent:'-'
      },
      { data: 'userrequest' },
      { data: 'status',},
      { 
        data: '',
        orderable: false,
        searchable:false,
        render: function(data,type,row) {
          return '<a href="resp-helpdesk/detail/'+row.id+'"><i class="fas fa-info btn btn-secondary rounded-circle"></i> Detail</a>'
        }
      },
    ]
    if(accordionId==='CloseTicket') {
      columns.splice(3,0,{data:'ticketclose'});
    }

    if ($.fn.DataTable.isDataTable('#datatable-'+accordionId)) {
      dataTableInstances[accordionId].destroy();
    }
    dataTableInstances[accordionId] = $('#datatable-'+accordionId).DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: 'list-resp/' + url,
        type: 'POST'
      },
      columns: columns,
      rowCallback: function(row, data, index) {
        // console.log(data.canedit)
        // const childRow = dataTableInstances[accordionId].row(index).child;
        // if (childRow.isShown()) {
        //   childRow.hide();
        //   $(row).removeClass('shown');
        // }
        // if(data.isrevisied==1) {
        //   $(row).addClass('bg-warning text-white');
        // }
        // if(data.isfeedback==1) {
        //   $(row).addClass('bg-info text-white');
        // }
        // if(data.isconfirmation==1) {
        //   $(row).addClass('bg-primary text-white');
        // }
      },
      pageLength: 10,
      lengthMenu: [10, 25, 50, 100],
    });

    // $('#datatable-'+accordionId+' tbody').on('click', 'td.details-control', 
    $(document).off('click','#datatable-'+accordionId+' tbody td.details-control').on('click','#datatable-'+accordionId+' tbody td.details-control',
    function() {      
      const table = $(this).closest('table').DataTable();
      const tr = $(this).closest('tr');
      const row = table.row(tr);
      if (row.child.isShown()) {
        row.child.hide();
        tr.removeClass('shown');
      } else {
        row.child.show();
        tr.addClass('shown');
      }
    });
  }