<html>

<head>



</head>

<body> 
<?php 
if(isset($_GET["BMR"]) ){
	$BMR = $_GET["BMR"] ;
	echo $BMR; 
}
	 
?>


<form action="results_BMI.php" method="post">
	<div class ="form-group">
		Weight (lbs): <input type="text" name="weight">
	</div>
	<div class ="form-group">
		Height(Inches): <input type="text" name="height">
	</div>
	<div class ="form-group">
		Age: <input type="text" name="age">
	</div>
	<div class ="form-group">
		<input type="submit" class = "page-scroll btn btn-default btn-xl sr-button" value="Submit">
	</div>
</form>



</body>
</html>