<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User Info</title>

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

    <script src="js/sortable.js"></script>
    <?php 
		include('dbConnect.php');
		session_start(); 

    ?>

</head>

<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">User Diary</a>
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


    <section class="bg-primary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                   


<?php
if (isset($_SESSION['user'])){
	$user = $_SESSION['user']; 





	echo "<br>";
	$sql2 = "SELECT userName, fName, lName FROM `user_info` WHERE userID = $user";
	$result2 = $conn->query($sql2); 
	if ($result2->num_rows > 0) {
	    // output data of each row
	    while($row = $result2->fetch_assoc()) {
	        echo  "
	        <table class = 'table table-bordered sortable' align='center'> 
	        <tr > 
	        	<th colspan ='2' >User_info Info</th>
	        <tr> 
	        	<td> User Name</td>
	        	<td> ".$row["userName"]." </td>
	        </tr> 
	       	<tr> 
	        	<td> First Name</td>
	        	<td> ".$row["fName"]." </td>
	        </tr> 
	        <tr> 
	        	<td> Last Name</td>
	        	<td> ".$row["lName"]." </td>
	        </tr>
	        </table>
	        ";
	    }
	}//if result 2 userInfo
	?>
	<div class ="form-group">
		<input type="submit" id = "editUser_Info" class = "page-scroll btn btn-default btn-xl sr-button" value="editUser_Info">
	</div>
	<?php 








	$sql1 = "SELECT height, current_weight,goal_weight, goals, goal_cal, goal_fat, goal_carb, goal_prot  FROM `user_body` WHERE userID = $user";
	$result1 = $conn->query($sql1);
	if ($result1->num_rows > 0) {
	    // output data of each row
	    while($row = $result1->fetch_assoc()) {
	        echo  "
	       	<table class = 'table table-bordered sortable' align='center'> 
	        <tr > 
	        	<th colspan ='2' >User_Body Info</th>
	        <tr> 
	        <tr> 
	        	<td> Height</td>
	        	<td> ".$row["height"]." </td>
	        </tr> 
	       	<tr> 
	        	<td> Current Weight</td>
	        	<td> ".$row["current_weight"]." </td>
	        </tr> 
			<tr> 
	        	<td> Goal Weight</td>
	        	<td> ".$row["goal_weight"]." </td>
	        </tr> 
	        <tr> 
	        	<td> Goals</td>
	        	<td> ".$row["goals"]." </td>
	        </tr> 
	        <tr> 
	        	<td> Goal Calories</td>
	        	<td> ".$row["goal_cal"]." </td>
	        </tr> 
	        <tr> 
	        	<td> Goal Fat</td>
	        	<td> ".$row["goal_fat"]." </td>
	        </tr> 
	        <tr> 
	        	<td> Goal Carb </td>
	        	<td> ".$row["goal_carb"]." </td>
	        </tr> 
	        <tr> 
	        	<td> Goal Protein </td>
	        	<td> ".$row["goal_prot"]." </td>
	        </tr> 
	        </table>
	        ";
	    }
	} else {
	    echo "0 results";
	}//userBody
		?>
	<div class ="form-group">
		<input type="submit" id = "editUser_Body" class = "page-scroll btn btn-default btn-xl sr-button" value="editUser_Body">
	</div>
	<?php 
	
	
	//user Pref
	echo "<br>";
	$sql3 = "SELECT Keto, Vegetarian, Allergies, Other FROM `user_pref` WHERE userID = $user";
	$result3 = $conn->query($sql3);
	if ($result3->num_rows > 0) {
	    // output data of each row
	    while($row = $result3->fetch_assoc()) {
	        echo  "
	        <table class = 'table table-bordered sortable' align='center'> 
	        <tr > 
	        	<th colspan ='2' >User Preference's</th>
	        <tr>  
	        <tr> 
	        	<td> Keto</td>
	        	<td> ".$row["Keto"]." </td>
	        </tr> 
	       	<tr> 
	        	<td> Vegetarian</td>
	        	<td> ".$row["Vegetarian"]." </td>
	        </tr> 
	        <tr> 
	        	<td> Allergies</td>
	        	<td> ".$row["Allergies"]." </td>
	        </tr>
	        <tr> 
	        	<td> Other</td>
	        	<td> ".$row["Other"]." </td>
	        </tr>
	        </table>
	        ";
	    }
	}//if result 2 userInfo
	?>
	<div class ="form-group">
		<input type="submit" id = "editUser_Pref" class = "page-scroll btn btn-default btn-xl sr-button" value="editUser_Pref">
	</div>
	<?php 



}//end isset user
else {
	echo "You are not logged in";
}


?>





















                </div>
            </div>
        </div>
    </section>



  

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


<script> 

document.getElementById("editUser_Info").onclick = function() {edit_user_info()};
document.getElementById("editUser_Body").onclick = function() {edit_user_body()};
document.getElementById("editUser_Pref").onclick = function() {edit_user_pref()};

function edit_user_info(){
	alert("This will allow you to edit your data... eventually");
	/*console.log("Fat: " + $fat);*/ 
/*	var fat = <?php echo json_encode($fat); ?>;
	var carb = <?php echo json_encode($carb); ?>;
	var prot = <?php echo json_encode($protein); ?>;
	var cal = <?php echo json_encode($TDEE); ?>;*/
/*	console.log("Fat2: " + fat); 
	$.ajax({
	      url: "saveMacrostoDB.php",
	      type: "POST",
	      data: { 'fat': fat,
	      		  'carb': carb, 
	      		  'prot': prot,
	      		  'cal' : cal 
	            }
	    }).done(function( msg ) {
	    	console.log(msg); 

	    });*/
	}
function edit_user_body(){
	alert("This will allow you to edit your data... eventually");
}
function edit_user_pref(){
	alert("This will allow you to edit your data... eventually");
}

</script>

</html>











