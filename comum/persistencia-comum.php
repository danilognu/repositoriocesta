<?php

Class menuBOA{

    public function MenuPai($mbDados){

        $loConexao = new Conexao();
        $pdo = $loConexao->IniciaConexao();

        $tfJOIN = $mbDados["join"]; 

        $loSql = "SELECT 
                    menu.id_menu
                    ,menu.nome
                    ,menu.icone_css
                    ,menu.url 
                  FROM menu 
                  WHERE 
                  menu.id_menu_pai IS NULL";


        $query= $pdo->prepare($loSql);
        $query->execute(); 


        $i = 0;
        $loLista = array();    
        foreach ($query as $row) {

      
            $loitenMenuPai = new menuVO();
           
            $loitenMenuPai->mbIdNome = $row["id_menu"];
            $loitenMenuPai->mbNome = $row["nome"];
            $loitenMenuPai->mbUrl = $row["url"];
            $loitenMenuPai->mbIconCss = $row["icone_css"];
            $loLista[$i] = $loitenMenuPai;
            $i++;   

         
        }
        return $loLista;
    }

    public function MenuFilhos($mbDados){

        $id_menu_pai = $mbDados["id_menu_pai"];
        $tfJOIN = $mbDados["join"];  

        $loConexao = new Conexao();
        $pdo = $loConexao->IniciaConexao();

        if($tfJOIN == 1){
            $loJOIN = "LEFT";
        }else{
            $loJOIN = "INNER";
        }

        $loSql = "SELECT 
                   menu.id_menu
                   ,menu.nome
                   ,menu.icone_css
                   ,menu.url 
                FROM menu 
                WHERE id_menu_pai =".$id_menu_pai;
        $query= $pdo->prepare($loSql);
        $query->execute(); 

        $i = 0;
        $loLista = array();    
        foreach ($query as $row) {
            
            $loitenMenuFilho = new menuVO();
            $loitenMenuFilho->mbIdNome = $row["id_menu"];
            $loitenMenuFilho->mbNome = $row["nome"];
            $loitenMenuFilho->mbUrl = $row["url"];
            $loitenMenuFilho->mbIconCss = $row["icone_css"];

            $loLista[$i] = $loitenMenuFilho;
            $i++;            
        }
        return $loLista;
    }    

}

Class comumBOA{

    public function ListaEstado($mbDados) {

        $loConexao = new Conexao();
        $pdo = $loConexao->IniciaConexao();

        $loSql = "SELECT id_estado,nome,uf FROM estado WHERE 1=1 ORDER BY uf";
        $query= $pdo->prepare($loSql);
        $query->execute();          

        $loEstados = null;
        $i = 0;
        $listaEstado = array();
        foreach ($query as $row) {

            $loItem = new comumEstadoVO();
            $loItem->mbIdEstado = $row["id_estado"];
            $loItem->mbNome = $row["nome"];
            $loItem->mbUF = $row["uf"];

            $listaEstado[$i] = $loItem;
            $i++; 

        }

        return  $listaEstado;

    }

    public function ListaCidade($mbIdEstado,$mbIdCidade) {

        $loConexao = new Conexao();
        $pdo = $loConexao->IniciaConexao();
        
        $loConsulta =  null;
        /*if($mbIdCidade != ""){
            $loConsulta = " AND id_cidade = ".$mbIdCidade; 
        }*/

        $loSql = "SELECT id_cidade,nome,id_estado FROM cidade WHERE id_estado = ".$mbIdEstado." ".$loConsulta;
        $query= $pdo->prepare($loSql);
        $query->execute();          

        $loEstados = null;
        $i = 0;
        $listaCidade = array();
        foreach ($query as $row) {

            $loItem = new comumCidadeVO();                
            $loItem->mbIdCidade = $row["id_cidade"];
            $loItem->mbNome = utf8_encode($row["nome"]);
            $loItem->mbIdEstado = $row["id_estado"];

            $listaCidade[$i] = $loItem;
            $i++;             

        }

        return  $listaCidade;

    }

    public function VerificaAcessosUsuario(){
        
        $loConexao = new Conexao();
        $pdo = $loConexao->IniciaConexao();

        $loSql = "SELECT ind_padrao
                        ,ind_exibe_agenda 
                FROM grupo_acesso 
                WHERE id_grupo_acesso = ".$_SESSION["id_grupo_acesso"];
        
        $query= $pdo->prepare($loSql);
        $query->execute();          

        foreach ($query as $row) {

            $loItem = new comumPermissoesVO();                
            $loItem->mbIndPadaro = $row["ind_padrao"];
            $loItem->mbIndExibeAgenda = $row["ind_exibe_agenda"];
      
        }

        return  $loItem;

    }

    public function VerificaPermissoes($prComumPermissoesVO){

        $loConexao = new Conexao();
        $pdo = $loConexao->IniciaConexao();

        $loIdPessoa = $prComumPermissoesVO->mbIdPessoa;
        $loIdMenu = $prComumPermissoesVO->mbIdMenu;
        $loIdTipo = $prComumPermissoesVO->mbTipo;

        $loSql = " SELECT COUNT(id_pessoa) CONTA_PERMISSAO
                  FROM pessoa 
                    INNER JOIN grupo_acesso ON grupo_acesso.id_grupo_acesso = pessoa.id_grupo_acesso
                    INNER JOIN permissoes ON permissoes.id_grupo_acesso = grupo_acesso.id_grupo_acesso
                  WHERE id_pessoa = ".$loIdPessoa." 
                    AND permissoes.id_menu IN(".$loIdMenu.") 
                    AND permissoes.tipo = '".$loIdTipo."' ";
        $query= $pdo->prepare($loSql);
        $query->execute();          

        $loIndPermissao = false;
        foreach ($query as $row) {

            if($row["CONTA_PERMISSAO"] > 0){
                $loIndPermissao = true;
            }    
      
        }

        return $loIndPermissao;                    

    }



}

?>