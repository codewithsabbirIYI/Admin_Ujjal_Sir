<?php
    
    require_once('functions/functions.php');

    // login check 
    needLogged();

    // role check
    if($_SESSION['role_id'] != 4){


    get_header();
    get_sidebar();

      // find about data here 
      $id = $_GET['e'];
      $sel = "SELECT * FROM about WHERE id = '$id'";
      $datas = mysqli_query($con, $sel);
      $data = mysqli_fetch_assoc($datas);



    // store data in variable from form 
    if(!empty($_POST)){
      $about_title=$_POST['about_title'];
      $about_text=$_POST['about_text'];
      $button_link=$_POST['button_link'];
      $button_text=$_POST['button_text'];
      
      $about_home_image= $_FILES['about_home_image'];
      $about_pase_image= $_FILES['about_pase_image'];


    // empty validation here     
    if(!empty($about_title)){
     
        if(!empty($about_text)){
          if(!empty($button_link)){
            if(!empty($button_text)){

                // check image is given for update 
                if(!empty($about_home_image['name'])){

                  $home_imageCustomeName='about_home'.time().'_'.rand(10000,1000000).'.'.pathinfo($about_home_image['name'],PATHINFO_EXTENSION);
                  $pase_imageCustomeName='about_pase'.time().'_'.rand(10000,1000000).'.'.pathinfo($about_pase_image['name'],PATHINFO_EXTENSION);
                  // image update query here 

                  $update="UPDATE `about` SET `about_title`='$about_title',`about_text`='$about_text',`button_link`='$button_link',`button_text`=' $button_text', `about_home_image` = '$home_imageCustomeName', `about_pase_image` = '$pase_imageCustomeName' WHERE id ='$id'";

                  // insert query run or data insert here 
                  if(mysqli_query($con,$update)){
                    
                    move_uploaded_file($about_home_image['tmp_name'],'uploads/'.$home_imageCustomeName);
                    move_uploaded_file($about_pase_image['tmp_name'],'uploads/'.$pase_imageCustomeName);
                  
                    header('Location: all-about.php');
                    $_SESSION['success'] = "about Insert successful";
                    
                  }else{
                    $_SESSION['error'] = "Ops! about Insert failed";
                  }
                 
                }else{

                    $update="UPDATE `about` SET `about_title`='$about_title',`about_text`='$about_text',`button_link`='$button_link',`button_text`='$button_text' WHERE id ='$id'";

                  if(mysqli_query($con, $update)){


                    header('Location: all-about.php');
                    echo$_SESSION['success'] = "about update without image successfully";
  
                  }else{
                    $_SESSION['error'] = "about update faild";
                  }
                }

              }else{
                $button_text_error = "Please enter Button Text";
              }
            }else{
              $about_link_error = "Please enter about Link";
            }
      
          }else{
            $about_text_error = "Please enter about Text";
          }
      
      }else{
        $about_title_error = "Please Enter about Title";
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
                              <i class="fab fa-gg-circle"></i>Edit about
                          </div>  
                          <div class="col-md-4 card_button_part">
                              <a href="all-about.php" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>All about</a>
                          </div>  
                      </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">about Title:<span class="req_star">*</span>:</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control form_control" id="" name="about_title" value = "<?= (isset($_POST['about_title'])) ? $_POST['about_title'] : $data['about_title']?>">
                            
                            <?php
                            if (isset($about_title_error)) {
                            ?>
                              <span class="text-danger"></span><?= $about_title_error; ?></span>
                            <?php
                            }
                            ?>
                    
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">about Text:</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control form_control" id="" name="about_text" value = "<?= (isset($_POST['about_text'])) ? $_POST['about_text'] : $data['about_text']?>">
                            <?php
                            if (isset($about_text_error)) {
                            ?>
                              <span class="text-danger"></span><?= $about_text_error; ?></span>
                            <?php
                            }
                            ?>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">Button link:</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control form_control" id="" name="button_link" value = "<?= (isset($_POST['button_link'])) ? $_POST['button_link'] : $data['button_link']?>">
                            <?php
                            if (isset($about_link_error)) {
                            ?>
                              <span class="text-danger"></span><?= $about_link_error; ?></span>
                            <?php
                            }
                            ?>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">Button Text:</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control form_control" id="" name="button_text" value = "<?= (isset($_POST['button_text'])) ? $_POST['button_text'] : $data['button_text']?>">
                            <?php
                            if (isset($about_text_error)) {
                            ?>
                              <span class="text-danger"></span><?= $about_text_error; ?></span>
                            <?php
                            }
                            ?>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">About Home Photo:</label>
                          <div class="col-sm-4">
                            <input type="file" class="form-control form_control" id="" name="about_home_image">
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label"></label>
                          <div class="col-sm-4">
                            <?php

                              if($data["about_home_image"] != ''){
                                ?>
                                <img height="80" class="img200" src="uploads/<?= $data['about_home_image']; ?>" alt="About Home Photo"/>
                              <?php
                              }else{
                                ?>
                                <img height="40" src="images/avatar.jpg" alt="User"/>
                              <?php
                              }

                            ?>
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">About Page Photo:</label>
                          <div class="col-sm-4">
                            <input type="file" class="form-control form_control" id="" name="about_pase_image">
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label"></label>
                          <div class="col-sm-4">
                            
                            <?php
                            // print_r($data['about_pase_image']);
                              if($data['about_pase_image'] != ''){
                                ?>
                                <img height="80" class="img200" src="uploads/about_pase1697011180_618163.jpg" alt="About Pase Photo"/>
                              <?php
                              }else{
                                ?>
                                <img height="40" src="images/avatar.jpg" alt="User"/>
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
    unset($_SESSION['old_about_title']);
    unset($_SESSION['old_about_subtitle']);
    unset($_SESSION['old_about_text']);
    unset($_SESSION['old_button_link']);
    unset($_SESSION['old_button_text']);

?>