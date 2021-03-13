<?php

require_once('../mysqli_connect.php');

$query = "SELECT ShipName, ShipRank, ShipScore FROM ships";

$response = @mysqli_query($dbc, $query);

$myObj;

if($response){
$rows = array();
		while($row = mysqli_fetch_array($response)){
		$rows[] = $row;
		}
		
		$myJSON = Json_encode($rows);
		
		echo $myJSON;
} else {
	echo "Couldn't issue database query";
	echo mysqli_error($dbc);
}
mysqli_close($dbc);

?> 
