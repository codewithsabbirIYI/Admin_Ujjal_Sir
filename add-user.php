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
      $user_name=$_POST['user_name'];
      $user_phone=$_POST['user_phone'];
      $user_email=$_POST['user_email'];
      $user_username=$_POST['user_username'];
      $user_password=md5($_POST['user_password']);
      $user_confirm_password=md5($_POST['user_confirm_password']);
      $user_role=($_POST['user_role']);

      // user image find here 
      $user_image= $_FILES['user_image'];
      // image custome name variable initial here 
      $imageCustomeName="";

      // user image custome name set from here 
      if($user_image['name']!=''){
      $imageCustomeName='user_'.time().'_'.rand(10000,1000000).'.'.pathinfo($user_image['name'],PATHINFO_EXTENSION);
      }
     
      // insert query here 
      $insert="INSERT INTO users(user_name,user_phone,user_email,user_username,user_password, user_image, role_id)
      VALUES('$user_name','$user_phone','$user_email','$user_username','$user_password','$imageCustomeName','$user_role')";

    // empty validation here 
    if(!empty($user_name)){
      if(!empty($user_email)){
        if(!empty($user_username)){
          if(!empty($user_password)){
            if(!empty($user_confirm_password)){
              if(!empty($user_role)){

                // check is password and confrirm password same 
                if($user_password === $user_confirm_password){

                  // insert query run or data insert here 
                  if(mysqli_query($con,$insert)){
                    move_uploaded_file($user_image['tmp_name'],'uploads/'.$imageCustomeName);

                    header('Location: all-user.php');
                    echo "User registration successful";
                  }else{
                    echo "Ops! User registration failed";
                  }
                  }else{
                    echo "Password and confirm password did not match";
                  }

                }else{
                  echo "Please enter confirm password";
                }
              }else{
                echo "Please Select Role";
              }
            }else{
              echo "Please enter your password";
            }
      
          }else{
            echo "Please enter your Username";
          }
      
        }else{
          echo "Please enter your email address";
        }

      }else{
        echo "Please enter your name";
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
                              <i class="fab fa-gg-circle"></i>User Registration
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
                            <input type="text" class="form-control form_control" id="" name="user_name">
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">Phone:</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control form_control" id="" name="user_phone">
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">Email<span class="req_star">*</span>:</label>
                          <div class="col-sm-7">
                            <input type="email" class="form-control form_control" id="" name="user_email">
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">Username<span class="req_star">*</span>:</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control form_control" id="" name="user_username">
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">Password<span class="req_star">*</span>:</label>
                          <div class="col-sm-7">
                            <input type="password" class="form-control form_control" id="" name="user_password">
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">Confirm-Password<span class="req_star">*</span>:</label>
                          <div class="col-sm-7">
                            <input type="password" class="form-control form_control" id="" name="user_confirm_password">
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">User Role<span class="req_star">*</span>:</label>
                          <div class="col-sm-4">
                            <select class="form-control form_control" id="" name="user_role">
                              <option value = "">Select Role</option>

                              <?php
                                $selrq = "SELECT * FROM roles ORDER BY role_id ASC";
                                $selr = mysqli_query($con, $selrq);

                                while ($role = mysqli_fetch_assoc($selr)) {
                                  ?>

                                  <option value="<?= $role['role_id']?>"><?= $role['role_name']?></option>

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
                    </div>
                    <div class="card-footer text-center">
                      <button type="submit" class="btn btn-sm btn-dark">REGISTRATION</button>
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