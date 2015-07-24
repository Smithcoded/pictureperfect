
<?php
require 'conn.php';
session_start();
$firstnameErr = $lastnameErr = $passwordErr = $emailErr = $usernameErr = $usertypeErr  = $usertype1Err = $signup_alert = $username1Err= $login1 =  "";
$firstname = $lastname = $username =$password = $passwordAgain = $email = $usertype = "";

if (!loggedin()){
	

$firstnameErr = $lastnameErr = $passwordErr = $emailErr = $usernameErr = $usertypeErr = $login1 =  "";
$firstname = $lastname = $username =$password = $passwordAgain = $email = $usertype1 = $usertype = "";

if(isset($_REQUEST['register_user'])!='') {


if ($_SERVER['REQUEST_METHOD'] == "POST") {

	 if (empty($_POST["firstname"])) {
      $firstnameErr = "Firstname is required";
   } else {
     $firstname = Dinput($_POST["firstname"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$firstname)) {
       $firstnameErr = "Only letters and white space allowed";
        
     }
   }
	
	if (empty($_POST["lastname"])) {
      $lastnameErr = "Lastname is required";
     
   } else {
     $lastname = Dinput($_POST["lastname"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$lastname)) {
       $lastnameErr = "Only letters and white space allowed";
        
     }
   }

   if (empty($_POST["username"])) {
     $usernameErr = $username1Err = "Username is required";
    
   } else {
     $username = Dinput($_POST["username"]);
     // check if name only contains letters and whitespace
   }

   if (empty($_POST["email"])) {
      $emailErr = "Email is required";
     
   } else {
     $email = Dinput($_POST["email"]);
     // check if e-mail address is well-formed
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format"; 
        
     }
   }

    if(empty($_POST['password']) || empty($_POST['passwordAgain'])){
		 $passwordErr = 'Password is required... Enter Passwords';
		 

	}else if ($_POST['password'] != $_POST['passwordAgain']){
		 $passwordErr = "Passwords do not match";
		  
	}
		else{
		$password = SHA1(Dinput($_POST['password']));

	}
   if (empty($_POST["usertype"])) {
     $usertypeErr  = $usertype1Err = "Usertype is required";
      
   } else {
     $usertype = Dinput($_POST["usertype"]);
    
     }
   $date = date("jS \of F, Y.");
		
		if (!empty($firstnameErr) || !empty($lastnameErr) || !empty($passwordErr) || !empty($emailErr)|| !empty($usernameErr) || !empty($usertypeErr)) {
			
		}else{
			
		try{
	 	// check if email address exists
	 $stmt= ("SELECT email FROM users WHERE email = :email ");
		
			$stmt = $conn->prepare($stmt);
	 		$stmt->bindparam(':email', $email);
	 		$stmt->execute();
	 		$rows = $stmt->rowCount();

	 		if ($rows > 0) {
	 			 $emailErr = " Email Address Already Exists, Try Another! ";
	 				}else{

	 					//prepare sql bind parameters
		$stmt=$conn->prepare("INSERT INTO users(firstname, lastname,  email, username, password, usertype, date) 
			VALUES(:firstname, :lastname, :email, :username, :password, :usertype, :date)");
		$stmt->bindParam(':firstname', $firstname);
		$stmt->bindParam(':lastname', $lastname);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':username', $username);
		
		$stmt->bindParam(':password', $password);
		$stmt->bindParam(':usertype', $usertype);
		$stmt->bindParam(':date', $date);
		$stmt->execute();
		$rows = $stmt->rowCount();

		if ($rows > 0) {
		
		$signup_alert = "Registration Successful, Please Log in.";
		
	}else{
		echo "Sorry, we could not register you owing network issues, Try Again.";
	}
}}

catch(PDOException $e){
	
	//display error msg
	echo "Error:".$e->getmessage();
}
	
	

	//database and all 

}
}
}
}
?>







<?php
require 'conn.php';
$username1 = $password1 = $usertype1 = "";
if(isset($_REQUEST['login_user'])!='') {
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

if (isset($_POST['username1']) && isset($_POST['password1']) && isset($_POST['usertype1'])) {
		  $username1 = Dinput($_POST['username1']);
		$password1 = Dinput($_POST['password1']);
		  $usertype1 = Dinput($_POST['usertype1']);

		 if (!empty($username1) && !empty($password1) && !empty($usertype1)) {
				 $password_hash = SHA1($password1);
				


				try{
			
			
			$stmt=("SELECT id, username, password, usertype FROM users WHERE username = :username  AND password =:password AND usertype = :usertype");
			$stmt = $conn->prepare($stmt);
			$stmt->bindparam(':username', $username1);
			$stmt->bindparam(':password', $password_hash);
			$stmt->bindparam(':usertype', $usertype1);
			$stmt->execute();
			
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			$rows = $stmt->rowCount();
			
					$id =	$result['id'];
					$_SESSION['id']= $id;
					$userid = $_SESSION['id'];
			if ($rows > 0) {
								$userid = $_SESSION['id'];
								
							if ($result['usertype'] === "photographer"){
								header("Location: upload.php.");
								}else if ($result['usertype'] === "member") {
									header("Location:gallery.php");
								}


						}else 
						 {
							 $login1 = "Invalid Username, Password or usertype";
						}
			

				}catch(PDOException $e){
					echo "Error".$e->getmessage();
				}


}
}}}

?>


<?php 



function Dinput($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);

	return $data;
}


function loggedin() {

if (isset($_SESSION['id']) && !empty($_SESSION['id'])){
	 return true;
}else{
	 return false;
}
}

?>


<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
	<title>
		Picture Perfect
	</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="main.css" />
  <link href='http://fonts.googleapis.com/css?family=Philosopher|Courgette' rel='stylesheet' type='text/css'>
  <script src="js/modernizr-1.0.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  
</head>
<body>





<div class = "container">
	<div class = "row" id="bigcall">
	<div class="col-md-8 col-sm-offset-4">
	
		<div class="container" id="first">
			<h1><span class="glyphicon glyphicon-camera "></span> Picture Perfect</h1>
		</div></div>
		<div class="col-md-8 col-md-offset-2">
		<div class="well well-sm" id="well20">
			<h4 id="floatcenter"> Absolutely Free High-resolution Pictures </h4>
		</div>
		<div class="well well-sm" id="well20">
			<h4 id="floatcenter"> Note: Photographers can only upload pictures and Members can only download pictures.  </h4>
		</div>
		</div><!-- offset end-->
		</div>


		<div class = "row" id="forms">
	<div class="col-md-4 col-md-offset-2">
		<div class="well well-lg" id="well20">
			<h3>Login</h3>
			<span class = "error"><?php echo $signup_alert; ?></span>

			<form method= "POST" id="form1" action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<div class="form-group">
      <label for="username">Username:</label>
      <input type="text"  class="form-control" required name ="username1" id="username" value="<?php echo $username1; ?>" placeholder="Enter Username">
    </div>

    
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password"  class="form-control" required name ="password1" id="password" value="<?php echo $password1; ?>" placeholder="Enter password">
    </div>

  <label for = "usertype1">User Type: </label><br />
   
		<label for = "photographer">Photographer</label>
		<input type="radio"  required name="usertype1" id="1" <?php if (isset($usertype1) && $usertype1=="photographer") echo "checked";?> value="photographer">
		<span class = "error"><?php echo $usertype1Err; ?></span>

		<label for = "member">Member</label>
		<input type="radio"  required name="usertype1" id="2" <?php if (isset($usertype1) && $usertype1=="member") echo "checked";?>value="member">
		<span class = "error"><?php echo $usertype1Err; ?></span>

		 <br>

		 <span class = "error"><?php echo $login1; ?></span><br/>
   <button type="submit" name ="login_user" value="login_user" class="btn btn-default">Login</button> </form>
  
		</div><!-- well end--></div>

		<div class="col-md-4 ">
		<div class="well well-lg" id="well20">
			<h3>Sign Up</h3>
			<span class ="error"></span>
			<div style="margin:0 auto;"></div>
			<form method= "POST" id="form2" action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<div class="form-group">
			<span class = "error"><?php echo $signup_alert; ?></span><br />

      <label for="firstname">First Name:</label>
      <input type="text"  class="form-control"  required name="firstname" id="firstname" value="<?php echo $firstname; ?>" placeholder="Enter First Name">
      <span class = "error"> <?php echo $firstnameErr; ?> </span>
    </div>

    <div class="form-group">
      <label for="lastname">Last Name:</label>
      <input type="text"  class="form-control"  required name="lastname" id="lastname" value="<?php echo $lastname; ?>" placeholder="Enter Last Name">
      <span class = "error"> <?php echo $lastnameErr; ?> </span>
    </div>


		<div class="form-group">
      <label for="username">Username:</label>
      <input type="text"  class="form-control"  required name="username" id="username" value="<?php echo $username; ?>" placeholder="Enter Username">
      <span class = "error"> <?php echo $usernameErr; ?> </span>
    </div>

    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email"  class="form-control"  required name="email" id="email" value="<?php echo $email; ?>" placeholder="Enter email">
      <span class = "error"> <?php echo $emailErr; ?> </span>
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password"  class="form-control"  required name="password" id="pwd" value="<?php echo $password; ?>" placeholder="Enter password">
      <span class = "error"> <?php echo $passwordErr; ?> </span>
    </div>

    <div class="form-group">
      <label for="pwd">Confirm Password:</label>
      <input type="password"   required name="passwordAgain" class="form-control" id="pwd" value="<?php echo $passwordAgain; ?>" placeholder="Confirm password">
      <span class = "error"> <?php echo $passwordErr; ?> </span>
    </div>

       <label for = "usertype">User Type: </label><br />
   
		<label for = "photographer">Photographer</label>
		<input type="radio"  required name="usertype" id="1" <?php if (isset($usertype) && $usertype=="photographer") echo "checked";?> value="photographer">
		<span class = "error"> <?php echo $usertypeErr; ?> </span>

		<label for = "member">Member</label>
		<input type="radio"  required name="usertype" id="2" <?php if (isset($usertype) && $usertype=="member") echo "checked";?>value="member">
		<span class = "error"> <?php echo $usertypeErr; ?> </span>
		 <br><br>


   <button type="submit" name ="register_user" value="register_user" class="btn btn-default">Sign Up</button> 
   	</form>
		</div><!-- well end-->

	</div></div>

		

	</div> <!-- end of bigCallout-->

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-sm-2">
					<h4>Copyright &copy; <?php echo date('Y'); ?> Picture Perfect</h4>
				</div>
				<div class="col-sm-4">
					<h4>About Us</h4>
					<p>An Intending Code Machine, with a docile personality. We want to aid the sharing of high resolution pictures of any kind for the use of any individual or organisation and at the same time to do the best we can in assisting you with a drive through memory lane which simply means your pictures or images are stored for your reference, Thank you for using Picture Perfect... Tell a friend or two. </p>
				</div>
				<div class="col-sm-2">
					<h4>Follow us</h4>
					<ul class="unstyled">
					<li><a href="#">Twitter</a></li>
					<li><a href="#">Facebook</a></li>
					<li><a href="#">Google plus</a></li></ul>
				</div>
				<div class="col-sm-2">
					<h4>Contact Us</h4>
					<p>Email: stormmy_70 @yahoo.com <br>
					 Tel: 08066996938 </p>
				</div>
				<div class="col-sm-2">
				<h4>PS:</h4>
					<p>Coded with <span class ="glyphicon glyphicon-heart"></span> by Smith Emmanuel</p>
				</div>
			</div>
		</div>
	</footer>
</body></html>


