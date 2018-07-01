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

mix.scripts([
	'resources/assets/js/account.js',
	'resources/assets/js/payment.js',
	'resources/assets/js/profiles.js',
	'resources/assets/js/subscription.js'
	], 'public/js/all.js')
   .sass('resources/assets/sass/app.scss', 'public/css');
