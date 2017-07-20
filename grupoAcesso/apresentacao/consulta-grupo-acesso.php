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
    </head>  

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
                                        <span class="caption-subject bold uppercase"> Grupo Acesso </span>
                                    </div>
                                </div>

                               
                                <br />


                                <!--FILTRO BEGIN-->
                                <h5><i class="fa fa-filter"></i> Filtro</h5>
                   

                                <form class="form-inline" role="form" id="form-filtro">

                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Situa&ccedil;&atilde;o</label>
                                            <select class="form-control input-sm input-small" id="filtro-status" name="status" >
                                                <option value='A'>Ativos</option>
                                                <option value='D'>Desativados</option>
                                            </select>   
                                            </div>
                                        
                                        <div class="form-group">
                                        </div>
                                        <div class="btn-group btn-group-sm btn-group-solid">
                                                <a href="#" id="form-pesquisa-grupos" class="btn dark"> Pesquisar
                                                        <i class="fa fa-search"></i>
                                                </a>
                                        </div>
   

                                         <input type="hidden" name="id-menu-exp" id="id-menu-exp" value="<?php //echo $IdMenu; ?>" />
                                         <input type="hidden" name="nomenclatura" id="nomenclatura" value="Solicitacao" />
                                         <input type="hidden" name="titulo" id="titulo" value="Relatorio Solicitacao" />         
                                    </form>

                                    <br />                                
                                <!--FILTRO END-->    




                                    <div class="portlet-body">
                                        <div class="table-toolbar"> 

                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <div class="btn-group btn-group-sm btn-group-solid">
                                                            <button id="btn-pesquisa-adiciona" class="btn sbold dark"> Adicionar
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                
                                                
           
                                                </div>

                                                <br/>

                                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                                <thead>
                                                    <tr>
            
                                                            <th></th>
                                                            <th>Nome</th>
                                                            <th>A&ccedil;&atilde;o</th>

                                                    </tr>
                                                </thead>
                                                <tbody id="conteudo-consulta" >
                                                
                                                <?php include("consulta-grupo-acesso.ajax.php"); ?>

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

        <script src="js/grupo-acesso.js" type="text/javascript"></script>

    </body>

</html>