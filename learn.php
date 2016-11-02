<?php
if(!session_id())
	session_start();






//if(!isset($_SESSION['basicLevel']))
//    $_SESSION['basicLevel'] = 1;
//if($_SESSION['basicLevel'] == 10)
//    $_SESSION['basicLevel'] = 1;
//echo "Before : " . $_SESSION['basicLevel'];
//$_SESSION['basicLevel'] = intval($_SESSION['basicLevel']) + 1;
$num1 = 0;
$num2 = 0;

//echo "/After Level : " . $_SESSION['basicLevel'];
//$num1 = rand(0,10)%($_SESSION['basicLevel']);
//$num2 = rand(0,10)%($_SESSION['basicLevel']);
$num1 = rand(0,10);
$num2 = rand(0,10);

if(!isset($_SESSION['firstTime'])){
    $_SESSION['firstTime'] = false;
    $num1 = 2;
    $num2 = 1;
}

if($num1<$num2){
    $temp = $num1;
    $num1 = $num2;
    $num2 = $temp;
}
    


$result = $num1 - $num2;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Learn subtraction</title>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
  	<script src="js/jquery.min.js"></script>
  	<script src="js/bootstrap.min.js"></script>
    <style type="text/css">
        body{




background: #70e1f5; /* fallback for old browsers */
background: -webkit-linear-gradient(to left, #70e1f5 , #ffd194); /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to left, #70e1f5 , #ffd194); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-primary bg-primary" style="background-color: rgba(27, 71, 190, 0.15); color: #0368b2">Learn how to subtract <strong>(Basics)</strong></h1>
        <div class="jumbotron ">
        <h1 class="text-primary  animated fadeIn"><?php echo $num1; ?> - <?php echo $num2; ?> = <?php echo $result; ?></h1>
        <p><?php echo $num1; ?> Apples - <?php echo $num2; ?> Apple<?php if($num2>1) echo 's'; ?> = <?php echo $result; ?> Apple<?php if($result>1) echo 's'; ?></p>
        <p class="text-primary">Initially, <strong><?php echo $num1; ?></strong> Apple<?php if($num1>1) echo 's'; ?> are there.
        <?php
        	for($i = 0; $i < $num1; $i++){
        		echo '<img class="animated zoomIn" src="images/apple.png" alt="Apple" width="40" height="40">';
        	}
        ?></p>
        <p class="text-danger">Mr.Monkey ate <strong><?php echo $num2; ?></strong> Apple<?php if($num2>1) echo 's'; ?>
        </p>

        <?php 
        	for($i = 0; $i < $result; $i++){
        		echo '<img class="animated zoomIn" src="images/apple.png" alt="Apple" width="40" height="40">';
        	}
        	for($i = 0; $i < $num2; $i++){
        		echo '<img  class="animated flash " src="images/appleEaten.png" alt="Apple" width="40" height="40">';
        	}

        ?>
        </div>
        <div class="row col-lg-6">
            <button class="btn btn-primary btn-lg" onclick="location.reload(true)">Next</button>
            <!-- <p class="text-right"></p> -->
        </div>
        <div class="row col-lg-6">
            <button class="btn btn-info btn-lg" style="margin-left: 90%" onclick="location.href='main.html'">Go Back</button>
            <!-- <p class="text-right"></p> -->
        </div>
    </div>
</body>
</html>