<?php
require_once("connection.php");
$id = $_POST['edit'];
$sql = "SELECT * FROM patient WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$class = substr($id, 0, 2) == "IP" ? "IP" : "OP";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit patient</title>
</head>

<body>
    <h1>Edit patient</h1>
    <form action="editPatient.php" style="margin-left: 40%;" method="post">
        <input type="hidden" name="id" value="<?php echo $id ?>">

        <label for="fname">First name:</label><br>
        <input type="text" name="fname" value=<?php echo $row['Fname'] ?>><br><br>

        <label for="lname">Last name:</label><br>
        <input type="text" name="lname" value=<?php echo $row['Lname'] ?>><br><br>

        <label for="class">Class:</label>
        <select name="class" name="class">
            <option value="IP" selected>Inpatient</option>
            <option value="OP" <?php echo $a = $class == "OP" ? "selected" : "" ?>>Outpatient</option>
        </select><br><br>


        <label for="DOB">Date of Birth:</label><br>
        <input type="date" name="DOB" value=<?php echo $row['DOB'] ?>><br><br>

        <label for="phone">Phone number:</label><br>
        <input type="number" name="phone" value=<?php echo $row['Phone'] ?>><br><br>

        <label for="address">Address:</label><br>
        <input type="text" name="address" value=<?php echo $row['Address'] ?>><br><br>

        <label for="Gender">Gender:</label>
        <select name="Gender" name="Gender">
            <option value="Male" selected>Male</option>
            <option value="Female" <?php echo $a = $row['Gender'] == "Female" ? "selected" : "" ?>>Female</option>
        </select><br><br>

        <input name="submit" type="submit" value="Submit">
    </form>
</body>

<?php
if (!isset($_POST['submit'])) {
    // echo '<script>alert("This ID is  valid")</script>';
    exit;
}

$id = isset($_POST['id']) ? $_POST['id'] : '';
$fname = isset($_POST['fname']) ? $_POST['fname'] : '';
$lname = isset($_POST['lname']) ? $_POST['lname'] : '';
$class = isset($_POST['class']) ? $_POST['class'] : '';
// $id = isset($_POST['id']) ? $_POST['id'] : '';
$DOB = isset($_POST['DOB']) ? $_POST['DOB'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';
$gender = isset($_POST['Gender']) ? $_POST['Gender'] : '';


$sql1 = "UPDATE patient SET Fname='$fname', Lname='$lname', DOB='$DOB', Phone='$phone', Address='$address', Gender='$gender' WHERE Id = '$id'";

if (mysqli_query($conn, $sql1)) {
    echo '<script>alert("Add patient successful")</script>';
    header("location:index.php");
    unset($_POST);
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>