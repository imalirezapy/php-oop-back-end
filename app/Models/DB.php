<?php

namespace App\Models;

class DB
{
    protected $pdo = null;

    protected $host = "localhost";

    protected $db = "test";

    protected $username = "root";

    protected $password = "";

    protected $table = null;

    protected $fields = null;

    protected $params = null;

    public $SQL = "";
    public function __construct()
    {

        $this->pdo = new \PDO("mysql:host={$this->host};dbname={$this->db}", $this->username, $this->password);
    }

    private function prepare($SQL, $data)
    {
        $this->convert($data);
        $stmt = $this->pdo->prepare($SQL);
        $stmt->execute($data);
        return $stmt;
    }
    protected function convert($data){
        $this->fields = join(",", array_keys($data));
        $this->params = join(",", array_map(fn($item)=> ":$item", array_keys($data)));
    }

    public function create($data)
    {
        $this->convert($data);
        $stmt = $this->prepare("insert into {$this->table} ({$this->fields}) value ({$this->params})", $data);
    }

    public function find($data)
    {
        $this->convert($data);
        $stmt = $this->prepare("select * from {$this->table} where {$this->fields} = {$this->params}", $data);
        return $stmt;

    }

    public function get()
    {
        $stmt = $this->pdo->prepare("select * from {$this->table} {$this->SQL}");
        $stmt->execute();
        return $stmt;
    }


}