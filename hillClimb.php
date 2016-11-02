<?php
if(!session_id())
	session_start();

if(isset($_GET['report'])){
	include 'report.php';
	exit();
}


$totalTurns = 1000;

$message = NULL;
$isCorrect = false;
$levelUpg = NULL;
$changeInLevel;
// $IA = true;

if(isset($_REQUEST['setLevel'])){
	$_SESSION['level'] = $_REQUEST['setLevel'];
	header("location: " . $_SERVER['PHP_SELF']);
}

if(isset($_GET['reset'])){
	unset($_SESSION['turn']);
	header("location: " . $_SERVER['PHP_SELF']);
}

if(isset($_REQUEST['IA']) && $_REQUEST['IA'] == true){
	$_SESSION['IA'] = true;
}
else{
	$_SESSION['IA'] = false;
}



$IA = $_SESSION['IA'];

if(!isset($_SESSION['turn'])){
	$_SESSION['turn'] = 1;
	$_SESSION['score'] = 0;
	$_SESSION['level'] = 1;
	$_SESSION['levelInc'] = 3;
	$_SESSION['report'] = array();
	$_SESSION['report']['wrong']  =array();
	$_SESSION['report']['correct'] = array();
	echo '<script type="text/javascript"> var level = 1; var score = 0; var levelInc = ' . $_SESSION['levelInc'] . '; var showIA = false;</script>';
}else{



	if(isset($_POST['returningLevelX']) && ($_POST['returningLevelX'])!=0){

		$_SESSION['level'] = $_POST['returningLevelX'];
		
		// echo "JS: " . $_SESSION['level'] . " ";

		if(!isset($_SESSION['report']['wrong'][$_SESSION['level']]))
			$_SESSION['report']['wrong'][$_SESSION['level']] = 1;
		else
			$_SESSION['report']['wrong'][$_SESSION['level']]++;

		if($IA == true){
			$maxWrong = 0;
			$maxWrongIndex = NULL;
			
			for($z=1; $z<=$_SESSION['level']; $z++){
				if(isset($_SESSION['report']['wrong'][$z]) && $_SESSION['report']['wrong'][$z]>$maxWrong){
					$maxWrong = $_SESSION['report']['wrong'][$z];
					$maxWrongIndex = $z;
				}
			}

			echo "Max Wrong: " . $maxWrong . " - Index sugegsred: " . $maxWrongIndex . "<br>";

			if($maxWrong >= $_SESSION['report']['wrong'][$_SESSION['level']]){
				$_SESSION['level'] = $maxWrongIndex;
				// echo "IA Level: " . $_SESSION['level'];
			}
		}


		echo "New Level: " . $_SESSION['level'];
		$levelUpg = "Level Degraded to Level: " . $_SESSION['level'];
	}

	echo '<script type="text/javascript"> var level = ' . $_SESSION['level'] . '; var score = ' . $_SESSION['score'] . '; var levelInc = ' . $_SESSION['levelInc'] . '; var showIA = false;</script>';

	if(array_sum($_SESSION['report']['wrong']) > 3){
		echo '<script type="text/javascript"> showIA = true; </script>';
	}

	$_SESSION['turn']++;
	
	echo "Turn : " . $_SESSION['turn'] . " Level: " . $_SESSION['level'] . "Other:<br>";
	
	if($_SESSION['turn'] <= $totalTurns){
		if(isset($_POST['answerX']) && ($_POST['answerX'] == "T")){
			$isCorrect = true;
			$_SESSION['score']++;
			echo " Posted : " . $_SESSION['score'];
			echo '<script type="text/javascript"> score = ' . $_SESSION['score'] . ';</script>';
			$message = "Correct answer ";
			if($_SESSION['score']%$_SESSION['levelInc'] == 0){
				if(!isset($_SESSION['report']['correct'][$_SESSION['level']]))
					$_SESSION['report']['correct'][$_SESSION['level']] = 1;
				else
					$_SESSION['report']['correct'][$_SESSION['level']]++;
				$_SESSION['level']++;
				echo '<script type="text/javascript"> level = ' . $_SESSION['level'] . '; score = ' . $_SESSION['score'] . ';</script>';
				echo "Level Updated: " . $_SESSION['level'];
				$levelUpg = $levelUpg . "Congratualtions, You entered to Level: " . $_SESSION['level'];
			}
		}else if(isset($_POST['answerX']) && ($_POST['answerX'] == "F")){
				$message = "Oops wrong answer, Lets try another one" . $message;
		}
	}else{
		echo "Test is over, Your Score: " . $_SESSION['score'];
		unset($_SESSION['turn']);
		exit();
	}

}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Hill Climb</title>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/snack.css">
    <link rel="stylesheet" href="css/animate.css">
  	<script src="js/jquery.min.js"></script>
  	<script src="js/bootstrap.min.js"></script>

  	<style type="text/css">
  		body{


			background-color: #fff; 
			background-image: 
			linear-gradient(90deg, transparent 79px, #abced4 79px, #abced4 81px, transparent 81px),
			linear-gradient(#eee .1em, transparent .1em);
			background-size: 100% 1.2em;
  		}
  		.table { width: 100px;
  				 overflow; 
  				 hidden;
  				}
  		th{
			font-size: 20px;
  		}
  		td{
			font-size: 30px;
  		}
  	</style>

</head>
<body>
<center>
<div class="container" style="padding: 50px">

	<?php
		if($message!=NULL){		
			echo '<div class="alert alert-info animated fadeIn">';
			echo '<strong>' . $message . '!</strong>';
			echo '</div>';
		}	
	?>


	
	<?php 
		if($levelUpg != NULL){
			if($isCorrect == true){
				echo '<div class="alert alert-success animated zoomInUp">';
			}
			else{
				echo '<div class="alert alert-danger animated flash">';
			}

			if($levelUpg!=NULL) echo "<strong>" . $levelUpg . "!</strong>" ;			
			}

	 ?>
  	
	</div>
	<form action="" method="POST">
	<h2>Learn and Grow</h2>
	<p>Your current Level: <?php echo $_SESSION['level'];  ?></p>
	<p>Your level will change according to your answering patterns</p>
	<p><div class="checkbox" name="IA" id="IA" style="visibility: hidden"><label>
	<?php 
		if(isset($_SESSION['IA']) && $_SESSION['IA'] == true)
			echo '<input type="checkbox" name="IA" checked> ';
		else
			echo '<input type="checkbox" name="IA"> ';
	 ?>
	<strong>Intelligent suggestions </strong></label></div> 
	<strong><a href="?report" target="_blank">Analysis Report</a></strong></p>
	<div class="row text col-lg-5">
		<br><br><br><br><br><br><br><br><br><h1 style="text-align: right">-</h1>
	</div>
	<table class="table responsive table-hover col-lg-7	" width="100px" style="margin: 50px">
		<thead>
			<tr>
				<th>10's Digit</th>
				<th>Unit Digit</th>
			</tr>
		</thead>
		<tbody>
			<tr class="danger">
				<td id="c2" style="visibility: hidden">
					<!-- c2 -->
				</td>
				<td id="c1" style="visibility: hidden">
					<!-- c1 -->
				</td>
			</tr>
			<tr class="primary">
				<td id="n2"> <!-- style=" text-decoration: line-through;"> -->
					<!-- n2 -->
				</td>
				<td id="n1">
					<!-- n1 -->
				</td>
			</tr>
			<tr class="primary" style="border-bottom: 3px solid #000;"">
				<td id="p2">
					<!-- p2 -->
				</td>
				<td id="p1">
					<!-- p1 -->
				</td>
			</tr>
			<tr class="success">
				<td id="a2" style="visibility: visible">
					<input type="text"  name="answer" id="Answer" style="width: 40px" placeholder="Answer" autofocus>
				</td>
				<td id="a1" style="visibility: hidden">
					<!-- a1 -->
				</td>
			</tr>

		</tbody>
	</table>
	
	<div class="row"><center><button class="btn btn-success btn-lg col-lg-12" type="button" onclick="calculate();" style="width: 200px; height: 300px; margin-top: 50px">Evaluate <br>and<br> Show Answer</button>
	<button class="btn btn-info btn-lg col-lg-12" onclick="setTimeout(this.submit, 5000);calculate()" style="width: 200px; height: 300px; margin-top: 50px; margin-left: 20px">Next Example</button></center></div>
	<div class="row col-lg-12">
            <button class="btn btn-danger btn-lg" type="button" style="margin-left: 90%" onclick="location.href='main.php'">Go Back</button>

			<input type="text"  name="answerX" id="AnswerX" style="visibility: hidden;">
			<input type="text"  name="returningLevelX" id="ReturningLevelX" value="0" style="visibility: hidden;">

            <!-- <p class="text-right"></p> -->
            </div>

        </div>
</div>
</center>
<div id="snackbar" style="font-size: 30px; ">Checking your answer..</div>

<script type="text/javascript">


	function calculate(){
		var userAns = document.getElementById("Answer").value;
		var snackbar = document.getElementById("snackbar");

    	snackbar.className = "show";
		var message;
		if(userAns == result){
			message = "Correct Answer";
		document.getElementById("AnswerX").value = "T";
		}else{
			message = "Wrong Answer. Please see the explaination.";
		document.getElementById("AnswerX").value = "F";

		var returningLevel = 1;
		for(var i=1; i<=level; i++){
			if(num2>(i*2))
				continue;
			returningLevel = i;
			break;
		}

		document.getElementById("ReturningLevelX").value = returningLevel;

		console.log("Returning to : " + returningLevel);


		}
		snackbar.innerHTML = message;
		setTimeout(function(){ snackbar.className = snackbar.className.replace("show", ""); }, 3000);
		setAnswers();

	}

	function setAnswers(){
		document.getElementById("a1").innerHTML = (num1-num2)%10;
		document.getElementById("a2").innerHTML = parseInt(((num1-num2)/10))%10;
		document.getElementById("a1").style.visibility = "visible";
		document.getElementById("a2").style.visibility = "visible";
		if((num1%10)<(num2%10)){
			document.getElementById("c1").innerHTML = "1" + num1%10;
			document.getElementById("c2").innerHTML = parseInt(num1/10)%10 - 1;
		}else{
			document.getElementById("c2").innerHTML = "0";	
			document.getElementById("c1").innerHTML = "0";
		}
		document.getElementById("c1").style.visibility = "visible";
		document.getElementById("c2").style.visibility = "visible";
	}

	function hideAnswers(){
		document.getElementById("c1").style.visibility = "hidden";
		document.getElementById("c2").style.visibility = "hidden";
		document.getElementById("a1").style.visibility = "hidden";
		document.getElementById("a2").style.visibility = "hidden";
		
	}

	function setNewQuestion(){
		var mod1 = level*2;
		console.log("Mod1: " + mod1);
		var mod2 = level*4;
		// var levelInc = 3;

		var lowerMultiplexer = mod1/levelInc;
		var minNum2 = 0;
		var maxNum2 = mod1-1;


		if(level>5){
			for(var z=0; z<levelInc; z++){
				if(score%levelInc!=z)
					continue;
				console.log("Level 0." + (z+1));
				minNum2 = lowerMultiplexer*z;
				maxNum2 = lowerMultiplexer*(z+1);
				break;
			}
		}

		console.log("MinNum2: " + minNum2);
		console.log("MaxNum2: " + maxNum2);

		do{
			num1 = parseInt((Math.random()*100000))%mod1;
			num2 = parseInt((Math.random()*100000))%100;


		}while(num1<num2 || (num1%10<num2%10) || num1==0 || num1<(mod1/2) || num2<minNum2 || num2>maxNum2 || (level>5 && num1==num2));
		result = num1 - num2;
		document.getElementById("n1").innerHTML = num1%10;
		document.getElementById("n2").innerHTML = parseInt((num1/10))%10;
		
		document.getElementById("p1").innerHTML = num2%10;
		document.getElementById("p2").innerHTML = parseInt((num2/10))%10;
	}

	function next(){
		hideAnswers();
		setNewQuestion();
	}

	var num1,num2;
	var result;
		
	setNewQuestion();
	if(showIA == true){
		document.getElementById("IA").style.visibility = "visible";
	}
	document.getElementById("Answer").value = result;

	console.log(num1, num2);
	console.log(num1-num2);
	console.log("LeveL: " + level);
	console.log("Score: " + score);
</script>

</body>
</html>