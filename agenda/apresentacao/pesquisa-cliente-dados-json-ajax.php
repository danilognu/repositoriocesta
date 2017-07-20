<?php  	
include("../../comum/comum.php"); 
include_once("../../pessoa/modelo-pessoa.php");  
include_once("../../pessoa/negocio-pessoa.php"); 

$loIdPessoa = null;
$loRetorno = null;

if(isset($_REQUEST["id_pessoa"])){ $loIdPessoa = $_REQUEST["id_pessoa"]; }

$loPessoaVO = new pessoaVO();
$loPessoaBO = new pessoaBO();
$loComum = new comumBO();

$loDados = array( 
    'id_tipo_pessoa' => '3'
    , 'id_pessoa' => $loIdPessoa
    , 'consulta_filtro' => 1
);

$loPessoa =  $loPessoaBO->ConsultaPessoa($loDados);

if(count($loPessoa) > 0){
    foreach ($loPessoa as $row){

        $loRetorno = array(
                        "id_pessoa" => $row->mbIdPessoa
                        ,"nome" => $row->mbNome
                        ,"telefone" => $row->mbTelefone1
                        ,"data_para_visita" => $row->mbDataParaVisita
        );

    }
}

echo json_encode($loRetorno);

?>




