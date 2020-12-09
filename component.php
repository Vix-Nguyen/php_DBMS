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


?>
