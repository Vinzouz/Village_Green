var Choixlivraison = document.getElementById('Choixlivraison');

var Adresselivraison = document.getElementById('Adresselivraison');
var Villelivraison = document.getElementById('Villelivraison');
var Codepolivraison = document.getElementById('Codepolivraison');

var formCommande = document.getElementById('formCommande');

// RECUP POST BOUTON ENVOIE FORMULAIRE INSCRIPTION
var buttonComm = document.getElementById('buttonComm');

var missChoixlivraison = document.getElementById('missChoixlivraison');
var missAdresselivraison = document.getElementById('missAdresselivraison');
var missVillelivraison = document.getElementById('missVillelivraison');
var missCodepolivraison = document.getElementById('missCodepolivraison');

var adresseValid = /^(?:([0-9]{0,4}[A-Z]{0,2})([,\s]?))(?:((bis|ter|qua)[\s,-])?)([A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'"\-\s]{0,50}[\s]*)([0-9]{0,5})$/;
var villeValid = /^[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'"-\/\s]{1,40}$/;
var codepValid = /^((0[1-9])|([1-8][0-9])|(9[0-8])|(2A)|(2B)) *([0-9]{3})?$/;

// AU CLIQUE DU SUBMIT, METHODE ENVOIE APPELLEE
buttonComm.onclick = envoie;

var flagChoixlivraison = 0;
var flagAdresselivraison = 0;
var flagVillelivraison = 0;
var flagCodepolivraison = 0;
var flag = 0;



function ChoixlivraisonCheck(SelectValue) {
    var hidechoixlivraison = document.getElementById('hidechoixlivraison');

    if (SelectValue === 'Oui') {
        hidechoixlivraison.style.display = 'none';
        missChoixlivraison.textContent = 'Ok';
        missChoixlivraison.style.color = 'green';
        flagChoixlivraison = 1;
        flagAdresselivraison = 1;
        flagVillelivraison = 1;
        flagCodepolivraison = 1;
        flag = flagChoixlivraison + flagAdresselivraison + flagVillelivraison + flagCodepolivraison;
    }
    else if (SelectValue === 'Non') {
        hidechoixlivraison.style.display = 'block';
        missChoixlivraison.textContent = 'Ok';
        missChoixlivraison.style.color = 'green';
        flagChoixlivraison = 1;
        Adresselivraison.onkeyup = AdresselivraisonCheck;
        Villelivraison.onkeyup = VillelivraisonCheck;
        Codepolivraison.onkeyup = CodepolivraisonCheck;
        flag = flagChoixlivraison + flagAdresselivraison + flagVillelivraison + flagCodepolivraison;
    }
    else if (SelectValue === ''){
        hidechoixlivraison.style.display = 'none';
        missChoixlivraison.textContent = 'Champ non renseigné';
        missChoixlivraison.style.color = 'red';
        flagChoixlivraison = 0;
    }
}


function AdresselivraisonCheck() {
    if (Adresselivraison.value == "") {
        event.preventDefault();
        missAdresselivraison.textContent = 'Champ non renseigné';
        missAdresselivraison.style.color = 'red';
        flagAdresselivraison = 0;
    } else if (adresseValid.test(Adresselivraison.value) == false) {
        event.preventDefault();
        missAdresselivraison.textContent = 'Format incorrect';
        missAdresselivraison.style.color = 'red';
        flagAdresselivraison = 0;
    } else {
        missAdresselivraison.textContent = 'Ok';
        missAdresselivraison.style.color = 'green';
        flagAdresselivraison = 1;
    }
}

function VillelivraisonCheck() {
    if (Villelivraison.value == "") {
        event.preventDefault();
        missVillelivraison.textContent = 'Champ non renseigné';
        missVillelivraison.style.color = 'red';
        flagVillelivraison = 0;
    } else if (villeValid.test(Villelivraison.value) == false) {
        event.preventDefault();
        missVillelivraison.textContent = 'Format incorrect';
        missVillelivraison.style.color = 'red';
        flagVillelivraison = 0;
    } else {
        missVillelivraison.textContent = 'Ok';
        missVillelivraison.style.color = 'green';
        flagVillelivraison = 1;
    }
}

function CodepolivraisonCheck() {
    if (Codepolivraison.value == "") {
        event.preventDefault();
        missCodepolivraison.textContent = 'Champ non renseigné';
        missCodepolivraison.style.color = 'red';
        flagCodepolivraison = 0;
    } else if (codepValid.test(Codepolivraison.value) == false) {
        event.preventDefault();
        missCodepolivraison.textContent = 'Format incorrect';
        missCodepolivraison.style.color = 'red';
        flagCodepolivraison = 0;
    } else {
        missCodepolivraison.textContent = 'Ok';
        missCodepolivraison.style.color = 'green';
        flagCodepolivraison = 1;
    }
}

function envoie() {

    if (flag === 4) {

        formCommande.submit();

    } else {
        
        
        alert('Veuillez vérifier les champs');

    }
}