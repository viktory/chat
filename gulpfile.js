var elixir = require('laravel-elixir');

var paths = {
    'bootstrap': './node_modules/bootstrap-sass/assets/',
    'jquery': './node_modules/jquery/',
    'scripts': './resources/assets/js/'
};

var public = 'public/';
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass("app.scss", public + 'css/', {includePaths: [paths.bootstrap + 'stylesheets']})
        .copy(paths.bootstrap + 'fonts/bootstrap/**', public + 'fonts')
        .scripts([
            paths.jquery + "dist/jquery.js",
            paths.bootstrap + "javascripts/bootstrap.js",
            paths.scripts + 'chat.js'
        ], public + 'js/app.js', './')
        .version([public + 'css/app.css', public + 'js/app.js']);
});
