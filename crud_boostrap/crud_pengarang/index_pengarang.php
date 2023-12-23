<?php
    include_once("connect_pengarang.php");
    $pengarang = mysqli_query($mysqli, "SELECT pengarang.* FROM pengarang 
                                        LEFT JOIN  buku ON buku.id_pengarang = pengarang.id_pengarang
                                        ORDER BY nama_pengarang ASC");
?>
 
<html>
<head>    
    <title>Home Pengarang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <style>
        a {
            border : 1px solid #007bff;
            background : #007bff;
            padding: 10px;
            color:white;
            text-decoration: none;
            border-radius: 6px;
        }

        a:hover{
            background:white;
            color:  black;
        }
        a.kotak{
            border : 1px solid #cec7c7;
            background : #cec7c7;
            padding: 10px;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
        .kotak:hover {
            background: white;
            color:  black;
        }
    </style>

</head>
 
<body>

<center>
    <a href="../crud_buku/index.php">Buku</a> |
    <a href="../crud_penerbit/index_penerbit.php">Penerbit</a> |
    <a href="index_pengarang.php">Pengarang</a> |
    <a href="../crud_katalog/index_katalog.php">Katalog</a>
    <hr>
</center>

<a class="kotak" href="add_pengarang.php"><b>Add New Pengarang</b></a><br/><br/>
 
    <table class="table" width='80%' border=1>
 
    <tr bgcolor="#cec7c7">
        <th>ID Pengarang</th> 
        <th>Nama Pengarang</th> 
        <th>Email</th> 
        <th>Telepon</th>
        <th>Alamat</th>
        <th>Aksi</th>
    </tr>
    <?php  
        while($pengarang_data = mysqli_fetch_array($pengarang)) {         
            echo "<tr>";
            echo "<td>".$pengarang_data['id_pengarang']."</td>";
            echo "<td>".$pengarang_data['nama_pengarang']."</td>";
            echo "<td>".$pengarang_data['email']."</td>";    
            echo "<td>".$pengarang_data['telp']."</td>";    
            echo "<td>".$pengarang_data['alamat']."</td>";   
            echo "<td><a class='btn btn-primary' href='edit_pengarang.php?id_pengarang=$pengarang_data[id_pengarang]'>Edit</a> | <a class='btn btn-danger' href='delete_pengarang.php?id_pengarang=$pengarang_data[id_pengarang]'>Delete</a></td></tr>";        
        }
    ?>
    </table>
</body>
</html>