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
mix.react('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.react('resources/js/system_app.js', 'public/js')
    .sass('resources/sass/system_app.scss', 'public/css');
var LiveReloadPlugin = require('webpack-livereload-plugin');


mix.webpackConfig({
    plugins: [new LiveReloadPlugin({host:"127.0.0.1"})]
});