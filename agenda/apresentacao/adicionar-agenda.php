<?php
	include("../../comum/comum.php");
    include("../modelo-agenda.php");
    include("../negocio-agenda.php");

    include("../../produtos/modelo-produto.php");
    include("../../produtos/negocio-produto.php");

    include("../../pessoa/modelo-pessoa.php");
    include("../../pessoa/negocio-pessoa.php");


$loIdAgenda             = NULL;
$loIdPessoaCliente      = NULL;
$loNomeCliente          = NULL;
$loDataVisita           = NULL;
$loIndVisitado          = 0;
$loDtCad                = NULL;
$DtAlt                  = NULL;
$IdPessoaCad            = NULL;
$NomePessoaCad          = NULL;
$loIdPessoaAlt          = NULL;
$loNomePessoaAlt        = NULL;
$loStatus               = 1;
$loTelefone1Cliente     = NULL;
$loIdProduto            = NULL;
$loObservacao           = NULL;
$loQtdProduto           = NULL;
$loDataParaVisita       = NULL;


$loAgendaFiltroVO = new agendaFiltroVO();
$loProduto = new produtoBO();
$loPessoa = new pessoaBO();
$loAgenda = new agendaBO();

if(isset($_REQUEST["id_agenda"])){

    $loIdAgenda = $_REQUEST["id_agenda"];
    $loAcao = "U";    
    $loAgendaFiltroVO->mbIdAgenda = $loIdAgenda;    
    $loListaAgenda =  $loAgenda->ConsultaAgenda($loAgendaFiltroVO);

    foreach ($loListaAgenda as $row) {

        $loIdAgenda             = $row->mbIdAgenda;            
        $loIdPessoaCliente      = $row->mbIdPessoaCliente;
        $loNomeCliente          = $row->mbNomeCliente;
        $loDataVisita           = $row->mbDataVisita;
        $loIndVisitado          = $row->mbIndVisitado;
        $loDtCad                = $row->mbDtCad;
        $DtAlt                  = $row->mbDtAlt;
        $IdPessoaCad            = $row->mbIdPessoaCad;
        $NomePessoaCad          = $row->mbNomePessoaCad;
        $loIdPessoaAlt          = $row->mbIdPessoaAlt;
        $loNomePessoaAlt        = $row->mbNomePessoaAlt;
        $loStatus               = $row->mbAtivo;
        $loTelefone1Cliente     = $row->mbTelefone1Cliente;
        $loIdProduto            = $row->mbIdProdutos;
        $loObservacao           = $row->mbObservacao;   
        $loQtdProduto           = $row->mbQtdProduto;  
        $loDataParaVisita       = $row->mbDataParaVisita; 

    }

}

//Recupera dados agendamento antigo
if(isset($_REQUEST["id_agenda_ant"])){

    $loIdAgendaAnt = $_REQUEST["id_agenda"];
    $loAcao = "U";    
    $loAgendaFiltroVO->mbIdAgenda = $loIdAgendaAnt;    
    $loListaAgenda =  $loAgenda->ConsultaAgenda($loAgendaFiltroVO);

    foreach ($loListaAgenda as $row) {

        $loIdPessoaCliente      = $row->mbIdPessoaCliente;
        $loNomeCliente          = $row->mbNomeCliente;
        $loIdProduto            = $row->mbIdProdutos;

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
        <link href="../../comum/js/jquery-ui-1.12.1.custom/jquery-ui.css" rel="stylesheet" type="text/css" />

        <link href="../../../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="../../../assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />

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
                   
                    <!-- CONTEUDO FORM PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-inbox font-dark"></i>
                                        <span class="caption-subject font-dark sbold uppercase"> Agenda </span>
                                    </div>
                   
                                </div>
                                <div class="portlet-body form">
                                    <form class="form-horizontal" role="form">
                                        <div class="form-body">
                                        
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Data Agendada *</label>
                                                <div class="col-md-2">
                                                    <input type="text" id="data-agendada" class="form-control mask_date data_calendario"  value="<?php echo $loDataVisita; ?>" >
                                                  </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Telefone</label>
                                                <div class="col-md-2">
                                                    <input type="text" id="telefone-pesquisa" class="form-control mask_telefone telefone-pesquisa"  value="<?php echo $loTelefone1Cliente; ?>" >
                                                  </div>
                                                  <label><h6><i class="fa fa-question"></i> &nbsp;Este campo &eacute; somente para pesquisa</h6></label>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Cliente *</label>
                                                <div class="col-md-4">
                                                    <select class="form-control select2me" name="options2" id="select-cliente"  >
                                                    <option value=""></option>
                                                    <?php
                                                            $loDados = array("id_tipo_pessoa" => 3, "consulta_filtro" => 1);                                                            
                                                            $loListaPessoa = $loPessoa->ConsultaPessoa($loDados);

                                                            if(count($loListaPessoa) > 0){

                                                                foreach ($loListaPessoa as $row){
                                                                    
                                                                    $loSelected = NULL;
                                                                    if($row->mbIdPessoa == $loIdPessoaCliente){
                                                                        $loSelected = "selected";
                                                                    }
                                                    ?>
                                                                    <option <?php echo $loSelected; ?> value="<?php echo $row->mbIdPessoa; ?>"><?php echo $row->mbNome; ?></option>
                                                        <?php
                                                                }
                                                            }
                                                                    
                                                        ?>
                                                    </select>
                                                    <input type="hidden" id="id_pessoa_cliente" class="form-control" value="<?php echo $loIdPessoaCliente; ?>" >
                                                </div>
                                                <div class="col-md-2">
                                                    <a href="#" id="pesquisa-cliente" class="btn btn-default"><i class="fa fa-search"></i></a>
                                                    <a href="#" id="adicionar-cliente-novo" class="btn btn-default"><i class="fa fa-plus"></i></a>
                                                </div>                                                  
                                            </div>    
                                            
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Data Para Visita</label>
                                                <div class="col-md-2">
                                                    <input type="text" id="data-para-visita" class="form-control" disabled value="<?php echo $loDataParaVisita; ?>" >
                                                  </div>
                                            </div>                                            

                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Observa&ccedil;&atilde;o</label>
                                                <div class="col-md-6">
                                                    <textarea id="observacao" cols="60" rows="5" ><?php echo $loObservacao; ?></textarea>
                                                 </div> 
                                            </div>   
                      
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Produtos</label>
                                                <div class="col-md-2">
                                                    <select class="form-control" name="" id="select-produto" >
                                                        <option value=""></option>
                                                        <?php
                                                                $loDadosP = NULL; 
                                                                
                                                                $loListaProdutos = $loProduto->ConsultaProduto($loDadosP);

                                                                if(count($loListaProdutos) > 0){

                                                                    foreach ($loListaProdutos as $row){
                                                                        
                                                                        $loSelected = NULL;
                                                                        if($row->mbIdProduto == $loIdProduto){
                                                                            $loSelected = "selected";
                                                                        }
                                                        ?>
                                                                        <option <?php echo $loSelected; ?> value="<?php echo $row->mbIdProduto; ?>"><?php echo $row->mbNome; ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                        
                                                            ?>
                                                    </select>                                                
                                                </div>
                                                <label class="col-md-1 control-label">Qtd Prod.</label>
                                                <div class="col-md-1">
                                                    <input type="text" class="form-control input-sm" name="qtd-produto" id="qtd-produto" value="<?php echo $loQtdProduto; ?>"  >
                                                </div>
                                            </div>    

 

                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Visitado</label>
                                                <div class="col-md-2">
                                                    <select class="form-control" id="visitado">
                                                        <option <?php if($loIndVisitado == 1 ){ echo "selected"; }?> value="1" >SIM</option>
                                                        <option <?php if($loIndVisitado == 0  ){ echo "selected"; }?> value="0" >NAO</option>
                                                    </select>                                                    
                                                </div>                                                
                                           </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Status</label>
                                                <div class="col-md-2">
                                                    <select class="form-control" id="status" disabled>
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
                                                    <button type="button" id="btn-imprimir" class="btn default"> <i class="fa fa-file-pdf-o"></i> Imprimir PDF</button>
                                                    <button type="button" id="btn-voltar" class="btn default"><i class="fa fa-mail-reply"></i> Voltar </button>
                                                    <?php if(isset($_REQUEST["id_agenda"])){ ?>
                                                    <button type="button" id="btn-desativar" class="btn red"><i class="fa fa-close"></i> Desativar</button>
                                                    <?php } ?>
                                                    <input type="hidden" id="acao" value="<?php echo $loAcao; ?>" /> 
                                                    <input type="hidden" id="id_agenda" value="<?php echo $loIdAgenda; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- CONTEUDO FORM PORTLET-->

                                    


            </div>
        </div>     
        <div id="dialog-message"></div>     
        <!-- END CONTAINER -->
        
        <!-- BEGIN RODA PÉ -->
        <?php include("../../comum/includes/rodape.php"); ?>
        <!-- BEGIN RODA PÉ -->

        <?php include("../../comum/includes/script.php"); ?>
        <?php //include("../../comum/includes/script-tabela.php"); ?>

        <script src="../../comum/js/jquery-ui-1.12.1.custom/jquery-ui.js" type="text/javascript"></script>
        <script src="../../../assets/global/plugins/select2/js/select2.full.js" type="text/javascript"></script>
        <script src="js/agenda.js" type="text/javascript"></script>


        <script src="../../../assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="../../../assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="../../../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="../../../assets/pages/scripts/table-datatables-managed-agenda.js" type="text/javascript"></script>

        

    </body>

</html>