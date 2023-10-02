$(document).ready(function() {
    let table = dtTable.DataTable({
        lengthChange:true,
        buttons: [
            {
                text:'Add',
                action: function(e, dt, node, config) {
                    showForm()
                    const closeBtn = document.querySelector('.close-btn')
                    closeBtn.setAttribute('disabled','disabled')
                    const detailBtn = document.querySelector('.detailnotulen')
                    detailBtn.classList.add('d-none')
                }
            },'excel','pdf','colvis'
        ],
        dom: 'flBrtip',
        // lengthMenu:[1,5,10],
        processing:true,
        serverSide:true,
        ajax:{
            url:'notulens',
            type:'GET',
            dataSrc:'data'
        },
        columns: [
            { 
                data:  null,
                render: function(data, type, row) {
                    if(data.status=='Input By User') {
                        return `<a class="btn btn-soft-secondary waves-effect waves-light btn-sm edit${menuname}" title="Edit" data-bs-toggle="modal" href="#edit${menuname}"><i class="fas fa-pencil-alt" title="Edit"></i></a>
                        <a class="btn btn-soft-danger waves-effect waves-light btn-sm delete${menuname}" title="Delete"><i class="fas fa-times-circle" title="Delete"></i></a>
                        <a class="btn btn-soft-success waves-effect waves-light btn-sm approve${menuname}" title="Approve"><i class="fas fa-check-circle" title="Approve"></i></a>`;
                    }
                    else {
                        return `<a class="btn btn-soft-secondary waves-effect waves-light btn-sm edit${menuname}" title="Follow Up" data-bs-toggle="modal" href="#edit${menuname}"><i class="far fa-calendar-check" title="Follow Up"></i></a>`;
                    }
                }
            },
            { data: 'id', visible:false },
            { data: 'agenda' },
            { data: 'title' },
            { data: 'starttime' },
            { data: 'endtime' },
            { data: 'notulen' },
            { data: 'head_notulen' },
            { data: 'key_person' },
            { data: 'status' },
            {
                data: null,
                render: function(data, type, row) {
                    return '<button class="btn btn-sm btn-primary detail-btn" data-id="' + data.id + '" type="button"><i class="bx bx-info-circle font-size-16 align-middle me-2"></i> Detail</button>' + '<button class="btn btn-sm btn-info print-btn" data-id="'+data.id+'" type="button" onclick="printPage(this)"><i class="bx bx-printer font-size-16 align-middle me-2"></i> Print</button>';
                }
            },
            // {
            //     data: null,
            //     render: function(data, type, row) {
            //         return '<button class="btn btn-sm btn-info">Edit</button>' +
            //             '<button class="btn btn-sm btn-danger">Delete</button>';
            //     }
            // }
        ]
    })

    table.on('click','tbody .editNotulen_Meeting', function() {
        let tr = $(this).closest('tr');
        let row = table.row(tr);
        const status = row.data().status
        const saveBtn = document.querySelector('.save')
        const updateBtn = document.querySelector('.update')
        const closeBtn = document.querySelector('.close-btn')
        const detailBtn = document.querySelector('.detailnotulen')
        closeBtn.removeAttribute('disabled')
        saveBtn.classList.add('d-none')
        detailBtn.classList.remove('d-none')
        // check if status approve updatebtn missing
        checkStatusForm(status,updateBtn)
    });

    const select = document.querySelector('#agenda')
    select.addEventListener('change', (e) => getSelectedInput(e))

    const getSelectedInput = (e) => {
        const value = e.target.value
        const url = `meeting-schedule/${value}`
        new Swal({
            title: 'Now loading',
            icon:'info',
            allowEscapeKey: false,
            allowOutsideClick: false,
        })
        fetch(url,{
            method: 'GET',
            cache: 'no-cache',
            mode: 'cors',
            headers: {
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            const jam_mulai = data.data.tgl_mulai +'T'+ data.data.jam_mulai
            const jam_selesai = data.data.act_tgl_selesai + 'T'+ data.data.act_jam_selesai
            document.querySelector('#judul').value = data.data.agenda
            document.querySelector('#notulen1').value = data.data.notulis
            document.querySelector('#pimpinan').value = data.data.pemateri
            document.querySelector('#mulai').value = jam_mulai
            document.querySelector('#selesai').value = jam_selesai
            new Swal({ 
                title: 'Finished!',
                icon: 'success',
                timer: 500,
                showConfirmButton: false
            })
        })
    }

    const checkStatusForm = (status,btn) => status === 'Approved' ? btn.classList.add('d-none') : btn.classList.remove('d-none')

    let currentPage = 1;
    let totalRows = 0;
    let contentCounter = -1;

    table.on('click', '.detail-btn', function() {
        let tr = $(this).closest('tr');
        let row = table.row(tr);
        let mainDataId = row.data().id;

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {

            // Open this row and fetch details
            $.ajax({
                url: `notulen/${mainDataId}/notes`,
                success: function(response) {
                    const details = response.data;
                    const alphabet = 'abcdefghijklmnopqrstuvwxyz';

                    totalRows = details.length;

                     // Function to create HTML for the detail table rows
                    const createDetailRows = (startIndex, endIndex) => {
                        let headerCounter = 0;
                        return details
                        .map(detail => {
                            const bg = detail.status == 1 ? 'bg-success' : (detail.status == 2 ? 'bg-info' : (detail.status==3 ? 'bg-warning' : ''))
                            const headerRow = detail.isheader == 1
                            if (headerRow) {
                                headerCounter++;
                                contentCounter = -1;
                            } else {
                                contentCounter++;
                            }
            
                            const numberValue = headerRow ? headerCounter : alphabet[contentCounter % alphabet.length];
            
                            return `
                            <tr>
                                <td${headerRow ? ' style="font-weight:bold"' : ''}>${numberValue}</td>
                                <td${headerRow ? ' style="font-weight:bold"' : ''}>${detail.content}</td>
                                <td>${headerRow ? ''  : detail.classification}</td>
                                <td>${headerRow ? '' : detail.pic_from}</td>
                                <td>${headerRow ? '' : detail.pic_to}</td>
                                <td>${headerRow ? '' : detail.targetdate}</td>
                                <td>${headerRow ? '' : (detail.description!=null ? detail.description : '')}</td>
                                <td class="${bg}">${headerRow ? '' : (detail.status!=null ? detail.statfeedback : '')}</td>
                            </tr>
                            `;
                        })
                        .slice(startIndex, endIndex)
                        .join('');
                    }

                    const createPagination = (currentPage, totalRows) => {
                        const totalPages = Math.ceil(totalRows / 10);
                        let paginationHTML = `
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end mb-0">
                                <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                                    <a class="page-link pagination-prev" data-page="${currentPage - 1}" href="#" tabindex="-1">Previous</a>
                                </li>
                                <li class="page-item"><a class="page-link disabled">Page ${currentPage} of ${totalPages}</a></li>
                                <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                                    <a class="page-link pagination-next" data-page="${currentPage + 1}" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                        `;
                        return paginationHTML;
                    }
                     // Function to show the paginated detail table
                    const showDetailTable = page => {
                        const startIndex = (page - 1) * 10;
                        const endIndex = Math.min(startIndex + 10, totalRows);
                        const detailTableHtml = `
                        <table class="table">
                            <thead>
                                <tr>
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Agenda/Topik, Penjelasan dan Hasil Rapat</th>
                                    <th>KLASIFIKASI</th>    
                                    <th>DARI</th>
                                    <th>UNTUK</th>
                                    <th>TANGGAL</th>
                                    <th>KETERANGAN</th>
                                    <th>STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                            ${createDetailRows(startIndex, endIndex)}
                            </tbody>
                        </table>
                        ${createPagination(currentPage, totalRows)}
                        `;
            
                        row.child(detailTableHtml).show();
                        tr.addClass('shown');
                    }

                     // Show the initial detail table with pagination
                    showDetailTable(currentPage);

                    // Handle pagination button clicks
                    table.on('click', '.pagination-prev:not(.disabled)', () => {
                        currentPage -= 1;
                        showDetailTable(currentPage);
                    });

                    table.on('click', '.pagination-next:not(.disabled)', () => {
                        currentPage += 1;
                        showDetailTable(currentPage);
                    });
                    // row.child(detailTableHtml).show();
                    // tr.addClass('shown');
                }
            });
        }
    });

    table.on('click',`.delete${menuname}`, function() {
        let tr = $(this).closest('tr');
        let row = table.row(tr);
        let id = row.data().id;

        Swal.fire({
            title: 'Perhatian!',
            text: 'Apakah anda yakin untuk menghapus notulen ini?',
            icon: 'warning',
            showCancelButton: true,
        }).then((result) => {
            if (result.isConfirmed) {
                const swal = Swal.fire({
                    title: 'Info',
                    text: 'Sedang process',
                    icon: 'info',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                })
                swal.disableButtons()
                fetch(`notulen/${id}/request`, {
                    method: "DELETE", 
                    mode: "cors",
                    cache: "no-cache", 
                    headers: {
                      "Content-Type": "application/json",
                    },
                    body: JSON.stringify({id:id}),
                })
                .then(resp => resp.json())
                .then(data => {
                    Swal.fire('Deleted',data.message,'success')
                })
            }
        })
    })

    table.on('click',`.approve${menuname}`, function() {
        let tr = $(this).closest('tr');
        let row = table.row(tr);
        let id = row.data().id;

        Swal.fire({
            title: 'Perhatian!',
            text: 'Apakah anda yakin untuk menyetujui notulen ini?',
            icon: 'warning',
            showCancelButton: true,
        }).then((result) => {
            if (result.isConfirmed) {
                const swal = Swal.fire({
                    title: 'Info',
                    text: 'Sedang process',
                    icon: 'info',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                })
                swal.disableButtons()
                fetch(`notulen/${id}/request`, {
                    method: "PUT", 
                    mode: "cors",
                    cache: "no-cache", 
                    headers: {
                      "Content-Type": "application/json",
                    },
                    body: JSON.stringify({id:id}),
                })
                .then(resp => resp.json())
                .then(data => {
                    return Swal.fire('Success',data.message,'success')
                })
            }
        })
    })
})

const printPage = el => {
    const id = el.dataset.id
    const url = 'notulen/print/'+id
    window.open(url, '_blank');
}

const showLoading = function() {
    Swal({
      title: 'Now loading',
      allowEscapeKey: false,
      allowOutsideClick: false,
    })
  };