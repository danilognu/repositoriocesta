<?php 
include("../../comum/comum.php"); 
include("../modelo-grupo-acesso.php");
include("../negocio-grupo-acesso.php");

$loDados = NULL;
$loIdGrupoAcesso = NULL;
$loStatus = NULL;

if(isset($_POST["status"])){
   $loStatus =  $_POST["status"];
}
if(isset($_POST["id_grupo_acesso"])){
    $loIdGrupoAcesso =  $_POST["id_grupo_acesso"];
}


$loDados = array("id_grupo_acesso" => $loIdGrupoAcesso, "status" => $loStatus);
$loGrupoBO = new grupoAcessoBO();
$loGrupo = $loGrupoBO->ConsultaGrupo($loDados);



if(count($loGrupo) > 0 ){

    foreach ($loGrupo as $row){
        
    ?>

    <tr class="odd gradeX abrir-grupo-acesso" id="<?php echo $row->mbCodigoGrupo; ?>" >
            <td style='width: 01%' >  </td>
            <td style='width: 70%' > <?php echo $row->mbNome; ?>  </td>
            <td > 
                <?php if($row->mbStatus == 1 ) { ?>
                <button type="button" class="btn btn-primary btn-gerenciar" id="<?php echo $row->mbCodigoGrupo; ?>" >Gerenciar <i class="fa fa-gears"></i></button> 
                <?php } ?>
                <button type="button" class="btn blue" onclick="GrupoAcesso.buttonAletarGrupo_onClick(<?php echo $row->mbCodigoGrupo; ?>);" id="" >Alterar <i class="fa fa-edit"></i> </button>
            </td>
    </tr>
<?php

    }
    
}

?>





