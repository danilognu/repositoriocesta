<?php 
$loRetorno = $loPessoa->ConsultaPessoa($loDados);


if(count($loRetorno) > 0 ){

    foreach ($loRetorno as $row){
        
    ?>

    <tr class="odd gradeX " id="<?php echo $row->mbIdPessoa; ?>" onClick="Cliente.AbrirPessoa_onClick(<?php echo $row->mbIdPessoa; ?>)" >
            <td style='width: 01%' >  </td>
            <td style='cursor:pointer; width: 05%' > <?php echo $row->mbIdPessoa; ?> </td>
            <td style='cursor:pointer;' > <?php echo $row->mbNome; ?> </td>
            <td style='cursor:pointer; width: 30%' > 
                <?php 
                 echo $loComumBO ->MascaraTelefone($row->mbTelefone1); 
                 if($row->mbTelefone2 != ""){
                    echo "&nbsp;&nbsp; / &nbsp;&nbsp; ".$loComumBO ->MascaraTelefone($row->mbTelefone2); 
                 }
                 if($row->mbTelefone3 != ""){
                    echo "&nbsp;&nbsp; / &nbsp;&nbsp; ".$loComumBO ->MascaraTelefone($row->mbTelefone3); 
                 }
                 ?>
            </td>
            <td style='cursor:pointer;' > <?php echo $row->mbEndereco; ?> </td>
            <td style='cursor:pointer;' > <?php echo $row->mbNomeVendedor; ?> </td>
            <td style='cursor:pointer; width: 05%;' >
            <?php
                if($row->mbStatus == 1){
                    echo " <span class='label label-sm label-success'> Ativo </span> ";
                }else{
                    echo " <span class='label label-sm label-danger'> Desativado </span> ";
                }
            ?>
            </td>
    </tr>
<?php

        $loContaItensFil++;    
    }
    
}

?>




