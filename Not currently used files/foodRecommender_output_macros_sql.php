<?php 
include('dbConnect.php');
//session_start();
    
?> 

<?php

$carbs = intval($_POST["carbs"]);
$fat   = intval($_POST["fat"]);
$prot  = intval($_POST["protein"]);
echo $carbs;


$sql = "SELECT * FROM mytable WHERE 
		Protein_g BETWEEN $prot AND $prot+1  AND
		Lipid_Tot_g BETWEEN $fat AND $prot+1 AND
		Carbohydrt_g BETWEEN $carbs AND $carbs+1
		";
$result = $conn->query($sql);

exit; 
?>