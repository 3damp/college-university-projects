<?php
	
	function checkType($userr,$dir) {
		require('db.php');

	    //DB Query
	    $sql = "SELECT * FROM users WHERE username = '$userr' /*AND user_bloqued = 'no'*/ LIMIT 1";
	    //Connect to DB and run the query     
	    $result = mysqli_query($con, $sql);
	    //Put the result of the query into an array of data
	    $row = mysqli_fetch_array($result);
	    //Check if we have a data into the array
	    if(is_array($row)) {
	        //If we have data into the array do this...
	        $type = $row['type'];
	        //Check user type and redirect
	        if (($type==1 && $dir!="player")||($type==2 && $dir!="coach")||($type==3 && $dir!="secretary")) {
	            echo "<script language=\"JavaScript\">\n";
	            echo "window.location='../index.php'";
	            echo "</script>";
	            exit();
	        }
	    }
	}

	

?>