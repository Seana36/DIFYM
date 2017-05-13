<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DIFYM</title>

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
    <script src="js/sortable.js"></script>
    <!-- 
	Source for Macro Creation: 
	https://healthyeater.com/how-to-calculate-your-macros 

	-->
    <?php 
		session_start(); 
		
        if(isset($_SESSION['user'])){
        include_once('isLoggedIn.php');
		$weight = $_SESSION['user_weight']; 
		$height = $_SESSION['user_height'];
		$age = $_SESSION['user_age']; 
        } 
        else{
            $weight = 150; 
            $height = 60;
            $age    = 20;
        }
	?>

</head>

<body id="page-top">

<?php 
if(isset($_GET["REE"]) ){
	$REE = $_GET["REE"] ;
}
#echo "<br>";
if(isset($_GET["TDEE"]) ){
	$TDEE = $_GET["TDEE"] ;
}
#echo "<br>";
if(isset($_GET["weight"]) ){
	$weight = $_GET["weight"] ;
}

	 
?>

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

    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1 id="homeHeading">Macro Calculator</h1>
                <hr>
                <p>Check out the calculators below to find out your daily macros. </p>
                <a href="#about" class="btn btn-primary btn-xl page-scroll">Calculate My Macros!</a>
            </div>
        </div>
    </header>


    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-lg-offset-4  text-left">
                   <!--  <form action="results_TDEE.php" method="post"> -->
						<div class ="form-group">
							Weight (lbs): <input type="text" name="weight" id = "weight" value = <?php echo "$weight" ?>>
						</div>
						<div class ="form-group">
							Height(Inches): <input type="text" name="height" id="height" value = <?php echo "$height" ?> >
						</div>
						<div class ="form-group">
							Age: <input type="text" name="age" id="age" value = <?php echo "$age" ?> >
						</div>
						<div class="checkbox">
						 	<label>
						    	<input type="checkbox" value="1.2" id="activityLevel" class="activityLevel"> Sedetary 
						    </label>
						</div>
						<div class="checkbox">
						 	<label>
						    	<input type="checkbox" value="1.375" id="activityLevel" class="activityLevel"> Light Activity 
						    </label>
						</div>
						<div class="checkbox">
						 	<label>
						    	<input type="checkbox" value="1.55" id="activityLevel" class="activityLevel"> Moderate Acctivity 
						    </label>
						</div>
						<div class="checkbox">
						 	<label>
						    	<input type="checkbox" value="1.725" id="activityLevel" class="activityLevel"> Very Active 
						    </label>
						</div>
						<div class ="form-group">
                        <a class="page-scroll" href="#about">
							<input type="submit" class = "page-scroll btn btn-primary btn-xl sr-button" value="Submit" id ="DisplaySubmit">
                        </a>
						</div>
                </div>
            </div>
        </div>
    </section>

<?php 
/*} //if isset()*/
?>

    <section class="bg-primary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center" >
                    <div id="displayDiv" style="display:none" >
                         <div class = "container"> 
                         <span>              
                            
                        </span>
                        </div>
                   </div>
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


<script> 

document.getElementById("DisplaySubmit").onclick = function() {myFunction()};

function myFunction(){
	var height = document.getElementById('height').value; 
	var weight = document.getElementById('weight').value; 
	var age = document.getElementById('age').value; 
	var activityLevel = check_Checkbox(); 
	$.ajax({
	      url: "display_TDEE.php",
	      type: "POST",
	      data: { 'height': height,
	      		  'weight': weight, 
	      		  'age': age,
	      		  'activityLevel' : activityLevel  
	            }
	    }).done(function( msg ) {
	    	$('#displayDiv').empty(); 
	      	$("#displayDiv").show();
	      	$('#displayDiv').append(msg);
	    });
	}

function check_Checkbox(){
    var checkedValue = null; 
    var inputElements = document.getElementsByClassName('activityLevel');
    for(var i=0; inputElements[i]; ++i){
          if(inputElements[i].checked){
               checkedValue = inputElements[i].value;
                /*console.log(checkedValue);*/
               return checkedValue; 
          }
    }
    
}

</script>
</body>


</html>