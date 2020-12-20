<?php
require_once("connection.php");
require_once("component.php");


if (!isset($_POST['fname']) || !isset($_POST['lname'])) 
{
    exit;
}


$sql1 = "";
$sql2 = "";
$result_1 = FALSE;
$result_2 = FALSE;
$fname = strlen($_POST['fname']) != 0 ? $_POST['fname'] : NULL;
$lname = strlen($_POST['lname']) != 0 ? $_POST['lname'] : NULL;
// echo isset($fname);
// echo gettype($lname);

if (isset($fname) && isset($lname)) {
   $sql1 = "SELECT M.Mname, M.Price, O.Fname, O.Lname, M.Id as MId, O.Id
   FROM treat_med as TM, medication as M,
   ( 
   SELECT T.Id, T.PatientId, P.Fname, P.Lname
   FROM patient as P, inpatient as I, treatment as T
   WHERE P.Id = I.Id and T.PatientId = I.Id 
       and P.Fname = '$fname' and P.Lname = '$lname'
   ) as O
   WHERE O.Id = TM.TreatId and O.PatientId = TM.PatientId
       and M.Id = TM.MedId
    ORDER BY O.Lname";
    $sql2 = "SELECT M.Mname, M.Price, S.Fname, S.Lname, M.Id as MId, S.Id
    FROM exam_med as EM, medication as M,
    ( 
    SELECT E.Id, E.PatientId, P.Fname, P.Lname
    FROM patient as P, outpatient as O, examination as E
    WHERE P.Id = O.Id and E.PatientId = O.Id 
        and P.Fname = '$fname' and P.Lname = '$lname'
    ) as S
    WHERE S.Id = Em.ExamId and S.PatientId = EM.PatientId
        and M.Id = EM.MedId
    ORDER BY S.Lname";
}
else if (isset($fname)) {
    $sql1 = "SELECT M.Mname,  M.Price, O.Fname, O.Lname, M.Id as MId, O.Id
   FROM treat_med as TM, medication as M,
   ( 
   SELECT T.Id, T.PatientId, P.Fname, P.Lname
   FROM patient as P, inpatient as I, treatment as T
   WHERE P.Id = I.Id and T.PatientId = I.Id 
       and P.Fname = '$fname'
   ) as O
   WHERE O.Id = TM.TreatId and O.PatientId = TM.PatientId
       and M.Id = TM.MedId
    ORDER BY O.Lname";
    $sql2 = "SELECT  M.Mname, M.Price, S.Fname, S.Lname, M.Id as MId, S.Id 
    FROM exam_med as EM, medication as M,
    ( 
    SELECT E.Id, E.PatientId, P.Fname, P.Lname
    FROM patient as P, outpatient as O, examination as E
    WHERE P.Id = O.Id and E.PatientId = O.Id 
        and P.Fname = '$fname' 
    ) as S
    WHERE S.Id = Em.ExamId and S.PatientId = EM.PatientId
        and M.Id = EM.MedId
    ORDER BY S.Lname";
}
else if (isset($lname)) {
    $sql1 = "SELECT  M.Mname, M.Price, O.Fname, O.Lname, M.Id as MId, O.Id
    FROM treat_med as TM, medication as M,
    ( 
    SELECT T.Id, T.PatientId, P.Fname, P.Lname
    FROM patient as P, inpatient as I, treatment as T
    WHERE P.Id = I.Id and T.PatientId = I.Id 
        and P.Lname = '$lname'
    ) as O
    WHERE O.Id = TM.TreatId and O.PatientId = TM.PatientId
        and M.Id = TM.MedId
    ORDER BY O.Lname";
     $sql2 = "SELECT M.Mname,  M.Price, S.Fname, S.Lname, M.Id as MId, S.Id as ID 
     FROM exam_med as EM, medication as M,
     ( 
     SELECT E.Id, E.PatientId, P.Fname, P.Lname
     FROM patient as P, outpatient as O, examination as E
     WHERE P.Id = O.Id and E.PatientId = O.Id 
        and P.Lname = '$lname'
     ) as S
     WHERE S.Id = Em.ExamId and S.PatientId = EM.PatientId
         and M.Id = EM.MedId
    ORDER BY S.Lname";
}

if (!strlen($sql1) == 0) {
    $result_1 = mysqli_query($conn, $sql1);
}

if (!strlen($sql2) == 0) {
    $result_2 = mysqli_query($conn, $sql2);
}

?>
<!DOCTYPE html>
<body>
<?php
if($fname)
  echo "Reports about the payment for each treatment or examination of a patient: "; echo $fname; echo " "; echo $lname; 

?>
<table>
    <tr style='background-color: tomato'>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Kind of patient</th>
        <th>Name of medication</th>
        <th>Price</th>
        <th>Medication ID</th>
        <th>Treat/Exam ID</th>
    </tr>
    <?php
    if ($result_1 || $result_2) {
        while ($row = mysqli_fetch_assoc($result_1)){
            printPaymentByPatient($row['Fname'], $row['Lname'], 'Inpatient' , $row['Mname'], $row['Price'], $row['Id'], $row['MId'] );
        }
        while ($row = mysqli_fetch_assoc($result_2)){
            printPaymentByPatient($row['Fname'], $row['Lname'], 'Outpatient' , $row['Mname'], $row['Price'], $row['Id'], $row['MId']);
        }
    }
    ?>
        </table>
</body>
</html>