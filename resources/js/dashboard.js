import Echo from 'laravel-echo';
import Swal from "sweetalert2";

import soundUrl from '../../public/elevator.wav'

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
    });
    fetchUser();
});

function createChromeNotification(notification){
    Notification.requestPermission().then(function(permission) {
  if (permission === "granted") {

    var chromeNotification = new Notification(notification.title, { body: notification.text, requireInteraction: true});

    chromeNotification.onclick = (event) => {
      event.preventDefault(); // Prevents the browser from focusing the Notification's tab
      window.open(notification.action); // Opens the website in a new tab
      notification.close(); // Closes the notification
    };
  }
});
}

function playNotificationAudio(){
        // const audio = new Audio("./../elevator.wav");
        const audio = new Audio(soundUrl);
        audio.play();
        window.notificationSound = audio;
        setTimeout(() => {
            playNotificationAudio()
        },  2000); // Call playSound() again after the duration of the sound
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

            createChromeNotification(notification)

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
