<head>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
</head>
<?php 
/*session_start();*/
include('dbConnect.php');

    

$carbs     = intval($_POST["carbs"]);
$fat       = intval($_POST["fats"]);
$prot      = intval($_POST["protein"]);
var_dump($carbs);
var_dump($fat);
var_dump($prot);


$sql = "SELECT * FROM mytable WHERE 
		Protein_g BETWEEN $prot AND $prot+1  AND
		Lipid_Tot_g BETWEEN $fat AND $fat+1 AND
		Carbohydrt_g BETWEEN $carbs AND $carbs+1
		";
$result = $conn->query($sql);

/*$_SESSION['result1'] = $result; 
*/var_dump($result);
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


    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/creative.min.js"></script>
</body>