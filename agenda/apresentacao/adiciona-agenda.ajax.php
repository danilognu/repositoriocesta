<?php 
include("../../comum/comum.php"); 
include("../modelo-agenda.php");
include("../negocio-agenda.php");

$loDados = $_POST["dados"];

$loAgenda = new agendaBO();
$loRetorno = $loAgenda->AdicionaAgenda($loDados);

echo json_encode($loRetorno);
?>




