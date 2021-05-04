<?php
require_once 'Classes/Tarefa.php';

if(isset($_POST['tarefa'])){
    $tarefa = $_POST['tarefa'];
    $desc = $_POST['descricao'];
    $prazo = $_POST['prazo'];

    $model = new Tarefa();

    if($model->registerTask($tarefa, $desc, $prazo)){
        header('Location:/cadastrar.php?status=1');
    }else{
        header('Location:/cadastrar.php?status=2');
    }
}