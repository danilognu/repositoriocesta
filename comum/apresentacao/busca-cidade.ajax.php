<?php
include("../comum.php");

$loIdEstado = $_REQUEST["id_estado"];
$loIdCidade = $_REQUEST["id_cidade"];

$loListaCidade = new comumBO();
$loLista = $loListaCidade->ListaCidade($loIdEstado,$loIdCidade);

$loCidades = null;
foreach ($loLista as $row){

    if($loIdCidade == $row->mbIdCidade)
        $loSelected = "selected";
    else 
        $loSelected = "";
    $loCidades .= "<option value=".$row->mbIdCidade." ".$loSelected." >".utf8_decode($row->mbNome)."</option>" ;      

}   

echo $loCidades;

?>