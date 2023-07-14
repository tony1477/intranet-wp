const appBtn = document.querySelector('#approveticket')
const rejBtn = document.querySelector('#rejectticket')
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
        title: 'Apakah Anda yakin reject permohonan ini?',
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
rejHelpdesk.addEventListener('click', rejectHelpdesk)
appHelpdesk.addEventListener('click',  doHelpdesk)