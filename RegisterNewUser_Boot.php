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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    <?php 
/*    session_start(); */
$username = $password1 = $password2 = $fName = $lName = $secQ = $secA ="";
$usernameErr = $pass1err = $pass2err = $fNameerr = $lNameerr = $secQerr = $secAerr = ""; 
$passed = true; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_POST["username"])) {
        $usernameErr = "Name is required";
        $passed = false; 
      } else {
        $username = test_input($_POST["username"]);
      }
      if (empty($_POST["password1"])) {
        $pass1err = "Password is required";
        $passed = false; 
      } else {
        $password1 = test_input($_POST["password1"]);
      }   
      if (empty($_POST["password2"])) {
        $pass2err = "Password is required";
        $passed = false; 
      } else {
        $password2 = test_input($_POST["password2"]);
      } 
      if (empty($_POST["fName"])) {
        $fNameerr = "First name is required";
        $passed = false; 
      } else {
        $fName = test_input($_POST["fName"]);
      }     
      if (empty($_POST["lName"])) {
        $lNameerr = "Last Name is required";
        $passed = false; 
      } else {
        $lName = test_input($_POST["lName"]);
      } 
      if (empty($_POST["secQ"])) {
        $secQerr = "Sec Q is required";
        $passed = false; 
      } else {
        $secQ = test_input($_POST["secQ"]);
      } 
      if (empty($_POST["secA"])) {
        $secAerr = "Sec A is required";
        $passed = false; 
      } else {
        $secA = test_input($_POST["secA"]);
      }  
/*var_dump($password1);*/
    if($password1 == $password2 AND isset($password1) AND $password1 !="") {
        echo "<script> console.log('Passowrd:$password1');</script>";
        registerUser($username, $password1, $fName, $lName, $secQ, $secA);
    }else {
    echo "passwords are not equal ";

    }
    

}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function registerUser($u, $p, $f, $l, $q, $a){
    include('dbConnect.php');
    echo "<script> console.log('Passowrd 1: $p');</script>";
    $sql = "INSERT INTO User_Info (userName, password, fName, lName, securityQ, securityA) VALUES ('$u', '$p', '$f', '$l', '$q', '$a')  ";
    if($conn->query($sql) === TRUE){
        echo "<script>console.log('Successfully added new user')</script>";
        $sql2 = "SELECT userID from User_Info WHERE userName = $u and password = $p";
        /*$_SESSION['']*/
        include_once('login_check_newuser.php'); 

        header('Location: RegisterNewUser_bodyInfo.html');
    }
    else {
        echo "<script>console.log('Error: $conn->error')</script>";
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}

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
                <a class="navbar-brand page-scroll" href="#page-top">Start Bootstrap</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="#about">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">Services</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#portfolio">Portfolio</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1 id="homeHeading">Regsiter New User</h1>
            </div>
        </div>
    </header>

    <section class="bg-primary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Enter Your Info</h2>
                    <!-- <hr class="light"> -->

                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                    <table class = "table"> 
                    <tr > 
	                    <td> UserName </td>
	                    <td><input type="text" name="username" value ="<?php echo $username;?>" style="color:black;"><span class="error"  >* <?php echo $usernameErr;?></span></td>
                    </tr>
                    <tr> 
	                    <td> Password </td>
	                    <td><input type="text" name="password1"  style="color:black;">*</td>
                    </tr>
                    <tr> 
	                    <td> Re-Enter Password </td>
	                    <td><input type="text" name="password2"  style="color:black;">*</td>
                    </tr>
                    <tr> 
	                    <td> First Name </td>
	                    <td><input type="text" name="fName" value ="<?php echo $fName;?>" style="color:black;"><span class="error">* <?php echo $fNameerr;?></span></td>
                    </tr>
                    <tr> 
	                    <td> Last Name </td>
	                    <td><input type="text" name="lName" value ="<?php echo $lName;?>" style="color:black;"><span class="error">* <?php echo $lNameerr;?></span></td>
                    </tr>
                    <tr> 
	                    <td> Security Question </td>
	                    <td><input type="text" name="secQ" value ="<?php echo $secQ;?>" style="color:black;"><span class="error">* <?php echo $secQerr;?></span></td>
                    </tr>
                    <tr> 
	                    <td> Security Answer </td>
	                    <td><input type="text" name="secA" value ="<?php echo $secA;?>" style="color:black;"><span class="error">* <?php echo $secAerr;?></span></td>
                    </tr>
                    <tr> 
                    	<td></td>
                    	<td><input class = "btn btn-default" type="submit" value="Submit"> </td>
                    </tr>


                    </table>
                </form>   
                    
<!-- <form action="RegisterNewUser.php" method="post">
  

	UserName <br>
	Password <br>
	Re-enter Password <br>
	First Name <br>
	Last Name <br>
	Security Q<br>
	Security A <br>
</form>


                </div>
                      <div class="col-lg-4 text-left">
                    <h2 class="section-heading">We've got what you need!</h2>
                    <hr class="light">
                    
<form action="RegisterNewUser.php" method="post">
	<input type="text" name="username"><br>
	<input type="text" name="password1"><br>
	<input type="text" name="password2"><br>
	<input type="text" name="fName">
	<input type="text" name="lName">
	<input type="text" name="secQ">
	<input type="text" name="secA">
	<input type="submit" value="Submit">
</form> -->




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

























<!-- 
<html> 
<body> 

<form action="RegisterNewUser.php" method="post">
  

	UserName <input type="text" name="username"><br>
	Password <input type="text" name="password1"><br>
	Re-enter Password <input type="text" name="password2"><br>
	First Name <input type="text" name="fName"><br>
	Last Name  <input type="text" name="lName"><br>
	Security Q <input type="text" name="secQ"><br>
	Security A <input type="text" name="secA"><br>
	<input type="submit" value="Submit">
</form>



</body>
</html> -->