// $(document).ready(function() {
//     // let table1 = $('#datatable-NewTicket').DataTable({
//     //   processing: true,
//     //   serverSide: true,
//     //   ajax: {
//     //     url: 'helpdesk/list-ticket/new',
//     //     type: 'POST'
//     //   },
//     //   columns: [
//     //     { data: 'tanggal' },
//     //     { data: 'nama' },
//     //     { data: 'request' },
//     //     { data: 'atasan' },
//     //     { 
//     //         data: 'detail',
//     //         className: 'details-control',
//     //         orderable: false,
//     //         defaultContent: ''
//     //     },
//     //     { data: 'action' }
//     //   ],
//     //   rowCallback: function(row, data, index) {
//     //     const childRow = table1.row(index).child;
//     //     if (childRow.isShown()) {
//     //       childRow.hide();
//     //       $(row).removeClass('shown');
//     //     }
//     //   },
//     //   createdRow: function(row, data, index) {
//     //     $(row).addClass('details-row');
//     //     const detailHtml = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
//     //       '<tr>' +
//     //       '<td>Alasan Permintaan:</td>' +
//     //       '<td>' + data.reason + '</td>' +
//     //       '</tr>' +
//     //       '<tr>' +
//     //       '<td>Kategori Bantuan:</td>' +
//     //       '<td>' + data.level + '</td>' +
//     //       '</tr>' +
//     //       '<tr>' +
//     //       '<td>Lampiran :</td>' +
//     //       '<td><a href="public/assets/protected/helpdesk/'+data.attachment+'" target="_blank">' + data.attachment + '</a></td>' +
//     //       '</tr>' +
//     //       '<tr>' +
//     //       '<td>Phone:</td>' +
//     //       '<td>' + data.phone + '</td>' +
//     //       '</tr>' +
//     //       '</table>';
//     //     table1.row(index).child(detailHtml).show();
//     //   },
//     //   pageLength: 10,
//     //   lengthMenu: [10, 25, 50, 100] // optional: specify the number of rows per page
//     // });

//     // Handle click event on the name column to toggle detail row
//     $('#datatable-newTicket tbody').on('click', 'td.details-control', function() {
//         const tr = $(this).closest('tr');
//         const row = table1.row(tr);
//         if (row.child.isShown()) {
//         row.child.hide();
//         tr.removeClass('shown');
//         } else {
//         row.child.show();
//         tr.addClass('shown');
//         }
//     });
//   });

  const getDtTable = (id) => {
    const type = id.slice(6)
    let str = 'new'
    switch(type) {
      case 'WaitingHead':
        str = 'waiting'
        break;

      case 'OnProgress':
        str = 'onprogress'
        break;

      case 'Success':
        str = 'close'
        break;

      case 'Cancel':
        str = 'cancel'
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
      { data: 'tanggal' },
      { data: 'nama' },
      { data: 'request' },
      { data: 'atasan' },
      { 
        data: 'detail',
        className: 'details-control',
        orderable: false,
        defaultContent: ''
      },
      { data: 'action' }
    ]
    if (accordionId === 'WaitingHead' || accordionId === 'OnProgress') {
      // Tabel 'table-new' tanpa kolom 'Status'
      columns.splice(-1, 0, { data: 'status' });
    }
    else {
      columns.splice(-1, 0, { data: null, visible:false});
    }
    // else if (accordionId === 'table-progress') {
    //   // Tabel 'table-progress' dengan kolom 'Status'
    //   columns.splice(3, 0, { data: 'status' });
    // }
    if ($.fn.DataTable.isDataTable('#datatable-'+accordionId)) {
      dataTableInstances[accordionId].destroy();
    }
    dataTableInstances[accordionId] = $('#datatable-'+accordionId).DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: 'helpdesk/list-ticket/' + url,
        type: 'POST'
      },
      columns: columns,
      rowCallback: function(row, data, index) {
        const childRow = dataTableInstances[accordionId].row(index).child;
        if (childRow.isShown()) {
          childRow.hide();
          $(row).removeClass('shown');
        }
        if(data.isfeedback==1) {
          $(row).addClass('bg-info text-white');
        }
        if(data.isconfirmation==1) {
          $(row).addClass('bg-primary text-white');
        }
      },
      createdRow: function(row, data, index) {
        $(row).addClass('details-row');
        const detailHtml = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
          '<tr>' +
          '<td>Alasan Permintaan:</td>' +
          '<td>' + data.reason + '</td>' +
          '</tr>' +
          '<tr>' +
          '<td>Kategori Bantuan:</td>' +
          '<td>' + data.level + '</td>' +
          '</tr>' +
          '<tr>' +
          '<td>Lampiran :</td>' +
          '<td><a href="public/assets/protected/helpdesk/' + data.attachment + '" target="_blank">' + data.attachment + '</a></td>' +
          '</tr>' +
          '<tr>' +
          '<td>Phone:</td>' +
          '<td>' + data.phone + '</td>' +
          '</tr>' +
          '</table>';
        dataTableInstances[accordionId].row(index).child(detailHtml).show();
      },
      pageLength: 10,
      lengthMenu: [10, 25, 50, 100]
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

  $('#datatable-' + accordionId + ' tbody').on('click', 'button.edit-button', function() {
    const rowData = dataTableInstances[accordionId].row($(this).closest('tr')).data();
    // Mengirim data ke halaman edit menggunakan fetch
    fetch('edit-helpdesk', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        cache:'no-cache',
        body: JSON.stringify({ id: rowData.id})
    })
    .then(response => response.json())
    .then(data => {
      console.log(data)
    })
    .catch(error => {
        console.error('Error:', error);
    });
  });

  $('#datatable-' + accordionId + ' tbody').on('click', 'button.approve-button', function() {
    const rowData = dataTableInstances[accordionId].row($(this).closest('tr')).data();
        
    Swal.fire({
      title: 'Apakah Anda yakin?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Yes',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.isConfirmed) {
        // Mengirim data ke halaman approve menggunakan fetch
        fetch('approve-helpdesk', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          cache: 'no-cache',
          body: JSON.stringify({ id: rowData.id})
        })
        .then(response => response.json())
        .then(data => {
          if(data.status==='success') {
            Swal.fire(
              'Success',
              data.message,
              'success'
            ).
            then((result) => {
              if (result.isConfirmed) location.href='list-helpdesk'
            })
          }
          else {
            Swal.fire(
              'Fail',
              data.message,
              'warning'
            )
          }
        })
        .catch(error => {
            console.error('Error:', error);
        });
      }
    });
  });
  }

  
  