
// Objeto de acesso global
Produto = {};

(function () {
    var pub = Produto;

    // Objeto de acesso privado
    var priv = {};

    jQuery(function ($) {
        var optionsPadrao = {
            autoOpen: false
            , modal: true
        };

        //Consulta 
        $("#btn-pesquisa").click(priv.buttonPesquisar_onClick);
        $("#btn-pesquisa-adiciona").click(priv.buttonPesquisarAdiciona_onClick);
        $(".abrir-produto").click(priv.buttonAbrirProduto_onClick);

        //Adiciona
        $("#btn-adicionar").click(priv.buttonAdicionar_onClick);
        $("#btn-cancelar").click(priv.buttonCancelar_onClick);

    });

    priv.buttonAbrirProduto_onClick = function(){
        
        var id_produto = $(this).attr("id");
         window.location.href = "adicionar-produto.php?id_produto=" + id_produto;

    };

    priv.buttonCancelar_onClick = function(){
        window.location.href = "consulta-produto.php";
    };

    priv.buttonAdicionar_onClick = function(){

        var loNome = $("#nome").val();
        var loDescricao = $("#descricao").val();
        var loStatus = $("#status").val();
        var loIdProduto = $("#id_produto").val();
        

        var loDados = jQuery.parseJSON( 
            '{ "nome": "'+loNome+'"'
            + ' , "descricao": "'+loDescricao+'"'
            + ' , "id_produto": "'+loIdProduto+'"'
            + ' , "status": "'+loStatus+'" }' 
         );

          $.ajax({
            data: {
                 dados: loDados
            }
            , type: "POST"
            , dataType: "json"
            , url: "adiciona-produto.ajax.php"
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
                   window.location.href = "consulta-produto.php";
               }

            }
        });          

    };

    priv.buttonPesquisarAdiciona_onClick = function(){
      window.location.href = "adicionar-produto.php";  
    } 

    priv.buttonPesquisar_onClick = function(){

        var loNome = $("#nome").val();
        var loTelefone = $("#telefone").val();

        var loDados = jQuery.parseJSON( 
            '{ "nome": "'+loNome+'"'
            + ' , "telefone": "'+loTelefone+'"'
            + ' , "id_tipo_pessoa": "3" }' 
         );

          $.ajax({
            data: {
                 dados: loDados
            }
            , type: "POST"
            , dataType: "json"
            , url: "consulta-cliente.ajax.php"
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
                     
                    $("#conteudo-consulta").val(retorno.consulta);

               }

            }
        });  

    };
    
})();


