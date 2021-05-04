<?php
require_once 'Classes/Tarefa.php';

$model = new Tarefa();
$id = $_POST['id'];

if($model->deleteTask($id)){
    header('Location:/pesquisa.php?status=1');
}else{
    header('Location:/pesquisa.php?status=2');
}