<?php


class Tarefas
{
    private $pdo;

    /*
     * Connection to the database
     */
    public function __construct(string $dbname, string $host , string $user, string $password)
    {
        try {
            $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$password);
        }catch (PDOException $e){
            echo ("Erro no banco de dados: ". $e->getMessage());
            exit();
        }
    }

    /*
     * Task Registration
     *
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
        }catch (PDOException $e){
            echo ("Erro no banco de dados: ". $e->getMessage());
            exit();
        }
    }

    /*
     * Upload tasks
     *
     * @return array
     */
    public function uploadTasks(): array
    {
        $cmd = $this->pdo->prepare("SELECT * FROM tarefas");
        $cmd->execute();
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }

    /*
     * Search task
     *
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

    public function editTask($id): array
    {
        $cmd = $this->pdo->prepare("SELECT * FROM tarefas WHERE cod = :id");
        $cmd->bindParam(":id", $id);
        $cmd->execute();
        return $cmd->fetch(PDO::FETCH_ASSOC);
    }

    public function updateTask(string $tarefa, string $descricao, string $prazo, string $id): bool
    {
        try {
            $cmd = $this->pdo->prepare("UPDATE tarefas SET tarefa = :tarefa, descricao = :descricao, data = :data WHERE cod = :id");;
            $cmd->bindParam(":tarefa", $tarefa);
            $cmd->bindParam(":descricao", $descricao);
            $cmd->bindParam(":data", $prazo);
            $cmd->bindParam(":id", $id);
            $cmd->execute();
            return true;
        }catch (PDOException $e){
            echo ("Erro no banco de dados: ". $e->getMessage());
            exit();
        }

    }
}