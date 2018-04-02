<?php
require_once("../php/db.php");
require_once("../php/functions.php");
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

                <?php
                    if (!isset($_POST['submit'])) {
                ?>
                <!-- Form -->
                <h1>New Team</h1>
                <form class="form-horizontal" role="form" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">Name<span style="color:red;"> *</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="junior"></label>
                        <div class="col-sm-10">
                            <input type="checkbox" id="junior" name="junior"><label for="junior">Junior</label>
                        </div>
                    </div>
                    </br></br>
                    <input type="submit" value="Submit" class="btn btn-primary btn-lg btn-block darkbtn" name="submit">
                    </br>
                </form>
                <!-- /form -->


                <?php
                    }else{
                        $name = $_POST['name'];
                        if (isset($_POST['junior'])) { // set junior value
                            $junior = 1;
                        }else{
                            $junior = 0;
                        }
                        

                        if(teamExists($name)){
                            echo "<script language=\"JavaScript\">\n";
                            echo "alert('That name already exists.');\n";
                            echo "window.location='newteam.php'";
                            echo "</script>";
                            exit();
                        }else{

                            // Insert new user to the database
                            $insert_user = "INSERT INTO teams (name, junior) VALUES ('$name', '$junior')";
                            $insert_user_query = mysqli_query($con, $insert_user);

                            $tsql = mysqli_query($con,"SELECT * FROM teams WHERE name = '$name'");
                            $tresult_array = mysqli_fetch_array($tsql);


                            //redirect
                            echo "<script language=\"JavaScript\">\n";
                            echo "alert('Team created!.');\n";
                            echo "window.location='editteam.php?teamid=".$tresult_array['team_id']."'";
                            echo "</script>";
                            exit();
                        }

                ?>
                    <h1>User successfully created</h1>
                    <h3><span>Username: </span><b><?=$username?></b></h3>

                    </br>
                    <form class="form-horizontal" role="form" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                        <input type="submit" value="Go back" class="btn btn-primary btn-lg darkbtn" name="a">
                    </form>


                <?php
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
    <script src="../js/simplyrugby.js"></script>
    


</body>
</html>
