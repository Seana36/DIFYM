<?php
include_once('dbConnect.php');

$id = intval($_POST['ID']);
$meal = $_POST['meal'];
echo $id; 
echo $meal; 
echo $id; 
$sql = "INSERT INTO UserDiary(userID, meal, NDB_NO, date) VALUES (1, '$meal' ,$id, '2017-10-05')";
if ($conn->query($sql) === TRUE) {
    echo "Add successfully to your diary";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

exit;
?>