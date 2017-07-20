
// Objeto de acesso global
Cliente = {};

(function () {
    var pub = Cliente;

    // Objeto de acesso privado
    var priv = {};

    pub.AbrirPessoa_onClick = function(obj){
        priv.buttonAbrirPessoa_onClick(obj);
    }

    pub.AbrirModalAvisoCadastraCliente = function(){

        bootbox.dialog({
            message: "Cliente nao localizado deseja cadastrar ?",
            title: "Aviso",
            buttons: {
                sim: {
                    label: "SIM",
                    className: "dark",
                    callback: function() {
                        Comum.AdicionarPreCadastroClienteTop("cliente");
                    }
                },
                nao: {
                    label: "N&Atilde;O",
                    className: "red"
                }
            }
        });     

    };

    jQuery(function ($) {
        var optionsPadrao = {
            autoOpen: false
            , modal: true
        };

        //Consulta 
        $("#btn-pesquisa").click(priv.buttonPesquisar_onClick);
        $("#btn-pesquisa-adiciona").click(priv.buttonPesquisarAdiciona_onClick);
        //$(".abrir-pessoa").click(priv.buttonAbrirPessoa_onClick);
        $("#exportar-excel").click(priv.buttonExportadorExcel_onClick);

        //Adiciona
        $("#btn-adicionar").click(priv.buttonAdicionar_onClick);
        $("#btn-cancelar").click(priv.buttonCancelar_onClick);

    });

    priv.buttonExportadorExcel_onClick = function(){

        $('#form-filtro').attr('action', 'exportador-excel-cliente.php');
        $('#form-filtro').attr('target', '_blank');
        $('#form-filtro').submit();
    };

    priv.buttonAbrirPessoa_onClick = function(id){

         var id_pessoa = id;
         window.location.href = "adicionar-cliente.php?id_pessoa=" + id_pessoa;
    };

    priv.buttonCancelar_onClick = function(){
        window.location.href = "consulta-cliente.php";
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
        var loTelefone3 = $("#telefone3").val();
        var loEmail = $("#email").val();
        var loStatus = $("#status").val();
        var loIdPessoa = $("#id_pessoa").val();
        var loIdTipoPessoa = 3; //Tipo Pessoa        
        var loIdGrupoAcesso = "";
        var loIdPessoaVendedor = $("#id_pessoa_vendedor").val();
        var loDataParaVisita = $("#data_para_visita").val();

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
            + ' , "telefone3": "'+loTelefone3+'"'
            + ' , "email": "'+loEmail+'"'
            + ' , "id_pessoa": "'+loIdPessoa+'"'
            + ' , "id_tipo_pessoa": "'+loIdTipoPessoa+'"'
            + ' , "id_grupo_acesso": "'+loIdGrupoAcesso+'"'
            + ' , "id_pessoa_vendedor": "'+loIdPessoaVendedor+'"'
            + ' , "data_para_visita": "'+loDataParaVisita+'"'
            + ' , "status": "'+loStatus+'" }' 
         );

          $.ajax({
            data: {
                 dados: loDados
            }
            , type: "POST"
            , dataType: "json"
            , url: "adiciona-cliente.ajax.php"
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
                     
                    window.location.href = "consulta-cliente.php";

               }

            }
        });          

    };

    priv.buttonPesquisarAdiciona_onClick = function(){
      window.location.href = "adicionar-cliente.php";  
    } 

    priv.buttonPesquisar_onClick = function(){

       $('#form-filtro').attr('action', 'consulta-cliente.php');
       $('#form-filtro').submit();

    };
    
})();


