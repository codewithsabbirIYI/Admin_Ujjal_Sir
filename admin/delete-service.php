<?php 
    require_once('functions/functions.php');

    // login check 
    needLogged();

    // role check
    if($_SESSION['role_id'] != 4){

        $id = $_GET['d'];
        

        $delete_query = "DELETE FROM `services` WHERE `id` = '$id'";

        if(mysqli_query($con, $delete_query)){
            
            header('Location: all-service.php');
            echo "service Delete Successfully";
        }
    }else{
        header('Location: index.php');   
    }
?>