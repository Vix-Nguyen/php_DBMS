<?php
require_once("connection.php");
require_once("component.php");
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
    <h1>HOSPITAL DBS2021</h1>
    <h2>Search patient by Doctor</h2>
    <form action="cau3_search_Inpatient_by_doctor.php" method="post">
    First name of Doctor: <input type="text" name="fname">
    Last name of Doctor: <input type="text" name="lname">
    <input type="submit" value="Search" style="margin-left: 5px;margin-bottom: 20px;">
    </form>

    <?php require("InpatientByDoctor.php"); ?>
</body>
</html>