<?php
require 'inicia.php';
/** ARMAZENA O CODIGO DO LIVRO A SER ALTERADO */
var_dump($_GET);
$cod_livro = isset($_GET['cod_livro']) ? (int) $_GET['cod_livro'] : null;
if (empty($cod_livro)) {
    echo "O código do livro para alteração não foi definido";
    exit;
}

/** BUSCA NA TABELA OS DADOS DO LIVRO QUE DEVERÁ SER ALTERADO */
$PDO = conecta_bd();
$stmt = $PDO->prepare("SELECT
cod_livro,titulo_livro,cod_isbn,autor_livro,nome_editora,qtd_paginas FROM
livros WHERE cod_livro = :cod_livro");
$stmt->bindParam(':cod_livro', $cod_livro, PDO::PARAM_INT);
$stmt->execute();
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
/** SE O FETCH ACIMA NÃO RETORNAR UM ARRAY PREENCHIDO, O CÓDICO DO LIVRO NÃO EXISTE NA TABELA */
if (!is_array($resultado)) {
    echo "Nenhum livro foi encontrado com o ID fornecido";
    exit;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Cadastro de Livros - Alteração</title>
  </head>
  <body>
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <h2 class="text-center">Cadastro de Livros - Alteração</h2>
          <form action="" method="post">
            <div class="mb-3">
              <label for="titulo_livro" class="form-label">Título:</label>
              <input type="text" class="form-control" name="titulo_livro" id="titulo_livro" value="<?php echo htmlspecialchars($resultado['titulo_livro']); ?>">
            </div>
            <div class="mb-3">
              <label for="cod_isbn" class="form-label">ISBN:</label>
              <input type="text" class="form-control" name="cod_isbn" id="cod_isbn" value="<?php echo htmlspecialchars($resultado['cod_isbn']); ?>">
            </div>
            <div class="mb-3">
              <label for="autor_livro" class="form-label">Autor:</label>
              <input type="text" class="form-control" name="autor_livro" id="autor_livro" value="<?php echo htmlspecialchars($resultado['autor_livro']); ?>">
            </div>
            <div class="mb-3">
              <label for="nome_editora" class="form-label">Editora:</label>
              <input type="text" class="form-control" name="nome_editora" id="nome_editora" value="<?php echo htmlspecialchars($resultado['nome_editora']); ?>">
            </div>
            <div class="mb-3">
              <label for="qtd_paginas" class="form-label">Qtd. Páginas:</label>
              <input type="text" class="form-control" name="qtd_paginas" id="qtd_paginas" value="<?php echo htmlspecialchars($resultado['qtd_paginas']); ?>">
            </div>
            <input type="hidden" name="cod_livro" id="cod_livro" value="<?= $cod_livro ?>">
            <div class="d-grid">
              <button type="submit" class="btn btn-primary">Alterar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>
<?php

/** COLETANDO AS INFORMAÇÕES DIGITADAS NO FORMULÁRIO */
$cod_livro = isset($_POST['cod_livro']) ? $_POST['cod_livro'] : null;
$titulo_livro = isset($_POST['titulo_livro']) ? $_POST['titulo_livro'] : null;
$cod_isbn = isset($_POST['cod_isbn']) ? $_POST['cod_isbn'] : null;
$autor_livro = isset($_POST['autor_livro']) ? $_POST['autor_livro'] : null;
$nome_editora = isset($_POST['nome_editora']) ? $_POST['nome_editora'] : null;
$qtd_paginas = isset($_POST['qtd_paginas']) ? $_POST['qtd_paginas'] : null;

/** VERIFICANDO SE TODOS OS CAMPOS DO FORMULÁRIO ESTÃO PREENCHIDOS */
if (empty($titulo_livro) || empty($cod_isbn) || empty($autor_livro)
        || empty($nome_editora) || empty($qtd_paginas)) {
    echo "É preciso preencher todos os campos do formulário de cadastro!";
    exit;
    }

/** ALTERA AS INFORMAÇÕES NA TABELA DE LIVROS DO BANCO DE DADOS UA10 */
$PDO = conecta_bd();
$stmt = $PDO->prepare("UPDATE livros SET
titulo_livro=:titulo_livro,cod_isbn=:cod_isbn,autor_livro=:autor_livro,nome_editora=:nome_editora,qtd_paginas=:qtd_paginas
WHERE cod_livro=:cod_livro");
$stmt->bindParam(':cod_livro', $cod_livro, PDO::PARAM_INT);
$stmt->bindParam(':titulo_livro', $titulo_livro);
$stmt->bindParam(':cod_isbn', $cod_isbn);
$stmt->bindParam(':autor_livro', $autor_livro);
$stmt->bindParam(':nome_editora', $nome_editora);
$stmt->bindParam(':qtd_paginas', $qtd_paginas);

if ($stmt->execute()) {
    header('Location: index.php');
}
else{
    echo 'Ocorreu um erro na alteração do livro';
    print_r($stmt->errorInfo());
}