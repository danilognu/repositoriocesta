<?php 
include("../../comum/comum.php"); 
include("../modelo-pessoa.php");
include("../negocio-pessoa.php");

$loDados = NULL;
if(isset($_POST["dados"])){
    $loDados = $_POST["dados"];
}else{
    $loDados = array("id_tipo_pessoa" => 1);
}

$loPessoa = new pessoaBO();
$loRetorno = $loPessoa->ConsultaPessoa($loDados);



if(count($loRetorno) > 0 ){

    foreach ($loRetorno as $row){
        
    ?>

    <tr class="odd gradeX abrir-pessoa" id="<?php echo $row->mbIdPessoa; ?>" >
            <td style='cursor:pointer;' > <?php echo $row->mbIdPessoa; ?> </td>
            <td style='cursor:pointer;' > <?php echo $row->mbNome; ?> </td>
            <td style='cursor:pointer;' > <?php echo $row->mbLogin; ?> </td>
            <td style='cursor:pointer;' > <?php echo $row->mbEmail; ?> </td>
    </tr>
<?php

    }
    
}
     

?>




