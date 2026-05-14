<?php
session_start();

// Ako je korisnik već prijavljen, idi na dashboard
if (isset($_SESSION['korisnik_id'])) {
    header("Location: pocetna.php");
    exit();
}

// Inače idi na login
header("Location: login.php");
exit();
?>