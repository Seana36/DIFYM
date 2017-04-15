<?php 
session_start(); 


$weight = $_POST['weight'];
$height = $_POST['height'];
$age = $_POST['age'];
$activityLevel = $_POST['activityLevel'] ;
/*if( isset($_POST['activityLevel'] )) {
	$activityLevel = intval($_POST['activityLevel']);	
}else {
	$activityLevel = 1; 
}*/
echo $activityLevel;
 

$REE = 66 + (6.2 * $weight) + (12.7 * $height) - (6.76 * $age); 

$TDEE = $REE * $activityLevel; 

header('Location:calc_BMI.php?REE='.$REE.'&TDEE='.$TDEE.'&weight='.$weight);


?>