<html>
<head>
	<title>Add Katalog</title>
</head>

<?php
	include_once("connect_katalog.php");
    $katalog = mysqli_query($mysqli, "SELECT * FROM katalog");
?>
 
<body>
	<a href="index_katalog.php">Go to Home</a>
	<br/><br/>
 
	<form action="add_katalog.php" method="post" name="form1">
		<table width="25%" border="0">
			<tr> 
				<td>ID Katalog</td>
				<td><input type="text" name="id_katalog"></td>
			</tr>
			<tr> 
				<td>Nama Katalog</td>
				<td><input type="text" name="nama"></td>
			</tr>
			<tr> 
				<td></td>
				<td><input type="submit" name="Submit" value="Add"></td>
			</tr>
		</table>
	</form>
	
	<?php
	 
		// Check If form submitted, insert form data into users table.
		if(isset($_POST['Submit'])) {
			$id_katalog = $_POST['id_katalog'];
			$nama_katalog = $_POST['nama'];
			
			include_once("connect_katalog.php");

			$result = mysqli_query($mysqli, "INSERT INTO `katalog` (`id_katalog`, `nama`) VALUES ('$id_katalog', '$nama_katalog');");
			
			header("Location:index_katalog.php");
		}
	?>
</body>
</html>