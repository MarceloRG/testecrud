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

// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css');

assets = "public/assets/";
mix.styles([
    assets + "plugins/bootstrap/css/bootstrap.min.css",
    assets + "css/style.css"
], 'public/css/app.css');
mix.scripts([
    assets + 'js/jquery-3.2.1.min.js',
    assets + 'js/popper.min.js',
    assets + 'js/tether.min.js',
    assets + 'plugins/bootstrap/js/bootstrap.min.js',
    assets + 'js/main.js'
], 'public/js/app.js');