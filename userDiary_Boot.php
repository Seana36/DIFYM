<?php 
include('dbConnect.php');
session_start();
//include_once('isLoggedIn.php');
$user = $_SESSION['user'];
?> 
<!DOCTYPE html>
<html lang="en">

<head>

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

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
                <a class="navbar-brand page-scroll" href="#page-top">Start Bootstrap</a>
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
                <h1 id="homeHeading">Your Favorite Source of Free Bootstrap Themes</h1>
                <hr>
                <p>Start Bootstrap can help you build better websites using the Bootstrap CSS framework! Just download your template and start going, no strings attached!</p>
                <a href="#about" class="btn btn-primary btn-xl page-scroll">Find Out More</a>
            </div>
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
            $carb_total = 0;
            $fat_total = 0;
            $pro_total = 0; 

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
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
                    }else {
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
                    }
                }
            } else {
                echo "0 results";
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

    <section class="no-padding" id="portfolio">
        <div class="container-fluid">
            <div class="row no-gutter popup-gallery">
                <div class="col-lg-4 col-sm-6">
                    <a href="img/portfolio/fullsize/1.jpg" class="portfolio-box">
                        <img src="img/portfolio/thumbnails/1.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
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
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
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
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
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
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
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
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
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
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <aside class="bg-dark">
        <div class="container text-center">
            <div class="call-to-action">
                <h2>Free Download at Start Bootstrap!</h2>
                <a href="http://startbootstrap.com/template-overviews/creative/" class="btn btn-default btn-xl sr-button">Download Now!</a>
            </div>
        </div>
    </aside>

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Let's Get In Touch!</h2>
                    <hr class="primary">
                    <p>Ready to start your next project with us? That's great! Give us a call or send us an email and we will get back to you as soon as possible!</p>
                </div>
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    <i class="fa fa-phone fa-3x sr-contact"></i>
                    <p>123-456-6789</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fa fa-envelope-o fa-3x sr-contact"></i>
                    <p><a href="mailto:your-email@your-domain.com">feedback@startbootstrap.com</a></p>
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

</html>
