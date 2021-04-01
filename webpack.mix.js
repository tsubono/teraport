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

mix.js('resources/js/app.js', 'public/js');
mix.sass('resources/sass/reset.scss', 'public/css');
mix.sass('resources/sass/common.scss', 'public/css');
mix.sass('resources/sass/top.scss', 'public/css');
mix.sass('resources/sass/auth.scss', 'public/css');
mix.sass('resources/sass/mypage.scss', 'public/css');
mix.sass('resources/sass/profile.scss', 'public/css');
mix.sass('resources/sass/message.scss', 'public/css');
mix.sass('resources/sass/service.scss', 'public/css');
mix.sass('resources/sass/transaction.scss', 'public/css');
mix.sass('resources/sass/error.scss', 'public/css');
mix.sass('resources/sass/notification.scss', 'public/css');
mix.sass('resources/sass/contact.scss', 'public/css');
