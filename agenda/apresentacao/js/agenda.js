
// Objeto de acesso global
Agenda = {};

(function () {
    var pub = Agenda;

    // Objeto de acesso privado
    var priv = {};

    pub.inputPesquisaTelefoneData_onBlur = function(){
        alert("entro");
    };

    pub.ModalClienteCadastrado = function(prCodigoCliente){

        $.ajax({
            data: {
                 id_pessoa: prCodigoCliente
            }
            , type: "POST"
            , dataType: "json"
            , url: "pesquisa-cliente-dados-json-ajax.php"
            , success: function (retorno) {
                
                $('#select-cliente').append('<option selected value="'+retorno.id_pessoa+'">'+retorno.nome+'</option>');
                $('#select2-select-cliente-container').append('<option selected value="'+retorno.id_pessoa+'">'+retorno.nome+'</option>');

                $('#modal-padrao').dialog("close");   

            }
        });   

    };

    jQuery(function ($) {
        var optionsPadrao = {
            autoOpen: false
            , modal: true
        };

         $( ".data_calendario" ).datepicker({
            dateFormat: 'dd/mm/yy',
            dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
            dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
            dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
            monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
            monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
            nextText: 'Próximo',
            prevText: 'Anterior'
        });

        //Consulta 
        $("#btn-pesquisa").click(priv.buttonPesquisar_onClick);
        $("#btn-pesquisa-adiciona").click(priv.buttonPesquisarAdiciona_onClick);
        $(".abrir-produto").click(priv.buttonAbrirProduto_onClick);
        $("#btn-exibir-toda-agenda").click(priv.buttonAbrirTodaAgenda_onClick);
        $("#btn-exibir-dia-agenda").click(priv.buttonAbrirDiaAgenda_onClick);
        $(".btn-agenda-visitada").click(priv.buttonAgendaVisitada_onClick);
        $("#exportar-excel").click(priv.buttonExportadoExcel_onClick);

        //Adiciona
        $("#btn-adicionar").click(priv.buttonAdicionar_onClick);
        $("#btn-voltar").click(priv.buttonCancelar_onClick);
        $("#pesquisa-cliente").click(priv.buttonPesquisaCliente_onClick);
        $("#adicionar-cliente-novo").click(priv.buttonAbrirNovoCliente_onClick);
        $("#btn-adicionar-cliente").click(priv.buttonAdicionarNovoCliente_onClick);
        $("#btn-desativar").click(priv.buttonDesativaAgendamento_onClick);
        $("#btn-imprimir").click(priv.buttonImprimirDocAgenda_onClick);
        $("#telefone-pesquisa").blur(priv.inputPesquisaClienteTelefone_onBlur);
        $("#select-cliente").change(priv.inputPesquisaTelefoneData_onBlur);


    });

    priv.inputPesquisaTelefoneData_onBlur = function(){
        id_pessoa = $(this).val();

        $.ajax({
            data: {
                 id_pessoa: id_pessoa
            }
            , type: "POST"
            , dataType: "json"
            , url: "pesquisa-cliente-dados-json-ajax.php"
            , success: function (retorno) {

               $("#data-para-visita").val(retorno.data_para_visita);
               $("#telefone-pesquisa").val(retorno.telefone);
               
            }
        });    

    };

    priv.inputPesquisaClienteTelefone_onBlur = function(){

        var loTelefone = $(this).val();
        $.ajax({
            data: {
                 telefone: loTelefone
            }
            , type: "POST"
            , dataType: "json"
            , url: "pesquisa-cliente-telefone.ajax.php"
            , success: function (retorno) {

                if(!retorno.contaCliente){

                    bootbox.dialog({
                        message: "Cliente nao localizado deseja cadastrar ?",
                        title: "Aviso",
                        buttons: {
                            sim: {
                                label: "SIM",
                                className: "dark",
                                callback: function() {
                                    Comum.AdicionarPreCadastroClienteTop("agenda");
                                }
                            },
                            nao: {
                                label: "N&Atilde;O",
                                className: "red"
                            }
                        }
                    }); 

                    $('#select-cliente option[value=0]').attr('selected','selected');
                    $("#select2-select-cliente-container").attr("title","");
                    $("#select2-select-cliente-container").text("");

                }else{

                    $('#select-cliente option[value='+retorno.codigoCliente+']').attr('selected','selected');
                    $("#select2-select-cliente-container").attr("title",retorno.nomeCliente);
                    $("#select2-select-cliente-container").text(retorno.nomeCliente);

                }

            }
        });          

    };

    priv.buttonExportadoExcel_onClick = function(){
       
        //window.open('exportador-excel-doc-agenda.php','_blank');
        $('#form-filtro').attr('action', 'exportador-excel-doc-agenda.php');
        $('#form-filtro').attr('target', '_blank');
        $('#form-filtro').submit();

    };

    priv.buttonImprimirDocAgenda_onClick = function(){

        var id_agenda = $("#id_agenda").val();
        window.open('exportador-pdf-doc-agenda.php?id_agenda='+id_agenda,'_blank');
        
    };

    priv.buttonAgendaVisitada_onClick = function(){

        var id_agenda = $(this).attr("id");
        var loObj = this;

        $.ajax({
            data: {
                 id_agenda: id_agenda
            }
            , type: "POST"
            , dataType: "json"
            , url: "grava-visita-agenda.ajax.php"
            , success: function (retorno) {

                if(retorno.erro){

                    bootbox.dialog({
                        message: retorno.messagem,
                        title: "Aviso",
                        buttons: {
                            success: {
                                label: "SIM",
                                className: "dark"
                            }
                        }
                    });

                }else{

                     $(loObj).parent().html("<span class='label label-success'> Visitado </span>");

                    //begin bootbox
                    bootbox.dialog({
                        message: retorno.messagem,
                        title: "Aviso",
                        buttons: {
                            success: {
                                label: "Ok",
                                className: "dark"
                            },
                            danger: {
                                label: "Imprimir",
                                className: "red",
                                callback: function() {
                                    window.open('exportador-pdf-doc-agenda.php?id_agenda='+id_agenda,'_blank');
                                }
                            },
                            reagendar: {
                                label: "Agendar Proxima Visita",
                                className: "blue",
                                callback: function() {
                                    window.location.href = "adicionar-agenda.php?id_agenda_ant="+id_agenda;
                                }
                            }                            
                        }
                    });
                    //end bootbox
                }

            }
        }); 

    };

    priv.buttonDesativaAgendamento_onClick = function(){

        var id_agenda = $("#id_agenda").val();
        $.ajax({
            data: {
                 id_agenda: id_agenda
            }
            , type: "POST"
            , url: "motivo-desativacao-agenda.ajax.php"
            , success: function (retorno) {

                    $("#dialog-message").html(retorno);
                    var optionsPadraoVisualizar = {
                        autoOpen: false
                        , modal: true
                    };
                    
                    $("#dialog-message").dialog($.extend({
                        title: "Motivo"
                        , width: 550
                        , height: 410
                    }, optionsPadraoVisualizar));
                    $('#dialog-message').dialog("open");    

            }
        });          

    };

    priv.buttonAbrirTodaAgenda_onClick = function(){
         window.location.href = "consulta-agenda.php?agenTotal=S";
    }

    priv.buttonAbrirDiaAgenda_onClick = function(){
         window.location.href = "consulta-agenda.php";
    }

    priv.buttonAdicionarNovoCliente_onClick = function(){

        
        var loNome = $("#nome-cliente-modal").val();
        var loEndereco = $("#endereco-cliente-modal").val();
        var loCep = $("#cep-cliente-modal").val();
        var loBairro = $("#bairro-cliente-modal").val();
        var loNumero = $("#numero-cliente-modal").val();
        var loTelefone1 = $("#telefone1-cliente-modal").val();
        var loTelefone2 = $("#telefone2-cliente-modal").val();
        var loEmail = $("#email-cliente-modal").val();
        var loStatus = $("#status-cliente-modal").val();
        var loIdTipoPessoa = 3;

        

        var loDados = jQuery.parseJSON( 
            '{ "nome": "'+loNome+'"'
            + ' , "cep": "'+loCep+'"'
            + ' , "endereco": "'+loEndereco+'"'
            + ' , "bairro": "'+loBairro+'"'
            + ' , "numero": "'+loNumero+'"'
            + ' , "telefone1": "'+loTelefone1+'"'
            + ' , "telefone2": "'+loTelefone2+'"'
            + ' , "email": "'+loEmail+'"'
            + ' , "id_tipo_pessoa": "'+loIdTipoPessoa+'"'
            + ' , "id_pessoa": ""'
            + ' , "cnpj": ""'
            + ' , "id_cidade": ""'
            + ' , "complemento": ""'
            + ' , "status": "'+loStatus+'" }' 
         );        


          $.ajax({
            data: {
                 dados: loDados
            }
            , type: "POST"
            , dataType: "json"
            , url: "grava-cliente.ajax.php"
            , success: function (retorno) {

            }
        });          



    };

    priv.buttonAbrirNovoCliente_onClick = function(){
        Comum.AdicionarPreCadastroClienteTop("agenda");
    };

    priv.buttonPesquisaCliente_onClick = function(){
         
       var loNomeCliente = $("#nome-cliente").val();

        $.ajax({
                data: {
                    nome: loNomeCliente
                }
                , type: "POST"
                , url: "pesquisa-cliente-ajax.php"
                , success: function (retorno) {

                    $("#dialog-message").html(retorno);
                    var optionsPadraoVisualizar = {
                        autoOpen: false
                        , modal: true
                        ,buttons: {
                            "Sair": function() {
                            $( this ).dialog( "close" );
                            }
                        }
                    };
                    
                    $("#dialog-message").dialog($.extend({
                        title: "Pesquisa Cliente"
                        , width: "60%"
                        , height: 400
                    }, optionsPadraoVisualizar));
                    $('#dialog-message').dialog("open");                        

                }
        });
    };

    priv.buttonAbrirProduto_onClick = function(){
        
        var id_agenda = $(this).attr("id");
         window.location.href = "adicionar-agenda.php?id_agenda=" + id_agenda;

    };

    priv.buttonCancelar_onClick = function(){
        window.location.href = "consulta-agenda.php";
    };

    priv.SeparaSelect2me = function(strDados){
        var arrayOfStrings = strDados.split(":");
        return arrayOfStrings[0];
    }

    priv.buttonAdicionar_onClick = function(){

        var loDataAgendada    = $("#data-agendada").val();
        var loIdPessoaCliente = $("#select-cliente").val();
        var loObeservacao     = $("#observacao").val();
        var loVisitado        = $("#visitado").val();
        var loStatus          = "";
        var loIdAgenda        = $("#id_agenda").val();
        var loIdProduto       = $("#select-produto").val();
        var loQtdProdutor     = $("#qtd-produto").val();
        
        var loDados = jQuery.parseJSON( 
            '{ "data_visita": "'+loDataAgendada+'"'
            + ' , "id_pessoa_cliente": "'+loIdPessoaCliente+'"'
            + ' , "ind_visitado": "'+loVisitado+'"'
            + ' , "observacao": "'+loObeservacao+'"'
            + ' , "id_agenda": "'+loIdAgenda+'"'
            + ' , "id_produto": "'+loIdProduto+'"'
            + ' , "qtd_produto": "'+loQtdProdutor+'"'
            + ' , "ativo": "'+loStatus+'" }' 
         );  


          $.ajax({
            data: {
                 dados: loDados
            }
            , type: "POST"
            , dataType: "json"
            , url: "adiciona-agenda.ajax.php"
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
                   window.location.href = "consulta-agenda.php";
               }

            }
        });          

    };

    priv.buttonPesquisarAdiciona_onClick = function(){
      window.location.href = "adicionar-agenda.php";  
    }; 

    priv.buttonPesquisar_onClick = function(){

        $('#form-filtro').attr('action', 'consulta-agenda.php');
        $('#form-filtro').submit();

        /*var loDataAgendaInic = $("#fil-data-agenda-inicio").val();
        var loDataAgendaFim = $("#fil-data-agenda-fim").val();
        var loCliente = $("#fil-select-cliente").val();
        var loCidade = $("#fil-select-cidade").val();
        var loTelefone = $("#fil-telefone").val();

        var loIndVisitado = "";
        if($("#fil-ind-visitado").is(":checked")){ loIndVisitado = "S";}else{ loIndVisitado = "N"} 

        var loDados = jQuery.parseJSON( 
            '{ "data_visita_inc": "'+loDataAgendaInic+'"'
            + ' , "data_visita_fim": "'+loDataAgendaFim+'"'
            + ' , "id_pessoa_cliente": "'+loCliente+'"'
            + ' , "id_cidade": "'+loCidade+'"'
            + ' , "ind_visitado": "'+loIndVisitado+'"'
            + ' , "telefone": "'+loTelefone+'" }' 
         );

          $.ajax({
            data: {
                 dados: loDados
                 ,agenTotal: "S"
            }
            , type: "POST"
            , url: "consulta-agenda.ajax.php"
            , success: function (retorno) {

              $("#conteudo-consulta").html(retorno);

            }
        }); */

    };
    
})();


