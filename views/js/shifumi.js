var tableau = ["pierre", "feuille", "ciseaux", "lézard", "spock"];
var choixJoueur;
var choixOrdi;
var resultat;

$(function(){
    $('#launch').on("click", Launching);
});

function Launching()
{
    console.log("test");
    document.getElementById('result').classList.remove('hide');
    choixJoueur = window.prompt("Pierre, Feuille, Ciseaux, Lézard, ou Spock ?");
    choixJoueur = choixJoueur.toLowerCase();
    choixOrdi = tableau[Math.floor(Math.random()*tableau.length)];

    if (choixOrdi == choixJoueur) {
        resultat = "Egalité !";
    }


    else {
        switch (choixOrdi) {
            case "ciseaux":
                if (choixJoueur == "lézard" || choixJoueur == "feuille"){
                    resultat = "Vous avez perdu !";
                }
                else {
                    resultat = "Vous avez gagné !"
                }
                break;
            case "pierre":
                if (choixJoueur == "lézard" || choixJoueur == "ciseaux"){
                    resultat = "Vous avez perdu !";
                }
                else {
                    resultat = "Vous avez gagné !"
                }
                break;
            case "feuille":
                if (choixJoueur == "spock" || choixJoueur == "pierre"){
                    resultat = "Vous avez perdu !";
                }
                else {
                    resultat = "Vous avez gagné !"
                }
                break;
            case "lézard":
                if (choixJoueur == "spock" || choixJoueur == "feuille"){
                    resultat = "Vous avez perdu !";
                }
                else {
                    resultat = "Vous avez gagné !"
                }
                break;
            case "spock":
                if (choixJoueur == "ciseaux" || choixJoueur == "pierre"){
                    resultat = "Vous avez perdu !";
                }
                else {
                    resultat = "Vous avez gagné !"
                }
                break;
        }
    }
    document.getElementById('choixJoueur').innerHTML = choixJoueur ;
    document.getElementById('choixOrdi').innerHTML = choixOrdi ;
    document.getElementById('resultat').innerHTML = resultat ;

}