var elixir = require('laravel-elixir');

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
 mix.sass('app.scss')

     .scripts([
      'libs/jquery-2.2.0.js'
     ], 'public/js/libs/jquery.js')

     .scripts([
      'libs/sweetalert-dev.js'
     ], 'public/js/libs/sweetalert.js')

     .scripts([
      'libs/bootstrap.js'
     ], 'public/js/libs/bootstrap.js')

     .scripts([
      'main.js'
     ], 'public/js/main.js')

     .scripts([
         'maps/create-google-map.js'
     ], 'public/js/maps/create-google-map.js')

     .scripts([
         'dropzone.forms.js'
     ], 'public/js/dropzone.forms.js')

     .scripts([
         'dropzone.flyer.js'
     ], 'public/js/dropzone.flyer.js')

     .scripts([
         'libs/jquery.typeahead.min.js'
     ], 'public/js/libs/typeahead.js')


     .styles ([
      'sweetalert.css'
     ], 'public/css/libs/sweetalert.css')

     .styles ([
      'homenavigation.css'
     ], 'public/css/homenavigation.css')

     .styles ([
      'navigation.css'
     ], 'public/css/navigation.css')

     .styles ([
        'bootstrap.css'
     ], 'public/css/libs/bootstrap.css')

     .styles ([
        'jquery.typeahead.min.css'
     ], 'public/css/libs/typeahead.css');

});