<?php

if(isset($_GET['operator'])){
    if($_GET['operator'] == 'createTask') {
        include_once $_SERVER['DOCUMENT_ROOT'].'/models/tasks.php';

        $task = new Tasks();

        $result = $task->insert(['name' => $_POST['name'], 'email' => $_POST['email'], 'text' => $_POST['text'],]);

        header('Location: ../index.php');
    }

    if($_GET['operator'] == 'editTask') {
    	include_once $_SERVER['DOCUMENT_ROOT'].'/models/tasks.php';

        $task = new Tasks();
    	
    	$id = (int)$_POST['id'];
    	$_POST['id'] = $id;

        $result = $task->update($_POST);

        header('Location: ../index.php');
    }
}

?>
