<?php
if(!session_id())
	session_start();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Subtration Teacher</title>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/snack.css">
    <link rel="stylesheet" href="css/animate.css">
  	<script src="js/jquery.min.js"></script>
  	<script src="js/bootstrap.min.js"></script>
	<style type="text/css">
	body{
		background: #7b4397; /* fallback for old browsers */
		background: -webkit-linear-gradient(to left, #7b4397 , #dc2430); /* Chrome 10-25, Safari 5.1-6 */
		background: linear-gradient(to left, #7b4397 , #dc2430); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        
/*        background: linear-gradient(137deg, #000000, #ff0000, #18ff00);*/
/*background-size: 600% 600%;*/

	}		

        
	</style>
</head>

<body>
<div class="container animated fadeIn">
  <div class="jumbotron" style="margin: 20px; background: linear-gradient(to left, rgba(59, 22, 77, 0.35) , rgba(139, 24, 31, 0.76)); box-shadow: 2px 30px 40px #000000">
      <center><h1 style="color: rgb(66, 229, 155); text-shadow: 2px 2px 20px #000000">Learn Subtraction</h1></center> 
    <p style="color: rgb(99, 156, 248); text-shadow: 4px 6px 20px #000000">This is an online platform for learning and testing your subtraction skills. You may take various levels of tests or Learn subtraction freshly from the basics.</p> 
  </div>

	<div class="row" style="margin: 20px;">
		<div class="col-sm-4  bg-primary animated fadeIn" style="background-color: rgba(55, 85, 116, 0.21); box-shadow: 2px 20px 50px #000000; border-radius: 20px 0px 0px 20px">
			<h2>Intelligent Learning</h2>
			<p>
				<a href="hillClimb.php" style="color: #ffffff"> <h3>Practice & Learn</h3> </a>
				<a href="hillClimbKmeans.php?kmeans" style="color: #ffffff"> <h3>Practice & Learn</h3> (Experimental)</a> 
			</p>
		</div>
		<div class="col-sm-4 bg-success animated fadeIn" style=" box-shadow: 2px 20px 50px #000000; border-radius: 0px 0px 0px 0px; z-index:1">
			<h2>Learn</h2>
			<p>
				<a href="learn.php"> <h3>Single Digit Subtraction</h3> </a>
				<a href="advSub.html"> <h3>Basic Two Digit Subtraction</h3> </a>
				<a href="advSub2.html"> <h3>Advance Two Digit Subtraction</h3> </a>

			</p>
		</div>
		<div class="col-sm-4 animated fadeIn" style="background-color: rgba(85, 76, 65, 0.31); box-shadow: 2px 20px 50px #000000; border-radius: 0px 20px 20px 0px; z-index:0">
            <h2 style="color: #deabab"><strong>Test</strong></h2>
			<p>
				<a href="testDebug.php" style="color: #ffffff"> <h3>Single Digit</h3> </a>
				<a href="testadv.php?q=4" style="color: #ffffff"> <h3>Basic Two Digit</h3> </a>
				<a href="testadv2.php?q=4" style="color: #ffffff"> <h3>Advance Two Digit</h3> </a>

			</p>
		</div>

	</div>
</div>
</body>
</html>