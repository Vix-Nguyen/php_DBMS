<?php
require_once("connection.php");

$sql = "SELECT id FROM nurse";
$result = mysqli_query($conn, $sql);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
    <style>
        body {
            background-color: powderblue;
        }
    </style>
</head>

<body>
    <h2>Add new patient infor: CLASS INPATIENT</h2>
    <form action="addInpatient.php" style="margin-left: 40%;" method="post">

        <label for="adm">Admission date:</label><br>
        <input type="date" name="adm"><br><br>

        <label for="disc">Discharge date:</label><br>
        <input type="date" name="disc"><br><br>

        <label for="fee">Fee:</label><br>
        <input type="number" name="fee">vnd<br><br>

        <label for="sckr">Sick Room:</label><br>
        <input type="text" name="sckr" placeholder=""><br><br>

        <label for="nurse">Nurse ID:</label>
        <select name="nurse" name="nurse">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                echo "<option value='$id' selected>$id</option>";
            }
            ?>
        </select><br><br>

        <input class="btn btn-primary" name="submit2" type="submit" value="Submit">
    </form>
</body>

</html>
<?php
// error_reporting(0);

if (!isset($_POST['submit2'])) {
    // echo '<script>alert("This ID is  valid")</script>';
    exit;
}
session_start();
$id = $_SESSION['id'];
$adm = isset($_POST['adm']) ? $_POST['adm'] : '';
$disc = isset($_POST['disc']) ? $_POST['disc'] : '';
$fee = isset($_POST['fee']) ? $_POST['fee'] : '';
$sckr = isset($_POST['sckr']) ? $_POST['sckr'] : '';
$nurse = isset($_POST['nurse']) ? $_POST['nurse'] : '';

$sql = "INSERT INTO inpatient (Id, AdmissionDate, DischargeDate, Fee, SickRoom, NurseID)
VALUES ('$id', '$adm', '$disc', '$fee', '$sckr', '$nurse');";

if (mysqli_multi_query($conn, $sql)) {

    echo '<script>alert("Add Inpatient successful")</script>';
    header("location:index.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

unset($_POST);

?>