<?php 
session_start(); 


$weight = $_POST['weight'];
$height = $_POST['height'];
$age = $_POST['age'];

$BMR = 66 + (6.2 * $weight) + (12.7 * $height) - (6.76 * $age); 



header('Location:calc_BMI.php?BMR='.$BMR);


?>