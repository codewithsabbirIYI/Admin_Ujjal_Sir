<?php
    
    require_once('functions/functions.php');
    get_header();
    get_sidebar();

  // find user data here 
  $id = $_GET['e'];
  $sel = "SELECT * FROM users WHERE user_id = '$id'";
  $datas = mysqli_query($con, $sel);
  $data = mysqli_fetch_assoc($datas);



    // store data in variable from form 
    if(!empty($_POST)){
      $user_name=$_POST['user_name'];
      $user_phone=$_POST['user_phone'];
      $user_email=$_POST['user_email'];
      // $user_username=$_POST['user_username'];
      // $user_password=md5($_POST['user_password']);
      // $user_confirm_password=md5($_POST['user_confirm_password']);
      $user_role=($_POST['user_role']);

      // user image find here 
      $user_image= $_FILES['user_image'];

      
     
      // update query here 
      $update="UPDATE users SET user_name = '$user_name', user_email = '$user_email', role_id = '$user_role' WHERE user_id = '$id' ";
      

    // empty validation here 
    if(!empty($user_name)){
      if(!empty($user_email)){
        // if(!empty($user_username)){
        //   if(!empty($user_password)){
        //     if(!empty($user_confirm_password)){
              if(!empty($user_role)){

                // check is password and confrirm password same 
                // if($user_password === $user_confirm_password){

                  // update query run or data update here 
                  if(mysqli_query($con,$update)){
                   
                    // user image custome name set from here 
                      if($user_image['name']!=''){

                        $imageCustomeName='user_'.time().'_'.rand(10000,1000000).'.'.pathinfo($user_image['name'],PATHINFO_EXTENSION);
                          // image update query here 
                          $update="UPDATE users SET user_image = '$imageCustomeName' WHERE user_id = '$id' ";
                                   
                          if(mysqli_query($con, $update))

                              move_uploaded_file($user_image['tmp_name'],'uploads/'.$imageCustomeName);
                              header('Location: view-user.php?v='.$id);
                            
                        }else{
                          echo "image update failed";
                        }

                    header('Location: view-user.php?v='.$id);
                    
                  }else{
                    echo "Ops! User Update failed";
                  }
                  // }else{
                  //   echo "Password and confirm password did not match";
                  // }

                }else{
                  echo "Please Select Role";                 
                }
          //     }else{
          //       echo "Please enter confirm password";
          //     }
          //   }else{
          //     echo "Please enter your password";
          //   }
      
          // }else{
          //   echo "Please enter your Username";
          // }
      
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
                              <i class="fab fa-gg-circle"></i>User Update
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
                            <input type="text" class="form-control form_control" id="" name="user_name" value="<?=$data['user_name']?>">
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">Phone:</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control form_control" id="" name="user_phone" value="<?=$data['user_phone']?>">
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">Email<span class="req_star">*</span>:</label>
                          <div class="col-sm-7">
                            <input type="email" class="form-control form_control" id="" name="user_email" value="<?=$data['user_email']?>">
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">Username<span class="req_star">*</span>:</label>
                          <div class="col-sm-7">
                            <input  type="text" class="form-control form_control" id="" value="<?=$data['user_username']?>" readonly>
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

                                  <option value="<?= $role['role_id']?>"   <?php if($role['role_id']==$data['role_id']){echo 'selected';} ?>   ><?= $role['role_name']?></option>

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
                          <div class="col-sm-4">
                            <?php

                              if($data["user_image"] != ''){
                                ?>
                                <img height="80" class="img200" src="uploads/<?= $data['user_image']; ?>" alt="User"/>
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

?>