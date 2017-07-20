<?php
//include("../../comum/comum.php");
include("../../comum/conexao.php");
include("../modelo-login.php"); 
include("../negocio-login.php"); 

$loDados = $_POST["dados"];
$loLogin = new loginBO();
$loRetrono = $loLogin->VerificaLogin($loDados);
echo json_encode($loRetrono);
?>