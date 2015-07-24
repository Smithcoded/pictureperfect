<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
	<title>
		Gallery | Picture Perfect
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
      <li><a href="userprofile.php" id="flush1"><span class="glyphicon glyphicon-picture"></span> My Pictures</a></li>
      <li><a href="#top" id="flush1"><span class="glyphicon glyphicon-chevron-up"></span> Back to top</a></li>
        <li><a href="logout.php" id="flush1"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
        
        
      </ul>
    </div>
  </div>
</nav>







<div class = "container">
	<div class = "row" id="bigcall">
	<div class="col-sm-4 col-sm-offset-4">
	
		<div class="container" id="first">
			<h1><span class="glyphicon glyphicon-camera "></span> Picture Perfect</h1>
		</div></div>
		<div class="col-sm-12">
		<div class="well well-sm"  id="well20" >
			<h4 id="floatcenter"> Absolutely Free High-resolution Pictures </h4>
		</div></div>
		</div><!-- offset end-->
		
<body>

<div class="container">


<?php 
require 'conn.php';
try {


	$stmt=("SELECT imagepath, imagename, firstname, lastname  FROM images ORDER BY id DESC ");
			$stmt = $conn->prepare($stmt);
			$stmt->execute();
			
			($result = $stmt->fetchAll(PDO::FETCH_ASSOC));
			foreach ($result as $row) {
				

				$imagepath = $row['imagepath'];
				$imagepath;
				$imagename = $row['imagename'] ;
				$imagename;
				$firstname = $row['firstname'];
				$lastname = $row['lastname'];

?> 
</div></div>


<div class = "container" >
<div class = "row" id= "features">
<div class = "col-sm-12"  id ="feature">
<div class = "panel"  "width:1200px; height:960px" id="link"> 
<div class = "panel-heading">
<h3 class="panel-title"  id= "centered"> Click on image to download</h3>
<span id = "feature"><?php echo $imagename . " / By " . ucfirst($firstname) . " " . ucfirst($lastname)    ?></span>
</div>


		  
			<?php $width = 'width:1100px';
			$height = 'height:960px';
			 $responsive = "class='img-responsive'";
			 $thumbnail = "'thumbnail' ";
			$target = "target='_blank'";


			 echo "<a href =" . $imagepath . " " . $target . ">";
				echo "<img alt = " .  $imagename. "   src=" . $imagepath . " " . $responsive . " " .  $thumbnail. " style= " . $width . "  " . $height . " ; />";
				echo "</a>";
			//echo "<img alt = " .  $imagename. "  src =" . $imagepath . ">";?>

<?php
			
		}}
		catch(PDOException $e){
					echo "Error".$e->getmessage();
				}

?>



</div>

</div>

</div>

</div>




</body>
</html>

