<?php
include_once("../../comum/comum.php");
include_once("../modelo-anotacao.php");
include_once("../negocio-anotacao.php");

$id_anotacao = NULL;
$loModalDesc = NULL;
$loModalAnotacaoVO = new anotacaoVO();

if (isset($_REQUEST["id_anotacao"]) && !empty($_REQUEST["id_anotacao"])){  

    $loModalAnotacaoVO->mbIdAnotacao = $_REQUEST["id_anotacao"];
    $loModalAnotacaoBO = new anotacaoBO();
    $loModalAnotacao = $loModalAnotacaoBO->ConsultaAnotacao($loModalAnotacaoVO);
    if(count($loModalAnotacao) > 0 ){
        foreach ($loModalAnotacao as $MotalAnotacao){
            $loModalDesc = $MotalAnotacao->mbDescricao;
        }
    }

}

?>
    <div class="portlet light bordered">
        <div class="portlet-body form">
            
            <form class="form-horizontal" role="form">
                <div class="form-body">

                    <div class="form-group">
                        <div class="col-md-6">
                            <textarea id="descricao-anotacao" cols="65" rows="5" ><?php echo $loModalDesc; ?></textarea>
                            </div> 

                    </div>   

                </div>
                
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="button" class="btn blue" id="btn-grava-desativa" onClick="GravaAnotacao(<?php echo $id_anotacao; ?>)" >Salvar Anotacao</button>
                            <input type="hidden" id="id_anotacao-modal" value="<?php echo $id_anotacao; ?>" />
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

<script>

    function GravaAnotacao(id_agenda){

        var id_anotacao = $("#id_anotacao-modal").val();
        var descricao = $("#descricao-anotacao").val();

        $.ajax({
            data: {
                 id_anotacao: id_anotacao
                 ,descricao: descricao
            }
            , type: "POST"
            , dataType: "json"
            , url: "../../anotacoes/apresentacao/grava-anotacao.ajax.php"
            , success: function (retorno) {
                //$('#modal-padrao').dialog("close"); 
                window.location.reload();
            }
        });              
    }

</script>