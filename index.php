<?php
   include("connection.php");
   session_start();
   $error = "";
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      $username = mysqli_real_escape_string($conn,$_POST['username']);
      $password = mysqli_real_escape_string($conn,$_POST['password']);
      
      $sql = "SELECT id FROM DBA WHERE username = '$username' and password = '$password'";
      $result = mysqli_query($conn,$sql);     
      $count = mysqli_num_rows($result);

      if($count == 1) {
         $_SESSION['username'] = $username;
         header("location: main.php");
      } else {
         $error = "Your Login Name or Password is invalid";
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
            font-size:14px;
            text-align: center;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
         div {
            text-align: left;
         }
      </style>
      
   </head>
   
   <body color = "#FFFFFF">
      <div>
         <div style = "width:300px; border: solid 1px #333333; ">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><strong>Login</strong></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>UserName:  </label><input type = "text" name = "username" class = "box"/> <br> <br>
                  <label>Password:  <br> </label><input type = "password" name = "password" class = "box"/> <br> <br>
                  <input type = "submit" value = " Login "/><br/>
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>