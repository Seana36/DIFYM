<script src="js/sortable.js"></script>
<?php 
include('dbConnect.php');


if( isset($_POST["cal_min"]) ){

	if($_POST['cal_min'] > $_POST['cal_max']){
	    $cal_min = $_POST['cal_max'];
	    $cal_max = $_POST['cal_min'];
	}else{
	    $cal_min = intval($_POST["cal_min"]);
		$cal_max = intval($_POST["cal_max"]);
	}


$sql = "SELECT * FROM mytable WHERE 
		Energ_Kcal BETWEEN $cal_min AND $cal_max 
		ORDER BY Energ_Kcal, Protein_g ASC, Carbohydrt_g DESC
		";
$result = $conn->query($sql);
?> 
<!-- <div class = "container"> -->
You are searching for Calories between <?php echo $cal_min ?> and <?php echo $cal_max ?> grams. <br>  
	<table class="table table-striped sortable">
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
			        	   <input type='submit'  class='button' name='".$row["NDB_No"]." ' value='dinner' /> <br>
			        	   <input type='submit'  class='button' name='".$row["NDB_No"]." ' value='snack' /> </td>
			        	  </tr>";
			    }
			} else {
			    echo "0 results";
			}

			?>
		</tbody>
	</table>
<!-- </div> -->
<script> 
/*document.getElementById("clickbutton").onclick = function() {myFunction()};
*/ $('.button').click(function() {
	/*function myFunction(){*/
 	var id = $(this).attr('name');
 	var meal = $(this).attr('value');
/* 	console.log('click the button ' + id);
 	console.log('click the button2 ' + meal);*/
	 $.ajax({
	  type: "POST",
	  url: "addto_UserDiary.php",
	  data: { 'ID':id ,
			  'meal' : meal}
	}).done(function( msg ) {
	  alert( "Data Saved: " + msg);
	});   
/*	} */

});
</script>
<?php 
} //end isset(session[calories])
?>