<?php 
include("../../comum/comum.php"); 
include("../modelo-produto.php");
include("../negocio-produto.php");

$loDados = NULL;
if(isset($_POST["dados"])){
    $loDados = $_POST["dados"];
}

$loProduto = new produtoBO();
$loRetorno = $loProduto->ConsultaProduto($loDados);



if(count($loRetorno) > 0 ){

    foreach ($loRetorno as $row){
        
    ?>

    <tr class="odd gradeX abrir-produto" id="<?php echo $row->mbIdProduto; ?>" >
            <td style='cursor:pointer; width: 10%' > <?php echo $row->mbIdProduto; ?> </td>
            <td style='cursor:pointer; width: 20%' > <?php echo $row->mbNome; ?> </td>
            <td style='cursor:pointer;' > <?php echo $row->mbDescricao; ?> </td>
    </tr>
<?php

    }
    
}

?>




