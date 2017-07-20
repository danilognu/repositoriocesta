<?php
include("persistencia-pessoa.php");

Class pessoaBO{

    public function ConsultaPessoa($mbDados){

        $loPessoa = new pessoaBOA();
        $loDados = $loPessoa->ConsultaPessoa($mbDados);

        return $loDados;

    }

    public function AdicionaPessoa($prloPessoaVO){

        $loErro = false;
        $loMessagem = NULL;

        if($prloPessoaVO->mbNome == ""){
            $loMessagem = "Por favor, preencha o Nome!";
            $loErro = true;           
        }

        //Pessoa Usuario
        if($prloPessoaVO->mbIdTipoPessoa == 1){
            
            /*if($prloPessoaVO->mbLogin == ""){
                $loMessagem = "Por favor, preencha o Login!";
                $loErro = true;           
            }else{
                $loContaLogin = $this->VerificaLoginExiste($prloPessoaVO->mbLogin);
                if($loContaLogin > 0){
                    $loMessagem = "Login já cadatrado, favor alterar!";
                    $loErro = true;                      
                }
            }*/
            if($prloPessoaVO->mbSenha == "" && $prloPessoaVO->mbIdPessoa == ""){
                $loMessagem = "Por favor, preencher a Senha!";
                $loErro = true;  
            }

            if($prloPessoaVO->mbSenha != $prloPessoaVO->mbSenhaConf){
                $loMessagem = "Senhas nao coincidem!";
                $loErro = true;  
            }
        }

        $loIdPessoaCad = NULL;

        if($loErro){
              $loRetorno = array("erro" => $loErro, "messagem" => $loMessagem );
        }else{

           
            if($prloPessoaVO->mbIdPessoa == ""){
                $loPessoa = new pessoaBOA();
                $loRetorno = $loPessoa->IncluirPessoa($prloPessoaVO);
            }else{
                $loPessoa = new pessoaBOA();
                $loRetorno = $loPessoa->AlterarPessoa($prloPessoaVO);
            }

            if(!$loRetorno["erro"]){
                $loRetorno = array("erro" => false, "messagem" => "", "id_pessoa" => $loRetorno["id_pessoa"]);
            }

        }

        return $loRetorno;


    }

    public function VerificaLoginExiste($mbLogin){

        $loPessoa = new pessoaBOA();
        $loDados = $loPessoa->VerificaLoginExiste($mbLogin);

        return $loDados;

    }

}


?>