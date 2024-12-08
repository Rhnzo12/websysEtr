<?php
session_start();
include 'db.php';

if ($_SESSION['role'] !== 'Owner') {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'] ?? 'User';
echo "Welcome to your Client Dashboard, " . htmlspecialchars($username) . "!";
?>
