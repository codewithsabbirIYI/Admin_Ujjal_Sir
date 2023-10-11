<?php
    
    require_once('functions/functions.php');

    // login check 
    needLogged();

    // role check
    if($_SESSION['role_id'] != 4){


    get_header();
    get_sidebar();


    // store data in variable from form 
    if(!empty($_POST)){
      $service_title=$_POST['service_title'];
      $service_text=$_POST['service_text'];
      $button_link=$_POST['button_link'];
      $button_text=$_POST['button_text'];
      
      $service_image= $_FILES['service_image'];
      $service_image= $_FILES['service_icon'];

   
      // user image custome name set from here 
      if($service_image['name']!=''){
      $imageCustomeName='service_'.time().'_'.rand(10000,1000000).'.'.pathinfo($service_image['name'],PATHINFO_EXTENSION);
      }
  
    // empty validation here 
    if(!empty($service_title)){
      if(!empty($service_icon)){
        if(!empty($service_text)){
          if(!empty($button_link)){
            if(!empty($button_text)){
              if(!empty($service_image['name'])){
                     
                  // insert query here 
                  $insert="INSERT INTO services(service_title,service_icon,service_text,button_link,button_text,service_image)
                  VALUES('$service_title','$service_icon','$service_text','$button_link','$button_text','$imageCustomeName')";

                  // insert query run or data insert here 
                  if(mysqli_query($con,$insert)){

                    move_uploaded_file($service_image['tmp_name'],'uploads/'.$imageCustomeName);

                    header('Location: all-service.php');
                    $_SESSION['success'] = "service Insert successful";
                  }else{
                    $_SESSION['success'] = "Ops! service Insert failed";
                  }
                 
                }else{
                  $service_image_error = "Please Select service Image";
                }
              }else{
                $button_text_error = "Please enter Button Text";
              }
            }else{
              $service_link_error = "Please enter service Link";
            }
      
          }else{
            $service_text_error = "Please enter service Text";
          }
      
        }else{
          $service_icon_error = "Please enter service Icon";
        }

      }else{
        $service_title_error = "Please Enter service Title";
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
                              <i class="fab fa-gg-circle"></i>Add services
                          </div>  
                          <div class="col-md-4 card_button_part">
                              <a href="all-service.php" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>All services</a>
                          </div>  
                      </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">service Title:<span class="req_star">*</span>:</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control <?php if (isset($service_title_error)) echo 'is-invalid' ?>" id="" name="service_title" value = "<?= (isset($_SESSION['old_service_title'])) ? $_SESSION['old_service_title']:"" ?>">
                            <?php
                            if (isset($service_title_error)) {
                            ?>
                              <span class="text-danger"></span><?= $service_title_error; ?></span>
                            <?php
                            }
                            ?>
                    
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">service Text:</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control <?php if (isset($service_text_error)) echo 'is-invalid' ?>" id="" name="service_text" value = "<?= (isset($_SESSION['old_service_text'])) ? $_SESSION['old_service_text']:"" ?>">
                            <?php
                            if (isset($service_text_error)) {
                            ?>
                              <span class="text-danger"></span><?= $service_text_error; ?></span>
                            <?php
                            }
                            ?>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">Button link:</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control <?php if (isset($service_link_error)) echo 'is-invalid' ?>" id="" name="button_link" value = "<?= (isset($_SESSION['old_button_link'])) ? $_SESSION['old_button_link']:"" ?>">
                            <?php
                            if (isset($service_link_error)) {
                            ?>
                              <span class="text-danger"></span><?= $service_link_error; ?></span>
                            <?php
                            }
                            ?>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">Button Text:</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control <?php if (isset($service_text_error)) echo 'is-invalid' ?>" id="" name="button_text" value = "<?= (isset($_SESSION['old_button_text'])) ? $_SESSION['old_button_text']:"" ?>">
                            <?php
                            if (isset($service_text_error)) {
                            ?>
                              <span class="text-danger"></span><?= $service_text_error; ?></span>
                            <?php
                            }
                            ?>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">Service Icon:</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control <?php if (isset($service_icon_error)) echo 'is-invalid' ?>" id="" name="service_icon"  value = "<?= (isset($_SESSION['old_service_icon'])) ? $_SESSION['old_service_icon']:"" ?>">
                            <?php
                            if (isset($service_icon_error)) {
                            ?>
                              <span class="text-danger"></span><?= $service_icon_error; ?></span>
                            <?php
                            }
                            ?>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">service Photo:</label>
                          <div class="col-sm-4">
                            <input type="file" class="form-control <?php if (isset($service_image_error)) echo 'is-invalid' ?>" id="" name="service_image">
                            <?php
                            if (isset($service_image_error)) {
                            ?>
                              <span class="text-danger"></span><?= $service_image_error; ?></span>
                            <?php
                            }
                            ?>
                          </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                      <button type="submit" class="btn btn-sm btn-dark">Save</button>
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


  // input field session distroy here 
  unset($_SESSION['old_service_title']);
  unset($_SESSION['old_service_subtitle']);
  unset($_SESSION['old_service_text']);
  unset($_SESSION['old_button_link']);
  unset($_SESSION['old_button_text']);

?>