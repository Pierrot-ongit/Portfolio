var ColorPalette = function(pen)
{
    this.canvas = document.getElementById("color-palette");
    this.context = this.canvas.getContext("2d");
    this.pen = pen;

    //A la construction de mon objet, ça crée le dégradé de couleur
    this.build();
    /* TODO */

    //Mettre en place l'événement quand je clique sur la palette
    this.canvas.addEventListener("click", this.onSelectColor.bind(this));

     //Créer la méthode qui sera appelée quand on clique sur la palette (onSelectColor)
    /*

     - Récupérer les coordonnées de la souris dans le canvas (cf getMouseLocation dans Slate.class.js)
     - Récupérer les composantes de la couleur choisie (http://www.html5canvastutorials.com/advanced/html5-canvas-get-image-data-tutorial/)

     */

    //Modifier le crayon de notre programme avec la couleur choisie

};

ColorPalette.prototype.onSelectColor = function(event)
{
    //Les coordonnées dans le canvas par rapport à la position de la souris
    var location = this.getMouseLocation(event);


    // http://www.html5canvastutorials.com/advanced/html5-canvas-get-image-data-tutorial
    // http://www.w3schools.com/TAGS/canvas_getimagedata.asp
    var color = this.context.getImageData(location.x, location.y, 1, 1);
    console.log(color); //The color/alpha information is held in an array, and is stored in the data property of the ImageData object.

    var rgb = 'rgb(' + color.data[0] + ', ' + color.data[1] + ', ' + color.data[2] + ')';
    console.log(rgb);

    this.pen.color = rgb;
    console.log(this.pen.color)

};
/**
 * Récupère la position de la souris dans le canvas
 *
 * @return Position de la souris
 */
ColorPalette.prototype.getMouseLocation = function(event)
{
    var rectangle = this.canvas.getBoundingClientRect();

    //Les coordonnées dans le canvas par rapport à la position de la souris
    return {
        x: event.clientX - rectangle.x,
        y: event.clientY - rectangle.y
    };

};

/**
 * Créer la méthode pour montrer le canvas de dégradés
 *
 */

ColorPalette.prototype.onShowPalette = function()
{
    //var canvas = document.getElementById("color-palette"); // Non nécessaire car définis en propriétés

   // console.log(this.canvas); //Element html, propriété de la classe ColorPalette

    //Affichage de la palette de couleur
    //$(this.canvas).toggle(); //Utilise jQuery

    this.canvas.classList.toggle('hide'); //javascript
}


/**
 * Créer la méthode pour créer le dégradé de couleurs.
 *
 */
ColorPalette.prototype.build = function()
{
    /*
    http://www.html5canvastutorials.com/tutorials/html5-canvas-linear-gradients/
     To create a linear gradient with HTML5 Canvas, we can use the createLinearGradient() method.
     Linear gradients are defined by an imaginary line which defines the direction of the gradient.
     Once we've created our gradient, we can insert colors using the addColorStop property.
     The direction of the linear gradient moves from the starting point to the ending point of the imaginary line defined with createLinearGradient().
     In this tutorial, we've used two color stops, a light blue that originates at the starting point of the gradient, and a dark blue that ends with the ending point.
     Color stops are placed along the imaginary line somewhere between 0 and 1, where 0 is at the starting point, and 1 is at the ending point.
    */

    //Création du dégradé de couleur

     // Dégradé rouge -> vert -> bleu horizontal.
     var gradient = this.context.createLinearGradient(0, 0, this.canvas.width, 0);

     gradient.addColorStop(0,    'rgb(255,   0,   0)');
     gradient.addColorStop(0.15, 'rgb(255,   0, 255)');
     gradient.addColorStop(0.32, 'rgb(0,     0, 255)');
     gradient.addColorStop(0.49, 'rgb(0,   255, 255)');
     gradient.addColorStop(0.66, 'rgb(0,   255,   0)');
     gradient.addColorStop(0.83, 'rgb(255, 255,   0)');
     gradient.addColorStop(1,    'rgb(255,   0,   0)');

     //Application du dégradé
     this.context.fillStyle = gradient;
     this.context.fillRect(0, 0, this.canvas.width, this.canvas.height);

     // Dégradé blanc opaque -> transparent -> noir opaque vertical.
     gradient = this.context.createLinearGradient(0, 0, 0, this.canvas.height);

     gradient.addColorStop(0,   'rgba(255, 255, 255, 1)');
     gradient.addColorStop(0.5, 'rgba(255, 255, 255, 0)');
     gradient.addColorStop(0.5, 'rgba(0,     0,   0, 0)');
     gradient.addColorStop(1,   'rgba(0,     0,   0, 1)');

     //Application du dégradé
     this.context.fillStyle = gradient; //Ce qu'il va dessiner
     this.context.fillRect(0, 0, this.canvas.width, this.canvas.height); //Dessin
};