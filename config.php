<?php

$server = "localhost";
$user = "root";
$password = "";
$nama_database = "pendaftaran_siswa";

$db = mysqli_connect($server, $user, $password, $nama_database);

if(!$db){
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
}

session_start();

// static user untuk login admin
$users = [
    'admin' => [
        'password' => '$2y$10$M25c64cx6bs7EL13pKxEB.EwsVcirYW54Ze/Y2JKzyoTBRI0aParG', // admin123
        'role' => 'admin'
    ]
];

// buat tabel users bila belum ada
$createUsersTable = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','siswa') NOT NULL DEFAULT 'siswa',
    fullname VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
mysqli_query($db, $createUsersTable);

function is_logged_in() {
    return isset($_SESSION['username']);
}

function current_user() {
    return $_SESSION['username'] ?? null;
}

function current_role() {
    return $_SESSION['role'] ?? null;
}

function require_login($redirect = 'login.php') {
    if (!is_logged_in()) {
        header('Location: ' . $redirect);
        exit;
    }
}

function require_admin() {
    require_login();
    if (current_role() !== 'admin') {
        http_response_code(403);
        echo 'Akses ditolak. Hanya admin yang dapat membuka halaman ini.';
        exit;
    }
}

function get_db_user($username) {
    global $db;
    $stmt = mysqli_prepare($db, "SELECT username, password, role, fullname FROM users WHERE username = ? LIMIT 1");
    if (!$stmt) {
        return null;
    }
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $dbUsername, $dbPassword, $dbRole, $dbFullname);
    $user = null;
    if (mysqli_stmt_fetch($stmt)) {
        $user = [
            'username' => $dbUsername,
            'password' => $dbPassword,
            'role' => $dbRole,
            'fullname' => $dbFullname,
        ];
    }
    mysqli_stmt_close($stmt);
    return $user;
}

function username_exists($username) {
    global $users;
    if (isset($users[$username])) {
        return true;
    }
    return get_db_user($username) !== null;
}

function register_user($username, $password, $fullname = '', $role = 'siswa') {
    global $db;
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = mysqli_prepare($db, "INSERT INTO users (username, password, role, fullname) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        return false;
    }
    mysqli_stmt_bind_param($stmt, 'ssss', $username, $hash, $role, $fullname);
    $success = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $success;
}

function verify_user_credentials($username, $password) {
    global $users;
    if (isset($users[$username])) {
        if (password_verify($password, $users[$username]['password'])) {
            return [
                'username' => $username,
                'role' => $users[$username]['role'],
            ];
        }
        return false;
    }
    $dbUser = get_db_user($username);
    if ($dbUser && password_verify($password, $dbUser['password'])) {
        return $dbUser;
    }
    return false;
}

function require_siswa_or_admin() {
    require_login();
    if (!in_array(current_role(), ['siswa', 'admin'], true)) {
        http_response_code(403);
        echo 'Akses ditolak.';
        exit;
    }
}
