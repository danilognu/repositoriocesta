<?php
include("../../comum/comum.php");
include("../modelo-pessoa.php");
include("../negocio-pessoa.php");

$loDados = NULL;
$loNomeFil = NULL;
$loTelefoneFil = NULL;
$loContaItensFil = 0;
$loConsultaFil = NULL;
$loStatusFil = NULL;

$loComumBO = new comumBO();
$loPessoa = new pessoaBO();

if(isset($_POST["fil-nome"])){    $loNomeFil = $_POST["fil-nome"];  }
if(isset($_POST["fil-telefone"])){  $loTelefoneFil = $_POST["fil-telefone"];  }
if(isset($_POST["fil-consulta"])){  $loConsultaFil = $_POST["fil-consulta"];  }
if(isset($_POST["fil-status"])){  $loStatusFil = $_POST["fil-status"];  }

$loDados = array("id_tipo_pessoa" => 3, "nome" => $loNomeFil, "telefone1" => $loTelefoneFil, "consulta_filtro" => $loConsultaFil, "ativo" => $loStatusFil);
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
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="fa fa-users"></i>
                                        <span class="caption-subject bold uppercase"> CLIENTES  </span>
                                    </div>
                                </div>

                                <form role="form" method="post" id="form-filtro">
                                    <div class="row">
                                        <div class="col-md-3">
                                            Nome:<input type="text" id="nome" name="fil-nome" class="form-control"  value="<?php echo $loNomeFil; ?>">
                                        </div>
                                        <div class="col-md-2">
                                            Telefone:<input type="text" id="telefone" name="fil-telefone" class="form-control mask_telefone"  value="<?php echo $loTelefoneFil; ?>">
                                            <input type="hidden"  name="fil-consulta" value="S">
                                        </div>

                                        <div class="col-md-2">
                                        Status:
                                         <select class="form-control" name="fil-status" id="fil-status">
                                                <option value='' ></option>
                                                <option value="S" <?php if($loStatusFil == "S"){ echo "selected";} ?> >Ativo</option>
                                                <option value="N" <?php if($loStatusFil == "N"){ echo "selected";} ?>>Desativado</option>      
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <br/>
                                            <button id="btn-pesquisa" class="btn sbold dark"> Pesquisa
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>                                
                                    </div>
                                </form>
                                
                                <br />

                                    <div class="portlet-body">
                                        <div class="table-toolbar"> 

                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <div class="btn-group">
                                                            <button id="btn-pesquisa-adiciona" class="btn sbold dark"> Adicionar
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                
                                                
                                                        <div class="col-md-1">

                                                            <div class="btn-group pull-right">
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
                                                            <th>Nome</th>
                                                            <th>Telefone</th>
                                                            <th>Endereco</th>
                                                            <th>Vendedor</th>
                                                            <th>Status</th>
                        


                                                    </tr>
                                                </thead>
                                                <tbody id="conteudo-consulta" >
                                                
                                                <?php include("consulta-cliente.ajax.php"); ?>

                                                </tbody>
                                            </table>

                                        </div><!--table-toolbar FIM-->
                                    </div><!--portlet-body FIM-->

                               </div><!--portlet light bordered FIM-->

                                    


            </div>
        </div>          
        <!-- END CONTAINER -->
        
        <!-- BEGIN RODA PÉ -->
        <?php include("../../comum/includes/rodape.php"); ?>
        <!-- BEGIN RODA PÉ -->

        <?php include("../../comum/includes/script.php"); ?>
        <?php include("../../comum/includes/script-tabela.php"); ?>

        <script src="js/cliente.js" type="text/javascript"></script>

        <?php 
            if($loContaItensFil == 0 && $loTelefoneFil != "" ){ 
        ?>

            <script>
                Cliente.AbrirModalAvisoCadastraCliente();      
            </script>

        <?php } ?>

    </body>

</html>