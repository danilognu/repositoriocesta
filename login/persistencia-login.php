<?php

Class loginBOA{

    public function VerificaLogin($mbDados){

        $loConexao = new Conexao();
        $pdo = $loConexao->IniciaConexao();

        $loConsultaWhere = NULL;

         if(isset($mbDados["login"]) && !empty($mbDados["login"]) ){
             $loConsultaWhere .= " AND login = '".$mbDados["login"]."'";
         }


         if(isset($mbDados["senha"]) && !empty($mbDados["senha"]) ){
             $loConsultaWhere .= " AND senha = '".base64_encode($mbDados["senha"])."'";
         }

        
        $loSql = "SELECT  login,senha,id_pessoa,nome,id_grupo_acesso FROM pessoa WHERE 1=1 ".$loConsultaWhere;
        $query= $pdo->prepare($loSql);
        $query->execute();          

        $i = 0;
        $listaPessoa = array();
        foreach ($query as $row) {

            $loPessoaConsulta = new LoginVO();
            $loPessoaConsulta->mbIdPessoa      = $row["id_pessoa"];
            $loPessoaConsulta->mbNome          = $row["nome"];
            $loPessoaConsulta->mbLogin         = $row["login"];
            $loPessoaConsulta->mbIdGrupoAcesso = $row["id_grupo_acesso"];

            $listaPessoa[$i] = $loPessoaConsulta;
            $i++;

        }
        return  $listaPessoa;

    }


}

?>