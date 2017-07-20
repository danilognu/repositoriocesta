<?php 
include("persistencia.anotacao.php");

Class anotacaoBO{

    public function ConsultaAnotacao($prAnotacaoVO){

        $loAgenda = new anotacaoBOA();
        $loDados = $loAgenda->ConsultaAnotacao($prAnotacaoVO);

        return $loDados;
    } 

    public function AdicionaAnotacao($prAnotacaoVO){

        $loErro = false;
        $loMessagem = NULL;

        if($prAnotacaoVO->mbDescricao == ""){
            $loMessagem = "Por favor, preencha a Descricao!";
            $loErro = true;           
        }

        if($loErro){
              $loRetorno = array("erro" => $loErro, "messagem" => $loMessagem );
        }else{

           
            $loAnotacaoBOABOA = new anotacaoBOA();
            if($prAnotacaoVO->mbIdAnotacao == ""){
                $loRetorno = $loAnotacaoBOABOA->IncluirAnotacao($prAnotacaoVO);
            }else{
                $loRetorno = $loAnotacaoBOABOA->AlterarAnotacao($prAnotacaoVO);
            }

            if(!$loRetorno["erro"]){
                $loRetorno = array("erro" => false, "messagem" => "" );
            }

        }

        return $loRetorno;

    }    

    public function DesativaAnotacao($prAnotacaoVO){

        $loAgenda = new anotacaoBOA();
        $loDados = $loAgenda->DesativaAnotacao($prAnotacaoVO);

        return $loDados;
        
    }

}

?>