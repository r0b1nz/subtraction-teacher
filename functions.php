<?php


function levelExists($level){

	include('config.php');
	$sql = "select * from levels where level = $level";
	$retval = $conn->query($sql);
	if($retval->num_rows<=0){
		return false;
	}else{
		return true;
	}
}

function getMax($level){
	include('config.php');
	$sql = "select max from levels where level = $level";
	$retval = $conn->query($sql);
	$row = $retval->fetch_assoc();
	// echo "Returned max : " . $row['max'];
	return $row['max'];
}

function getTotalQuestions($level){
	include('config.php');
	$sql = "select totalquestions from levels where level = $level";
	$retval = $conn->query($sql);
	$row = $retval->fetch_assoc();
	return $row['totalquestions'];
}

function getEfficiency($level){
	include('config.php');
	$sql = "select efficiency from levels where level = $level";
	$retval = $conn->query($sql);
	$row = $retval->fetch_assoc();
	return $row['efficiency'];
}

?>