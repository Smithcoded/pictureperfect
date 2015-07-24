<?php 

session_start();
require 'conn.php';
//include "index2.php";
$target_dir = "uploads/";
$uploadOk = 1;
$uploadsuccess = "";
$uploaderror = $uploaderror1 = $uploaderror2 = $uploaderror3 = "";

//check if image file is a fake
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$target_file = checkInput($target_file);
	$imageFiletype = pathinfo($target_file, PATHINFO_EXTENSION);
	$userid = $_SESSION['id'];


if (isset($_POST["submit"])) {

	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	if ($check !== false)	{
		"File is an image -  " . $check["mime"] . " . " . "<br />";
		$uploadOk = 1;
	}else {
		$uploaderror1 = "File is not an image." . "<br />";
		$uploadOk = 0;
	}
}//end of if - submit
//check if already file exists
if (file_exists($target_file)) {
	$uploaderror2 = "Sorry, file already exists." . "<br />";
	$uploadOk =0;
}
//create a thumbnail




//file size limit
if ($_FILES["fileToUpload"]["size"] > 19500000) {
	echo "Sorry, your file is too large." . "<br />";
	$uploadOk =0;
}

//file formats allowed
if ($imageFiletype != "jpg" && $imageFiletype != "png" && $imageFiletype != "jpeg" && $imageFiletype != "gif" ) {
	$uploaderror3 = "Sorry, only JPG, JPEG, PNG & GIF files allowed. " . "<br />";
	$uploadOk = 0;
}

// if ($uploadOk = 1) {
// 	$image = $_FILES["fileToUpload"]["name"];
// 	$uploadedfile = $_FILES["fileToUpload"]["tmp_name"];
// 	$image_type = $_FILES["fileToUpload"]["type"];
// 			if ($image_type == 'image/png' || $image_type == 'image/x-png') {
// 				$src = imagecreatefrompng($uploadedfile);
// 			}else if ($image_type == 'image/gif') {
// 				$src = imagecreatefromgif($uploadedfile);
// 			}else if ($image_type == 'image/jpeg' || $image_type == 'image/jpg' || $image_type == 'image/pjpeg') {
// 				$src = imagecreatefromjpeg($uploadedfile);
// 			}


// 			list($width, $height) = getimagesize($uploadedfile);

// }

//check if uploadOK is set to 0 by an error
if ($uploadOk == 0){
	$uploaderror =  "Sorry, your file was not uploaded" . "<br />";
	
}
//if evertin is ok, try uploading file
else {
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		
					
					
					 $imagename = basename($_FILES["fileToUpload"]["name"]);
					 
					try {

							$stmt=("SELECT id, firstname, lastname  FROM users WHERE id = :id");
							$stmt = $conn->prepare($stmt);
							$stmt->bindparam(':id', $userid);
			
								$stmt->execute();
			
							$result = $stmt->fetch(PDO::FETCH_ASSOC);
								$rows = $stmt->rowCount();
								$firstname = $result['firstname'];
								$lastname = $result['lastname'];
							






						//prepare sql bind parameters
							$stmt=$conn->prepare("INSERT INTO images(userid, imagename, imagepath, firstname, lastname)  VALUES(:userid, :imagename, :imagepath, :firstname, :lastname) " );
		
							$stmt->bindParam(':userid', $userid);
							$stmt->bindParam(':imagename', $imagename);
							$stmt->bindParam(':imagepath', $target_file);
							$stmt->bindParam(':firstname', $firstname);
							$stmt->bindParam(':lastname', $lastname);
							$stmt->execute();

	
							
							$uploadsuccess = "The Image " . basename($_FILES["fileToUpload"]["name"]) . " Has Been Uploaded Successfully." . "<br />";

							}
    						 catch(PDOException $e){

							echo $stmt = $e->getmessage();
							echo "Error:".$e->getmessage();
							}
					
	}else {
		echo "Sorry, there was an error uploading your file" . "<br />";

	}
}
}

function checkInput($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	$data = preg_replace('/\s+/', '', $data);
	
	return $data;
}

?>
<?php 
if (isset($_POST['signout']) && !empty($_POST['signout'])) {
	header("Location: logout.php");
}
?>


<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
	<title>
		Upload image | Picture Perfect
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
<nav class="navbar navbar-fixed-top navbar-default" id = "#top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#" id="flush">Picture Perfect</a>
    </div>
    <!-- Collapse high priority -->
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
       <li><a href="userprofile2.php" id="flush1"><span class="glyphicon glyphicon-picture"></span> My Pictures</a></li>
      
        <li><a href="logout.php" id="flush1"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>

      </ul>
    </div>
  </div>
</nav>





<div class = "container">
	<div class = "row" id="bigcall">
	<div class="col-md-8 col-sm-offset-4">
	
		<div class="container" id="first">
			<h1><span class="glyphicon glyphicon-camera "></span> Picture Perfect</h1>
		</div>

		<!-- <div class="well well-sm" id="well1">
			<h4 id="floatcenter"> Absolutely Free High-resolution Pictures </h4>
		</div> -->
		</div><!-- offset end-->
		</div>


<div class="col-md-8 col-md-offset-2">
<div class="well well-sm" id="well20">
<form action = "upload.php" method="POST" enctype="multipart/form-data">
<h4 id="floatcenter"> Upload Image(s) </h4><br/><br>
<span class="error"> <?php echo $uploadsuccess; ?> </span>
<span class="error"> <?php echo $uploaderror; ?> </span>
<span class="error"> <?php echo $uploaderror1; ?> </span>
<span class="error"> <?php echo $uploaderror2; ?> </span>
<span class="error"> <?php echo $uploaderror3; ?> </span> 

		Select image to upload: <input type="file" name="fileToUpload" id="fileToUpload" multiple="multiple"> <br /><br />
		<button type="submit" name ="submit" value="Upload Image" class="btn btn-default">Upload Image</button> 
		<br /><br /><br /><br />
		
		
		</form></div></div>
		</div>
		</body></html>
