<?php
require_once("../php/db.php");
require_once("../php/userTypeChecker.php");
require_once("../php/functions.php");
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
    <?php require_once("navbar.php"); // Include UI frame ?> 
        <div id="page-wrapper">
            <!-- .container-fluid -->
            <div class="container-fluid"> <!-- ============ PAGE CONTENT ============= -->
                
                <?php

                    //GET user ID
                    if (isset($_GET['gameid'])) {
                        $game_id = $_GET['gameid'];
                    }else{
                        echo "<script language=\"JavaScript\">\n";
                        echo "window.location='games.php'";
                        echo "</script>";
                        exit();
                    }

                    if(isset($_POST['save'])){

                        $opponent       = $_POST['opponent'];
                        $date           = $_POST['date'];
                        $location       = intval($_POST['location']);
                        $result         = intval($_POST['result']);
                        $score          = $_POST['score'];
                        $comments1a     = $_POST['comments1a'];
                        $comments1b     = $_POST['comments1b'];
                        $comments2a     = $_POST['comments2a'];
                        $comments2b     = $_POST['comments2b'];


                        $sql = mysqli_query($con,"UPDATE games SET opponent = '$opponent', date1 = '$date', location = '$location', result = '$result', score = '$score', comments1a = '$comments1a', comments1b = '$comments1b', comments2a = '$comments2a', comments2b = '$comments2b' WHERE game_id=$game_id ");
                    }

                    if(isset($_POST['save_pos'])){
                        $position_id    = intval($_POST['position']);
                        $rate           = intval($_POST['rate']);
                        $addpos = mysqli_query($con, "INSERT INTO positions (member_id, position_id, rate) VALUES ('$user_id','$position_id','$rate')");
                    }


                    //GET game array
                    $usql = mysqli_query($con,"SELECT * FROM games WHERE game_id = '$game_id'");
                    $game_result = mysqli_fetch_array($usql);
                    

                    $opponent       = $game_result['opponent'];
                    $date           = $game_result['date1'];
                    $location       = $game_result['location'];
                    $result         = $game_result['result'];
                    $score          = $game_result['score'];
                    $comments1a     = $game_result['comments1a'];
                    $comments1b     = $game_result['comments1b'];
                    $comments2a     = $game_result['comments2a'];
                    $comments2b     = $game_result['comments2b'];
                    

                ?>


                <h1>Edit Game</h1>

            
                </br></br>

                <form class="form-horizontal" role="form" action="gamepage.php?gameid=<?=$game_id?>" method="post">

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="opponent">Opponent</label>
                        <div class="col-sm-10">
                            <input type="text" value="<?=$opponent?>"  class="form-control" id="opponent" name="opponent" placeholder="Enter surname" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="date">Date</label>
                        <div class="col-sm-10">
                            <input type="date" value="<?=$date?>"  class="form-control" id="date" name="date" placeholder="Enter date" required>
                        </div>
                    </div>

                    <?php include("radios.php");?>

                    <label class="control-label col-sm-2">Location</label>
                    <div class="radio">
                        <?php radioLocation($location);?>
                        </br></br>
                    </div>

                    <label class="control-label col-sm-2">Result</label>
                    <div class="radio">
                        <?php radioResult($result);?>
                        </br></br>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="score">Score</label>
                        <div class="col-sm-10">
                            <input type="text" value="<?=$score?>"  class="form-control" id="score" name="score" placeholder="0 - 0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="comments1a">1st Half (SR)</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="4" id="comments1a" name="comments1a"><?=$comments1a?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="comments1b">1st Half (Opponent)</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="4" id="comments1b" name="comments1b"><?=$comments1b?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="comments2a">2nd Half (SR)</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="4" id="comments2a" name="comments2a"><?=$comments2a?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="comments2b">2nd Half (Opponent)</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="4" id="comments2b" name="comments2b"><?=$comments2b?></textarea>
                        </div>
                    </div>

                    

                    </br>
                    <input type="submit" value="Save" class="btn btn-primary btn-lg btn-block darkbtn" name="save">
                </form>

                <?php
                    

                    
                

                    
                ?>
                <!--
                <form class="form-horizontal" role="form" action="playerpage.php?gameid=<?=$game_id?>" method="post">
                    
                    <input type="submit" value="Delete Game" class="btn btn-primary btn-lg btn-block darkbtn" name="save_pos">
                </form>
                -->

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
