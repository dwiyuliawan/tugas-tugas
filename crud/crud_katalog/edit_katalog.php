<html>
<head>
	<title>Edit Katalog</title>
</head>

<?php
	include_once("connect_katalog.php");
	$id_katalog = $_GET['id_katalog'];

	$katalog = mysqli_query($mysqli, "SELECT * FROM katalog WHERE id_katalog='$id_katalog'");
    $buku = mysqli_query($mysqli, "SELECT * FROM buku");

    while($katalog_data = mysqli_fetch_array($katalog))
    {
    	$id_katalog = $katalog_data['id_katalog'];
    	$nama_katalog = $katalog_data['nama'];
    }
?>
 
<body>
	<a href="index_katalog.php">Go to Home</a>
	<br/><br/>
 
	<form action="edit_katalog.php?id_katalog=<?= $id_katalog; ?>" method="post">
		<table width="25%" border="0">
			<tr> 
				<td>ID Katalog</td>
				<td style="font-size: 11pt;"><?= $id_katalog; ?> </td>
			</tr>
			<tr> 
				<td>Nama Katalog</td>
				<td><input type="text" name="nama" value="<?= $nama_katalog; ?>"></td>
			</tr>
			<tr> 
				<td></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
	
	<?php
	 
		// Check If form submitted, insert form data into users table.
		if(isset($_POST['update'])) {

			$id_katalog = $_GET['id_katalog'];
			$nama_katalog = $_POST['nama'];
			
			include_once("connect_katalog.php");

			$result = mysqli_query($mysqli, "UPDATE katalog SET id_katalog = '$id_katalog', nama = '$nama_katalog' WHERE id_katalog = '$id_katalog';");

			header("Location:index_katalog.php");
		}
	?>
</body>
</html>