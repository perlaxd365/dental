import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();

// toastr
// https://cylab.be/blog/219/notifications-with-toastr-and-laravel
window.toastr = require('toastr');
window.toastr.options = {
  "progressBar": true
};