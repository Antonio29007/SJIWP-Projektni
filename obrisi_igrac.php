<?php
include("db_connection.php");
session_start();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Provjera postoji li igrač prije brisanja
    $check_query = "SELECT ID_igraca FROM igraci WHERE ID_igraca = $id";
    $check_result = mysqli_query($conn, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        $query = "DELETE FROM igraci WHERE ID_igraca = $id";
        if (mysqli_query($conn, $query)) {
            $_SESSION['success'] = "Igrač je uspješno obrisan.";
        } else {
            $_SESSION['errors'] = ["Došlo je do greške prilikom brisanja igrača."];
        }
    } else {
        $_SESSION['errors'] = ["Igrač nije pronađen."];
    }
    
    header("Location: igraci.php");
    exit();
} else {
    $_SESSION['errors'] = ["Nije odabran igrač za brisanje."];
    header("Location: igraci.php");
    exit();
}
?>