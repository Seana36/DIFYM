<?php
    $user = $_SESSION['userID']; 
    include_once('dbConnect.php');

    $sql = "SELECT * FROM User_info i, User_body b WHERE i.userID = $user AND b.userID = $user"; 
	$result = $conn->query($sql);

    try
    {
        if($user)
        {
        	if ($result->num_rows > 0) {
        		while($row = $result->fetch_assoc()) {
        			$_SESSION['user_weight'] = $row['current_weight']; 
        			$_SESSION['user_height'] = $row['height']; 
        			$_SESSION['user_age'] = $row['age']; 
        		}
        	}
        	
        }
        else
        {
            throw new Exception("You must be logged in to review your account information");
        }
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
    }
    



?>