<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <title>To Do List - Cadastrar Tarefa</title>
    </head>
    <body>
    <nav class="navbar navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Cadastrar Tarefa</a>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col">
                <?php
                if(isset($_GET['status'])) {
                    $message = $_GET['status'] == 1
                        ? 'Tarefa cadastrada com sucesso!'
                        : 'Houve um problema ao cadastrar a tarefa!';
                    echo '<div class="alert alert-info">'. $message .'</div>';
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form action="registerTask.php" method="post">
                    <div class="form-group">
                        <label for="tarefa">O que deve ser feito?</label>
                        <input type="text" class="form-control" name="tarefa" id="tarefa" required="">
                    </div>
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <input type="text" class="form-control" name="descricao" id="descricao" required="">
                    </div>
                    <div class="form-group">
                        <label for="prazo">Prazo</label>
                        <input type="date" class="form-control" name="prazo" id="prazo" required="">
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                    <a href="pesquisa.php" class="btn btn-secondary">Pesquisar Tarefas</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    </body>
</html>