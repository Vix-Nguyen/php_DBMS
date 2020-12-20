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
    <h2>Search for payment of a patient</h2>
    <form action="cau4_search_payment_by_patient.php" method="post">
    First name of Patient: <input type="text" name="fname">
    Last name of Patient: <input type="text" name="lname">
    <input type="submit" value="Search" style="margin-left: 5px;margin-bottom: 20px;">
    </form>

    <?php require("paymentByPatient.php"); ?>
</body>
</html>