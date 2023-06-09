$(document).ready(function() {
    let table = $('#datatable-newTicket').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: 'helpdesk/list-newticket',
        type: 'POST'
      },
      columns: [
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
      ],
      rowCallback: function(row, data, index) {
        var childRow = table.row(index).child;
        if (childRow.isShown()) {
          childRow.hide();
          $(row).removeClass('shown');
        }
      },
      createdRow: function(row, data, index) {
        $(row).addClass('details-row');
        var detailHtml = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
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
          '<td><a href="public/assets/protected/helpdesk/'+data.attachment+'" target="_blank">' + data.attachment + '</a></td>' +
          '</tr>' +
          '<tr>' +
          '<td>Phone:</td>' +
          '<td>' + data.phone + '</td>' +
          '</tr>' +
          '</table>';
        table.row(index).child(detailHtml).show();
      },
      pageLength: 10,
      lengthMenu: [10, 25, 50, 100] // optional: specify the number of rows per page
    });
    // Handle click event on the name column to toggle detail row
    $('#datatable-newTicket tbody').on('click', 'td.details-control', function() {
        console.log('this')
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        if (row.child.isShown()) {
        row.child.hide();
        tr.removeClass('shown');
        } else {
        row.child.show();
        tr.addClass('shown');
        }
    });
  });
  