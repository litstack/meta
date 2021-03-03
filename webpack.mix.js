const mix = require('laravel-mix');

mix.js('resources/js/index.js', 'dist')
    .vue()
    .disableNotifications();
