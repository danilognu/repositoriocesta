<?php 
include("../../comum/comum.php"); 
include("../modelo-anotacao.php");
include("../negocio-anotacao.php");

$loAnotacaoVO = new anotacaoVO();
if(isset($_POST)){
    $loAnotacaoVO->mbIdAnotacao = $_POST["id_anotacao"];
}


$loAnotacaoBO = new anotacaoBO();
$loRetorno = $loAnotacaoBO->DesativaAnotacao($loAnotacaoVO);

?>


