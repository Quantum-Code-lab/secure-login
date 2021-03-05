<?php 
require_once("action/db_connect.php");
require_once("action/functions.php");
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Login & Rigistration System</title>

    <!-- Bootstrap css (01)-->
    <link rel="stylesheet" href="include/bootstraps/css/bootstrap.css">

    <!-- font-awesome css 02 -->
    <link rel="stylesheet" href="include/fontawesome-5.13.0/css/all.css">

    <!-- main css 03-->
    <link rel="stylesheet" href="include/Ext_all_CSS/signup.css">

</head>

<body>
    <div class="brand">
        <a href="index.php"><i class="fas fa-drafting-compass"></i></a>
    </div>

    <div class="container">
        <div class="row">
            <div class="con-tainer ">
                <p><?php validation(); ?></p>
            </div>
            <form method="POST">
                <div class="col-lg-6 col-lg-offset-3 abc">
                    <!-- here "col-lg-offset-3" use for align column in center without using "m-auto" -->
                    <div class="card mt-5 py-2 def">
                        <!-- here "py" = padding for top and bottom 2 also "px"= padding left and right  -->
                        <!-- use bb inside bootstrap class for apply external css -->
                        <div class="card-title">
                            <h4 class="text-center aa">Please Fillup The Registration Form</h4>
                        </div>

                        <div class="card-body">
                            <input type="text" name="firstname" placeholder="please enter your first name"
                                class="form-control mycoluum" required>
                            <input type="text" name="lastname" placeholder="please enter your last name"
                                class="form-control mycoluum" required>
                                <input type="text" name="username" placeholder="please enter your user name"
                                class="form-control mycoluum" required>
                            <input type="email" name="email" placeholder="please enter your Email"
                                class="form-control mycoluum" required>
                            <input type="password" name="password" placeholder="please enter your passeord"
                                class="form-control mycoluum" required>
                            <input type="password" name="c_password" placeholder="confirm passeord"
                                class="form-control mycoluum" required>
                        </div>
                        <div class="inputbtn">
                            <button type="submit" name="submit" class="submit-btn">Signup</button>
                            <button type="reset" name="reset" class="res_btn">Reset</button>
                        </div>
                        <span>if you have already have a account then login</span>
                        <button type="submit" name="submit" class="login-btn">login</button>

                    </div>
                </div>
            </form>
        </div><!-- end row -->
        <!-- <div class="inputbtn">
        <input type="submit" name="Signup" class="" value="Signup">
    </div> -->
    </div>
    <!-- jquery.min.js (04)-->
    <script type="text/javascript" src="include/jquery/jquery-min.js"></script>

    <!-- bootstrap min.js (05)-->
    <script type="text/javascript" src="include/bootstraps/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="include/bootstraps/js/bootstrap.js"></script>
</body>

</html>