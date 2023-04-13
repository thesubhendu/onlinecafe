import Echo from 'laravel-echo';
import Swal from "sweetalert2";

window.Pusher = require('pusher-js');

window.Swal = Swal;
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true,
});

window.realtimeSetup = false;


window.addEventListener("load", function () {

    Notification.requestPermission().then((result) => {
      console.log(result);
    });
    fetchUser();
});

function playNotificationAudio(){
        const audio = new Audio("./../elevator.wav");
        audio.play();

}

function setupNotification(user){
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

            let chromeNotification = new Notification(notification.title, { body: notification.text});

            chromeNotification.addEventListener('click', () => {
                window.href = notification.action;
            })
            window.Swal.fire(options)
            //add sound
            playNotificationAudio();
        });
}

window.fetchUser = function fetchUser(){
    if(window.realtimeSetup) {
        return false;
    }
    fetch('/user-info', {
        headers: {
            'Content-Type': 'application/json'
        },
    })
        .then(response => response.json())
        .then(data => {
            if(data.user) {
               setupNotification(data.user)
                window.realtimeSetup = true;
            }
        })
}
