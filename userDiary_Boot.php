<?php 
include('dbConnect.php');
session_start();
?> 
<!DOCTYPE html>
<html lang="en">

<head>

<!-- Need these for the drop down menu -->
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
  <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


	<!-- Latest compiled and minified JavaScript -->
	 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!--^^^^Need these for the drop down menu^^^^^ -->


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Creative - Start Bootstrap Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/creative.min.css" rel="stylesheet">



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">DIFYM</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php 
                if(isset($_SESSION['user'])){
                    include_once('navBars/nav_loggedIn.html');
                }else{
                    include_once('navBars/nav_NotloggedIn.html');
                }

            ?>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <?php
if(isset($_SESSION['user'])){
$user = $_SESSION['user'];	

    ?>

    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1 id="homeHeading">Your Favorite Source of Free Bootstrap Themes</h1>
                <hr>
                <p>Start Bootstrap can help you build better websites using the Bootstrap CSS framework! Just download your template and start going, no strings attached!</p>
                <a href="#about" class="btn btn-primary btn-xl page-scroll">Find Out More</a>
            </div>
                            <!-- Display Drop down  -->
                  <div class="dropdown">
				    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" >Month
				    <span class="caret"></span></button>
				    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" >
				      <li><option value = "1">January</a></li>
				      <li><option value = "2">February</a></li>
				      <li><option value = "3">March</a></li>
				    </ul>
				  </div>
				</div>


               <!--  end Drop down  -->
        </div>
    </header>

    <section class="bg-primary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 text-center">




                    
<?php



$sql = "SELECT  *
        FROM userdiary u,mytable t 
        WHERE u.NDB_No = t.NDB_No AND u.userID = $user
        ORDER BY meal AND date
        ";
$result = $conn->query($sql);
print_table($result); 
$result = $conn->query($sql);
$total_total = calc_meal_totals($result);




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

<?php
$carb_total = 0;
$fat_total = 0;
$pro_total = 0; 
$break_count = 0; 
$lunch_count =0; 
$dinner_counnt = 0; 
$other_count = 0; 


    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row["meal"] == "breakfast"){
            	if($break_count == 0 ){
            	?>
            	<table class="table ">
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
		        	echo "<script> console.log(" . $break_count . ") </script>"; 
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
	                          <td><input type='submit' class='btn btn-default' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value ='Delete'/></td>
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
	                          <td><input type='submit' class='btn btn-default' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value = 'Delete'/></td>
	                          </tr>";
	                          $carb_total += $row["Carbohydrt_g"];
	                          $fat_total += $row["Lipid_Tot_g"];
	                          $pro_total += $row["Protein_g"];
	                    }//end else 
            	}//break_count == 0 
            	else {
            		echo "<script> console.log(" . $break_count . ") </script>"; 
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
	                          <td><input type='submit' class='btn btn-default' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value ='Delete'/></td>
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
	                          <td><input type='submit' class='btn btn-default' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value = 'Delete'/></td>
	                          </tr>";
	                          $carb_total += $row["Carbohydrt_g"];
	                          $fat_total += $row["Lipid_Tot_g"];
	                          $pro_total += $row["Protein_g"];
	                    }//end else 
            	}//break count != 0 
		  
            }
            else if($row["meal"] == "lunch"){
            	if($lunch_count == 0 ){
            	?>
            	</tbody>
		    	</table> 
            	<table class="table ">
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
		        <script> console.log("lunch"); </script>
		        	<?php 
		        	echo "<script> console.log(" . $lunch_count . "); </script>"; 
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
	                          <td><input type='submit' class='btn btn-default' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value ='Delete'/></td>
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
	                          <td><input type='submit' class='btn btn-default' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value = 'Delete'/></td>
	                          </tr>";
	                          $carb_total += $row["Carbohydrt_g"];
	                          $fat_total += $row["Lipid_Tot_g"];
	                          $pro_total += $row["Protein_g"];
	                    }//end else 
            	}//lunch_count == 0 
            	else {
            		echo "<script> console.log(" . $lunch_count . ") </script>"; 
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
	                          <td><input type='submit' class='btn btn-default' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value ='Delete'/></td>
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
	                          <td><input type='submit' class='btn btn-default' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value = 'Delete'/></td>
	                          </tr>";
	                          $carb_total += $row["Carbohydrt_g"];
	                          $fat_total += $row["Lipid_Tot_g"];
	                          $pro_total += $row["Protein_g"];
	                    }//end else 
            	}//lunch count != 0 
          
            }//if meal == lunch 
            else if($row["meal"] == "dinner"){
            	if($dinner_counnt == 0 ){
            	?>
            	</tbody>
		    	</table> 
            	<table class="table ">
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
		        <script> console.log("dinner_counnt"); </script>
		        	<?php 
		        	echo "<script> console.log(" . $dinner_counnt . "); </script>"; 
		        	$dinner_counnt = $dinner_counnt + 1; 
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
	                          <td><input type='submit' class='btn btn-default' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value ='Delete'/></td>
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
	                          <td><input type='submit' class='btn btn-default' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value = 'Delete'/></td>
	                          </tr>";
	                          $carb_total += $row["Carbohydrt_g"];
	                          $fat_total += $row["Lipid_Tot_g"];
	                          $pro_total += $row["Protein_g"];
	                    }//end else 
            	}//dinner_counnt == 0 
            	else {
            		echo "<script> console.log(" . $dinner_counnt . ") </script>"; 
            		?><tbody><?php
            		$dinner_counnt = $dinner_counnt + 1; 
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
	                          <td><input type='submit' class='btn btn-default' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value ='Delete'/></td>
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
	                          <td><input type='submit' class='btn btn-default' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value = 'Delete'/></td>
	                          </tr>";
	                          $carb_total += $row["Carbohydrt_g"];
	                          $fat_total += $row["Lipid_Tot_g"];
	                          $pro_total += $row["Protein_g"];
	                    }//end else 
            	}//dinner count != 0 
 
            }//end if meal == dinner
            else {
           	if($other_count == 0 ){
            	?>
            	</tbody>
		    	</table> 
            	<table class="table ">
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
		        <script> console.log("other_count"); </script>
		        	<?php 
		        	echo "<script> console.log(" . $other_count . "); </script>"; 
		        	$other_count = $other_count + 1; 
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
	                          <td><input type='submit' class='btn btn-default' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value ='Delete'/></td>
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
	                          <td><input type='submit' class='btn btn-default' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value = 'Delete'/></td>
	                          </tr>";
	                          $carb_total += $row["Carbohydrt_g"];
	                          $fat_total += $row["Lipid_Tot_g"];
	                          $pro_total += $row["Protein_g"];
	                    }//end else 
            	}//other_count == 0 
            	else {
            		echo "<script> console.log(" . $other_count . ") </script>"; 
            		?><tbody><?php
            		$other_count = $other_count + 1; 
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
	                          <td><input type='submit' class='btn btn-default' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value ='Delete'/></td>
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
	                          <td><input type='submit' class='btn btn-default' name='".$row["NDB_No"]." ' value1='".$row["meal"]."' value = 'Delete'/></td>
	                          </tr>";
	                          $carb_total += $row["Carbohydrt_g"];
	                          $fat_total += $row["Lipid_Tot_g"];
	                          $pro_total += $row["Protein_g"];
	                    }//end else 
            	}//dinner count != 0 







            }//end else meal == other 

        }
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

























</tbody></table>

                </div>
            </div>
        </div>
    </section>

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                <?php
                    for($row = 0; $row < 3; $row++){
                        echo "<ul>";
                        for($col = 0; $col < 4; $col++){
                            echo "<li>".$total_total[$row][$col]."</li>";
                        }
                    echo "</ul>";
                    }
                ?>
                </div>
            </div>
        </div>

    </section>


<?php 
} //end if isset
else {
	?>
	    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1 id="homeHeading">You are not logged in, please login before viewing your diary </h1>
            </div>
        </div>
    </header>
    <?php 
} 
?>


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

</html>
