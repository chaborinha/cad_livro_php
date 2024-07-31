<?php 
require_once 'inicia.php';
$PDO = conecta_bd();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <h1>Cadastro de Livros</h1>
    <p><a href="form_inclui.php">Adicionar livro</a></p>
    <h2>Lista de livros cadastrados</h2>
    <?php 
       $stmt_count = $PDO->prepare("SELECT COUNT(*) AS total FROM livros");
       $stmt_count->execute();
       $stmt = $PDO->prepare("SELECT 
       cod_livro,titulo_livro,cod_isbn,autor_livro,nome_editora,qtd_paginas FROM
       livros ORDER BY titulo_livro");
       $stmt->execute();
       $total = $stmt_count->fetchColumn();
       if ($total > 0): ?>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Título</th>
                <th>ISBN</th>
                <th>Autor</th>
                <th>Editora</th>
                <th>Qtd. Páginas</th>
                <th>Opções para o livro</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($stmt as $row): ?>
             <tr>
                <td><?=  htmlspecialchars($row['titulo_livro']); ?></td>
                <td><?=  htmlspecialchars($row['cod_isbn']); ?></td>
                <td><?=  htmlspecialchars($row['autor_livro']); ?></td>
                <td><?=  htmlspecialchars($row['nome_editora']); ?></td>
                <td><?=  htmlspecialchars($row['qtd_paginas']); ?></td>
                <td>
                    <a href="form_altera.php?cod_livro=<?= $row['cod_livro']?>">Alterar</a>
                    |
                    <a href="exclui.php?cod_livro=<?= $row['cod_livro'];?>" onclick="return confirm('Tem certeza de que deseja excluir o registro?');">Excluir</a>
                </td>
             </tr> 
             <?php endforeach; ?>  

        </tbody>
    </table>
    <?php echo "<p> Total de livros cadastrados: $total </p>" ?>
    <?php else: ?>
        <p>Nenhum livro encontrado!</p>
    <?php endif; ?>
    </form>
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