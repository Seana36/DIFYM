<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
    include('dbConnect.php');
    session_start();
    if(isset($_SESSION['user'])){
    echo "<script> console.log('User is logged in'); </script>"; 
}
    //include('isLoggedIn.php');
/*    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
    }*/

    ?> 

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Homepage</title>



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
<!--     BootStrap Slider -->    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.0/bootstrap-slider.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.0/bootstrap-slider.min.js"></script>
    <link href ="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.0/css/bootstrap-slider.css" rel="stylesheet">
    <link href = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.0/css/bootstrap-slider.min.css" rel = "stylesheet">


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

    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1 id="homeHeading">Welcome to Does It Fit Your Macros?</h1>
                <hr>
                <p>Check out the searches below and see if you can find the right food to fit your macros!</p>
                <a href="#recommender" class="btn btn-primary btn-xl page-scroll">Take me to the Searches</a>
            </div>
        </div>
    </header>


    <section class="bg-primary" id="recommender">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-lg-offset-0 text-center" >
                    <h2 class="section-heading">Look up by Macros</h2>
                    <hr class="light">

                    <div class ="form-group">
						Fat: <br>
                        Min: 
                         <input id="fat_min" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="0"/>
                         <br>
                    </div>
                    <div class ="form-group">
                         Max: 
                         <input id="fat_max" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="50"/>
					</div> 

					<div class ="form-group">
						Carbs: <br><!--  <input type="text" id = "carbs" name="carbs" style ="color:black"> -->
                        Min: 
                         <input id="carb_min" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="0"/>
                         <br>
                    </div>
                    <div class ="form-group">
                         Max: 
                         <input id="carb_max" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="50"/>
					</div>

                    <div class ="form-group">
                        Protein: <br><!--  <input type="text" id = "carbs" name="carbs" style ="color:black"> -->
                        Min: 
                         <input id="prot_min" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="0"/>
                         <br>
                    </div>
                    <div class ="form-group">
                         Max: 
                         <input id="prot_max" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="50"/>
                    </div>

					<div class ="form-group">
					<a class="page-scroll" href="#Search_Results">
						<input type="submit" id = "MacroButton" class = "btn btn-default btn-xl sr-button" value="Submit Macro"  >
					</a>
					</div>
					<!-- </form> -->
                </div>
                <div class="col-lg-4 col-lg-offset-0 text-center">
                    <h2 class="section-heading">Look up by Calories</h2>
                    <hr class="light">
                    <!-- <form action="foodRecommender_output_cal.php" method="post"> -->
	                    <div class ="form-group">
							Calories: <br>
                        Min: 
                         <input id="cal_min" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="500" data-slider-step="5" data-slider-value="0"/>
                        </div>
                        <div class ="form-group">
                        Max: 
                             <input id="cal_max" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="500" data-slider-step="5" data-slider-value="250"/>
                        </div> 
						<div class ="form-group">
                        <a class="page-scroll" href="#Search_Results">
							<input type="submit" id = "CalorieButton" class = "btn btn-default btn-xl sr-button" value="Submit Cal" >
                        </a>
						</div>					
                </div>
                <div class="col-lg-4 col-lg-offset-0 text-center">
                    <h2 class="section-heading">Look up by Name</h2>
                    <hr class="light">
                        <div class ="form-group">
                            Name: <input type="text" id = "name" name="name" style ="color:black">
                        </div>
                        <div class ="form-group">
                        <a class="page-scroll" href="#Search_Results">
                            <input type="submit" id = "NameButton" class = "btn btn-default btn-xl sr-button" value="Submit Name" >
                        </a>
                        </div>                  
                </div>
            </div>
        </div>
    </section>

    <section id="Search_Results">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Search Results
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-0 text-center col-xs-12">  
                <!-- http://stackoverflow.com/questions/12032664/load-a-html-page-within-another-html-page   -->       
                    <div id="macroDiv" style="display:none" >
                         <div class = "container"> 
                         <span>              
                            
                        </span>
                        </div>
                   </div>
                    <div id="calDiv" style="display:none;">
                    <div class = "container"> 
                         <span>              
                            
                        </span>
                        </div>
                   </div>
                    <div id="nameDiv" style="display:none;">
                    <div class = "container"> 
                         <span>              
                            
                        </span>
                        </div>
                   </div>
            </div>
        </div>
    </section>


    <section class="no-padding" id="portfolio">
        <div class="container-fluid">
            <div class="row no-gutter popup-gallery">
                <div class="col-lg-4 col-sm-6">
                    <a href="img/portfolio/fullsize/1.jpg" class="portfolio-box">
                        <img src="img/portfolio/thumbnails/1.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                </div>
                                <div class="project-name">
                                    
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="img/portfolio/fullsize/2.jpg" class="portfolio-box">
                        <img src="img/portfolio/thumbnails/2.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    
                                </div>
                                <div class="project-name">
                                    
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="img/portfolio/fullsize/3.jpg" class="portfolio-box">
                        <img src="img/portfolio/thumbnails/3.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                </div>
                                <div class="project-name">
                                    
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="img/portfolio/fullsize/4.jpg" class="portfolio-box">
                        <img src="img/portfolio/thumbnails/4.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                </div>
                                <div class="project-name">
                                    
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="img/portfolio/fullsize/5.jpg" class="portfolio-box">
                        <img src="img/portfolio/thumbnails/5.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                </div>
                                <div class="project-name">
                                    
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="img/portfolio/fullsize/6.jpg" class="portfolio-box">
                        <img src="img/portfolio/thumbnails/6.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                </div>
                                <div class="project-name">
                                    
                                </div>
                            </div>
                        </div>
                    </a>
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
var slider1 = new Slider('#fat_min', {});
var slider2 = new Slider('#fat_max', {});
var slider3 = new Slider('#carb_min', {});
var slider4 = new Slider('#carb_max', {});
var slider5 = new Slider('#prot_min', {});
var slider6 = new Slider('#prot_max', {});
var slider7 = new Slider('#cal_min', {});
var slider8 = new Slider('#cal_max', {});

document.getElementById("MacroButton").onclick = function() {myFunction()};

function myFunction(){
    console.log("inside click function"); 
    var fat_min = $('#fat_min').val();
    var fat_max = $('#fat_max').val();
    var carb_min = $('#carb_min').val();
    var carb_max = $('#carb_max').val();
    var prot_min = $('#prot_min').val();
    var prot_max = $('#prot_max').val();
    console.log("Fat: "+fat_min); 
    $.ajax({
      url: "foodRecommender_output_macros2.php",
      type: "POST",
      data: { 'fat_min': fat_min,
              'fat_max': fat_max,
              'carb_min': carb_min,
              'carb_max': carb_max,
              'prot_min' : prot_min,
              'prot_max' : prot_max }
    }).done(function( msg ) {
    $('#macroDiv span').empty();    
      $("#macroDiv").show();
      $(msg).appendTo('#macroDiv span') ;
    });
}  

document.getElementById("CalorieButton").onclick = function() {myFunction_Cal()};
function myFunction_Cal(){
/*    console.log("inside click function"); 
    var cal = document.getElementById('calories').value; 
    console.log(cal); */
    var cal_min = $('#cal_min').val();
    var cal_max = $('#cal_max').val();
    $.ajax({
      url: "foodRecommender_output_cal2.php",
      type: "POST",
      data: { 'cal_min': cal_min,
              'cal_max': cal_max }
    }).done(function( msg ) {  
    $('#calDiv span').empty();  
      $("#calDiv").show();
      $(msg).appendTo('#calDiv span') ;
    });
}
document.getElementById("NameButton").onclick = function() {myFunction_Name()};
function myFunction_Name(){
    console.log("inside name function"); 
    var name = document.getElementById('name').value; 
    console.log(name); 
    $.ajax({
      url: "foodRecommender_output_name.php",
      type: "POST",
      data: { 'name': name }
    }).done(function( msg ) {   
      $('#nameDiv span').empty(); 
      $("#nameDiv").show();
      $(msg).appendTo('#nameDiv span') ;
    });
}


</script>


</body>

</html>
