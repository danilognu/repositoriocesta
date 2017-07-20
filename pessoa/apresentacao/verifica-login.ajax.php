<?php 
include("../../comum/comum.php"); 
include("../modelo-pessoa.php");
include("../negocio-pessoa.php");

$loPessoaVO = new pessoaVO();
$loPessoa = new pessoaBO();

$loRetorno = $loPessoa->VerificaLoginExiste($_POST["login"]);

echo json_encode($loRetorno);
?>

