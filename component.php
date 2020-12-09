<?php

function searchPatient($id, $fname, $lname, $DoB, $Phone, $Addr, $gender){
    $element = "
    <tr>
        <td>$id</td>
        <td>$fname</td>
        <td>$lname</td>
        <td>$DoB</td>
        <td>$Phone</td>
        <td>$Addr</td>
        <td>$gender</td>
    </tr>
    ";

    echo $element;
}

function printInpatientByDortor($fname, $lname, $phone, $gender, $result){
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

function printPaymentByPatient($kind , $Mname, $Price){
    $element = "
    <tr>
        <td>$kind</td>
        <td>$Mname</td>
        <td>$Price</td>
    </tr>
    ";

    echo $element;
}

?>
