<?php
require_once("../php/db.php");
require_once("../php/userTypeChecker.php");
session_start();

if(!isset($_SESSION["user_name"])){
    echo "<script language=\"JavaScript\">\n";
    echo "window.location='../signin.php'";
    echo "</script>";
    exit();
    
}else{ //CHECK USER TYPE
    $active_username = $_SESSION["user_name"];
    $dir = basename(__DIR__);
    checkType($active_username,$dir);

    //retrieve name from database
    $sql = "SELECT * FROM users WHERE username = '$active_username' LIMIT 1";
    $result = mysqli_query($con, $sql);
    $result_array = mysqli_fetch_array($result);

    $name = $result_array['name'];
}

?>
<html lang="en">
<head>
    <meta name="generator" content="HTML Tidy for HTML5 (experimental) for Windows https://github.com/w3c/tidy-html5/tree/c63cc39" />
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="../../favicon.ico" />
    <title>SimplyRugby</title>
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="../css/mycss.css" rel="stylesheet" />
</head>

<body>
    <div id="wrapper">
    <?php require_once("navbar.php");?>
        <div id="page-wrapper">
            <!-- .container-fluid -->
            <div class="container-fluid"> <!-- ============ PAGE CONTENT ============= -->
                
                <h1>Member Search</h1>
                <form class="form-horizontal" role="form" action="<?=$_SERVER['PHP_SELF']?>" method="get">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="username">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="surname">Surname</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="surname" name="surname" placeholder="Enter surname">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                        </div>
                    </div>
                    
                    <div class="col-sm-2"></div>
                    <input type="submit" value="Search" class="btn btn-primary btn-lg btn-block darkbtn" name="submit">
                </form>
                <?php
                    if (isset($_GET['submit'])) { //If it's submitted

                        $name       = $_GET['name'];
                        $surname    = $_GET['surname'];
                        $username   = $_GET['username'];

                        if ($username) { // Make query depending on input
                            $sql = mysqli_query($con,"SELECT * FROM users WHERE username = '$username'");
                        }else if ($surname && $name) {
                            $sql = mysqli_query($con,"SELECT * FROM users WHERE surname = '$surname' AND name = '$name'");
                        }else if ($surname){
                            $sql = mysqli_query($con,"SELECT * FROM users WHERE surname = '$surname'");
                        }else if ($name){
                            $sql = mysqli_query($con,"SELECT * FROM users WHERE name = '$name'");
                        }else{
                            exit();
                        }

                        //DO this for every user retrieved
                        while ($result_array = mysqli_fetch_array($sql)) {
                ?>
                            <div class="panel panel-default listbtn-panel">
                                <a class="listbtn" href="editmember.php?id=<?=$result_array['id']?>"><div class="panel-body listbtn"><?=$result_array['name']." ".$result_array['surname']?></div></a>
                            </div>
                <?php
                        }
                    }
                ?>


            </div> <!-- ================ /PAGE CONTENT ================ -->
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- JAVASCRIPT IMPORT-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
    <script src="../js/bootstrap.min.js"></script>

</body>
</html>
