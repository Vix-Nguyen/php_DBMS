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
    <link rel="stylesheet" href="style-main.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>HOSPITAL DBS2021</title>
    <style>
        body {
            background-color: powderblue;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center">HOSPITAL DBS2021</h1>
    <form action="main.php" method="post" style="margin-left:10px;font-size:18px;font-weight:bold;">
    First name of patient: <input type="text" name="fname" style="font-size:16px;">
    Last name of patient: <input type="text" name="lname" style="font-size:16px;">
        <input class="btn btn-primary btn-sm" type="submit" value="Search" style="margin-left:5px;font-size:16px;">
        <button class="btn btn-primary btn-sm" style="margin-left:5px;font-size:16px;" name="all">Search all</button>
        </br>
        <button class="btn btn-success btn-sm" formaction="addPatient.php" method="post" style="margin-top: 10px;margin-bottom: 10px;font-size:16px;">Add new patient</button>
        <button class="btn btn-success btn-sm" formaction="cau3_search_Inpatient_by_doctor.php" method="post" style="margin-top: 10px;margin-bottom: 10px;font-size:16px;">Search by doctor name</button>
        <button class="btn btn-success btn-sm" formaction="cau4_search_payment_by_patient.php" method="post" style="margin-top: 10px;margin-bottom: 10px;font-size:16px;">Search patient's payment</button>
    </form>
    <?php require("patient.php"); ?>
</body>
</html>