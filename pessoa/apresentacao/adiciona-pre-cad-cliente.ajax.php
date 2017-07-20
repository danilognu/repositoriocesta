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
$loIdPessoaCad      = NULL;
$loDtCad            = NULL;
$loDtAlt            = NULL;
$loStatus           = 1;
$loCnpj             = NULL;
$loTela             = NULL;

//Para Agenda
if(isset($_REQUEST["tela"])){ $loTela = $_REQUEST["tela"]; }

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
            $loTelefone3        = $row->mbTelefone3;
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
        <span class="caption-subject font-dark sbold uppercase"> Pre Cadastro Cliente </span>
    </div>
    <div class="portlet-body form">
        <form class="form-horizontal" role="form">
            <div class="form-body">
            
                <div class="form-group">
                    <label class="col-md-2 control-label">Nome *</label>
                    <div class="col-md-8">
                        <input type="text" id="nome-cliente-modal" class="form-control"  value="<?php echo $loNome; ?>" >
                        </div>
                </div>


                <div class="form-group">
                    <label class="col-md-2 control-label">Telefone1</label>
                    <div class="col-md-3">
                        <input type="text" id="telefone1-cliente-modal" class="form-control mask_telefone" value="<?php echo $loTelefone1; ?>"   >
                        </div>
                        <label class="col-md-2 control-label">Telefone2</label>
                        <div class="col-md-3">
                        <input type="text" id="telefone2-cliente-modal" class="form-control mask_celular"  value="<?php echo $loTelefone2; ?>"  >
                        </div>
                </div>

                
                <div class="form-group">
                    <label class="col-md-2 control-label">Telefone3</label>
                    <div class="col-md-3">
                        <input type="text" id="telefone3-cliente-modal" class="form-control mask_telefone" value="<?php echo $loTelefone1; ?>"   >
                        </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">Estado</label>
                    <div class="col-md-2">

                        <select class="form-control" nome="estado-cliente-modal" id="estado-cliente-modal" onchange="loacalizaCidadeSelectModal('');">
                        
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
                        <div class="col-md-4">

                        <select class="form-control" nome="cidade-cliente-modal" id="cidade-cliente-modal" class="cidade" >
                        </select>


                        </div>
                </div>  


                <div class="form-group">
                        <label class="col-md-2 control-label">E-mail</label>
                        <div class="col-md-7">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <input type="email" id="email-cliente-modal" class="form-control"  value="<?php echo $loEmail; ?>" > </div>
                        </div>
                    </div>
                </div>



            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="button" class="btn dark"  onclick="AdiconaPreCadCliente('<?php echo $loTela; ?>');" >Adicionar</button>
                        <button type="button" onclick="FecharPreCadCliente();" class="btn default">Cancelar</button>
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

function FecharPreCadCliente(){
     $('#modal-padrao').dialog("close");
}

function AdiconaPreCadCliente(prTela){

    var loNome = $("#nome-cliente-modal").val();
    var loTelefone1 = $("#telefone1-cliente-modal").val();
    var loTelefone2 = $("#telefone2-cliente-modal").val();
    var loTelefone3 = $("#telefone3-cliente-modal").val();
    var loCidade = $("#cidade-cliente-modal").val();
    var loEmail = $("#email-cliente-modal").val();
    var loIdTipoPessoa = 3;
    var id_pessoa = "";

    var loDados = jQuery.parseJSON( 
            '{ "nome": "'+loNome+'"'
            + ' , "id_cidade": "'+loCidade+'"'
            + ' , "telefone1": "'+loTelefone1+'"'
            + ' , "telefone2": "'+loTelefone2+'"'
            + ' , "telefone3": "'+loTelefone3+'"'
            + ' , "email": "'+loEmail+'"'
            + ' , "id_tipo_pessoa": "'+loIdTipoPessoa+'"'
            + ' , "id_pessoa": "'+id_pessoa+'"'
            + ' , "status": "1" }' 
         );


        $.ajax({
            data: {
                 dados: loDados
            }
            , type: "POST"
            , dataType: "json"
            , url: "../../pessoa/apresentacao/adiciona-cliente.ajax.php"
            , success: function (retorno) {

               if(retorno.erro){

                    bootbox.dialog({
                        message: retorno.messagem,
                        title: "Aviso",
                        buttons: {
                        success: {
                            label: "OK",
                            className: "dark"
                        }
                        }
                    });

               }else{

                    switch (prTela) {
                    case "agenda":
                            Agenda.ModalClienteCadastrado(retorno.id_pessoa);
                        break;
                    }

                     $('#modal-padrao').dialog("close");
               }

            }
        });           

}

<?php 
    if($loTela == "agenda"){
?>
        $("#telefone1-cliente-modal").val( $("#telefone-pesquisa").val() );    
<?php
    }
?>
<?php 
    if($loTela == "cliente"){
?>
        $("#telefone1-cliente-modal").val( $("#telefone").val() );    
<?php
    }
?>



</script>
        

