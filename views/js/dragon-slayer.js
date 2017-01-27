'use strict';   // Mode strict du JavaScript

/*************************************************************************************************/
/* **************************************** DONNEES JEU **************************************** */
/*************************************************************************************************/

var game;
var counter = 1;
var pvDragon;
var pvJoueur;
var armor;
var armorName;
var sword;
var swordName;
var difficulty;

function initialize()
{
	game = {};
    
    game.level = requestInteger("Choisissez le niveau de difficulté : 1 pour facile, 2 pour moyen, 3 pour difficile", 1, 3);
    game.sword = requestInteger("Choisissez votre épée : 1 pour bois, 2 pour acier et 3 pour excalibur", 1, 3);
    game.armor = requestInteger("Choisissez votre armure : 1 pour cuivre, 2 pour fer et 3 pour magique",1 , 3);
    switch (game.level) {
	case 1 :
		pvJoueur = getRandomInteger(200, 250);
		pvDragon = getRandomInteger(150, 200);
		difficulty = 'facile';
		break;
	case 2:
		pvJoueur = getRandomInteger(200, 250);
		pvDragon = getRandomInteger(200, 250);
		difficulty = 'moyen';
		break;
	case 3 :
		pvJoueur = getRandomInteger(150, 200);
		pvDragon = getRandomInteger(200, 250);
		difficulty = 'difficile';
		break;			
	}

	switch (game.armor) {
	case 1 :
		armor = 1;
		armorName = 'cuivre';
		break;
	case 2 :
		armor = 3;
		armorName = 'fer';
		break;
	case 3 :
		armor = 5;
		armorName = 'magique';
		break;	
	}



	switch (game.sword) {
		case 1 :
			sword = 1;
			swordName = 'bois';
			break;
		case 2 :
			sword = 3;
			swordName = 'acier';
			break;
		case 3 :
			sword = 5;
			swordName = 'excalibur';
			break;
	}
}







/*************************************************************************************************/
/* *************************************** FONCTIONS JEU *************************************** */
/*************************************************************************************************/




// fonction attaque joueur
var degatsJoueur;
function attackJoueur(){
	degatsJoueur = getRandomInteger(sword, 15);
	pvDragon= pvDragon - degatsJoueur;
	console.log('Vous êtes plus rapide et frappez le dragon, vous lui enlevez ' + degatsJoueur + ' PV');
	return pvDragon;
}


// fonction attaque dragon
var degatsDragon;
function attackDragon(){
	degatsDragon = (getRandomInteger(5, 15) - armor);
	pvJoueur = pvJoueur - degatsDragon;
	console.log('Le dragon est plus rapide et vous brûle, il vous enlève ' + degatsDragon + ' PV');
	return pvJoueur;
}

// function choix tour attaque
var tourVainqueur;
var textAttack;


function tour(){
	var tourJoueur = getRandomInteger(1, 20);
	var tourDragon = getRandomInteger(1, 20);

	if (tourJoueur > tourDragon){
		tourVainqueur = "Joueur";
		attackJoueur();
		textAttack = document.createTextNode('Vous êtes plus rapide et frappez le dragon, vous lui enlevez ' + degatsJoueur + ' PV');
	}

	else {
		tourVainqueur = "Dragon";
		attackDragon();
		textAttack = document.createTextNode('Le dragon est plus rapide et vous brûle, il vous enlève ' + degatsDragon + ' PV');
	}
	//return textAttack;
}

//function afficher pv
function affichagePV(){
	console.log('Dragon : ' + pvDragon + ' PV, joueur : ' + pvJoueur + ' PV');
}


function writeLog () {

	var node = document.createElement("LI");
	var retourLigne = document.createElement("br");
	//Le numéro du tour
	node.appendChild(document.createElement("br"));
	var textCounter = document.createTextNode('Tour numéro : ' + counter);
	node.appendChild(textCounter);
	node.appendChild(document.createElement("br"));
	
	//Les attacks
	node.appendChild(textAttack);
	node.appendChild(document.createElement("br"));

	//Les PV
	var textPV = document.createTextNode('Dragon : ' + pvDragon + ' PV, Joueur : ' + pvJoueur + ' PV');
	node.appendChild(textPV);
	node.appendChild(document.createElement("br"));

	// On ajoute la node qui contient l'ensemble du texte du tour.
	document.querySelector('.panel-body>ul').appendChild(node);

}
function writePV(){
	document.getElementById('pvJoueur').innerHTML = pvJoueur ;
	document.getElementById('pvMonster').innerHTML = pvDragon ;
}

function writeLaunching()
{
    document.querySelector('.panel-body>ul').innerHTML = ""; // Reset du log de combat
    document.getElementById('result').classList.add('hide'); // Cache du résultat si une partie a déjà était jouée
	writePV();
	document.getElementById('difficulty').innerHTML = difficulty ;
	document.getElementById('sword').innerHTML = swordName ;
	document.getElementById('armor').innerHTML = armorName ;

}

/*************************************************************************************************/
/* ************************************** CODE PRINCIPAL *************************************** */
/*************************************************************************************************/
$(function(){
	$('#launch').on("click", Launching);
	$('#one_tour').on("click", OneTour);
	$('#automatic').on("click", Automatic);
});


function Launching()
{
	initialize();
	writeLaunching();
	console.log(game);
	console.log("Points de vie de départ :");
	affichagePV();
}

function OneTour()
{
    if (game)
    {
        console.log('Tour numéro ' + counter);
        tour();
        affichagePV();
        writeLog();
        writePV();
        counter++
        if (pvDragon <= 0) {
            console.log('Vous avez vaincu le dragon !!');
            document.getElementById('result').classList.toggle('hide');
            document.getElementById('result').innerHTML = 'Vous avez terrassez le dragon !!' ;
        }

        else if (pvJoueur <= 0) {
            console.log('Vous êtes mort !!');
            document.getElementById('result').classList.toggle('hide');
            document.getElementById('result').innerHTML = 'Vous êtes mort !!' ;
        }
    }
    else
	{
		window.alert("Veuillez d'abord initialiser la partie en cliquant sur le bouton 'Commencez la partie!' ")
	}
}

function Automatic()
{
	if(!game)
    {
        window.alert("Veuillez d'abord initialiser la partie en cliquant sur le bouton 'Commencez la partie!' ")
    }
	else
	{
        do
        {
            console.log('Tour numéro ' + counter);
            tour();
            affichagePV();
            writeLog();
            writePV();
            counter++
        }

        while (pvDragon > 0 && pvJoueur > 0);

        if (pvDragon <= 0) {
            console.log('Vous avez vaincu le dragon !!');
            document.getElementById('result').classList.toggle('hide');
            document.getElementById('result').innerHTML = 'Vous avez terrassez le dragon !!' ;
        }

        else if (pvJoueur <= 0) {
            console.log('Vous êtes mort !!');
            document.getElementById('result').classList.toggle('hide');
            document.getElementById('result').innerHTML = 'Vous êtes mort !!' ;
        }
	}

}




