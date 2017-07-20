<?php 
include("../../comum/comum.php"); 
include("../modelo-produto.php");
include("../negocio-produto.php");

$loDados = $_POST["dados"];

$loProduto = new produtoBO();
$loRetorno = $loProduto->AdicionaProduto($loDados);

echo json_encode($loRetorno);
?>




