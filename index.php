<?php include("config.php"); require_login(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Pendaftaran Siswa/Siswi Baru SMK</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h3>Pendaftaran Siswa/Siswi Baru SMK</h3>
        <h1>Selamat Datang, <?php echo htmlspecialchars(current_user()); ?>!</h1>
    </header>

    <div class="container">
        <nav class="top-nav">
            <a href="logout.php">Logout</a>
            <a href="form-daftar.php">Daftar Baru</a>
            <?php if(current_role() === 'admin'): ?>
                <a href="list-siswa.php">Lihat Pendaftar</a>
            <?php endif; ?>
        </nav>

        <?php if(isset($_GET['status'])): ?>
        <div class="alert <?php echo ($_GET['status'] == 'sukses') ? 'alert-success' : 'alert-danger' ?>">
            <?php echo ($_GET['status'] == 'sukses') ? '✅ Pendaftaran siswa baru berhasil!' : '❌ Pendaftaran gagal!' ?>
        </div>
        <?php endif; ?>

        <div class="menu-grid">
            <a href="form-daftar.php" class="menu-item">
                <div class="icon">📝</div>
                <h2>Daftar Baru</h2>
                <p>Isi formulir pendaftaran siswa baru.</p>
            </a>
            <?php if(current_role() === 'admin'): ?>
            <a href="list-siswa.php" class="menu-item">
                <div class="icon">📋</div>
                <h2>Data Pendaftar</h2>
                <p>Lihat semua siswa yang sudah mendaftar.</p>
            </a>
            <?php endif; ?>
        </div>

    </div>
</body>
</html>
