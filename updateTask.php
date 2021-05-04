<?php
require_once './Classes/Tarefas.php';

$model = new Tarefas();
$id = $_POST['id'];

$model->getTask($id);

if (!$model) {
    die('vaza do meu sistema');
}

$tarefa = $_POST['tarefa'];
$desc = $_POST['descricao'];
$prazo = $_POST['data'];

if($model->updateTask($id, $tarefa, $desc, $prazo)) {
    header('Location:/pesquisa.php?status=1');
} else {
    header('Location:/pesquisa.php?status=2');
}