<?php 
include("persistencia-produto.php");

Class produtoBO{

    public function ConsultaProduto($mbDados){

        $loProduto = new produtoBOA();
        $loDados = $loProduto->ConsultaProduto($mbDados);

        return $loDados;
    }

    public function AdicionaProduto($mbDados){

        $loErro = false;
        $loMessagem = NULL;

        if($mbDados["nome"] == ""){
            $loMessagem = "Por favor, preencha o Nome do Produto!";
            $loErro = true;           
        }

        if($loErro){
              $loRetorno = array("erro" => $loErro, "messagem" => $loMessagem );
        }else{

           
            if($mbDados["id_produto"] == ""){
                $loProduto = new produtoBOA();
                $loRetorno = $loProduto->IncluirProduto($mbDados);
            }else{
                $loProduto = new produtoBOA();
                $loRetorno = $loProduto->AlterarProduto($mbDados);
            }

            if(!$loRetorno["erro"]){
                $loRetorno = array("erro" => false, "messagem" => "" );
            }

        }

        return $loRetorno;


    }

}

?>