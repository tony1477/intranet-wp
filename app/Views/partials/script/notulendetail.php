<script>
    const detailBtn = document.querySelector('.detailnotulen')
    const submitBtn = document.querySelector('.submitnotes')
    const submitFeed = document.querySelector('.submitfeedback')
    const updateBtn = document.querySelector('.updatenotes')
    const cancelBtn = document.querySelector('.cancelnotes')
    const myModalEl = document.getElementById('detailnotulen')
    const feedbackEl = document.getElementById('feedbackModal')

    myModalEl.addEventListener('show.bs.modal', function (event) {
        const id = document.forms['Notulen_Meeting']['id'].value
        getDataTable(id)
    })

    async function getDataTable(id) {
        const getdata = await fetch(`notulen/${id}/notes`, {
            method:'GET',
            mode:'cors',
            cache:'no-cache',
            creadentials:'same-origin',
            headers: {
                'Content-Type':'application/json',
                "X-Requested-With": "XMLHttpRequest"
            },
        })        
        .then((response) => response.json())
        .then(data => {
            const headerid = document.querySelector('#headerid')
            headerid.value = id
            let disabled=''
            if(data.canedit==false) disabled='d-none disabled-link'
            let table = $('#dt-detailNotulen').DataTable({
                lengthChange:true,
                destroy: true,
                data: data.data,
                lengthMenu: [5,10,15,25,50],
                processing:true,
                columns: [
                    { 
                        data:  null,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data:  null,
                        render: function(data, type, row) {
                            return `<a class="btn btn-soft-secondary waves-effect waves-light btn-sm editNotulenDetail ${disabled}}" title="Edit" ><i class="fas fa-pencil-alt" title="Edit"></i></a>
                            <a class="btn btn-soft-danger waves-effect waves-light btn-sm deleteNotulenDetail ${disabled}" title="Delete"}><i class="fas fa-times-circle" title="Delete"></i></a>
                            <a class="btn btn-soft-primary waves-effect waves-light btn-sm d-none feedbackNotulenDetail" title="Feedback" data-bs-target="#feedbackModal" data-bs-toggle="modal" data-bs-dismiss="modal"><i class=" far fa-calendar-check" title="Feedback"></i></a>`;
                        }
                    },
                    { data: 'detailid', visible:false },
                    { data: 'content' },
                    { data: 'classification' },
                    { data: 'pic_from' },
                    { data: 'pic_to' },
                    { data: 'targetdate' },
                    { data: 'description' },               
                ]
            })
            return data.canedit
        })
        .then(result => {
            let forms = document.forms['detailnotulen'];
            let elements = forms.elements;
            elements.forEach(element => {
                element.disabled = !result
            });
            if(result==false) {
                let feedbackBtn = document.querySelectorAll('.feedbackNotulenDetail')
                feedbackBtn.forEach(el => {
                    el.classList.remove('d-none')
                })
            }
        })
    }

    $('#dt-detailNotulen').on('click','a.editNotulenDetail', function(){
        let table = $('#dt-detailNotulen').DataTable();
        let rowData = table.row($(this).parents('tr')).data()
        // let ix = table.row(this).index();
        // console.log(table.row( $(this).parents('tr') ).data())
        detailid.value = 0
        agendaInput.innerHTML = rowData.content
        dariInput.value = rowData.pic_from
        untukInput.value = rowData.pic_to
        untukTanggal.value = rowData.targetdate
        agendaKeterangan.value = rowData.description
        switch(rowData.classification) {
            case 'PERLU KEPUTUSAN':
                document.querySelector('#pk-choice').checked = true
                break;
            case 'SEBAGAI INFORMASI':
                document.querySelector('#si-choice').checked = true
                break;
            case 'UNTUK TINDAK LANJUT':
                document.querySelector('#utl-choice').checked = true
                break;
        }
        agendaInput.focus()        
        // const detId = document.querySelector('#detailid')
        detailid.value = rowData.detailid
        focusField('add')
        submitBtn.classList.add('d-none')
        updateBtn.classList.remove('d-none')
        cancelBtn.classList.remove('d-none')
    })

    $('#dt-detailNotulen').on('click','a.deleteNotulenDetail', function(){
        let table = $('#dt-detailNotulen').DataTable();
        let rowData = table.row($(this).parents('tr')).data()
        const headerid = rowData.notulenid
        const detailid = rowData.detailid
        Swal.fire({
            title: 'Apakah anda yakin akan menghapus data?',
            text:'',
            icon: 'warning',
            showCancelButton:true,
            confirmButtonColor: "#2ab57d",
            cancelButtonColor: "#fd625e",
            confirmButtonText: 'Ya'
        })
        .then(function(res) {
            if(res.value) {
                deleteData(`notulen/${headerid}/notes/${detailid}`)
                .then(data => {
                    if(data.status=='success') {
                        Swal.fire('Deleted!',data.message,data.status)
                        getDataTable(headerid)
                    }
                })
                .catch(err => {
                    Swal.fire('Error!',err,'error')
                })
            }
        })
    })

    $('#dt-detailNotulen').on('click','a.feedbackNotulenDetail', function(){
        let table = $('#dt-detailNotulen').DataTable();
        let rowData = table.row($(this).parents('tr')).data()        
        const formfeedback = document.forms['feedbackform']
        let status=false;
        if(rowData.status) status=true
        formfeedback['detailid'].value = rowData.detailid
        formfeedback['statusFeedback'].disabled = status
        formfeedback['keteranganFeedback'].disabled = status
        formfeedback.querySelector('.submitfeedback').disabled = status

        formfeedback['agendafeedback'].value = rowData.content
        formfeedback['statusFeedback'].value = rowData.status
        formfeedback['keteranganFeedback'].value = rowData.reason
    })

    submitBtn.addEventListener('click', () => {
        const url =  `notulen/${headerid.value}/notes`
        storeData(url)
    })

    submitFeed.addEventListener('click', () => {
        const form = document.forms['feedbackform']
        const detail = form['detailid']
        const url =  `notulen/feedback/${detail.value}`
        const data = {
            'status' : form['statusFeedback'].value,
            'reason' : form['keteranganFeedback'].value
        }
        patchData(url,data)
        .then(data => {
            if(data.status=='success') {
                form['statusFeedback'].disabled = true
                form['keteranganFeedback'].disabled = true
                form.querySelector('.submitfeedback').disabled = true
                return Swal.fire("Success!", data.message, data.status)
            }
        })
        .catch((error) => {
            Swal.fire('Error','Terjadi kesalahan','error')
        });
        
    })

    updateBtn.addEventListener('click', () => {
        const url =  `notulen/${headerid.value}/notes/${detailid.value}`
        storeData(url,'PUT')
    })

    cancelBtn.addEventListener('click', () => {
        // document.forms['detailnotulen'].reset()
        $('form[name="detailnotulen"]').get(0).reset()
        agendaInput.innerHTML=''
        cancelBtn.classList.add('d-none')
        updateBtn.classList.add('d-none')
        submitBtn.classList.remove('d-none')
        focusField('remove')
        detailid.value=0
    })

    const focusField = (type) => {
        const form = document.forms['detailnotulen']
        const inputField = form.querySelectorAll('.form-control')
        Array.from(inputField,(el) => {
            if(type=='add') el.classList.add('inputField')
            else el.classList.remove('inputField')
        })
    }
    
    const getDetailFormData = () => {
        const headerid = document.querySelector('input[name="headerid"]').value
        const agenda = document.querySelector('textarea[name="agenda"]')
        const klasifikasi = document.querySelectorAll('input[name="klasifikasi"]')
        const selectValue= Array.from(klasifikasi).find(radio => radio.checked);
        const picFrom = document.querySelector('input[name="pic_dari"]')
        const picTo = document.querySelector('input[name="pic_untuk"]')
        const tanggal = document.querySelector('input[name="tanggal_fu"]')
        const keterangan = document.querySelector('textarea[name="keterangan"]')

        const data = {
            notulenid: headerid,
            agenda: agenda.value,
            klasifikasi: selectValue.value,
            picFrom: picFrom.value,
            picTo: picTo.value,
            tanggal: tanggal.value,
            keterangan: keterangan.value
        }

        return data
    }

    const storeData = (url,method='POST') => {
        let data = getDetailFormData()
        fetch(url,{
            method:method,
            mode:'cors',
            cache:'no-cache',
            creadentials:'same-origin',
            headers: {
                'Content-Type':'application/json',
                "X-Requested-With": "XMLHttpRequest"
            },
            body: JSON.stringify(data)
        })
        .then((response) => response.json())
        .then(resp => {
            if(resp.status == 'success') {
                return Swal.fire("Success!", resp.message, resp.status)
                .then(function() {
                    // console.log(data)
                    getDataTable(data.notulenid)
                    document.querySelector('form[name="detailnotulen"]').reset()
                    detailid.value=0
                    agendaInput.innerHTML=''
                    cancelBtn.classList.add('d-none')
                    updateBtn.classList.add('d-none')
                    submitBtn.classList.remove('d-none')
                    focusField('remove')
                })
            }
            return Swal.fire('Failed!',resp.message,resp.status);
        })
    }
</script>