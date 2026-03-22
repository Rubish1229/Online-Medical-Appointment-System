<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Strict no-cache headers
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

// Check session
if (!isset($_SESSION['p_id'])) {
    header("Location: patientlogin.php");
    exit();
}
?>