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
    var loader = "  <div class='container center'>\n" +
        "\n" +
        "\n" +
        "                <div class=\"preloader-wrapper big active\">\n" +
        "                    <div class=\"spinner-layer spinner-blue-only\">\n" +
        "                        <div class=\"circle-clipper left\">\n" +
        "                            <div class=\"circle\"></div>\n" +
        "                        </div><div class=\"gap-patch\">\n" +
        "                            <div class=\"circle\"></div>\n" +
        "                        </div><div class=\"circle-clipper right\">\n" +
        "                            <div class=\"circle\"></div>\n" +
        "                        </div>\n" +
        "                    </div>\n" +
        "                </div>\n" +
        "\n" +
        "            </div>";


    let par = e.target.nodeName;
    console.log(par);
    if(par === 'I'){
        let Itag = $(e.target).parent();
        let url = Itag.attr('href');
        if(url){
            $('#propertyContainer').html(loader);
            axios.post(url).then((response)=>{
                $('#propertyContainer').html(response.data.property.content);
            });
        }
    }else if(par === 'A'){
        let url = e.target.getAttribute('href');
        if(url){
            $('#propertyContainer').html(loader);
            axios.post(url).then((response)=>{
                $('#propertyContainer').html(response.data.property.content);
            });
        }
    }

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
        $('.parallax').parallax();
        $('.scrollspy').scrollSpy();
    }, 600);



});
/* pre loading */
