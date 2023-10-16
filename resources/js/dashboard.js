import Echo from 'laravel-echo';
import Swal from "sweetalert2";

import {showToastNotification, isAppInstalled, increaseOrderCount} from "@/helpers";

import {playNotificationAudio, createChromeNotification} from "@/services/orderNotifications";

window.Pusher = require('pusher-js');

window.Swal = Swal;
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true,
});

window.realtimeSetup = false;

// let deferredPrompt;
//
// window.addEventListener('beforeinstallprompt', (e) => {
//         // Prevent Chrome 67 and earlier from automatically showing the prompt
//         e.preventDefault();
//         // Stash the event so it can be triggered later.
//         deferredPrompt = e;
//
//         if (!isAppInstalled()) {
//             setTimeout(() => {
//                 window.Swal.fire({
//                     title: 'Add Brewsta Admin to your home screen and use it like regular app',
//                     showDenyButton: true,
//                     confirmButtonText: 'Install Now',
//                     denyButtonText: `Not Now`,
//                 }).then((result) => {
//                     /* Read more about isConfirmed, isDenied below */
//                     if (result.isConfirmed) {
//                         deferredPrompt.prompt();
//
//                         deferredPrompt.userChoice.then((choiceResult) => {
//                             if (choiceResult.outcome === 'accepted') {
//                                 // pwaInstallPrompt.close()
//                                 localStorage.setItem('pwaInstalled', 'true');
//
//                             }
//                             deferredPrompt = null;
//                         });
//                     } else if (result.isDenied) {
//
//                     }
//                 })
//             }, 2000)
//         }
//
//     })
// //end pwa install prompt

window.addEventListener("load", function () {

    Notification.requestPermission().then((result) => {
    });
    fetchUser();
});

function setupNotification(user){
    window.Echo.private('App.Models.User.' + user.id)
        .notification((notification) => {
            playNotificationAudio();
            createChromeNotification(notification)
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
