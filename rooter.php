<?php

$root = "http://".$_SERVER['SERVER_NAME']."/Portfolio/";
$viewsLinks = "http://".$_SERVER['SERVER_NAME']."/Portfolio/views/";

$viewsPath = $_SERVER['DOCUMENT_ROOT']."/Portfolio/views/";
function templateRequest($name) {
    $template = $_SERVER['DOCUMENT_ROOT']."/Portfolio/views/templates/".$name.".phtml";
    return $template;
}
