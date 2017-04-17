<?php
session_start(); 
include_once('dbConnect.php');
include_once('isLoggedIn.php'); 

$user = $_SESSION['userID']; 
$id = intval($_POST['ID']);
$meal = $_POST['meal'];
echo $id; 
echo $meal; 
echo $id; 
$sql = "INSERT INTO UserDiary(userID, meal, NDB_NO, date) VALUES ($user, '$meal' ,$id, '2017-10-06')";
$sql2 = "SELECT count FROM Freq_Item WHERE userID = '$user'  AND NDB_NO = $id "; 
$result2 = $conn->query($sql2);

if ($conn->query($sql) === TRUE) {
	if ($result2->num_rows > 0) {
/*		while($row = $result->fetch_assoc()) {
			echo "var_dump($row)"; 
		}*/
	}else {
		 echo "Add successfully to your diary";
	}



   
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

//exit;
?>