const $ = require('jquery');
global.$ = global.jQuery = $;

require('../css/app.css');
require('materialize-css');
require('materialize-css/dist/js/materialize');
require('../sass/sass.scss');

$(window).on('load', function () {


    $('#preloader').delay(400).fadeOut('slow');
    $('#loader')
        .delay(350)
        .fadeOut();

    setTimeout(function () {
        $('#homePage').show();
        $('.tap-target').tapTarget();
        $('.tap-target').tapTarget('open');
        $('.carousel.carousel-slider').carousel();
        $('.carousel.carousel-slider').carousel({
            fullWidth: true
        });
        $('.modal').modal();
        $('.modal').modal({
            inDuration: 450,
            outDuration: 450,
            preventScrolling: true
        });
        $('.sidenav').sidenav();

        $('.scrollspy').scrollSpy();
        $('.scrollspy').scrollSpy({
            offset: 70
        });
    }, 600);



});
$(window).scroll(function(){
    var wScroll = $(this).scrollTop();
    $('.main_pageL').css({
        'transform' : 'translate(0px, '+wScroll/2-'%)'
    });
    $('.main_pageB1').css({
        'transform' : 'translate(0px, -'+wScroll/300+'%)'
    });
    $('.main_pageB2').css({
        'transform' : 'translate(0px, '+wScroll/30+'%)'
    });
    $('.main_fill').css({
        'transform' : 'translate(0px, '+wScroll/190+'%)'
    });

});
