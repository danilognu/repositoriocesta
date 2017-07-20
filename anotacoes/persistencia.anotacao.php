<?php
Class anotacaoBOA{

    public function ConsultaAnotacao($prAnotacaoVO){

        $loConexao = new Conexao();
        $pdo = $loConexao->IniciaConexao();

        $loComumBO = new comumBO();

        $loWhere = NULL;

        if( isset($prAnotacaoVO->mbStatus) && !$prAnotacaoVO->mbStatus ){
            $loWhere .= " AND anotacoes.ativo = ".$prAnotacaoVO->mbStatus;
        }else{
            $loWhere .= " AND anotacoes.ativo = 1 ";
        }
        if( isset($prAnotacaoVO->mbIdAnotacao) && !empty($prAnotacaoVO->mbIdAnotacao) ){
            $loWhere .= " AND anotacoes.id_anotacao = ".$prAnotacaoVO->mbIdAnotacao;
        }

        $loSql = "SELECT 
                    anotacoes.id_anotacao
                    ,anotacoes.descricao
                    ,anotacoes.ativo 
                    ,pessoa_cad.id_pessoa as id_pessoa_cad
                    ,pessoa_alt.id_pessoa as id_pessoa_alt
                    ,pessoa_cad.nome as nome_cad
                    ,pessoa_cad.nome as nome_alt
                    ,DATE_FORMAT(anotacoes.dt_cad, '%d/%m/%Y %H:%m') dt_cad
                    ,DATE_FORMAT(anotacoes.dt_alt, '%d/%m/%Y') dt_alt
                FROM anotacoes
                INNER JOIN pessoa pessoa_cad ON pessoa_cad.id_pessoa = anotacoes.id_pessoa_cad
                LEFT JOIN pessoa pessoa_alt ON pessoa_alt.id_pessoa = anotacoes.id_pessoa_alt
                WHERE 1=1 ".$loWhere;
    
         $query= $pdo->prepare($loSql);
         $query->execute();                    


        $i = 0;
        $listaAnotacao = array();
        foreach ($query as $row) {

            $loItem = new anotacaoVO();
            $loItem->mbIdAnotacao   = $row["id_anotacao"];
            $loItem->mbDescricao    = $row["descricao"];
            $loItem->mbStatus        = $row["ativo"];
            $loItem->mbIdPessoaCad  = $row["id_pessoa_cad"];;
            $loItem->mbIdPessoaAlt  = $row["id_pessoa_alt"];
            $loItem->mbIdNomeCad    = $row["nome_cad"];
            $loItem->mbIdNomeAlt    = $row["nome_alt"];
            $loItem->mbDtCad        = $row["dt_cad"];
            $loItem->mbDtAlt        = $row["dt_alt"];

            $listaAnotacao[$i] = $loItem;
            $i++;   
        }
        return $listaAnotacao;                 

    }

      public function IncluirAnotacao($prAnotacaoVO){

            $loConexao = new Conexao();
            $pdo = $loConexao->IniciaConexao();

            $loComumBO = new comumBO();

            $loDescricao  = $prAnotacaoVO->mbDescricao;

            $loSql = "INSERT INTO anotacoes 
                        (
                             descricao
                            ,id_pessoa_cad
                            ,dt_cad
                            ,ativo
                        ) VALUES 
                        (?,?,NOW(),1)";   

            $query = $pdo->prepare($loSql);
            $query->bindValue(1,  $loDescricao);
            $query->bindValue(2,  $_SESSION["id_pessoa_usuario"]);
            $query->execute();

            return true;
    }

     public function AlterarAnotacao($prAnotacaoVO){

            $loConexao = new Conexao();
            $pdo = $loConexao->IniciaConexao();
            $loComumBO = new comumBO();

            $loIdAnotacao = $prAnotacaoVO->mbIdAnotacao;
            $loDescricao  = $prAnotacaoVO->mbDescricao;
            $loAtivo      = $prAnotacaoVO->mbAtivo;

            $loSql = "UPDATE  anotacoes 
                        SET
                        descricao = ?
                        ,id_pessoa_alt = ?
                        ,dt_alt = NOW() 
                        WHERE id_anotacao = ".$loIdAnotacao; 
            $query = $pdo->prepare($loSql);
            $query->bindValue(1,  $loDescricao);
            $query->bindValue(3,  $_SESSION["id_pessoa_usuario"]);
            $query->execute();

            return true;
    }

    public function DesativaAnotacao($prAnotacaoVO){

        $loConexao = new Conexao();
        $pdo = $loConexao->IniciaConexao();

        $loSql = "UPDATE anotacoes SET ativo = 0 WHERE id_anotacao =".$prAnotacaoVO->mbIdAnotacao;
        $query = $pdo->prepare($loSql);
        $query->execute();

        return true;

    }


}


?>