<?php 
    
    require_once('functions/functions.php');

    
    
    if(!empty($_POST)){

        // find form data here 
        $user_email = $_POST['user_email'];

        // field empty check 
        if(!empty($user_email)){
           

            // check is user email is exiest 
            $select_query = "SELECT * FROM users WHERE user_email = '$user_email'";

            $datas = mysqli_query($con, $select_query);

            $data = mysqli_fetch_assoc($datas);

            

            if($data){

                // mail send code here 

                $to = "somebody@example.com";
                $subject = "My subject";
                $txt = "Hello world!";
                $headers = "From: webmaster@example.com" . "\r\n" .
                "CC: somebodyelse@example.com";

                mail($to,$subject,$txt,$headers);


                header('Location: reset-password.php?rp='.$data['user_slug']);
            }else{
                echo "This Email Not Found";
            }
        }else{
            echo "Enter Your Email";
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div class="login-page bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                  <h3 class="mb-3">Forgot Password</h3>
                    <div class="bg-white shadow rounded">
                        <div class="row">
                            <div class="col-md-7 pe-0">
                                <div class="form-left h-100 py-5 px-5">
                                    <form method="POST" action="" class="row g-4">
                                        <div class="col-12">
                                            <label>Email<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fas fa-user"></i></div>
                                                <input type="email" class="form-control" placeholder="Enter Your Email" name="user_email">
                                            </div>
                                        </div>


                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-info">Send</button>
                                        </div> 

                                    </form>
                                </div>
                            </div>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>