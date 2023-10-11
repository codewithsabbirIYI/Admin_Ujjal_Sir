<?php 
    
    require_once('functions/functions.php');
    // login check 
    needLogged();

      // role check 
      if($_SESSION['role_id'] != 4){

    get_header();
    get_sidebar();

  // find user data here 
  $id = $_GET['e'];
  $sel = "SELECT * FROM users WHERE user_id = '$id'";
  $datas = mysqli_query($con, $sel);
  $data = mysqli_fetch_assoc($datas);


   // store data in variable from form 
   if (!empty($_POST)) {
    $user_name = $_POST['user_name'];
    $user_phone = $_POST['user_phone'];
    $user_email = $_POST['user_email'];
    $user_role = ($_POST['user_role']);
    $user_slug = uniqid('U');
    // user image find here 
    $user_image = $_FILES['user_image'];
    // image custome name variable initial here 
    $imageCustomeName = "";


    // empty validation here 
    if (!empty($user_name)) {
      if (!empty($user_phone)) {
        if (!empty($user_email)) { 
          if (!empty($user_role)) {

              // check is image given for update 
              if ($user_image['name']!= '') {
              // image custom name here 
              $imageCustomeName = 'user_' . time() . '_' . rand(10000, 1000000) . '.' . pathinfo($user_image['name'], PATHINFO_EXTENSION); 

              // update query here 
              $update = "UPDATE `users` SET `user_name`='$user_name',`user_phone`='$user_phone',`user_email`='$user_email',`role_id`='$user_role', `user_image` = '$imageCustomeName' WHERE `user_id` = '$id'";

                // insert query run or data insert here 
                if (mysqli_query($con, $update)) {
                move_uploaded_file($user_image['tmp_name'], 'uploads/' . $imageCustomeName);

                $_SESSION['success'] = "User registration successful";

                header('Location: all-user.php?'.$_SESSION['success']);

                } else {
                  $_SESSION['error'] = "Ops! User registration failed";
                }

                }else{
                    // update query here 
                    $update = "UPDATE `users` SET`user_name`='$user_name',`user_phone`='$user_phone',`user_email`='$user_email',`role_id`='$user_role' WHERE `user_id` = '$id'";

                    // data insert with out image 
                    if(mysqli_query($con, $update)){
                      
                      $_SESSION['success'] = "User registration successful";

                      header('Location: all-user.php?'.$_SESSION['success']);
                    
                    }  
                }
          
          } else {
            $user_role_error = "Please Select user Role";
          }
        } else {
          $user_email_error = "Please enter your email";
        }
      } else {
        $user_phone_error = "Please enter your Phone";
      }
    } else {
      $user_name_error = "Please Enter Your Name";
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
                <i class="fab fa-gg-circle"></i>User Edit
              </div>
              <div class="col-md-4 card_button_part">
                <a href="all-user.php" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>All User</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label col_form_label">Name<span class="req_star">*</span>:</label>
              <div class="col-sm-7">
                <input type="text" class="form-control form_control <?php if (isset($user_name_error)) echo 'is-invalid' ?>" id="" name="user_name" value="<?= (isset($_POST['user_name'])) ? $_POST['user_name'] : $data['user_name']?>">
                <?php
                if (isset($user_name_error)) {
                ?>
                  <span class="text-danger"></span><?= $user_name_error; ?></span>
                <?php
                }
                ?>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label col_form_label">Phone:</label>
              <div class="col-sm-7">
                <input type="text" class="form-control form_control <?php if (isset($user_phone_error)) echo 'is-invalid' ?>" id="" name="user_phone" value="<?= (isset($_POST['user_phone'])) ? $_POST['user_phone'] : $data['user_phone']?>">
                <?php
                if (isset($user_phone_error)) {
                ?>
                  <span class="text-danger"></span><?= $user_phone_error; ?></span>
                <?php
                }
                ?>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label col_form_label">Email<span class="req_star">*</span>:</label>
              <div class="col-sm-7">
                <input type="email" class="form-control <?php if (isset($user_email_error)) echo 'is-invalid' ?>" id="input" name="user_email" value="<?= (isset($_POST['user_email'])) ? $_POST['user_email'] : $data['user_email']?>">
                <?php
                if (isset($user_email_error)) {
                ?>
                  <span class="text-danger"></span><?= $user_email_error; ?></span>
                <?php
                }
                ?>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label col_form_label">Username<span class="req_star">*</span>:</label>
              <div class="col-sm-7">
                <input type="text" style="text-align: left;" class="form-control " id="input" name="user_username" value="<?= $data['user_username']?>" disabled>
              
              </div>
            </div>
          
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label col_form_label">User Role<span class="req_star">*</span>:</label>
              <div class="col-sm-4">
                <select class="form-control form_control" id="" name="user_role">
                  <option value="">Select Role</option>

                  <?php
                  $selrq = "SELECT * FROM roles ORDER BY role_id ASC";
                  $selr = mysqli_query($con, $selrq);

                  while ($role = mysqli_fetch_assoc($selr)) {
                  ?>

                    <option value="<?= $role['role_id'] ?>" <?= ($role['role_id'] == $data['role_id'])? "selected" : "" ?>><?= $role['role_name'] ?></option>

                  <?php
                  }

                  ?>
                  <?php
                  if (isset($user_role_error)) {
                    ?>
                      <span class="text-danger"></span><?= $user_role_error; ?></span>
                    <?php
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label col_form_label">Photo:</label>
              <div class="col-sm-4">
                <input type="file" class="form-control form_control" id="" name="user_image">
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label col_form_label"></label>
              <div class="col-sm-4">
              <?php

                  if($data["user_image"] != ''){
                    ?>
                    <img height="40" class="img200" src="uploads/<?= $data['user_image']; ?>" alt="User"/>
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