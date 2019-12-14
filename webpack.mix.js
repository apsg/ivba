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

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .version();


mix.styles([
    'node_modules/admin-lte/dist/css/AdminLTE.min.css',
    'node_modules/admin-lte/dist/css/skins/_all-skins.min.css',
    'resources/assets/css/gacek.css'
], 'public/css/all.css');

mix.scripts([
    'node_modules/admin-lte/dist/js/app.min.js',
    'resources/assets/js/gacek.js'
], 'public/js/all.js');

// ----------- FRONT -----------------------

mix.styles([
    'resources/assets/css/reset.css',
    'resources/assets/css/fonts.css',
    'resources/assets/css/animate.css',
    'resources/assets/css/custom.css',
    'resources/assets/css/gacek-front.css',
    'resources/assets/css/learn.css',
], 'public/css/front.css');

mix.scripts([
    // 'resources/assets/js/modernizr.custom.js',
    'resources/assets/js/custom.js',
], 'public/js/front.js');

// ----- MULTISITE -----------------
let domains = [
    'inauka',
    'projekt30'
];

for (let domain of domains) {
    mix.js('resources/assets/js/' + domain + '.js', 'public/js', domain + '.js')
        .sass('resources/assets/sass/' + domain + '.scss', 'public/css', domain + '.css');
}
