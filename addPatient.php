<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="addPatient.php" style="margin-left: 40%;" method="post">
        <label for="fname">First name:</label><br>
        <input type="text" name="fname"  placeholder="John"><br><br>

        <label for="lname">Last name:</label><br>
        <input type="text" name="lname" placeholder="Smith"><br><br>

        <label for="id">ID:</label><br>
        <input type="text" name="id" placeholder="IP or OP"><br><br>

        <label for="DOB">Date of Birth:</label><br>
        <input type="date" name="DOB" ><br><br>

        <label for="phone">Phone number:</label><br>
        <input type="number" name="phone" placeholder="0825001927"><br><br>

        <label for="address">Address:</label><br>
        <input type="text" name="address" placeholder="12 Ly Thuong Kiet, Quan 10, Thanh pho Ho Chi Minh"><br><br>

        <label for="Gender">Gender:</label>
        <select name="Gender" name="Gender">
            <option value="Male" selected>Male</option>
            <option value="Female">Female</option>
        </select><br><br>
        
        

        <input name="submit" type="submit" value="Submit">
    </form> 
</body>
</html>

<?php
error_reporting(0);
require("connection.php");


if (!isset($_POST['submit'])) {
    // echo '<script>alert("This ID is  valid")</script>';
    exit;
}

$fname = isset($_POST['fname']) ? $_POST['fname'] : '';
$lname = isset($_POST['lname']) ? $_POST['lname'] : '';
$id = isset($_POST['id']) ? $_POST['id'] : '';
$DOB = isset($_POST['DOB']) ? $_POST['DOB']: '';
$phone = isset($_POST['phone']) ? $_POST['phone']: '';
$address = isset($_POST['address']) ? $_POST['address']: '';
$gender = isset($_POST['Gender']) ? $_POST['Gender']: '';

$sql = "SELECT * FROM patient WHERE Id = '$id'";
$result = mysqli_query($conn, $sql);


if ($id == '') {
    echo '<script>alert("This ID is not valid")</script>';
    exit;
}

if (mysqli_num_rows($result) == 1) {
  echo '<script>alert("This ID is not unique")</script>';
} else {
    $sql = "INSERT INTO patient (fname, lname, id, dob, phone, address, gender)
    VALUES ('$fname', '$lname', '$id', '$dob', '$phone', '$address', '$gender');";
    
    if (mysqli_multi_query($conn, $sql)) {
        echo '<script>alert("Add patient successful")</script>';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}


mysqli_close($conn);
?>

