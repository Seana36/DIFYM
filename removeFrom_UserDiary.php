<?php
include_once('dbConnect.php');
//add user's choise to breakfast -> user diary
$foodID = intval($_POST['foodID']);
$meal = $_POST['meal'];
 
$sql = "DELETE FROM `userdiary` WHERE meal = '$meal' AND NDB_NO = $foodID ";


if ($conn->query($sql) === TRUE) {
	
    echo "Add deleted from your diary";

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


#exit;
?>