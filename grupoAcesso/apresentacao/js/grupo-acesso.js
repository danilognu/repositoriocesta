
// Objeto de acesso global
GrupoAcesso = {};

(function () {
    var pub = GrupoAcesso;

    // Objeto de acesso privado
    var priv = {};

    pub.buttonAletarGrupo_onClick = function(codigo){
       
       var id_grupo_acesso = codigo;
       window.location.href = "adiciona-grupo-acesso.php?id_grupo_acesso=" + id_grupo_acesso;

    };

    pub.ValidaPermissao = function(idGrupo,idMenu,perm,acesso,css_class,obj){

        var loTipoSelecao = "";
        if($(obj).find("span").attr("class") == "fa fa-check"){
            loTipoSelecao = "deleta";
        }

        if($("#"+idGrupo+idMenu+perm).attr('class') == "fa fa-check" ){
          $("#"+idGrupo+idMenu+perm).removeClass("fa fa-check").addClass("fa fa-close");
        }else if($("#"+idGrupo+idMenu+perm).attr('class') == "fa fa-close" ){
           $("#"+idGrupo+idMenu+perm).removeClass("fa fa-close").addClass("fa fa-check");
        }

        console.log("loTipoSelecao = " + loTipoSelecao);

        var loDados = jQuery.parseJSON( 
            '{ "id_grupo": "'+idGrupo+'"'
            + ' , "id_menu": "'+idMenu+'"'
            + ' , "perm": "'+perm+'"'
            + ' , "tipo_selecao": "'+loTipoSelecao+'"'
            + ' , "acesso": "'+acesso+'" }' 
        );

        $.ajax({
            data: {
                dados: loDados
            }
            , type: "POST"
            , dataType: "json"
            , url: "gravar-permissao.ajax.php"
            , success: function (retorno) {                    
            }
        });
    
    }

    jQuery(function ($) {
        var optionsPadrao = {
            autoOpen: false
            , modal: true
        };

        //Consulta 
        $("#btn-pesquisa-adiciona").click(priv.buttonPesquisarAdiciona_onClick);
        $(".btn-aletrar").click(priv.buttonAletar_onClick);
        $(".btn-gerenciar").click(priv.buttonGerenciarGrupo_onClick);
        $("#form-pesquisa-grupos").click(priv.buttonPesquisaGrupo_onClick);

        //Adiciona
        $("#btn-adicionar").click(priv.buttonAdicionar_onClick);
        $("#btn-cancelar").click(priv.buttonCancelar_onClick);

        //Gerencia Grupo Acesso 
        $("#btn-voltar-gerencia-grupo").click(priv.buttonVoltarGrupoAcesso_onClick);
        $("#btn-adicionar-gerencia-grupo").click(priv.buttonAdicionaGerenciaGrupo_onClick);

    });

    priv.buttonAdicionaGerenciaGrupo_onClick = function(){

        var indExibeAgenda = "";
        if($("#ind-exibe-agenda").is(":checked")){ indExibeAgenda = 1;}else{ indExibeAgenda = 0} 

        var indGrupoPadrao = "";
        if($("#ind-grupo-padrao").is(":checked")){ indGrupoPadrao = 1;}else{ indGrupoPadrao = 0} 

        var loIdGrupoAcesso = $("#id_grupo_acesso").val();

        var loDados = jQuery.parseJSON( 
            '{ "ind_exibe_agenda": "'+indExibeAgenda+'"'
            + ' , "id_grupo_acesso": "'+loIdGrupoAcesso+'"'
            + ' , "ind_padrao": "'+indGrupoPadrao+'" }' 
         );         

          $.ajax({
            data: {
                 dados: loDados
            }
            , type: "POST"
            , dataType: "json"
            , url: "adiciona-gerencia-grupo-acesso.ajax.php"
            , success: function (retorno) {

                window.location.href = "consulta-grupo-acesso.php";

            }
        });  


    }

    priv.buttonVoltarGrupoAcesso_onClick = function(){
        window.location.href = "consulta-grupo-acesso.php";
    }

    priv.buttonPesquisaGrupo_onClick = function(){

        var loStatus = $("#filtro-status").val();

        $.ajax({
            data: {
                 status: loStatus
            }
            , type: "POST"
            , url: "consulta-grupo-acesso.ajax.php"
            , success: function (retorno) {
                
                $("#conteudo-consulta").html(retorno);             

            }
        });          
        

    }

    priv.buttonGerenciarGrupo_onClick = function(){
        
        var id_grupo_acesso = $(this).attr('id');
        window.location.href = "gerencia-grupo-acesso.php?id_grupo_acesso=" + id_grupo_acesso;
    }

    priv.buttonAletar_onClick = function(codigo){
       
       var id_grupo_acesso = $(this).attr("id");
       window.location.href = "adiciona-grupo-acesso.php?id_grupo_acesso=" + id_grupo_acesso;

    };

    priv.buttonCancelar_onClick = function(){
        window.location.href = "consulta-grupo-acesso.php";
    };

    priv.buttonAdicionar_onClick = function(){

        var loNome = $("#nome").val();
        var loStatus = $("#status").val();
        var loIdGrupoAcesso = $("#id_grupo_acesso").val();
        
        var loDados = jQuery.parseJSON( 
            '{ "id_grupo_acesso": "'+loIdGrupoAcesso+'"'
            + ' , "nome": "'+loNome+'"'
            + ' , "status": "'+loStatus+'" }' 
         );         

          $.ajax({
            data: {
                 dados: loDados
            }
            , type: "POST"
            , dataType: "json"
            , url: "adiciona-grupo-acesso.ajax.php"
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
                   window.location.href = "consulta-grupo-acesso.php";
               }

            }
        });          

    };

    priv.buttonPesquisarAdiciona_onClick = function(){
      window.location.href = "adiciona-grupo-acesso.php";  
    } 

    
})();


