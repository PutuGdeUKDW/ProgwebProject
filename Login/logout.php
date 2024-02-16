<?php
// Mulai sesi
session_start();

// Hapus session
session_unset();
session_destroy();

// Hapus cookie dengan nama 'cookie1'
setcookie('cookie1', '', time() - 3600, '/');

// Redirect ke halaman login atau halaman lain yang sesuai
header('Location: login.php');
exit;
?>
