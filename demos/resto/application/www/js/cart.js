$(function(){
    // $('#AddCart').on("click", AddCart); // On sélectionne le formulaire même à la place.
    $("#order").on('submit', AddCart);

    // Event pour afficher le produit sélectionné
    $('#productName').on('change', MenuDisplay);
    // Pour l'afficher dés le lancement de la page.
    var valueSelected = document.getElementById("productName").value;
    $.get(getRequestUrl()+"/order/menu?nameProduct="+valueSelected, valueSelected,getMenuData);


    //Event pour gérer la suppresion d'items dans le panier
    $('body').on('click', ".remove", removeItem)

    //On passe à la page validation
    $("#validateCart").on('click', validateCart);

    // On annule la commande et vide le panier
    $(".button-cancel").on('click', clearLocalStorage)


});



function validateCart(event)
{
    event.preventDefault();
    console.log("test")
    var cart = loadDataFromDomStorage("cart");
    //console.log(cart)
    var products = {}
    //products.product1 = cart[1];
    for (var i = 0; i < cart.length; i++)
    {
        products[i] = cart[i]
    }
    //console.log(products)

    $.post(getRequestUrl()+"/order/payement", products, createOrder);
}

function clearLocalStorage()
{
    localStorage.clear();
}

function removeItem(event)
{

    event.preventDefault();
    var productId = $(this).attr('id');
    //console.log(productId); // gets the id of a clicked link that has a class of menu
    var cart = loadDataFromDomStorage("cart");

    for (var i = 0; i < cart.length; i++) {
        //console.log(cart[i][0].value)
        if (cart[i][1].value == productId)
        {
            console.log(productId);
            console.log(cart[i][1].value);
            cart.splice(cart.indexOf(cart[i]), 1);
        }
    }

    saveDataToDomStorage("cart", cart);
    writeCart();

}

function MenuDisplay(e)
{
    var valueSelected = this.value;
    //console.log(valueSelected);
    $.get(getRequestUrl()+"/order/menu?nameProduct="+valueSelected, valueSelected,getMenuData);

}

function MenuDisplayGuide(e)
{
    /**
     * *
     * Ceci est le guide pour l'affichage dynamique via Ajax du menu dans la page de commande.
     */

    // En premier lieu on récupère la valeur de l'option sélectionné.
    //var optionSelected = $("option:selected", this);
    //console.log(optionSelected);
    var valueSelected = this.value;
    console.log(valueSelected);

    // Ensuite on passe utilise la fonction $.get de Jquery.
    $.get(getRequestUrl()+"/order/menu?productId="+valueSelected, valueSelected,getProductData);

    // https://api.jquery.com/jquery.get/
    // jQuery.get( url [, data ] [, success ] [, dataType ] )
    //data = A plain object or string that is sent to the server with the request.
    // success = A callback function that is executed if the request succeeds.

    // La fonction getProductData est défini dans le fichier Ajax.js

    /**
     * Il va falloir ensuite créer un controller et une view qui correspondent à ladresse renseigné en premier paramètre
     * Le temps que l'on paramètre ces fichiers, vous pouvez vous rendre directement à l'url correspondante
     * Dans cet exemple cest : http://localhost/projet3wa/index.php/order/menu?productId=5
     * Dans le fichier MenuController.php
     *
     class MenuController
     {
         public function httpGetMethod(Http $http, array $queryFields)
         {

             $model = new ProductModel();
             $product = $model->findOne($queryFields['productId']);
             return [
                 'product'=> $product,
             ];
         }
     }
     *
     * Il faut bien sur avoir créer dans le ProductModel, une requete qui permet de sélectionner un produit avec l'id comme critère de sélection.
     * Le fichier ProductModel :

     public function findOne($id)
     {
         $db = new Database();
         $product = $db->queryOne('SELECT * FROM products WHERE id = ?', [$id]);
         return $product;
     }
     *
     * Et maintenant on peut régler la View, pour afficher le résultat contenu dans la variable product
     * Le fichier MenuView :
     <?= var_dump($product) ?>
     <div class="meal-details">
     <img src="<?= $wwwUrl ?>/images/meals/<?= $product['image'] ?>">
     <p><?= $product['description'] ?></p>
     <p class="number">Prix : <strong><?= $product['salePrice'] ?>€</strong></p>

     </div>
     */
    /**
     * Nous pouvons maintenant nous précoccuper du fichier Ajax.js
     *
     function getProductData(data)
     {
         console.log(data);
         $(".meal-details").html(data);
     }
     */

}



function AddCart(e)
{
    e.preventDefault();
    var product = $(this).serializeArray();
    var cart =loadDataFromDomStorage("cart");

    if(cart == null)
    {
        cart = [];
        cart.push(product);
    }
    else
    {
        for (var i = 0; i < cart.length; i++) {
            //console.log(cart[i][0].value)
            if (cart[i][0].value == product[0].value)
            {
                //console.log(product[0].value);
                //console.log(cart[i][0]);
                cart.splice(cart.indexOf(cart[i]), 1);
            }
        }
        cart.push(product);
    }

    saveDataToDomStorage("cart", cart);

    // Devenue inutile depuis l'ajout d'input hidden dans la 1ère requete ajax/
    //var productName = product[0]['value'];
    //$.get(getRequestUrl()+"/order/menu/detail?nameProduct="+productName, product, getProductData, "json");

    writeCart();

}



function AddCartGuide(e)
{
    /**
     * Ce guide est destiné à vous expliquer le fonctionnement de la fonction JS qui permet d'ajouter ce qu'on on a selectionné dans le pannier
     * N'hesitez pas à enlever les commentaires sur les différents console.log au fur et à mesure pour comprendre ce qui se passe.
     * Il existe deux grandes parties. L'inscription des données dans le local storage et l'écriture de la table en HTML.
     * Il est très vivement conseillé d'installer l'extension fireStorage Plus! pour firefox, elle est TRES utile pour la manipulation du local storage
     */

    /**
     *  1ère Partie : L'inscription des données dans le local Storage
     *
     */


    // ***** Empecher le bouton de soumettre le formulaire et de recharger la page. ****/
    e.preventDefault();

    // **** Récupérer les données du formulaires ****/
    //console.log($(this)); // Cela va retourner un objet representant le formulaire sur lequel l'événement a eu lieu
    //console.log($(this).serializeArray());

    // The .serializeArray() method creates a JavaScript array of objects, ready to be encoded as a JSON string. It operates on a jQuery collection of forms and/or form controls
    // En gros, à partir des éléments d'un formulaire, cette fonction créée un tableau (array)
    // Ce tableau va contenir , sous forme d'objets, les différents champs du formulaire.
    // N'hésitez pas à regarder les exemples dans le lien suivant:
    // https://api.jquery.com/serializeArray/ //
    // Le tableau retourné est pret à être mis au format JSON, et à ensuite enregistré dans le local storage.

    var product = $(this).serializeArray();


    //***** Mettre les données au format JSON et les enregistrer dans le local storage. ************/
    // Dans le fichier utilities.js une fonction a été crée pour nous, afin de réaliser en un coup ces deux opérations.
    // C'est la fonction saveDataToDomStorage. Allez la regarder un instant.
    // Ensuite vous voudrez peut être vous rappeler ce que font les fonctions JSON.stringify et localStorage.setItem.
    // http://www.dyn-web.com/tutorials/php-js/json/stringify.php
    // http://www.alsacreations.com/article/lire/1402-web-storage-localstorage-sessionstorage.html

    // console.log(product);
    // console.log(JSON.stringify(product));
    // Ainsi window.localStorage.setItem("produit1", product); // Revient au meme que :
    saveDataToDomStorage("produit1", product);
    console.log(loadDataFromDomStorage("produit1"))


    // ******** Récupérer  et afficher les données stockés dans le local storage
    // Pour afficher il faut utiliser la fonction localStorage.getItem(name)
    //console.log(localStorage.getItem("produit1"));
    // Nous récupérons ainsi  notre tableau contenant les objets représentant les champs du formulaire (dans notre cas , juste deux, le nom du produit et la quantité)

    // Ce tableau est au format JSON. Pour l'utiliser il faut le "déconvertir" du format JSON vers un format de tableau normal.
    //Pour cela nous utilisons JSON.parse(data).
    // http://www.dyn-web.com/tutorials/php-js/json/parse.php
    // console.log(JSON.parse(localStorage.getItem("produit1")));
    // Et une nouvelle fois, dans le fichier utilities.js, une fonction a été construire afin de réaliser tout cela en un coup.

    //console.log(loadDataFromDomStorage("produit1"));



    //***** Stocker plusieurs valeurs dans le local storage ****/
    //Il nous faut maintenant stocker plusieurs entrées différentes dans le local storage, sans qu'une nouvelle entrée n'écrase et remplace les entrées précédentes.
    // Pour réaliser cela nous aller réaliser un tableau, qui va contenir les différentes entrées (qui sont elles memes des tableaux, qui contiennent des objets(oui cela fait 3 niveaux en tout).

    //var cart =[];

    //On insère dans ce tableau notre variable product. La fonction .push ajoute automatiquement à la fin du tableau.
    //cart.push(product);

    // Et on insère notre tableau contenant tous nos produits sélectionnés dans le local storage.
    //saveDataToDomStorage("cart", cart);

    //console.log(loadDataFromDomStorage("cart"));


    //Ensuite et pour terminer il ne faut plus partir d'un tableau vide à chaque fois, mais récupérer les données du local storage
    // Ainsi au lieu de commencer avec var cart = [];
    // Nous allons commencer avec :
    //var cart = loadDataFromDomStorage("cart");
    // Ainsi on repart de ce qui existe déjà dans le local storage.
    // Mais si l'utilisateur arrive pour la première fois sur la page, le local storage est vide.
    // Et nous ne pourrons donc pas récupérer ce qui a déjà était mis dans le local storage (on ne peut pas récupérer du vide).
    //Cela entrenera une erreur quand on voudra ajouter ensuite le produit. Il faut donc  faire une déclaration conditionnelle. Un if ^^.

    var cart =loadDataFromDomStorage("cart");
    if(cart == null)
    {
        cart = [];
    }


    //******** Faire des updates du local storage pour éviter les doublons ***/
    // Actuellement à chaque fois que l'utilisateur clique sur le bouton Ajouter, cela ajoute une nouvelle entrée au local stroage.
    // Mais si au lieu d'ajouter une nouvelle entrée pour chaque produit, nous voulons mettre à jour la ligne concernant un produit qui aurait déjà été ajouté ?
    // Il faut faire une boucle pour analyser le contenu de la variable cart, et vérifier si le nom du produit sélectionné dans le formulaire est déjà contenu dans la variable.
    // Si c'est le cas, il faut supprimer l'ancienne ligne, pour pouvoir ensuite insérer la nouvelle.
    for (var i = 0; i < cart.length; i++) {
        if (cart[i][0].value == product[0].value) {
            //console.log(cart[i][0].value)
            //console.log(product[0].value);
            console.log(cart.splice(cart.indexOf(cart[i]), 1));
        }
    }


    // Fonction avec la 1ère Partie Complète.
    function AddCart(e)
    {
        e.preventDefault();
        var product = $(this).serializeArray();
        var cart = loadDataFromDomStorage("cart");

        if (cart == null) {
            cart = [];
            cart.push(product);
        }
        else {
            for (var i = 0; i < cart.length; i++) {
                //console.log(cart[i][0].value)
                if (cart[i][0].value == product[0].value) {
                    //console.log(product[0].value);
                    console.log(cart[i][0]);
                    console.log(cart.splice(cart.indexOf(cart[i]), 1));
                }
            }
            cart.push(product);
        }

        saveDataToDomStorage("cart", cart);
    }



    /**
     * 2ème PARTIE : L'écriture de la table dans le
     *
     */




}
