<?php
$user_name = $_GET['user'];
$password = $_GET['pass'];
$string1=$user_name;
$string2=$password;
$connection = db_connect();
header('icecast-auth-user: 0');
$sql = "SELECT user_name, password FROM Listeners";
$result = $connection->query($sql);
if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
		echo "user_name: " . $row["user_name"]. " - password: " . $row["password"], "<br>";
		if (strcmp($string1, $row['user_name']) && strcmp($string2, $row['password'])) header('icecast-auth-user: 1');
	}
} else {
	echo "0 results";
}
mysqli_close($connection);
function db_connect()
{
	$db_hostname = 'localhost';
	$db_username = 'root';
	$db_password = '***';
	$db_database = 'PrivateRadio';
	$connection = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
	if ($connection->connect_error) {
		die("Connection failed: " . $connection->connect_error);
	}
	return $connection;
}
?>
