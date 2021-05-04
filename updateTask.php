<?php
require_once './Classes/Tarefa.php';

$model = new Tarefa();
$id = $_POST['id'];

$model->getTask($id);

if (!$model) {
    die('Tarefa não encontrada');
}

$tarefa = $_POST['tarefa'];
$desc = $_POST['descricao'];
$prazo = $_POST['data'];

if($model->updateTask($id, $tarefa, $desc, $prazo)) {
    header('Location:/pesquisa.php?status=1');
} else {
    header('Location:/pesquisa.php?status=2');
}