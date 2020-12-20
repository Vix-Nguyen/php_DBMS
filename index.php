<?php
   include("connection.php");
   session_start();
   $error = "";
   $_SESSION['is_logged_in'] = FALSE;
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      $username = mysqli_real_escape_string($conn,$_POST['username']);
      $password = mysqli_real_escape_string($conn,$_POST['password']);
      
      if (strlen($username) > 0 && strlen($password) > 0) {
         $sql = "SELECT id FROM DBA WHERE username = '$username' and password = '$password'";
         $result = mysqli_query($conn,$sql);     
         $count = mysqli_num_rows($result);

         if ($count == 1) {
            $_SESSION['login_user'] = $username;
            $_SESSION['is_logged_in'] = TRUE;
            $error = "Login successfully!";
            echo "<script>setTimeout(\"location = 'main.php';\", 500);</script>";
         } else {
            $error = "Your Login Name or Password is invalid";
         }
      }
      else if (strlen($username) == 0 && strlen($password) > 0) {
         $error = "Please enter user name!";
      }
      else if (strlen($username) > 0 && strlen($password) == 0) {
         $error = "Please enter password!";
      }
   }
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Login</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:20px;
            text-align: left;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:16px;
         }
         .box {
            margin: center;
            border:#666666 solid 2px;
            font-size:16px;
            text-align: left;
         }
         .center {
            margin: auto;
            width: 20%;
            padding: 10px;
         }
         input[type=submit] {
            font-size:18px;
            text-align: center;
            margin: right;
         }
      </style>
      
   </head>
   
   <body color = "#FFFFFF">
      <div class = "center">
         <div style = "width:300px; border: solid 2px #333333;">
            <div style = "background-color:#333333; color:#FFFFFF; padding:2px;text-align:center;"><strong>Login</strong></div>
            <div style = "margin:30px">
               <form action = "" method = "post">
                  <label>Username:  </label><input type = "text" name = "username" class = "box"/> <br> <br>
                  <label>Password:  <br> </label><input type = "password" name = "password" class = "box"/> <br> <br>
                  <input type = "submit" value = "Login" name="but_login" id="but_login"/><br/>
               </form>
               
               <div style = "font-size:18px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>