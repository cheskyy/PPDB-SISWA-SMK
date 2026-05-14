<?php
include("config.php");

if (is_logged_in()) {
    header('Location: index.php');
    exit;
}

$error = '';
$success = '';
if (isset($_GET['registered'])) {
    $success = 'Registrasi berhasil. Silakan login menggunakan akun Anda.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Silakan masukkan username dan password.';
    } else {
        $user = verify_user_credentials($username, $password);
        if ($user) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header('Location: index.php');
            exit;
        }
        $error = 'Username atau password salah.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login | Pendaftaran Siswa/Siswi Baru SMK</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h3>Pendaftaran Siswa/Siswi Baru SMK</h3>
        <h1>Masuk ke Sistem Pendaftaran</h1>
    </header>

    <div class="container">
        <div class="card">
            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
            <?php endif; ?>

            <form action="login.php" method="POST">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="admin atau siswa" required />
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Masukkan password" required />
                </div>
                <div class="form-group">
                    <input type="submit" class="btn-submit" value="Login" />
                </div>
            </form>

            <p style="font-size:14px; color:#475569; margin-top:12px; line-height:1.6;">
                Belum punya akun? <a href="register.php">Daftar baru</a> sekarang.<br>
                Admin contoh: <strong>admin</strong> / <strong>admin123</strong>
            </p>
        </div>
    </div>
</body>
</html>
