<?php

class Note{
    public $id;
    public $title;
    public $description;
    public $content;
    public $todoList = array();

    function addTodo($todo) {
        array_push($this->todoList,$todo);
    }

    function reStatusTodo($todoIndex) {
        $currentTodoStatus = $this->todoList[$todoIndex]->isFinish;
        $this->todoList[$todoIndex]->isFinish = (!$currentTodoStatus);
    }

    function removeTodo($todoIndex) {
        unset($this->todoList[$todoIndex]);
    }

    function setContent($valueOfContent){
        $this->content = $valueOfContent;
    }

}

