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
      $banner_title=$_POST['banner_title'];
      $banner_subtitle=$_POST['banner_subtitle'];
      $banner_text=$_POST['banner_text'];
      $button_link=$_POST['button_link'];
      $button_text=$_POST['button_text'];
      
      $banner_image= $_FILES['banner_image'];

   
      // user image custome name set from here 
      if($banner_image['name']!=''){
      $imageCustomeName='banner_'.time().'_'.rand(10000,1000000).'.'.pathinfo($banner_image['name'],PATHINFO_EXTENSION);
      }
  
    // empty validation here 
    if(!empty($banner_title)){
      if(!empty($banner_subtitle)){
        if(!empty($banner_text)){
          if(!empty($button_link)){
            if(!empty($button_text)){
              if(!empty($banner_image['name'])){
                     
                  // insert query here 
                  $insert="INSERT INTO banners(banner_title,banner_subtitle,banner_text,button_link,button_text,banner_image)
                  VALUES('$banner_title','$banner_subtitle','$banner_text','$button_link','$button_text','$imageCustomeName')";

                  // insert query run or data insert here 
                  if(mysqli_query($con,$insert)){

                    move_uploaded_file($banner_image['tmp_name'],'uploads/'.$imageCustomeName);

                    header('Location: all-banner.php');
                    $_SESSION['success'] = "Banner Insert successful";
                  }else{
                    $_SESSION['success'] = "Ops! Banner Insert failed";
                  }
                 
                }else{
                  $banner_image_error = "Please Select Banner Image";
                }
              }else{
                $button_text_error = "Please enter Button Text";
              }
            }else{
              $banner_link_error = "Please enter Banner Link";
            }
      
          }else{
            $banner_text_error = "Please enter Banner Text";
          }
      
        }else{
          $banner_subtitle_error = "Please enter Banner Subtile";
        }

      }else{
        $banner_title_error = "Please Enter Banner Title";
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
                              <i class="fab fa-gg-circle"></i>Add Banners
                          </div>  
                          <div class="col-md-4 card_button_part">
                              <a href="all-banner.php" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>All Banners</a>
                          </div>  
                      </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">Banner Title:<span class="req_star">*</span>:</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control <?php if (isset($banner_title_error)) echo 'is-invalid' ?>" id="" name="banner_title" value = "<?= (isset($_SESSION['old_banner_title'])) ? $_SESSION['old_banner_title']:"" ?>">
                            <?php
                            if (isset($banner_title_error)) {
                            ?>
                              <span class="text-danger"></span><?= $banner_title_error; ?></span>
                            <?php
                            }
                            ?>
                    
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">Banner Subtitle:</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control <?php if (isset($banner_subtitle_error)) echo 'is-invalid' ?>" id="" name="banner_subtitle"  value = "<?= (isset($_SESSION['old_banner_subtitle'])) ? $_SESSION['old_banner_subtitle']:"" ?>">
                            <?php
                            if (isset($banner_subtitle_error)) {
                            ?>
                              <span class="text-danger"></span><?= $banner_subtitle_error; ?></span>
                            <?php
                            }
                            ?>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">Banner Text:</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control <?php if (isset($banner_text_error)) echo 'is-invalid' ?>" id="" name="banner_text" value = "<?= (isset($_SESSION['old_banner_text'])) ? $_SESSION['old_banner_text']:"" ?>">
                            <?php
                            if (isset($banner_text_error)) {
                            ?>
                              <span class="text-danger"></span><?= $banner_text_error; ?></span>
                            <?php
                            }
                            ?>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">Button link:</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control <?php if (isset($banner_link_error)) echo 'is-invalid' ?>" id="" name="button_link" value = "<?= (isset($_SESSION['old_button_link'])) ? $_SESSION['old_button_link']:"" ?>">
                            <?php
                            if (isset($banner_link_error)) {
                            ?>
                              <span class="text-danger"></span><?= $banner_link_error; ?></span>
                            <?php
                            }
                            ?>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">Button Text:</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control <?php if (isset($banner_text_error)) echo 'is-invalid' ?>" id="" name="button_text" value = "<?= (isset($_SESSION['old_button_text'])) ? $_SESSION['old_button_text']:"" ?>">
                            <?php
                            if (isset($banner_text_error)) {
                            ?>
                              <span class="text-danger"></span><?= $banner_text_error; ?></span>
                            <?php
                            }
                            ?>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">Banner Photo:</label>
                          <div class="col-sm-4">
                            <input type="file" class="form-control <?php if (isset($banner_image_error)) echo 'is-invalid' ?>" id="" name="banner_image">
                            <?php
                            if (isset($banner_image_error)) {
                            ?>
                              <span class="text-danger"></span><?= $banner_image_error; ?></span>
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
  unset($_SESSION['old_banner_title']);
  unset($_SESSION['old_banner_subtitle']);
  unset($_SESSION['old_banner_text']);
  unset($_SESSION['old_button_link']);
  unset($_SESSION['old_button_text']);

?>