$(function(){

    var moneyFormat =  document.querySelectorAll(".money");
    for (i=0; i < moneyFormat.length; i++)
    {
        //console.log(moneyFormat[i].innerHTML);
        //console.log(formatMoneyAmount(moneyFormat[i].innerHTML));
        var moneyChanged = formatMoneyAmount(moneyFormat[i].innerHTML);
        moneyFormat[i].innerHTML = moneyChanged
    }

    //Confimrer la commande et payer
    $("#payement-success").on('submit', SuccessPayement);

    // Annuler le payement
    $("#cancel-payement").on('click', CancelPayement);

});

function SuccessPayement(e)
{
    e.preventDefault();
}

function CancelPayement()
{

}