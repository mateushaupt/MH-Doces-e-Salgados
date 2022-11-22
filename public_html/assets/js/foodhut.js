/*!
=========================================================
* FoodHut Landing page
=========================================================

* Copyright: 2019 DevCRUD (https://devcrud.com)
* Licensed: (https://devcrud.com/licenses)
* Coded by www.devcrud.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
*/

// smooth scroll
$(document).ready(function(){
    $(".navbar .nav-link").on('click', function(event) {

        if (this.hash !== "") {

            event.preventDefault();

            var hash = this.hash;

            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 700, function(){
                window.location.hash = hash;
            });
        } 
    });

});

function undisplayCadastro() {
    document.getElementById("homePage").style.display = "block";
    document.getElementById("cadastro").style.display = "none";
    document.getElementById("about").style.display = "block";
    document.getElementById("pedido").style.display = "block";
    document.getElementById("testimonial").style.display = "block";
    document.getElementById("contact").style.display = "block";
    document.getElementById("login").style.display = "none";
    
    
}

function undisplayLogin() {
    document.getElementById("homePage").style.display = "block";
    document.getElementById("login").style.display = "none";
    document.getElementById("about").style.display = "block";
    document.getElementById("pedido").style.display = "block";
    document.getElementById("testimonial").style.display = "block";
    document.getElementById("contact").style.display = "block";
    document.getElementById("cadastro").style.display = "none";
    
    
}

function displayLogin() {
    document.getElementById("login").style.display = "block";
    document.getElementById("cadastro").style.display = "none";
    document.getElementById("homePage").style.display = "none";
    document.getElementById("about").style.display = "none";
    document.getElementById("pedido").style.display = "none";
    document.getElementById("testimonial").style.display = "none";
    document.getElementById("contact").style.display = "none";
    
    
}

function displayCadastro() {
    document.getElementById("cadastro").style.display = "block";
    document.getElementById("login").style.display = "none";
    document.getElementById("homePage").style.display = "none";
    document.getElementById("about").style.display = "none";
    document.getElementById("pedido").style.display = "none";
    document.getElementById("testimonial").style.display = "none";
    document.getElementById("contact").style.display = "none";
    
}


new WOW().init();

function initMap() {
    var uluru = {lat: 29.26134, lng: 51.30406};
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 8,
      center: uluru
    });
    var marker = new google.maps.Marker({
      position: uluru,
      map: map
    });
 }
