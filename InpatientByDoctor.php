<?php
require_once("connection.php");
require_once("component.php");


if (!isset($_POST['fname']) || !isset($_POST['lname'])) 
{
    exit;
}

$sql = "";
$result = FALSE;
$fname = strlen($_POST['fname']) != 0 ? $_POST['fname'] : NULL;
$lname = strlen($_POST['lname']) != 0 ? $_POST['lname'] : NULL;

if (isset($fname) && isset($lname)) {
    $sql = "SELECT P.Fname, P.Lname, P.Phone, P.Gender, T.result
    from treatment as T, inpatient as I, patient as P
    WHERE T.PatientId = I.Id and I.Id = P.Id
    and T.DoctorId IN 
        ( SELECT D.Id 
        FROM employee as E, doctor as D 
        WHERE E.Id = D.Id 
        and Fname = '$fname' and Lname = '$lname' )
    ORDER BY P.Lname";
}
else if (isset($fname)) {
    $sql = "SELECT P.Fname, P.Lname, P.Phone, P.Gender, T.result
    from treatment as T, inpatient as I, patient as P
    WHERE T.PatientId = I.Id and I.Id = P.Id
    and T.DoctorId IN 
        ( SELECT D.Id 
        FROM employee as E, doctor as D 
        WHERE E.Id = D.Id 
        and Fname = '$fname')
    ORDER BY P.Lname";
}
else if (isset($lname)) {
    $sql = "SELECT P.Fname, P.Lname, P.Phone, P.Gender, T.result
    from treatment as T, inpatient as I, patient as P
    WHERE T.PatientId = I.Id and I.Id = P.Id
    and T.DoctorId IN 
        ( SELECT D.Id 
        FROM employee as E, doctor as D 
        WHERE E.Id = D.Id 
        and Lname = '$lname' )
    ORDER BY P.Lname";
}

if (!strlen($sql) == 0) {
    $result = mysqli_query($conn, $sql);
}

?>
<!DOCTYPE html>
<body>
<table>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Phone</th>
        <th>Gender</th>
        <th>Result</th>
    </tr>
    <?php
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)){
            printInpatientByDoctor($row['Fname'], $row['Lname'], $row['Phone'], $row['Gender'], $row['result']);
        }
    }
    ?>
</table>
</body>
</html>
