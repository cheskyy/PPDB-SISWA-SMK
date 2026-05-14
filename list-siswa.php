<?php include("config.php"); require_admin(); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Siswa | Pendaftaran Siswa/Siswi Baru SMK</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h3>Pendaftaran Siswa/Siswi Baru SMK</h3>
        <h1>Data Siswa Pendaftar</h1>
    </header>

    <div class="container">
        <nav>
            <a href="form-daftar.php">+ Tambah Baru</a>
            <a href="index.php">← Kembali</a>
            <a href="logout.php">Logout</a>
        </nav>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>Agama</th>
                        <th>Sekolah Asal</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM calon_siswa";
                    $query = mysqli_query($db, $sql);

                    while($siswa = mysqli_fetch_array($query)){
                        echo "<tr>";
                        echo "<td>".$siswa['id']."</td>";
                        echo "<td>".$siswa['nama']."</td>";
                        echo "<td>".$siswa['alamat']."</td>";
                        echo "<td>".$siswa['jenis_kelamin']."</td>";
                        echo "<td>".$siswa['agama']."</td>";
                        echo "<td>".$siswa['sekolah_asal']."</td>";
                        echo "<td>";
                        echo "<a class='btn-edit' href='form-edit.php?id=".$siswa['id']."'>Edit</a>";
                        echo "<a class='btn-hapus' href='hapus.php?id=".$siswa['id']."'>Hapus</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <p class="total-info">Total: <?php echo mysqli_num_rows($query) ?> siswa terdaftar</p>
        </div>
    </div>
</body>
</html>
