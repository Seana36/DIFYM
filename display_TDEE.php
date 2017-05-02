<?php 


	if(isset($_POST['weight']) ){ 

	$weight = $_POST['weight'];
	$height = $_POST['height'];
	$age = $_POST['age'];
	$activityLevel = intval($_POST['activityLevel'] );

	$REE = 66 + (6.2 * $weight) + (12.7 * $height) - (6.76 * $age); 

	$TDEE = $REE * $activityLevel; 
	$gain_TDEE = $TDEE + ($TDEE * 0.20);
	$lose_TDEE = $TDEE - ($TDEE * 0.20);

	echo "Your REE is:  $REE <br>
	Your TDEE is: $TDEE <br>
	Meaning that in order to lose weight you should eat: $gain_TDEE <br>
	Meaning that in order to gain weight you should eat: $lose_TDEE <br>"; 

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
	<table class = 'table table-bordered sortable'>
	  <tr>
	    <th>Calories</th>
	    <th>Fat (grams)</th>
	    <th>Carbs (grams)</th>
	    <th>Protein (grams) </th>
	  </tr>
	  <tr>
	    <td><?php echo $total_cal ?></td>
	    <td><?php echo $fat ?></td>
	    <td><?php echo $carb?></td>
	    <td><?php echo $protein?></td>
	  </tr>
	</table>
		<div class ='form-group'>
		Save these macros 
			<input type='submit' id = 'SubmitMacros' class = 'page-scroll btn btn-default btn-xl sr-button' value='Save_Macros'>
		</div>

	<?php  
	}
	else {
		echo "WEight is not set";
	}
?>