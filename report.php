<?php

if(isset($_REQUEST['score']))
	$score = $_REQUEST['score'];
else
	$score = 0;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Score card</title>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
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
<body><center>
<div class="container">
	<div class="jumbotron " style="padding: 30px; margin: 50px">
		<h1>
			Level by Level Analysis
		</h1>
	</div>
	<center>
	<div class="jumbotron " style="padding: 30px; margin: 100px;">
		<h2>
			<center>
			<?php

				for($i=1; $i<20; $i++){
					if(isset($_SESSION['report']['wrong'][$i]))
							echo '<div class="container progress">
  <div class="progress-bar progress-bar-striped active progress-bar-danger" role="progressbar"
  aria-valuenow="50" aria-valuemin="0" aria-valuemax="10" style="width:' . $_SESSION['report']['wrong'][$i]*10 . '%">Level' . ($i) . ' , Wrong attempts: '. $_SESSION['report']['wrong'][$i] . '</div></div>';
				}
				for($i=1; $i<20; $i++){
					if(isset($_SESSION['report']['correct'][$i]))
							echo '<div class="container progress">
  <div class="progress-bar progress-bar-striped active progress-bar-success" role="progressbar"
  aria-valuenow="50" aria-valuemin="0" aria-valuemax="10" style="width:' . $_SESSION['report']['correct'][$i]*10 . '%">Level' . ($i) . ' , Correct attempts: '. $_SESSION['report']['correct'][$i] . '</div></div>';
				}

			?>
			</center>
		</h2>
	</div>
		<center>
	<div class="jumbotron " style="padding: 30px; margin: 100px; width: 400px">
		<h2>
			<center><a href="main.php">Main Page</a></center>
		</h2>
	</div>
	</center>

	</center>
</div>

</body>
</html>