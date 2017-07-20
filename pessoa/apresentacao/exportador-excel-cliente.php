<?php
include("../../comum/comum.php");
include("../../comum/includes/PHPExcel/Classes/PHPExcel.php");
include("../modelo-pessoa.php");
include("../negocio-pessoa.php");


$loDados = NULL;
$loNomeFil = NULL;
$loTelefoneFil = NULL;
$loContaItensFil = 0;
$loConsultaFil = NULL;
$loStatusFil = NULL;

// Instanciamos a classe
$objPHPExcel = new PHPExcel();
$loComumBO = new comumBO();
$loPessoaBO = new pessoaBO();


if(isset($_POST["fil-nome"])){    $loNomeFil = $_POST["fil-nome"];  }
if(isset($_POST["fil-telefone"])){  $loTelefoneFil = $_POST["fil-telefone"];  }
if(isset($_POST["fil-consulta"])){  $loConsultaFil = $_POST["fil-consulta"];  }
if(isset($_POST["fil-status"])){  $loStatusFil = $_POST["fil-status"];  }


$loDados = array("id_tipo_pessoa" => 3, "nome" => $loNomeFil, "telefone1" => $loTelefoneFil, "consulta_filtro" => $loConsultaFil, "ativo" => $loStatusFil);


//Cabeçalho
$objPHPExcel->getActiveSheet()->getColumnDimension("A")->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension("B")->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension("C")->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension("D")->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension("E")->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension("F")->setWidth(60);
$objPHPExcel->getActiveSheet()->getColumnDimension("G")->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension("H")->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension("I")->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension("J")->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension("K")->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension("L")->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension("M")->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension("N")->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension("O")->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension("P")->setWidth(30);

$objPHPExcel->getActiveSheet()->getStyle("A"."1")->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("A1", "CODIGO" );

$objPHPExcel->getActiveSheet()->getStyle("B"."1")->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("B1", "NOME" );

$objPHPExcel->getActiveSheet()->getStyle("C"."1")->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("C1", "TELEFONE 1" );

$objPHPExcel->getActiveSheet()->getStyle("D"."1")->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("D1", "TELEFONE 2" );

$objPHPExcel->getActiveSheet()->getStyle("E"."1")->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("E1", "TELEFONE 3" );

$objPHPExcel->getActiveSheet()->getStyle("F"."1")->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("F1", "ENDERECO" );

$objPHPExcel->getActiveSheet()->getStyle("G"."1")->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("G1", "BAIRRO" );

$objPHPExcel->getActiveSheet()->getStyle("H"."1")->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("H1", "NUMERO" );

$objPHPExcel->getActiveSheet()->getStyle("I"."1")->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("I1", "CEP" );

$objPHPExcel->getActiveSheet()->getStyle("J"."1")->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("J1", "CIDADE" );

$objPHPExcel->getActiveSheet()->getStyle("K"."1")->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("K1", "ESTADO" );

$objPHPExcel->getActiveSheet()->getStyle("L"."1")->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("L1", "ATIVO" );

$objPHPExcel->getActiveSheet()->getStyle("M"."1")->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("M1", "DATA CADASTRO" );

$objPHPExcel->getActiveSheet()->getStyle("N"."1")->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("N1", "DATA ALTERACAO" );

$objPHPExcel->getActiveSheet()->getStyle("O"."1")->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("O1", "USUARIO CAD" );

$objPHPExcel->getActiveSheet()->getStyle("P"."1")->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("P1", "USUARIO ALT" );


//Corpo
$arTabela = array(
                "mbIdPessoa"
                ,"mbNome"
                ,"mbTelefone1"
                ,"mbTelefone2"
                ,"mbTelefone3"
                ,"mbEndereco"
                ,"mbBairro"
                ,"mbNumero"
                ,"mbCep"
                ,"mbNomeCidade"
                ,"mbEstadoCidade"
                ,"mbStatus"
                ,"mbDtCad"
                ,"mbDtAlt"
                ,"mbNomePessoaCad"
                ,"mbNomePessoaAlt"
            );
$loRetorno = $loPessoaBO->ConsultaPessoa($loDados);

if(count($loRetorno) > 0 ){

    $linha = 2;
    foreach ($loRetorno as $row){


            $coluna = 0;
            foreach ($arTabela as $nomeColuna){

                switch ( $nomeColuna ){
                     case "mbStatus":
                         if($row->$nomeColuna == 0){ $item = "NAO"; }else{ $item = "SIM"; }
                    break;
                    case "mbTelefone1":
                        $item = $loComumBO->MascaraTelefone($row->$nomeColuna);
                    break;
                    case "mbTelefone2":
                        $item = $loComumBO->MascaraTelefone($row->$nomeColuna);
                    break; 
                    case "mbTelefone3":
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

$objPHPExcel->getActiveSheet()->setTitle("Documento Clientes");

// Cabeçalho do arquivo para ele baixar
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename=Clientes.xls');
header('Cache-Control: max-age=0');
// Se for o IE9, isso talvez seja necessário
header('Cache-Control: max-age=1');

// Acessamos o 'Writer' para poder salvar o arquivo
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

// Salva diretamente no output, poderíamos mudar arqui para um nome de arquivo em um diretório ,caso não quisessemos jogar na tela
$objWriter->save('php://output'); 

exit;

?>