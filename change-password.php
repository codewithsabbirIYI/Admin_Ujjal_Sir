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
        
        $old_user_password = md5($_POST['old_user_password']);
        $user_password = md5($_POST['user_password']);
        $confirm_password = md5($_POST['user_confirm_password']);

        // field empty check here 
        if(!empty($old_user_password)){
            if (!empty($user_password)) {
                if (!empty($confirm_password)) {

                    // old password find here 
                    $id = $_GET['p'];
                    $select_query = "SELECT `user_password` FROM `users` WHERE `user_id` = '$id'";
                    $user_data = mysqli_fetch_assoc(mysqli_query($con, $select_query));
                    $user_db_password = $user_data['user_password'];

                    // old password and user given old password match here 

                    if($old_user_password == $user_db_password){

                        // password and confirm password match here 
                        if($user_password == $confirm_password){

                            // finally user password update operation here 
                            $update_query = "UPDATE `users` SET `user_password` = '$user_password' WHERE `user_id` = '$id'";
                            if(mysqli_query($con, $update_query)){
                                echo "Password Update Successfully";
                            }else{
                                echo "Opps Password Update Failed";
                            }
                        }else{
                            echo "Password and Confirm password Does't Match";
                        }

                    }else{
                        echo "Old Password Does't Match";
                    }
                    
                }else{
                    echo "Please Enter Confirm Password";
                }
            }else{
                echo "Please Enter Your New Password";
            }
        }else{
            echo "Please Enter Old Password";
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
                              <i class="fab fa-gg-circle"></i>Change Password
                          </div>  
                          <div class="col-md-4 card_button_part">
                              <a href="all-user.php" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>All User</a>
                          </div>  
                      </div>
                    </div>
                    <div class="card-body">
                      
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">Old Password<span class="req_star">*</span>:</label>
                          <div class="col-sm-7">
                            <input type="password" class="form-control form_control" id="" name="old_user_password">
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">New Password<span class="req_star">*</span>:</label>
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