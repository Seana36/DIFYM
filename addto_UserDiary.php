<?php
session_start(); 
include_once('dbConnect.php');
include_once('isLoggedIn.php');
 
$user = $_SESSION['userID']; 
$id = intval($_POST['ID']);
$meal = $_POST['meal'];
$today = getdate();
/*$user = 1;
$id = 1006;
$meal = 'Breakfast'; */

$sql11 = "SELECT u.servings, u.NDB_NO, t.Energ_Kcal, t.Protein_g, t.Lipid_Tot_g , t.Carbohydrt_g FROM userdiary u, mytable t WHERE userID = $user AND meal = '$meal' and u.NDB_NO = $id AND date = $date AND u.NDB_NO = t.NDB_NO "; 

$sql2 = "SELECT count FROM Freq_Item WHERE userID = '$user'  AND NDB_NO = $id "; 

$result11 = $conn->query($sql11);
if($result11->num_rows > 0) {
	echo "<script> console.log('inside first if') </script>";
	while($row = $result11->fetch_assoc()) {
		$servings = intval($row['servings']) + 1; 
		echo "<script> console.log($servings) </script>";
		$sql = "UPDATE UserDiary 
				SET servings = $servings 
				WHERE userID = $user AND NDB_NO = $id AND meal = '$meal' AND date = $date"; 
		$result = $conn->query($sql);
	}
}
else 
{
	$sql = "INSERT INTO UserDiary(userID, meal, NDB_NO, date, servings) VALUES ($user, '$meal' ,$id, $date, 1)";
	$result = $conn->query($sql);
}



$result2 = $conn->query($sql2);
if ($result === TRUE) {
	//if the item is already in Freq_item, 
	//increment the count
	if ($result2->num_rows > 0) {
		while($row = $result2->fetch_assoc()) {
			$counter = intval($row['count']) + 1; 
			$sql3 = "UPDATE  Freq_Item SET count =  $counter WHERE userID = '$user'  AND NDB_NO = $id "; 
			if ($conn->query($sql3) === TRUE) {
				echo "Add successfully to your diary and updated the count";
			}
		}
	}else {
	//item is not in Freq_Item
	//set count = 1	
		 echo "Add successfully to your diary";
		 $sql3 = "INSERT INTO Freq_Item(userID, NDB_NO, count) VALUES ($user, $id, 1) ";
		 if ($conn->query($sql3) === TRUE) {
				echo "Add successfully to your diary and updated the count to 1";
		}
	}

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

//exit;
?>