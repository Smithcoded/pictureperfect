
<?php
session_start();


if (!loggedin()){
require 'conn.php';

$firstnameErr = $lastnameErr = $passwordErr  $emailErr = $usernameErr = $usertypeErr = "";
$firstname = $lastname = $username =$password = $passwordAgain = $email = $usertype = "";

if(isset($_REQUEST['submit'])!='') {


if ($_SERVER['REQUEST_METHOD'] == "POST") {

	if(empty($_POST['firstname'])){
		$firstnameErr = "First name is required";

	}else if(isset($_POST['firstname'])){
		$firstname = Dinput($_POST['firstname']);
	

		if(!preg_match("/^[a-zA-Z ]*$/",$firstname)){
			$firstnameErr = "Only letters and white spaces allowed";
		}}
	

	 
	if(empty($_POST['lastname'])){
		$lastnameErr = "Last name is required";

	}else if(isset($_POST['lastname'])) {
		$lastname = Dinput($_POST['lastname']);
	

		if(!preg_match("/^[a-zA-Z ]*$/",$lastname)){
			$lastnameErr = "Only letters and white spaces allowed";
		}}

		if(empty($_POST['username'])){
		$usernameErr = "Username is required";

	}else if(isset($_POST['username'])){
		$username = Dinput($_POST['username']);
	}
	

	
	if(empty($_POST['password'])){
		$passwordErr = 'Password is required... Enter Password';

	}else if ($_POST['password'] != $_POST['passwordAgain']){
		echo "<h2>Passwords do not match<h2>";
	}
		if(isset($_POST['password'])){
		$password = SHA1(Dinput($_POST['password']));
	}

   if (empty($_POST["email"])) {
     $emailErr = "Email is required";

   } else if(isset($_POST['email'])){
     $email = Dinput($_POST["email"]);
     
     // check if e-mail address is well-formed
     
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $emailErr = "Invalid email format"; 
   }
   	}
   
   if(isset($_POST['usertype'])){
		$usertype = Dinput($_POST['usertype']);
	
   $date = date("jS \of F, Y.");

	//database and all 

try{
	 	// check if email address exists
	 $stmt= ("SELECT email FROM user WHERE email = :email ");
		
			$stmt = $conn->prepare($stmt);
	 		$stmt->bindparam(':email', $email);
	 		$stmt->execute();
	 		$rows = $stmt->rowCount();

	 		if ($rows > 0) {
	 				echo "<h1> Email Address Already Exists, Try Another! </h1>";
	 				}else{
	


		//prepare sql bind parameters
		$stmt=$conn->prepare("INSERT INTO user(firstname, lastname,  email, username, password, usertype, date) VALUES(:firstname, :lastname, :username, :email, :password, :usertype, :date)");
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
		echo "Succcessful";
		//header('Location: login.php');;
	}else{
		echo "Sorry, we could not register you owing network issues, Try Again.";
	}
}}
catch(PDOException $e){
	
	//display error msg
	echo "Error:".$e->getmessage();

}
}
}
}else{
	header('Location: main.php');
}
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
<html>

<head>
	<title>Welcome to Loopy!</title>
	<meta charset=utf-8>
	<link rel="stylesheet" href="loopy.css" />
</head>
<body>
<div>

<h1>Sign Up to Loopy!</h1>



<h2> Sign Up</h2>
<p><span class ="error">* Required field. </span></p>
<div style="margin:0 auto;"/> 
<form method= "POST" id="forrm" action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
First Name: <input type="text" required name="firstname" value="<?php echo $firstname; ?>">
<span class = "error">* <?php echo $firstnameErr; ?></span> <br><br>

Last Name: <input type="text" required name="lastname" value="<?php echo $lastname; ?>">
<span class = "error">* <?php echo $lastnameErr; ?></span> <br><br>

Username: <input type="text" required name="username" value="<?php echo $username; ?>">
<span class = "error">* <?php echo $usernameErr; ?></span> <br><br>

 E-mail: <input type="email" required name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span> <br><br>

Password : <input type="password" required name="password" value="<?php echo $passwordAgain; ?>">
<span class = "error">* <?php echo $passwordErr; ?></span> <br><br>

Password Again: <input type="password" required name="passwordAgain" value="<?php echo $passwordAgain; ?>">
<span class = "error">* <?php echo $passwordErr; ?></span> <br><br>

User Type:
   <input type="radio" required name="usertype" <?php if (isset($usertype) && $usertype=="female") echo "checked";?>  value="1">Photographer<br><br>
   <input type="radio" required name="usertype" <?php if (isset($usertype) && $usertype=="male") echo "checked";?>  value="2">Member
   <span class="error">* <?php echo $usertypeErr;?></span>
   <br><br>
   <input type="submit" name="submit" value="Submit"> 


</form>
</div>
</body>
</html>
