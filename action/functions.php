<?php 
	function myfunc()
	{
		//echo"hello";
	}

	// query function -02
	function Query($query)
	{
		global $con;
		return mysqli_query($con,$query);
	}
	// Confirm function -03
	function confirm($result)
	{
		global $con;
		if (!$result) 
		{
			die('Query Failed'.mysqli_error($con));
		}
	}
	function clean($string)	//04
	{
		return htmlentities($string);
	}
	// for fetch data from db2_autocommit(05)
	function fetch_data($result)
    {
        return mysqli_fetch_assoc($result);
    }

	// redirect location function-06
	function redirect($location)
	{
		return header("location:{$location}");
	}
	// set massage function-07
	function set_message($msg)
	{
		if(!empty($msg))
		{
			$_SESSION['Message']=$msg;
		}
		else
		{
			$msg="";
		}
	}
	// to display massage function-08
	function display_message()
	{
		if(isset($_SESSION['Message']))
		{
			echo $_SESSION['Message'];
			unset($_SESSION['Message']);
		}
	}
	
	// token generator -09

	function token_generator()
	{
		$token = $_SESSION['token']=md5(uniqid(mt_rand(),true));
		return $token;
	}
	// for sending email to register user(10)
	 function send_email($email,$sub,$msg,$header) // this function describe inside register user func
	 {
		 return mail($email,$sub,$msg,$header);

	 }
	// for mysql row count
	function row_count($count)
	{
		return mysqli_num_rows($count);
	}
	// form validation function
	function validation()
	{
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			//echo "it's working";
			$Firstname = clean($_POST['firstname']);
			$Lastname = clean($_POST['lastname']);
			$Username = clean($_POST['username']);
			$Email = clean($_POST['email']);
			$Password = clean($_POST['password']);
			$C_password = clean($_POST['c_password']);

			//to chech input field data catch or not un comment line (70)
			//echo $Firstname,$Lastname,$Email,$Password,$C_password;

			$Errors =[]; //for error massage array
			$Max = 10;
			$Min = 04;

			if (strlen($Firstname)<$Min)	// 1st name 4 char er boro hobe na
			{
				$Errors[]= "First Name Cannot Be Less {$Min} Charecter";
			}

			if(strlen($Lastname)<$Min)	// last name 4 char er choto hobe na
			{
				$Errors[]= "Last Name Cannot Be Less {$Min} Charecter";
			}

			if (strlen($Firstname)>$Max)	// 1st name 20 char er boro hobe na
			{
				$Errors[]= "First Name Cannot Be More Than {$Max} Charecter";
			}

			if(strlen($Lastname)>$Max)// last name 20 char er boro hobe na
			{
				$Errors[]= "Last Name Cannot Be more than {$Max} Charecter";
			}

			if(strlen($Username)<$Min)
			{
				$Errors[]= "User Name Cannot Be Less {$Min} Charecter";
			}
			if(strlen($Username)<$Min)
			{
				$Errors[]= "User Name Cannot Be more {$Max} Charecter";
			}
			if ($Username=="") 
			{
				$Errors[]= "User Name Cannot Be empty";
			}
			if ($Password!= $C_password) 
			{
				$Errors[]= "Password and Confirm password must be same";
			}
			// -----------------*************************-----------------

			if(!preg_match("/^[a-zA-Z,0-9\s]*$/",$Username))/* ^=start; []=allow those charecter; $=end;\s = make a space*/ 
			{
				$Errors[]= "User Name Cannot Accept Those Charecter";
			}

			if(!preg_match("/^[a-z0-9\._]+@[a-z]+\.[a-z]*$/",$Email))
			{
				$Errors[]= "please enter a valaid email";
			}
			// -----------------*************************-----------------
			// email exist or not

			if(email_exist($Email)) 
			{
				$Errors[]= "Email That you entered already exist in database";
			}

			 //user exist or not

			if (firstname_exist($Firstname)) 
			{
				$Errors[]= "First name That you entered already exist in database";
			}
			if (Username_exist($Username)) 
			{
				$Errors[]= "User name That you entered already exist in database";
			}
			//display the error massage
			if (!empty($Errors)) 
			{
				foreach ($Errors as $Error) // $Errors = Array and $Error= Variable to display errors
				{
					echo '<div class="alert alert-warning" role="alert">'.$Error.'</div>';
				}
			}

			// registration function call here check bellow
			else
			{
				if (user_registration($Firstname,$Lastname,$Username,$Email,$Password))
				{
					set_message('<p>You have successfully Registered now you can check your mail to varify your account</p>');
					redirect("login.php");
				}
				else
				{
					set_message('<p> Your Account Not Registered Please Try Again </p>');
					redirect("index.php");
				}
			}

		}
	}

	//User Name exist or not

	function firstname_exist($Firstname)
	{
		$sql= "SELECT * FROM users WHERE FirstName='$Firstname'";
		$result= Query($sql);

		if (fetch_data($result)) 
		{
			return true;

		}
		else
		{
			return false;
		}
	}
	//Username exist or not

	function Username_exist($username)
	{
		$sql= "SELECT * FROM users WHERE Username ='$username'";
		$result= Query($sql);
		if (fetch_data($result)) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//User Email exist or not

	function email_exist($email)
	{
		$sql= "SELECT * FROM users WHERE Email = '$email'";
		$result= Query($sql);

		if(fetch_data($result)) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	//***User registered function***
	function user_registration($f_name,$l_name,$u_name,$u_email,$Password)
	{
		$Firstname = ($f_name);
		$Lastname = ($l_name);
		$Username=($u_name);
		$Email = ($u_email);
		$Password = ($Password);

		if (email_exist($Email)) 
		{
			return true;
		}
		elseif(Username_exist($Username))
		{
			return true;
		}
		elseif(firstname_exist($Firstname))
		{
			return true;
		}
		else
		{
			$Password = md5($Password);
			$Validation_code = md5($Username);
			$sql ="INSERT INTO users(FirstName,LastName,Username,Email,U_Password,ValaidationCode,Active)VALUES('$Firstname','$Lastname','$Username','$Email','$Password','$Validation_code','0')";
			$result =Query($sql);
			confirm($result);
			//for email function variables to need
			$subject="Active your Account"; 
			$msg="Please Check The Link Bellow To Varify Your Account http://localhost/my_projects/SLRS/activetion.php?Email=$Email & Code = $Validation_code";
				
				// http://my_projects/SLRS/activetion.php?Email=$Email & Code = $Validation_code
			$header = "From No-Reply amirkhalifa.cse@gmail.com";

			send_email($Email,$subject,$msg,$header);
			return true;
		}
	}
?>