<?php

Class agendaBOA{

    public function ConsultaAgenda($loAgendaFiltroVO){


        $loComumBO = new comumBO();
        $loConexao = new Conexao();
        $pdo = $loConexao->IniciaConexao();

        $loWhere = NULL;

        if( isset($loAgendaFiltroVO->mbStatus) && !empty($prPessoaFiltroVO->mbStatus) ){
            $loWhere .= " AND agenda.ativo = ".$loAgendaFiltroVO->mbStatus;
        }else{
            $loWhere .= " AND agenda.ativo = 1 ";
        }

        if( isset($loAgendaFiltroVO->mbIdAgenda) && !empty($loAgendaFiltroVO->mbIdAgenda) ){
            $loWhere .= " AND agenda.id_agenda = ".$loAgendaFiltroVO->mbIdAgenda;
        }

        if( isset($loAgendaFiltroVO->mbConsulta) && !empty($loAgendaFiltroVO->mbConsulta) ){
            $loConsulta = true;
        }else{
            $loConsulta = false;
        }

        if( isset($loAgendaFiltroVO->mbExibicaoAgendaTotal) && !empty($loAgendaFiltroVO->mbExibicaoAgendaTotal)){

            if($loAgendaFiltroVO->mbExibicaoAgendaTotal == "N"){
                $date = date('Y-m-d');
                $loWhere .= " AND agenda.data_visita = '".$date."' ";
                if($loAgendaFiltroVO->mbIndVisitado == ""){
                    $loWhere .= " AND agenda.ind_visitado = 0 ";
                }
            }
        }

        if( isset($loAgendaFiltroVO->mbDataVisitaInc) && !empty($loAgendaFiltroVO->mbDataVisitaInc) && isset($loAgendaFiltroVO->mbDataVisitaFim) && !empty($loAgendaFiltroVO->mbDataVisitaFim)  ){
            $loWhere .= " AND agenda.data_visita >= '".$loComumBO->FormataDataYMD($loAgendaFiltroVO->mbDataVisitaInc)."' AND agenda.data_visita <= '".$loComumBO->FormataDataYMD($loAgendaFiltroVO->mbDataVisitaFim)."'";
        }

        if( isset($loAgendaFiltroVO->mbIdCliente) && !empty($loAgendaFiltroVO->mbIdCliente) ){
            $loWhere .= " AND pessoa_cliente.id_pessoa = ".$loAgendaFiltroVO->mbIdCliente;
        }   

        if( isset($loAgendaFiltroVO->mbTelefone) && !empty($loAgendaFiltroVO->mbTelefone) ){
            $loWhere .= " AND pessoa_cliente.telefone1 = '".$loAgendaFiltroVO->mbTelefone."'";
        }   

        if( isset($loAgendaFiltroVO->mbIdCidade) && !empty($loAgendaFiltroVO->mbIdCidade) ){
            $loWhere .= " AND pessoa_cliente.id_cidade = '".$loAgendaFiltroVO->mbIdCidade."'";
        }  
        
        if( isset($loAgendaFiltroVO->mbIndVisitado) && !empty($loAgendaFiltroVO->mbIndVisitado) ){
            $loWhere .= " AND agenda.ind_visitado = ".$loAgendaFiltroVO->mbIndVisitado;
        }  

        if( isset($loAgendaFiltroVO->mbIndAtrazados) && ($loAgendaFiltroVO->mbIndAtrazados) ){
            $loWhere .= " AND DATEDIFF(agenda.data_visita,NOW()) < 0  AND  agenda.ind_visitado = 0 ";
        }             

        $loListaPermissoes = $loComumBO->VerificaAcessosUsuario();       
        if($loListaPermissoes->mbIndExibeAgenda){
           $loWhere .= " AND agenda.id_pessoa_cad = ".$_SESSION["id_pessoa_usuario"];
        }               

        $loSql = "SELECT 
                    agenda.id_agenda
                    ,pessoa_cliente.id_pessoa as id_pessoa_cliente
                    ,pessoa_cliente.nome as nome_cliente
                    ,pessoa_cliente.telefone1
                    ,DATE_FORMAT(agenda.data_visita, '%d/%m/%Y') data_visita
                    ,agenda.ind_visitado
                    ,agenda.dt_cad
                    ,agenda.dt_alt
                    ,pessoa_cad.id_pessoa as id_pessoa_cad
                    ,pessoa_cad.nome as nome_pessoa_cad
                    ,pessoa_alt.id_pessoa as id_pessoa_alt
                    ,pessoa_alt.nome as nome_pessoa_alt
                    ,agenda.ativo
                    ,agenda.observacao
                    ,produto.id_produto
                    ,produto.nome nome_produto
                    ,DATE_FORMAT(NOW(), '%d/%m/%Y') data_atual
                    ,agenda.qtd_produto
                    ,DATEDIFF(agenda.data_visita,NOW()) dias_atrazo
                    ,DATE_FORMAT(pessoa_cliente.data_para_visita, '%d/%m/%Y %H:%i') data_para_visita
                FROM agenda
                INNER JOIN pessoa pessoa_cliente ON pessoa_cliente.id_pessoa =  agenda.id_pessoa_cliente
                LEFT JOIN pessoa pessoa_cad ON pessoa_cad.id_pessoa =  agenda.id_pessoa_cad
                LEFT JOIN pessoa pessoa_alt ON pessoa_alt.id_pessoa =  agenda.id_pessoa_alt
                LEFT JOIN produto ON produto.id_produto = agenda.id_produto
                WHERE 1=1 ".$loWhere;


        $query= $pdo->prepare($loSql);
        $query->execute();

        $i = 0;
        $listaAgenda = array(); 
        foreach ($query as $row) {

            $loItem = new agendaVO();
            $loItem->mbIdAgenda             = $row["id_agenda"];
            $loItem->mbIdPessoaCliente      = $row["id_pessoa_cliente"];
            $loItem->mbNomeCliente          = $row["nome_cliente"];
            $loItem->mbDataVisita           = $row["data_visita"];
            $loItem->mbIndVisitado          = $row["ind_visitado"];
            $loItem->mbDtCad                = $row["dt_cad"];
            $loItem->mbDtAlt                = $row["dt_alt"];
            $loItem->mbIdPessoaCad          = $row["id_pessoa_cad"];
            $loItem->mbNomePessoaCad        = $row["nome_pessoa_cad"];
            $loItem->mbIdPessoaAlt          = $row["id_pessoa_alt"];
            $loItem->mbNomePessoaAlt        = $row["nome_pessoa_alt"];
            $loItem->mbAtivo                = $row["ativo"];
            $loItem->mbTelefone1Cliente     = $row["telefone1"];
            $loItem->mbObservacao           = $row["observacao"];
            $loItem->mbIdProdutos           = $row["id_produto"];
            $loItem->mbNomeProdutos         = $row["nome_produto"];
            $loItem->mbDataAtual            = $row["data_atual"];
            $loItem->mbQtdProduto           = $row["qtd_produto"];
            $loItem->mbDiasAtrado           = str_replace("-","",$row["dias_atrazo"]);
            $loItem->mbDataParaVisita       = $row["data_para_visita"];
            $listaAgenda[$i] = $loItem;
            $i++;   
        }
        return $listaAgenda; 

    }

    public function ContaAgendamentoAtrasados(){

        $loComumBO = new comumBO();
        $loConexao = new Conexao();
        $pdo = $loConexao->IniciaConexao();

        $loWhere = NULL;

        $loListaPermissoes = $loComumBO->VerificaAcessosUsuario();       
        if($loListaPermissoes->mbIndExibeAgenda){
           $loWhere .= " AND agenda.id_pessoa_cad = ".$_SESSION["id_pessoa_usuario"];
        }   

        $loSql = "SELECT COUNT(*) CONTA_ATRAZADOS
                  FROM agenda
                  INNER JOIN pessoa pessoa_cliente ON pessoa_cliente.id_pessoa =  agenda.id_pessoa_cliente
                  LEFT JOIN pessoa pessoa_cad ON pessoa_cad.id_pessoa =  agenda.id_pessoa_cad
                  LEFT JOIN pessoa pessoa_alt ON pessoa_alt.id_pessoa =  agenda.id_pessoa_alt
                  LEFT JOIN produto ON produto.id_produto = agenda.id_produto
                  WHERE 1=1 AND DATEDIFF(agenda.data_visita,NOW()) < 0  AND  agenda.ind_visitado = 0 AND agenda.ativo = 1 ". $loWhere;
        $query= $pdo->prepare($loSql);
        $query->execute();

        $i = 0;
        $listaAgenda = array();
        foreach ($query as $row) { 

            $loItem = new agendaVO();
            $loItem->mbDiasAtrado  = $row["CONTA_ATRAZADOS"];
            $listaAgenda[$i] = $loItem;
            $i++;  

        }
        return $listaAgenda;                     

    }

    public function IncluirAgenda($mbDados){

            $loConexao = new Conexao();
            $pdo = $loConexao->IniciaConexao();

            $loComumBO = new comumBO();


            $loIdAgenda             = $mbDados["id_agenda"];
            $loIdPessoaCliente      = $mbDados["id_pessoa_cliente"];
            $loDataVisita           = $loComumBO->FormataDataYMD($mbDados["data_visita"]);
            $loIndVisitado          = $mbDados["ind_visitado"];
            $loAtivo                = $mbDados["ativo"];
            $loIdProduto            = $mbDados["id_produto"];
            $loObs                  = utf8_decode($mbDados["observacao"]);
            $loQtdProduto           = $mbDados["qtd_produto"];
            $loProdutos             = 1;       


            $loSql = "INSERT INTO agenda 
                        (
                        id_pessoa_cliente
                        ,data_visita
                        ,ind_visitado
                        ,id_pessoa_cad
                        ,id_produto
                        ,observacao
                        ,qtd_produto
                        ,ativo
                        ,dt_cad
                        ) VALUES 
                        (?,?,?,?,?,?,?,1,NOW())";   

            $query = $pdo->prepare($loSql);
            $query->bindValue(1,  $loIdPessoaCliente);
            $query->bindValue(2,  $loDataVisita);
            $query->bindValue(3,  $loIndVisitado);
            $query->bindValue(4,  $_SESSION["id_pessoa_usuario"]);
            $query->bindValue(5,  $loIdProduto);
            $query->bindValue(6,  $loObs);
            $query->bindValue(7,  $loQtdProduto);
            $query->execute();

            return true;
    }

    public function AlterarAgenda($mbDados){

            $loConexao = new Conexao();
            $pdo = $loConexao->IniciaConexao();
            $loComumBO = new comumBO();

            $loIdAgenda             = $mbDados["id_agenda"];
            $loIdPessoaCliente      = $mbDados["id_pessoa_cliente"];
            $loDataVisita           = $loComumBO->FormataDataYMD($mbDados["data_visita"]);
            $loIndVisitado          = $mbDados["ind_visitado"];
            $loAtivo                = $mbDados["ativo"];
            $loIdProduto            = $mbDados["id_produto"];
            $loObs                  = utf8_decode($mbDados["observacao"]);
            $loQtdProduto           = $mbDados["qtd_produto"];
            $loProdutos             = 1;       

            $loSql = "UPDATE  agenda 
                        SET
                        id_pessoa_cliente = ?
                        ,data_visita = ?
                        ,ind_visitado = ?
                        ,id_pessoa_alt = ?
                        ,id_produto = ?
                        ,observacao = ?
                        ,qtd_produto = ?
                        ,dt_alt = NOW() 
                        WHERE id_agenda = ".$loIdAgenda ; 
            $query = $pdo->prepare($loSql);
            $query->bindValue(1,  $loIdPessoaCliente);
            $query->bindValue(2,  $loDataVisita);
            $query->bindValue(3,  $loIndVisitado);
            $query->bindValue(4,  $_SESSION["id_pessoa_usuario"]);
            $query->bindValue(5,  $loIdProduto);
            $query->bindValue(6,  $loObs);
            $query->bindValue(7,  $loQtdProduto);
            $query->execute();

            return true;
    }

    public function DesativaAgendamento($mbDados){

        $loConexao = new Conexao();
        $pdo = $loConexao->IniciaConexao();

        $loIdAgenda = $mbDados["id_agenda"];
        $loMotivoDesativacao = $mbDados["motivo_desativacao"];

        $loSql = "UPDATE  agenda 
                    SET
                    motivo_desativacao = ?
                    ,id_pessoa_alt = ?
                    ,ativo = 0
                    ,dt_alt = NOW() 
                    WHERE id_agenda = ".$loIdAgenda ; 
        $query = $pdo->prepare($loSql);
        $query->bindValue(1,  $loMotivoDesativacao);
        $query->bindValue(2,  $_SESSION["id_pessoa_usuario"]);
        $query->execute();

        return true;

    }
    //GravaAgendaVisitada
    public function GravaAgendaVisitada($prAgendaVO){

        $loConexao = new Conexao();
        $pdo = $loConexao->IniciaConexao();

        $loRetorno = false;
        if($prAgendaVO->mbIdAgenda <> ""){

            $loSql = "UPDATE agenda SET ind_visitado = 1 WHERE id_agenda = ".$prAgendaVO->mbIdAgenda;
            $query= $pdo->prepare($loSql);
            $query->execute();

           $loRetorno = true;
        }

        return $loRetorno;
    }

}

?>