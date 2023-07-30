import soundUrl from "../../../public/elevator.wav";

const audio = new Audio(soundUrl);
// const
var soundCount = 0;

window.stopSound= false;


export function playNotificationAudio(){
    // const audio = new Audio("./../elevator.wav");
    audio.play();
    window.notificationSound = audio;
    soundCount++;

    if(window.stopSound || soundCount > 30){
        return;
    }

    setTimeout(() => {
        playNotificationAudio()
    },  2000); // Call playSound() again after the duration of the sound
}


export function createChromeNotification(notification){
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

