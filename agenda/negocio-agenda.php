<?php 
include("persistencia-agenda.php");

Class agendaBO{

    public function ConsultaAgenda($prPessoaFiltroVO){

        $loAgenda = new agendaBOA();
        $loDados = $loAgenda->ConsultaAgenda($prPessoaFiltroVO);

        return $loDados;
    }

    public function AdicionaAgenda($mbDados){

        $loErro = false;
        $loMessagem = NULL;

        if($mbDados["data_visita"] == ""){
            $loMessagem = "Por favor, preencha o Nome do Data !";
            $loErro = true;           
        }

        if($mbDados["id_pessoa_cliente"] == ""){
            $loMessagem = "Por favor, preencha o Cliente!";
            $loErro = true;           
        }

        if($loErro){
              $loRetorno = array("erro" => $loErro, "messagem" => $loMessagem );
        }else{

           
            $loAgendaBOA = new agendaBOA();
            if($mbDados["id_agenda"] == ""){
                $loRetorno = $loAgendaBOA->IncluirAgenda($mbDados);
            }else{
                $loRetorno = $loAgendaBOA->AlterarAgenda($mbDados);
            }

            if(!$loRetorno["erro"]){
                $loRetorno = array("erro" => false, "messagem" => "" );
            }

        }

        return $loRetorno;

    }

    public function DesativaAgendamento($mbDados){

        $loAgenda = new agendaBOA();
        $loDados = $loAgenda->DesativaAgendamento($mbDados);

        return $loDados;        
    }

    public function GravaAgendaVisitada($prAgendaVO){

        $loAgenda = new agendaBOA();
        $loDados = $loAgenda->GravaAgendaVisitada($prAgendaVO);

        if($loDados){
            $loRetorno = array("erro" => false, "messagem" => "Agenda Alterada com Sucesso, deseja imprimir documento ou reagendado ?" );
        }else{
            $loRetorno = array("erro" => true, "messagem" => "Problema ao alterar agenda." );
        }
        return $loRetorno;        
    }

    public function ContaAgendamentoAtrasados(){

        $loAgenda = new agendaBOA();
        $loDados = $loAgenda->ContaAgendamentoAtrasados();

        return $loDados;        
    }

       
}

?>