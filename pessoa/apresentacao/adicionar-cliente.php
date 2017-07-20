<?php
	include("../../comum/comum.php");
    include("../modelo-pessoa.php");
    include("../negocio-pessoa.php");


$loIdPessoa         = NULL;
$loNome             = NULL;
$loLogin            = NULL;
$loEmail            = NULL;
$loTipoPessoa       = NULL;
$loNomeTipoPessoa   = NULL;
$loEndereco         = NULL;
$loBairro           = NULL;
$loNumero           = NULL;
$loCep              = NULL;
$loComplemento      = NULL;
$loTelefone1        = NULL;
$loTelefone2        = NULL;
$loTelefone3        = NULL;
$loIdPessoaCad      = NULL;
$loDtCad            = NULL;
$loDtAlt            = NULL;
$loStatus           = 1;
$loCnpj             = NULL;
$loIdEstado         = NULL;
$loIdCidade         = NULL;
$loIdPessoaVendedor = NULL;
$loDataParaVisita   = NULL;

$loPessoa = new pessoaBO();

if(isset($_REQUEST["id_pessoa"])){

    $loIdPessoa = $_REQUEST["id_pessoa"];
    $loAcao = "U";
    $loDados = array("id_pessoa" => $loIdPessoa, "consulta_filtro" => 0);

   
    $loListaPessoa =  $loPessoa->ConsultaPessoa($loDados);


    foreach ($loListaPessoa as $row) {

            $loIdPessoa         = $row->mbIdPessoa;
            $loNome             = $row->mbNome;
            $loLogin            = $row->mbLogin;
            $loEmail            = $row->mbEmail;
            $loTipoPessoa       = $row->mbIdTipoPessoa;
            $loNomeTipoPessoa   = $row->mbNomeTipoPessoa;
            $loEndereco         = $row->mbEndereco;
            $loBairro           = $row->mbBairro;
            $loNumero           = $row->mbNumero;
            $loCep              = $row->mbCep;
            $loComplemento      = $row->mbComplemento;
            $loTelefone1        = $row->mbTelefone1;
            $loTelefone2        = $row->mbTelefone2;
            $loTelefone3        = $row->mbTelefone3;
            $loIdPessoaCad      = $row->mbIdPessoaCad;
            $loDtCad            = $row->mbDtCad;
            $loDtAlt            = $row->mbDtAlt;
            $loStatus           = $row->mbStatus;
            $loCnpj             = $row->mbCnpj;
            $loIdEstado         = $row->mbIdEstado;
            $loIdCidade         = $row->mbIdCidade;
            $loIdPessoaVendedor = $row->mbIdPessoaVendedor;
            $loDataParaVisita   = $row->mbDataParaVisita;

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
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject font-dark sbold uppercase"> Adiciona Cliente </span>
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
                                                <label class="col-md-2 control-label">CNPJ</label>
                                                <div class="col-md-3">
                                                    <input type="text" id="cnpj" class="form-control mask_cnpj"  value="<?php echo $loCnpj; ?>" >
                                                  </div>

                                            </div>   

                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Cep</label>
                                                <div class="col-md-3">
                                                    <input type="text" id="cep" class="form-control mask_cep"  value="<?php echo $loCep; ?>" >
                                                  </div>

                                            </div>   

                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Endere&ccedil;o</label>
                                                <div class="col-md-5">
                                                    <input type="text" id="endereco" class="form-control"  value="<?php echo $loEndereco; ?> " >
                                                  </div>
                                            </div>  

                                           <div class="form-group">
                                                <label class="col-md-2 control-label">Bairro</label>
                                                <div class="col-md-3">
                                                    <input type="text" id="bairro" class="form-control"  value="<?php echo $loBairro; ?>" >
                                                  </div>
                                                  <label class="col-md-1 control-label">Nr.</label>
                                                  <div class="col-md-1">
                                                    <input type="text" id="numero" class="form-control mask_number"  value="<?php echo $loNumero; ?>" >
                                                  </div>
                                            </div>   

                                            
                                           <div class="form-group">
                                                <label class="col-md-2 control-label">Estado</label>
                                                <div class="col-md-1">

                                                    <select class="form-control" nome="estado" id="estado" onchange="loacalizaCidadeSelect('');">
                                                    
                                                    <?php 

                                                        $loListaEstado = new comumBO();
                                                        
                                                        $loDados = NULL;
                                                        $loLista =  $loListaEstado->ListaEstado($loDados);
                                                       
                                                       echo "<option value='' ></option>" ;      
                                                        
                                                        foreach ($loLista as $row){
                                                            
                                                            $loSelected = "";
                                                            if($row->mbIdEstado == $loIdEstado){
                                                                $loSelected = "selected";
                                                            }

                                                            echo "<option value=".$row->mbIdEstado." ".$loSelected." >".$row->mbUF."</option>" ;      

                                                        }     
                                                    ?>
                                                    
                                                    </select>

                                                  </div>
                                                  <label class="col-md-1 control-label">Cidade</label>
                                                  <div class="col-md-3">

                                                    <select class="form-control" nome="cidade" id="cidade" class="cidade" >
                                                    </select>


                                                  </div>
                                            </div>  

                                                                                                                                                         

                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Complemento</label>
                                                <div class="col-md-5">
                                                    <input type="text" id="complemento" class="form-control"  value="<?php echo $loComplemento; ?>" >
                                                  </div>
                                            </div> 

                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Telefone 1</label>
                                                <div class="col-md-2">
                                                    <input type="text" id="telefone1" class="form-control mask_telefone" value="<?php echo $loTelefone1; ?>"   >
                                                  </div>
                                                  <label class="col-md-1 control-label">Telefone2</label>
                                                  <div class="col-md-2">
                                                    <input type="text" id="telefone2" class="form-control mask_celular"  value="<?php echo $loTelefone2; ?>"  >
                                                  </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Telefone 3</label>
                                                <div class="col-md-2">
                                                    <input type="text" id="telefone3" class="form-control mask_telefone" value="<?php echo $loTelefone3; ?>"   >
                                                  </div>
                                            </div>   
                                            
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Data para a visita</label>
                                                <div class="col-md-2">
                                                    <input type="text" id="data_para_visita" class="form-control mask_date_hora" value="<?php echo $loDataParaVisita; ?>"   >
                                                  </div>
                                            </div>                                               

                                       <div class="form-group">
                                                <label class="col-md-2 control-label">E-mail</label>
                                                <div class="col-md-5">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-envelope"></i>
                                                        </span>
                                                        <input type="email" id="email" class="form-control"  value="<?php echo $loEmail; ?>" > </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Vendedor</label>
                                                <div class="col-md-5">
                                                    <select class="form-control" id="id_pessoa_vendedor">
                                                        <?php                                                            
                                                        $loDados = array("id_tipo_pessoa" => 1, "ativo" => "S");

                                                        $loListaPessoa =  $loPessoa->ConsultaPessoa($loDados);


                                                        echo "<option value='' ></option>" ;      
                                                            
                                                            foreach ($loListaPessoa as $rwPessoas){
                                                                
                                                                $loSelected = "";
                                                                if(is_null($loIdPessoa)){
                                                                     if($rwPessoas->mbIdPessoa == $_SESSION["id_pessoa_usuario"]){
                                                                        $loSelected = "selected";
                                                                    }          
                                                                }else{
                                                                    if($rwPessoas->mbIdPessoa == $loIdPessoaVendedor){
                                                                        $loSelected = "selected";
                                                                    }
                                                                }

                                                                echo "<option value=".$rwPessoas->mbIdPessoa." ".$loSelected." >".$rwPessoas->mbNome."</option>" ;      

                                                            }     
                                                        ?>
                                                    </select>                                                    
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
                                                    <input type="hidden" id="id_pessoa" value="<?php echo $loIdPessoa; ?>" />
                                                    <input type="hidden" nome="id-menu" id="id-menu" value="<?php echo $IdMenu; ?>" />
                                                    <input type="hidden" nome="id-garagem-atual" id="id-garagem-atual" value="<?php echo $loIdLocalidadeGaragemAtual; ?>" />
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

        <script src="js/cliente.js" type="text/javascript"></script>
        <!--script src="../../comum/js/comum.js" type="text/javascript"></script-->

        <?php if($loIdCidade != ""){  ?>
        <script>loacalizaCidadeSelect(<?php echo $loIdCidade; ?>);</script>
        <?php } ?>

    </body>

</html>