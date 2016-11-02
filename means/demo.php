<?php

if(!session_id())
	session_start();

// $p = array(8,2);
// echo kNear($p);

function kNear($ptx){
// include the library
require_once "src/KMeans/Space.php";
require_once "src/KMeans/Point.php";
require_once "src/KMeans/Cluster.php";

$newPoint = $ptx;
// $newPoint = array(8,2);
// x->Level
// y->Wrong Attempts
// z->Correct Attempts - Later
$jsLevel = 4;
$points = array();
$totalClusters = count($_SESSION['report']['wrong']);
for($i=1; $i<20; $i++){
	if(isset($_SESSION['report']['wrong'][$i])){
		$temp = array($i, $_SESSION['report']['wrong'][$i]);
		// echo "(" . $i . "," . $_SESSION['report']['wrong'][$i] . ") ";
		array_push($points, $temp);
		// echo $points[0];
	}

}

// $temp = array(1,2,3);
// array_push($temp, $points);
// array_push(array(1,2), $points);

// create a 2-dimentions space
$space = new KMeans\Space(2);

// add points to space
foreach ($points as $coordinates)
	$space->addPoint($coordinates);

// cluster these 50 points in 3 clusters
$clusters = $space->solve($totalClusters);

// display the cluster centers and attached points
$newPoint = array(8,2);
$minDist = 1000000;
$nearestCluster;
$maxAttempts = 0;
$maxAttemptsCluster;
foreach ($clusters as $point) {
	// echo $point[0] . "-" . $point[1] . "<br>";
}

$map = array();
// echo count($map);

foreach ($clusters as $i => $cluster){
	// printf("<br>Cluster %s {%d,%d}: %d points\n", $i, $cluster[0], $cluster[1], count($cluster));
	
	if($maxAttempts<$cluster[1]){
		$maxAttempts = $cluster[1];
		$maxAttemptsCluster = $i;
	}

	if($newPoint[0] == $cluster[0]){
		array_push($map, 0);
		continue;
	}

	$euDistance = euDist($newPoint, $cluster);
	array_push($map, $euDistance);
	if($euDistance < $minDist){
		$minDist = $euDistance;
		$nearestCluster = $i;
	}
}

// 4 nearest neighbours
// see which one has most attmepts
// go to that

//4 loops
//in each loop, eliminate the nearest

$nearestMapIndex = array();
$minDist = 10000000;
$minDistIndex;
for($x=0; $x<4; $x++){
	$minDist = 100000000;
	$minDistIndex = -1;
	foreach ($clusters as $i => $cluster) {
		// foreach ($nearestMapIndex as $nearestIndex) {
		// 	echo "<br>$i->=" . $nearestIndex;
		// }
		// echo "<br>Searching $i in array\n";
		$goforward = true;
		foreach ($nearestMapIndex as $nearestIndex) {
			if($nearestIndex == $i){
				$goforward = false;
			}
		}
		if($goforward == false)
			continue;


		$dist = euDist($newPoint, $cluster);
		if($dist < $minDist){
			$minDist = $dist;
			$minDistIndex = $i;
			// echo "<br> set index=" . $i;
			if(array_search($minDistIndex, $nearestMapIndex)==null){
				array_push($nearestMapIndex, $minDistIndex);
				// echo "<br>added";
			}
	}
		}

		foreach ($nearestMapIndex as $nearestIndex) {
			// echo "<br>->=" . $nearestIndex;
		}

	
	// echo "Index:" . $minDistIndex;

	// echo "<hr><br><br>";
}


foreach ($nearestMapIndex as $nearestIndex) {
	// echo "<br>." . $nearestIndex;
}
// If attempts> Take it
$bestNeighbourIndex;
$bestNeighbourAttempts = 0;
foreach ($nearestMapIndex as $nearestIndex) {

	if($clusters[$nearestIndex][1]>$bestNeighbourAttempts){
		$bestNeighbourAttempts = $clusters[$nearestIndex][1];
		$bestNeighbourIndex = $nearestIndex;
	}

}

// echo "<h2>Best Neighbour: " . $bestNeighbourIndex  ;
return $clusters[$bestNeighbourIndex][0];
}



// echo "<br>Nearest graph Cluster: " . $nearestCluster . "<br>";
// echo "Maximum attempt cluster" . $maxAttemptsCluster . "<br>";
// $nearestPoint = array($clusters[$nearestCluster][0],$clusters[$nearestCluster][1]);


function euDist($pt1, $pt2){
	return ($pt1[0]-$pt2[0])*($pt1[0]-$pt2[0]) + ($pt1[1]-$pt2[1])*($pt1[1]-$pt2[1]);
}

?>