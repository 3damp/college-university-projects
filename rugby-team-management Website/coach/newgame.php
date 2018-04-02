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
                    //Get coach id
                    $usql = mysqli_query($con,"SELECT * FROM users WHERE username = '$active_username'");
                    $u_result = mysqli_fetch_array($usql);
                    $active_id = $u_result['id'];
                    //Get team id
                    $tsql = mysqli_query($con,"SELECT * FROM teams WHERE coach_id = '$active_id'");
                    $team_result = mysqli_fetch_array($tsql);

                    if($team_result == null){
                        echo '
                            <h1>You don\'t have a team</h1>
                        ';
                        exit();
                    }else {
                        $team_id = $team_result['team_id'];
                    }
                    if (!isset($_POST['submit']) && $team_result != null) {

                ?>
                <!-- Form -->
                <h1>New Game</h1>
                <form class="form-horizontal" role="form" action="newgame.php" method="post">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="bdate">Date<span style="color:red;"> *</span></label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="bdate" name="date" placeholder="Enter date" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">Opponent<span style="color:red;"> *</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="opponent" placeholder="Enter name" required>
                        </div>
                    </div>
                    
                    <label class="control-label col-sm-2">Location<span style="color:red;"> *</span></label>
                    <div class="radio">
                        <label><input type="radio" value="0" name="location" required>Home </label>
                        <label><input type="radio" value="1" name="location">Away </label>
                        </br></br>
                    </div>
                    
                    </br></br>
                    <input type="submit" value="Submit" class="btn btn-primary btn-lg btn-block darkbtn" name="submit">
                    </br>
                </form>
                <!-- /form -->


                <?php
                    }else{
                        $opponent   = $_POST['opponent'];
                        $date = $_POST['date'];
                        $location = $_POST['location'];

                        // Insert new game to the database
                        $insert_game = "INSERT INTO games (team_id, opponent, date1, location) VALUES ('$team_id', '$opponent', '$date', '$location')";
                        $insert_game_query = mysqli_query($con, $insert_game);

                        
                        //redirect
                        echo "<script language=\"JavaScript\">\n";
                        echo "alert('Game created!.');\n";
                        echo "window.location='games.php'";
                        echo "</script>";
                        exit();
                        

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
