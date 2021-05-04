<?php


class Tarefas
{
    private $pdo;

    /**
     * Tarefas constructor.
     */
    public function __construct()
    {
        
        try {
            $config = require('config.php');
            $this->pdo = new PDO("mysql:dbname=" . $config['database']. ";host=" . $config['host'],$config['username'] , $config['password']);
        } catch(PDOException $e) {
            die('Conexão recusada. ' . $e->getMessage());
        }
        
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
    public function getTasks(): array
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
    public function getTask($id): array
    {
        $cmd = $this->pdo->prepare("SELECT * FROM tarefas WHERE id = :id");
        $cmd->bindParam(":id", $id, PDO::PARAM_INT);
        $cmd->execute();
        return $cmd->fetch(PDO::FETCH_ASSOC) ?? [];
    }

    /**
     * @param string $tarefa
     * @param string $descricao
     * @param string $prazo
     * @param int $id
     * @return bool
     */
    public function updateTask(int $id, string $tarefa, string $descricao, string $prazo): bool
    {
        try {
            $cmd = $this->pdo->prepare("UPDATE tarefas SET tarefa = :tarefa, descricao = :descricao, data = :data WHERE id = :id");;
            $cmd->bindParam(":tarefa", $tarefa, PDO::PARAM_STR);
            $cmd->bindParam(":descricao", $descricao, PDO::PARAM_STR);
            $cmd->bindParam(":data", $prazo, PDO::PARAM_STR);
            $cmd->bindParam(":id", $id, PDO::PARAM_INT);
            $cmd->execute();
            return true;
        } catch (PDOException $e) {
            echo("Erro no banco de dados: " . $e->getMessage());
            return false;
        }
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteTask(int $id): bool
    {
        try {
            $cmd = $this->pdo->prepare("DELETE FROM tarefas WHERE id = :id");;
            $cmd->bindParam(":id", $id, PDO::PARAM_INT);
            $cmd->execute();
            return true;
        } catch (PDOException $e) {
            echo("Erro no banco de dados: " . $e->getMessage());
            exit();
        }
    }
}



