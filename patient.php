<?php
require_once("connection.php");
require_once("component.php");

// echo $name[0];
// echo $name[$nameLength];
if (!isset($_POST['fname']) || !isset($_POST['lname'])) {
    exit;
}



$fname = strlen($_POST['fname']) != 0 ? $_POST['fname'] : NULL;
$lname = strlen($_POST['lname']) != 0 ? $_POST['lname'] : NULL;
// echo isset($fname);
// echo gettype($lname);
if (isset($_POST['all'])) {
    $sql = "SELECT * FROM patient";
} else if (isset($fname) && isset($lname)) {
    $sql = "SELECT * FROM patient WHERE fname='$fname' and lname='$lname'";
} else if (isset($fname)) {
    $sql = "SELECT * FROM patient WHERE fname='$fname'";
} else if (isset($lname)) {
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
            <th>Phone</th>
            <th></th>
            <th></th>
        </tr>
        <?php
        if ($result != FALSE) {
            while ($row = mysqli_fetch_assoc($result)) {
                searchPatient($row['Id'], $row['Fname'], $row['Lname'], $row['Phone']);
            }
        }
        ?>
    </table>
</body>

</html>