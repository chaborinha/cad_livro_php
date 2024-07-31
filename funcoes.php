<?php
/** O CÓDIGO ABAIXO FAZ A CONEXÃO COM O MYSQL ATRAVÉS DE PDO **/

function conecta_bd() {
    try {
        $PDO = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $PDO;
    } catch (PDOException $e) {
        echo 'Erro na conexão: ' . $e->getMessage();
        exit;
    }
}
?>
