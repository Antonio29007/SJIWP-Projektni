<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!function_exists('isLoggedIn')) {
    function isLoggedIn() {
        return isset($_SESSION['korisnik_id']);
    }
}

if (!function_exists('isAdmin')) {
    function isAdmin() {
        return isset($_SESSION['uloga']) && $_SESSION['uloga'] === 'admin';
    }
}

if (!function_exists('requireLogin')) {
    function requireLogin() {
        if (!isLoggedIn()) {
            header("Location: login.php");
            exit();
        }
    }
}

if (!function_exists('requireAdmin')) {
    function requireAdmin() {
        requireLogin();
        if (!isAdmin()) {
            header("Location: pocetna.php");
            exit();
        }
    }
}

if (!function_exists('getCurrentUser')) {
    function getCurrentUser() {
        if (!isLoggedIn()) return null;
        return [
            'id' => $_SESSION['korisnik_id'],
            'ime' => $_SESSION['ime'] ?? '',
            'prezime' => $_SESSION['prezime'] ?? '',
            'korisnicko_ime' => $_SESSION['korisnicko_ime'] ?? '',
            'uloga' => $_SESSION['uloga'] ?? ''
        ];
    }
}
?>