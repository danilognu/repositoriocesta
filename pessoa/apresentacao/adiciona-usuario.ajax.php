<?php 
include("../../comum/comum.php"); 
include("../modelo-pessoa.php");
include("../negocio-pessoa.php");

$mbDados = $_POST["dados"];


$loPessoaVO = new pessoaVO();
if(isset($mbDados["id_pessoa"])){       $loPessoaVO->mbIdPessoa         = $mbDados["id_pessoa"];}
if(isset($mbDados["nome"])){            $loPessoaVO->mbNome             = $mbDados["nome"];}
if(isset($mbDados["cnpj"])){            $loPessoaVO->mbCnpj             = $mbDados["cnpj"];}
if(isset($mbDados["cep"])){             $loPessoaVO->mbCep              = $mbDados["cep"];}
if(isset($mbDados["endereco"])){        $loPessoaVO->mbEndereco         = $mbDados["endereco"];}
if(isset($mbDados["bairro"])){          $loPessoaVO->mbBairro           = $mbDados["bairro"];}
if(isset($mbDados["numero"])){          $loPessoaVO->mbNumero           = $mbDados["numero"];}
if(isset($mbDados["id_cidade"])){       $loPessoaVO->mbIdCidade         = $mbDados["id_cidade"];}
if(isset($mbDados["complemento"])){     $loPessoaVO->mbComplemento      = $mbDados["complemento"];}
if(isset($mbDados["telefone1"])){       $loPessoaVO->mbTelefone1        = $mbDados["telefone1"];}
if(isset($mbDados["telefone2"])){       $loPessoaVO->mbTelefone2        = $mbDados["telefone2"];}
if(isset($mbDados["email"])){           $loPessoaVO->mbEmail            = $mbDados["email"];}
if(isset($mbDados["status"])){          $loPessoaVO->mbStatus           = $mbDados["status"];}
if(isset($mbDados["id_tipo_pessoa"])){  $loPessoaVO->mbIdTipoPessoa     = $mbDados["id_tipo_pessoa"];}
if(isset($mbDados["id_grupo_acesso"])){ $loPessoaVO->mbIdGrupoAcesso    = $mbDados["id_grupo_acesso"];}

if(isset($mbDados["login"])){ $loPessoaVO->mbLogin            = $mbDados["login"];}
if(isset($mbDados["senha"])){ $loPessoaVO->mbSenha            = $mbDados["senha"];}
if(isset($mbDados["senhaConf"])){ $loPessoaVO->mbSenhaConf    = $mbDados["senhaConf"];}


$loPessoa = new pessoaBO();
$loRetorno = $loPessoa->AdicionaPessoa($loPessoaVO);

echo json_encode($loRetorno);
?>

