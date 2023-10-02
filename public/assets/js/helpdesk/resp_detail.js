const appBtn = document.querySelector('#approveticket')
const rejBtn = document.querySelector('#rejectticket')
const btnConfirm = document.querySelector('.btnConfirm')
const btnReview = document.querySelector('.btn-review')
const rejHelpdesk = document.querySelector('#rejticket')
const appHelpdesk = document.querySelector('#approvehelpdesk')

const approveHelpdesk = () => {
    const id = document.querySelector('#idticket').innerText
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
        setTimeout(Toast.disableButtons(),500);
        fetch('../approve-helpdesk', {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json'
            },
            cache: 'no-cache',
            body: JSON.stringify({ id: id})
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
                if (result.isConfirmed) history.go(-1)
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
}

const rejectHelpdesk = () => {
    const id = document.querySelector('#idticket').innerText
    Swal.fire({
        title: 'Apakah Anda yakin reject/cancel permohonan ini?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
            title: 'Reason for Reject',
            html: `
                <textarea class="form-control" id="reasonReject" placeholder="Alasan di cancel ticket"></textarea>
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
                setTimeout(Toast.disableButtons(),500);

                // Mengirim data ke halaman approve menggunakan fetch
                fetch('../reject-helpdesk', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                cache: 'no-cache',
                body: JSON.stringify({ id: id, reason:inputData})
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
                    if (result.isConfirmed) history.go(-1)
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
}

const doHelpdesk = () => {
    const id = document.querySelector('#idticket').innerText
    const petugas = document.querySelector('#user_it').value
    const urgency = document.querySelector('#urgency').value
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
        setTimeout(Toast.disableButtons(),500);

        fetch('../dohelpdesk', {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json'
            },
            cache: 'no-cache',
            body: JSON.stringify({ 'id': id, 'petugas':petugas, 'urgency':urgency})
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
                if (result.isConfirmed) history.go(-1)
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
}

appBtn.addEventListener('click', approveHelpdesk)
btnReview.addEventListener('click', (e) => {
    const Toast = Swal.fire({
        icon:'info',
        text:'Sedang dalam process! Tunggu hingga selesai',
        title:'Info',
        allowEscapeKey:false,
        allowOutsideClick:false
    })
    setTimeout(Toast.disableButtons(),500);
})
btnConfirm.addEventListener('click', (e) => {
    const radioOpt = document.querySelectorAll('input[name="helpdesktype"]:checked')
    if(radioOpt.length == 0) 
        return Swal.fire('Warning','Harap Pilih Jenis Helpdesk','warning');
    
    const Toast = Swal.fire({
        icon:'info',
        text:'Sedang dalam process! Tunggu hingga selesai',
        title:'Info',
        allowEscapeKey:false,
        allowOutsideClick:false
    })
    setTimeout(Toast.disableButtons(),500);
})
rejHelpdesk.addEventListener('click', rejectHelpdesk)
appHelpdesk.addEventListener('click',  doHelpdesk)