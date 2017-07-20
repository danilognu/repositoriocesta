
// Objeto de acesso global
Anotacao = {};

(function () {
    var pub = Anotacao;

    // Objeto de acesso privado
    var priv = {};


    jQuery(function ($) {
        var optionsPadrao = {
            autoOpen: false
            , modal: true
        };

        //Consulta 
        $("#btn-pesquisa").click(priv.buttonConsultaAnotacoes_onClick);
        $(".desativa-anotacao").click(priv.buttonDesativaAnotacao_onClick);
        $(".abrir-anotacao").click(priv.buttonAbrirAnotacao_onClick);
        $("#btn-pesquisa-adiciona").click(priv.buttonAbrirAnotacao_onClick);

    });
    

    priv.buttonAbrirAnotacao_onClick = function(){
        
        var id_anotacao = "";
        if(isNaN($(this).attr("id"))){
            id_anotacao = "";
        }else{
            id_anotacao = $(this).attr("id");
        }

        $.ajax({
            data: {
                 id_anotacao: id_anotacao
            }
            , type: "POST"
            , url: "../../anotacoes/apresentacao/modal-cadastra-anotacao.php"
            , success: function (retorno) {

                $("#modal-padrao").html(retorno);
                var optionsPadraoVisualizar = {
                    autoOpen: false
                    , modal: true
                };

                $("#modal-padrao").dialog($.extend({
                    title: "Cadastra Nova Anotacao"
                    , width: 550
                    , height: 350
                }, optionsPadraoVisualizar));
                $('#modal-padrao').dialog("open");   

            }
        }); 

    };

    priv.buttonConsultaAnotacoes_onClick = function(){
        
        var loStatus = $("#status").val();

        $.ajax({
            data: {
                 status: loStatus
            }
            , type: "POST"
            , url: "consulta-anotacoes.ajax.php"
            , success: function (retorno) {

              $("#conteudo-consulta").html(retorno);

            }
        }); 
        
    };

    priv.buttonDesativaAnotacao_onClick = function(){
        
         var id_anotacao = $(this).attr('id');
        $.ajax({
            data: {
                 id_anotacao: id_anotacao
            }
            , type: "POST"
            , url: "desativa-anotacao.ajax.php"
            , success: function (retorno) {

                window.location.href = "consulta-anotacoes.php";

            }
        });  

    };

    
})();


