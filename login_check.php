<?php 
session_start(); 

include_once('dbConnect.php');


$userName = test_input($_POST['username']);
$password = test_input($_POST['password']); 	

$sql = "SELECT fName, lName, userID FROM User_info WHERE userID = (SELECT userID FROM User_info WHERE username = '$userName' AND password ='$password')"; 

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$result = $conn->query($sql);
if (!$result){
	header('Location:login.php');
	echo"<p style = 'color:red'>Incorrect login.</p>";
	echo "<script> alert('Login failed please try again');"; 
	/*die("query failed" . $conn->error);*/
}
$entry = $result->fetch_row();
if($entry > 0)
{
	$_SESSION['loggedIn'] = TRUE;
	$_SESSION["name"] = $entry[0] . " " . $entry[1];
	$_SESSION["user"] = $entry[2];
	//echo "<script> console.log('$_SESSION['user']'); </script>";
	header('Location:homepage.php');
}

else
{
	header('Location:login.php');
	echo"<p style = 'color:red'>Incorrect login.</p>";
}


?>