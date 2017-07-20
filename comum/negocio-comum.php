<?php
include("persistencia-comum.php");

Class comumBO{

    public function MenuPai($mbDados){

        $loMenu = new menuBOA();
        $loLista = $loMenu->MenuPai($mbDados);       

        return $loLista;

    }

    public function MenuFilhos($mbDados){

        $loMenu = new menuBOA();
        $loLista = $loMenu->MenuFilhos($mbDados);       

        return $loLista;

    }

    public function VerificaAcessosUsuario(){

        $loComumBOA = new comumBOA();
        $loLista = $loComumBOA->VerificaAcessosUsuario();       

        return $loLista;

    }

    

    public function MascaraTelefone($mbTelefone){
       $loTelefone = "(".substr($mbTelefone, 0, 2).") ".substr($mbTelefone, 2, 4)."-".substr($mbTelefone, 6, 5);
       return $loTelefone;
    }

    public function RemoverMascaraTelefone($mbTelefone){
        $loRemovStr = array("(",")","-"," ");
        $loTelefone = str_replace($loRemovStr, "", $mbTelefone);
        return $loTelefone;
    }

    public function ListaEstado($mbDados){

        $loListaEstado = new comumBOA();
        $loLista = $loListaEstado->ListaEstado($mbDados);

        return  $loLista;
    }

    public function ListaCidade($loIdEstado,$loIdCidade){

        $loListaCidade = new comumBOA();
        $loLista = $loListaCidade->ListaCidade($loIdEstado,$loIdCidade);

        return  $loLista;

    }

    public function FormataDataYMD($loString){

      $loRemovStr = array("/"," ");
      $loString = str_replace($loRemovStr, "", $loString);
      
      $loMntData = NULL;   
      if(!empty($loString)){
        $loDia = substr($loString, 0,2);
        $loMes = substr($loString, 2,2);
        $loAno = substr($loString, 4,4);
        $loMntData = $loAno."-".$loMes."-".$loDia;
      }
      return $loMntData;

    }

    public function FormataDataYMDHMY($loString){

      $loRemovStr = array("/"," ");
      $loString = str_replace($loRemovStr, "", $loString);
      
      $loMntData = NULL;   
      if(!empty($loString)){
        $loDia = substr($loString, 0,2);
        $loMes = substr($loString, 2,2);
        $loAno = substr($loString, 4,4);
        $loHora = substr($loString, 8,2);
        $loMinu = substr($loString, 10,2);

        $loMntData = $loAno."-".$loMes."-".$loDia." ".$loHora.":".$loMinu;

      }
      return $loMntData;

    }    

    public function VerificaPermissoes($prComumPermissoesVO){

        $loComumBOA = new comumBOA();
        $loComum = $loComumBOA->VerificaPermissoes($prComumPermissoesVO);

        return  $loComum;
    }

}

?>