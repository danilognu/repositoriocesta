<?php  	include("../../comum/comum.php");  ?>
<?php  include_once("../../pessoa/modelo-pessoa.php");  ?>
<?php  include_once("../../pessoa/negocio-pessoa.php");  ?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php

$loNome = null;
$loTelefone = null;
$loExibir = null;

if(isset($_REQUEST["nome"])){ $loNome = $_REQUEST["nome"]; }
if(isset($_REQUEST["telefone"])){ $loTelefone = $_REQUEST["telefone"]; }
if(isset($_REQUEST["exibir"])){ $loExibir = $_REQUEST["exibir"]; }

$loPessoa = new pessoaBO();
$loComum = new comumBO();

?>

<br />

 <form class="form-inline" id="form-filtro" role="form" method="POST" >


    <div class="form-group">
            
            <label class="col-md-3 control-label">Nome</label>
            <div class="col-md-2">
                <input type="text" id="filtro-nome" name="filtro-nome" class="form-control" value="<?php echo $loNome; ?>"  size="25" >
            </div>
        </div>
        <div class="form-group">
                <label class="col-md-3 control-label">Telefone &nbsp;&nbsp;</label>
                <div class="col-md-3">
                <input type="text" id="filtro-telefone" name="filtro-telefone" class="form-control mask_telefone" value="<?php echo $loTelefone; ?>" size="15" >
            </div>                                           
        </div>        
        <a href="#" onclick="PesquisaCliente();" class="btn sbold dark" title="Adicionar Cliente" > 
                <i class="fa fa-search"></i>
        </a>
        <a href="#" id="adicionar-cliente-novo" class="btn btn-default" title="Adicionar Cliente" ><i class="fa fa-plus"></i></a>
</form>

<br />



<br />

<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
    <thead>
        <tr>
            <th ></th>
            <th width="50%">Nome </th>
            <th width="30%">Telefone </th> 
            <th width="15%">A&ccedil;&atilde;o  </th> 

        </tr>
    </thead>
    <tbody  >


       <?php
        $loDadosC = array( 
                'id_tipo_pessoa' => '3'
                , 'nome' => $loNome
                , 'telefone1' => $loTelefone
                , 'consulta_filtro' => 1 
            );

            $loLista =  $loPessoa->ConsultaPessoa($loDadosC);

            if(count($loLista) > 0 && $loExibir == 1){

                 foreach ($loLista as $row){
                   
         ?>

                <tr class="odd gradeX"  >

                    <td>  </td>   
                    <td> <?php echo $row->mbNome; ?> </td>
                    <td> <?php echo $loComum->MascaraTelefone($row->mbTelefone1); ?>  </td>
                    <td> 
                         <button 
                            id="btn-adicionar" 
                            onclick="Adicionar('<?php echo $row->mbNome; ?>',<?php echo $row->mbIdPessoa;?>);" 
                            class="btn sbold dark"> 
                            <i class="fa fa-plus"></i>
                        </button>
                    </td>

                </tr>
            <?php

                }
                
            }

            ?>


    </tbody>
</table>



<script>

function PesquisaCliente(){

        var loNome = $("#filtro-nome").val(); 
        var loTelefone = $("#filtro-telefone").val();

        $.ajax({
                data: {
                    nome: loNome
                    ,cpf: loTelefone
                    ,exibir: 1
                }
                , type: "POST"
                , url: "pesquisa-cliente-ajax.php"
                , success: function (retorno) {

                    $("#dialog-message").html(retorno);

                }
        });


}

function marcardesmarcar(){
  $('.checkboxes').each(
         function(){
           if ($(this).prop( "checked")) 
           $(this).prop("checked", false);
           else $(this).prop("checked", true);               
         }
    );
}


function Adicionar(nome,id){

    jQuery('#dialog-message').dialog('close');
    $('#select-cliente option[value='+id+']').attr('selected','selected');
    $("#select2-select-cliente-container").attr("title",nome);
    $("#select2-select-cliente-container").text(nome);

    /*if(indGravaGridePassageiro == 1){
            $("#table-passageiros tbody tr").remove(); 
           
            var button = "<a href='#' class='btn-rota' onclick='Solicitacao.RemoverLinha(this);' ><i class='fa fa-close'></i> Remover </a>";
            var newRow = $("<tr>");
            var cols = "";

            cols += "<td>" + nome + "</td>";
            cols += "<td>" + button + " <input type='hidden' class='codigo-passageiros' value='"+id+"' /> </td>";

            newRow.append(cols);
            $("#table-passageiros").append(newRow);
    }*/

}

</script>
<script src="../../comum/js/form-input-mask.js" type="text/javascript"></script>