<?php 

	session_start(); 

	if(isset($_POST['weight']) ){ 

	$weight = $_POST['weight'];
	$height = $_POST['height'];
	$age = $_POST['age'];
	$activityLevel = doubleval($_POST['activityLevel'] );

	$REE = 66 + (6.2 * $weight) + (12.7 * $height) - (6.76 * $age); 

	$TDEE = $REE * $activityLevel; 
	$gain_TDEE = $TDEE + ($TDEE * 0.20);
	$lose_TDEE = $TDEE - ($TDEE * 0.20);

	echo "Your REE is:  $REE <br>
	Your TDEE is: $TDEE <br>
	Meaning that in order to lose weight you should eat: $gain_TDEE <br>
	Meaning that in order to gain weight you should eat: $lose_TDEE <br>"; 

	$protein = $weight * 0.825;
	$fat = (($TDEE * 0.25) / 9);
	$pro_cal = $protein * 4;
	$fat_cal = $fat * 9; 
	$new_cal = $TDEE - $pro_cal - $fat_cal;
	$carb = ($new_cal / 4); 
	$total_cal = ($pro_cal ) + ($fat_cal ) + ($carb);

	?>
	<table class = 'table table-bordered sortable'>
	  <tr>
	    <th>Calories</th>
	    <th>Fat (grams)</th>
	    <th>Carbs (grams)</th>
	    <th>Protein (grams) </th>
	  </tr>
	  <tr>
	    <td><?php echo number_format($TDEE,2) ?></td>
	    <td><?php echo number_format($fat,2) ?></td>
	    <td><?php echo number_format($carb,2)?></td>
	    <td><?php echo number_format($protein,2)?></td>
	  </tr>
	</table>

	<?php 
	if(isset($_SESSION['user'])){ ?>
		<div class ='form-group'>
		Save these macros 
			<input type='submit' id = 'SubmitMacros' class = 'page-scroll btn btn-default btn-xl sr-button' value='Save_Macros'>
		</div>

		<script>
		document.getElementById("SubmitMacros").onclick = function() {myFunction_Macros()};
		function myFunction_Macros(){
		    console.log('myfunction');
		    var cal = <?php json_encode($TDEE) ?>; 
		    var fat = <?php json_encode($fat) ?>; 
		    var carb = <?php json_encode($carb) ?>; 
		    var prot = <?php json_encode($protein) ?>; 
		    $.ajax({
		          url: "saveMacrostoDB.php",
		          type: "POST",
		          data: { 'cal':cal,
		                  'fat':fat,
		                  'carb':carb,
		                  'prot':prot 
		                }
		        }).done(function( msg ) {
		            alert(msg);
		        });
		    }
		</script>
	<?php }	//if isset 
	else {
		echo "user not logged in rn";
	}
	?>


	<?php  
	}
	else {
		echo "WEight is not set";
	}
?>
