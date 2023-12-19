<style>
		table {
			border-collapse: collapse;
		}

		th,td {
			border: 2px solid black;
			padding: 8px;
			text-align: center;
		}
	</style>

<table>
		<thead bgcolor="blue">
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Kelas</th>
			</tr>
		</thead>
		<tbody>
			<?php
			//loop dari 1 ke 10
			for ($a = 1; $a <= 10; $a++) {
                if($a % 2 == 0) {
                    echo "<tr bgcolor=white>";
                } else {
                    echo "<tr bgcolor=gray>";
                }
				
				echo "<td>{$a}</td>";
				echo "<td>nama ke {$a}</td>";
				$b = 11 - $a;
				echo "<td>kelas {$b}</td>";
				echo "</tr>";
			}

			?>
		</tbody>
	</table>