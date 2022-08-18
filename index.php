<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
     <link rel="stylesheet" href="css/style.css">
</head>
<body>


<?php

include 'dbcon.php';

if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email =  mysqli_real_escape_string($con, $_POST['email']);
    $password =  mysqli_real_escape_string($con, $_POST['password']);
    $cpassword =  mysqli_real_escape_string($con, $_POST['cpassword']);

    $pass = password_hash($password,PASSWORD_BCRYPT);
    $cpass = password_hash($cpassword,PASSWORD_BCRYPT);

    $emailquery = " select * from registration where email ='$email' ";
    $query = mysqli_query($con,$emailquery);

    $emailcount = mysqli_num_rows($query);

    if($emailcount > 0){
        ?>
        <script>
            alert("Email already Exist")
        </script>
        <?php
    }else{
        if($password === $cpassword){
           $insertquery = "insert into registration(username, email, password, cpassword)
            values('$username','$email','$pass','$cpass')";

            $iquery = mysqli_query($con, $insertquery);

            if($iquery){
                ?>
                <script>
                    alert("inserted successfully")
                </script>
                <?php
            }
            else{
                ?>
                <script>
                    alert("Connection failed")
                </script>
                 <?php
            }
        }else{
            ?>
            <script>
                alert("Password is not matching");
            </script>
             <?php
        }
    }
}
?>


    <div class="main"
    style="margin: -170px ;">

        <!-- Sign up form -->
        <section class="signup" style="margin-bottom: -100px ;">
            <div class="container">
                <div class="signup-content" style="margin-bottom: -100px;">
                    <div class="signup-form">
                        <h2 class="form-title">Registration</h2>
                        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username" id="name" placeholder="Your Name" required/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email" required/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="pass" placeholder="Password" required/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="cpassword" id="re_pass" placeholder="Repeat your password" required/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="submit" id="signup" class="form-submit"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="signin.php" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>



    </div>

</body>
</html>