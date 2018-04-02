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
                
                <?php
                    //Save team id to session to keep editing
                    $usql = mysqli_query($con,"SELECT * FROM users WHERE username = '$active_username'");
                    $u_result = mysqli_fetch_array($usql);
                    $active_id = $u_result['id'];

                    $tsql = mysqli_query($con,"SELECT * FROM teams WHERE coach_id = '$active_id'");
                    $team_result = mysqli_fetch_array($tsql);

                    if($team_result == null){
                        echo '
                            <h1>You don\'t have a team</h1>
                        ';
                        exit();
                    }

                    $team_id = $team_result['team_id'];

                ?>



                <h1>"<?=$team_result['name']?>" games</h1>
                <?php
                    
                

                    $gsql = mysqli_query($con,"SELECT * FROM games WHERE team_id = '$team_id' ORDER BY date1 DESC");

                    //Print all games
                    while ($games_result = mysqli_fetch_array($gsql)) {
                        $date = $games_result['date1'];
                        $opponent = $games_result['opponent'];
                        $game_id = $games_result['game_id'];
                        $g_result = $games_result['result'];

                        echo '
                            <div class="panel panel-default listbtn-panel">
                                <a class="listbtn" href="gamepage.php?gameid='.$game_id.'"><div class="panel-body listbtn" ';

                        if ($g_result!=NULL) {
                            echo 'style="color:#aaa;"';
                        }else{
                            echo 'style="font-weight: bold;"';
                        }
                        
                        
                        echo '>('.$date.')  '.$opponent;

                        // SHOW result if it has been played
                        if ($g_result=='0') { 
                            echo ' <span style="color:green;"><b>(WIN)</b></span>';
                        }else if ($g_result==1) { 
                            echo ' <span style="color:red;"><b>(LOSS)</b></span>';
                        }else if($g_result==2) { 
                            echo ' <span style="color:#ccbd00;"><b>(DRAW)</b></span>';
                        }else{

                        }

                        echo '</div></a>
                            </div>

                        ';
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
