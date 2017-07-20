
// Objeto de acesso global
Login = {};

(function () {
    var pub = Login;

    // Objeto de acesso privado
    var priv = {};

    jQuery(function ($) {
        var optionsPadrao = {
            autoOpen: false
            , modal: true
        };

        //Consulta 
        $(".btn-entrar").click(priv.buttonEntrar_onClick);
        $("#senha").keypress(priv.inputVerificaTecla_onKeyPress);

    });

    priv.inputVerificaTecla_onKeyPress = function(){
         if(event.keyCode == 13){ // Se for enter
            priv.buttonEntrar_onClick();           
        } 
    };

    priv.buttonEntrar_onClick = function(){

        var loLogin = $("#login").val();
        var loSenha = $("#senha").val();

        var loDados = jQuery.parseJSON( 
            '{ "login": "'+loLogin+'"'
            + ' , "senha": "'+loSenha+'" }' 
         );

          $.ajax({
            data: {
                 dados: loDados
            }
            , type: "POST"
            , dataType: "json"
            , url: "verifica-login.ajax.php"
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
                     window.location.href = "../../agenda/apresentacao/consulta-agenda.php";
               }

            }
        });      

    }
 
})();


