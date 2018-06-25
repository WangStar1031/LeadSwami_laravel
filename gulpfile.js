var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass([
        'sidebar.scss',
        'topbar.scss',
        'account.scss',
        'authZapier.scss',
        'welcome.scss',
        'payment.scss',
        'profiles.scss',
        'subscription.scss',
        // ]).styles([
        'bootstrap.min.scss',
        'switch_button.scss'
        ]);

    mix.copy('resources/assets/js/jquery.inputmask.bundle.js', 'public/js/jquery.inputmask.bundle.js');
    mix.copy('resources/assets/js/jquery.min.js', 'public/js/jquery.min.js');
    mix.copy('resources/assets/js/bootstrap.js', 'public/js/bootstrap.js');
    mix.scripts([
        'account.js',
        // 'bootstrap.js',
        // 'jquery.inputmask.bundle.js',
        // 'jquery.min.js',
        'payment.js',
        'profiles.js'
        ]);
   	// mix.copy('bower_components/font-awesome/fonts', 'public/assets/fonts');
   	// mix.styles([
    //     'bower_components/bootstrap/dist/css/bootstrap.css',
    //     'bower_components/fontawesome/css/font-awesome.css',
    //     'resources/css/sb-admin-2.css',
    //     'resources/css/timeline.css'
    // ], 'public/assets/stylesheets/styles.css', './');
    // mix.scripts([
    //     'bower_components/jquery/dist/jquery.js',
    //     'bower_components/bootstrap/dist/js/bootstrap.js',
    //     'bower_components/Chart.js/Chart.js',
    //     'bower_components/metisMenu/dist/metisMenu.js',
    //     'resources/js/sb-admin-2.js',
    //     'resources/js/frontend.js'
    // ], 'public/assets/scripts/frontend.js', './');
});


