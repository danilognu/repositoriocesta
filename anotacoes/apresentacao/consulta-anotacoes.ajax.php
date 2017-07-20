<?php 
include("../../comum/comum.php"); 
include_once("../modelo-anotacao.php");
include_once("../negocio-anotacao.php");

$loDados = NULL;
if(isset($_POST["dados"])){
    $loDados = $_POST["dados"];
}

$loAnotacaoVO = new anotacaoVO();

if(isset($_POST["status"])){ $loAnotacaoVO->mbStatus = $_POST["status"];}

$loAnotacaoBO = new anotacaoBO();
$loRetorno = $loAnotacaoBO->ConsultaAnotacao($loAnotacaoVO);



if(count($loRetorno) > 0 ){

    foreach ($loRetorno as $row){
        
    ?>

    <tr class="odd gradeX" id="<?php echo $row->mbIdAnotacao; ?>" >
            <td class="abrir-anotacao" id="<?php echo $row->mbIdAnotacao; ?>" style='cursor:pointer; width: 01%' >  </td>
            <td class="abrir-anotacao" id="<?php echo $row->mbIdAnotacao; ?>" style='cursor:pointer; width: 10%' > <?php echo $row->mbIdAnotacao; ?> </td>
            <td class="abrir-anotacao" id="<?php echo $row->mbIdAnotacao; ?>" style='cursor:pointer; width: 75%' > <?php echo $row->mbDescricao; ?> </td>
            <td class="abrir-anotacao" id="<?php echo $row->mbIdAnotacao; ?>" style='cursor:pointer; width: 15%' > <?php echo $row->mbDtCad; ?> </td> 
            <td style='width: 90%' >
                <button type='button' class='btn red desativa-anotacao' id="<?php echo $row->mbIdAnotacao; ?>" title='Desativa Anotacao' ><i class='fa fa-close'></i></button>
            </td>
    </tr>
<?php

    }
    
}

?>




