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

//pwa install prompt

function isIos() {
    const userAgent = window.navigator.userAgent.toLowerCase();
    return /iphone|ipad|ipod/.test(userAgent);
}
// Detects if device is in standalone mode
const isInStandaloneMode = () => ('standalone' in window.navigator) && (window.navigator.standalone);


function isAppInstalled(){
    if (localStorage.getItem('pwaInstalled') === 'true' || (window.matchMedia('(display-mode: standalone)').matches) || (navigator.standalone)) {
        console.log('result is', localStorage.getItem('pwaInstalled'))

        return true;
    }
    console.log('result false', localStorage.getItem('pwaInstalled'))
    return false;
}


    let deferredPrompt;

window.addEventListener('beforeinstallprompt', (e) => {
        // Prevent Chrome 67 and earlier from automatically showing the prompt
        e.preventDefault();
        // Stash the event so it can be triggered later.
        deferredPrompt = e;

        if (!isAppInstalled()) {
            setTimeout(() => {
                window.Swal.fire({
                    title: 'Add Brewsta Admin to your home screen and use it like regular app',
                    showDenyButton: true,
                    confirmButtonText: 'Install Now',
                    denyButtonText: `Not Now`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        deferredPrompt.prompt();

                        deferredPrompt.userChoice.then((choiceResult) => {
                            if (choiceResult.outcome === 'accepted') {
                                // pwaInstallPrompt.close()
                                localStorage.setItem('pwaInstalled', 'true');

                            }
                            deferredPrompt = null;
                        });
                    } else if (result.isDenied) {

                    }
                })
            }, 2000)
        }

    })
//end pwa install prompt




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

const audio = new Audio(soundUrl);
// const
var soundCount = 0;

function playNotificationAudio(){
        // const audio = new Audio("./../elevator.wav");
        audio.play();
        window.notificationSound = audio;
        soundCount++;

        if(soundCount > 3){
            return;
        }

        setTimeout(() => {
            playNotificationAudio()
        },  2000); // Call playSound() again after the duration of the sound
}

function setupNotification(user){
    window.Echo.private('App.Models.User.' + user.id)
        .notification((notification) => {

            let options = {
                title: notification.title,
                // toast: true,
                position: 'top-right',
                allowOutsideClick:false,
                // timer:4000,
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
