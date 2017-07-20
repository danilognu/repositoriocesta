<?php


$loItemMenu = new comumBO();
$loComumPermissoesVO = new comumPermissoesVO();

$loDadosMenu = array("join" => 0);
$loListaMenuPai = $loItemMenu->MenuPai($loDadosMenu);
?>       
                    <!-- BEGIN SIDEBAR MENU -->
                    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                        <li class="sidebar-toggler-wrapper hide">
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <div class="sidebar-toggler"> </div>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                        </li>
                        <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                        <li class="sidebar-search-wrapper">
                            <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                            <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                            <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                            <!-- END RESPONSIVE QUICK SEARCH FORM -->
                        </li>

                        <?php  
                        foreach ($loListaMenuPai as $rowPai) { 
                            
                           $loDadosM = array("id_menu_pai" => $rowPai->mbIdNome, "join" => 0);
                           $loListaMenuFilho = $loItemMenu->MenuFilhos($loDadosM);
                           $loIdMenuPF = "";
                           if(count($loListaMenuFilho) > 0) {
                               foreach ($loListaMenuFilho as $rowFilho) {
                                    $loIdMenuPF .= $rowFilho->mbIdNome.",";
                               }
                           } 
                            if($loIdMenuPF != ""){
                                $size = strlen($loIdMenuPF);
                                $loIdMenuPF = substr($loIdMenuPF,0, $size-1);
                            }else{
                                $loIdMenuPF =$rowPai->mbIdNome;
                            }
                            $loComumPermissoesVO->mbIdPessoa = $_SESSION["id_pessoa_usuario"];
                            $loComumPermissoesVO->mbIdMenu = $loIdMenuPF;
                            $loComumPermissoesVO->mbTipo = "V";
                            $loComumRetorno = $loItemMenu->VerificaPermissoes($loComumPermissoesVO);
                            if($loComumRetorno){
                                $loExibeMenuPai = true;
                            }else{
                                $loExibeMenuPai = false;
                            }

                           if($loExibeMenuPai){
                        ?>
                        <li class="nav-item  ">
                            <a href="<?php echo  $rowPai->mbUrl; ?>" class="nav-link nav-toggle">
                                <i class="<?php echo  $rowPai->mbIconCss; ?>"></i>
                                <span class="title"><?php echo  /*utf8_encode(*/$rowPai->mbNome/*)*/; ?> </span>
                                <span class="arrow"></span>
                            </a>
                            <?php 
                                $loDadosM = array("id_menu_pai" => $rowPai->mbIdNome, "join" => 0);
                                $loListaMenuFilho = $loItemMenu->MenuFilhos($loDadosM); 
                                if(count($loListaMenuFilho) > 0) { ?>
                                    <ul class="sub-menu">
                                    <?php  foreach ($loListaMenuFilho as $rowFilho) { 
                                    
                                    $loComumPermissoesVO->mbIdPessoa = $_SESSION["id_pessoa_usuario"];
                                    $loComumPermissoesVO->mbIdMenu = $rowFilho->mbIdNome;
                                    $loComumPermissoesVO->mbTipo = "V";
                                    $loComumRetorno = $loItemMenu->VerificaPermissoes($loComumPermissoesVO);
                                    if($loComumRetorno){
                                        $loExibeMenuFilho = true;
                                    }else{
                                        $loExibeMenuFilho = false;
                                    }
                                        if($loExibeMenuFilho){
                                    
                                    ?>
                                            <li class="nav-item  ">
                                                <a href="<?php echo  $rowFilho->mbUrl; ?>" class="nav-link ">
                                                    <span class="title"><?php echo  /*utf8_encode(*/$rowFilho->mbNome/*)*/; ?></span>
                                                </a>
                                            </li>
                                    <?php 
                                        }
                                    } ?>
                                    </ul>
                                <?php } ?>
                        </li>
                       <?php 
                            }
                       } 
                       ?>

                    
                    </ul>
                    <!-- END SIDEBAR MENU -->
