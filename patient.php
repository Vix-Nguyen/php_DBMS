<?php
require_once("connection.php");
require_once("component.php");

if(!isset($_POST['fname']) && !isset($_POST['lname']))
{
    exit;
}
// echo $name[0];
// echo $name[$nameLength];

$fname = isset($_POST['fname']) ? $_POST['fname'] : NULL;
$lname = isset($_POST['lname']) ? $_POST['lname'] : NULL;
echo gettype($fname);
echo gettype($lname);
if (isset($fname) && isset($lname)) {
    $sql = "SELECT * FROM patient WHERE fname='$fname' and lname='$lname'";
}
else if (isset($fname)) {
    $sql = "SELECT * FROM patient WHERE fname='$fname'";
}
else if (isset($lname)) {
    $sql = "SELECT * FROM patient WHERE lname='$lname'";
}

$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<body>
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
    if ($result != FALSE) {
        while ($row = mysqli_fetch_assoc($result)){
            searchPatient($row['Id'], $row['Fname'], $row['Lname'], $row['DOB'], $row['Phone'], $row['Address'], $row['Gender']);
        }
    }
    ?>
        </table>
</body>
</html>