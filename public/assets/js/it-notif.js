$(document).ready(function() {
    
    const ithelpdeskNotif = () => {
        const pusher = new Pusher('5484a2d917d249565526', {
            cluster: 'ap1',
            encrypted: true
        });
        
        const channel = pusher.subscribe('my-channel');
        
        channel.bind('ithelpdesk', (data) => {
            // Handle the new notification event
            // console.log(data)
            const notifContainer = document.querySelector('.simplebar-content');
            const row = data.data
            // data.data.forEach((row) => {
                const el = document.createElement('a')
                el.className = 'text-reset notification-item cursor-pointer'
                el.setAttribute('data-href',row.url)
                el.setAttribute('data-id',row.id)
                el.setAttribute('onclick','viewnotif(this)')
                el.innerHTML = `<div class="d-flex">
                <div class="flex-shrink-0 avatar-sm me-3">
                    <span class="avatar-title bg-success rounded-circle font-size-16"><i class="${row.img}"></i>
            </span>
                </div>
                <div class="flex-grow-1">
                    <h6 class="mb-1">${row.title}</h6>
                    <div class="font-size-13 text-muted">
                        <p class="mb-1">${row.content}</p>
                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>${row.date}</span></p>
                    </div>
                </div>
            </div>`
            notifContainer.appendChild(el)
            // })
            getNotification()
            alertify.set('notifier','position', 'top-right');
            alertify.success('You got new notification');
            // Update the user interface to show the new notification
        });
    }

    ithelpdeskNotif();
})
