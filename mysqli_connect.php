 <?php

DEFINE ('DB_USER', 'A-to-B');
DEFINE ('DB_PASSWORD', 'Passw0rd');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'ocean_race');

$dbc = @mysqli_connect(DB_HOST,DB_USER, DB_PASSWORD,DB_NAME)
OR die('could not connect to MySQL' .
	mysqli_connect_error());


?> 