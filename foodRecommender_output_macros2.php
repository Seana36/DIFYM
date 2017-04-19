<?php 
include('dbConnect.php');
if( isset($_POST['FATTIES']) ){
  $fat = intval($_POST['FATTIES']);
  $carbs = intval($_POST['carbs']); 
  $prot = 10; 


$sql = "SELECT * FROM mytable WHERE 
		Protein_g BETWEEN $prot AND $prot+5  AND
		Lipid_Tot_g BETWEEN $fat AND $fat+5 AND
		Carbohydrt_g BETWEEN $carbs AND $carbs+5
		";
$result = $conn->query($sql);

?>
<body> 
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
                          <td> <input type='submit' class='button' name='".$row["NDB_No"]." ' value='breakfast'  />  <br>
                           <input type='submit' class='button' name='".$row["NDB_No"]." ' value='lunch' />  </td>
                          <td> 
                           <input type='submit' class='button' name='".$row["NDB_No"]." ' value='dinner' /> <br>
                           <input type='submit' class='button' name='".$row["NDB_No"]." ' value='snack'  /> </td>
                          </tr>";
                }
            } else {
                echo "There were no foods with those macros, please try again. ";
            }

            ?>
        </tbody>
    </table>

<script> 
$(document).ready(function(){
  $('.button').click(function() {
    console.log("inside click function"); 
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
});
</script>

 <?php 

 }
else {
  $fat = 100;
  $carbs = 100;
  $prot = 100; 
}
echo "<script> console.log('{Protein}: ".$prot."'); </script>"; 

?>  
