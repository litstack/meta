const mix = require('laravel-mix');

mix.options({
    extractVueStyles: false,
    postCss: [
        {
            purge: [],
        },
    ],
});

mix.js('resources/js/index.js', 'dist')
    .vue({ version: 2 })
    .disableNotifications();
