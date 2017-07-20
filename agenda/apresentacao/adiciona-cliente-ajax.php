<?php
include("../../comum/comum.php");
include("../../pessoa/modelo-pessoa.php");
include("../../pessoa/negocio-pessoa.php");


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
$loIdPessoaCad      = NULL;
$loDtCad            = NULL;
$loDtAlt            = NULL;
$loStatus           = 1;
$loCnpj             = NULL;

if(isset($_REQUEST["id_pessoa"])){

    $loIdPessoa = $_REQUEST["id_pessoa"];
    $loAcao = "U";
    $loDados = array("id_pessoa" => $loIdPessoa);


    $loPessoa = new pessoaBO();
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
            $loIdPessoaCad      = $row->mbIdPessoaCad;
            $loDtCad            = $row->mbDtCad;
            $loDtAlt            = $row->mbDtAlt;
            $loStatus           = $row->mbStatus;
            $loCnpj             = $row->mbCnpj;

    }

}


?>
          
                  
<!-- CONTEUDO FORM PORTLET-->
<div class="">
    <div class="caption">
        <i class="icon-settings font-dark"></i>
        <span class="caption-subject font-dark sbold uppercase"> Adiciona Cliente </span>
    </div>
    <div class="portlet-body form">
        <form class="form-horizontal" role="form">
            <div class="form-body">
            
                <div class="form-group">
                    <label class="col-md-1 control-label">Nome*</label>
                    <div class="col-md-5">
                        <input type="text" id="nome-cliente-modal" class="form-control"  value="<?php echo $loNome; ?>" >
                        </div>
                </div>

                <div class="form-group">
                    <label class="col-md-1 control-label">Endere&ccedil;o</label>
                    <div class="col-md-4">
                        <input type="text" id="endereco-cliente-modal" class="form-control"  value="<?php echo $loEndereco; ?> " >
                        </div>                    
                        <label class="col-md-1 control-label">Cep</label>
                        <div class="col-md-3">
                        <input type="text" id="cep-cliente-modal" class="form-control mask_cep"  value="<?php echo $loCep; ?>" >
                        </div>
                </div>  

                <div class="form-group">
                    <label class="col-md-1 control-label">Bairro</label>
                    <div class="col-md-3">
                        <input type="text" id="bairro-cliente-modal" class="form-control"  value="<?php echo $loBairro; ?>" >
                        </div>
                        <label class="col-md-2 control-label">Nr.</label>
                        <div class="col-md-1">
                        <input type="text" id="numero-cliente-modal" class="form-control mask_number"  value="<?php echo $loNumero; ?>" >
                        </div>
                </div>   


                <div class="form-group">
                    <label class="col-md-1 control-label">Telefone1</label>
                    <div class="col-md-3">
                        <input type="text" id="telefone1-cliente-modal" class="form-control mask_telefone" value="<?php echo $loTelefone1; ?>"   >
                        </div>
                        <label class="col-md-2 control-label">Telefone2</label>
                        <div class="col-md-3">
                        <input type="text" id="telefone2-cliente-modal" class="form-control mask_celular"  value="<?php echo $loTelefone2; ?>"  >
                        </div>
                </div>



            <div class="form-group">
                    <label class="col-md-1 control-label">E-mail</label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-envelope"></i>
                            </span>
                            <input type="email" id="email-cliente-modal" class="form-control"  value="<?php echo $loEmail; ?>" > </div>
                    </div>
                    <label class="col-md-1 control-label">Status</label>
                    <div class="col-md-2">
                        <select class="form-control" id="status-cliente-modal">
                            <option <?php if($loStatus == 1 ){ echo "selected"; }?> value="1" >Ativo</option>
                            <option <?php if($loStatus != 1  ){ echo "selected"; }?> value="0" >Desativado</option>
                        </select>                                                    
                    </div>
                </div>


                
            </div>



            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="button" class="btn dark"  onclick="ModalAdicionaClienteDados()" >Adicionar</button>
                        <button type="button" id="btn-cancelar-cliente" class="btn default">Cancelar</button>
                        <input type="hidden" id="acao" value="<?php echo $loAcao; ?>" /> 
                        <input type="hidden" id="id_pessoa" value="<?php echo $loIdPessoa; ?>" />
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- CONTEUDO FORM PORTLET-->
<script src="../../comum/js/form-input-mask.js" type="text/javascript"></script>
<script>

function ModalAdicionaClienteDados(){
    Agenda.ModalAdicionaClienteDados();
}

</script>
        

