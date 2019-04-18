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

mix.webpackConfig({
    resolve: {
        alias: {
            modules: path.resolve(__dirname, "node_modules")
        }
    }
});

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/app/index.js', 'public/js/app')
    .js('resources/js/app/hotel.js', 'public/js/app')
    .js('resources/js/app/list.js', 'public/js/app')
    .js('resources/js/action/master.js', 'public/js/action')
    .js('resources/js/action/hotel.js', 'public/js/action')
    .js('resources/js/register.js', 'public/js')
    .js('resources/js/sw.js', 'public');

mix.sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/index.sass', 'public/css')
    .sass('resources/sass/hotel.sass', 'public/css')
    .sass('resources/sass/list-page.sass', 'public/css/list.css');

mix.version();

mix.browserSync({
    proxy: 'din.dev:7003',
    https: {
        key: "/home/sidraw/.localssl/din.dev-key.pem",
        cert: "/home/sidraw/.localssl/din.dev.pem"
    },
    port: 443,
    online: false,
    browser: []
});