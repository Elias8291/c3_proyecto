const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

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

// JS compilations
mix.js('resources/js/app.js', 'public/js');

// Tailwind CSS processing
mix.postCss('resources/css/app.css', 'public/css', [
    tailwindcss('./tailwind.config.js'), // Configuración de Tailwind
]);

// Other CSS styles
mix.styles([
    'public/css/social-icons.css',
    'public/css/owl.carousel.css',
    'public/css/owl.theme.css',
    'public/css/prism.css',
    'public/css/main.css',
    'public/css/custom.css',
], 'public/css/all.css').version();

// Other JS files
mix.js('public/js/scripts.js', 'public/js/scripts.min.js')
    .js('resources/assets/js/profile.js', 'public/assets/js/profile.js')
    .js('resources/assets/js/custom/custom.js', 'public/assets/js/custom/custom.js')
    .js('resources/assets/js/custom/custom-datatable.js', 'public/assets/js/custom/custom-datatable.js')
    .version();

// Copying assets from node_modules to public directory
mix.copy('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/assets/css/bootstrap.min.css');

mix.copy('node_modules/datatables.net-dt/css/jquery.dataTables.min.css', 'public/assets/css/jquery.dataTables.min.css');
mix.copy('node_modules/datatables.net-dt/images', 'public/assets/images');
mix.copy('node_modules/select2/dist/css/select2.min.css', 'public/assets/css/select2.min.css');
mix.copy('node_modules/sweetalert/dist/sweetalert.css', 'public/assets/css/sweetalert.css');
mix.copy('node_modules/izitoast/dist/css/iziToast.min.css', 'public/assets/css/iziToast.min.css');

// FontAwesome
mix.copy('node_modules/@fortawesome/fontawesome-free/css/all.min.css', 'public/css/fontawesome.css');
mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts');


// Babel to compile JS files
mix.babel('node_modules/jquery.nicescroll/dist/jquery.nicescroll.js', 'public/assets/js/jquery.nicescroll.js');
mix.babel('node_modules/jquery/dist/jquery.min.js', 'public/assets/js/jquery.min.js');
mix.babel('node_modules/popper.js/dist/umd/popper.min.js', 'public/assets/js/popper.min.js');
mix.babel('node_modules/bootstrap/dist/js/bootstrap.min.js', 'public/assets/js/bootstrap.min.js');
mix.babel('node_modules/datatables.net/js/jquery.dataTables.min.js', 'public/assets/js/jquery.dataTables.min.js');
mix.babel('node_modules/select2/dist/js/select2.min.js', 'public/assets/js/select2.min.js');
mix.copy('node_modules/sweetalert2/dist/sweetalert2.min.js', 'public/js/sweetalert2.js');
mix.babel('node_modules/izitoast/dist/js/iziToast.min.js', 'public/assets/js/iziToast.min.js');
