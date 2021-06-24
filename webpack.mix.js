const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .sass('resources/scss/frontend/frontend.scss', 'public/css/frontend.css')
    .sass('resources/scss/backend/backend.scss', 'public/css/backend.css')
    .js('resources/js/frontend/frontend.js', 'public/js/frontend.js')
    .js('resources/js/backend/backend.js', 'public/js/backend.js');

if (mix.inProduction()) {
    mix.version();
}
