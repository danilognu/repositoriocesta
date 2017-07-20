<?php 
include("../../comum/comum.php"); 
include("../modelo-agenda.php");
include("../negocio-agenda.php");

$loIdAgenda = $_POST["id_agenda"];

$loAgendaVO = new agendaVO();

$loAgendaVO->mbIdAgenda = $loIdAgenda;

$loAgenda = new agendaBO();
$loRetorno = $loAgenda->GravaAgendaVisitada($loAgendaVO);

echo json_encode($loRetorno);
?>




