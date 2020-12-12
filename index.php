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
    <link rel="stylesheet" href="style-index.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Hospital</title>
    <style>
        body {
            background-color: powderblue;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center">HOSPITAL</h1>
    <span class="oi oi-icon-name" title="icon name" aria-hidden="true"></span>
    <form action="index.php" method="post">
        First name of patient: <input type="text" name="fname">
        Last name of patient: <input type="text" name="lname">
        <input class="btn btn-primary btn-sm" type="submit">
        <br>
        <button class="btn btn-primary btn-sm" name="all" style="margin-top: 20px;">Search all patient</button>
        <button class="btn btn-success btn-sm" formaction="addPatient.php" style="margin-top: 20px;">Add new patient</button>
    </form>
    <!-- <?php
            // if(isset($_POST["searchAll"])){

            ?>
        <table>
                <tr>
                    <th>Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>DoB</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Gender</th>
                </tr>
    <?php
    // while ($row = mysqli_fetch_assoc($result)){
    //     searchPatient($row['Id'], $row['Fname'], $row['Lname'], $row['DOB'], $row['Phone'], $row['Address'], $row['Gender']);
    // }
    ?>
        </table> -->
    <?php
    //} 
    require("patient.php");
    ?>
</body>

</html>