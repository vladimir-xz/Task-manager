import _ from 'lodash';

window._ = _;

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    console.info('CSRF has been connected');
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    setTimeout(function() { document.getElementsByClassName('popover-background-window')[0].click(); }, 100);
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}