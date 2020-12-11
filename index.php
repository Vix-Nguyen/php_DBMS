<?php
require_once("connection.php");
require_once("component.php");

$sql = "SELECT * FROM patient";
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"/>
    <title>Hospital</title>
</head>
<body>
    <h1>HOSPITAL</h1>
    <form action="index.php" method="post">
    First name of patient: <input type="text" name="fname">
    Last name of patient: <input type="text" name="lname">
        <input type="submit" value="Search">
        <br>
        <button name="all"  style="margin-top: 20px;">Search all patient</button>
        <button formaction="addPatient.php" method="post">Add new patient</button>
        <button formaction="addPatient.php" method="post">Add new patient info</button>
    </form>
    <?php
        require("patient.php");
    ?>
</body>
</html>