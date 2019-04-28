const $ = require('jquery');

global.$ = global.jQuery = $;

require('../css/app.css');
require('materialize-css');
require('materialize-css/dist/js/materialize');
require('../sass/sass.scss');
const axios = require('axios/dist/axios');

global.axios = axios;

/*ajax register form*/
$('#registerFormContainer').on("submit",function (e) {
    e.preventDefault();
    var formData = new FormData(e.target);
    $('#RegisterLogin').show();
    axios.post('/api/register', formData).then((response)=>{
        console.log(response.data);
       if(response.status === 200){
           $('#RegisterLogin').hide();
           $('#registerFormContainer').html(response.data.form);
           $('select').formSelect();
       }else if(response.status === 202){
           $(location).attr('href','/');
       }
    })

});

/*ajax register form*/
/*ajax filter prop*/
var mainUrl = '/api/properties';
$('#property_filter_category_categoryName').on('change', function(e) {
    mainUrl = '/api/properties';
    $('#propFilterForm').submit();
});
$('#property_filter_featured_type').on('change', function(e) {
    mainUrl = '/api/properties';
    $('#propFilterForm').submit();
});
$('#property_filter_propName').on('keyup', function(e) {
    mainUrl = '/api/properties';
    $('#propFilterForm').submit();
});
$('#property_filter_propertyAddress_propCity').on('change', function(e) {
    mainUrl = '/api/properties';
    $('#propFilterForm').submit();
});
$('#property_filter_propertyAddress_propDistrict').on('change', function(e) {
    mainUrl = '/api/properties';
    $('#propFilterForm').submit();
});
$('#property_filter_propDetails_propBHK').on('change', function(e) {
    mainUrl = '/api/properties';
    $('#propFilterForm').submit();
});
$('#propFilterForm').on('submit',function (event) {

    var loader = "<div class=\"progress\">\n" +
        "      <div class=\"indeterminate\"></div>\n" +
        "  </div>";

    var formData = new FormData(event.target);
    $('#loaderProperties').html(loader);

    axios.post(mainUrl,formData).then((response)=>{
        console.log(response);
        $('#propertyContainer').html(response.data.property.content);
        $('select').formSelect();
        $('.carousel.carousel-slider').carousel();
        $('.card').css({'zIndex':0})
    });
    event.preventDefault();
});

/*ajax filter prop*/
/*ajax properties*/
$('#propertyContainer').on('click', function (e) {
    var loader = "<div class=\"progress\">\n" +
        "      <div class=\"indeterminate\"></div>\n" +
        "  </div>";
    let par = e.target.nodeName;
    console.log(par);
    if(par === 'I'){
        let Itag = $(e.target).parent();
        let url = Itag.attr('href');
        console.log(url);
        if(url && url!=='#!' && url.startsWith("/api/properties")){
            $('#loaderProperties').html(loader);
            mainUrl = url;
            $('#propFilterForm').submit();
        }
    }else if(par === 'A'){
        let url = e.target.getAttribute('href');
        if(url && url!=='#!' && url.startsWith("/api/properties")){
            $('#loaderProperties').html(loader);
            mainUrl = url;
            $('#propFilterForm').submit();
        }else if(url.startsWith("/view/property")){

            window.open(url,'_blank');

        }
    }
    e.preventDefault();
});

$(document).ready(function () {
    axios.get('/api/properties').then((response)=>{
        $('#propertyContainer').html(response.data.property.content);
        $('select').formSelect();
        $('.carousel.carousel-slider').carousel();
        $('.card').css({'zIndex':0})
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
        var d = $('.carousel.carousel-slider').carousel();
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
        $('.sidenav').sidenav({
            preventScrolling: false

        });
        $('.parallax').parallax();
        $('.scrollspy').scrollSpy();
        $('.scrollspy').scrollSpy({
            scrollOffset: 90
        });
        $('select').formSelect();
        $('.slider').slider();
        $('.slider').slider({
            interval: 3000,
            height: 600
        });
        $('.dropdown-trigger').dropdown();
        $('.dropdown-trigger').dropdown({
            alignment: 'right',
            hover: true
        })


    }, 600);


});
/* pre loading */

var header = $('header');

var range = 200;

$(window).on('scroll', function () {

    var scrollTop = $(this).scrollTop(),
        height = header.outerHeight(),
        offset = height / 1.1,
        calc = 1 - (scrollTop - offset + range) / range;

    header.css({ 'opacity': calc });

    if (calc > '1') {
        header.css({ 'opacity': 1 });

    } else if ( calc < '0' ) {

        header.css({ 'opacity': 0 });

    }

});

