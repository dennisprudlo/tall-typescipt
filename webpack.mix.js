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

mix.options({
	terser: {
		extractComments: false,
	}
});

mix.ts('resources/js/app.ts', 'public/js/app.min.js');
mix.postCss('resources/css/app.css', 'public/css/app.min.css', [
	require('tailwindcss'),
	require('autoprefixer')
]);

if (mix.inProduction()) {
	mix.version();
}

// mix.disableSuccessNotifications();

// mix.browserSync({
//     proxy: 'https://application.local'
// });