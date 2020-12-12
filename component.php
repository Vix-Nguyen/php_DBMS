<?php

function searchPatient($id, $fname, $lname, $Phone){

    $element = "
    <tr>
        <td>$id</td>
        <td>$fname</td>
        <td>$lname</td>
        <td>$Phone</td>
    </tr>
    ";

    echo $element;
    getInfor($id);
}

function getInfor($id){
    require("connection.php");

    $class = substr($id, 0 ,2);
    $element = "";
    if ($class == "IP") {
        $element ="    
        <tr style='background-color: tomato'>
            <td>Doctor</td>
            <td>Start Date</td>
            <td>End Date</td>
            <td>Result</td>
        </tr>";
        echo $element;
        $sql = "SELECT * FROM treatment WHERE PatientId='$id'";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $docID = $row['DoctorId'];
            $stD = $row['StartDate'];
            $enD = $row['EndDate'];
            $rsl = $row['Result'];
            $element= "
            <tr style='background-color: wheat'>
                <td>$docID</td>
                <td>$stD</td>
                <td>$enD</td>
                <td>$rsl</td>
            </tr>";
            echo $element;
        }
    }
    else{
        $element ="    
        <tr style='background-color: tomato'>
            <td>Doctor</td>
            <td>Examination Date</td>
            <td>Fee</td>
            <td>Second Date</td>
        </tr>";
        echo $element;

        $sql = "SELECT * FROM examination WHERE PatientId='$id'";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $docID = $row['DoctorId'];
            $stD = $row['ExamDate'];
            $enD = $row['Fee'];
            $rsl = $row['SecondDate'];
            $element="
            <tr style='background-color: wheat'>
                <td>$docID</td>
                <td>$stD</td>
                <td>$enD</td>
                <td>$rsl</td>
            </tr>";
            echo $element;
        }
    }
}

function printInpatientByDoctor($fname, $lname, $phone, $gender, $result){
    $element = "
    <tr>
        <td>$fname</td>
        <td>$lname</td>
        <td>$phone</td>
        <td>$gender</td>
        <td>$result</td>
    </tr>
    ";

    echo $element;
}

function printPaymentByPatient($Fname, $Lname, $kind , $Mname, $Price){
    $element = "
    <tr>
        <td>$Fname</td>
        <td>$Lname</td>
        <td>$kind</td>
        <td>$Mname</td>
        <td>$Price</td>
    </tr>
    ";

    echo $element;
}

?>
