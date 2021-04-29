<?php


class Tarefas
{
    private $pdo;

    /**
     * Tarefas constructor.
     */
    public function __construct()
    {
        $this->pdo = new PDO("mysql:dbname=todolist;host=localhost", "root", "");

    }


    /**
     * @param string $tarefa
     * @param string $descricao
     * @param string $prazo
     * @return bool
     */
    public function registerTask(string $tarefa, string $descricao, string $prazo): bool
    {
        try {
            $cmd = $this->pdo->prepare("INSERT INTO tarefas (tarefa, descricao, data) VALUES (:tarefa, :desc, :prazo)");
            $cmd->bindParam(":tarefa", $tarefa, PDO::PARAM_STR);
            $cmd->bindParam(":desc", $descricao, PDO::PARAM_STR);
            $cmd->bindParam(":prazo", $prazo, PDO::PARAM_STR);
            $cmd->execute();
            return true;
        } catch (PDOException $e) {
            echo("Erro no banco de dados: " . $e->getMessage());
            exit();
        }
    }

    /**
     * @return array
     */
    public function uploadTasks(): array
    {
        $cmd = $this->pdo->prepare("SELECT * FROM tarefas");
        $cmd->execute();
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param string $tarefa
     * @return array
     */
    public function searchTask(string $tarefa): array
    {
        $tarefa = "%" . $tarefa . "%";
        $cmd = $this->pdo->prepare("SELECT * FROM tarefas WHERE tarefa LIKE :tarefa ");
        $cmd->bindParam(":tarefa", $tarefa, PDO::PARAM_STR);
        $cmd->execute();
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $id
     * @return array
     */
    public function editTask($id): array
    {
        $cmd = $this->pdo->prepare("SELECT * FROM tarefas WHERE cod = :id");
        $cmd->bindParam(":id", $id, PDO::PARAM_STR);
        $cmd->execute();
        return $cmd->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @param string $tarefa
     * @param string $descricao
     * @param string $prazo
     * @param string $id
     * @return bool
     */
    public function updateTask(string $tarefa, string $descricao, string $prazo, string $id): bool
    {
        try {
            $cmd = $this->pdo->prepare("UPDATE tarefas SET tarefa = :tarefa, descricao = :descricao, data = :data WHERE cod = :id");;
            $cmd->bindParam(":tarefa", $tarefa, PDO::PARAM_STR);
            $cmd->bindParam(":descricao", $descricao, PDO::PARAM_STR);
            $cmd->bindParam(":data", $prazo, PDO::PARAM_STR);
            $cmd->bindParam(":id", $id, PDO::PARAM_STR);
            $cmd->execute();
            return true;
        } catch (PDOException $e) {
            echo("Erro no banco de dados: " . $e->getMessage());
            exit();
        }
    }

    /**
     * @param string $id
     * @return bool
     */
    public function deleteTask(string $id): bool
    {
        try {
            $cmd = $this->pdo->prepare("DELETE FROM tarefas WHERE cod = :id");;
            $cmd->bindParam(":id", $id, PDO::PARAM_STR);
            $cmd->execute();
            return true;
        } catch (PDOException $e) {
            echo("Erro no banco de dados: " . $e->getMessage());
            exit();
        }
    }
}