/**
 * Created by wap58 on 25/11/16.
 */
function getMenuData(data)
{
    //console.log(data);
    $(".meal-details").html(data);

}

function createOrder(data)
{
    console.log(data);
    $(".order-details").html(data);
    clearLocalStorage();
    location.assign(getRequestUrl()+"/order/payement?orderId="+data);
}





function getProductData(data)
{
    // Fonction devenue inutile avec l'ajout d'input hidden dans la première requete ajax

    var productData = data;
    var cart = loadDataFromDomStorage("cart");

    // console.log(productData['id']);
    // console.log(productData['buyPrice']);
    // console.log(productData['productName']);
    // console.log(cart[0]);

    for (var i = 0; i < cart.length; i++) {
        //console.log(cart[i][0].value)
        //console.log(productData['nameProduct'])
        if (cart[i][0].value == productData['nameProduct'])
        {
            console.log(productData['nameProduct']);
            console.log(cart[i][0].value);

        }
    }
    //cart.push(product);
}

function rewriteQutyProduct(data)
{
    //console.log(data['quantityInStock'])
    var QutyRewrite = $('#Quty-'+data['id']);
    if(data['quantityInStock'] < 5)
    {
        QutyRewrite = QutyRewrite.html("<span class='danger'>"+data['quantityInStock']+"</span>");
    }
    else
    {
        QutyRewrite = QutyRewrite.html(data['quantityInStock']);
    }

    //console.log(QutyRewrite);
    
}

function reloadPage(data)
{
    console.log(data)
}
