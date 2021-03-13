<?php

require_once('../mysqli_connect.php');

$query = "SELECT ShipName, ShipRank, ShipScore FROM ships";

$response = @mysqli_query($dbc, $query);

if($response){
	echo '<table align="left
	cellspacing="5" cellpadding="8">
	
	<tr><td align="left"><b><Ship Name></b></td>
		<td align="left"><b><Ship Rank></b></td>
		<td align="left"><b><Ship Score></b></td></tr>';

		while($row = mysqli_fetch_array($response)){
			
			echo '<tr><td align="left">' .
			$row['ShipName'] . '</td><td align="left">' .
			$row['ShipRank'] . '</td><td align="left">' .
			$row['ShipScore'] . '</td><td align="left">';

			echo '</tr>';
		}
		echo '</table>';
} else {
	echo "Couldn't issue database query";
	echo mysqli_error($dbc);
}
mysqli_close($dbc);

?> 
