	/**********************/
	/*    	Nav bar      */
	/********************/

$(document).ready(function(){
  $('.navbar-fostrap').click(function(){
    $('.nav-fostrap').toggleClass('visible');
    $('body').toggleClass('cover-bg');
  });
});

	/**********************/
	/*	Client carousel   */
	/**********************/
	$('.carousel-client').bxSlider({
		auto: true,
	    slideWidth: 400,
	    minSlides: 1,
	    maxSlides: 7,
	    controls: false
	});

	/*
  ____     ____   ____     ___    _       _     
 / ___|   / ___| |  _ \   / _ \  | |     | |    
 \___ \  | |     | |_) | | | | | | |     | |    
  ___) | | |___  |  _ <  | |_| | | |___  | |___ 
 |____/   \____| |_| \_\  \___/  |_____| |_____|
                                                 
 */

/*Scroll du bouton pour remonter la page web*/

$(function () {
    $('body').append(
        '<div id="fleche"><i class="fas fa-arrow-circle-up"></i></div>'
    );
    $(window).scroll(function () {
        if ($(this).scrollTop() > 173) {
            /* si l'espace depuis le haut est supérieur à 86px */
            $('#fleche').fadeIn(); /* alors apparition du boutton */
        } else {
            $('#fleche').fadeOut(200); /* sinon il disparaît */
        }
    });
    $('#fleche').click(function () {
        $('html, body').animate({
            scrollTop: 0
        }, 900);
        return false;
    });
});

/*
  ____    _____    ____   _____  __  __
 |  _ \  | ____|  / ___| | ____| \ \/ /
 | |_) | |  _|   | |  _  |  _|    \  / 
 |  _ <  | |___  | |_| | | |___   /  \ 
 |_| \_\ |_____|  \____| |_____| /_/\_\
 */

var mail = document.getElementById("disc");
var emailOk = 0;
var indexEmo;
var RegMail = /^[a-zA-Z0-9_\-]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/;

if(mail === null){

}else{
    mail.onkeyup = function () {
        smiley(this)
    };
}

/*Modification du Smiley utiliser en fonction de l'état de la REGEX */
function smiley(id) {
    var this_id = id.id;
    var val;

    if (this_id === "disc") {
        val = id.value;
        indexEmo = document.getElementById("I_disc");
        if ((RegMail.exec(val))) {
			indexEmo.classList.remove("normal");
			indexEmo.classList.remove("rouge");
            indexEmo.classList.add("vert");
            nomOk = 1;
        } else if (val == "") {
			indexEmo.classList.remove("vert");
			indexEmo.classList.remove("rouge");
			indexEmo.classList.add("normal");
            nomOk = 0;
        } else {
			indexEmo.classList.remove("normal");
			indexEmo.classList.add("rouge");
			indexEmo.classList.remove("vert");
            nomOk = 0;

        }
    }
}

 /*Contrôle de l'adresse Email */
 function email() {
    var RegMail = /^[a-zA-Z0-9_\-]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/;
    var email = document.getElementById("disc").value;

    if ((RegMail.exec(email))) {
        alert("Email Valide");
    } else {
        alert("Email non Valide");
    }

}