<?php
require_once("connection.php");
require_once("component.php");


if (!isset($_POST['fname']) || !isset($_POST['lname'])) 
{
    exit;
}



$fname = strlen($_POST['fname']) != 0 ? $_POST['fname'] : NULL;
$lname = strlen($_POST['lname']) != 0 ? $_POST['lname'] : NULL;
// echo isset($fname);
// echo gettype($lname);

if (isset($fname) && isset($lname)) {
    $sql = "SELECT P.Fname, P.Lname, P.Phone, P.Gender, T.result
    from treatment as T, inpatient as I, patient as P
    WHERE T.PatientId = I.Id and I.Id = P.Id
    and T.DoctorId IN 
        ( SELECT D.Id 
        FROM employee as E, doctor as D 
        WHERE E.Id = D.Id 
        and Fname = '$fname' and Lname = '$lname' )
    ";
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
    ";
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
    ";
}

$result = mysqli_query($conn, $sql);

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
    if ($result != FALSE) {
        while ($row = mysqli_fetch_assoc($result)){
            printInpatientByDortor($row['Fname'], $row['Lname'], $row['Phone'], $row['Gender'], $row['result']);
        }
    }
    ?>
        </table>
</body>
</html>
