<?php
include_once("connect_pengarang.php");
 
$id_pengarang = $_GET['id_pengarang'];
 
$result = mysqli_query($mysqli, "DELETE FROM pengarang WHERE id_pengarang='$id_pengarang'");

// After delete redirect to Home, so that latest user list will be displayed.
header("Location:index_pengarang.php");
?>