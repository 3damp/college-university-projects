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
                    


                    if (isset($_POST['submit'])) {

                        $username   = $_POST['username'];
                        $name       = $_POST['name'];
                        $surname    = $_POST['surname'];
                        $email      = $_POST['email'];
                        $email2     = $_POST['email2'];
                        $bdate      = $_POST['bdate'];
                        $address    = $_POST['address'];
                        $postcode   = $_POST['postcode'];
                        $tnum       = $_POST['tnum'];
                        $mnum       = $_POST['mnum'];
                        $type       = $_POST['type'];
                        $sru        = $_POST['sru'];
                        $id         = $_POST['mid'];
                        

                        
                        

                        if($email != $email2){
                            echo "<script language=\"JavaScript\">\n";
                            echo "alert('Emails did not match');\n";
                            echo "window.location='index.php'";
                            echo "</script>";
                            //exit();
                        }else{
                            if (isset($_POST['resetpwd'])) {
                                $date1 = explode("-", $bdate);
                                $password = "$date1[0]"."$date1[1]"."$date1[2]";
                                $encrypted_password = md5($password); //encrypt password

                                $insert_user = "UPDATE users SET username='$username', name='$name', surname='$surname', email='$email', tnum='$tnum', mnum='$mnum', postcode='$postcode', address='$address', bdate='$bdate', type='$type', sru='$sru', password='$encrypted_password' WHERE username='$username' LIMIT 1";
                            }else{
                                $insert_user = "UPDATE users SET username='$username', name='$name', surname='$surname', email='$email', tnum='$tnum', mnum='$mnum', postcode='$postcode', address='$address', bdate='$bdate', type='$type', sru='$sru' WHERE username='$username' LIMIT 1";
                            }

                            if ($type==1) {
                                // Check previous user type
                                $tempresult = mysqli_query($con, "SELECT * FROM users WHERE username = '$username' LIMIT 1");
                                $tempresult_array = mysqli_fetch_array($tempresult);

                                if ($tempresult_array['type']==1) { //if previous type was 'player': 
                                    if (isset($_POST['junior'])) { // set junior value
                                        $junior = 1;
                                    }else{
                                        $junior = 0;
                                    }
                                    
                                    $doc_name = $_POST['doc_name'];
                                    $doc_tel = $_POST['doc_tel'];
                                    $doc_address = $_POST['doc_address'];
                                    $health_issues = $_POST['health_issues'];
                                    $nextofkin_name = $_POST['nextofkin_name'];
                                    $nextofkin_tel = $_POST['nextofkin_tel'];
                                    $guardian1_name = $_POST['guardian1_name'];
                                    $guardian1_address = $_POST['guardian1_address'];
                                    $guardian2_name = $_POST['guardian2_name'];
                                    $guardian2_address = $_POST['guardian2_address'];

                                    // Check if there's an entry in players table for this user
                                    $p_result = mysqli_query($con, "SELECT * FROM players WHERE member_id = '$id' LIMIT 1");
                                    $p_result_array = mysqli_fetch_array($p_result);

                                    if($p_result_array !== null){ //UPDATE entry
                                        sout("exists",$id);
                                        $save_player = "UPDATE players SET junior='$junior', doc_name='$doc_name', doc_tel='$doc_tel', doc_address='$doc_address', health_issues='$health_issues', nextofkin_name='$nextofkin_name', nextofkin_tel='$nextofkin_tel', guardian1_name='$guardian1_name', guardian1_address='$guardian1_address', guardian2_name='$guardian2_name', guardian2_address='$guardian2_address' WHERE member_id='$id' LIMIT 1";
                                    }else{ // CREATE new entry
                                        sout("no exists",$id);
                                        $save_player = "INSERT INTO players (member_id, junior, doc_name, doc_tel, doc_address, health_issues, nextofkin_name, nextofkin_tel, guardian1_name, guardian1_address, guardian2_name, guardian2_address) VALUES ('$id','$junior', '$doc_name', '$doc_tel', '$doc_address', '$health_issues', '$nextofkin_name', '$nextofkin_tel', '$guardian1_name', '$guardian1_address', '$guardian2_name', '$guardian2_address')";
                                    }

                                    
                                    $insert_player_query = mysqli_query($con, $save_player);
                                }

                                
                            }

                            // Update user to the database
                            $insert_user_query = mysqli_query($con, $insert_user);
                        }

                        $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";

                    }else{
                        $id = $_GET['id'];
                        $sql = "SELECT * FROM users WHERE id = '$id' LIMIT 1";
                    }
                    

                ?>
                <!-- Form -->
                <h1>Edit member details<span style="color: green"> <?php asd(isset($_POST['submit'])); ?></span></h1>

                <?php
                    //retrieve data from database
                    
                    $result = mysqli_query($con, $sql);
                    $result_array = mysqli_fetch_array($result);

                    $id = $result_array['id'];
                    $username = $result_array['username'];
                    $name = $result_array['name'];
                    $surname = $result_array['surname'];
                    $email = $result_array['email'];
                    $bdate = $result_array['bdate'];
                    $address = $result_array['address'];
                    $postcode = $result_array['postcode'];
                    $tnum = $result_array['tnum'];
                    $mnum = $result_array['mnum'];
                    $type = $result_array['type'];
                    $sru = $result_array['sru'];

                ?>

                <form class="form-horizontal" role="form" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    </br>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="type">Type</label>
                        <div class="col-sm-10">
                            <?php typeradio($type);?>
                        </div>
                    </div>
                    <div class="form-group" style="visibility: hidden;">
                        <label class="control-label col-sm-2" for="mid">Id</label>
                        <div class="col-sm-10">
                            <input  type="number" value="<?=$id?>" class="form-control" id="mid" name="mid" placeholder="Enter username" >
                        </div>
                    </div>
                    
                        
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="username">Username</label>
                        <div class="col-sm-10">
                            <input type="text" value="<?=$username?>" class="form-control" id="username" name="username" placeholder="Enter username" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">Name</label>
                        <div class="col-sm-10">
                            <input type="text" value="<?=$name?>" class="form-control" id="name" name="name" placeholder="Enter name" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="surname">Surname</label>
                        <div class="col-sm-10">
                            <input type="text" value="<?=$surname?>"  class="form-control" id="surname" name="surname" placeholder="Enter surname" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Email</label>
                        <div class="col-sm-10">
                            <input type="email" value="<?=$email?>"  class="form-control" id="email" name="email" placeholder="Enter email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email2">Repeat Email</label>
                        <div class="col-sm-10">
                            <input type="email" value="<?=$email?>"  class="form-control" id="email2" name="email2" placeholder="Re-enter email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="bdate">Date of birth</label>
                        <div class="col-sm-10">
                            <input type="date" value="<?=$bdate?>"  class="form-control" id="bdate" name="bdate" placeholder="Enter date of birth" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="address">Address</label>
                        <div class="col-sm-10">
                            <textarea class="form-control"  rows="4" id="address" name="address" required><?=$address?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="postcode">Postcode</label>
                        <div class="col-sm-10">
                            <input type="text" value="<?=$postcode?>"  class="form-control" id="postcode" name="postcode" placeholder="Enter postcode" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="tnum">Phone number:</label>
                        <div class="col-sm-10">
                            <input type="tel" value="<?=$tnum?>" class="form-control" id="tnum" name="tnum">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="mnum">Mobile number</label>
                        <div class="col-sm-10">
                            <input type="tel" value="<?=$mnum?>" class="form-control" id="mnum" name="mnum" placeholder="Enter number" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="sru">SRU</label>
                        <div class="col-sm-10">
                            <input type="text" value="<?=$sru?>" class="form-control" id="sru" name="sru" placeholder="Enter SRU">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="rpwd"></label>
                        <div class="col-sm-10">
                            <input type="checkbox" id="rpwd" name="resetpwd"><label for="rpwd">Reset Password</label>
                        </div>
                    </div>

                    

                    <?php 
                        if ($type==1 && exists("players",$id)) {
                            //echo "<script>console.log('Name: ".$id."');</script>";
                            $p_result = mysqli_query($con, "SELECT * FROM players WHERE member_id = '$id' LIMIT 1");
                            $player_array = mysqli_fetch_array($p_result);
                            playerFilledFields($player_array);
                        }else if ($type==1) {
                            playerEmptyFields();
                        }
                        if ($type==2 && exists("coaches",$id)) {
                            $c_result = mysqli_query($con, "SELECT * FROM coaches WHERE member_id = '$id' LIMIT 1");
                            $coach_array = mysqli_fetch_array($c_result);
                            coachFilledFields($coach_array);
                        }else if ($type==2) {
                            coachEmptyFields();
                        }
                        
                    ?>


                    </br></br> <!-- SUBMIT BUTTON -->
                    <input type="submit" value="Save" class="btn btn-primary btn-lg btn-block darkbtn" name="submit">
                    </br>
                
                </form>
                <!-- /form -->
                


                <?php
                    
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
