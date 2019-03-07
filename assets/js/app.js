const $ = require('jquery');
global.$ = global.jQuery = $;

require('../css/app.css');
require('materialize-css');
require('materialize-css/dist/js/materialize');
require('../sass/sass.scss');

$(window).on('load', function () {
    $('.preloader-background').delay(400).fadeOut('slow');

    $('.preloader-wrapper')
        .delay(350)
        .fadeOut();


    setTimeout(function () {
        $('.tap-target').tapTarget();
        $('.tap-target').tapTarget('open');
    }, 1000);

});