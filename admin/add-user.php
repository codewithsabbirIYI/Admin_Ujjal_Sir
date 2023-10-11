<?php

require_once('functions/functions.php');

// login check 
needLogged();

// role check
if ($_SESSION['role_id'] != 4) {


  get_header();
  get_sidebar();

  // store data in variable from form 
  if (!empty($_POST)) {
    $user_name = $_POST['user_name'];
    $user_phone = $_POST['user_phone'];
    $user_email = $_POST['user_email'];
    $user_username = $_POST['user_username'];
    $user_password = md5($_POST['user_password']);
    $user_confirm_password = md5($_POST['user_confirm_password']);
    $user_role = ($_POST['user_role']);
    $user_slug = uniqid('U');
    // user image find here 
    $user_image = $_FILES['user_image'];
    // image custome name variable initial here 
    $imageCustomeName = "";

    // user image custome name set from here 
    if ($user_image['name'] != '') {
      $imageCustomeName = 'user_' . time() . '_' . rand(10000, 1000000) . '.' . pathinfo($user_image['name'], PATHINFO_EXTENSION);
    }

    // insert query here 
    $insert = "INSERT INTO users(user_name,user_slug,user_phone,user_email,user_username,user_password, user_image, role_id)
      VALUES('$user_name','$user_slug','$user_phone','$user_email','$user_username','$user_password','$imageCustomeName','$user_role')";



    // empty validation here 
    if (!empty($user_name)) {
      if (!empty($user_phone)) {
        if (!empty($user_email)) {
          if (!empty($user_username)) {
            if (!empty($_POST['user_password'])) {

              if (!empty($_POST['user_confirm_password'])) {
                if (!empty($user_role)) {

                  // check is password and confrirm password same 
                  if ($user_password === $user_confirm_password) {

                    // insert query run or data insert here 
                    if (mysqli_query($con, $insert)) {
                      move_uploaded_file($user_image['tmp_name'], 'uploads/' . $imageCustomeName);

                      $_SESSION['success'] = "User registration successful";

                      header('Location: all-user.php?' . $_SESSION['success']);
                    } else {
                      $_SESSION['error'] = "Ops! User registration failed";
                    }
                  } else {
                    $user_confirm_password_match_error = "Password and confirm password did not match";
                  }
                } else {
                  $user_role_error = "Please Select user Role";
                }
              } else {
                $user_confirm_password_error = "Please enter confirm password";
              }
            } else {
              $user_password_error = "Please enter your password";
            }
          } else {
            $user_username_error = "Please enter your username";
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
                <input type="text" class="form-control form_control <?php if (isset($user_name_error)) echo 'is-invalid' ?>" id="" name="user_name" value="<?php if (isset($_POST['user_name'])) echo  $_POST['user_name'] ?>">
                <?php
                if (isset($user_name_error)) {
                ?>
                  <span class="text-danger"></span><?= $user_name_error; ?></span>m       
                <?php
                }
                ?>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label col_form_label">Phone:</label>
              <div class="col-sm-7">
                <input type="text" class="form-control form_control <?php if (isset($user_phone_error)) echo 'is-invalid' ?>" id="" name="user_phone" value="<?php if (isset($_POST['user_phone'])) echo  $_POST['user_phone'] ?>">
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
                <input type="email" class="form-control <?php if (isset($user_email_error)) echo 'is-invalid' ?>" id="input" name="user_email" value="<?php if (isset($_POST['user_email'])) echo  $_POST['user_email'] ?>">
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
                <input type="text" style="text-align: left;" class="form-control <?php if (isset($user_username_error)) echo 'is-invalid' ?>" id="input" name="user_username" value="<?php if (isset($_POST['user_username'])) echo  $_POST['user_username'] ?>">
                <?php
                if (isset($user_username_error)) {
                ?>
                  <span class="text-danger"></span><?= $user_username_error; ?></span>
                <?php
                }
                ?>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label col_form_label">Password<span class="req_star">*</span>:</label>
              <div class="col-sm-7">
                <div class="input-group">
                  <input type="password" class="form-control form_control <?php if (isset($user_password_error)) echo 'is-invalid' ?>" id="user_password" name="user_password" value="<?php if (isset($_POST['user_password'])) echo  $_POST['user_password'] ?>">

                  <span style="cursor: pointer;" class="input-group-text"><i id="user_passsword_show_btn" class="fa fa-eye-slash" onclick="showPassBtn()"></i></i></span>
                </div>

                <?php
                if (isset($user_password_error)) {
                ?>
                  <span class="text-danger"></span><?= $user_password_error; ?></span>
                <?php
                }
                ?>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label col_form_label">Confirm-Password<span class="req_star">*</span>:</label>
              <div class="col-sm-7">
                <div class="input-group">
                  <input type="password" class="form-control form_control <?php if (isset($user_confirm_password_error)) echo 'is-invalid' ?>" id="user_confirm_password" name="user_confirm_password" value="<?php if (isset($_POST['user_confirm_password'])) echo  $_POST['user_confirm_password'] ?>">

                  <span class="input-group-text"><i id="user_confirm_password_show_btn" class="fa fa-eye-slash" onclick="showConPassBtn()"></i></span>
                </div>

                <?php
                if (isset($user_confirm_password_match_error)) {
                ?>
                  <span class="text-danger"></span><?= $user_confirm_password_match_error; ?></span>
                <?php
                }
                ?>

                <?php
                if (isset($user_confirm_password_error)) {
                ?>
                  <span class="text-danger"></span><?= $user_confirm_password_error; ?></span>
                <?php
                }
                ?>
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

                    <option value="<?= $role['role_id'] ?>"><?= $role['role_name'] ?></option>

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
} else {
  header('Location: index.php');
}

?>


<script>
  // $(document).ready(function () {

  //   // for password 
  //     $('#user_passsword_show_btn').click(function (e) { 
  //         e.preventDefault();
  //         $(this).attr('class', 'fa fa-eye');
  //         $('#user_passsword').attr('type', 'text');
  //     });

  //   // for confirm password 
  //     $('#user_confirm_password_show_btn').click(function (e) { 
  //         e.preventDefault();
  //         $(this).attr('class', 'fa fa-eye');
  //         $('#user_confirm_password').attr('type', 'text');
  //     });

  // });


  // for password  
  // function alert() {
  //   alert "( alert)";
  // }


  function showPassBtn() {


    var passChk = document.getElementById("user_passsword_show_btn");



    var passChkClass = passChk.getAttribute('class');
    var passType = document.getElementById('user_password').getAttribute('type');
    if (passChkClass == 'fa fa-eye-slash') {
      document.getElementById("user_passsword_show_btn").setAttribute("class", "fa fa-eye");

      if (passType == 'password') {
        document.getElementById('user_password').setAttribute('type', 'text');
      }
    } else {
      document.getElementById("user_passsword_show_btn").setAttribute("class", "fa fa-eye-slash");
      document.getElementById('user_password').setAttribute('type', 'password');
    }

  }

  // for confirm password 
  function showConPassBtn() {
    var passChk = document.getElementById("user_confirm_password_show_btn");

    var passChkClass = passChk.getAttribute('class');
    var passType = document.getElementById('user_confirm_password').getAttribute('type');
    if (passChkClass == 'fa fa-eye-slash') {
      document.getElementById("user_confirm_password_show_btn").setAttribute("class", "fa fa-eye");

      if (passType == 'password') {
        document.getElementById('user_confirm_password').setAttribute('type', 'text');
      }
    } else {
      document.getElementById("user_confirm_password_show_btn").setAttribute("class", "fa fa-eye-slash");
      document.getElementById('user_confirm_password').setAttribute('type', 'password');
    }
  }
</script>