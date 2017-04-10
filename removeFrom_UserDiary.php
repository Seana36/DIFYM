<?php
include_once('dbConnect.php');
//add user's choise to breakfast -> user diary
$foodID = intval($_POST['foodID']);
$meal = $_POST['meal'];
#console($foodID); 
#console($meal); 
echo '<script type="text/
javascript">console.log($foodID);</script>'; 
$sql = "DELETE FROM `userdiary` WHERE meal = '$meal' AND NDB_NO = $foodID "; 

#"INSERT INTO UserDiary(userID, meal, NDB_NO, date) VALUES (1, '$meal' ,$id, '2017-10-05')";
if ($conn->query($sql) === TRUE) {
	
    echo "Add deleted from your diary";

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


#exit;
?>