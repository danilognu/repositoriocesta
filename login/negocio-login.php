<?php

if(!isset($_SESSION)){
    session_start();
}
include("persistencia-login.php");

class loginBO{

    public function VerificaLogin($mbDados){

        $loitens = new loginBOA();
        $loLista = $loitens->VerificaLogin($mbDados);

        if( count($loLista) > 0 ){
            foreach ($loLista as $row) {
                
                $_SESSION["id_pessoa_usuario"]  = $row->mbIdPessoa;
                $_SESSION["nome"]               = $row->mbNome;
                $_SESSION["login"]              = $row->mbLogin;
                $_SESSION["id_grupo_acesso"]     = $row->mbIdGrupoAcesso;

            }
            $loRetorno = array("erro" => false, "messagem" => "Incluido");
        }else{
            $loRetorno = array("erro" => true, "messagem" => "Usuario n&atilde;o localizado!");
        }

        return  $loRetorno;
    } 

}

?>