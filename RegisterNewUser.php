<?php

include('dbConnect.php');
$username  = $_POST['username'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
$fName     = $_POST['fName'];
$lName     = $_POST['lName'];
$secQ	   = $_POST['secQ'];
$secA	   = $_POST['secA'];

if($password1 == $password2){
 	$sql = "INSERT INTO User_Info (userName, password, fName, lName, securityQ, securityA) 
 	                     VALUES ('$username', '$password2', '$fName', '$lName', '$secQ', '$secA')  ";
 	if($conn->query($sql) === TRUE){
 		echo "<script><alert>Successfully added new user</alert> </script>";
 		$sql2 = "SELECT userID from User_Info WHERE userName = $userName and password = $password2";
 		include_once('login_check.php'); 
 		header('Location: RegisterNewUser_bodyInfo.html');

 	}
 	else {
 		echo "Error: " . $sql . "<br>" . $conn->error;
 	}

}
else {
	echo "Passwords did not match";
}



?>