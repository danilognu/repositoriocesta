<?php

Class pessoaBOA{

    public function ConsultaPessoa($mbDados){

        $loComum = new comumBO();

        $loConexao = new Conexao();
        $pdo = $loConexao->IniciaConexao();

        $loWhere = NULL;

        if( isset($mbDados["ativo"]) && !empty($mbDados["ativo"]) ){

            $loStatus = $mbDados["ativo"] === "S" ? "1" : "0"; 

            $loWhere .= " AND pessoa.ativo = ".$loStatus;
        }else{
            if(!isset($mbDados["consulta_filtro"])){
                $loWhere .= " AND pessoa.ativo = 1 ";
                if($_SESSION["id_grupo_acesso"] == "1"){ // Para Vendedor
                    $loWhere .= " AND pessoa.id_pessoa_vendedor = ".$_SESSION["id_pessoa_usuario"];
                }
            }
        }

        if( isset($mbDados["id_tipo_pessoa"]) && !empty($mbDados["id_tipo_pessoa"]) ){
            $loWhere .= " AND tipo_pessoa.id_tipo_pessoa = ".$mbDados["id_tipo_pessoa"];
        }

        if( isset($mbDados["nome"]) && !empty($mbDados["nome"]) ){
            $loWhere .= " AND pessoa.nome like '%".$mbDados["nome"]."%'";
        }

        if( isset($mbDados["telefone1"]) && !empty($mbDados["telefone1"]) ){
            $loWhere .= " AND pessoa.telefone1 like '%".$loComum->RemoverMascaraTelefone($mbDados["telefone1"])."%'";
            $loWhere .= " OR pessoa.telefone2 like '%".$loComum->RemoverMascaraTelefone($mbDados["telefone1"])."%'";
            $loWhere .= " OR pessoa.telefone3 like '%".$loComum->RemoverMascaraTelefone($mbDados["telefone1"])."%'";
        }

        if( isset($mbDados["id_pessoa"]) && !empty($mbDados["id_pessoa"]) ){
            $loWhere .= " AND pessoa.id_pessoa = ".$mbDados["id_pessoa"];
        }



        $loSql = "SELECT 
                        pessoa.id_pessoa
                        ,pessoa.nome as nome_pessoa
                        ,pessoa.login
                        ,pessoa.email
                        ,tipo_pessoa.id_tipo_pessoa
                        ,tipo_pessoa.nome as nome_tipo_pessoa
                        ,pessoa.endereco
                        ,pessoa.bairro
                        ,pessoa.numero
                        ,pessoa.cep
                        ,pessoa.complemento
                        ,pessoa.telefone1
                        ,pessoa.telefone2
                        ,pessoa.telefone3
                        ,pessoa.id_pessoa_cad
                        ,pessoa.dt_cad
                        ,pessoa.dt_alt
                        ,pessoa.ativo
                        ,pessoa.cnpj
                        ,grupo_acesso.id_grupo_acesso
                        ,cidade.id_cidade 
                        ,estado.id_estado
                        ,cidade.nome as nome_cidade
                        ,estado.nome as nome_estado
			            ,pessoa_cad.nome as nome_pessoa_cad
			            ,pessoa_alt.nome as nome_pessoa_alt                        
                        ,pessoa_vendedor.id_pessoa as id_pessoa_vendedor
                        ,pessoa_vendedor.nome as nome_vendedor
                        ,DATE_FORMAT(pessoa.data_para_visita, '%d/%m/%Y %H:%i') data_para_visita
                    FROM pessoa 
                    INNER JOIN tipo_pessoa ON tipo_pessoa.id_tipo_pessoa = pessoa.id_tipo_pessoa
                        LEFT JOIN grupo_acesso ON grupo_acesso.id_grupo_acesso = pessoa.id_grupo_acesso
                        LEFT JOIN cidade ON cidade.id_cidade =  pessoa.id_cidade
                        LEFT JOIN estado ON estado.id_estado = cidade.id_estado        
                        LEFT JOIN pessoa pessoa_cad ON pessoa_cad.id_pessoa =  pessoa.id_pessoa_cad
			            LEFT JOIN pessoa pessoa_alt ON pessoa_alt.id_pessoa =  pessoa.id_pessoa_alt
                        LEFT JOIN pessoa pessoa_vendedor ON pessoa_vendedor.id_pessoa =  pessoa.id_pessoa_vendedor                                     
                    WHERE 1 = 1 ".$loWhere;
        //echo $loSql;
        $query= $pdo->prepare($loSql);
        $query->execute();          

        $i = 0;
        $listaPessoa = array();
        foreach ($query as $row) {

            $loPessoaItem = new pessoaVO();
            $loPessoaItem->mbIdPessoa		  = $row["id_pessoa"];
            $loPessoaItem->mbNome			  = $row["nome_pessoa"];
            $loPessoaItem->mbLogin			  = $row["login"];
            $loPessoaItem->mbEmail			  = $row["email"];
            $loPessoaItem->mbIdTipoPessoa	  = $row["id_tipo_pessoa"];
            $loPessoaItem->mbNomeTipoPessoa   = $row["nome_tipo_pessoa"];
            $loPessoaItem->mbEndereco		  = $row["endereco"];
            $loPessoaItem->mbBairro		      = $row["bairro"];
            $loPessoaItem->mbNumero		      = $row["numero"];
            $loPessoaItem->mbCep			  = $row["cep"];
            $loPessoaItem->mbComplemento	  = $row["complemento"];
            $loPessoaItem->mbTelefone1		  = $row["telefone1"];
            $loPessoaItem->mbTelefone2		  = $row["telefone2"];
            $loPessoaItem->mbTelefone3		  = $row["telefone3"];
            $loPessoaItem->mbIdPessoaCad	  = $row["id_pessoa_cad"];
            $loPessoaItem->mbDtCad			  = $row["dt_cad"];
            $loPessoaItem->mbDtAlt			  = $row["dt_alt"];
            $loPessoaItem->mbStatus			  = $row["ativo"];
            $loPessoaItem->mbCnpj			  = $row["cnpj"];
            $loPessoaItem->mbIdGrupoAcesso    = $row["id_grupo_acesso"];
            $loPessoaItem->mbIdCidade         = $row["id_cidade"];
            $loPessoaItem->mbNomeCidade       = $row["nome_cidade"];
            $loPessoaItem->mbEstadoCidade     = $row["nome_estado"];
            $loPessoaItem->mbIdEstado         = $row["id_estado"];
            $loPessoaItem->mbNomePessoaCad    = $row["nome_pessoa_cad"];
            $loPessoaItem->mbNomePessoaAlt    = $row["nome_pessoa_alt"];
            $loPessoaItem->mbIdPessoaVendedor = $row["id_pessoa_vendedor"];
            $loPessoaItem->mbNomeVendedor     = $row["nome_vendedor"];
            $loPessoaItem->mbDataParaVisita   = $row["data_para_visita"];
            $listaPessoa[$i] = $loPessoaItem;
            $i++;            
        
        }
        return  $listaPessoa;
    }

    public function IncluirPessoa($prPessoaVO){
        
            $loConexao = new Conexao();
            $pdo = $loConexao->IniciaConexao();

            $loComumBO = new comumBO();

            $loIdPessoa     = $prPessoaVO->mbIdPessoa;
            $loNome         = utf8_decode($prPessoaVO->mbNome);
            $loCnpj         = $prPessoaVO->mbCnpj;
            $loCep          = $prPessoaVO->mbCep;
            $loEndereco     = utf8_decode($prPessoaVO->mbEndereco);
            $loBairro       = utf8_decode($prPessoaVO->mbBairro);
            $loNumero       = $prPessoaVO->mbNumero;
            $loIdCidade     = $prPessoaVO->mbIdCidade;
            $loComplemento  = utf8_decode($prPessoaVO->mbComplemento);
            $loTelefone1    = $prPessoaVO->mbTelefone1;
            $loTelefone2    = $prPessoaVO->mbTelefone2;
            $loTelefone3    = $prPessoaVO->mbTelefone3;
            $loEmail        = $prPessoaVO->mbEmail;
            $loStatus       = $prPessoaVO->mbStatus;
            $loIdTipoPessoa = $prPessoaVO->mbIdTipoPessoa;
            $loIdGrupoAcesso = $prPessoaVO->mbIdGrupoAcesso;
            $loIdPessoaVendedor = $prPessoaVO->mbIdPessoaVendedor;
            $loDataParaVisita   = $loComumBO->FormataDataYMDHMY($prPessoaVO->mbDataParaVisita);

            $loLogin = NULL;
            if(isset($prPessoaVO->mbLogin)){
                $loLogin = $prPessoaVO->mbLogin;
            }
            $loSenha = NULL;
            if(isset($prPessoaVO->mbSenhaConf)){
                $loSenha = base64_encode($prPessoaVO->mbSenhaConf);
            }

            $loSql = "INSERT INTO pessoa
                        (
                             nome
                             ,cnpj
                             ,cep
                             ,endereco
                             ,bairro
                             ,numero
                             ,id_cidade
                             ,complemento
                             ,telefone1
                             ,telefone2
                             ,telefone3
                             ,email
                             ,id_pessoa_cad
                             ,id_tipo_pessoa                             
                             ,login
                             ,senha
                             ,id_grupo_acesso  
                             ,ativo
                             ,id_pessoa_vendedor
                             ,data_para_visita
                             ,dt_cad                                                       
                        ) VALUES 
                            (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())
                        "; 
            $query = $pdo->prepare($loSql);
            $query->bindValue(1,  $loNome);
            $query->bindValue(2,  $loCnpj);
            $query->bindValue(3,  $loCep);
            $query->bindValue(4,  $loEndereco);
            $query->bindValue(5,  $loBairro);
            $query->bindValue(6,  $loNumero);
            $query->bindValue(7,  $loIdCidade);
            $query->bindValue(8,  $loComplemento);
            $query->bindValue(9,  $loTelefone1);
            $query->bindValue(10, $loTelefone2);
            $query->bindValue(11, $loTelefone3);
            $query->bindValue(12, $loEmail);
            $query->bindValue(13, $_SESSION["id_pessoa_usuario"]);
            $query->bindValue(14, $loIdTipoPessoa);
            $query->bindValue(15, $loLogin);
            $query->bindValue(16, $loSenha);
            $query->bindValue(17, $loIdGrupoAcesso);
            $query->bindValue(18, $loStatus);
            $query->bindValue(19, $loIdPessoaVendedor);
            $query->bindValue(20, $loDataParaVisita);
            $query->execute();  

            $loSqlMax = "SELECT MAX(id_pessoa) id_pessoa_max FROM pessoa";
            $queryMax = $pdo->prepare($loSqlMax);
            $queryMax->execute();  
            foreach ($queryMax as $row) {
                $loIdPessoaCad = $row["id_pessoa_max"];
            }

            $loRetorno = array("erro" => false, "id_pessoa" => $loIdPessoaCad);

            return $loRetorno;                        

    }

    public function AlterarPessoa($prPessoaVO){

            $loConexao = new Conexao();
            $pdo = $loConexao->IniciaConexao();

            $loComumBO = new comumBO();

            $loIdPessoa     = $prPessoaVO->mbIdPessoa;
            $loNome         = utf8_decode($prPessoaVO->mbNome);
            $loCnpj         = $prPessoaVO->mbCnpj;
            $loCep          = $prPessoaVO->mbCep;
            $loEndereco     = utf8_decode($prPessoaVO->mbEndereco);
            $loBairro       = utf8_decode($prPessoaVO->mbBairro);
            $loNumero       = $prPessoaVO->mbNumero;
            $loIdCidade     = $prPessoaVO->mbIdCidade;
            $loComplemento  = utf8_decode($prPessoaVO->mbComplemento);
            $loTelefone1    = $prPessoaVO->mbTelefone1;
            $loTelefone2    = $prPessoaVO->mbTelefone2;
            $loTelefone3    = $prPessoaVO->mbTelefone3;
            $loEmail        = $prPessoaVO->mbEmail;
            $loStatus       = $prPessoaVO->mbStatus;
            $loIdTipoPessoa = $prPessoaVO->mbIdTipoPessoa;
            $loIdGrupoAcesso = $prPessoaVO->mbIdGrupoAcesso;   
            $loIdPessoaVendedor = $prPessoaVO->mbIdPessoaVendedor;       
            $loDataParaVisita   = $loComumBO->FormataDataYMDHMY($prPessoaVO->mbDataParaVisita);  

            $loParamentros = "";
            if($loIdTipoPessoa == 1){
                $loLogin = $prPessoaVO->mbLogin;
                $loSenhaConf = $prPessoaVO->mbSenhaConf;

                $loParamentros .= " ,login = '".$loLogin."' 
                                   ,id_grupo_acesso = ".$loIdGrupoAcesso." ";

                if($loSenhaConf != ""){
                   $loParamentros .= " ,senha = '".base64_encode($loSenhaConf)."'";
             
                }
            }

            $loSql = "UPDATE pessoa SET 
                              nome = ?
                             ,cnpj = ?
                             ,cep = ?
                             ,endereco = ?
                             ,bairro = ?
                             ,numero = ?
                             ,id_cidade = ?
                             ,complemento = ?
                             ,telefone1 = ?
                             ,telefone2 = ?
                             ,telefone3 = ?
                             ,email = ?
                             ,id_tipo_pessoa = ?
                             ,ativo = ?
                             ,id_pessoa_alt = ?
                             ,id_pessoa_vendedor = ?
                             ,data_para_visita = ?
                             ,dt_alt = NOW()
                             ,id_pessoa_alt = NOW()
                             ".$loParamentros."                             
                        WHERE 
                            id_pessoa = ".$loIdPessoa;

            $query = $pdo->prepare($loSql);
            $query->bindValue(1,  $loNome);
            $query->bindValue(2,  $loCnpj);
            $query->bindValue(3,  $loCep);
            $query->bindValue(4,  $loEndereco);
            $query->bindValue(5,  $loBairro);
            $query->bindValue(6,  $loNumero);
            $query->bindValue(7,  $loIdCidade);
            $query->bindValue(8,  $loComplemento);
            $query->bindValue(9,  $loTelefone1);    
            $query->bindValue(10, $loTelefone2);
            $query->bindValue(11, $loTelefone3);
            $query->bindValue(12, $loEmail);
            $query->bindValue(13, $loIdTipoPessoa);
            $query->bindValue(14, $loStatus);
            $query->bindValue(15, $_SESSION["id_pessoa_usuario"]);
            $query->bindValue(16, $loIdPessoaVendedor);
            $query->bindValue(17, $loDataParaVisita);
            $query->execute();  

            return true;                              

    }

    public function VerificaLoginExiste($mbLogin){

        $loConexao = new Conexao();
        $pdo = $loConexao->IniciaConexao();

        $loContaLogin = 0;
        $loSql = "SELECT COUNT(*) CONTA_LOGIN 
                  FROM pessoa 
                  WHERE ativo = 1 
                  AND id_tipo_pessoa = 1 
                  AND login like '%".$mbLogin."%'"; 
        $query= $pdo->prepare($loSql);
        $query->execute();          

        foreach ($query as $row) {
            $loContaLogin = $row["CONTA_LOGIN"];
        }

        $loRetorno = array( "cotagem" => $loContaLogin );

        return $loRetorno;

    }

}

?>