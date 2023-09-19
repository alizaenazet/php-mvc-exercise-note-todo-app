<?php

class Todo{
    
    public $id;
    public $todo;
    public $isFinish = false;
    function __construct($todo) {
        $this->todo = $todo; 
    }
}