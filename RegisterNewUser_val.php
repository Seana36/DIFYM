<html> 
<head>
<?php 
$username = $password1 = $password2 = $fName = $lName = $secQ = $secA ="";
$usernameErr = $pass1err = $pass2err = $fNameerr = $lNameerr = $secQerr = $secAerr = ""; 
$passed = true; 

/*if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$username  = test_input($_POST['username']);
	$password1 = test_input($_POST['password1']);
	$password2 = test_input($_POST['password2']);
   	$fName = test_input($_POST['fName']);
   	$lName = test_input($_POST['lName']);
	$secQ = test_input($_POST['secQ']);
   	$secA = test_input($_POST['secA']);*/


/*

	if (empty($_POST["username"])) {
		$usernameErr = "UserName is required";
		$passed = false; 
	}else {
		$username  = test_input($_POST["username"]);
	}
	if (empty($_POST["password1"])) {
		$pass1err = "Passowrd is required";
		$passed = false; 
	}else {
	    $password1 = test_input($_POST['password1']);
	}
	if (empty($_POST["password2"])) {
		$pass2err = "Passowrd is required";
		$passed = false; 
	}else {
	}
	if (empty($_POST["fName"])) {
		$fNameerr = "First Name is required";
		$passed = false; 
	}else {
	}
	if (empty($_POST["lname"])) {
		$lNameerr = "Last Name is required";
		$passed = false; 
	}else {
	}
	if (empty($_POST["secQ"])) {
		$secQerr = "Security Q is required";
		$passed = false; 
	}else {
	}
	if (empty($_POST["secA"])) {
		$secAerr = "Security A is required";
		$passed = false; 
	}else {
	}

	if($passed == true){
		registerUser();
	}else {
		echo "<script>console.log('You did not pass'); </script> ";
	}*/
	

/*}*/

/*function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}*/

/*function registerUser(){
	include('dbConnect.php');
	if($password1 == $password2){
 	$sql = "INSERT INTO User_Info (userName, password, fName, lName, securityQ, securityA) 
 	                     VALUES ('$username', '$password2', '$fName', '$lName', '$secQ', '$secA')  ";
 	if($conn->query($sql) === TRUE){
 		echo "<script><alert>Successfully added new user</alert> </script>";
 		$sql2 = "SELECT userID from User_Info WHERE userName = $userName and password = $password2";
 		include_once('login_check.php'); 
 		header('Location: RegisterNewUser_bodyInfo.html');

 	}
 	else {
 		echo "Error: " . $sql . "<br>" . $conn->error;
 	}

}
else {
	echo "Passwords did not match";
}*/

/*} */

?>
</head>
<body> 
<!-- form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"> -->

 <form action="RegisterNewUser.php" method="post">
  

	UserName <input type="text" name="username"><span class="error">* <?php echo $usernameErr;?></span><br>
	Password <input type="text" name="password1"><span class="error">* <?php echo $pass1err;?></span><br>
	Re-enter Password <input type="text" name="password2"><span class="error">* <?php echo $pass2err;?></span><br>
	First Name <input type="text" name="fName"><span class="error">* <?php echo $fNameerr;?></span><br>
	Last Name  <input type="text" name="lName"><span class="error">* <?php echo $lNameerr;?></span><br>
	Security Q <input type="text" name="secQ"><span class="error">* <?php echo $secQerr;?></span><br>
	Security A <input type="text" name="secA"><span class="error">* <?php echo $secAerr;?></span><br>
	<input type="submit" value="Submit">
</form>


<?php
// define variables and set to empty values


?>



</body>
</html>