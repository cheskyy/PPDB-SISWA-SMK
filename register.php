<?php
include("config.php");

if (is_logged_in()) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';
    $fullname = trim($_POST['fullname'] ?? '');

    if ($username === '' || $password === '' || $confirm === '') {
        $error = 'Semua kolom wajib diisi.';
    } elseif ($password !== $confirm) {
        $error = 'Password dan konfirmasi password tidak sama.';
    } elseif (strlen($password) < 6) {
        $error = 'Password minimal 6 karakter.';
    } elseif (username_exists($username)) {
        $error = 'Username sudah digunakan. Silakan pilih username lain.';
    } else {
        $created = register_user($username, $password, $fullname, 'siswa');
        if ($created) {
            header('Location: login.php?registered=1');
            exit;
        }
        $error = 'Gagal mendaftar. Silakan coba lagi.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register | Pendaftaran Siswa/Siswi Baru SMK</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h3>Pendaftaran Siswa/Siswi Baru SMK</h3>
        <h1>Buat Akun Siswa Baru</h1>
    </header>

    <div class="container">
        <div class="card">
            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form action="register.php" method="POST">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Masukkan username" required />
                </div>
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="fullname" placeholder="Masukkan nama lengkap" />
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Minimal 6 karakter" required />
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="confirm_password" placeholder="Ulangi password" required />
                </div>
                <div class="form-group">
                    <input type="submit" class="btn-submit" value="Daftar Sekarang" />
                </div>
            </form>

            <p style="font-size:14px; color:#475569; margin-top:12px; line-height:1.6;">
                Sudah punya akun? <a href="login.php">Login di sini</a>.
            </p>
        </div>
    </div>
</body>
</html>
