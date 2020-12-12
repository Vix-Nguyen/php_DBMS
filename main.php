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
    <h1>HOSPITAL DBS2021</h1>
    <form action="main.php" method="post">
    First name of patient: <input type="text" name="fname">
    Last name of patient: <input type="text" name="lname">
        <input type="submit" value="Search" style="margin-left: 5px;">
        <button style="margin-left: 5px; margin-bottom: 20px;" name="all">Search all patient</button>
        <br>

        <button formaction="addPatient.php" method="post" style="margin-bottom: 20px;">Add new patient</button>
        <button formaction="cau3_search_Inpatient_by_doctor.php" method="post" style="margin-left: 5px;">Search by doctor name</button>
        <button formaction="cau4_search_payment_by_patient.php" method="post" style="margin-left: 5px;">Search patient's payment</button>
    </form>
    <?php require("patient.php"); ?>
</body>
</html>