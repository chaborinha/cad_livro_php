<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Cadastro de Livros</h2>
    <form action="" method="post">
        <label for="titulo_livro">Título:</label>
            <input type="text" name="titulo_livro" id="titulo_livro">
            <br><br>
        <label for="cod_isbn">ISBN:</label>
            <input type="text" name="cod_isbn" id="cod_isbn">
            <br><br>
        <label for="autor_livro">Autor:</label>
            <input type="text" name="autor_livro" id="autor_livro">
            <br><br>
        <label for="nome_editora">Editora:</label>
            <input type="text" name="nome_editora" id="nome_editora">
            <br><br>
        <label for="qtd_paginas">Qtd. Páginas:</label>
            <input type="text" name="qtd_paginas" id="qtd_paginas">
            <br><br>
        <input type="submit" value="Incluir">
    </form>
    
</body>
</html>

<?php
require_once 'inicia.php';
/** COLETA AS INFORMAÇÕES DIGITADAS NO FORMULÁRIO FORM_INCLUI */

$titulo_livro = isset($_POST['titulo_livro']) ? $_POST['titulo_livro'] : null;
$cod_isbn = isset($_POST['cod_isbn']) ? $_POST['cod_isbn'] : null;
$autor_livro = isset($_POST['autor_livro']) ? $_POST['autor_livro'] : null;
$nome_editora = isset($_POST['nome_editora']) ? $_POST['nome_editora'] : null;
$qtd_paginas = isset($_POST['qtd_paginas']) ? $_POST['qtd_paginas'] : null;

/** VERIFICANDO SE O USUÁRIO PREENCHEU TODOS OS CAMPOS DO FORMULÁRIO */
if (empty($titulo_livro) || empty($cod_isbn) || empty($autor_livro) || empty($nome_editora) || empty($qtd_paginas))
{
    echo 'É preciso preencher todos os campos do formulário de cadastro!';
    exit;
}
/** INSERINDO AS INFORMAÇÕES NA TABELA LIVROS DO BANCO UA10 */
$PDO = conecta_bd();
$sql = "INSERT INTO
livros(titulo_livro,cod_isbn,autor_livro,nome_editora,qtd_paginas)
VALUES(:titulo_livro,:cod_isbn,:autor_livro,:nome_editora,:qtd_paginas)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':titulo_livro', $titulo_livro);
$stmt->bindParam(':cod_isbn', $cod_isbn);
$stmt->bindParam(':autor_livro', $autor_livro);
$stmt->bindParam(':nome_editora', $nome_editora);
$stmt->bindParam(':qtd_paginas', $qtd_paginas);

if ($stmt->execute()) {
    header('Location: index.php');
}
else{
    echo "Ocorreu um erro na inclusão de registro";
    print_r($stmt->errorInfo());
}
