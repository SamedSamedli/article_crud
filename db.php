<?php

class Database
{
    private $dsn = "mysql:host=localhost; dbname=article_crud";
    private $user = "root";
    private $pass = "";
    public $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO($this->dsn, $this->user, $this->pass);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function insert($title, $description, $status)
    {
        $sql = "INSERT INTO articles (title, description, status) VALUES (:title, :description, :status)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['title' => $title, 'description' => $description, 'status' => $status]);

        return true;
    }

    public function read()
    {
        $data = array();
        $sql = "SELECT * FROM articles";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $data[] = $row;
        }
        return $data;
    }

    public function getArticleByID($id)
    {
        $sql = "SELECT * FROM articles WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function update($id, $title, $description, $status)
    {
        $sql = "UPDATE articles SET title = :title, description = :description, status = :status";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['title' => $title, 'description' => $description, 'status' => $status, 'id' => $id]);
        return true;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM articles WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return true;
    }

    public function totalRowCount()
    {
        $sql = "SELECT * FROM articles";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $t_rows = $stmt->rowCount();
        return $t_rows;
    }
}

$ob = new Database();
echo $ob->totalRowCount();
