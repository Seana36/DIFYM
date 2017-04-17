<?php
session_start(); 
include_once('dbConnect.php');
/*include_once('isLoggedIn.php');
 
$user = $_SESSION['userID']; 
$id = intval($_POST['ID']);
$meal = $_POST['meal'];*/
$user = 1;
$id = 2051;
$meal = 'Breakfast'; 

/*echo $id; 
echo $meal; 
echo $id; */
$sql11 = "SELECT servings FROM UserDiary WHERE userID = $user AND meal = '$meal' and NDB_NO = $id AND date =  '2017-10-06' "; 

/*$sql = "INSERT INTO UserDiary(userID, meal, NDB_NO, date) VALUES ($user, '$meal' ,$id, '2017-10-06')";*/
$sql2 = "SELECT count FROM Freq_Item WHERE userID = '$user'  AND NDB_NO = $id "; 


$result11 = $conn->query($sql11);
if($result11->num_rows > 0) {
	while($row = $result11->fetch_assoc()) {
		$servings = intval($row['servings']) + 1; 
		var_dump($row['servings']);
		echo "<script> console.log($servings) </script>";
		#$sql = "INSERT INTO UserDiary(userID, meal, NDB_NO, date, servings) VALUES ($user, '$meal' ,$id, '2017-10-06', $servings)";
		$sql = "UPDATE UserDiary SET servings = $servings WHERE userID = $user AND NDB_NO = $id AND meal = '$meal' AND date = '2017-10-06'"; 
		$result = $conn->query($sql);
	}
}
else 
{
	$sql = "INSERT INTO UserDiary(userID, meal, NDB_NO, date, servings) VALUES ($user, '$meal' ,$id, '2017-10-06', 1)";
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