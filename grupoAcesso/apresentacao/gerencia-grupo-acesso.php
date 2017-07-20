<?php
	include("../../comum/comum.php");
    include("../modelo-grupo-acesso.php");
    include("../negocio-grupo-acesso.php");

$loNome                     = NULL;
$loIndExibirAgenda          = NULL;
$loIndGrupoPadrao           = NULL;
$loIndExibirAgendaCheck     = NULL;
$loIndGrupoPadraoCheck      = NULL;


$loIdGrupoAcesso = $_REQUEST["id_grupo_acesso"];

$loComum = new comumBO();
$loGrupoBO = new grupoAcessoBO();

$loDados = array("id_grupo_acesso" => $loIdGrupoAcesso);
$loGrupo = $loGrupoBO->ConsultaGrupo($loDados);

foreach ($loGrupo as $row){

    $loNome = $row->mbNome;
    $loIndGrupoPadrao = $row->mbIndPadrao;
    $loIndExibirAgenda = $row->mbIndExibeAgen;

    if($loIndGrupoPadrao == 1){ $loIndGrupoPadraoCheck = "checked"; }
    if($loIndExibirAgenda == 1){ $loIndExibirAgendaCheck = "checked"; }

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


        <link href="../../../assets/global/plugins/jstree/dist/themes/default/style.min.css" rel="stylesheet" type="text/css" />
        <link href="../../../assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="../../../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <link href="../../../assets/global/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" />


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
                                        <span class="caption-subject bold uppercase"> Grupo Acesso - <?php echo $loNome; ?> </span>
                                    </div>
                                </div>

                               
                                <br />

                                    <div class="portlet-body">
                                        <div class="table-toolbar"> 

                                    <div class="row">
                                    </div>

                                    <br/>

                                          


                                <div class="portlet-body">
                                    <div id="tree_1" class="tree-demo">
                                        <ul>


                                        <?php

                                                $loDadosMenu = array("join" => 1);

                                                $loListaMenu =  $loComum->MenuPai($loDadosMenu);

                                                if(count($loListaMenu) > 0 ){

                                                    foreach ($loListaMenu as $row){
                                                        //Menu Mae
                                                    ?>

                                                       <li data-jstree='{ "selected" : false }'>
                                                            <a href="javascript:;"> <?php echo $row->mbNome; ?> </a>

                                                            <ul>
                                                            <?php 

                                                               
                                                                //Aqui é definido as permissoes no meu que nao pai
                                                                //Agenda - Anotações BEGIN 
                                                                if($row->mbIdNome == 2 || $row->mbIdNome == 3){

                                                                    $loGrupoVO = new permissoesGrupoVO();
                                                                    $loGrupoVO->mbIdGrupoAcesso = $loIdGrupoAcesso;
                                                                    $loGrupoVO->mbIdMenu = $row->mbIdNome;

                                                                    $loListaPerm =  $loGrupoBO->VerificaPermissao($loGrupoVO);
                                                                    
                                                                    $class_Consult = "fa fa-close";
                                                                    $class_Alt = "fa fa-close";
                                                                    $class_Ex = "fa fa-close";
                                                                    $loAcesso_c = 0;
                                                                    $loAcesso_a = 0;
                                                                    $loAcesso_e = 0;
                                                                    if(count($loListaPerm) > 0 ){
                                                                        foreach ($loListaPerm as $rowPerm){

                                                                            if($rowPerm->mbTipo == "V"){
                                                                                $class_Consult = "fa fa-check";
                                                                                $loAcesso_c = 1;
                                                                            }
                                                                            if($rowPerm->mbTipo == "A"){
                                                                                $class_Alt = "fa fa-check";
                                                                                $loAcesso_a = 1;
                                                                            }
                                                                            if($rowPerm->mbTipo == "C"){
                                                                                $class_Ex = "fa fa-check";
                                                                                $loAcesso_e = 1;
                                                                            }

                                                                        }
                                                                    }

                                                                ?>
                                                                    <li data-jstree='{ "selected" : false }'> Permiss&otilde;es
                                                                        <!--ul-->
                                                                            <li data-jstree='{ "type" : "file" }' onClick="GrupoAcesso.ValidaPermissao(<?php echo $loIdGrupoAcesso; ?>,<?php echo $row->mbIdNome; ?>,'V',<?php echo $loAcesso_c; ?>,'<?php echo $class_Consult; ?>',this);"> 
                                                                                    <span class="<?php echo $class_Consult; ?>" id="<?php echo $loIdGrupoAcesso ?><?php echo $row->mbIdNome; ?>V"></span> 
                                                                                    Visualizar                                                                              </li>
                                                                            <li data-jstree='{ "type" : "file" }'  onClick="GrupoAcesso.ValidaPermissao(<?php echo $loIdGrupoAcesso; ?>,<?php echo $row->mbIdNome; ?>,'A',<?php echo $loAcesso_a; ?>,'<?php echo $class_Alt; ?>',this);" > 
                                                                                <span class="<?php echo $class_Alt; ?>" id="<?php echo $loIdGrupoAcesso ?><?php echo $row->mbIdNome; ?>A"></span>
                                                                                    Altera&#231;&otilde;es 
                                                                            </li>
                                                                                <li data-jstree='{ "type" : "file" }'  onClick="GrupoAcesso.ValidaPermissao(<?php echo $loIdGrupoAcesso; ?>,<?php echo $row->mbIdNome; ?>,'C',<?php echo $loAcesso_a; ?>,'<?php echo $class_Ex ; ?>',this);" > 
                                                                                <span class="<?php echo $class_Ex ; ?>" id="<?php echo $loIdGrupoAcesso ?><?php echo $row->mbIdNome; ?>C"></span>
                                                                                    Cancelar
                                                                            </li>
                                                                        <!--/ul-->
                                                                    </li>   
                                                                <?php    
                                                                }else{////Agenda - Anotações END

                                                                    //SUB MENU NEGIN
                                                                    //Aqui é gerado as permissoes e os menus filhos
                                                                    $loDadosM = array("id_menu_pai" => $row->mbIdNome, "join" => 1);
                                                                    $loListaMenuFilho =  $loComum->MenuFilhos($loDadosM);

                                                                    if(count($loListaMenuFilho) > 0 ){
                                                                        foreach ($loListaMenuFilho as $rowSub){
                                                                            //Menu Filho
                                                                        ?>
                                                                            
                                                                            <li data-jstree='{ "selected" : false }'> 
                                                                            
                                                                                <a href="javascript:;"><?php echo $rowSub->mbNome; ?> </a>
                                                                                <ul>

                                                                                    <?php

                                                                                    $loGrupoVO = new permissoesGrupoVO();
                                                                                    $loGrupoVO->mbIdGrupoAcesso = $loIdGrupoAcesso;
                                                                                    $loGrupoVO->mbIdMenu = $rowSub->mbIdNome;

                                                                                    $loListaPerm =  $loGrupoBO->VerificaPermissao($loGrupoVO);
                                                                                    
                                                                                    $class_Consult = "fa fa-close";
                                                                                    $class_Alt = "fa fa-close";
                                                                                    $class_Ex = "fa fa-close";
                                                                                    $loAcesso_c = 0;
                                                                                    $loAcesso_a = 0;
                                                                                    $loAcesso_e = 0;
                                                                                    if(count($loListaPerm) > 0 ){
                                                                                        foreach ($loListaPerm as $rowPerm){
                                                                                            if($rowPerm->mbTipo == "V"){
                                                                                                $class_Consult = "fa fa-check";
                                                                                                $loAcesso_c = 1;
                                                                                            }
                                                                                            if($rowPerm->mbTipo == "A"){
                                                                                                $class_Alt = "fa fa-check";
                                                                                                $loAcesso_a = 1;
                                                                                            }
                                                                                            if($rowPerm->mbTipo == "C"){
                                                                                                $class_Ex = "fa fa-check";
                                                                                                $loAcesso_e = 1;
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                    ?>

                                                                                    <li data-jstree='{ "type" : "file" }' onClick="GrupoAcesso.ValidaPermissao(<?php echo $loIdGrupoAcesso; ?>,<?php echo $rowSub->mbIdNome; ?>,'V',<?php echo $loAcesso_c; ?>,'<?php echo $class_Consult; ?>',this);"> 
                                                                                        <span class="<?php echo $class_Consult; ?>" id="<?php echo $loIdGrupoAcesso ?><?php echo $rowSub->mbIdNome; ?>V"></span> 
                                                                                        Visualizar 
                                                                                    </li>
                                                                                    <li data-jstree='{ "type" : "file" }'  onClick="GrupoAcesso.ValidaPermissao(<?php echo $loIdGrupoAcesso; ?>,<?php echo $rowSub->mbIdNome; ?>,'A',<?php echo $loAcesso_a; ?>,'<?php echo $class_Alt; ?>',this);" > 
                                                                                        <span class="<?php echo $class_Alt; ?>" id="<?php echo $loIdGrupoAcesso ?><?php echo $rowSub->mbIdNome; ?>A"></span>
                                                                                        Altera&#231;&otilde;es 
                                                                                    </li>
                                                                                        <li data-jstree='{ "type" : "file" }'  onClick="GrupoAcesso.ValidaPermissao(<?php echo $loIdGrupoAcesso; ?>,<?php echo $rowSub->mbIdNome; ?>,'C',<?php echo $loAcesso_a; ?>,'<?php echo $class_Ex ; ?>',this);" > 
                                                                                        <span class="<?php echo $class_Ex ; ?>" id="<?php echo $loIdGrupoAcesso ?><?php echo $rowSub->mbIdNome; ?>C"></span>
                                                                                        Cancelar
                                                                                    </li>
                                                                                </ul>

                                                                            </li>
                                                                        
                                                                        <?php    
                                                                        }
                                                                    }
                                                                    //SUB MENU END
                                                                }
                                                            ?>
                                                            </ul>    

                                                       </li>

                                                    <?php
                                                
                                                    }
                                                }

                                        ?>
                                          
                                          
                                        </ul>
                                    </div>
                                </div>


                            <br />
                            <br />

                           <div class="form-group">
                                <label>Tipo Acesso</label>
                                <div class="input-group">
                                    <div class="icheck-list">
                                        <label>
                                            <input type="checkbox" id="ind-exibe-agenda" <?php echo $loIndExibirAgendaCheck; ?> class="icheck" data-checkbox="icheckbox_square-grey"> Exibir somente minha agenda
                                        </label>     

                                        <label>
                                            <input type="checkbox" id="ind-grupo-padrao" <?php echo $loIndGrupoPadraoCheck; ?> class="icheck" data-checkbox="icheckbox_square-grey"> Definir como Usu&aacute;rio Padr&atilde;o 
                                        </label>                                                                              
                                         
                                    </div>
                                </div>
                            </div>

                            <br />


                            </div>



                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="button" class="btn dark" id="btn-adicionar-gerencia-grupo" >Adicionar</button>
                                        <button type="button" id="btn-voltar-gerencia-grupo" class="btn default">Voltar <i class="fa fa-mail-reply"></i></button>
                                        <input type="hidden" id="id_grupo_acesso" value="<?php echo $loIdGrupoAcesso ?>" />
                                    </div>
                                </div>
                            </div>




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

        <script src="../../../assets/global/plugins/jstree/dist/jstree.min.js" type="text/javascript"></script>
        <script src="../../../assets/pages/scripts/ui-tree.min.js" type="text/javascript"></script>

        <script src="../../../assets/pages/scripts/form-icheck.min.js" type="text/javascript"></script>
        <script src="../../../assets/global/plugins/icheck/icheck.min.js" type="text/javascript"></script>


    </body>

</html>