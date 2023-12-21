<?php
$servername = "localhost";
$database = "perpus";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " .mysqli_connect_error());
}

// echo "Connected successfully";
// mysqli_close($conn);

$sql = "SELECT * FROM anggota";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "anggota : " . $row["nama"]. " - " . $row["sex"]. " - " . $row["telp"]. " - " . $row["alamat"]. " - " . $row["email"]. "<br>";
    }
}else {
    echo "0 results";
}
$conn->close();
?>