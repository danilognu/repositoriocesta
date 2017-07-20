<?php 
include("../../comum/comum.php"); 
include("../../pessoa/modelo-pessoa.php");
include("../../pessoa/negocio-pessoa.php");

$loDados = $_POST["dados"];

$loPessoa = new pessoaBO();
$loRetorno = $loPessoa->AdicionaPessoa($loDados);

echo json_encode($loRetorno);
?>


