<?php
if(!session_id())
	session_start();

if(isset($_GET['q']))
	$totalTurns = $_GET['q'];
else
	$totalTurns = 10;



if(!isset($_SESSION['turn'])){
	$_SESSION['turn'] = 1;
	$_SESSION['score'] = 0;
}else{
	$_SESSION['turn'] = $_SESSION['turn'] + 1;
	// echo "Turn : " . $_SESSION['turn'];
	if($_SESSION['turn'] <= $totalTurns){
		if(isset($_POST['answerX']) && $_POST['answerX'] == "T"){
			// echo "Correc";
			$_SESSION['score'] = $_SESSION['score'] + 1;
			// echo "Score: " . $_SESSION['score'];
		}

	}else{
		if(isset($_POST['answerX']) && $_POST['answerX'] == "T"){
			// echo "Correc";
			$_SESSION['score'] = $_SESSION['score'] + 1;
			// echo "Score: " . $_SESSION['score'];
		}
		// header('location: testScores.php?score=' . $_SESSION['score']);
		$message = "Your Score: " . $_SESSION['score'];
		include 'showMessage.php';
		// exit();
		echo "<center><br><br><br><h2>Thank you for taking the test.";
		unset($_SESSION['turn']);
		exit();
	}

}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Basic N-Digit Subtraction Test</title>
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

	echo '<div class="container progress">
  <div class="progress-bar progress-bar-striped active progress-bar-info" role="progressbar"
  aria-valuenow="50" aria-valuemin="0" aria-valuemax="' . $totalTurns . '" style="width:' . ($_SESSION['turn']/$totalTurns)*100 . '%">Question No.' . $_SESSION['turn'] . '</div></div>';

?>
	<h2 class=" animated jello">Basic Subtraction Test</h2>
	<p>Required to understand the subtraction of 2-Digit or more than 2-Digit numbers.</p>
	<div class="row text col-lg-5">
		<br><br><br><br><br><br><br><br><br><h1 style="text-align: right">-</h1>
	</div><form method="POST" action="">
	<table class="table responsive table-hover col-lg-7	animated fadeIn" width="100px" style="margin: 50px">
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
	
	<div class="row"><center><button class="btn btn-success btn-lg col-lg-12 animated pulse" type="button" onclick="calculate();" style="width: 200px; height: 300px; margin-top: 50px">Evaluate <br>and<br> Show Answer</button>
	<button class="btn btn-info btn-lg col-lg-12" onclick="setTimeout(this.submit, 5000);calculate()" style="width: 200px; height: 300px; margin-top: 50px; margin-left: 20px">Next Example</button></center></div>
	<div class="row col-lg-12">
            <button class="btn btn-danger btn-lg" type="button" style="margin-left: 90%" onclick="location.href='main.php'">Go Back</button>
            <!-- <p class="text-right"></p> -->
            <input type="text" name="answerX" id="AnswerX" style="visibility: hidden">
        </div>
        </form>
</div>
</center>
<div id="snackbar" style="font-size: 30px; ">Checking your answer..</div>

<script type="text/javascript">
	function toNum(numb) {
		if(numb<10)
			return "0" + numb;
		else
			return numb;
	}

	function showCarry(){
	document.getElementById("c1").style.visibility = "visible";
	document.getElementById("c2").style.visibility = "visible";
	}

	function calculate(){
		var userAns = document.getElementById("Answer").value;
		var snackbar = document.getElementById("snackbar");

    	snackbar.className = "show";
		var message;
		if(userAns == result){
			message = "Correct Answer";
		document.getElementById("AnswerX").value = "T";
			// alert("Correct Answer. You may see the explaination, Or proceed further by pressing 'Next Example'.");
		}else{
			message = "Incorrect Answer. Please see the 'Learn' section on main page.";
		document.getElementById("AnswerX").value = "F";
			// alert("Wrong Answer. Please see the explaination.");
		}
		snackbar.innerHTML = message;
		setTimeout(function(){ snackbar.className = snackbar.className.replace("show", ""); }, 3000);

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

	function next(){
		document.getElementById("c1").style.visibility = "hidden";
		document.getElementById("c2").style.visibility = "hidden";
		document.getElementById("a1").style.visibility = "hidden";
		document.getElementById("a2").style.visibility = "hidden";
		
		// var inputBox = document.createElement("input");
		// inputBox.setAttribute("id", "Answer");
		// inputBox.setAttribute("placeholder", "Answer");
		// inputBox.setAttribute("style", "width: 200px; height: 300px; margin-top: 50px");
		// inputBox.setAttribute("onclick", "calculate()");

		// document.getElementById("a2").appendChild(inputBox);
		// document.getElementById("a2").style.visibility = "visible";
		
		do{
			num1 = parseInt((Math.random()*100000))%100;
			num2 = parseInt((Math.random()*100000))%100;
		}while(num1<num2 || (num1%10<num2%10));
		result = num1 - num2;
		document.getElementById("n1").innerHTML = num1%10;
		document.getElementById("n2").innerHTML = parseInt((num1/10))%10;
		
		document.getElementById("p1").innerHTML = num2%10;
		document.getElementById("p2").innerHTML = parseInt((num2/10))%10;

	}

	// var num1 = parseInt((Math.random()*100000))%100;
	// var num2 = parseInt((Math.random()*100000))%100;
	var num1,num2;
	var result;
	do{
		num1 = parseInt((Math.random()*100000))%100;
		num2 = parseInt((Math.random()*100000))%100;
	}while(num1<num2 || (num1%10<num2%10));
	result = num1 - num2;


	// Level 1 High - Low // No Borrow
	// if(num1<num2){
	// 	var temp = num1;
	// 	num1 = num2;
	// 	num2 = temp;
	// }

	console.log(num1, num2);
	// Level Adv
	// if((num1%10)>(num2%10) && num1>num2{
	// 	var temp = num1;
	// 	num1 = num2;
	// 	num2 = temp;
	// }

	document.getElementById("n1").innerHTML = num1%10;
	document.getElementById("n2").innerHTML = parseInt((num1/10))%10;
	
	document.getElementById("p1").innerHTML = num2%10;
	document.getElementById("p2").innerHTML = parseInt((num2/10))%10;
	

	

	

	// document.getElementById("c1").innerHTML = "0";
	// document.getElementById("c2").innerHTML = "0"
	


	console.log(toNum(10));

</script>

</body>
</html>