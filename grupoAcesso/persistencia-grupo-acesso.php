<?php

Class grupoAcessoBOA{

    Public $glPermissaoVisualisaSigla = "V";
    Public $glPermissaoVisualisaNome = "VISUALIZAR";

    Public $glPermissaoAlterarSigla = "A";
    Public $glPermissaoAlterarNome = "ALTERAR";

    Public $glPermissaoCancelarSigla = "C";
    Public $glPermissaoCancelarNome = "CANCELAR";

    public function ConsultaGrupo($mbDados){

        $loConexao = new Conexao();
        $pdo = $loConexao->IniciaConexao();  

        $loWhere = NULL;

        if( isset($mbDados["id_grupo_acesso"]) && !empty($mbDados["id_grupo_acesso"]) ){
            $loWhere .= " AND grupo_acesso.id_grupo_acesso = ".$mbDados["id_grupo_acesso"];
        }else{  

            if( isset($mbDados["status"]) && !empty($mbDados["status"]) ){

                if($mbDados["status"] == "D"){
                    $loStatus = "0";
                }else{
                    $loStatus = "1";
                }
                $loWhere .= " AND grupo_acesso.ativo = ".$loStatus;
            }else{
                $loWhere .= " AND grupo_acesso.ativo = 1";
            } 
            
        }

          

        $loSql = "SELECT 
                    grupo_acesso.id_grupo_acesso
                    ,grupo_acesso.nome
                    ,grupo_acesso.dt_cad
                    ,grupo_acesso.dt_alt
                    ,grupo_acesso.ativo
                    ,pessoa_cad.nome as nome_pessoa_cad
                    ,pessoa_alt.nome as nome_pessoa_alt
                    ,grupo_acesso.ind_padrao
                    ,grupo_acesso.ind_exibe_agenda
                FROM grupo_acesso
                LEFT JOIN pessoa pessoa_cad ON pessoa_cad.id_pessoa = grupo_acesso.id_pessoa_cad
                LEFT JOIN pessoa pessoa_alt ON pessoa_alt.id_pessoa = grupo_acesso.id_pessoa_alt
                WHERE 1=1 ".$loWhere;
         $query= $pdo->prepare($loSql);
         $query->execute();                    


        $i = 0;
        $listaGrupoAcesso = array();
        foreach ($query as $row) {

            $loItem = new grupoAcessoVO();
            $loItem->mbCodigoGrupo  = $row["id_grupo_acesso"];
            $loItem->mbNome         = $row["nome"];
            $loItem->mbDataCad      = $row["dt_cad"];
            $loItem->mbDataAlt      = $row["dt_alt"];
            $loItem->mbPessoaCad    = $row["nome_pessoa_cad"];
            $loItem->mbPessoaAlt    = $row["nome_pessoa_alt"];
            $loItem->mbStatus       = $row["ativo"];
            $loItem->mbIndPadrao    = $row["ind_padrao"];
            $loItem->mbIndExibeAgen = $row["ind_exibe_agenda"];
            $listaGrupoAcesso[$i] = $loItem;
            $i++;   
        }
        return $listaGrupoAcesso; 

    }

public function IncluirGrupoAcesso($mbDados){

            $loConexao = new Conexao();
            $pdo = $loConexao->IniciaConexao();  

            $loNome = $mbDados["nome"];
            $loStatus = $mbDados["status"];


            $loSql = "INSERT INTO grupo_acesso
                        (
                             nome
                             ,id_pessoa_cad
                             ,dt_cad
                             ,ativo
                       ) VALUES 
                            (?,?,NOW(),1)
                        "; 
            $query = $pdo->prepare($loSql);
            $query->bindValue(1,  $loNome);
            $query->bindValue(2, $_SESSION["id_pessoa_usuario"]);
            $query->execute();  

            return true; 
    }

     public function AlterarGrupoAcesso($mbDados){
        
            $loConexao = new Conexao();
            $pdo = $loConexao->IniciaConexao();  

            $loNome = $mbDados["nome"];
            $loStatus = $mbDados["status"];
            $loId = $mbDados["id_grupo_acesso"];


            $loSql = "UPDATE grupo_acesso
                        SET
                             nome = ?
                             ,id_pessoa_alt = ?
                             ,ativo = ?
                             ,dt_alt = NOW()
                       WHERE 
                            id_grupo_acesso = ".$loId; 
            $query = $pdo->prepare($loSql);
            $query->bindValue(1, $loNome);
            $query->bindValue(2, $_SESSION["id_pessoa_usuario"]);
            $query->bindValue(3, $loStatus);
            $query->execute();  

            return true; 
    }

    public function VerificaPermissao($mbDados){

        $loConexao = new Conexao();
        $pdo = $loConexao->IniciaConexao();  

        $loSql = "SELECT id_permissao
                ,id_grupo_acesso
                ,id_menu
                ,tipo
                ,tipo_desc
                ,id_pessoa_usuario
            FROM permissoes 
            WHERE id_grupo_acesso = ".$mbDados->mbIdGrupoAcesso." 
            AND id_menu = ".$mbDados->mbIdMenu." 
            AND id_pessoa_usuario = ".$_SESSION["id_pessoa_usuario"]." ";
         $query= $pdo->prepare($loSql);
         $query->execute();                    


        $i = 0;
        $listaPermissao = array();
        foreach ($query as $row) {

            $loItem = new grupoAcessoVO();

            $loItem->mbIdPermissao      = $row["id_permissao"];
            $loItem->mbIdGrupoAcesso    = $row["id_grupo_acesso"];
            $loItem->mbIdMenu           = $row["id_menu"];
            $loItem->mbTipo             = $row["tipo"];
            $loItem->mbTipoDesc         = $row["tipo_desc"];
            $loItem->mbIdPessoaUsuario  = $row["id_pessoa_usuario"];

            $listaPermissao[$i] = $loItem;
            $i++;   
        }
        return $listaPermissao; 

    }  

    public function GravarPermissao($mbDados){

        $loConexao = new Conexao();
        $pdo = $loConexao->IniciaConexao();


        $loidGrupo = $mbDados["id_grupo"];
        $loidMenu = $mbDados["id_menu"];
        $loParam = $mbDados["perm"];
        $loAcesso = $mbDados["acesso"];
        $loTipoSelecao = $mbDados["tipo_selecao"];

         //Verifica se ja existe
        $loSql = "SELECT 
                        COUNT(*) item_perm 
                    FROM permissoes 
                    WHERE id_grupo_acesso = ".$loidGrupo." 
                    AND id_menu = ".$loidMenu."  
                    AND tipo = '".$loParam."'";
        echo $loSql;
        $query= $pdo->prepare($loSql);
        $query->execute();    

        $loContagem = 0;
        foreach ($query as $row) {
            $loContagem = $row["item_perm"];
        }

        echo "loAcesso = ". $loAcesso;
        if($loContagem > 0 &&  $loTipoSelecao == "deleta"){

            $loSqlD = "DELETE FROM permissoes 
                        WHERE id_grupo_acesso = ".$loidGrupo."  
                        AND id_menu = ".$loidMenu." 
                        AND tipo = '".$loParam."'";
            echo $loSqlD;
            $query= $pdo->prepare($loSqlD);
            $query->execute();  

             return true;    

        }else{

            $loSqlI = "INSERT INTO permissoes 
                            (
                                id_pessoa_usuario
                                ,id_grupo_acesso
                                ,id_menu
                                ,tipo) 
                        VALUES (
                                    ?
                                   ,?
                                   ,?
                                   ,?
                             )";

            $query= $pdo->prepare($loSqlI);
            $query->bindValue(1, $_SESSION["id_pessoa_usuario"]);
            $query->bindValue(2, $loidGrupo);
            $query->bindValue(3, $loidMenu);
            $query->bindValue(4, $loParam);
            $query->execute(); 

            return true;                    

        }

    }

     public function AdicionaGerenciaGrupoAcesso($mbDados){
        
            $loConexao = new Conexao();
            $pdo = $loConexao->IniciaConexao();  

            $loIdExibeAgenda    = $mbDados["ind_exibe_agenda"];
            $loIndPadrao        = $mbDados["ind_padrao"];
            $loIdGrupoAcesso    = $mbDados["id_grupo_acesso"];


            $loSql = "UPDATE grupo_acesso
                        SET
                             ind_padrao = ?
                             ,ind_exibe_agenda = ?
                       WHERE 
                            id_grupo_acesso = ".$loIdGrupoAcesso; 
            $query = $pdo->prepare($loSql);
            $query->bindValue(1, $loIndPadrao);
            $query->bindValue(2, $loIdExibeAgenda);
            $query->execute();  

            return true; 
    }          

}

?>