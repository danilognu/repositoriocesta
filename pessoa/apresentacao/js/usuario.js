
// Objeto de acesso global
Usuario = {};

(function () {
    var pub = Usuario;

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
        $(".abrir-pessoa").click(priv.buttonAbrirPessoa_onClick);

        //Adiciona
        $("#btn-adicionar").click(priv.buttonAdicionar_onClick);
        $("#btn-cancelar").click(priv.buttonCancelar_onClick);
        $("#login").blur(priv.inputVerificaLogin_onBlur);

    });


    priv.inputVerificaLogin_onBlur = function(){

         var loLogin = $(this).val();

        if(loLogin != ""){

            $.ajax({
                data: {
                    login: loLogin
                }
                , type: "POST"
                , dataType: "json"
                , url: "verifica-login.ajax.php"
                , success: function (retorno) {

                    if(retorno.cotagem > 0){

                        bootbox.dialog({
                            message: "Login ja cadatrado, favor alterar!",
                            title: "Aviso",
                            buttons: {
                            success: {
                                label: "OK",
                                className: "dark"
                            }
                            }
                        });

                        $("#login").val("");
                    }

                }
            }); 
              
        }


    };    

    priv.buttonAbrirPessoa_onClick = function(){

         var id_pessoa = $(this).attr("id");
         window.location.href = "adicionar-usuario.php?id_pessoa=" + id_pessoa;
    };

    priv.buttonCancelar_onClick = function(){
        window.location.href = "consulta-usuario.php";
    };

    priv.buttonAdicionar_onClick = function(){

        var loNome = $("#nome").val();
        var loCnpj = $("#cnpj").val();
        var loCep =  $("#cep").val();
        var loEndereco = $("#endereco").val();
        var loBairro =  $("#bairro").val();
        var loNumero = $("#numero").val();
        var loIdCidade = $("#cidade").val();
        var loComplemento = $("#complemento").val();
        var loTelefone1 = $("#telefone1").val();
        var loTelefone2 = $("#telefone2").val();
        var loEmail = $("#email").val();
        var loStatus = $("#status").val();
        var loIdPessoa = $("#id_pessoa").val();
        var loGrupoAcesso = $("#grupo-acesso").val();
        var loIdTipoPessoa = 1; //Tipo Pessoa   

        var loLogin = $("#login").val();
        var loSenha = $("#senha").val();
        var loSenhaConf = $("#confi-senha").val();     

        var loDados = jQuery.parseJSON( 
            '{ "nome": "'+loNome+'"'
            + ' , "cnpj": "'+loCnpj+'"'
            + ' , "cep": "'+loCep+'"'
            + ' , "endereco": "'+loEndereco+'"'
            + ' , "bairro": "'+loBairro+'"'
            + ' , "numero": "'+loNumero+'"'
            + ' , "id_cidade": "'+loIdCidade+'"'
            + ' , "complemento": "'+loComplemento+'"'
            + ' , "telefone1": "'+loTelefone1+'"'
            + ' , "telefone2": "'+loTelefone2+'"'
            + ' , "email": "'+loEmail+'"'
            + ' , "id_pessoa": "'+loIdPessoa+'"'
            + ' , "id_tipo_pessoa": "'+loIdTipoPessoa+'"'
            + ' , "login": "'+loLogin+'"'
            + ' , "senha": "'+loSenha+'"'
            + ' , "senhaConf": "'+loSenhaConf+'"'
            + ' , "id_grupo_acesso": "'+loGrupoAcesso+'"'
            + ' , "status": "'+loStatus+'" }' 
         );

          $.ajax({
            data: {
                 dados: loDados
            }
            , type: "POST"
            , dataType: "json"
            , url: "adiciona-usuario.ajax.php"
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
                     
                   window.location.href = "consulta-usuario.php";

               }

            }
        });          

    };

    priv.buttonPesquisarAdiciona_onClick = function(){
      window.location.href = "adicionar-usuario.php";  
    } 

    priv.buttonPesquisar_onClick = function(){

        var loNome = $("#nome").val();
        var loStatus = $("#status").val();

        var loDados = jQuery.parseJSON( 
            '{ "nome": "'+loNome+'"'
            + ' , "ativo": "'+loStatus+'"'
            + ' , "id_tipo_pessoa": "1" }' 
         );

          $.ajax({
            data: {
                 dados: loDados
            }
            , type: "POST"
            , dataType: "json"
            , url: "consulta-usuario.ajax.php"
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


