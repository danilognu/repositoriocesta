<?php

Class produtoBOA{

    public function ConsultaProduto($mdDados){

        $loConexao = new Conexao();
        $pdo = $loConexao->IniciaConexao();

        $loWhere = NULL;

        if( isset($mbDados["ativo"]) && !empty($mbDados["ativo"]) ){
            $loWhere .= " AND produto.ativo = ".$mbDados["ativo"];
        }else{
            $loWhere .= " AND produto.ativo = 1 ";
        }

        if( isset($mbDados["id_produto"]) && !empty($mbDados["id_produto"]) ){
            $loWhere .= " AND produto.id_produto = ".$mbDados["id_produto"];
        }

        $loSql = "SELECT 
                        produto.id_produto
                        ,produto.nome
                        ,produto.descricao
                        ,produto.dt_cad
                        ,produto.dt_alt
                        ,pessoa_cad.id_pessoa id_pessoa_cad
                        ,pessoa_cad.nome nome_pessoa_cad
                        ,pessoa_alt.id_pessoa  id_pessoa_alt
                        ,pessoa_alt.nome nome_pessoa_alt
                        ,produto.ativo
                    FROM produto
                    LEFT JOIN pessoa pessoa_cad ON pessoa_cad.id_pessoa = produto.id_pessoa_cad
                    LEFT JOIN pessoa pessoa_alt ON pessoa_alt.id_pessoa = produto.id_pessoa_alt
                    WHERE 1=1 ".$loWhere;
         $query= $pdo->prepare($loSql);
         $query->execute();

        $i = 0;
        $listaProduto = array();
        foreach ($query as $row) {

            $loItem = new produtoVO();
            $loItem->mbIdProduto     = $row["id_produto"];
            $loItem->mbNome          = $row["nome"];
            $loItem->mbDescricao     = $row["descricao"];
            $loItem->mbDtCad         = $row["dt_cad"];
            $loItem->mbDtAlt         = $row["dt_alt"];
            $loItem->mbNomePessoaAlt = $row["nome_pessoa_cad"];
            $loItem->mbNomePessoaCad = $row["nome_pessoa_alt"];
            $loItem->mbStatus         = $row["ativo"];
            $listaProduto[$i] = $loItem;
            $i++;   
        }
        return $listaProduto; 

    }

     public function IncluirProduto($mbDados){
        
            $loConexao = new Conexao();
            $pdo = $loConexao->IniciaConexao();

            $loNome = $mbDados["nome"];
            $loDescricao = $mbDados["descricao"];
            $loStatus = $mbDados["status"];


            $loSql = "INSERT INTO produto
                        (
                             nome
                             ,descricao
                             ,id_pessoa_cad
                             ,dt_cad
                             ,ativo
                       ) VALUES 
                            (?,?,?,NOW(),1)
                        "; 
            $query = $pdo->prepare($loSql);
            $query->bindValue(1,  $loNome);
            $query->bindValue(2,  $loDescricao);
            $query->bindValue(3, $_SESSION["id_pessoa_usuario"]);
            $query->execute();  

            return true; 
    }

     public function AlterarProduto($mbDados){
        
            $loConexao = new Conexao();
            $pdo = $loConexao->IniciaConexao();

            $loNome = $mbDados["nome"];
            $loDescricao = $mbDados["descricao"];
            $loStatus = $mbDados["status"];
            $loIdProduto = $mbDados["id_produto"];


            $loSql = "UPDATE produto
                        SET
                             nome = ?
                             ,descricao = ?
                             ,id_pessoa_alt = ?
                             ,ativo = ?
                             ,dt_alt = NOW()
                       WHERE 
                            id_produto = ".$loIdProduto; 
            $query = $pdo->prepare($loSql);
            $query->bindValue(1, $loNome);
            $query->bindValue(2, $loDescricao);
            $query->bindValue(3, $_SESSION["id_pessoa_usuario"]);
            $query->bindValue(4, $loStatus);
            $query->execute();  

            return true; 
    }
   

}

?>