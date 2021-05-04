<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>To Do List - Pesquisar tarefa</title>
</head>
<body>
    <div class="row">
        <div class="col">
            <nav class="navbar navbar-light bg-light">
                <a class="navbar-brand">Pesquisar tarefas</a>
                <form class="form-inline" action="pesquisa.php" method="post">
                    <input class="form-control mr-sm-2" type="search" placeholder="Estudar" aria-label="Search"
                           name="pesquisa">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
                </form>
            </nav>
        </div>
    </div>
    <div class="container-fluid">
    <div class="row">
        <div class="col">
        <?php
            if(isset($_GET['status'])) {
                $message = $_GET['status'] == 1 
                        ? 'Ação realizada com sucesso!'
                        : 'Houve um problema ao realizar a ação!';
                echo '<div class="alert alert-info">'. $message .'</div>';
            }
        ?>
        </div>
    </div>
        <div class="row">
            <?php
            require_once 'Classes/Tarefa.php';
            require_once 'helpers.php';

            $model = new Tarefa();
            $tasks = $model->getTasks();

            if (isset($_POST['pesquisa'])) {
                $pesquisa = $_POST['pesquisa'];
                $tasks = $model->searchTask($pesquisa);
            }
            if (count($tasks)) {
                foreach ($tasks as $task) {
                    $task['data'] = convertDate($task['data']);
                    echo "<div class='col-sm-4'>
                            <div class='card'>
                                <div class='card-body'>
                                    <h5 class='card-title'>". $task['tarefa'] ."</h5>
                                    <p class='card-text'>". $task['descricao'] ."</p>
                                    <p class='card-text'>". $task['data'] ."</p>
                                    <a href='editar.php?id=". $task['id'] ."' class='btn btn-success btn-sm'>Editar</a>               
                                    <a href='#' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#confirma' onclick=" . '"' . "get_dados({$task['id']},'{$task['tarefa']}')" . '"' . ">Excluir</a>
                                </div>
                            </div>
                    </div>";
                }
            }
            ?>
        </div>
        <div class="modal" tabindex="-1" id="confirma">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Excluir Tarefa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="deleteTask.php" method="post">
                        <div class="modal-body">
                            <p>Você deseja excluir a tarefa: <strong id="nome_tarefa">nome da tarefa</strong>?
                            </p>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-success" value="Confirmar">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <input type="hidden" id="tarefa_id" name="id" value="">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function get_dados(id, tarefa){
            document.getElementById('nome_tarefa').innerHTML = tarefa;
            document.getElementById('tarefa_id').value = id;
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    </body>
</html>