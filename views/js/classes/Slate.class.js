var Slate = function(pen)
{

    //Construction de l'ardoise
    this.canvas = document.getElementById("slate");
    this.context = this.canvas.getContext("2d");
    this.isDrawing = false; //Est-ce que j'ai le droit de dessiner ?

    //Position actuelle de la souris
    //Null tant qu'on a pas commencé à dessiner
    this.currentLocation = null;

    //Crayon qui dessine sur l'ardoise
    this.pen = pen;

    this.canvas.addEventListener("mousemove", this.onMouseMove.bind(this));
    this.canvas.addEventListener("mousedown", this.onMouseDown.bind(this));
    this.canvas.addEventListener("mouseup", this.onMouseUp.bind(this));
    this.canvas.addEventListener("mouseleave", this.onMouseLeave.bind(this));
};

/*
 * Fonction onMouseMove
 */
Slate.prototype.onMouseMove = function(event)
{
    //Est-ce que j'ai le droit de dessiner ?
    //Si oui j'effectue le code qui dessine
    //Sinon je ne fais rien du tout
    if(this.isDrawing)
    {

        //Remplacé par getMouseLocation
        /*
        // Infos sur le canvas lui même (en tant qu'élément HTML dans son entier) . Sa position x et y par xemple, width et height aussi.
        var rectangle = this.canvas.getBoundingClientRect();

        //Les coordonnées dans le canvas par rapport à la position de la souris
        var x = event.clientX - rectangle.x;
        var y = event.clientY - rectangle.y;
           */

        //Dernière position de la souris par rapport à l'élément canvas
        var location = this.getMouseLocation(event);

        this.context.beginPath();

        //Choix de l'épaisseur
        this.context.lineWidth = this.pen.size;

        //Choix de la couleur
        this.context.strokeStyle = this.pen.color;

        //Dessin
        this.context.moveTo(this.currentLocation.x, this.currentLocation.y);
        this.context.lineTo(location.x, location.y);
        this.context.stroke();
        //this.context.closePath();

        //Je mets à jour avec la dernière position de la souris
        this.currentLocation = location;
    }
};

Slate.prototype.onMouseDown = function(event)
{

    //Remplacé par getMouseLocation
    /*
     var rectangle = this.canvas.getBoundingClientRect();

     //Les coordonnées dans le canvas par rapport à la position de la souris
     var x = event.clientX - rectangle.x;
     var y = event.clientY - rectangle.y;
     */

    //Les coordonnées dans le canvas par rapport à la position de la souris

    //On commence à dessiner
    //Donc on stocke la position de la souris dans le canvas
    this.currentLocation = this.getMouseLocation(event);

    this.isDrawing = true;//J'ai cliqué sur la souris, je peux donc dessiner

};
Slate.prototype.onMouseUp = function()
{
    this.isDrawing = false;
};
Slate.prototype.onMouseLeave = function()
{
    this.isDrawing = false;
};

/**
 * Récupère la position de la souris dans le canvas
 *
 * @return Position de la souris
 */
Slate.prototype.getMouseLocation = function(event)
{
    // Récupération des coordonnées de l'ardoise.
    var rectangle = this.canvas.getBoundingClientRect();

    //Les coordonnées dans le canvas par rapport à la position de la souris
    // Création d'un objet contenant les coordonnées X,Y de la souris relative à l'ardoise.
    return {
        x: event.clientX - rectangle.left,
        y: event.clientY - rectangle.top
    };

};

/**
 * Créer la méthode onClearCanvas
 *
 */
Slate.prototype.onClearCanvas = function()
{
    console.log(this.slate);

    /*
     To clear the HTML5 Canvas, we can use the clearRect() method to clear the canvas bitmap.
       This performs much better than other techniques for clearing the canvas, such as resetting the canvas width and height, or destroying the canvas element and then recreating it.
     */
    this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
};

/**
 * Créer la méthode onSaveCanvas
 */
Slate.prototype.onSaveCanvas = function()
{
    $("#drawing>img").attr("src", this.canvas.toDataURL());
    document.getElementById('drawing').classList.toggle('hide');
    /*  Version détaillé
    // save canvas image as data url (png format by default)
    var dataURL = this.canvas.toDataURL();
    console.log(dataURL);

    // set canvasImg image src to dataURL
    // so it can be saved as an image
    document.getElementById('drawing').classList.toggle('hide');
    console.log(document.querySelector('#drawing>img'));
    document.querySelector('#drawing>img').src = dataURL;
    */
};