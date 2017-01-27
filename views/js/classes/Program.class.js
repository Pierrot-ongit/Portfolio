var Program = function()
{
    //Création d'un objet Pen
    this.pen = new Pen();

    //Création d'un objet Slate
    this.slate = new Slate(this.pen); // On lui donne le crayon à utiliser.

    //Création d'un objet ColorPalette
    this.colorPalette = new ColorPalette(this.pen);

};
/**
 * Méthode appartenant à la classe Program
 * Elle sert en tant que gestionnaire d'événements.
 *
 */
Program.prototype.start = function()
{
    console.log("Lancement du programme");

    //bind permet de préciser à quoi fera référence le mot clé "this"
    // On l'utilise pour choisir la class Program et non au bouton HTML
    $(".pen-size").on("click", this.onPickPenSize.bind(this));

    //Récupération des éléments qui ont la classe css pen-color
    //Mise en place du gestionnaire d'événements quand on clique sur un de ces éléments
    //bind permet de préciser à quoi fera référence le mot clé "this" dans la méthode onPickPenColor
    $(".pen-color").on("click", this.onPickPenColor.bind(this));

    // Event listener sur le bouton d'effaceur
    $("#tool-clear-canvas").on("click", this.slate.onClearCanvas.bind(this.slate));

    // Event listener sur le bouton pipette
    $("#tool-color-picker").on("click", this.colorPalette.onShowPalette.bind(this.colorPalette));

    // Event listener sur le bouton Save
    $("#tool-save-canvas").on("click", this.slate.onSaveCanvas.bind(this.slate));
};

/**
 * Créer la méthode onPickPenSize
 *
 */
Program.prototype.onPickPenSize = function(event)
{
    console.log("Une épaisseur de crayon a été choisie");

    //event est un objet qui contient des informations sur l'événement
    //uniquement disponible dans les fonctions appelées dans les gestionnaires d'événéments !
    // Objet qui représente lévénement
    //console.log(event);

    //Objet qui représente l'élément HTML (ici le bouton) sur lequel on a cliqué
    //console.log(event.currentTarget);

    //Je le stocke dans une variable
    var button = event.currentTarget;

    //Valeur de data-size du bouton

    //Syntaxe JavaScript
    //console.log(button.dataset.size);

    // ou Syntaxe jQuery
    //$(button).data("size");

    this.pen.size = $(button).data("size");

    //console.log($(this).data("size"));

    //La propriété pen de ma classe Program
    console.log(this.pen);
    console.log(this.pen.size);
};

/**
 * Créer la méthode onPickPenColor
 */
Program.prototype.onPickPenColor = function(event)
{
    console.log("Une couleur de crayon a été choisie");

    //This fait référence à l'objet magicalSlate (instance de Program) défini dans main.js
    //Et ça c'est grâce à bind
    //Sans bind, this fait référence à l'élément sur lequel a eu lieu l'événement
    console.log(this);


    //Elément sur lequel a eu lieu l'événement
    //Comme this ne fait plus référence à l'élément sur lequel a eu l'événement (car on a utilisé bind)
    //On utilise l'objet event pour le trouver
    var div = event.currentTarget;

    //Syntaxe jQuery
    this.pen.color = $(div).data("color");

    //Syntaxe javascript
    //this.pen.color = div.dataset.color;

    console.log(this.pen);
    console.log(this.pen.color);
};



