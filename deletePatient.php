<?php

require_once("connection.php");
$id = $_POST['delete'];
$sql = "DELETE FROM patient WHERE id='$id'";
$result = mysqli_query($conn, $sql);
unset($_POST);
header("location:index.php");
