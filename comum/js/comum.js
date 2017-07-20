
// Objeto de acesso global
Comum = {};

(function () {
    var pub = Comum;

    // Objeto de acesso privado
    var priv = {};

     pub.AdicionarPreCadastroClienteTop = function(prDados){
        priv.buttonAdicionarPreCadastroClienteTop_onClick(prDados);
     }
    

    jQuery(function ($) {
        var optionsPadrao = {
            autoOpen: false
            , modal: true
        };

        $("#btn-adiciona-nova-anotacao").click(priv.buttonAdicionaNovaAnotacao_onClick);
        $(".abrir-anotacao-cadastrada").click(priv.buttonAbrirAnotacao_onClick);
        $(".abrir-anotacao-cadastrada").click(priv.buttonAbrirAnotacao_onClick);
        $("#btn-top-adicionar-pre-cad-cliente").click(priv.AdicionarPreCadastroClienteTop_onClick);
    });

    priv.AdicionarPreCadastroClienteTop_onClick = function(){
        priv.buttonAdicionarPreCadastroClienteTop_onClick("comum");
    }
    
    priv.buttonAdicionarPreCadastroClienteTop_onClick = function(prDados){

        $.ajax({
            data: {
                 tela: prDados
            }
            , type: "POST"
            , url: "../../pessoa/apresentacao/adiciona-pre-cad-cliente.ajax.php"
            , success: function (retorno) {

                $("#modal-padrao").html(retorno);
                var optionsPadraoVisualizar = {
                    autoOpen: false
                    , modal: true
                };

                $("#modal-padrao").dialog($.extend({
                    title: "Pre Cadastro Cliente"
                    , width: 800
                    , height: 450
                }, optionsPadraoVisualizar));
                $('#modal-padrao').dialog("open");   

            }
        }); 

    };

    priv.buttonAbrirAnotacao_onClick = function(){

        var id_anotacao = $(this).attr("id");

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

    priv.buttonAdicionaNovaAnotacao_onClick = function(){
        
        $.ajax({
            data: {
                 id_anotacao: ""
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

})();



function loacalizaCidadeSelect(id_cidade){


    var id_estado = $("#estado option:selected").val();

    $.ajax({
            data: {
                 id_estado: id_estado
                 ,id_cidade: id_cidade
            }
            , type: "POST"
            //, dataType: "json"
            , url: "../../comum/apresentacao/busca-cidade.ajax.php"
            , success: function (data) {

               $('#cidade').html("");
               $('#cidade').append(data);
            }
        });//Ajax
    
        
}

function loacalizaCidadeSelectModal(id_cidade){


    var id_estado = $("#estado-cliente-modal option:selected").val();

    $.ajax({
            data: {
                 id_estado: id_estado
                 ,id_cidade: id_cidade
            }
            , type: "POST"
            //, dataType: "json"
            , url: "../../comum/apresentacao/busca-cidade.ajax.php"
            , success: function (data) {

               $('#cidade-cliente-modal').html("");
               $('#cidade-cliente-modal').append(data);
            }
        });//Ajax
    
        
}