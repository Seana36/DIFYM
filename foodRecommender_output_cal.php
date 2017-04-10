<?php 
include('dbConnect.php');
//session_start();
    
?> 


<?php

$cal = intval($_POST["calories"]);



$sql = "SELECT * FROM mytable WHERE 
		Energ_Kcal BETWEEN $cal AND $cal+1 
		ORDER BY Energ_Kcal, Protein_g DESC, Carbohydrt_g DESC
		";
$result = $conn->query($sql);
?> 
<div class = "container">
You are searching for Calories between <?php echo $cal ?> and <?php echo $cal+1 ?> grams. <br>  
	<table class="table table-striped">
		<thead>
	      <tr>
	        <th>ID</th>
	        <th>Name</th>
	        <th>Calories </th>
	        <th>Protein</th>
	        <th>Carbs</th>
	        <th>Fat </th>
	        <th>Add To:  </th>
	        <th> </th>
	      </tr>
    	</thead>
   		<tbody>
			<?php

			if ($result->num_rows > 0) {
			    // output data of each row
			    while($row = $result->fetch_assoc()) {
			        echo "<tr>
			        	  <td>" . $row["NDB_No"]. "</td>
			        	  <td>" . $row["Shrt_Desc"]."</td>
			        	  <td>" . $row["Energ_Kcal"]. "</td>
			        	  <td>" . $row["Protein_g"]. "</td>
			        	  <td>" . $row["Carbohydrt_g"]. "</td>
			        	  <td>" . $row["Lipid_Tot_g"]. "</td>
			        	  <td> <input type='submit' class='button' name='".$row["NDB_No"]." ' value='breakfast' />  <br>
			        	   <input type='submit' class='button' name='".$row["NDB_No"]." ' value='lunch' />  </td>
			        	  <td> 
			        	   <input type='submit' class='button' name='".$row["NDB_No"]." ' value='dinner' /> <br>
			        	   <input type='submit' class='button' name='".$row["NDB_No"]." ' value='snack' /> </td>
			        	  </tr>";
			    }
			} else {
			    echo "0 results";
			}

			?>
		</tbody>
	</table>
</div>
<script> 
 $('.button').click(function() {
 	//var clickBtnValue = $(this).val();
 	var id = $(this).attr('name');
 	var meal = $(this).attr('value');
	 $.ajax({
	  type: "POST",
	  url: "addto_UserDiary.php",
	  data: { 'ID':id ,
			  'meal' : meal}
	}).done(function( msg ) {
	  alert( "Data Saved: " + msg );
	});    

});
</script>
