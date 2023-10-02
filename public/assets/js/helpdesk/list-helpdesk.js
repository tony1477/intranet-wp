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
    ]
    switch(accordionId) {
      case 'NewTicket':
        columns.push({ data: 'action', title: 'Aksi'});
        break;

      case 'WaitingHead':
      case 'OnProgress':
        columns.push({ data: 'status', title: 'Status' });
        columns.push({ data: 'action', title: 'Aksi' });
        columns.splice(1,0,{ data: 'tiketno'});
        break;

      case 'Success':
      case 'Cancel':
        columns.splice(1,0,{ data: 'tiketno'});
        console.log('open')
        break;

      default :
        columns.splice(-1, 0, { data: null, visible:false});
        break;
    }

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
        // console.log(data.canedit)
        const childRow = dataTableInstances[accordionId].row(index).child;
        if (childRow.isShown()) {
          childRow.hide();
          $(row).removeClass('shown');
        }
        if(data.isrevisied==1) {
          $(row).addClass('bg-warning text-white');
        }
        if(data.isfeedback==1) {
          $(row).addClass('bg-primary text-white');
        }
        if(data.isconfirmation==1) {
          $(row).addClass('bg-info text-white');
        }
        if(data.iscancel==1) {
          $(row).addClass('bg-danger text-white');
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
          '<tr '+ (data.responsetext != null ? 'class = "bg-warning"' : '')+'>' +
          '<td>Reason:</td>' +
          '<td>' + (data.responsetext!=null ? data.responsetext : '') + '</td>' +
          '</tr>' +
          '</table>';
        dataTableInstances[accordionId].row(index).child(detailHtml).show();
      },
      pageLength: 10,
      lengthMenu: [10, 25, 50, 100],
      // columnDefs: [
      //   {
      //     targets: -1, // Kolom terakhir dalam array columns
      //     visible: 
      //     searchable: false,
      //     orderable: false
      //   }
      // ]
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

    $(document).off('click','#datatable-'+accordionId+' tbody button.edit-button').on('click','#datatable-' + accordionId + ' tbody button.edit-button', function() {
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
        title: 'Apakah Anda yakin melanjutkan proses ini?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
          // Mengirim data ke halaman approve menggunakan fetch
          const Toast = Swal.fire({
            icon:'info',
            text:'Sedang dalam process! Tunggu hingga selesai',
            title:'Info',
            allowEscapeKey:false,
            allowOutsideClick:false
          })
          Toast.disableButtons()

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

    $('#datatable-' + accordionId + ' tbody').on('click', 'button.reject-button', function() {
      const rowData = dataTableInstances[accordionId].row($(this).closest('tr')).data();
          
      Swal.fire({
        title: 'Apakah Anda yakin perbaikan / reject permohonan ini?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: 'Reason for Reject',
            html: `
              <textarea class="form-control" id="reasonReject" placeholder="Alasan di reject , minta di revisi (optional)"></textarea>
            `,
            showCancelButton: true,
            confirmButtonText: 'Submit',
            cancelButtonText: 'Batal'
          }).then((result) => {
            // Jika tombol 'Submit' diklik
            if (result.isConfirmed) {
              // Mendapatkan nilai inputan dari form
              const inputData = document.getElementById('reasonReject').value;

              const Toast = Swal.fire({
                icon:'info',
                text:'Sedang dalam process! Tunggu hingga selesai',
                title:'Info',
                allowEscapeKey:false,
                allowOutsideClick:false
              })
              Toast.disableButtons()
              // Mengirim data ke halaman approve menggunakan fetch
              fetch('reject-helpdesk', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json'
                },
                cache: 'no-cache',
                body: JSON.stringify({ id: rowData.id, reason:inputData})
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
          })
        }
      });
    });

    $('#datatable-' + accordionId + ' tbody').on('click', 'button.feedback-button', function() {
      const rowData = dataTableInstances[accordionId].row($(this).closest('tr')).data();
      Swal.fire({
        title: 'Reply Feedback',
        html: `
          <textarea class="form-control" id="reply-feedback" placeholder="Reply for Feedback to IT"></textarea>
        `,
        showCancelButton: true,
        confirmButtonText: 'Submit',
        cancelButtonText: 'Batal'
      }).then((result) => {
        // Jika tombol 'Submit' diklik
        if (result.isConfirmed) {
          // Mendapatkan nilai inputan dari form
          const inputData = document.getElementById('reply-feedback').value;

          const Toast = Swal.fire({
              icon:'info',
              text:'Sedang dalam process! Tunggu hingga selesai',
              title:'Info',
              allowEscapeKey:false,
              allowOutsideClick:false
            })
            Toast.disableButtons()
          // Mengirim data ke halaman approve menggunakan fetch
          fetch('feedback-helpdesk', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            cache: 'no-cache',
            body: JSON.stringify({ id: rowData.id, text:inputData})
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
      })
    });

    $('#datatable-' + accordionId + ' tbody').on('click', 'button.confirm-button', function() {
      const rowData = dataTableInstances[accordionId].row($(this).closest('tr')).data();
      Swal.fire({
        title: 'Konfirmasi ke IT',
        html: `
          <textarea class="form-control" id="reply-confirm" placeholder="Jika Permohonan bantuan belum sesuai"></textarea>
        `,
        showCancelButton: true,
        confirmButtonText: 'Submit',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          const Toast = Swal.fire({
            icon:'info',
            text:'Sedang dalam process! Tunggu hingga selesai',
            title:'Info',
            allowEscapeKey:false,
            allowOutsideClick:false
          })
          Toast.disableButtons()
          const inputData = document.getElementById('reply-confirm').value;

          fetch('confirm-helpdesk', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            cache: 'no-cache',
            body: JSON.stringify({ id: rowData.id, text:inputData})
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
      })
    });

    $('#datatable-' + accordionId + ' tbody').on('click', 'button.done-button', function() {
      const rowData = dataTableInstances[accordionId].row($(this).closest('tr')).data();
      Swal.fire({
        title: 'Apakah Anda yakin menutup / menyelesaikan permohonan ini?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
      })
      .then((result) => {
        if (result.isConfirmed) {

          const Toast = Swal.fire({
            icon:'info',
            text:'Sedang dalam process! Tunggu hingga selesai',
            title:'Info',
            allowEscapeKey:false,
            allowOutsideClick:false
          })
          Toast.disableButtons()
          
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
      })
    })

    $('#datatable-' + accordionId + ' tbody').on('click', 'button.cancel-button', function() {
      const rowData = dataTableInstances[accordionId].row($(this).closest('tr')).data();
      const Toast = Swal.fire({
        icon:'info',
        text:'Sedang dalam process! Tunggu hingga selesai',
        title:'Info',
        allowEscapeKey:false,
        allowOutsideClick:false
      })
      Toast.disableButtons()

      fetch('reject-helpdesk', {
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
    })
  };