<?php
    
    require_once('functions/functions.php');

    // login check 
    needLogged();

    // role check
    if($_SESSION['role_id'] != 4){


    get_header();
    get_sidebar();
    
    // find old counter data 
    $id = $_GET['e'];
    $sel = "SELECT * FROM counters WHERE id = '$id'";
    $datas = mysqli_query($con, $sel);
    $data = mysqli_fetch_assoc($datas);

    // store data in variable from form 
    if(!empty($_POST)){
      $counter_icon=$_POST['counter_icon'];
      $counter_number=$_POST['counter_number'];
      $counter_title=$_POST['counter_title'];
      $counter_text=$_POST['counter_text'];
      
  
    // empty validation here 
    if(!empty($counter_icon)){
    
      if(!empty($counter_number)){
      
        if(!empty($counter_title)){
         

          if(!empty($counter_text)){
          
                // insert query here 
                $update="UPDATE `counters` SET `counter_icon`='$counter_icon',`counter_number`='$counter_number',`counter_title`='$counter_title',`counter_text`='$counter_text' WHERE id ='$id'";

                // insert query run or data insert here 
                if(mysqli_query($con,$update)){

                header('Location: all-counter.php');
                echo "counter Update successful";
                }else{
                echo "Ops! counter Update failed";
                }
                 
              
            }else{
              $counter_text_error = "Please input Counter text";
            }
      
          }else{
            $counter_title_error = "Please input Counter number";
          }
      
        }else{
          $counter_number_error = "Please input Counter number";
        }

      }else{
        $counter_icon_error = "Please input Counter Icon Class";
      }

    }

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
          <div class="col-md-12 ">
              <form method="post" action="" enctype="multipart/form-data">
                  <div class="card mb-3">
                    <div class="card-header">
                      <div class="row">
                          <div class="col-md-8 card_title_part">
                              <i class="fab fa-gg-circle"></i>Add counters
                          </div>  
                          <div class="col-md-4 card_button_part">
                              <a href="all-counter.php" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>All counters</a>
                          </div>  
                      </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">Counter Icon:<span class="req_star">*</span>:</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control form_control" id="" name="counter_icon" value = "<?= isset($_POST['counter_icon']) ? $_POST['counter_icon'] : $data['counter_icon']; ?>">   

                     
                            <?php 
                                if(isset($counter_icon_error)){
                            ?>
                                    <span class="text-danger"></span><?= $counter_icon_error ;?></span>
                            <?php
                                }
                            ?>              
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">Counter Number:</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control form_control" id="" name="counter_number"  value = "<?= isset($_POST['counter_number']) ? $_POST['counter_number'] : $data['counter_number']; ?>">
                            <?php 
                                if(isset($counter_number_error)){
                            ?>
                                    <span class="text-danger"></span><?= $counter_number_error ;?></span>
                            <?php
                                }
                            ?>   
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">Counter Title:</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control form_control" id="" name="counter_title" value = "<?= isset($_POST['counter_title']) ? $_POST['counter_title'] : $data['counter_title']; ?>">
                            <?php 
                                if(isset($counter_title_error)){
                            ?>
                                    <span class="text-danger"></span><?= $counter_title_error ;?></span>
                            <?php
                                }
                            ?>   
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">Counter Text:</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control form_control" id="" name="counter_text" value = "<?= isset($_POST['counter_text']) ? $_POST['counter_text'] : $data['counter_text']; ?>">
                            <?php 
                                if(isset($counter_text_error)){
                            ?>
                                    <span class="text-danger"></span><?= $counter_text_error ;?></span>
                            <?php
                                }
                            ?>  
                          </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                      <button type="submit" class="btn btn-sm btn-dark">Update</button>
                    </div>  
                  </div>
              </form>
          </div>
      </div>
  </div>

<?php

get_footer();
}else{
header('Location: index.php');
}

?>