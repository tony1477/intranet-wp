const appBtn = document.querySelector('#approveticket')
const rejBtn = document.querySelector('#rejectticket')

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
    
}

appBtn.addEventListener('click', approveHelpdesk)