<html>

<!-- 
Source for Macro Creation: 
https://healthyeater.com/how-to-calculate-your-macros 

-->
    <!-- Load Ajax - Sean -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>

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
	echo $TDEE ." TDEE <br>"; 
	echo $weight . " Weight<br> ";
	$protein = $weight * 0.825;
	echo $protein . " Protein<br>";
	$fat = (($TDEE * 0.25) / 9);
	echo $fat . " FAT <br>";
	$pro_cal = $protein * 4;
	echo $pro_cal . " PROT Cal <br>";
	$fat_cal = $fat * 9; 
	echo $fat_cal . " Fat Cal<br>";
	$new_cal = $TDEE - $pro_cal - $fat_cal;
	echo $new_cal . " New Cal<br>";
	$carb = ($new_cal / 4); 
	echo $carb . " Carb<br>";
	$total_cal = ($pro_cal ) + ($fat_cal ) + ($carb);
	echo $total_cal . " Total Cal <br>";

?> 


<table>
  <tr>
    <th>Calories</th>
    <th>Fat (grams)</th>
    <th>Carbs (grams)</th>
    <th>Protein (grams) </th>
  </tr>
  <tr>
    <td><?php echo $total_cal; ?></td>
    <td><?php echo $fat; ?></td>
    <td><?php echo $carb; ?></td>
    <td><?php echo $protein; ?></td>
  </tr>
</table>
<!-- <form action="saveMacrostoDB.php" method="post"> -->
	<div class ="form-group">
	Save these macros 
		<input type="submit" id = "SubmitMacros" class = "page-scroll btn btn-default btn-xl sr-button" value="Save_Macros">
	</div>
<!-- </form> -->

<?php 



} //if isset()
?>
<script> 

document.getElementById("SubmitMacros").onclick = function() {myFunction()};

function myFunction(){
	/*console.log("Fat: " + $fat);*/ 
	var fat = <?php echo json_encode($fat); ?>;
	var carb = <?php echo json_encode($carb); ?>;
	var prot = <?php echo json_encode($protein); ?>;
	var cal = <?php echo json_encode($TDEE); ?>;
	console.log("Fat2: " + fat); 
	$.ajax({
	      url: "saveMacrostoDB.php",
	      type: "POST",
	      data: { 'fat': fat,
	      		  'carb': carb, 
	      		  'prot': prot,
	      		  'cal' : cal 
	            }
	    }).done(function( msg ) {
	    	console.log(msg); 
/*	    $('#macroDiv span').empty();    
	      $("#macroDiv").show();
	      $(msg).appendTo('#macroDiv span') ;*/
	    });
	}
</script>

</body>
</html>