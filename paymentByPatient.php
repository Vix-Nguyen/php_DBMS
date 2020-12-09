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
   $sql1 = "SELECT M.Mname, M.Price
   FROM treat_med as TM, medication as M,
   ( 
   SELECT T.Id, T.PatientId 
   FROM patient as P, inpatient as I, treatment as T
   WHERE P.Id = I.Id and T.PatientId = I.Id 
       and P.Fname = '$fname' and P.Lname = '$lname'
   ) as O
   WHERE O.Id = TM.TreatId and O.PatientId = TM.PatientId
       and M.Id = TM.MedId";
    $sql2 = "SELECT M.Mname, M.Price
    FROM exam_med as EM, medication as M,
    ( 
    SELECT E.Id, E.PatientId 
    FROM patient as P, outpatient as O, examination as E
    WHERE P.Id = O.Id and E.PatientId = O.Id 
        and P.Fname = '$fname' and P.Lname = '$lname'
    ) as S
    WHERE S.Id = Em.ExamId and S.PatientId = EM.PatientId
        and M.Id = EM.MedId";
}
else if (isset($fname)) {
    $sql1 = "SELECT M.Mname,  M.Price
   FROM treat_med as TM, medication as M,
   ( 
   SELECT T.Id, T.PatientId 
   FROM patient as P, inpatient as I, treatment as T
   WHERE P.Id = I.Id and T.PatientId = I.Id 
       and P.Fname = '$fname'
   ) as O
   WHERE O.Id = TM.TreatId and O.PatientId = TM.PatientId
       and M.Id = TM.MedId";
    $sql2 = "SELECT  M.Mname, M.Price
    FROM exam_med as EM, medication as M,
    ( 
    SELECT E.Id, E.PatientId 
    FROM patient as P, outpatient as O, examination as E
    WHERE P.Id = O.Id and E.PatientId = O.Id 
        and P.Fname = '$fname' 
    ) as S
    WHERE S.Id = Em.ExamId and S.PatientId = EM.PatientId
        and M.Id = EM.MedId";
}
else if (isset($lname)) {
    $sql1 = "SELECT  M.Mname, M.Price
    FROM treat_med as TM, medication as M,
    ( 
    SELECT T.Id, T.PatientId 
    FROM patient as P, inpatient as I, treatment as T
    WHERE P.Id = I.Id and T.PatientId = I.Id 
        and P.Lname = '$lname'
    ) as O
    WHERE O.Id = TM.TreatId and O.PatientId = TM.PatientId
        and M.Id = TM.MedId";
     $sql2 = "SELECT M.Mname,  M.Price
     FROM exam_med as EM, medication as M,
     ( 
     SELECT E.Id, E.PatientId 
     FROM patient as P, outpatient as O, examination as E
     WHERE P.Id = O.Id and E.PatientId = O.Id 
        and P.Lname = '$lname'
     ) as S
     WHERE S.Id = Em.ExamId and S.PatientId = EM.PatientId
         and M.Id = EM.MedId";
}

$result_1 = mysqli_query($conn, $sql1);
$result_2 = mysqli_query($conn, $sql2);
?>
<!DOCTYPE html>
<body>
<table>
    <tr>
        <th>Kind of patient</th>
        <th>Name of medication</th>
        <th>Price</th>
    </tr>
    <?php
    if ($result_1 != FALSE || $result_2 != FALSE) {
        while ($row = mysqli_fetch_assoc($result_1)){
            printPaymentByPatient('Inpatient' , $row['Mname'], $row['Price']);
        }
        while ($row = mysqli_fetch_assoc($result_2)){
            printPaymentByPatient('Outpatient' , $row['Mname'], $row['Price']);
        }
    }
    ?>
        </table>
</body>
</html>
