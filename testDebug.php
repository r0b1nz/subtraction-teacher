<?php
require_once('functions.php');

if(!session_id())
	session_start();

if(isset($_GET['level'])){
	$_SESSION['level'] = $_GET['level'];
}

if(!isset($_SESSION['level'])){
	$_SESSION['level'] = 1;
	// echo "New Level : " . $_SESSION['level'];
}

if(!levelExists($_SESSION['level'])){
	
	$message = "<h1>You have completed the test, Please start the 2-Digit Basic Subtraction Test";
	include 'showMessage.php';
	exit();
}


if(!isset($_SESSION['requiredTotalQuestions']) || !isset($requiredTotalQuestions)){
	$totalQuestions = getTotalQuestions($_SESSION['level']);
	// echo " . New Total : " . $totalQuestions;
}
if(!isset($_SESSION['max']) || !isset($max)) {
	$max = intval(getMax($_SESSION['level'])); 
	// echo " . New max : " . $max;
}
if(!isset($_SESSION['requiredEfficiency']) || !isset($requiredEfficiency)){
	$requiredEfficiency = getEfficiency($_SESSION['level']);
	// echo " . New eff : " . $requiredEfficiency;
}


// Randomization
if(isset($_SESSION['lastResult'])){
	$result = $_SESSION['lastResult'];
	while($_SESSION['lastResult']==$result){
		// echo "geting.";
		$num1 = rand(0,10000)%$max;
		$num2 = rand(0,10000)%$max;
		if($num1<$num2){
		    $temp = $num1;
		    $num1 = $num2;
		    $num2 = $temp;
		}
		$result = $num1 - $num2;
	}
}else{
	// echo "<h1>Here</h1>";
	$num1 = rand(0,10000)%$max;
	$num2 = rand(0,10000)%$max;
	if($num1<$num2){
		$temp = $num1;
	    $num1 = $num2;
		$num2 = $temp;
	}
	$result = $num1 - $num2;
}

// $num1 = rand(0,9)%$max;
// $num2 = rand(0,9)%$max;
// if($num1<$num2){
//     $temp = $num1;
//     $num1 = $num2;
//     $num2 = $temp;
// }

// $result = $num1 - $num2;
if(isset($_POST['result']) && isset($_SESSION['lastResult'])){
	if(empty($_POST['result'])){
		$ans = NULL;
		// echo "Null";
	}
	else{
		$ans = $_POST['result'];
	}
	if($ans == $_SESSION['lastResult']){
		$_SESSION['correctAns']++;
		echo '<div class = "container" style="padding-top:20px"><div class="alert alert-success fade in">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Success!</strong> Congratulations your answer was correct!
		</div> </div>';
	}else{
		echo '<div class = "container" style="padding-top:20px"><div class="alert alert-danger fade in">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Failed!</strong> Your answer was wrong!
		</div> </div>';
	}
	$_SESSION['lastResult'] = $result;
	$_SESSION['totalQuestions']++;

	// if($_SESSION['totalQuestions'] == $totalQuestions){
	// 	echo "Your test is over. Score: " . ($_SESSION['correctAns']/$_SESSION['totalQuestions'])*100;
	// 	exit();	
	// }

}else{
	require_once('functions.php');
	if(!isset($_SESSION['level']))
		$_SESSION['level'] = 1;
	$_SESSION['lastResult'] = $result;
	$_SESSION['totalQuestions'] = 1;
	$_SESSION['correctAns'] = 0;
	$_SESSION['requiredTotalQuestions'] = getTotalQuestions($_SESSION['level']);
	$_SESSION['max'] = getMax($_SESSION['level']);
	$_SESSION['requiredEfficiency'] = getEfficiency($_SESSION['level']);

	// echo "Hello, First time";
}

// Efficiency
$efficiency = ($_SESSION['correctAns']/$_SESSION['totalQuestions'])*100;
// echo "Efficiency : " . $efficiency;
// echo "cor: " . $_SESSION['correctAns'];
// echo "tot" . $_SESSION['totalQuestions'];

if($_SESSION['totalQuestions'] > $totalQuestions){
	$showQuestionNo = "Test Ended";
}else{
	$showQuestionNo = $_SESSION['totalQuestions'];
}

echo '<div class="container progress">
  <div class="progress-bar progress-bar-striped active progress-bar-info" role="progressbar"
  aria-valuenow="50" aria-valuemin="0" aria-valuemax="' . $totalQuestions . '" style="width:' . ($_SESSION['totalQuestions']/$totalQuestions)*100 . '%">Question No.' . $showQuestionNo . '</div></div>';

 echo '<div class="container progress">
  <div class="progress-bar progress-bar-striped active progress-bar-success" role="progressbar"
  aria-valuenow="50" aria-valuemin="0" aria-valuemax="' . $totalQuestions . '" style="width:' . ($_SESSION['correctAns']/$totalQuestions)*100 . '%">Correct : ' . $_SESSION['correctAns'] . '</div>';

 echo '<div class="progress-bar progress-bar-striped active progress-bar-danger" role="progressbar"
  aria-valuenow="50" aria-valuemin="0" aria-valuemax="' . $totalQuestions . '" style="width:' . (($_SESSION['totalQuestions'] - $_SESSION['correctAns'] - 1)/$totalQuestions)*100 . '%">Incorrect : ' . ($_SESSION['totalQuestions'] - $_SESSION['correctAns'] - 1) . '</div></div>';


// if($_SESSION['totalQuestions'] > $totalQuestions){
// 	if(intval(($_SESSION['correctAns']/($_SESSION['totalQuestions']-1))*100) < $requiredEfficiency){
// 		echo "Try again! Cannot move to next level";
// 	}else{
// 		$_SESSION['level']++;
// 		unset($_SESSION['requiredTotalQuestions']);
// 		unset($_SESSION['max']);
// 		unset($_SESSION['requiredEfficiency']);
// 		// $totalQuestions;
// 		// $mod;
		
// 	}
// }


function refresh_session(){
	$_SESSION['lastResult'] = $result;
	$_SESSION['totalQuestions'] = 1;
	$_SESSION['correctAns'] = 0;
	$_SESSION['requiredTotalQuestions'] = getTotalQuestions($_SESSION['level']);
	$_SESSION['max'] = getMax($_SESSION['level']);
	$_SESSION['requiredEfficiency'] = getEfficiency($_SESSION['level']);
}

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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
	        <h1 class="text-primary bg-primary">Learn how to subtract (Level: <strong><?php echo $_SESSION['level']; ?></strong>)</h1>
	        <div class="jumbotron">
	        <?php
			 	if($_SESSION['totalQuestions'] > $totalQuestions){
					echo '<h2 class="text-primary">Your test is over. <br><strong>Score: ' . intval(($_SESSION['correctAns']/($_SESSION['totalQuestions']-1))*100) . '/100</strong></h2>';
					if(intval(($_SESSION['correctAns']/($_SESSION['totalQuestions']-1))*100) >= $requiredEfficiency){
					echo '	<div class="col-lg-12">
				        	<button class="btn btn-primary btn-lg" onclick="location.reload(true)">Next Level!</button>
				        	<!-- <p class="text-right"></p> -->
				        	</div>';
				    $_SESSION['level']++;
					unset($_SESSION['requiredTotalQuestions']);
					unset($_SESSION['max']);
					unset($_SESSION['requiredEfficiency']);
				    }else{
				    	echo '<h3>Cannot pass Level' . $_SESSION['level'] .  ', Try again</h3>';
				    	unset($_SESSION['requiredTotalQuestions']);
						unset($_SESSION['max']);
						unset($_SESSION['requiredEfficiency']);
						echo '	<div class="col-lg-12">
					        	<button class="btn btn-primary btn-lg" onclick="location.reload(true)">Repeat Level</button>
					        	<!-- <p class="text-right"></p> -->
					        	</div>';
						// refreshSession();

				    }
					exit();	
				}
				?>
	        <h1 class="text-primary animated fadeIn"><?php echo $num1; ?> - <?php echo $num2; ?> = <input type="text" class=" animated fadeIn" name="result" required autofocus></h1>
	        <p><?php echo $num1; ?> Apples - <?php echo $num2; ?> Apple<?php if($num2>1) echo 's'; ?></p>
	        <p class="text-primary">Initially, <strong><?php echo $num1; ?></strong> Apple<?php if($num1>1) echo 's'; ?> are there.
	        <?php
	        	for($i = 0; $i < $num1; $i++){
	        		echo '<img  class="animated zoomIn" src="images/apple.png" alt="Apple" width="40" height="40">';
	        	}
	        ?></p>
	        <p class="text-danger">Mr.Monkey ate <strong><?php echo $num2; ?></strong> Apple<?php if($num2>1) echo 's'; ?>
	        </p>

	        <?php 
	        	for($i = 0; $i < $result; $i++){
	        		echo '<img class="animated zoomIn" src="images/apple.png" alt="Apple" width="40" height="40">';
	        	}
	        	for($i = 0; $i < $num2; $i++){
	        		echo '<img class="animated flash" src="images/appleEaten.png" alt="Apple" width="40" height="40">';
	        	}

	        ?>
	        </div>
	        <div class="row">
	        <div class="col-lg-6">
	        	<button type="submit" class="btn btn-primary btn-lg" style="margin-top: 10px" >Submit</button>
	        	<!-- <p class="text-right"></p> -->
	        </div>
	        <div class="col-lg-3">
	        	<a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="btn btn-success btn-lg" role="button" style="margin-top: 10px">Restart Level</a>
	        </div>
	        <div class="col-lg-3">
            	<button class="btn btn-danger btn-lg" type="button" style="margin-left: 60%; margin-top: 10px" onclick="location.href='main.php'">Go Back</button>
            	<!-- <p class="text-right"></p> -->
        	</div>
	        </div>
        </form> 
    </div>
</body>
</html>