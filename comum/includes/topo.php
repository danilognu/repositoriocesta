<?php
    include_once("../../anotacoes/modelo-anotacao.php");
    include_once("../../anotacoes/negocio-anotacao.php");

    include_once("../../agenda/modelo-agenda.php");
    include_once("../../agenda/negocio-agenda.php");
    
    $loContaAgenAtrazados = 0;

    $loAnotacaoVO = new anotacaoVO();
    $loAnotacaoBO = new anotacaoBO();

    $loTopAgendaFiltroVO = new agendaFiltroVO();
    $loTopAgendaFiltroVO->mbIndAtrazados = 1; 
    $loTopAgendaBO = new agendaBO();

    
?>

     <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="#">
                        <img src="../../../assets/layouts/layout/img/logo.png" alt="logo" class="logo-default" /> 
                    </a>
                    <div class="menu-toggler sidebar-toggler"> </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN TOP NAVIGATION MENU -->

                <?php
                    $TpContAgendas = $loTopAgendaBO->ContaAgendamentoAtrasados();
                    if(count($TpContAgendas) > 0 ){
                        foreach ($TpContAgendas as $TpAgenda){
                            $loContaAgenAtrazados =$TpAgenda->mbDiasAtrado;
                        }
                    }
                ?>

                <div class="top-menu">
                    
                    <ul class="nav navbar-nav pull-right">
                       

                        <li class="dropdown dropdown-extended" id="header_cad_cli">
                            <a style="padding-right:10px;" href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" title="Cadastro Rapido de Cliente" data-close-others="true" id="btn-top-adicionar-pre-cad-cliente" >
                                <i  class="icon-layers"></i>
                            </a>
                        </li>

                     <?php if($loContaAgenAtrazados > 0){ ?>    

                        <!-- BEGIN NOTIFICATION DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" title="Agendamentos em atrasos" >
                                <i class="icon-bell"></i>
                                <span class="badge badge-default"> <?php echo $loContaAgenAtrazados; ?> </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="external">
                                    <h3> Agendamentos em atraso </h3>
                                    <a href="../../../admin_1/page_user_profile_1.html">Ver Todos</a>
                                </li>
                                <li>
                                    <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                        <?php
                                            $TpAgendas = $loTopAgendaBO->ConsultaAgenda($loTopAgendaFiltroVO);
                                            if(count($TpAgendas) > 0 ){
                                                foreach ($TpAgendas as $TpAgenda){
                                        ?>
                                        <li>
                                            <a href="../../agenda/apresentacao/adicionar-agenda.php?id_agenda=<?php echo $TpAgenda->mbIdAgenda; ?>">
                                                <span class="time"><?php echo $TpAgenda->mbDiasAtrado; ?> dias</span>
                                                <span class="details">
                                                    <span class="label label-sm label-icon label-danger">
                                                        <i class="fa fa-hourglass-end"></i>
                                                    </span> <?php echo $TpAgenda->mbNomeCliente; ?> </span>
                                            </a>
                                        </li>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <!-- END NOTIFICATION DROPDOWN -->
                    <?php } ?>
                        <!-- BEGIN INBOX DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" title="Anotacoes" >
                                <i class="fa fa-edit"></i>
                                <!--span class="badge badge-default"> 4 </span-->
                            </a>
                            <ul class="dropdown-menu">
                                <li class="external">
                                    <!--h3>You have
                                        <span class="bold">7 New</span> Messages</h3-->
                                    <!--a href="../../../admin_1/app_inbox.html">Anota&ccedil;&atilde;o</a-->
                                    <div style="padding-left:5px;" >    
                                        <button class="btn dark" id="btn-adiciona-nova-anotacao" >Adicionar Nova uma Anotacao
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>

                                </li>
                                <li>
                                    <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                       <?php
                                       $loAnotacoes = $loAnotacaoBO->ConsultaAnotacao($loAnotacaoVO);
                                        if(count($loAnotacoes) > 0 ){
                                            foreach ($loAnotacoes as $Anotacao){
                                       ?>
                                        <li>
                                            <a href="#" class="abrir-anotacao-cadastrada" id="<?php echo $Anotacao->mbIdAnotacao; ?>" >
                                                <?php echo substr($Anotacao->mbDescricao, 0 ,35); ?> <br /> 
                                                <?php echo "<span style='font-size:10px'>Data Cad<span>: ".$Anotacao->mbDtCad; ?>
                                            </a>
                                        </li>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <!-- END INBOX DROPDOWN -->
                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <!--img alt="" class="img-circle" src="../../../assets/layouts/layout/img/avatar3_small.jpg" -->
                                <i class="fa fa-user"></i>
                                <span class="username username-hide-on-mobile"> <?php echo $_SESSION["nome"]; ?> </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="../../pessoa/apresentacao/adicionar-usuario.php.php?id_pessoa=<?php echo $_SESSION["id_pessoa_usuario"]; ?>">
                                        <i class="icon-user"></i> Alterar </a>
                                </li>
                                <li class="divider"> </li>
                                <li>
                                    <a href="../../login/apresentacao/login.php">
                                        <i class="icon-logout"></i> Sair </a>
                                </li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->
                        <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-quick-sidebar-toggler">
                            <a href="javascript:;" class="dropdown-toggle" title="Sair do sistema" >
                                <i class="icon-logout"></i>
                            </a>
                        </li>
                        <!-- END QUICK SIDEBAR TOGGLER -->
                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        
      