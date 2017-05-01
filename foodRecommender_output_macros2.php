<?php 
include('dbConnect.php');
session_start(); 
if( isset($_POST['fat_min']) ){

  if($_POST['fat_min'] > $_POST['fat_max']){
    $fatMin = $_POST['fat_max'];
    $fatMax = $_POST['fat_min'];
  }else{
    $fatMin = $_POST['fat_min'];
    $fatMax = $_POST['fat_max'];

  }
  echo "<script> console.log('{FatMin}: ".$fatMin."'); </script>"; 
  echo "<script> console.log('{FatMax}: ".$fatMax."'); </script>"; 

  $carbs = intval($_POST['carbs']); 
  $prot = 10;
  if(isset($_SESSION['user'])){
    $user = $_SESSION['user']; 
    $sql222 = "SELECT Vegetarian FROM user_pref WHERE userID = $user "; 
    $result2 = $conn->query($sql222);
    if ($result2->num_rows > 0) {
      while($row = $result2->fetch_assoc()) {
        $veggie = $row['Vegetarian']; 
      }
    }

  } else {
    echo "<script> console.log('You are not logged in') </script>";
  }
  

#veggie keywords: pork, shrimp, meat, beef, turkey, chicken, bacon, hamburger, salmon, 

#SELECT * FROM mytable WHERE 
#Protein_g BETWEEN 5 AND 10  AND
#Lipid_Tot_g BETWEEN 5 AND 10 AND 
#Carbohydrt_g BETWEEN 5 AND 10 AND 
#Shrt_Desc NOT LIKE '%MILK%'



if ($veggie == 'Y'){
  echo "<script> console.log('You are a veggie') </script>"; 
  $sql = "SELECT * FROM mytable WHERE 
    Protein_g BETWEEN $prot AND $prot+5  AND
    Lipid_Tot_g BETWEEN $fatMin AND $fatMax AND
    Carbohydrt_g BETWEEN $carbs AND $carbs+5 AND
    Shrt_Desc NOT LIKE '%MEAT%' AND
    Shrt_Desc NOT LIKE '%PORK%' AND
    Shrt_Desc NOT LIKE '%BACON%' AND 
    Shrt_Desc NOT LIKE '%CHICKEN%' AND
    Shrt_Desc NOT LIKE '%HAMBURGER%' AND 
    Shrt_Desc NOT LIKE '%SALMON%' AND 
    Shrt_Desc NOT LIKE '%SHRIMP%' AND 
    Shrt_Desc NOT LIKE '%TURKEY%'
    ";
}
else {
  echo "<script> console.log('You are NOT veggie".$veggie."') </script>";
  $sql = "SELECT * FROM mytable WHERE 
    Protein_g BETWEEN $prot AND $prot+5  AND
    Lipid_Tot_g BETWEEN $fatMin AND $fatMax AND
    Carbohydrt_g BETWEEN $carbs AND $carbs+5
    ";
}
$result = $conn->query($sql);
?>
<body> 
<?php 
  echo "You are searching for fat between: $fatMin and $fatMax. <br>
        You are searching for carbs between: <br>
        You are searching for protein between: ";
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
echo "<script> console.log('{Fat}: ".$fat_min."'); </script>"; 

?>  
