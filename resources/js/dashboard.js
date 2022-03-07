import Echo from 'laravel-echo';
window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});



window.addEventListener("load", function () {
    fetch('/user-info', {
        headers: {
            'Content-Type': 'application/json'
        },
    })
        .then(response => response.json())
        .then(user => {
            window.Echo.private('App.Models.User.' + user.id)
                .notification((notification) => {

                    let options = {
                        title: notification.title,
                        toast: true,
                        position: 'top-right',
                        text: notification.text,
                    };

                    if (notification.action) {
                        options.confirmButtonText = "<a class='text-white' href='" + notification.action + "'>View</a>"
                    }

                    window.Swal.fire(options)
                });
        })
});
