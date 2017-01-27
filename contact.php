<?php
//if $_POST is empty redirect
if (empty($_POST)) {
    header("location: /Portfolio/");
    exit();
}
 
include 'rooter.php';



//Le nom et prénom
$name = $_POST['name'];
// L'adresse  mail
$email = $_POST['email'];
// the message
$msg = $_POST["message"];
// use wordwrap() if lines are longer than 70 characters
//$msg = wordwrap($msg,70);

//Validate first
if(empty($name)||empty($email))
{
    $error = "Le nom et l'adresse mail sont obligatoires !";
    $template = templateRequest('contact');
    include $viewsPath.'templates/layout.phtml';
    exit;
}

if(IsInjected($email))
{
    $error = "L'adresse mail n'a pas été renseignée dans un format correct !";
    $template = templateRequest('contact');
    include $viewsPath.'templates/layout.phtml';
    exit;
}

$email_from = 'contact@pierrenoel.pro';
$email_subject = "Prise de contact de la part de ".$name."" ;

$email_body = "Vous avez reçu un nouveau message de la part de $name.\n".
    "Voici le message:\n $msg";

$to = "contact@pierrenoel.pro";
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $email \r\n";
// send email
mail($to,$email_subject,$email_body,$headers);
//SYNTAX : mail(to,subject,message,headers,parameters);


// Function to validate against any email injection attempts
function IsInjected($str)
{
    $injections = array('(\n+)',
        '(\r+)',
        '(\t+)',
        '(%0A+)',
        '(%0D+)',
        '(%08+)',
        '(%09+)'
    );
    $inject = join('|', $injections);
    $inject = "/$inject/i";
    if(preg_match($inject,$str))
    {
        return true;
    }
    else
    {
        return false;
    }
}
$template = templateRequest('contact');
include $viewsPath.'templates/layout.phtml';