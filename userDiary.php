<?php 
include('dbConnect.php');
session_start();
include_once('isLoggedIn.php');
$user = $_SESSION['userID'];
    
?> 

<html> 
<head>
	<!-- <?php #header("Refresh:10; "); ?> -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>


<body>
Hello World, its the User Diary Page! 
<br> 


<?php


$sql = "SELECT  *
		FROM userdiary u,mytable t 
		WHERE u.NDB_No = t.NDB_No AND u.userID = $user
		";
$result = $conn->query($sql);
print_table($result); 
$result = $conn->query($sql);
$total_total = calc_meal_totals($result);

for($row = 0; $row < 3; $row++){
	echo "<ul>";
	for($col = 0; $col < 4; $col++){
		echo "<li>".$total_total[$row][$col]."</li>";
	}
	echo "</ul>";
}


function calc_meal_totals($result){
	$breakfast_total = array("protein" => 0, "carb" => 0, "fat" => 0);
	$lunch_total = array("protein" => 0, "carb" => 0, "fat" => 0);
	$dinner_total = array("protein" => 0, "carb" => 0, "fat" => 0);
	$snack_total = array("protein" => 0, "carb" => 0, "fat" => 0);

	if ($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()) {
	    	if($row["meal"] == "breakfast"){
	    		$breakfast_total["carb"] += $row["Carbohydrt_g"];
	    		$breakfast_total["fat"] += $row["Lipid_Tot_g"];
	    		$breakfast_total["protein"] += $row["Protein_g"];
	    	}
	    	else if($row["meal"] == "lunch"){
	    		$lunch_total["carb"] += $row["Carbohydrt_g"];
	    		$lunch_total["fat"] += $row["Lipid_Tot_g"];
	    		$lunch_total["protein"] += $row["Protein_g"];
	    	}
	    	else if($row["meal"] == "dinner"){
	    		$dinner_total["carb"] += $row["Carbohydrt_g"];
	    		$dinner_total["fat"] += $row["Lipid_Tot_g"];
	    		$dinner_total["protein"] += $row["Protein_g"];
	    	}

	    }
	}
	$total_total = array( 
		array("Breakfast", $breakfast_total["fat"], $breakfast_total["carb"], $breakfast_total["protein"]),
		array("Breakfast", $lunch_total["fat"], $lunch_total["carb"], $lunch_total["protein"]),
		array("Breakfast", $dinner_total["fat"], $dinner_total["carb"], $dinner_total["protein"]),
		); 

	return $total_total ;
}
?>

<?php
function print_table($result){
?>
<div class = "container">
	<table class="table table-striped">
		<thead>
	      <tr>
	        <th>Item ID</th>
	        <th>Description</th>
	        <th>Meal </th>
	        <th>Calories </th>
	        <th>Fat </th>
	        <th>Carb </th>
	        <th>Protein </th>
	        <th>Date </th>
	        <th>Servings </th>
	      </tr>
    	</thead>
   		<tbody>
			<?php
			$carb_total = 0;
			$fat_total = 0;
			$pro_total = 0; 

			if ($result->num_rows > 0) {
			    // output data of each row
			    while($row = $result->fetch_assoc()) {
			    	if($row["servings"] > 1){
			    		$servings = $row["servings"];
			    		echo "<tr>
			        	  <td>" . $row["NDB_No"]. "</td>
			        	  <td>" . $row["Shrt_Desc"]."</td>
			        	  <td>" . $row["meal"]. "</td>
			        	  <td>" . (floatval($row["Energ_Kcal"]) * $servings). "</td>
			        	  <td>" . (floatval($row["Lipid_Tot_g"]) * $servings). "</td>
			        	  <td>" . (floatval($row["Carbohydrt_g"]) * $servings). "</td>
			        	  <td>" . (floatval($row["Protein_g"]) * $servings). "</td>
			        	  <td>" . $row["date"]. "</td> 
			        	  <td>" . $row["servings"]. "</td> 
			        	  <td><input type='submit' class='button' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value ='Delete'/></td>
			        	  </tr>";
			        	  $carb_total += $row["Carbohydrt_g"];
			        	  $fat_total += $row["Lipid_Tot_g"];
			        	  $pro_total += $row["Protein_g"];
			    	}else {
			        echo "<tr>
			        	  <td>" . $row["NDB_No"]. "</td>
			        	  <td>" . $row["Shrt_Desc"]."</td>
			        	  <td>" . $row["meal"]. "</td>
			        	  <td>" . $row["Energ_Kcal"]. "</td>
			        	  <td>" . $row["Lipid_Tot_g"]. "</td>
			        	  <td>" . $row["Carbohydrt_g"]. "</td>
			        	  <td>" . $row["Protein_g"]. "</td>
			        	  <td>" . $row["date"]. "</td> 
			        	  <td>" . $row["servings"]. "</td> 
			        	  <td><input type='submit' class='button' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value = 'Delete'/></td>
			        	  </tr>";
			        	  $carb_total += $row["Carbohydrt_g"];
			        	  $fat_total += $row["Lipid_Tot_g"];
			        	  $pro_total += $row["Protein_g"];
			       	}
			    }
			} else {
			    echo "0 results";
			}

			?>
		</tbody>
	</table>
	<?php
		echo "Total Carb: ".$carb_total. "<br>";
		echo "Total Pro: ".$pro_total. "<br>";
		echo "Total Fat: ".$fat_total. "<br>";
	}//end function
	?>
</div>


<script> 
$('.button').click(function() {
 	//var clickBtnValue = $(this).val();
 	var id = $(this).attr('name');
 	var meal = $(this).attr('value1');
	 $.ajax({
	  type: "POST",
	  url: "removeFrom_UserDiary.php",
	  data: { 'foodID':id ,
			  'meal' : meal}
	}).done(function( msg ) {
	  alert( "Data Saved: " + msg );
	});    
	location.reload();
});
</script>

</body>
</html>