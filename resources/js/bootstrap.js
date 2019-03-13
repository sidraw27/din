
window._ = require('lodash');

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

axios = require('axios');

let token = document.head.querySelector('meta[name="csrf-token"]');

window.$http = axios.create({
    // async: true,
    // crossDomain: true,
    // mode: 'no-cors',
    // credentials: false,
    headers: {
        // 'X-Requested-With': 'XMLHttpRequest',
       'X-CSRF-TOKEN': token.content,
       //  'Content-Type': 'application/json'
       //  'Content-Type': 'application/form-data'
   }
});

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });
