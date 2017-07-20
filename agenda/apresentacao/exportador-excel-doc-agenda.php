<?php
include("../../comum/comum.php");
include("../../comum/includes/PHPExcel/Classes/PHPExcel.php");
include("../modelo-agenda.php");
include("../negocio-agenda.php");

// Instanciamos a classe
$objPHPExcel = new PHPExcel();
$loAgendaFiltroVO = new agendaFiltroVO();
$loAgendaVo = new agendaVO();
$loAgenda = new agendaBO();
$loComumBO = new comumBO();

//POST
if(isset($_POST["fil-data-agenda-inicio"])){    $loAgendaFiltroVO->mbDataVisitaInc = $_POST["fil-data-agenda-inicio"];  }
if(isset($_POST["fil-data-agenda-fim"])){       $loAgendaFiltroVO->mbDataVisitaFim = $_POST["fil-data-agenda-fim"];     }
if(isset($_POST["fil-select-cliente"])){        $loAgendaFiltroVO->mbIdCliente     = $_POST["fil-select-cliente"];      }
if(isset($_POST["fil-select-cidade"])){         $loAgendaFiltroVO->mbIdCidade      = $_POST["fil-select-cidade"];       }
if(isset($_POST["fil-consulta"])){              $loAgendaFiltroVO->mbConsulta      = $_POST["fil-consulta"];            }

if(isset($_POST["fil-telefone"])){  $loAgendaFiltroVO->mbTelefone = $loComumBO->RemoverMascaraTelefone($_POST["fil-telefone"]); }
if(isset($_POST["fil-ind-visitado"]) && $_POST["fil-ind-visitado"] == "on" ){$loAgendaFiltroVO->mbIndVisitado   = "1";  }

if( isset($_REQUEST["agenTotal"]) && $_REQUEST["agenTotal"] == "S" ){
    $loAgendaFiltroVO->mbExibicaoAgendaTotal = "S";
}else {
    $loAgendaFiltroVO->mbExibicaoAgendaTotal = "N";
}

//Cabeçalho
$objPHPExcel->getActiveSheet()->getColumnDimension("A")->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension("B")->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension("C")->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension("D")->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension("E")->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension("F")->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension("G")->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension("H")->setWidth(60);
$objPHPExcel->getActiveSheet()->getColumnDimension("I")->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension("J")->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension("K")->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension("L")->setWidth(20);

$objPHPExcel->getActiveSheet()->getStyle("A"."1")->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("A1", "CODIGO" );

$objPHPExcel->getActiveSheet()->getStyle("B"."1")->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("B1", "DATA AGENDADO" );

$objPHPExcel->getActiveSheet()->getStyle("C"."1")->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("C1", "CLIENTE" );

$objPHPExcel->getActiveSheet()->getStyle("D"."1")->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("D1", "TELEFONE" );

$objPHPExcel->getActiveSheet()->getStyle("E"."1")->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("E1", "PRODUTO" );

$objPHPExcel->getActiveSheet()->getStyle("F"."1")->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("F1", "QTD PRODUTO" );

$objPHPExcel->getActiveSheet()->getStyle("G"."1")->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("G1", "VISITADO" );

$objPHPExcel->getActiveSheet()->getStyle("H"."1")->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("H1", "OBS" );

$objPHPExcel->getActiveSheet()->getStyle("I"."1")->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("I1", "USUARIO CADASTRO" );

$objPHPExcel->getActiveSheet()->getStyle("J"."1")->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("J1", "DATA CADASTRO" );

$objPHPExcel->getActiveSheet()->getStyle("K"."1")->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("K1", "USUARIO ALTERACAO" );

$objPHPExcel->getActiveSheet()->getStyle("L"."1")->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("L1", "DATA ALTERACAO" );

//Corpo
$arTabela = array(
                "mbIdAgenda"
                ,"mbDataVisita"
                ,"mbNomeCliente"
                ,"mbTelefone1Cliente"
                ,"mbNomeProdutos"
                ,"mbQtdProduto"
                ,"mbIndVisitado"
                ,"mbObservacao"
                ,"mbNomePessoaCad"
                ,"mbDtCad"
                ,"mbNomePessoaAlt"
                ,"mbDtAlt"
            );
$loRetorno = $loAgenda->ConsultaAgenda($loAgendaFiltroVO);

if(count($loRetorno) > 0 ){

    $linha = 2;
    foreach ($loRetorno as $row){


            $coluna = 0;
            foreach ($arTabela as $nomeColuna){

                switch ( $nomeColuna ){
                     case "mbIndVisitado":
                         if($row->$nomeColuna == 0){ $item = "NAO"; }else{ $item = "SIM"; }
                    break;
                    case "mbTelefone1Cliente":
                        $item = $loComumBO->MascaraTelefone($row->$nomeColuna);
                    break;
                    default:
                        $item = $row->$nomeColuna;
                }

               $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($coluna, $linha, utf8_encode($item) );

               $coluna++;

            }
        

        $linha++;
    }
}

//exit;

$objPHPExcel->getActiveSheet()->setTitle("Documento Agendamentos");

// Cabeçalho do arquivo para ele baixar
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename=Agendamentos.xls');
header('Cache-Control: max-age=0');
// Se for o IE9, isso talvez seja necessário
header('Cache-Control: max-age=1');

// Acessamos o 'Writer' para poder salvar o arquivo
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

// Salva diretamente no output, poderíamos mudar arqui para um nome de arquivo em um diretório ,caso não quisessemos jogar na tela
$objWriter->save('php://output'); 

exit;

?>