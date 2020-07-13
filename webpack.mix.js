const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.combine(['public/assets/js/jquery-3.4.1.min.js',
    'public/assets/js/bootstrap.min.js',
    'public/assets/js/popper.min.js',
    'public/assets/js/admin4b.docs.js',
    'public/assets/js/admin4b.min.js',
    'public/assets/js/highlight.min.js',
    'public/assets/js/datatables.min.js',
    //'public/assets/js/jquery.slim.min.js',
    'public/assets/js/moment.min.js',

], 'public/app.js');


mix.combine(['public/assets/css/fonts.css',
    'public/assets/css/bootstrap.min.css',
    'public/assets/css/font-awesome.min.css',
    'public/assets/css/simple-line-icons.min.css',
    'public/assets/css/datatables.min.css',
    'public/assets/css/admin4b.min.css'
], 'public/app.css');