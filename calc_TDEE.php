<html>


<head>

<?php 
session_start(); 
include_once('isLoggedIn.php');
$weight = $_SESSION['user_weight']; 
$height = $_SESSION['user_height'];
$age = $_SESSION['user_age'];  
#echo $weight; 

?>

</head>

<body> 
<?php 
if(isset($_GET["REE"]) ){
	$REE = $_GET["REE"] ;
}
#echo "<br>";
if(isset($_GET["TDEE"]) ){
	$TDEE = $_GET["TDEE"] ;
}
#echo "<br>";
if(isset($_GET["weight"]) ){
	$weight = $_GET["weight"] ;
}

	 
?>


<form action="results_TDEE.php" method="post">
	<div class ="form-group">
		Weight (lbs): <input type="text" name="weight" value = <?php echo "$weight" ?>>
	</div>
	<div class ="form-group">
		Height(Inches): <input type="text" name="height" value = <?php echo "$height" ?> >
	</div>
	<div class ="form-group">
		Age: <input type="text" name="age" value = <?php echo "$age" ?> >
	</div>
	<div class="checkbox">
	 	<label>
	    	<input type="checkbox" value="1.2" name="activityLevel"> Sedetary 
	    </label>
	</div>
	<div class="checkbox">
	 	<label>
	    	<input type="checkbox" value="1.375" name="activityLevel"> Light Activity 
	    </label>
	</div>
	<div class="checkbox">
	 	<label>
	    	<input type="checkbox" value="1.55" name="activityLevel"> Moderate Acctivity 
	    </label>
	</div>
	<div class="checkbox">
	 	<label>
	    	<input type="checkbox" value="1.725" name="activityLevel"> Very Active 
	    </label>
	</div>
	<div class ="form-group">
		<input type="submit" class = "page-scroll btn btn-default btn-xl sr-button" value="Submit">
	</div>
</form>

<?php 
	if(isset($_GET["REE"]) ){ 
?>
	Your REE is: <?php echo $REE ?> <br>
	Your TDEE is: <?php echo $TDEE ?> <br>
	Meaning that in order to lose weight you should eat: <?php echo ($TDEE - ($TDEE * 0.20) )?> <br>
	Meaning that in order to gain weight you should eat: <?php echo ($TDEE + ($TDEE * 0.20) )?> <br>

	<?php 
	//Calculating Macros Here
	echo $TDEE; 
	$protein = $weight * 0.825;
	echo $protein . "<br>";
	$fat = (($TDEE * 0.25) / 9);
	echo $fat . "<br>";
	$pro_cal = $protein * 4;
	echo $pro_cal . "<br>";
	$fat_cal = $fat * 9; 
	echo $fat_cal . "<br>";
	$new_cal = $TDEE - $pro_cal - $fat_cal;
	echo $new_cal . "<br>";
	$carb = ($new_cal / 4); 
	echo $carb . "<br>";
	$total_cal = ($pro_cal * 4 ) + ($fat_cal * 9) + ($carb);
	echo $total_cal . "<br>";

?> 
<?php 
} 
?>

</body>
</html>