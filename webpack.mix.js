let mix = require('laravel-mix');

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

mix.js('resources/assets/js/main.js', 'public/assets/js')
    .js('resources/assets/js/semantic.min.js','public/assets/js')
   .sass('resources/assets/sass/app.scss', 'public/assets/css')
    .sass('resources/assets/sass/admin.scss', 'public/assets/css')
    .sass('resources/assets/sass/volunteer.scss','public/assets/css');
