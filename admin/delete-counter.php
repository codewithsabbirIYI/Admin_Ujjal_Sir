<?php 
    require_once('functions/functions.php');

    // login check 
    needLogged();

    // role check
    if($_SESSION['role_id'] != 4){

        $id = $_GET['d'];
        

        $delete_query = "DELETE FROM `counters` WHERE `id` = '$id'";

        if(mysqli_query($con, $delete_query)){
            
            header('Location: all-counter.php');
            echo "Counter Delete Successfully";
        }
    }else{
        header('Location: index.php');   
    }
?>