// https://developer.mozilla.org/fr/docs/Web/API/Element/getBoundingClientRect
'use strict';

//Initialisation de jQuery

/*
 * Installation d'un gestionnaire d'évènement déclenché quand l'arbre DOM sera
 * totalement construit par le navigateur.
 *
 * Le gestionnaire d'évènement est une fonction anonyme que l'on donne directement à jQuery.
 */
$(function(){

    console.log("Tous les éléments du DOM sont bien chargés");

    var magicalSlate = new Program();
    magicalSlate.start();

});
