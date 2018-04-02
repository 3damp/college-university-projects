<?php
require_once("php/db.php");
require_once("php/userTypeChecker.php");
session_start();

if(!isset($_SESSION["user_name"])){
    echo "<script language=\"JavaScript\">\n";
    echo "window.location='signin.php'";
    echo "</script>";
    exit();

}else{ //CHECK USER TYPE AND REDIRECT
    $username = $_SESSION["user_name"];
    //DB Query
    $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
    //Connect to DB and run the query     
    $result = mysqli_query($con, $sql);
    //Put the result of the query into an array of data
    $row = mysqli_fetch_array($result);
    //Check if we have a data into the array
    if(is_array($row)) {
        //If we have data into the array do this...
        $type = $row['type'];

        //Check user type and redirect
        if ($type==2) {         // If it is coach
            echo "<script language=\"JavaScript\">\n";
            echo "window.location='coach/index.php'";
            echo "</script>";
            exit();
        }else if ($type==3) {   // If it is secretary
            echo "<script language=\"JavaScript\">\n";
            echo "window.location='secretary/index.php'";
            echo "</script>";
            exit();
        }else{                  // If it is player
            echo "<script language=\"JavaScript\">\n";
            echo "window.location='player/index.php'";
            echo "</script>";
            exit();
        }
    }
}
