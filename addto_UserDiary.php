<?php
session_start(); 
include_once('dbConnect.php');
include_once('isLoggedIn.php');
 
$user = $_SESSION['user']; 
$id = intval($_POST['ID']);
$meal = $_POST['meal'];
/*$today = getdate();*/
$date = '2017-10-05';
/*echo "<script> console.log(ID: $id)</script>";*/
/*$user = 1;
$id = 1006;
$meal = 'Breakfast'; */

/*$sql1 = "SELECT u.servings, u.NDB_NO, t.Energ_Kcal, t.Protein_g, t.Lipid_Tot_g , t.Carbohydrt_g FROM userdiary u, mytable t WHERE userID = $user AND meal = '$meal' and u.NDB_NO = $id AND date = $date AND u.NDB_NO = t.NDB_NO "; */
$sql1 = "SELECT * FROM userdiary u, mytable t WHERE userID = $user AND meal = '$meal' and u.NDB_NO = $id AND date = '$date' AND u.NDB_NO = t.NDB_NO "; 
echo $sql1; 

$result1 = $conn->query($sql1);
/*echo var_dump($result1);*/
if($result1->num_rows > 0) {
	echo "first if";
	while($row = $result1->fetch_assoc()) {
		$servings = intval($row['servings']) + 1; 
		echo "<script> console.log($servings); </script>";
		$sql = "UPDATE UserDiary 
				SET servings = $servings 
				WHERE userID = $user AND NDB_NO = $id AND meal = '$meal' AND date = '$date'"; 
		$result = $conn->query($sql);
	}
}
else 
{
	$servings = intval($row['servings']); 
	echo "servings $servings";
/*	echo "<script> console.log('inside else'); </script>";*/
	$sql = "INSERT INTO UserDiary(userID, meal, NDB_NO, date, servings) VALUES ($user, '$meal' ,$id, '$date', 1)";
	$result = $conn->query($sql);
}


$sql2 = "SELECT count FROM Freq_Item WHERE userID = '$user'  AND NDB_NO = $id "; 
$result2 = $conn->query($sql2);
if ($result === TRUE) {
/*	echo "<script> console.log('result == true '); </script>";*/
	//if the item is already in Freq_item, 
	//increment the count
	if ($result2->num_rows > 0) {
		while($row = $result2->fetch_assoc()) {
			$counter = intval($row['count']) + 1; 
			$sql3 = "UPDATE  Freq_Item SET count =  $counter WHERE userID = '$user'  AND NDB_NO = $id "; 
			if ($conn->query($sql3) === TRUE) {
				echo "Add successfully to your diary and updated the count $counter";
			}
			else {
				echo "NOT successfully to your diary and updated the count";
			}
		}
	}else {
		echo "<script> console.log('result != true '); </script>";
	//item is not in Freq_Item
	//set count = 1	
		 $sql3 = "INSERT INTO Freq_Item(userID, NDB_NO, count) VALUES ($user, $id, 1) ";
		 if ($conn->query($sql3) === TRUE) {
				echo "Add successfully to your diary and updated the count to 1";
		}
		else {
			echo "NOT successfully to your diary and updated the count to 1" + $conn->error;
		}
	}

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

//exit;
?>