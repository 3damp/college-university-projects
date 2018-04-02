

<?php
require_once("php/db.php");
require_once("php/functions.php");
session_start();

if(!isset($_SESSION["user_name"])!=""){
    echo "<script language=\"JavaScript\">\n";
    echo "window.location='signin.php'";
    echo "</script>";
    exit();
}
?>

<html lang="en">
<head>
    <meta name="generator" content="HTML Tidy for HTML5 (experimental) for Windows https://github.com/w3c/tidy-html5/tree/c63cc39" />
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="../../favicon.ico" />
    <title>TITLE</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="css/mycss.css" rel="stylesheet" />
    <!--<link href="css/sb-admin.css" rel="stylesheet">-->

</head>

<body>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Simply Rugby</a>
            </div>
            
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
                        <a href="logout.php"><i class=""></i>Logout</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->







    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> 
    <!-- JAVASCRIPT IMPORT-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
