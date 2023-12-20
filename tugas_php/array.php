<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<style>
		nav {
			padding-top: 15px;
			margin-top: 5px;
			background: yellow;
		}

		table {
			border-collapse: collapse;
			margin-left: 300px;
			margin-top: 150px;
		}

		th,
		td {
			border: 1px solid #cec7c7;
			padding: 8px;
			text-align: center;
		}
	</style>

	<title>Document</title>
</head>

<body>
	<table>
		<nav>
			<h2>Daftar Nilai</h2>
		</nav>

		<thead bgcolor="white">
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Tanggal Lahir</th>
				<th>Umur</th>
				<th>Alamat</th>
				<th>Kelas</th>
				<th>Nilai</th>
				<th>Hasil</th>

			</tr>
		</thead>
		<tbody>



			<?php

            $data_json = file_get_contents('data.json');
			$data = json_decode($data_json, true);


			foreach ($data as $key => $value) {
				$tgl_lahir = date_create($value['tanggal_lahir']);
				$date = date_create(date('y-m-d'));
				$umur = date_diff($tgl_lahir, $date);
				if ($key % 2 == 0) {
					echo "<tr bgcolor=#eee>";
				} else {
					echo "<tr bgcolor=white>";
				}
				$b = 1 + $key;
				echo "<td>$b.</td>";
				echo "<td>{$value['nama']}</td>";
				echo "<td>{$value['tanggal_lahir']}</td>";

				echo "<td>{$umur->format('%Y')}</td>";
				echo "<td>{$value['alamat']}</td>";
				echo "<td>{$value['kelas']}</td>";
				echo "<td>{$value['nilai']}</td>";
				echo "<td>{$value['hasil']}</td>";
				echo "</tr>";
			}

			?>
		</tbody>
	</table>
</body>

</html>