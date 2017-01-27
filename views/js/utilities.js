'use strict';   // Mode strict du JavaScript

/*************************************************************************************************/
/* *********************************** FONCTIONS UTILITAIRES *********************************** */
/*************************************************************************************************/


function getRandomInteger(a, b){
	var random = Math.random();
	random = Math.floor(random * (b - a + 1) + a);
	return random;
}


function showImage (filename) {
	document.write('<img src="../img/' + filename +'.jpg"/>');
}
//showImage("dragon");


function requestInteger (message, min, max){
	var input;
	do 
		{
			input = parseInt(window.prompt(message));	
		}

	while (input < min || input > max || isNaN(input))

	return input;	

}

//requestInteger("Niveau de difficulté : 1. Facile - 2. Normal - 3. Difficile", 1, 3)

function writeLog () {
	
	var node = document.createElement("LI");
	var textnode = document.createTextNode('Tour numéro : ' + counter);
	node.appendChild(textnode);
	document.querySelector('.panel-body>ul').appendChild(node);
	//document.querySelector('.panel-body>ul:last-child').innerHTML = '<p>Tour numéro : ' + counter + '</p>' ;
	
	// Create a <li> node
	//var node = document.createElement("LI");

	// Create a text node
	//var textnode = document.createTextNode("Water");

	// Append the text to <li>
	//node.appendChild(textnode);
	//$('.panel-body').document.write('test');
	// Append <li> to <ul> with id="myList"
	//document.getElementById("myList").appendChild(node);
}