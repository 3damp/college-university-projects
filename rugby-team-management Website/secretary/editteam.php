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
                    //Check if team_id is passed from previous page
                    if (isset($_GET['teamid'])) {
                        $team_id = $_GET['teamid'];
                        $_SESSION['team']=$team_id;
                    }else{ //GET team_id from session
                        $team_id = $_SESSION['team'];
                    }
                    //GET team currently editting
                    $tsql = mysqli_query($con,"SELECT * FROM teams WHERE team_id = '$team_id'");
                    $team_result = mysqli_fetch_array($tsql);
                ?>

                <h1><?=$team_result['name']?></h1>
                <?php
                    // if player is meant to be added
                    if (isset($_GET['addid'])) {
                        $add_id = $_GET['addid'];

                        // ADD player to team
                        $addPlayerSql = mysqli_query($con,"UPDATE players SET team_id = '$team_id' WHERE member_id = '$add_id' LIMIT 1");

                    }else if(isset($_GET['removeid'])){
                        $remove_id = $_GET['removeid'];
                        // REMOVE player from team
                        $removePlayerSql = mysqli_query($con,"UPDATE players SET team_id = NULL WHERE member_id = '$remove_id' LIMIT 1");
                    }else if(isset($_GET['addcoach'])){
                        $save_coach_id = $_GET['addcoach'];
                        sout("aed",$save_coach_id);
                        // REMOVE player from team
                        $save_coach_query = mysqli_query($con,"UPDATE teams SET coach_id = '$save_coach_id' WHERE team_id = '$team_id' LIMIT 1");
                    }
                    //GET team currently editting
                    $tsql = mysqli_query($con,"SELECT * FROM teams WHERE team_id = '$team_id'");
                    $team_result = mysqli_fetch_array($tsql);

                    //SHOW coach in team
                    $coach_id = $team_result['coach_id'];
                    
                    $usql = mysqli_query($con,"SELECT * FROM users WHERE id = '$coach_id'");
                    $user_result = mysqli_fetch_array($usql);
                    echo '
                        <h3>Coach</h3>
                        <div class="panel panel-default listbtn-panel">
                            <a class="listbtn" href="#"><div class="panel-body listbtn">'.$user_result['name'].' '.$user_result['surname'].'</div></a>
                        </div>
                        <h3>Players</h3>
                    ';
                    

                    //SHOW players in team
                    $psql = mysqli_query($con,"SELECT * FROM players WHERE team_id = '$team_id'");
                    while ($players_result = mysqli_fetch_array($psql)) {
                        $mem_id = $players_result['member_id'];
                        $usql = mysqli_query($con,"SELECT * FROM users WHERE id = '$mem_id'");
                        $user_result = mysqli_fetch_array($usql);
                        echo '
                            <div class="panel panel-default listbtn-panel">
                                <a class="listbtn" href="editteam.php?removeid='.$user_result['id'].'"><div class="panel-body listbtn">'.$user_result['name'].' '.$user_result['surname'].' <span style="color:#bbb">(click to remove)</span></div></a>
                            </div>
                        ';
                    }
                ?>
                </br>
                <div style="background-color: #ddd; padding: 10;border: 1px solid #ccc;border-radius: 4px;">
                <h3>Add player</h3>
                <form class="form-horizontal" role="form" action="editteam.php" method="get">
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
                    if (isset($_GET['submit'])) {

                        $name       = $_GET['name'];
                        $surname    = $_GET['surname'];
                        $username   = $_GET['username'];


                        if ($username) {
                            echo "<script>console.log('1');</script>";
                            $sql = mysqli_query($con,"SELECT * FROM users WHERE (type=1) AND username = '$username'");
                        }else if ($surname && $name) {
                            $sql = mysqli_query($con,"SELECT * FROM users WHERE (type=1) AND surname = '$surname' AND name = '$name'");
                        }else if ($surname){
                            $sql = mysqli_query($con,"SELECT * FROM users WHERE (type=1) AND surname = '$surname'");
                        }else if ($name){
                            $sql = mysqli_query($con,"SELECT * FROM users WHERE (type=1) AND name = '$name'");
                        }else{
                            $sql = mysqli_query($con,"SELECT * FROM users WHERE (type=1)");
                        }

                        // SHOW search
                        while ($result_array = mysqli_fetch_array($sql)) {
                ?>
                            <div class="panel panel-default listbtn-panel">
                                <a class="listbtn" href="editteam.php?addid=<?=$result_array['id']?>"><div class="panel-body listbtn"><?=$result_array['name']." ".$result_array['surname']?></div></a>
                            </div>
                <?php
                        }
                    }
                ?>
                </div>
                </br>
                <div style="background-color: #ddd; padding: 10;border: 1px solid #ccc;border-radius: 4px;">
                <h3>Add coach</h3>
                <form class="form-horizontal" role="form" action="editteam.php" method="get">
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
                    <input type="submit" value="Search" class="btn btn-primary btn-lg btn-block darkbtn" name="submit_coach">
                </form>
                <?php
                    if (isset($_GET['submit_coach'])) {

                        $name       = $_GET['name'];
                        $surname    = $_GET['surname'];
                        $username   = $_GET['username'];

                        if ($username) {
                            echo "<script>console.log('1');</script>";
                            $sql = mysqli_query($con,"SELECT * FROM users WHERE (type=2) AND username = '$username'");
                        }else if ($surname && $name) {
                            $sql = mysqli_query($con,"SELECT * FROM users WHERE (type=2) AND surname = '$surname' AND name = '$name'");
                        }else if ($surname){
                            $sql = mysqli_query($con,"SELECT * FROM users WHERE (type=2) AND surname = '$surname'");
                        }else if ($name){
                            $sql = mysqli_query($con,"SELECT * FROM users WHERE (type=2) AND name = '$name'");
                        }else{
                            $sql = mysqli_query($con,"SELECT * FROM users WHERE (type=2)");
                        }

                        // SHOW search
                        while ($result_array = mysqli_fetch_array($sql)) {
                ?>
                            <div class="panel panel-default listbtn-panel">
                                <a class="listbtn" href="editteam.php?addcoach=<?=$result_array['id']?>"><div class="panel-body listbtn"><?=$result_array['name']." ".$result_array['surname']?></div></a>
                            </div>
                <?php
                        }
                    }
                ?>
                </div>
                </br></br></br>

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
