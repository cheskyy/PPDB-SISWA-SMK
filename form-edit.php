<?php

include("config.php");
require_admin();

if( !isset($_GET['id']) ){
    header('Location: list-siswa.php');
}

$id = $_GET['id'];
$sql = "SELECT * FROM calon_siswa WHERE id=$id";
$query = mysqli_query($db, $sql);
$siswa = mysqli_fetch_assoc($query);

if( mysqli_num_rows($query) < 1 ){
    die("Data tidak ditemukan...");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Siswa | Pendaftaran Siswa/Siswi Baru SMK</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h3>Pendaftaran Siswa/Siswi Baru SMK</h3>
        <h1>Edit Data Siswa</h1>
    </header>

    <div class="container">
        <nav>
            <a href="list-siswa.php">← Kembali ke Daftar</a>
            <a href="logout.php">Logout</a>
        </nav>

        <div class="card">
            <form action="proses-edit.php" method="POST">

                <input type="hidden" name="id" value="<?php echo $siswa['id'] ?>" />

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" value="<?php echo $siswa['nama'] ?>" required />
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" required><?php echo $siswa['alamat'] ?></textarea>
                </div>

                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <?php $jk = $siswa['jenis_kelamin']; ?>
                    <div class="radio-group">
                        <label><input type="radio" name="jenis_kelamin" value="laki-laki" <?php echo ($jk == 'laki-laki') ? "checked": "" ?>> Laki-laki</label>
                        <label><input type="radio" name="jenis_kelamin" value="perempuan" <?php echo ($jk == 'perempuan') ? "checked": "" ?>> Perempuan</label>
                    </div>
                </div>

                <div class="form-group">
                    <label>Agama</label>
                    <?php $agama = $siswa['agama']; ?>
                    <select name="agama">
                        <option <?php echo ($agama == 'Islam') ? "selected": "" ?>>Islam</option>
                        <option <?php echo ($agama == 'Kristen') ? "selected": "" ?>>Kristen</option>
                        <option <?php echo ($agama == 'Hindu') ? "selected": "" ?>>Hindu</option>
                        <option <?php echo ($agama == 'Budha') ? "selected": "" ?>>Budha</option>
                        <option <?php echo ($agama == 'Atheis') ? "selected": "" ?>>Atheis</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Sekolah Asal</label>
                    <input type="text" name="sekolah_asal" value="<?php echo $siswa['sekolah_asal'] ?>" required />
                </div>

                <div class="form-group">
                    <input type="submit" class="btn-submit" value="Simpan Perubahan" name="simpan" />
                </div>

            </form>
        </div>
    </div>
</body>
</html>
