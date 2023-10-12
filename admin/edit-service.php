<?php
    
    require_once('functions/functions.php');

    // login check 
    needLogged();

    // role check
    if($_SESSION['role_id'] != 4){

    // find service data here 
    $id = $_GET['e'];
    $sel = "SELECT * FROM services WHERE id = '$id'";
    $datas = mysqli_query($con, $sel);
    $data = mysqli_fetch_assoc($datas);


    get_header();
    get_sidebar();


    // store data in variable from form 
    if(!empty($_POST)){
      $service_title=$_POST['service_title'];
      $service_text=$_POST['service_text'];
      $button_link=$_POST['button_link'];
      $button_text=$_POST['button_text'];
      
      $service_image= $_FILES['service_image'];
      $service_icon= $_POST['service_icon'];

  
    // empty validation here 
    if(!empty($service_title)){
      if(!empty($service_icon)){
        if(!empty($service_text)){
          if(!empty($button_link)){
            if(!empty($button_text)){

               // check image is given for update 
               if(!empty($service_image['name'])){

                $imageCustomeName='service_'.time().'_'.rand(10000,1000000).'.'.pathinfo($service_image['name'],PATHINFO_EXTENSION);
                // image update query here 

                $update="UPDATE `services` SET `service_title`='$service_title',`service_icon`='$service_icon',`service_text`='$service_text',`button_link`='$button_link',`button_text`=' $button_text', `service_image` = '$imageCustomeName' WHERE id ='$id'";

                // insert query run or data insert here 
                if(mysqli_query($con,$update)){
                  
                  move_uploaded_file($service_image['tmp_name'],'uploads/'.$imageCustomeName);
                
                  header('Location: all-service.php');
                  $_SESSION['success'] = "service Insert successful";
                  
                }else{
                  $_SESSION['error'] = "Ops! service Insert failed";
                }
               
              }else{
                
                $update="UPDATE `services` SET `service_title`='$service_title',`service_icon`='$service_icon',`service_text`='$service_text',`button_link`='$button_link',`button_text`=' $button_text' WHERE id ='$id'";

                if(mysqli_query($con, $update)){


                  header('Location: all-service.php');
                  echo$_SESSION['success'] = "service update without image successfully";

                }else{
                  $_SESSION['error'] = "service update faild";
                }
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
                              <a href="all-service.php" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>Services Info</a>
                          </div>  
                      </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">Service Title:<span class="req_star">*</span>:</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control <?php if (isset($service_title_error)) echo 'is-invalid' ?>" id="" name="service_title" value = "<?= (isset($_POST['service_title'])) ? $_POST['service_title'] : $data['service_title']?>">
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
                          <label class="col-sm-3 col-form-label col_form_label">Service Icon:<span class="req_star">*</span>:</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control <?php if (isset($service_icon_error)) echo 'is-invalid' ?>" id="service_icon" name="service_icon" value = "<?= (isset($_POST['service_icon'])) ? $_POST['service_icon'] : $data['service_icon']?>">     
                            <?php 
                                if(isset($service_icon_error)){
                            ?>
                                    <span class="text-danger"></span><?= $service_icon_error ;?></span>
                            <?php
                                }
                            ?>              
                          </div>
                          
                        </div> 
                        <div class="row mb-3">
                          
                           <!-- all icon show here  -->
                           <?php
                              require_once('all_icon_class.php');
                            ?>
                          <label class="col-sm-3 col-form-label col_form_label"></label>
                          <div class="col-sm-7" style="height: 100px; overflow: scroll;">
                              <?php 

                                foreach ($fonts as $key => $font) {
                                 
                                ?>

                                <i class="<?='fa'.' '.$font?>" value="<?='fa'.' '.$font?>" onclick="showValue('<?='fa'.' '.$font?>')"></i>
                              
                                <!-- <i class="fa fa-user icon" value= "icon" onclick = "showValue()"></i> -->
                               
                              <?php
                                }
                              
                              ?>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">Service Text:</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control <?php if (isset($service_text_error)) echo 'is-invalid' ?>" id="" name="service_text" value = "<?= (isset($_POST['service_text'])) ? $_POST['service_text'] : $data['service_text']?>">
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
                            <input type="text" class="form-control <?php if (isset($service_link_error)) echo 'is-invalid' ?>" id="" name="button_link" value = "<?= (isset($_POST['button_link'])) ? $_POST['button_link'] : $data['button_link']?>">
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
                            <input type="text" class="form-control <?php if (isset($button_text_error)) echo 'is-invalid' ?>" id="" name="button_text" value = "<?= (isset($_POST['button_text'])) ? $_POST['button_text'] : $data['button_text']?>">
                            <?php
                            if (isset($button_text_error)) {
                            ?>
                              <span class="text-danger"></span><?= $button_text_error; ?></span>
                            <?php
                            }
                            ?>
                          </div>
                        </div>
                        
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">Service Photo:</label>
                          <div class="col-sm-4">
                            <input type="file" class="form-control <?php if (isset($service_image_error)) echo 'is-invalid' ?>" id="" name="service_image">
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label"></label>
                          <div class="col-sm-4">
                            <?php

                              if($data["service_image"] != ''){
                                ?>
                                <img height="80" class="img200" src="uploads/<?= $data['service_image']; ?>" alt="service"/>
                              <?php
                              }else{
                                ?>
                                <img height="40" src="images/avatar.jpg" alt="User"/>
                              <?php
                              }

                            ?>
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

<script>

 function showValue(a){
  
  $font_class = a;

  $service_icon = document.getElementById('service_icon');

  $service_icon.setAttribute('value', $font_class)

 }

</script>