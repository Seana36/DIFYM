<?php 
/*session_start();*/
include('dbConnect.php');

    

$carbs     = intval($_POST["carbs"]);
$fatties   = intval($_POST["fat"]);
$prot  = intval($_POST["protein"]);
echo $carbs;
var_dump($carbs);
var_dump($fatties);
var_dump($prot);


/*$sql = "SELECT * FROM mytable WHERE 
		Protein_g BETWEEN $prot AND $prot+1  AND
		Lipid_Tot_g BETWEEN $fat AND $prot+1 AND
		Carbohydrt_g BETWEEN $carbs AND $carbs+1
		";*/
		$sql = "SELECT * FROM mytable WHERE 
		Protein_g BETWEEN $prot AND $prot+1  AND
		Lipid_Tot_g BETWEEN $fatties AND 3 AND
		Carbohydrt_g BETWEEN $carbs AND $carbs+1
		";
$result = $conn->query($sql);

/*$_SESSION['result1'] = $result; 
*/var_dump($result);
?>
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
<?php
/*header('Location:homepage_table.php'); */

?>

