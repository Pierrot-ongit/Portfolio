'use strict';

$(function(){
    $('.fa-remove').on("click", onExecution);
});

function onExecution()
{
    confirm("Etes vous sur de vouloir supprimer cet article ?");
}