<?php 

include('dbConnect.php');
session_start(); 
$height 		= $_POST['height'];
$cur_weight 	= $_POST['cur_weight'];
$goal_weight 	= $_POST['goal_weight'];
$goals 			= $_POST['goals'];
$age 			= $_POST['age'];

$keto			= $_POST['keto'];
$veggie			= $_POST['veggie'];
$allergies		= $_POST['allergies'];
$other			= $_POST['other'];
echo $keto. "<br>";
echo $veggie. "<br>";
echo $allergies. "<br>";
echo $other. "<br>";

include_once('isLoggedIn.php');
/*
"INSERT INTO User_Body (userID, height, current_weight, goal_weight, goals, age) 
		VALUES ($user, $height, $cur_weight, $goal_weight, '$goals', $age  );
		INSERT INTO User_Pref (userID, Keto, Vegetarian, Allergies, Other) 
		VALUES ($user, '$keto', '$veggie', '$allergies', '$other');
		";*/

$sql = "INSERT INTO User_Pref (userID, Keto, Vegetarian, Allergies, Other) 
		VALUES ($user, '$keto', '$veggie', '$allergies', '$other');
		";
$sql2 = "INSERT INTO User_Body (userID, height, current_weight, goal_weight, goals, age) 
		 VALUES ($user, $height, $cur_weight, $goal_weight, '$goals', $age  )"; 
if($conn->query($sql) === TRUE){
	if($conn->query($sql2) === TRUE){
		echo "Successfully added new user INFORMATION";
	}
}
else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}

?>