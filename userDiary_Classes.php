<?php 

	function calc_meal_totals($result){
	    $breakfast_total = array("cal" => 0, "protein" => 0, "carb" => 0, "fat" => 0);
	    $lunch_total = array("cal" => 0, "protein" => 0, "carb" => 0, "fat" => 0);
	    $dinner_total = array("cal" => 0, "protein" => 0, "carb" => 0, "fat" => 0);
	    $snack_total = array("cal" => 0, "protein" => 0, "carb" => 0, "fat" => 0);
	    $totals      = array("cal" => 0, "protein" => 0, "carb" => 0, "fat" => 0);

	    if ($result->num_rows > 0) {
	        while($row = $result->fetch_assoc()) {
	            if($row["meal"] == "breakfast"){
	            	$breakfast_total["cal"] += $row["Energ_Kcal"];
	                $breakfast_total["carb"] += $row["Carbohydrt_g"];
	                $breakfast_total["fat"] += $row["Lipid_Tot_g"];
	                $breakfast_total["protein"] += $row["Protein_g"];

	                $totals["cal"] += $row["Energ_Kcal"];
	                $totals["carb"] += $row["Carbohydrt_g"];
	                $totals["fat"] += $row["Lipid_Tot_g"];
	               	$totals["protein"] += $row["Protein_g"];

	            }
	            else if($row["meal"] == "lunch"){
	            	$lunch_total["cal"] += $row["Energ_Kcal"];
	                $lunch_total["carb"] += $row["Carbohydrt_g"];
	                $lunch_total["fat"] += $row["Lipid_Tot_g"];
	                $lunch_total["protein"] += $row["Protein_g"];

	                $totals["cal"] += $row["Energ_Kcal"];
	                $totals["carb"] += $row["Carbohydrt_g"];
	                $totals["fat"] += $row["Lipid_Tot_g"];
					$totals["protein"] += $row["Protein_g"];

	            }
	            else if($row["meal"] == "dinner"){
	            	$dinner_total["cal"] += $row["Energ_Kcal"];
	                $dinner_total["carb"] += $row["Carbohydrt_g"];
	                $dinner_total["fat"] += $row["Lipid_Tot_g"];
	                $dinner_total["protein"] += $row["Protein_g"];

	                $totals["cal"] += $row["Energ_Kcal"];
	                $totals["carb"] += $row["Carbohydrt_g"];
	                $totals["fat"] += $row["Lipid_Tot_g"];
	               	$totals["protein"] += $row["Protein_g"];

	            }
	            else if($row["meal"] == "snack"){
	            	$snack_total["cal"] += $row["Energ_Kcal"];
	                $snack_total["carb"] += $row["Carbohydrt_g"];
	                $snack_total["fat"] += $row["Lipid_Tot_g"];
	                $snack_total["protein"] += $row["Protein_g"];

	                $totals["cal"] += $row["Energ_Kcal"];
	                $totals["carb"] += $row["Carbohydrt_g"];
	                $totals["fat"] += $row["Lipid_Tot_g"];
	                $totals["protein"] += $row["Protein_g"];

	            }

	        }
	    }
	    $total_total = array( 
	        array("Breakfast", $breakfast_total["cal"], $breakfast_total["fat"], $breakfast_total["carb"], $breakfast_total["protein"]),
	        array("Lunch", $lunch_total["cal"],$lunch_total["fat"], $lunch_total["carb"], $lunch_total["protein"]),
	        array("Dinner", $dinner_total["cal"],$dinner_total["fat"], $dinner_total["carb"], $dinner_total["protein"]),
	        array("Snack", $snack_total["cal"],$snack_total["fat"], $snack_total["carb"], $snack_total["protein"]),
	        array("Total", $totals["cal"],$totals["fat"], $totals["carb"], $totals["protein"])

	        ); 

	    return $total_total ;
	}

	function print_table($result){
		echo "<div class = 'container'>";

		$carb_total = 0;
		$fat_total = 0;
		$pro_total = 0; 
		$break_count = 0; 
		$lunch_count =0; 
		$dinner_count = 0; 
		$snack_count = 0; 
		$other_count = 0; 

	    if ($result->num_rows > 0) {
	        while($row = $result->fetch_assoc()) {
	            if($row["meal"] == "breakfast"){
	            	if($break_count == 0 ){
		            	?>
		            	<table class="table ">
		            	<h2> Breakfast</h2>
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
				            <th> </th>
				          </tr>
				        </thead>
				        <tbody>
				        	<?php 
				        	$break_count = $break_count + 1; 
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
			                          <td><input type='submit' id='DeleteButton' class='btn btn-default' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value ='Delete'/></td>
			                          </tr>";
			                          $carb_total += $row["Carbohydrt_g"];
			                          $fat_total += $row["Lipid_Tot_g"];
			                          $pro_total += $row["Protein_g"];
			                    }else { //if servings >1 
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
			                          <td><input type='submit' id='DeleteButton' class='btn btn-default' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value = 'Delete'/></td>
			                          </tr>";
			                          $carb_total += $row["Carbohydrt_g"];
			                          $fat_total += $row["Lipid_Tot_g"];
			                          $pro_total += $row["Protein_g"];
		                    }//end else 
	            	}//break_count == 0 
	            	else {
	            		?><tbody><?php
	            		$break_count = $break_count + 1; 
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
		                          <td><input type='submit' id='DeleteButton' class='btn btn-default' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value ='Delete'/></td>
		                          </tr>";
		                          $carb_total += $row["Carbohydrt_g"];
		                          $fat_total += $row["Lipid_Tot_g"];
		                          $pro_total += $row["Protein_g"];
		                    }else { //if servings >1 
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
		                          <td><input type='submit' id='DeleteButton' class='btn btn-default' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value = 'Delete'/></td>
		                          </tr>";
		                          $carb_total += $row["Carbohydrt_g"];
		                          $fat_total += $row["Lipid_Tot_g"];
		                          $pro_total += $row["Protein_g"];
		                    }//end else 
	            	}//break count != 0 (else)
	            }//if meal == breakfast 
	            else if($row['meal'] == "lunch"){
	            	if($lunch_count == 0 ){
		            	?>
		            	<table class="table ">
		            	<h2> Lunch</h2>
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
				        	$lunch_count = $lunch_count + 1; 
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
			                          <td><input type='submit' id='DeleteButton' class='btn btn-default' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value ='Delete'/></td>
			                          </tr>";
			                          $carb_total += $row["Carbohydrt_g"];
			                          $fat_total += $row["Lipid_Tot_g"];
			                          $pro_total += $row["Protein_g"];
			                    }else { //if servings >1 
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
			                          <td><input type='submit' id='DeleteButton' class='btn btn-default' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value = 'Delete'/></td>
			                          </tr>";
			                          $carb_total += $row["Carbohydrt_g"];
			                          $fat_total += $row["Lipid_Tot_g"];
			                          $pro_total += $row["Protein_g"];
		                    }//end else 
	            	}//break_count == 0 
	            	else {
	            		?><tbody><?php
	            		$lunch_count = $lunch_count + 1; 
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
		                          <td><input type='submit' id='DeleteButton' class='btn btn-default' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value ='Delete'/></td>
		                          </tr>";
		                          $carb_total += $row["Carbohydrt_g"];
		                          $fat_total += $row["Lipid_Tot_g"];
		                          $pro_total += $row["Protein_g"];
		                    }else { //if servings >1 
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
		                          <td><input type='submit' id='DeleteButton' class='btn btn-default' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value = 'Delete'/></td>
		                          </tr>";
		                          $carb_total += $row["Carbohydrt_g"];
		                          $fat_total += $row["Lipid_Tot_g"];
		                          $pro_total += $row["Protein_g"];
		                    }//end else 
	            	}//break count != 0 (else)
	            }//if meal == lunch
	            else if($row['meal'] == "dinner"){
	            	if($dinner_count == 0 ){
		            	?>
		            	<table class="table ">
		            	<h2> Dinner Time!</h2>
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
				        	$dinner_count = $dinner_count + 1; 
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
			                          <td><input type='submit' id='DeleteButton' class='btn btn-default' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value ='Delete'/></td>
			                          </tr>";
			                          $carb_total += $row["Carbohydrt_g"];
			                          $fat_total += $row["Lipid_Tot_g"];
			                          $pro_total += $row["Protein_g"];
			                    }else { //if servings >1 
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
			                          <td><input type='submit'  id='DeleteButton' class='btn btn-default' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value = 'Delete'/></td>
			                          </tr>";
			                          $carb_total += $row["Carbohydrt_g"];
			                          $fat_total += $row["Lipid_Tot_g"];
			                          $pro_total += $row["Protein_g"];
		                    }//end else 
	            	}//dinner_count == 0 
	            	else {
	            		?><tbody><?php
	            		$dinner_count = $dinner_count + 1; 
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
		                          <td><input type='submit' id='DeleteButton' class='btn btn-default' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value ='Delete'/></td>
		                          </tr>";
		                          $carb_total += $row["Carbohydrt_g"];
		                          $fat_total += $row["Lipid_Tot_g"];
		                          $pro_total += $row["Protein_g"];
		                    }else { //if servings >1 
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
		                          <td><input type='submit' id='DeleteButton' class='btn btn-default' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value = 'Delete'/></td>
		                          </tr>";
		                          $carb_total += $row["Carbohydrt_g"];
		                          $fat_total += $row["Lipid_Tot_g"];
		                          $pro_total += $row["Protein_g"];
		                    }//end else 
	            	}//break count != 0 (else)
	            }//if meal==dinner 
	            else if($row['meal'] == "snack"){
	            	if($snack_count == 0 ){
		            	?>

		            	<table class="table ">
		            	<h2> Snack!</h2>
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
				        	$snack_count = $snack_count + 1; 
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
			                          <td><input type='submit' id='DeleteButton' class='btn btn-default' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value ='Delete'/></td>
			                          </tr>";
			                          $carb_total += $row["Carbohydrt_g"];
			                          $fat_total += $row["Lipid_Tot_g"];
			                          $pro_total += $row["Protein_g"];
			                    }else { //if servings >1 
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
			                          <td><input type='submit' id='DeleteButton' class='btn btn-default' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value = 'Delete'/></td>
			                          </tr>";
			                          $carb_total += $row["Carbohydrt_g"];
			                          $fat_total += $row["Lipid_Tot_g"];
			                          $pro_total += $row["Protein_g"];
		                    }//end else 
	            	}//dinner_count == 0 
	            	else {
	            		?><tbody><?php
	            		$snack_count = $snack_count + 1; 
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
		                          <td><input type='submit' id='DeleteButton' class='btn btn-default' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value ='Delete'/></td>
		                          </tr>";
		                          $carb_total += $row["Carbohydrt_g"];
		                          $fat_total += $row["Lipid_Tot_g"];
		                          $pro_total += $row["Protein_g"];
		                    }else { //if servings >1 
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
		                          <td><input type='submit' id='DeleteButton' class='btn btn-default' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value = 'Delete'/></td>
		                          </tr>";
		                          $carb_total += $row["Carbohydrt_g"];
		                          $fat_total += $row["Lipid_Tot_g"];
		                          $pro_total += $row["Protein_g"];
		                    }//end else 
	            	}//break count != 0 (else)

	            }//if meal == snack
	            else {         


	            }//end else meal == other 

	        }//while loop
?>



	     
<?php 
    }//if statement


	?>
        </tbody>
    </table>  
    <?php
        echo "Total Carb: ".$carb_total. "<br>";
        echo "Total Pro: ".$pro_total. "<br>";
        echo "Total Fat: ".$fat_total. "<br>";


    ?>

<script> 
			console.log("here2");
/*            document.getElementById("DeleteButton").onclick = function() {myFunction_Del2()};
            function myFunction_Del2(){*/
          $('.btn').click(function() {
                console.log("delete click2");
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
   /*         }*/
          });
            </script>

    <?php    
    }//end function print_table()
    ?>

