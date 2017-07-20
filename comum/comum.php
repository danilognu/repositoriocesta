<?php

if(!isset($_SESSION)){ session_start(); }
if(!isset($_SESSION["id_pessoa_usuario"])){
     header("location:../login/login.php");
}

$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];

include_once("conexao.php");
include_once("modelo-comum.php");
include_once("negocio-comum.php");

// $TITULO_HEAD_ADM = $constantes->titulo_head_adm;*/

?>