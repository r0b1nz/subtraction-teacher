
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
			 <?php echo $message; ?>
		</h1>
	</div>
	<center>
	<div class="jumbotron " style="padding: 30px; margin: 100px; width: 400px">
		<h2>
			<center><a href="main.php">Main Page</a></center>
		</h2>
	</div>
	</center>
</div>

</body>
</html>