<?php
include("persistencia-grupo-acesso.php");

Class grupoAcessoBO{

    public function ConsultaGrupo($mbDados){

        $loProduto = new grupoAcessoBOA();
        $loDados = $loProduto->ConsultaGrupo($mbDados);

        return $loDados;

    }

    public function AdicionaGrupoAcesso($mbDados){

        $loErro = false;
        $loMessagem = NULL;

        if($mbDados["nome"] == ""){
            $loMessagem = "Por favor, preencha o Nome!";
            $loErro = true;           
        }

        if($loErro){
              $loRetorno = array("erro" => $loErro, "messagem" => $loMessagem );
        }else{

           $loGrupoAcessoBOA = new grupoAcessoBOA();
            if($mbDados["id_grupo_acesso"] == ""){                
                $loRetorno = $loGrupoAcessoBOA->IncluirGrupoAcesso($mbDados);
            }else{
                $loRetorno = $loGrupoAcessoBOA->AlterarGrupoAcesso($mbDados);
            }

            if(!$loRetorno["erro"]){
                $loRetorno = array("erro" => false, "messagem" => "" );
            }

        }

        return $loRetorno;


    }

    public function VerificaPermissao($mbDados){

        $loProduto = new grupoAcessoBOA();
        $loDados = $loProduto->VerificaPermissao($mbDados);

        return $loDados;

    }    

    public function GravarPermissao($mbDados){

        $loGrupoAcessoBOA = new grupoAcessoBOA();
        $loDados = $loGrupoAcessoBOA->GravarPermissao($mbDados);

        return $loDados;
        
    }

    public function AdicionaGerenciaGrupoAcesso($mbDados){

        $loProduto = new grupoAcessoBOA();
        $loDados = $loProduto->AdicionaGerenciaGrupoAcesso($mbDados);

        return $loDados;

    }

    

}

?>