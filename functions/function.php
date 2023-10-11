<?php

    // find config file find here 

    require_once('./config.php');
    
    // forntend header find here 
    function get_header(){
        require_once('include/header.php');
    }

    // forntend banner find here 
    function get_home_banner(){
        require_once('include/home_banner.php');
    }

    // forntend feature find here 
    function get_home_counter(){
        require_once('include/home_counter.php');
    }

    // forntend about find here 
    function get_home_about(){
        require_once('include/home_about.php');
    }

    // forntend service find here 
    function get_home_service(){
        require_once('include/home_service.php');
    }

    // forntend feature find here 
    function get_home_feature(){
        require_once('include/home_feature.php');
    }

    // forntend project find here 
    function get_home_project(){
        require_once('include/home_project.php');
    }

    // forntend project find here 
    function get_home_quote(){
        require_once('include/home_quote.php');
    }

    // forntend team find here 
    function get_home_team(){
        require_once('include/home_team.php');
    }

    // forntend testimonial find here 
    function get_home_testimonial(){
        require_once('include/home_testimonial.php');
    }

    // forntend team find here 
    function get_home_footer(){
        require_once('include/footer.php');
    }

    function get_page_header($page_header_title,  $page_header_breadcramp){

        require_once('include/page_header.php');
    }
?>