require('./bootstrap');

import Alpine from 'alpinejs';
import Swal from 'sweetalert2'
import Echo from 'laravel-echo';

window.Alpine = Alpine;

Alpine.start();

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});

window.Swal = Swal;




