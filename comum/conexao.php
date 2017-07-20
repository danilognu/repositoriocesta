<?php

$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];

include("constantes.php");

Class Conexao{

    public function IniciaConexao(){   

        $constantes = new constantes(); 

       try {
            $hostname = $constantes->host_banco;
            $dbname = $constantes->nome_banco;
            $username = $constantes->usuario_banco;
            $pw = $constantes->senha_banco;
            $pdo = new PDO ("mysql:host=".$hostname.";dbname=".$dbname."", $username, $pw); 
        } catch (PDOException $e) {
            echo "Erro de Conexão " . $e->getMessage() . "\n";
            exit;
        }

        return $pdo;

    }

}

?>
