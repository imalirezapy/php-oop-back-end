<?php

namespace App\Models;


class DB
{
    private $config = null;

    protected $pdo = null;

    protected $table = null;

    protected $fields = null;

    protected $params = null;

    public $SQL = "";
    public function __construct()
    {

        $config= include($_SERVER['DOCUMENT_ROOT'] . '/test/Config.php');
        $this->config = $config;
        $stmt = (new \PDO("mysql:host={$config['host']};port={$config['port']}", $config['username'], $config['password']))->prepare("CREATE DATABASE IF NOT EXISTS {$config['dbname']} COLLATE utf8mb4_persian_ci");
        $stmt->execute();

        $this->pdo = new \PDO("mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}", $config['username'], $config['password']);

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

    public function update($data){
        $params = array_map(fn($item, $field) => "$item='$field'", array_keys($data), array_values($data));
        $params = join(", ", array_slice($params, 1));

        $stmt = $this->pdo->prepare("update {$this->table} set {$params} where id = {$data['id']}");
        $stmt->execute();
        return $stmt;
    }

    public function delete($data)
    {
        $key = array_keys($data)[0];
        $value = $data[$key];
        $stmt = $this->pdo->prepare("delete from {$this->table} where {$key} = {$value}");
        $stmt->execute();
    }

    public function creatTable($name, $sql)
    {

        $stmt = $this->pdo->prepare("CREATE table IF NOT EXISTS {$name} (id INT( 11 ) AUTO_INCREMENT PRIMARY KEY, " . $sql . " )");
        $stmt->execute();

    }

}

