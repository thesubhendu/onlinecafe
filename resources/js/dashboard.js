import Echo from 'laravel-echo';
import Swal from "sweetalert2";

window.Pusher = require('pusher-js');

window.Swal = Swal;
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
        .then(data => {
            if(data.user) {
                setupNotification(data.user)
            }else{
                console.log('no user at the moment');
            }
        })
});

window.setupNotification = function setupNotification(user){
    window.Echo.private('App.Models.User.' + user.id)
        .notification((notification) => {

            let options = {
                title: notification.title,
                toast: true,
                position: 'top-right',
                timer:4000,
                text: notification.text,
            };

            let badge = document.querySelector('.badge');
            let count = badge.textContent;
            badge.innerHTML = count++;

            if (notification.action) {
                options.confirmButtonText = "<a class='text-white' href='" + notification.action + "'>View</a>"
            }

            window.Swal.fire(options)
        });
}

