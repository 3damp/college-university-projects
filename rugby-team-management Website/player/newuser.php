<?php
require_once("../php/db.php");
//require_once("php/functions.php");
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
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Header-->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Simply Rugby</a>
            </div>
            <!-- Navigation Menu -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="#"><i class=""></i> Category 1 </a>
                    </li>
                    <li>
                        <a href="#"><i class=""></i> Category 2</a>
                    </li>
                    <li>
                        <a href="#"><i class=""></i> Category 3</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#users"><i class=""></i> Collapsing Category <i class=""></i></a>
                        <ul id="users" class="collapse">
                            <li>
                                <a href="#"> Subcategory 1 </a>
                            </li>
                            <li>
                                <a href="#"> Subcategory 2 </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="../logout.php"><i class=""></i>Logout</a>
                    </li>
                </ul>
            </div>
            <!-- /Navigation Menu -->
        </nav>

        <div id="page-wrapper">

            <!-- .container-fluid -->
            <div class="container-fluid"> <!-- ============ PAGE CONTENT ============= -->

                <?php
                    if (!isset($_POST['submit'])) {
                ?>
                <!-- Form -->
                <h1>New user (Secretary)</h1>
                <form class="form-horizontal" role="form" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">Name<span style="color:red;"> *</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="surname">Surname<span style="color:red;"> *</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="surname" name="surname" placeholder="Enter surname" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Email<span style="color:red;"> *</span></label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email2">Re-enter Email<span style="color:red;"> *</span></label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email2" name="email2" placeholder="Re-enter email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="bdate">Date of birth<span style="color:red;"> *</span></label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="bdate" name="bdate" placeholder="Enter date of birth" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="address">Address<span style="color:red;"> *</span></label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="4" id="address" name="address" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="postcode">Postcode<span style="color:red;"> *</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="postcode" name="postcode" placeholder="Enter postcode" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="tnum">Phone number:</label>
                        <div class="col-sm-10">
                            <input type="tel" class="form-control" id="tnum" name="tnum" placeholder="Enter number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="mnum">Mobile number<span style="color:red;"> *</span></label>
                        <div class="col-sm-10">
                            <input type="tel" class="form-control" id="mnum" name="mnum" placeholder="Enter number" required>
                        </div>
                    </div>

                    </br></br>
                    <input type="submit" value="Submit" class="btn btn-primary btn-lg btn-block darkbtn" name="submit">
                    </br>
                </form>
                <!-- /form -->


                <?php
                    }else{
                        
                        $name       = $_POST['name'];
                        $surname    = $_POST['surname'];
                        $email      = $_POST['email'];
                        $email2     = $_POST['email2'];
                        $bdate      = $_POST['bdate'];
                        $address    = $_POST['address'];
                        $postcode   = $_POST['postcode'];
                        $tnum       = $_POST['tnum'];
                        $mnum       = $_POST['mnum'];
                        $type       = 1;
                        

                        if($email != $email2){
                            echo "<script language=\"JavaScript\">\n";
                            echo "alert('Emails did not match');\n";
                            echo "window.location='index.php'";
                            echo "</script>";
                            //exit();
                        }else{

                            echo "<script>console.log('Name: ".$bdate."');</script>";
                            //generate username
                            $username   = $name.$surname;
                            //Generate password
                            $date1 = explode("-", $bdate);
                            $password = "$date1[0]"."$date1[1]"."$date1[2]";
                            $encrypted_password = md5($password); //encrypt password

                            echo "<script>console.log('username: ".$username."');</script>";
                            echo "<script>console.log('password: ".$password."');</script>";



                            // Insert new user to the database
                            $insert_user = "INSERT INTO users (username, name, surname, email, tnum, mnum, postcode, address, password, bdate, type) VALUES ('$username', '$name', '$surname', '$email', '$tnum', '$mnum', '$postcode', '$address', '$encrypted_password', '$bdate', '$type')";
                            $insert_user_query = mysqli_query($con, $insert_user);
                            

                        }

                ?>
                    <h1>User successfully created</h1>
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

</body>
</html>
