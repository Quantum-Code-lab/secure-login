<?php 
	require_once("action/db_connect.php");
	require_once("action/functions.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>title confirm your loging</title>
    <link rel="stylesheet" type="text/css" href="include/Ext_all_CSS/login.css">

</head>

<body>
    <div class="regform">
        <div class="display_msg">
            <h3><?php display_message();?></h3>
        </div>
        <form action="dashboard.php" method="POST">
            <input type="text" name="email" placeholder="enter your email"><br><br>
            <input type="password" name="password" placeholder="enter your password"><br><br>
            <br>
            <div class="l_btn">
                <button type="submit" name="login" class="log_btn">Login</button>
				<span><a href="reset.php">forgot password</a></span>
            </div>
            <div class="abc">
                <input type="checkbox" name="check"><span> remember me</span><br>
                <span>if you have already a member then<a href="signup.php">signup</a> </span>
            </div>
            <!-- <div class="card-footer">
                <a href="reset.php">forgot password</a>
            </div> -->
        </form>

    </div>

</body>

</html>