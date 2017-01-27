/**
 * Created by wap58 on 01/12/16.
 */
$(function(){

    //Event pour gérer la suppresion d'éléments dans la page admin
    $('.delette').on('click', deleteContent);

    //Events pour gérer la modification de quantité pour les produits.
    $('.adding').on('click', AddQutyProduct);
    $('.removing').on('click', RemoveQutyProduct);

    // Edit user profil
    $('.edit-user').on('click', show_form_user);


});

function AddQutyProduct(event)
{
    event.preventDefault();
    var productId = $(this).attr('id');
       productId = productId.charAt(6);
     console.log(productId);

    $.get(getRequestUrl()+"/admin/adminproducts?productId="+productId+"&AddQuty=1", rewriteQutyProduct);
}

function RemoveQutyProduct(event)
{
    event.preventDefault();
    var productId = $(this).attr('id');
    productId = productId.charAt(8);
    console.log(productId);

    $.get(getRequestUrl()+"/admin/adminproducts?productId="+productId+"&RemoveQuty=1", rewriteQutyProduct);
}



function deleteContent(event)
{
    /**
     * La classe delette est commune à tous les boutons "poubelles" sur la page admin.
     * Mais chacun a un ID unique, avec une "catégorie" précisée dedans, ainsi qu'un numéro correspondant à l'ID de ce contenu dans la BDD.
     * On va d'abord rechercher la "catégorie" de contenu à laquelle appartient le bouton
     * Une fois trouvée on peut agir, et utiliser une fonction ajax pour aller supprimer le contenu dans la BDD.
     */

    event.preventDefault();
    var contentId = $(this).attr('id');
    //console.log(this);
    //console.log(contentId); // gets the id of a clicked link that has a class of menu

    //Test pour : booking
    if(contentId.search("booking") != -1)
    {
        //console.log("C'est un booking !");
        bookingId = contentId.charAt(8);
        console.log(bookingId);
        $.get(getRequestUrl()+"/admin/delette?bookingId="+bookingId, reloadPage);
        


    }

    //Test pour : product
    if(contentId.search("product") != -1)
    {
        //console.log("C'est un product !");
        productId = contentId.charAt(16);
        console.log(productId);
        $.get(getRequestUrl()+"/admin/delette?productId="+productId, reloadPage);
    }

    //Test pour : product
    if(contentId.search("user") != -1)
    {
        //console.log("C'est un user !");
        userId = contentId.charAt(13);
        console.log(userId);
        $.get(getRequestUrl()+"/admin/delette?userId="+userId, reloadPage);
    }




    //Fonction AJAX pour la gestion de la suppression
    
}



// Validating Empty Field
function check_empty() {
    if (document.getElementById('firstName').value == "" || document.getElementById('phone').value == "" || document.getElementById('address').value == "") {
        alert("Fill All Fields !");
    } else {
        document.getElementById('form').submit();
        alert("Form Submitted Successfully...");
    }
}
//Function To Display Popup
function show_form_user(event) {
    var productId = $(this).attr('id');
    productId = productId.charAt(4);
    console.log(productId);
    var formUserID = $("input:hidden[name=userID]").val(productId);
    console.log(formUserID);
    document.getElementById('form-user').style.display = "block";
}
//Function to Hide Popup
function div_hide(){
    document.getElementById('form-user').style.display = "none";
}