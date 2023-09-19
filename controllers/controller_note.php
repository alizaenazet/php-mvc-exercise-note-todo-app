<?php include('../models/model_note.php') ?>
<?php include('../models/model_todo.php') ?>
<?php
session_start();
if (!isset($_SESSION["notesData"])) {
    $_SESSION['notesData'] = array();
}

function createNote(){
    $newNote = new Note();
    $newNote->title = $_POST['inputTitle'];
    $newNote->description = $_POST['inputDescription'];
    array_push($_SESSION['notesData'],$newNote);
}
function editNote($index){
    $newNote =  $_SESSION['notesData'][$index];
    $newNote->title = $_POST['inputTitle'];
    $newNote->description = $_POST['inputDescription'];
    $_SESSION['notesData'][$index] = $newNote;
}

if (isset($_POST["addNote"])) {
   createNote();
   header("Location:../views/view_note.php");
}

function getNote($index) {
    return  $_SESSION['notesData'][$index];
}

function getAllNotes() {
    return $_SESSION['notesData'];
}

function deleteNote($id) {
   $tempNotes = $_SESSION['notesData'];
   unset($_SESSION['notesData'][$id]);
}

function addNoteTodo($todo,$noteIndex) {
    $newTodo = new Todo($todo);
    $_SESSION['notesData'][$noteIndex]->addTodo($newTodo);
}

function deleteNoteTodo($todoIndex,$noteIndex){
    $_SESSION['notesData'][$noteIndex]->removeTodo($todoIndex);
}

function reStatusNoteTodo($todoIndex,$noteIndex){
    $_SESSION['notesData'][$noteIndex]->reStatusTodo($todoIndex);
}

function setNoteContent($contentText,$noteIndex) {
    $_SESSION['notesData'][$noteIndex]->setContent($contentText);    
}


if (isset($_GET['deleteNote'])) {
    $noteIndex = $_GET['deleteNote'];
    deleteNote($noteIndex);
    header("Location:../views/view_note.php");
}
if (isset($_POST['editNote'])) {
    $noteIndex = $_POST['id'];
    editNote($noteIndex);
    header("Location:../views/view_note.php");
}


if (isset($_POST['addNoteTodo'])) {
    $newTodo = $_POST['newTodo'];
    $noteIndex =  $_POST['noteIDX'];   
    addNoteTodo($newTodo,$noteIndex);
    header("Location:../views/view_noteDetail.php?noteIdx=".$noteIndex);
}

if (isset($_GET['reStatusTodo']) && isset($_GET['noteIndx'])) {
    $todoIndex = $_GET['reStatusTodo'];
    $noteIndex = $_GET['noteIndx'];
    reStatusNoteTodo($todoIndex,$noteIndex);
    header("Location:../views/view_noteDetail.php?noteIdx=".$noteIndex);
}

if (isset($_GET['deleteTodo']) && isset($_GET['noteIndx'])) {
    $todoIndex = $_GET['deleteTodo'];
    $noteIndex = $_GET['noteIndx'];
    deleteNoteTodo($todoIndex,$noteIndex);
    header("Location:../views/view_noteDetail.php?noteIdx=".$noteIndex);
}

if (isset($_POST['saveNote'])) {
    $noteIndex = $_POST['noteIDX'];
    $content = $_POST['noteContent'];
    setNoteContent($content,$noteIndex);
    header("Location:../views/view_noteDetail.php?noteIdx=".$noteIndex);
}