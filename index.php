<?php

    // function file load here 
    require_once('functions/functions.php');

    // header section load here 
    get_header();
    
    // sidebar section load here 
    get_sidebar();

?>
  

        <div class="row">
            <div class="col-md-12 breadcumb_part">
                <div class="bread">
                    <ul>
                        <li><a href=""><i class="fas fa-home"></i>Home</a></li>
                        <li><a href=""><i class="fas fa-angle-double-right"></i>Dashboard</a></li>                             
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 welcome_part">
                <p><span>Welcome Mr.</span> Saidul Islam Uzzal</p>
            </div>
        </div>
    </div>

<?php

   get_footer();

?>