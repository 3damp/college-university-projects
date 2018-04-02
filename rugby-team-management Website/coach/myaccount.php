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
    <?php require_once("navbar.php");?>
        <div id="page-wrapper">
            <!-- .container-fluid -->
            <div class="container-fluid"> <!-- ============ PAGE CONTENT ============= -->

                <?php
                    if (!isset($_POST['edit']) && !isset($_POST['savepwd'])) {
                ?>
                <!-- Form -->
                <h1>My Account</h1>

                <?php
                    //retrieve data from database
                    $sql = "SELECT * FROM users WHERE username = '$active_username' LIMIT 1";
                    $result = mysqli_query($con, $sql);
                    $result_array = mysqli_fetch_array($result);

                    $name = $result_array['name'];
                    $surname = $result_array['surname'];
                    $email = $result_array['email'];
                    $bdate = $result_array['bdate'];
                    $address = $result_array['address'];
                    $postcode = $result_array['postcode'];
                    $tnum = $result_array['tnum'];
                    $mnum = $result_array['mnum'];
                ?>

                <form class="form-horizontal" role="form" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">Name</label>
                        <div class="col-sm-10">
                            <input type="text" value="<?=$name?>" class="form-control" id="name" name="name" placeholder="Enter name" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="surname">Surname</label>
                        <div class="col-sm-10">
                            <input type="text" value="<?=$surname?>" disabled class="form-control" id="surname" name="surname" placeholder="Enter surname" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Email</label>
                        <div class="col-sm-10">
                            <input type="email" value="<?=$email?>" disabled class="form-control" id="email" name="email" placeholder="Enter email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="bdate">Date of birth</label>
                        <div class="col-sm-10">
                            <input type="date" value="<?=$bdate?>" disabled class="form-control" id="bdate" name="bdate" placeholder="Enter date of birth" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="address">Address</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" disabled rows="4" id="address" name="address" required><?=$address?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="postcode">Postcode</label>
                        <div class="col-sm-10">
                            <input type="text" value="<?=$postcode?>" disabled class="form-control" id="postcode" name="postcode" placeholder="Enter postcode" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="tnum">Phone number:</label>
                        <div class="col-sm-10">
                            <input type="tel" value="<?=$tnum?>" disabled class="form-control" id="tnum" name="tnum">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="mnum">Mobile number</label>
                        <div class="col-sm-10">
                            <input type="tel" value="<?=$mnum?>" disabled class="form-control" id="mnum" name="mnum" placeholder="Enter number" required>
                        </div>
                    </div>
                    </br></br>
                    <input type="submit" value="Change password" class="btn btn-primary btn-lg btn-block darkbtn" name="edit">
                    </br>
                
                </form>
                <!-- /form -->


                <?php
                    }else {
                        if (isset($_POST['savepwd'])) {
                            $password = $_POST['oldpwd'];
                            $newpwd = $_POST['newpwd'];
                            $newpwd2 = $_POST['newpwd2'];

                            $encrypted_password = md5($password);
                            //retrieve data from database
                            $sql = "SELECT * FROM users WHERE username = '$active_username' LIMIT 1";
                            $result = mysqli_query($con, $sql);
                            $result_array = mysqli_fetch_array($result);

                            $database_hash = $result_array['password'];

                            if($encrypted_password == $database_hash){
                                if(strlen($newpwd)>=8){
                                    if($newpwd==$newpwd2){
                                        $newhash = md5($newpwd);
                                        $insert_user = "UPDATE users SET password='$newhash' WHERE username = '$active_username' LIMIT 1";
                                        $insert_user_query = mysqli_query($con, $insert_user);

                                        echo "<script language=\"JavaScript\">\n";
                                        echo "alert('Password changed');\n";
                                        echo "window.location='myaccount.php'";
                                        echo "</script>"; 
                                    }else{
                                        echo "<script language=\"JavaScript\">\n";
                                        echo "alert('Passwords did not match');\n";
                                        echo "</script>"; 
                                    }
                                }else{
                                    echo "<script language=\"JavaScript\">\n";
                                    echo "alert('Password must have at least 8 characters');\n";
                                    echo "</script>"; 
                                }
                                
                            }else{
                              echo "<script language=\"JavaScript\">\n";
                              echo "alert('Wrong password.');\n";
                              echo "</script>"; 
                            }
                        }
                ?>

                    <h1>Change password</h1>
                    </br>

                    <form class="form-horizontal" role="form" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="oldpwd">Old password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="oldpwd" name="oldpwd" placeholder="Enter old password" required>
                            </div>
                        </div>
                        </br>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="newpwd">New password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="newpwd" name="newpwd" placeholder="Enter new password" required >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="newpwd2">Repeat new password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="newpwd2" name="newpwd2" placeholder="Re-enter new password" required>
                            </div>
                        </div>
                        <input type="submit" value="Save" class="btn btn-primary btn-block btn-lg darkbtn" name="savepwd">
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
