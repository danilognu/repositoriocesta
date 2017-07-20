<?php

include("../../comum/comum.php");
include("../../pessoa/modelo-pessoa.php");
include("../../pessoa/negocio-pessoa.php");
include("../modelo-agenda.php");
include("../negocio-agenda.php");



$loPessoaBO = new pessoaBO();
$loAgendaFiltroVO = new agendaFiltroVO();
$loAgenda = new agendaBO();
$loComumBO = new comumBO();

if( isset($_REQUEST["agenTotal"]) ){
    $loTitulo = "TODA AGENDA";
    $loAgenTotal = true;
}else {
    $loTitulo = "AGENDA DO DIA";
    $loAgenTotal = false;
}


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



?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Cesta Basica Total</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Sistema de controle de Agenda" name="description" />
        <meta content="Danilo Gabriel de Souza" name="author" />
        <!-- danilognu@gmail.com-->

        <?php include("../../comum/includes/css.php"); ?>
        <?php include("../../comum/includes/css-tabela.php"); ?>

        <!--link href="../../comum/js/jquery-ui-1.12.1.custom/jquery-ui.css" rel="stylesheet" type="text/css" /-->

        <link href="../../../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="../../../assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
   
    <?php include("../../comum/includes/topo.php"); ?>
           
  <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <div class="page-sidebar navbar-collapse collapse">
                <?php include("../../comum/includes/menu.php"); ?>
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                   
                              <div class="portlet light bordered">
                                <div class="portlet">
                                    <div class="caption font-dark">
                                        <i class="fa fa-calendar"></i>
                                        <span class="caption-subject bold uppercase"> <?php echo $loTitulo; ?> </span>
                                    </div>
                                </div>

                          

                                        
   
                                <!-- ================================================================================================================ -->
                                    <form role="form" method="post" id="form-filtro">
                                        <div class="row" style=" width: 100%;">

                                            <?php if($loAgendaFiltroVO->mbExibicaoAgendaTotal == "S") { ?>
                                                <div class="col-md-2">
                                                    Dt Agenda Incio
                                                    <input type="text" class="form-control-sm input-sm form-control mask_date data_calendario" name="fil-data-agenda-inicio"  id="fil-data-agenda-inicio" value="<?php echo $loAgendaFiltroVO->mbDataVisitaInc; ?>" > 
                                                </div>
                                                <div class="col-md-2">
                                                    Dt Agenda Fim
                                                    <input type="text" class="form-control-sm input-sm form-control mask_date data_calendario" name="fil-data-agenda-fim" id="fil-data-agenda-fim" value="<?php echo $loAgendaFiltroVO->mbDataVisitaFim; ?>" > 
                                                    <input type="hidden" name="fil-telefone" id="fil-telefone" value="" >
                                                </div>      
                                            <?php }else{ ?>                                      
                                                <div class="col-md-2">
                                                    Telefone
                                                    <input type="text" class="form-control form-control input-sm mask_telefone" name="fil-telefone" id="fil-telefone" value="<?php echo $loAgendaFiltroVO->mbTelefone; ?>" > 
                                                </div>
                                            <?php } ?>
                                            <div class="col-md-3">Clientes
                                                <select class="form-control select2me" name="fil-select-cliente" id="select-cliente"  >
                                                        <option value=""></option>
                                                        <?php
                                                                $loDados = array("id_tipo_pessoa" => 3);
                                                                $loPessoa = $loPessoaBO->ConsultaPessoa($loDados);

                                                                if(count($loPessoa) > 0){

                                                                    foreach ($loPessoa as $row){
                                                                        if($row->mbIdPessoa == $loAgendaFiltroVO->mbIdCliente){
                                                                            $loSelectedCli = "selected";
                                                                        }else{
                                                                            $loSelectedCli = "";
                                                                        }
                                                                        ?>
                                                                        <option value="<?php echo $row->mbIdPessoa; ?>" <?php echo $loSelectedCli; ?> >
                                                                            <?php echo $row->mbNome; ?>
                                                                        </option>
                                                                        <?php
                                                                    }
                                                                }                                                                        
                                                            ?>
                                                </select>
                                            </div>
                                            <div class="col-md-1"><br />
                                                <a href="#" id="pesquisa-cliente" class="btn btn-default fil-pesquisa-cliente"><i class="fa fa-search"></i></a>
                                            </div>

                                            <div class="col-md-2">Cidades
                                                    <select class="form-control select2me" name="fil-select-cidade" id="fil-select-cidade" style=" width: 100px;"  >
                                                        <option value=""></option>
                                                        <?php
                                                                $loDados = array("id_tipo_pessoa" => 3);
                                                                $loPessoa = $loPessoaBO->ConsultaPessoa($loDados);

                                                                if(count($loPessoa) > 0){

                                                                    foreach ($loPessoa as $row){
                                                                        if($row->mbIdCidade == $loAgendaFiltroVO->mbIdCidade){
                                                                            $loSelectedCid = "selected";
                                                                        }else{
                                                                            $loSelectedCid = "";
                                                                        }       
                                                                        ?>
                                                                        <option value="<?php echo $row->mbIdCidade; ?>" <?php echo $loSelectedCid; ?> >
                                                                            <?php echo $row->mbNomeCidade; ?>
                                                                        </option>
                                                                        <?php
                                                                    }
                                                                }                                                                        
                                                            ?>
                                                </select>
                                            </div>

                                            <div class="col-md-1">Visitado
                                                <input type="checkbox" name="fil-ind-visitado" id="fil-ind-visitado" <?php if($loAgendaFiltroVO->mbIndVisitado == "1") echo "checked"; ?> >
                                            </div>



                     
                                            <div class="col-md-2"><br />
                                                <!--a href="#" id="pesquisa-carona" class="btn dark">Pesquisar <i class="fa fa-search"></i></a-->
                                                <div class="btn-group btn-group-sm btn-group-solid">
                                                    <button id="btn-pesquisa" class="btn sbold dark "> Pesquisar
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                    <input type="hidden" name="fil-consulta" id="fil-consulta" value="1" >
                                                    <input type="hidden" name="agenTotal" id="agenTotal" value="<?php echo $loAgendaFiltroVO->mbExibicaoAgendaTotal; ?>" >
                                                </div>

                                            </div>
                                        </div>
                                    </form>
                                    <hr>
                                <!-- ================================================================================================================ -->





                                    <div class="portlet-body">
                                        <div class="table-toolbar"> 

                                                <div class="row">
                                                    <div class="col-md-11 form-inline">
                                                        <div class="btn-group btn-group-sm btn-group-solid">
                                                            <button id="btn-pesquisa-adiciona" class="btn sbold dark "> Adicionar
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </div>
                                                        <?php if(!$loAgenTotal){ ?>
                                                            <div class="btn-group btn-group-sm btn-group-solid">
                                                                <button id="btn-exibir-toda-agenda" class="btn default"> Ver Toda Agenda
                                                                    <i class="fa fa-calendar"></i>
                                                                </button>
                                                            </div>     
                                                        <?php }else{ ?>
                                                            <div class="btn-group btn-group-sm btn-group-solid">
                                                                <button id="btn-exibir-dia-agenda" class="btn default"> Agenda do Dia
                                                                    <i class="fa fa-calendar"></i>
                                                                </button>
                                                            </div>     
                                                        <?php } ?>                                                   
                                                    </div>

                                                
                                                
                                                        <div class="col-md-1">

                                                            <div class="btn-group btn-group-sm pull-right">
                                                                <button class="btn dark  btn-outline dropdown-toggle" data-toggle="dropdown">Exportar
                                                                    <i class="fa fa-angle-down"></i>
                                                                </button>
                                                                <ul class="dropdown-menu pull-right">
                                                                    <li>
                                                                        <a href="#" id="exportar-excel" >
                                                                            <i class="fa fa-file-excel-o"></i> Exportar Excel </a>
                                                                    </li>
                                                                    
                                                                </ul>
                                                            </div>
                                                        </div>

                                                </div>

                                                <br/>

                                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                                <thead>
                                                    <tr>
            
                                                            <th></th>
                                                            <th>Codigo</th>
                                                            <th>Data Agendado</th>
                                                            <th>Cliente</th>
                                                            <th>Telefone</th>
                                                            <th>Produtos</th>
                                                            <th>Usuario Cad.</th>
                                                            <th>Acao</th>

                                                    </tr>
                                                </thead>
                                                <tbody id="conteudo-consulta" >
                                                
                                                <?php include("consulta-agenda.ajax.php"); ?>

                                                </tbody>
                                            </table>

                                        </div><!--table-toolbar FIM-->
                                    </div><!--portlet-body FIM-->

                               </div><!--portlet light bordered FIM-->

                                    


            </div>
        </div>       
        <div id="dialog-message"></div>     
        <!-- END CONTAINER -->
        
        <!-- BEGIN RODA PÉ -->
        <?php include("../../comum/includes/rodape.php"); ?>
        <!-- BEGIN RODA PÉ -->

        <?php include("../../comum/includes/script.php"); ?>
        <?php include("../../comum/includes/script-tabela.php"); ?>

        <!--script src="../../comum/js/jquery-ui-1.12.1.custom/jquery-ui.js" type="text/javascript"></script-->
        <script src="../../../assets/global/plugins/select2/js/select2.full.js" type="text/javascript"></script>
        <script src="js/agenda.js" type="text/javascript"></script>

    </body>

</html>