<?php
require_once("connection.php");
require_once("component.php");

// $sql = "SELECT * FROM patient";
// $result = mysqli_query($conn, $sql);

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
    <h1>HOSPITAL_DBS</h1>
    <h2>Search Inpatient by Doctor</h2>
    <form action="cau3_search_Inpatient_by_doctor.php" method="post">
    First name of Doctor: <input type="text" name="fname">
    Last name of Doctor: <input type="text" name="lname">
    <input type="submit">
    </form>

    <?php
    //} 
    require("InpatientByDoctor.php");
    ?>
</body>
</html>