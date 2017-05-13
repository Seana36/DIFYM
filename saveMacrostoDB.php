<?php 
include('dbConnect.php');
session_start(); 

if(isset($_SESSION['user'])){
	$user = $_SESSION['user']; 

	if(isset($_POST['fat'])){
		$fat = $_POST['fat'];
		$carb = $_POST['carb'];
		$prot = $_POST['prot']; 
		$cal = $_POST['cal']; 

	$sql = "UPDATE user_body 
			SET goal_cal = $cal, 
				goal_fat = $fat,
    			goal_carb = $carb,
    			goal_prot = $prot
			WHERE userID = $user";
	if ($conn->query($sql) === TRUE) {
		echo "Successfully updated your goals";
	} 
	else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}


	}//isset fat
	else{
		echo "Fat is not set";
	}
}//isss user set 
else {
	echo "You must be logged in to complete this action"; 
}

?> 