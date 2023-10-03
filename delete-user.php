<?php 
    require_once('functions/functions.php');

    // login check 
    needLogged();

    $id = $_GET['d'];
    

    $delete_query = "DELETE FROM `users` WHERE `user_id` = '$id'";

    if(mysqli_query($con, $delete_query)){
        
        header('Location: all-user.php');
        echo "User Delete Successfully";
    }

?>