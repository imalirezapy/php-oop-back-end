<?php
require_once "test.php";

//$Table = new Table("table-striped");


//add table header



//$Table->getResult();

$array = [
    ["id" => 1,
        "name"=>"alireza",
        "username"=>"imAlireza",
        "is_active"=>false],
    ["id" => 2,
        "name"=>"mohammad",
        "username"=>"mhm123",
        "is_active"=>true],
    ["id" => 3,
        "name"=>"sara",
        "username"=>"sara234",
        "is_active"=>false],
];

$table = new Table($array, "table-striped");
//$table->sort("food-name", "price", "");
$table->td("id")

    ->td("username")
    ->td("name")
    ->td("is_active");


$grid=$table->render();
/*class Users{
    public $table = null;

    public function __construct()
    {

    }

    public function getUsers(){
        $array = [
            ["id" => 1,
                "name"=>"alireza",
                "username"=>"imAlireza",
                "is_active"=>false],
            ["id" => 2,
                "name"=>"mohammad",
                "username"=>"mhm123",
                "is_active"=>true],
            ["id" => 3,
                "name"=>"sara",
                "username"=>"sara234",
                "is_active"=>false],
        ];
        return $array;
    }


    public function showUsers()
    {
        $this->table->thead();
        $this->table->tr()
            ->th("id", "col")
            ->th("name", "col")
            ->th("username", "col")
            ->th("is_active", "col");

        $this->table->tbody();

        foreach ($this->getUsers() as $user){
            $this->table->tr();
            foreach($user as $key=>$value){
                $this->table->td($value);
            }
        }


        $this->table->getResult();
    }
}

$users = new Users();
$users->showUsers();*/