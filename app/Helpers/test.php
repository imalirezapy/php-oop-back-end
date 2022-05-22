<?php

include "tamplates/header.php";



class Table{
    public $call = "";

    public $colms = [];

    public $default = ["<table class='table %s'>"];

    public $thead = ["\t<thead>", "\t<thead>"];

    public $tbody = ["\t<tbody>", "\t</tbody>"];

    public $head_tr = [];

    public $body_tr = [];

    public $filter = null;

    public function __construct(public $array, public $table_class ="")
    {
        $this->default[0] = sprintf($this->default[0], $table_class);
    }
    public function thead() {
        $this->call = "head_tr";
        return $this;

    }

    public function tbody(){
        $this->call = "body_tr";
        return $this;
    }

    public function tr(){
        array_push($this->{$this->call}, ...["\t\t<tr>", "\t\t</tr>"]);
        return $this;
    }


    public function th($str="", $class=""){
        array_splice($this->{$this->call}, -1, 0, ["\t\t\t<th scope='$class'>", "\t\t\t\t$str", "\t\t\t</th>"]);
        return $this;


    }


    public function td_($str, $class=""){
        array_splice($this->{$this->call}, -1, 0, ["\t\t\t<td class='$class'>", "\t\t\t\t$str", "\t\t\t</td>"]);
        return $this;

    }
    public function td($value, $func=null){
        array_push($this->colms, $value);
        if ($func) {
            array_push($this->filter, [$value, $func]);
        }
        return $this;
    }

    public function getResult()
    {
        array_splice($this->thead,-1, 0, $this->head_tr);
        array_splice($this->tbody,-1, 0, $this->body_tr);
        array_push($this->default, ...$this->thead, ...$this->tbody, ...["</table>"]);
        echo implode("\n", $this->default);
    }

    public function render(){
        $fa = include "lang/fa/attrebute.php";
        // header
        $this->thead();

        // header row
        $this->tr();
        foreach ($this->colms as $colm) {
            $this->th($fa[$colm], "col");
        }

        // body
        $this->tbody();

        // body rows
        foreach ($this->array as $user){
            $this->tr();
            foreach($this->colms as $colm){
                $this->td_($user[$colm]);
            }
        }

        $this->getResult();
        return $this;
    }


}


//include "tamplates/footer.php";
