/* 
Activité : jeu de devinette
*/

// NE PAS MODIFIER OU SUPPRIMER LES LIGNES CI-DESSOUS
// COMPLETEZ LE PROGRAMME UNIQUEMENT APRES LE TODO

console.log("Bienvenue dans ce jeu de devinette !");

//////// Données p'entrées du jeu //////
var counter = 0;
var saisie;
var choix =[];
var solution;
var level;
function requestInteger (message, min, max){
	var input;
	do 
		{
			input = parseInt(window.prompt(message));	
		}
	while (input < min || input > max || isNaN(input))
	return input;
}

function writeLog () {

	var node = document.createElement("LI");


	var textCounter = document.createTextNode('Tentative n° ' + counter);
	node.appendChild(textCounter);
	node.appendChild(document.createElement("br"));
	var textChoix = document.createTextNode('Nombre(s) choisis : ' + choix);
	node.appendChild(textChoix);
	node.appendChild(document.createElement("br"));
	node.appendChild(document.createElement("br"));

	// On ajoute la node qui contient l'ensemble du texte du tour.
	document.querySelector('.well>ul').appendChild(node);

	//On change le counter
	document.querySelector('.counter').innerHTML = (level - counter);
}


$(function(){
	$('#launch').on("click", Launching);
	$('#one_tour').on("click", OneTour);
});

////// Lancement du jeu ////

function Launching() {
	// Cette ligne génère aléatoirement un nombre entre 1 et 100
	solution = Math.floor(Math.random() * 100) + 1;
	console.log("(La solution est " + solution + ")");

	level = requestInteger("Choisissez le nombre de tentatives possibles entre 1 et 10",1 , 10);
	document.querySelector('.counter').innerHTML = level - counter;
	return level;
}

function OneTour() {

	saisie = requestInteger("Saisissez un nombre entre 1 et 100",1 , 100);
	choix.push(saisie);
	counter ++;
	writeLog();

	if (saisie == solution)
	{
		window.alert("Bravo, vous avez gagné !")
		console.log("Bravo, vous avez gagné !")
		document.querySelector('#result').innerHTML = "Bravo, vous avez gagné !";
	}

	else if (saisie != solution && counter < (level))
	{

		if (saisie > solution) {
			window.alert(saisie +" est trop grand");
			console.log(saisie +" est trop grand");
		}

		else if (saisie < solution) {
			window.alert(saisie +" est trop petit");
			console.log(saisie +" est trop petit");
		}
	}
	else // En gros la partie est terminé
	{
		window.alert("Vous avez perdu !")
		console.log("Vous avez perdu !")
		document.querySelector('#result').innerHTML = "Vous avez perdu !";
	}
}




