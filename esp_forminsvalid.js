// RECUP POSTS FORMULAIRE INSCRIPTION
var InsclientNom = document.getElementById('InsclientNom');
var InsclientPrenom = document.getElementById('InsclientPrenom');
var InsclientAdresse = document.getElementById('InsclientAdresse');
var InsclientVille = document.getElementById('InsclientVille');
var InsclientCodeP = document.getElementById('InsclientCodeP');
var InsclientTel = document.getElementById('InsclientTel');
var InsclientMail = document.getElementById('InsclientMail');
var InsclientType = document.getElementById('InsclientType');
var InsclientSiret = document.getElementById('InsclientSiret');

// RECUP POSTS FORMULAIRE INSCRIPTION PASS
var InsclientPass = document.getElementById('InsclientPass');
var InsclientPassV = document.getElementById('InsclientPassV');

// RECUP POST DU FORMULAIRE INSCRIPTION
var formIns = document.getElementById('formInsclient');

// RECUP POST BOUTON ENVOIE FORMULAIRE INSCRIPTION
var buttonIns = document.getElementById('buttonIns');

// RECUP SPAN ERREUR FORMULAIRE INSCRIPTION
var missInsclientNom = document.getElementById('missInsclientNom');
var missInsclientPrenom = document.getElementById('missInsclientPrenom');
var missInsclientAdresse = document.getElementById('missInsclientAdresse');
var missInsclientVille = document.getElementById('missInsclientVille');
var missInsclientCodeP = document.getElementById('missInsclientCodeP');
var missInsclientTel = document.getElementById('missInsclientTel');
var missInsclientMail = document.getElementById('missInsclientMail');
var missInsclientType = document.getElementById('missInsclientType');
var missInsclientSiret = document.getElementById('missInsclientSiret');

// RECUP SPAN ERREUR FORMULAIRE PASS INSCRIPTION
var missInsclientPass = document.getElementById('missInsclientPass');
var missInsclientPassV = document.getElementById('missInsclientPassV');

// INITIALISATION DES REGEX
var nomValid = /^([A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]{1,15})[-\'\s]{0,1}([A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]{1,15})[-\s]{0,1}([A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]{1,15})$/;
var adresseValid = /^(?:([0-9]{0,4}[A-Z]{0,2})([,\s]?))(?:((bis|ter|qua)[\s,-])?)([A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'"\-\s]{0,50}[\s]*)([0-9]{0,5})$/;
var villeValid = /^[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'"-\/\s]{1,40}$/;
var codepValid = /^((0[1-9])|([1-8][0-9])|(9[0-8])|(2A)|(2B)) *([0-9]{3})?$/;
var telValid = /^([\d]{2})([\s.]?)([\d]{2})([\s.]?)([\d]{2})([\s.]?)([\d]{2})([\s.]?)([\d]{2})([\s.]?)$/;
var mailValid = /([a-zA-Z0-9-_]{1,20})+(\.[a-zA-Z0-9-_]{1,20})*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]{1,20})*\.[a-zA-Z]{2,4}/;
var siretValid = /^[\d]{1,14}$/;
var passwordValid = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;

// INITIALISATION DES COMPORTEMENTS DES INPUTS
InsclientNom.onkeyup = InsclientNomCheck;
InsclientPrenom.onkeyup = InsclientPrenomCheck;
InsclientAdresse.onkeyup = InsclientAdresseCheck;
InsclientVille.onkeyup = InsclientVilleCheck;
InsclientCodeP.onkeyup = InsclientCodePCheck;
InsclientTel.onkeyup = InsclientTelCheck;
InsclientMail.onkeyup = InsclientMailCheck;

InsclientSiret.onkeyup = InsclientSiretCheck;
InsclientPass.onkeyup = InsclientPassCheck;
InsclientPassV.onkeyup = InsclientPassVCheck;

// AU CLIQUE DU SUBMIT, METHODE ENVOIE APPELLEE
buttonIns.onclick = envoie;

// MISE EN PLACE DES FLAGS D'ERREUR
var flagInsclientNom = 0;
var flagInsclientPrenom = 0;
var flagInsclientAdresse = 0;
var flagInsclientVille = 0;
var flagInsclientCodeP = 0;
var flagInsclientTel = 0;
var flagInsclientMail = 0;
var flagInsclientType = 0;
var flagInsclientSiret = 0;
var flagPasswordIns = 0;
var flagValidPasswordIns = 0;
var flagInsclientPass = 0;
var flagInsclientPassV = 0;
var flag = 0;

// FONCTION APPELLEE SI TOUS LES FLAGS SONT INITIALISES
function checkForm() {
    InsclientNomCheck();
    InsclientPrenomCheck();
    InsclientAdresseCheck();
    InsclientVilleCheck();
    InsclientCodePCheck();
    InsclientTelCheck();
    InsclientMailCheck();
    InsclientTypeCheck();
    InsclientSiretCheck();
    InsclientPassCheck();
    InsclientPassVCheck();
}

// TOUTES LES FONCTIONS QUI VERIFIENT LA CASSE DES INPUTS
function InsclientNomCheck() {
    if (InsclientNom.value == "") {
        event.preventDefault();
        missInsclientNom.textContent = 'Champ non renseigné';
        missInsclientNom.style.color = 'red';
        flagInsclientNom = 0;
    } else if (nomValid.test(InsclientNom.value) == false || !isNaN(InsclientNom.value)) {
        event.preventDefault();
        missInsclientNom.textContent = 'Format incorrect';
        missInsclientNom.style.color = 'red';
        flagInsclientNom = 0;
    } else {
        missInsclientNom.textContent = 'Ok';
        missInsclientNom.style.color = 'green';
        flagInsclientNom = 1;
    }
}

function InsclientPrenomCheck() {
    if (InsclientPrenom.value == "") {
        event.preventDefault();
        missInsclientPrenom.textContent = 'Champ non renseigné';
        missInsclientPrenom.style.color = 'red';
        flagInsclientPrenom = 0;
    } else if (nomValid.test(InsclientPrenom.value) == false || !isNaN(InsclientPrenom.value)) {
        event.preventDefault();
        missInsclientPrenom.textContent = 'Format incorrect';
        missInsclientPrenom.style.color = 'red';
        flagInsclientPrenom = 0;
    } else {
        missInsclientPrenom.textContent = 'Ok';
        missInsclientPrenom.style.color = 'green';
        flagInsclientPrenom = 1;
    }
}


function InsclientAdresseCheck() {
    if (InsclientAdresse.value == "") {
        event.preventDefault();
        missInsclientAdresse.textContent = 'Champ non renseigné';
        missInsclientAdresse.style.color = 'red';
        flagInsclientAdresse = 0;
    } else if (adresseValid.test(InsclientAdresse.value) == false) {
        event.preventDefault();
        missInsclientAdresse.textContent = 'Format incorrect';
        missInsclientAdresse.style.color = 'red';
        flagInsclientAdresse = 0;
    } else {
        missInsclientAdresse.textContent = 'Ok';
        missInsclientAdresse.style.color = 'green';
        flagInsclientAdresse = 1;
    }
}

function InsclientVilleCheck() {
    if (InsclientVille.value == "") {
        event.preventDefault();
        missInsclientVille.textContent = 'Champ non renseigné';
        missInsclientVille.style.color = 'red';
        flagInsclientVille = 0;
    } else if (villeValid.test(InsclientVille.value) == false) {
        event.preventDefault();
        missInsclientVille.textContent = 'Format incorrect';
        missInsclientVille.style.color = 'red';
        flagInsclientVille = 0;
    } else {
        missInsclientVille.textContent = 'Ok';
        missInsclientVille.style.color = 'green';
        flagInsclientVille = 1;
    }
}

function InsclientCodePCheck() {
    if (InsclientCodeP.value == "") {
        event.preventDefault();
        missInsclientCodeP.textContent = 'Champ non renseigné';
        missInsclientCodeP.style.color = 'red';
        flagInsclientCodeP = 0;
    } else if (codepValid.test(InsclientCodeP.value) == false) {
        event.preventDefault();
        missInsclientCodeP.textContent = 'Format incorrect';
        missInsclientCodeP.style.color = 'red';
        flagInsclientCodeP = 0;
    } else {
        missInsclientCodeP.textContent = 'Ok';
        missInsclientCodeP.style.color = 'green';
        flagInsclientCodeP = 1;
    }
}

function InsclientTelCheck() {
    if (InsclientTel.value == "") {
        event.preventDefault();
        missInsclientTel.textContent = 'Champ non renseigné';
        missInsclientTel.style.color = 'red';
        flagInsclientTel = 0;
    } else if (telValid.test(InsclientTel.value) == false) {
        event.preventDefault();
        missInsclientTel.textContent = 'Format incorrect';
        missInsclientTel.style.color = 'red';
        flagInsclientTel = 0;
    } else {
        missInsclientTel.textContent = 'Ok';
        missInsclientTel.style.color = 'green';
        flagInsclientTel = 1;
    }
}

function InsclientMailCheck() {
    if (InsclientMail.value == "") {
        event.preventDefault();
        missInsclientMail.textContent = 'Champ non renseigné';
        missInsclientMail.style.color = 'red';
        flagInsclientMail = 0;
    } else if (mailValid.test(InsclientMail.value) == false) {
        event.preventDefault();
        missInsclientMail.textContent = 'Format incorrect';
        missInsclientMail.style.color = 'red';
        flagInsclientMail = 0;
    } else {
        missInsclientMail.textContent = 'Ok';
        missInsclientMail.style.color = 'green';
        flagInsclientMail = 1;
    }
}

function InsclientTypeCheck(SelectValue) {
    var hideInsclientSiret = document.getElementById('hideInsclientSiret');

    if (SelectValue === 'PAR') {
        hideInsclientSiret.style.display = 'none';
        missInsclientType.textContent = 'Ok';
        missInsclientType.style.color = 'green';
        flagInsclientType = 1;
    }
    else if (SelectValue === 'PRO') {
        hideInsclientSiret.style.display = 'block';
        missInsclientType.textContent = 'Ok';
        missInsclientType.style.color = 'green';
        flagInsclientType = 1;
    }
    else if (SelectValue === '0'){
        hideInsclientSiret.style.display = 'none';
        missInsclientType.textContent = 'Champ non renseigné';
        missInsclientType.style.color = 'red';
        flagInsclientType = 0;
    }
}

function InsclientSiretCheck() {
    if (InsclientSiretCheck.value == "") {
        event.preventDefault();
        missInsclientSiret.textContent = 'Champ non renseigné';
        missInsclientSiret.style.color = 'red';
        flagInsclientSiret = 0;
    } else if (siretValid.test(InsclientSiret.value) == false) {
        event.preventDefault();
        missInsclientSiret.textContent = 'Format incorrect';
        missInsclientSiret.style.color = 'red';
        flagInsclientSiret = 0;
    } else {
        missInsclientSiret.textContent = 'Ok';
        missInsclientSiret.style.color = 'green';
        flagInsclientSiret = 1;
    }
}

function InsclientPassCheck() {
    if (InsclientPass.value == "") {
        event.preventDefault();
        missInsclientPass.textContent = 'Champ non renseigné';
        missInsclientPass.style.color = 'red';
        flagInsclientPass = 0;
    } else if (passwordValid.test(InsclientPass.value) == false) {
        event.preventDefault();
        missInsclientPass.textContent = 'Format incorrect';
        missInsclientPass.style.color = 'red';
        flagInsclientPass = 0;
    } else {
        missInsclientPass.textContent = 'Ok';
        missInsclientPass.style.color = 'green';
        flagInsclientPass = 1;
    }
}

function InsclientPassVCheck() {
    if (InsclientPassV.value == "") {
        event.preventDefault();
        missInsclientPassV.textContent = 'Champ non renseigné';
        missInsclientPassV.style.color = 'red';
        flagInsclientPassV = 0;
    } else if (passwordValid.test(InsclientPassV.value) == false) {
        event.preventDefault();
        missInsclientPassV.textContent = 'Format incorrect';
        missInsclientPassV.style.color = 'red';
        flagInsclientPassV = 0;
    } else {
        missInsclientPassV.textContent = 'Ok';
        missInsclientPassV.style.color = 'green';
        flagInsclientPassV = 1;
    }
}

// FONCTION ENVOIE APPELLEE A L'APPUI DU BOUTON S'INSCRIRE
function envoie() {

    flag = flagInsclientNom + flagInsclientPrenom + flagInsclientAdresse + flagInsclientVille + flagInsclientCodeP + flagInsclientTel + flagInsclientMail + flagInsclientType + flagInsclientSiret + flagInsclientPass + flagInsclientPassV;
    console.log(`flag ${flag}`);

    if (flag === 11) {

        formInsclient.submit();

    } else {
        console.log(`flagInsclientNom${flagInsclientNom} flagInsclientPrenom${flagInsclientPrenom} flagInsclientAdresse${flagInsclientAdresse} flagInsclientVille${flagInsclientVille} flagInsclientCodeP${flagInsclientCodeP} flagInsclientTel${flagInsclientTel} flagInsclientMail${flagInsclientMail} flagInsclientType${flagInsclientType} flagInsclientSiret${flagInsclientSiret} flagInsclientPass${flagInsclientPass} flagInsclientPassV${flagInsclientPassV}`);
        checkForm();
        alert('Veuillez vérifier les champs');

    }
}