<?php
include("../../comum/comum.php");
include("../../comum/includes/Mpdf/mpdf.php"); 
include("../modelo-agenda.php");
include("../negocio-agenda.php");


$loIdAgenda = $_REQUEST["id_agenda"];

$loAgendaFiltroVO = new agendaFiltroVO();
$loAgenda = new agendaBO();

$loAgendaFiltroVO->mbIdAgenda = $loIdAgenda;

$loRetorno = $loAgenda->ConsultaAgenda($loAgendaFiltroVO);
if(count($loRetorno) > 0 ){

    foreach ($loRetorno as $row){
        $loDataAgendamento  = $row->mbDataVisita;
        $loNomeCliente      = $row->mbNomeCliente;
        $loNomeProduto      = $row->mbNomeProdutos;
        $loIndVisitado      = $row->mbIndVisitado;
        $loDataAtual        = $row->mbDataAtual;
        $loQtd              = $row->mbQtdProduto;
    }
}

if($loIndVisitado == 1){
    $loVistado = "SIM";
}else{
    $loVistado = "NAO";
}

 $loHtmlTabela = "";
 $loHtmlTabela .= "<h1 style='font-size:14px; font-family:Arial, Helvetica, sans-serif;' > CESTA BASICA TOTAL - RELATORIO DE VISITA AGENDA N: ".$loIdAgenda." - ".$loDataAtual." </h1>";
 $loHtmlTabela .= " <hr>";
 $loHtmlTabela .= "<table width='100%' border='0' cellspacing='0' cellpadding='0' style='font-family:Arial, Helvetica, sans-serif;'>";
 $loHtmlTabela .= " <tr>";
 $loHtmlTabela .= "   <td style='font-size:14px; border-collapse: collapse;border:1px solid #000000; font-weight:900;padding: 5px; width: 15%;'><b>Data Atendimento<b/></td>";
 $loHtmlTabela .= "   <td style='font-size:13px; border-collapse: collapse;border:1px solid #000000;padding-left: 10px'>". $loDataAgendamento ."</td>";
 $loHtmlTabela .= " </tr>";
 $loHtmlTabela .= " <tr>";
 $loHtmlTabela .= "    <td style='font-size:14px; border-collapse: collapse;border:1px solid #000000; font-weight:900;padding: 5px;'><b>Cliente</b></td>";
 $loHtmlTabela .= "    <td style='font-size:13px; border-collapse: collapse;border:1px solid #000000;padding-left: 10px'>". $loNomeCliente ."</td>";
 $loHtmlTabela .= " </tr>";
 $loHtmlTabela .= "  <tr>";
 $loHtmlTabela .= "   <td style='font-size:14px; border-collapse: collapse;border:1px solid #000000; font-weight:900;padding: 5px;'><b>Produto</b></td>";
 $loHtmlTabela .= "   <td style='font-size:13px; border-collapse: collapse;border:1px solid #000000;padding-left: 10px'>". $loNomeProduto ."</td>";
 $loHtmlTabela .= "  </tr>";
 $loHtmlTabela .= "  <tr>";
 $loHtmlTabela .= "    <td style='font-size:14px; border-collapse: collapse;border:1px solid #000000; font-weight:900;padding: 5px;'><b>Qtd</b></td>";
 $loHtmlTabela .= "    <td style='font-size:13px; border-collapse: collapse;border:1px solid #000000;padding-left: 10px'>". $loQtd ."</td>";
 $loHtmlTabela .= "  </tr>";
 $loHtmlTabela .= "  <tr>";
 $loHtmlTabela .= "    <td style='font-size:14px; border-collapse: collapse;border:1px solid #000000; font-weight:900;padding: 5px;'><b>Visitado</b></td>";
 $loHtmlTabela .= "    <td style='font-size:13px; border-collapse: collapse;border:1px solid #000000;padding-left: 10px'>". $loVistado ."</td>";
 $loHtmlTabela .= "  </tr>"; 
 $loHtmlTabela .= "</table>";


//  echo  $loHtmlTabela;
//  exit();
 $mpdf=new mPDF('','A4-L');
 //$mpdf->charset_in='iso-8859-1'; 
 //$mpdf=new mPDF();
 $mpdf->WriteHTML(utf8_encode($loHtmlTabela));
 //$mpdf->Output();
 $mpdf->Output("documento-agenda-".$loIdAgenda.".pdf", 'D');
 exit();

?>