export function showToastNotification(notification) {
    console.log('n id', notification.id)
    iziToast.show({
        id: notification.id,
        title: notification.title,
        message: notification.text,
        color:'green',
        position: 'topRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
        timeout: false,
        buttons: [
            ['<a target="_blank" href="'+notification.action+ '">View</a>', function (instance, toast) {
                location.href = notification.action
                // Turbo.visit(notification.action, { action: "replace" })
                // instance.click();
            }, true]
        ]
    });
}

export function isIos() {
    const userAgent = window.navigator.userAgent.toLowerCase();
    return /iphone|ipad|ipod/.test(userAgent);
}
// Detects if device is in standalone mode
export const isInStandaloneMode = () => ('standalone' in window.navigator) && (window.navigator.standalone);

export function isAppInstalled(){
    if (localStorage.getItem('pwaInstalled') === 'true' || (window.matchMedia('(display-mode: standalone)').matches) || (navigator.standalone)) {
        return true;
    }
    return false;
}

export function increaseOrderCount(){
    let badge = document.querySelector('.badge');
    let count = parseInt( badge.textContent);
    count++;
    badge.innerHTML = count.toString();
}
