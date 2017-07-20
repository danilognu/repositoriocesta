<?php
	include("../../comum/comum.php");
    include("../modelo-produto.php");
    include("../negocio-produto.php");


$loIdProduto        = NULL;     
$loNome             = NULL;          
$loDescricao        = NULL;     
$loDtCad            = NULL;         
$loDtAlt            = NULL;         
$loNomePessoaAlt    = NULL; 
$loNomePessoaCad    = NULL; 
$loStatus           = 1;

if(isset($_REQUEST["id_produto"])){

    $loIdProduto = $_REQUEST["id_produto"];
    $loAcao = "U";
    $loDados = array("id_produto" => $loIdPessoa);

    $loProduto = new produtoBO();
    $loListaProduto =  $loProduto->ConsultaProduto($loDados);

    foreach ($loListaProduto as $row) {

        $loIdProduto        = $row->mbIdProduto;     
        $loNome             = $row->mbNome;          
        $loDescricao        = $row->mbDescricao;     
        $loDtCad            = $row->mbDtCad;         
        $loDtAlt            = $row->mbDtAlt;         
        $loNomePessoaAlt    = $row->mbNomePessoaAlt; 
        $loNomePessoaCad    = $row->mbNomePessoaCad; 
        $loStatus           = $row->mbStatus;

    }

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
                   
                    <!-- CONTEUDO FORM PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-inbox font-dark"></i>
                                        <span class="caption-subject font-dark sbold uppercase"> Adiciona Produto </span>
                                    </div>
                   
                                </div>
                                <div class="portlet-body form">
                                    <form class="form-horizontal" role="form">
                                        <div class="form-body">
                                        
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Nome *</label>
                                                <div class="col-md-5">
                                                    <input type="text" id="nome" class="form-control"  value="<?php echo $loNome; ?>" >
                                                  </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Descri&ccedil;&atilde;o</label>
                                                <div class="col-md-6">
                                                    <textarea id="descricao" cols="60" rows="5" > <?php echo $loDescricao; ?>  </textarea>
                                                 </div> 

                                            </div>   


                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Status</label>
                                                <div class="col-md-2">
                                                    <select class="form-control" id="status">
                                                        <option <?php if($loStatus == 1 ){ echo "selected"; }?> value="1" >Ativo</option>
                                                        <option <?php if($loStatus != 1  ){ echo "selected"; }?> value="0" >Desativado</option>
                                                    </select>                                                    
                                                </div>
                                                
                                           </div>
                                        </div>



                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="button" class="btn dark" id="btn-adicionar" >Adicionar</button>
                                                    <button type="button" id="btn-cancelar" class="btn default">Cancelar</button>
                                                    <input type="hidden" id="acao" value="<?php echo $loAcao; ?>" /> 
                                                    <input type="hidden" id="id_produto" value="<?php echo $loIdProduto; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- CONTEUDO FORM PORTLET-->

                                    


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