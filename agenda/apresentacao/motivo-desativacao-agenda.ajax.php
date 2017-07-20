<?php
$id_agenda = NULL;
if(isset($_REQUEST["id_agenda"])){
    $id_agenda = $_REQUEST["id_agenda"];
}
?>


                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-inbox font-dark"></i>
                                        <span class="caption-subject font-dark sbold uppercase"> Motivo  Desativa&ccedil;&atilde;o</span>
                                    </div>
                   
                                </div>
                                <div class="portlet-body form">
                                    <form class="form-horizontal" role="form">
                                        <div class="form-body">

                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <textarea id="motivo-desativacao" cols="65" rows="5" > </textarea>
                                                 </div> 

                                            </div>   

                                        </div>


                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="button" class="btn red" id="btn-grava-desativa" onClick="GravaDesativaAgendamento(<?php echo $id_agenda; ?>)" >Gravar /  Desativar</button>
                                                    <input type="hidden" id="id_agenda" value="<?php echo $id_agenda; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

<script>

    function GravaDesativaAgendamento(id_agenda){

        var id_agenda = $("#id_agenda").val();
        var motivo_desativacao = $("#motivo-desativacao").val();

        var loDados = jQuery.parseJSON( 
            '{ "id_agenda": "'+id_agenda+'"'
            + ' , "motivo_desativacao": "'+motivo_desativacao+'" }' 
         );   


        $.ajax({
            data: {
                 dados: loDados
            }
            , type: "POST"
            , url: "grava-motivo-desativacao-agenda.ajax.php"
            , success: function (retorno) {
                $('#dialog-message').dialog("close"); 
                window.location.href = "consulta-agenda.php";
            }
        });              
    }

</script>