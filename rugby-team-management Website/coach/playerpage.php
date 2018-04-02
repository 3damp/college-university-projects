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
    <?php require_once("navbar.php");?>
        <div id="page-wrapper">
            <!-- .container-fluid -->
            <div class="container-fluid"> <!-- ============ PAGE CONTENT ============= -->
                
                <?php

                    //GET user ID
                    if (isset($_GET['userid'])) {
                        $user_id = $_GET['userid'];
                    }else{
                        echo "<script language=\"JavaScript\">\n";
                        echo "window.location='myteam.php'";
                        echo "</script>";
                        exit();
                    }

                    if(isset($_POST['save'])){

                        $standard   = intval($_POST['standard']);
                        $spin       = intval($_POST['spin']);
                        $side       = intval($_POST['side']);
                        $scrabble   = intval($_POST['scrabble']);
                        $rear       = intval($_POST['rear']);
                        $punt       = intval($_POST['punt']);
                        $pop        = intval($_POST['pop']);
                        $grabber    = intval($_POST['grabber']);
                        $goal       = intval($_POST['goal']);
                        $front      = intval($_POST['front']);
                        $drop       = intval($_POST['drop']);
                        $comments   = $_POST['comments'];


                        $sql = mysqli_query($con,"UPDATE players SET comments = '$comments', standard = $standard, spin = $spin, side = $side, scrabble = $scrabble, rear = $rear, punt = $punt, pop = $pop, grabber = $grabber, goal = $goal, front = $front, drop1 = $drop WHERE member_id=$user_id ");
                    }
                    if(isset($_POST['save_pos'])){
                        $position_id    = intval($_POST['position']);
                        $rate           = intval($_POST['rate']);
                        $addpos = mysqli_query($con, "INSERT INTO positions (member_id, position_id, rate) VALUES ('$user_id','$position_id','$rate')");
                    }


                    //GET user currently viewing
                    $usql = mysqli_query($con,"SELECT * FROM users WHERE id = '$user_id'");
                    $user_result = mysqli_fetch_array($usql);
                    $psql = mysqli_query($con,"SELECT * FROM players WHERE member_id = '$user_id'");
                    $player_result = mysqli_fetch_array($psql);

                    $standard   = $player_result['standard'];
                    $spin       = $player_result['spin'];
                    $side       = $player_result['side'];
                    $scrabble   = $player_result['scrabble'];
                    $rear       = $player_result['rear'];
                    $punt       = $player_result['punt'];
                    $pop        = $player_result['pop'];
                    $grabber    = $player_result['grabber'];
                    $goal       = $player_result['goal'];
                    $front      = $player_result['front'];
                    $drop       = $player_result['drop1'];
                    $comments   = $player_result['comments'];

                ?>


                <h1><?=$user_result['name']." ".$user_result['surname']?></h1>

                
                    
                        
                    
                <span style="text-decoration: "><b>Email: </b></span><span><?=$user_result['email']?></span></br>

                <?php
                    // ========== BEST POSITION CALCULATOR ===========
                    $sql = mysqli_query($con,"SELECT * FROM positions WHERE member_id = '$user_id'");
                    // IF there's any position stored
                    if (mysqli_num_rows($sql)) { 
                        $temp = [0,0,0,0,0,0,0,0,0,0];
                        $best_rate = 3;
                        $best_pos = 0;
                        //CHECK what is the best rate from all positions stored
                        while ($positions_result = mysqli_fetch_array($sql)) {
                            if ($positions_result['rate']>=$best_rate) {
                                $best_rate = $positions_result['rate'];
                            }
                        }
                        //GET those entries that match the maximum rate
                        $sql = mysqli_query($con,"SELECT * FROM positions WHERE member_id = '$user_id' AND rate >= '$best_rate'");
                        //COUNT how many entries are there for each position with maximum rate
                        while ($positions_result = mysqli_fetch_array($sql)) {
                            if ($positions_result['rate']>=$best_rate) {
                                $temp[$positions_result['position_id']]++;
                            }
                        }
                        //CHECK which of the best positions is the most frequent
                        $highest = 0;
                        foreach ($temp as $key => $value) {
                            if ($value>$highest) {
                                $best_pos = $key;
                                $highest = $value;
                            }
                        }
                        //PRINT Best position
                        switch ($best_pos) {
                            case 1:
                                echo '<span style="text-decoration: "><b>Best Position: </b></span><span>Full back</span></br>';
                                break;
                            case 2:
                                echo '<span style="text-decoration: "><b>Best Position: </b></span><span>Wing</span></br>';
                                break;
                            case 3:
                                echo '<span style="text-decoration: "><b>Best Position: </b></span><span>Centre</span></br>';
                                break;
                            case 4:
                                echo '<span style="text-decoration: "><b>Best Position: </b></span><span>Fly half</span></br>';
                                break;
                            case 5:
                                echo '<span style="text-decoration: "><b>Best Position: </b></span><span>Scrum half</span></br>';
                                break;
                            case 6:
                                echo '<span style="text-decoration: "><b>Best Position: </b></span><span>Hooker</span></br>';
                                break;
                            case 7:
                                echo '<span style="text-decoration: "><b>Best Position: </b></span><span>Prop</span></br>';
                                break;
                            case 8:
                                echo '<span style="text-decoration: "><b>Best Position: </b></span><span>2nd row</span></br>';
                                break;
                            case 9:
                                echo '<span style="text-decoration: "><b>Best Position: </b></span><span>Back row</span></br>';
                                break;
                            default:
                                echo '<span style="text-decoration: "><b>Best Position: </b></span><span>NOT AVAILABLE</span></br>';
                                break;
                        }
                    //If there's not enough data, it won't show any position
                    }else{
                        echo '<span style="text-decoration: "><b>Best Position: </b></span><span>'."NOT AVAILABLE".'</span></br>';
                    }
                    // ====== END BEST POSITION CALCULATOR ==========

                ?>
                    
                

            
                </br></br>

                <form class="form-horizontal" role="form" action="playerpage.php?userid=<?=$user_id?>" method="post">


                    <?php printSkillRadio("standard",$standard);?>
                    <?php printSkillRadio("spin",$spin);?>
                    <?php printSkillRadio("side",$side);?>
                    <?php printSkillRadio("scrabble",$scrabble);?>
                    <?php printSkillRadio("rear",$rear);?>
                    <?php printSkillRadio("punt",$punt);?>
                    <?php printSkillRadio("pop",$pop);?>
                    <?php printSkillRadio("grabber",$grabber);?>
                    <?php printSkillRadio("goal",$goal);?>
                    <?php printSkillRadio("front",$front);?>
                    <?php printSkillRadio("drop",$drop);?>
                    </br>

                    
                    

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="comments">Comments</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="4" id="comments" name="comments"><?=$comments?></textarea>
                        </div>
                    </div>

                    

                    </br>
                    <input type="submit" value="Save" class="btn btn-primary btn-lg btn-block darkbtn" name="save">
                </form>

                <?php
                    

                    
                

                    
                ?>
                
                <h2>Register played position</h2>
                <form class="form-horizontal" role="form" action="playerpage.php?userid=<?=$user_id?>" method="post">
                    <label class="control-label col-sm-2">Position played</label>
                    <div class="radio">
                        <label><input type="radio" value="1" name="position" required>Full back</label>
                        <label><input type="radio" value="2" name="position">Wing</label>
                        <label><input type="radio" value="3" name="position">Centre</label>
                        <label><input type="radio" value="4" name="position">Fly half</label>
                        <label><input type="radio" value="5" name="position">Scrum half</label>
                        <label><input type="radio" value="6" name="position">Hooker</label>
                        <label><input type="radio" value="7" name="position">Prop</label>
                        <label><input type="radio" value="8" name="position">2nd row</label>
                        <label><input type="radio" value="9" name="position">Back row</label>
                    </div>
                    </br>
                    <label class="control-label col-sm-2">Rate</label>
                    <div class="radio">
                        <label><input type="radio" value="1" name="rate" required>1 </label>
                        <label><input type="radio" value="2" name="rate">2 </label>
                        <label><input type="radio" value="3" name="rate">3 </label>
                        <label><input type="radio" value="4" name="rate">4 </label>
                        <label><input type="radio" value="5" name="rate">5 </label>
                    </div>
                    </br>
                    <input type="submit" value="Add Position" class="btn btn-primary btn-lg btn-block darkbtn" name="save_pos">
                </form>


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
