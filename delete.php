<?php
    require_once './db/dbConn.php';
    require_once './helpers/functions.php';

    $id = $_GET['id']?? NULL;
    $errors = [];
    if (!validate($id, 'intVal')) {
        $errors['id'] = 'invalid id';
    }
    var_dump($id);
    if (count($errors) == 1) {
        $_SESSION['message'] = $errors['id'];
    }else{

        $sql = "DELETE FROM tasks WHERE id = $id";
        $op = mysqli_query($conn, $sql);
        if ($op) {
            $_SESSION['message'] = 'task is deleted !';
        }
        else{

            $_SESSION['message'] = 'error, try again !';
        }
        header('location: index.php');
    }

?>