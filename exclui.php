<?php

require_once 'inicia.php';
/** ARMAZENANDO CODIGO DO LIVRO A SER DELETADO */
$cod_livro = isset($_GET['cod_livro']) ? $_GET['cod_livro'] : null;
/** VERIFICAR SE O CODICO DO LIVRO EXISTE */
if (empty($cod_livro)) {
    echo 'O codico do livro para exclusão não foi definido!';
    exit;
}
/** FAZENDO EXCLUSAO DO REGISTRO DA TABELA LIVROS */
$PDO = conecta_bd();
$sql = "DELETE FROM livros WHERE cod_livro=:cod_livro";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':cod_livro', $cod_livro, PDO::PARAM_INT);
if ($stmt->execute()) {
    header('Location: index.php');
}
else{
    echo 'Ocorreu um erro ao deletar livro';
    print_r($stmt->errorInfo());
}