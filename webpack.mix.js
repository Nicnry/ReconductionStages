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

mix.js('resources/assets/js/my.js', 'public/js')
    .js('resources/assets/js/internships.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/documents.scss', 'public/css')
    .sass('resources/assets/sass/editGrid.scss', 'public/css')
    .sass('resources/assets/sass/evalGrid.scss', 'public/css')
    .sass('resources/assets/sass/people.scss', 'public/css')
    .sass('resources/assets/sass/synchro.scss', 'public/css')
    .sass('resources/assets/sass/travelTime.scss', 'public/css')
    .sass('resources/assets/sass/visits.scss', 'public/css')
    .sass('resources/assets/sass/wishesMatrix.scss', 'public/css')
    .sass('resources/assets/sass/mpmenu.scss', 'public/css')
    .sass('resources/assets/sass/internships.scss', 'public/css')
    .copy('resources/assets/css/minimal.css','public/css');
