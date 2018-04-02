
<?php
  require_once("php/db.php");
  session_start();
  //Check if there is an active session
  if(isset($_SESSION["user_name"])!=""){
    header("Location: index.php");
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
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="css/mycss.css" rel="stylesheet" />
</head>

  <body>
    <div class="container">


      <?php
        if (!isset($_POST['submit'])){
      ?>
      <div class="container" id="logincontainer">
      
        <form class="form-signin" action="<?=$_SERVER['PHP_SELF']?>" method="post">
          <h2 class="form-signin-heading">Login</h2>
          <label for="inputUsername" class="sr-only">Username</label>
          <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" required autofocus>
          <label for="inputPassword" class="sr-only">Password</label>
          <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
          <button class="btn btn-lg btn-primary btn-block darkbtn" type="submit" name="submit">Login</button>
        </form>
      </div> <!-- /container -->

      <?php
        } else {
          // Check DB connection
          if(mysqli_connect_errno()){
            echo "Connection to DB error: " . mysqli_connect_errno();
            exit();
          }
          
          //Get data from input fields
          $username = $_POST['username'];
          $password = $_POST['password'];
          
          //DB Query
          $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
          $result = mysqli_query($con, $sql);
          
          //Put result of query into array
          $row = mysqli_fetch_array($result);
          
          if (!$row) {
            echo "<script language=\"JavaScript\">\n";
            echo "alert('Wrong username or password.');\n";
            echo "window.location='signin.php'";
            echo "</script>"; 
            exit();
          }

          //Check if we have a data into the array
          if(is_array($row)) {
            $username = $row['username'];
            $database_hash = $row['password'];
            $encrypted_password = md5($password);

            //Compare passwords
            if($encrypted_password == $database_hash){
              $_SESSION["user_id"] = $id;
              $_SESSION["user_name"] = $username;
              header("Location: index.php");
              exit();

            }else{
              echo "<script language=\"JavaScript\">\n";
              echo "alert('Wrong username or password.');\n";
              echo "window.location='signin.php'";
              echo "</script>"; 
              exit();
            }
          } 
        }
      ?>  

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
    <script src="js/bootstrap.min.js"></script></body>
  </body>
</html>
