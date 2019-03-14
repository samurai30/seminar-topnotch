const $ = require('jquery');

global.$ = global.jQuery = $;

require('../css/app.css');
require('materialize-css');
require('materialize-css/dist/js/materialize');
require('../sass/sass.scss');
const axios = require('axios/dist/axios');

/*ajax register form*/
$('#registerFormContainer').on("submit",function (e) {
    e.preventDefault();
    var formData = new FormData(e.target);
    axios.post('/api/register', formData).then((response)=>{
       if(response.status === 200){
           $('#registerFormContainer').html(response.data.form);

       }else if(response.status === 202){
           $(location).attr('href','/');
       }
    })

});


/*ajax register form*/


/*ajax properties*/

$('#propertyContainer').on('click', function (e) {
    var url = e.target.getAttribute('href');
    console.log(url);
    axios.post(url).then((response)=>{

        $('#propertyContainer').html(response.data.property.content);

    });

    e.preventDefault();
});

$(document).ready(function () {

    axios.post('/api/properties').then((response)=>{

        $('#propertyContainer').html(response.data.property.content);
        
    })
    
    
});

/*ajax properties*/

/* pre loading */
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

    }, 600);



});
/* pre loading */

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
