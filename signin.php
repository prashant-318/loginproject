<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Font Icon -->
     <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

     <!-- Main css -->
     <link rel="stylesheet" href="css/style.css">
    <title>Sign In</title>
</head>
<body>

   <?php
     include 'dbcon.php';
     if(isset($_POST['submit'])){

        $email= $_POST['email'];
        $password= $_POST['password'];

        $email_search = " select * from registration where email='$email' ";
        $query= mysqli_query($con,$email_search);

        $email_count = mysqli_num_rows($query);

        if($email_count){
            $email_pass = mysqli_fetch_assoc($query);

            $decode = password_verify($password, $email_pass['password']);

            if($decode){
             echo "Login success";
            }else{
              echo "password incorrect";
            }
        }else{
           echo "Invalid Email";
        }
     }
   ?>


              <!-- Sing in  Form -->
              <section class="sign-in">
                <div class="container">
                    <div class="signin-content">
                        <div class="signin-image">
                            <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                        </div>
    
                        <div class="signin-form">
                            <h2 class="form-title">Sign In</h2>
                            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" class="register-form" id="login-form">
                                <div class="form-group">
                                    <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                    <input type="text" name="email" id="your_name" placeholder="Email" required/>
                                </div>
                                <div class="form-group">
                                    <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                    <input type="password" name="password" id="your_pass" placeholder="Password" required/>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                    <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                                </div>
                                <div class="form-group form-button">
                                    <input type="submit" name="submit" id="signin" class="form-submit"/>
                                </div>
                            </form>
                            <a href="index.php" class="signup-image-link">Create an account</a>
                        </div>
                    </div>
                </div>
            </section>




</body>
</html>