<?php  include("../../comum/comum.php");  ?>
<?php  include_once("../../pessoa/modelo-pessoa.php");  ?>
<?php  include_once("../../pessoa/negocio-pessoa.php");  ?>
<?php

$loCodigoCliente = NULL;
$loNomeCliente = NULL;
$loTelefone = NULL;
$loContaCliente = 0;

if(isset($_REQUEST["telefone"])){ $loTelefone = $_REQUEST["telefone"]; }
$loDados = array("id_tipo_pessoa" => 3, "telefone1" => $loTelefone, "consulta_filtro" => 1);


$loComum = new comumBO();
$loPessoaBO = new pessoaBO();


$loPessoa = $loPessoaBO->ConsultaPessoa($loDados);


if(count($loPessoa) > 0 ){

    foreach ($loPessoa as $row){
        $loCodigoCliente = $row->mbIdPessoa;
        $loNomeCliente = $row->mbNome;
        $loContaCliente = 1;
    }
}


$loRetorno = array("contaCliente" => $loContaCliente, "codigoCliente" => $loCodigoCliente, "nomeCliente" => $loNomeCliente);

echo json_encode($loRetorno);


?>