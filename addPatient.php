<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
    <form action="main.php" method="post" style="float:left;margin-top:10px; margin-left:10px">
        <button name = "btn_back" id = "btn_back" method="post" class="btn btn-success btn-sm"> < Back </button>
    <br>
    </form>
    <style>
        body {
            background-color: powderblue;
        }
    </style>
</head>

<body>
    <h2 style="text-align:center; margin-top:20px;">Add new patient</h2>
    <form class="form-group" action="addPatient.php" style="margin-left: 40%;" method="post">
        <label for="fname">First name:</label><br>
        <input type="text" name="fname" placeholder="John"><br><br>

        <label for="lname">Last name:</label><br>
        <input type="text" name="lname" placeholder="Smith"><br><br>

        <label for="class">Class:</label>
        <select name="class" name="class">
            <option value="IP" selected>Inpatient</option>
            <option value="OP">Outpatient</option>
        </select><br><br>


        <label for="DOB">Date of Birth:</label><br>
        <input type="date" name="DOB"><br><br>

        <label for="phone">Phone number:</label><br>
        <input type="number" name="phone" placeholder="0825001927"><br><br>

        <label for="address">Address:</label><br>
        <input type="text" name="address" placeholder="12 Ly Thuong Kiet, Quan 10, Thanh pho Ho Chi Minh"><br><br>

        <label for="Gender">Gender:</label>
        <select name="Gender" name="Gender">
            <option value="Male" selected>Male</option>
            <option value="Female">Female</option>
        </select><br><br>



        <input class="btn btn-primary" name="submit" type="submit" value="Save">
    </form>
</body>

</html>

<?php
error_reporting(0);

require("connection.php");
include('session.php');


if (!isset($_POST['submit'])) {
    // echo '<script>alert("This ID is  valid")</script>';
    exit;
}

$fname = isset($_POST['fname']) ? $_POST['fname'] : '';
$lname = isset($_POST['lname']) ? $_POST['lname'] : '';
$class = isset($_POST['class']) ? $_POST['class'] : '';
// $id = isset($_POST['id']) ? $_POST['id'] : '';
$DOB = isset($_POST['DOB']) ? $_POST['DOB'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';
$gender = isset($_POST['Gender']) ? $_POST['Gender'] : '';


// $result = mysqli_query($conn, $sql);
// $row = mysqli_fetch_assoc($result);
$id = '';

if ($class == "IP") {
    $sql = "SELECT MAX(A.InpatientId) AS I
    FROM
    (SELECT CONVERT(SUBSTRING(Id, 3, 5), UNSIGNED INTEGER) AS InpatientId
    FROM Patient
    WHERE Id LIKE 'IP%') AS A;";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $idnew = $row['I'] + 1;
    // echo $row['I'];

    if ($idnew > 999) {
        $id = "IP0" . strval($idnew);
    } else if ($idnew > 99) {
        $id = "IP00" . strval($idnew);
    } else if ($idnew > 9) {
        $id = "IP000" . strval($idnew);
    } else {
        $id = "IP0000" . strval($idnew);
    }
    session_start();
    $_SESSION['id'] = $id;
} else {
    $sql = "SELECT MAX(A.InpatientId) AS I
    FROM
    (SELECT CONVERT(SUBSTRING(Id, 3, 5), UNSIGNED INTEGER) AS InpatientId
    FROM Patient
    WHERE Id LIKE 'OP%') AS A;";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $idnew = $row['I'] + 1;

    if ($idnew > 999) {
        $id = "OP0" . strval($idnew);
    } else if ($idnew > 99) {
        $id = "OP00" . strval($idnew);
    } else if ($idnew > 9) {
        $id = "OP000" . strval($idnew);
    } else {
        $id = "OP0000" . strval($idnew);
    }
}



$sql = "INSERT INTO patient (fname, lname, id, dob, phone, address, gender)
    VALUES ('$fname', '$lname', '$id', '$DOB', '$phone', '$address', '$gender');";

if (mysqli_multi_query($conn, $sql)) {
    echo '<script>alert("Add patient successful")</script>';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

if ($class == "IP") {
    header("location:addInpatient.php");
} else {
    $sql = "INSERT INTO outpatient (id)
        VALUES ('$id');";
    if (mysqli_multi_query($conn, $sql)) {
        echo '<script>alert("Add OUTpatient successful")</script>';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    header("location:main.php");
}
unset($_POST);

mysqli_close($conn);
?>