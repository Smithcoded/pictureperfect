
<!DOCTYPE html>
<html lang="en">
<head>
	<title>
		Upload image | Picture Perfect
	</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="main.css" />
  <link href='http://fonts.googleapis.com/css?family=Philosopher|Courgette' rel='stylesheet' type='text/css'>

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
        <li><a href="logout.php" id="flush1"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
        
      </ul>
    </div>
  </div>
</nav>





<div class = "container">
	<div class = "row" id="bigcall">
	<div class="col-md-4 col-md-offset-4">
	
		<div class="container" id="first">
			<h1><span class="glyphicon glyphicon-camera "></span> Picture Perfect</h1>
		</div>

		<!-- <div class="well well-sm" id="well1">
			<h4 id="floatcenter"> Absolutely Free High-resolution Pictures </h4>
		</div> -->
		</div><!-- offset end-->
		</div>


<div class="col-md-4 col-md-offset-4">
<div class="well well-sm" id="well20">
<form action = "upload.php" method="POST" enctype="multipart/form-data">
<h4 id="floatcenter"> Upload Image(s) </h4><br/><br>
		Select image to upload: <input type="file" name="fileToUpload" id="fileToUpload" multiple="multiple"> <br /><br />
		<button type="submit" name ="submit" value="Upload Image" class="btn btn-default">Upload Image</button> 
		<br /><br /><br /><br />
		
		<a href="logout.php"><button type="btn" name ="signout" value="signout" class="btn btn-danger">Sign Out</button> </a>
		</form></div></div>
		</div>
		</body></html>
		




