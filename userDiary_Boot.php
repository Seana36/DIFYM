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

    <title>DIFYM- User Diary</title>

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
    <!-- Load Ajax - Sean -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>

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
		echo "<script> console.log('USER: $user');</script>";
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

include_once('userDiary_Classes.php'); 

$sql = "SELECT  *
        FROM userdiary u,mytable t 
        WHERE u.NDB_No = t.NDB_No AND u.userID = $user
        ORDER BY meal ASC
        ";
$result = $conn->query($sql);
print_table($result);
$result = $conn->query($sql);
$total_total = calc_meal_totals($result);

?>
 
</div>

                </div>
            </div>
        </div>
    </section>
<!-- Displaying Totals -->
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 ">
                <h2> Macro Breakdown by Meal </h2>
                <table class = "table"> 
                <tr> 
                    <th> Meal</th>
                    <th> Calories </th>
                    <th> Fat </th>
                    <th> Carbs </th>
                    <th> Protein </th>
                </tr>
                <?php
                    for($row = 0; $row < 5; $row++){
                       echo "<tr>";
                        for($col = 0; $col < 5; $col++){
                            echo "<td> ".$total_total[$row][$col]."</td> ";
                        }
                    echo "</tr>";
                    }
                ?>

                </table>
                </div>
            </div>
        </div>
    </section>

<!--     Displaying COmpared to totals-->    
    <section id="services2" class="bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 ">
                <h2> How many are left?</h2>

                <?php
                $totalCal =  $total_total[4][1];
                $totalFat =  $total_total[4][2];
                $totalCarb = $total_total[4][3];
                $totalProt = $total_total[4][4];

                $sql11 = "SELECT goal_cal, goal_fat, goal_carb, goal_prot FROM `user_body` WHERE userID = $user";
                $result11 = $conn->query($sql11);
                if ($result11->num_rows > 0) {
                    while($row = $result11->fetch_assoc()) {
                        $goalCal = $row['goal_cal'];
                        $goalFat = $row['goal_fat'];
                        $goalCarb= $row['goal_carb'];
                        $goalProt= $row['goal_prot'] ;  
                    }
                }
                else {
                    echo "something else";
                }
                $remainingCal = $goalCal - $totalCal;
                $remainingFat = $goalFat - $totalFat;
                $remainingCarb = $goalCarb - $totalCarb;
                $remainingProt = $goalProt - $totalProt;
                ?>
                <table class = "table">
                <tr> 
                    <td>  </td>
                    <td> Calories </td>
                    <td> Fat </td>
                    <td> Carb </td>
                    <td> Protein </td>
                </tr>
                <tr> 
                    <td> Eaten today </td>
                    <td> <?php echo $totalCal ?> </td>
                    <td> <?php echo $totalFat ?> </td>
                    <td> <?php echo $totalCarb ?> </td>
                    <td> <?php echo $totalProt ?> </td>
                </tr>
                <tr> 
                    <td> Daily Goal </td>
                    <td> <?php echo $goalCal ?> </td>
                    <td> <?php echo $goalFat ?></td>
                    <td> <?php echo $goalCarb ?> </td>
                    <td> <?php echo $goalProt ?> </td>
                </tr>
                <tr> 
                    <td> Left </td>
                    <td> <?php echo $remainingCal ?> </td>
                    <td> <?php echo $remainingFat ?></td>
                    <td> <?php echo $remainingCarb ?></td>
                    <td> <?php echo $remainingProt ?> </td>
                </tr>
               
                </table> 

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
                <h1 id="homeHeading" >You are not logged in, please login before viewing your diary </h1>
            </div>
        </div>
    </header>
    <?php 
} 
?>

<script> 
            console.log("here1");
            document.getElementById("DeleteButton").onclick = function() {myFunction_Del()};
            function myFunction_Del(){
        /*  $('.button').click(function() {*/
                console.log("delete click");
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
            }
        /*  });*/
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

</html>
