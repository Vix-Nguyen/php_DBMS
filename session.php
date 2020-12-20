<?php
   include('connection.php');
   session_start();
   // Check user login or not
   if(!$_SESSION['is_logged_in']) {
      echo "<h3 style='text-align:center;font-size:18px; color:#cc0000; margin-top:10px'>You must login first!</h3>";
      echo "<script>setTimeout(\"location ='index.php';\", 1000);</script>";
   }

   else {
      $user_check = $_SESSION['login_user'];
      
      $ses_sql = mysqli_query($conn,"select username from dba where username = '$user_check' ");
      
      $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
      
      $login_session = $row['username'];
      
      if(!isset($_SESSION['login_user'])){
         echo "Session expired!";
         $_SESSION['is_logged_in'] = FALSE;
         die();
         echo "<script>setTimeout(\"location = 'index.php';\",2000);</script>";
      }
   }
?>