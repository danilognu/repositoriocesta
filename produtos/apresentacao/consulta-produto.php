<?php
	include("../../comum/comum.php");
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
                                        <i class="fa fa-inbox"></i>
                                        <span class="caption-subject bold uppercase"> Produtos </span>
                                    </div>
                                </div>

                                <!--div class="row">
                                    <div class="col-md-3">
                                        Nome:<input type="text" id="nome" name="nome" class="form-control"  value="">
                                    </div>
                                    <div class="col-md-3">
                                        <br/>
                                        <button id="btn-pesquisa" class="btn sbold dark"> Pesquisa
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>                                
                                </div-->
                                
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

                                                
                                                
                                                        <!--div class="col-md-1">

                                                            <div class="btn-group pull-right">
                                                                <button class="btn dark  btn-outline dropdown-toggle" data-toggle="dropdown">Exportar
                                                                    <i class="fa fa-angle-down"></i>
                                                                </button>
                                                                <ul class="dropdown-menu pull-right">
                                                                    <li>
                                                                        <a href="#" id="exportar-excel" >
                                                                            <i class="fa fa-file-excel-o"></i> Exportar Excel </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#" id="exportar-pdf" >
                                                                            <i class="fa fa-file-pdf-o"></i> Exportar PDF </a>
                                                                    </li>
                                                                    
                                                                </ul>
                                                            </div>
                                                        </div-->

                                                </div>

                                                <br/>

                                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                                <thead>
                                                    <tr>
            
                                                            <th>Codigo</th>
                                                            <th>Nome</th>
                                                            <th>Descri&ccedil;&atilde;o</th>

                                                    </tr>
                                                </thead>
                                                <tbody id="conteudo-consulta" >
                                                
                                                <?php include("consulta-produto.ajax.php"); ?>

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

        <script src="js/produto.js" type="text/javascript"></script>

    </body>

</html>