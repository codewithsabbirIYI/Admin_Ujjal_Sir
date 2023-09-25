<?php

    // config file load here 
   require_once('config.php');
   

//    header section find here 
    function get_header() {
        require_once('includes/header.php');
    }
    // sidebar serction find here 
    function get_sidebar() {
        require_once('includes/sidebar.php');
    }
    // footer section find here 
    function get_footer() {
        require_once('includes/footer.php');
    }

?>