<?php 
session_start(); 

include_once('dbConnect.php');

$userName = $_POST['username'];
$password = $_POST['password']; 

$sql = "SELECT fName, lName, userID FROM User_info WHERE userID = (SELECT userID FROM User_info WHERE username = '$userName' AND password ='$password')"; 
$result = $conn->query($sql);
if (!$result){
	die("query failed" . $conn->error);
}
$entry = $result->fetch_row();
if($entry > 0)
{
	$_SESSION['loggedIn'] = TRUE;
	$_SESSION["name"] = $entry[0] . " " . $entry[1];
	$_SESSION["user"] = $entry[2];
	//echo "<script> console.log('$_SESSION['user']'); </script>";
	header('Location:homepage_table.php');
}

else
{
	header('Location:login.php');
	echo"<p style = 'color:red'>Incorrect login.</p>";
}


?>