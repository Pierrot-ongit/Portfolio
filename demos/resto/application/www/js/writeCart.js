/**
 * Created by wap58 on 28/11/16.
 */
function writeCart()
{
    var data = loadDataFromDomStorage("cart");
    var table = $('tbody');

    //table.empty();


//table.clearData();
   for (var i = 0; i < data.length; i++) {
         //console.log(data[i]);
        var tr = $('<tr>');
       //La quantité
       var td = $('<td>').text(data[i][4].value);
        tr.append(td);
        // Le nom du produit
        td = $('<td>').text(data[i][0].value);
        tr.append(td);
        //Le prix unitaire
        td = $('<td>').text(formatMoneyAmount(data[i][2].value));
        tr.append(td);
        //Le prix total
        td = $('<td>').text(formatMoneyAmount((data[i][2].value) * (data[i][4].value)));
        tr.append(td);
        // Le bouton
        td = $('<td>').html("<button form='' id='" + data[i][1].value + "' class='button button-cancel remove'><i class='fa fa-trash'></i></button>");
        tr.append(td);

        table.append(tr);
     }
    
}
