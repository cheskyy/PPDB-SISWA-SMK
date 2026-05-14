<?php include("config.php"); require_siswa_or_admin(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Formulir Pendaftaran | Pendaftaran Siswa/Siswi Baru SMK</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h3>Pendaftaran Siswa/Siswi Baru SMK</h3>
        <h1>Formulir Pendaftaran Siswa Baru</h1>
    </header>

    <div class="container">
        <nav>
            <a href="index.php">← Kembali ke Menu</a>
            <a href="logout.php">Logout</a>
        </nav>

        <div class="card">
            <form action="proses-pendaftaran.php" method="POST">

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" placeholder="Masukkan nama lengkap" required />
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" placeholder="Masukkan alamat lengkap" required></textarea>
                </div>

                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <div class="radio-group">
                        <label><input type="radio" name="jenis_kelamin" value="laki-laki" required> Laki-laki</label>
                        <label><input type="radio" name="jenis_kelamin" value="perempuan"> Perempuan</label>
                    </div>
                </div>

                <div class="form-group">
                    <label>Agama</label>
                    <select name="agama">
                        <option>Islam</option>
                        <option>Kristen</option>
                        <option>Hindu</option>
                        <option>Budha</option>
                        <option>Atheis</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Sekolah Asal</label>
                    <input type="text" name="sekolah_asal" placeholder="Masukkan nama sekolah asal" required />
                </div>

                <div class="form-group">
                    <input type="submit" class="btn-submit" value="Daftarkan Sekarang" name="daftar" />
                </div>

            </form>
        </div>
    </div>
</body>
</html>
