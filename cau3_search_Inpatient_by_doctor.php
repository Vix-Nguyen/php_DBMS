<?php
require_once("connection.php");
require_once("component.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-main.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Search by doctor's name</title>
    <style>
        body {
            background-color: powderblue;
        }
    </style>
</head>
<body>
    <h1 style="text-align:center;">HOSPITAL DBS2021</h1>
    <h2 style="margin-left:10px;">Search patient by Doctor's name</h2>
    </br>
    <form action="cau3_search_Inpatient_by_doctor.php" method="post" style="margin-left:10px;font-size:18px;font-weight:bold;">
    First name of Doctor: <input type="text" name="fname" style="font-size:16px;">
    Last name of Doctor: <input type="text" name="lname" style="font-size:16px;">
    <input class="btn btn-primary btn-sm" type="submit" value="Search" style="margin-left: 5px;font-size:16px;">
    </form>

    <?php require("InpatientByDoctor.php"); ?>
</body>
</html>