<?php
include("db_connection.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $igrac_ID = intval($_POST['igrac_ID'] ?? 0);

    // Provjera postoji li igrač
    if ($igrac_ID <= 0) {
        $_SESSION['error'] = "Nevažeći ID igrača.";
        header("Location: igraci.php?error=1");
        exit();
    }

    // Provjera ima li igrač povezanih zapisa (npr. strijelaca)
    $sql_check_strijelci = "SELECT COUNT(*) AS broj FROM strijelci WHERE igrac_ID = ?";
    $stmt_check = $conn->prepare($sql_check_strijelci);
    $stmt_check->bind_param("i", $igrac_ID);
    $stmt_check->execute();
    $result = $stmt_check->get_result();
    $row = $result->fetch_assoc();
    $stmt_check->close();

    if ($row['broj'] > 0) {
        $_SESSION['error'] = "Igrač ima povezane zapise o golovima i ne može se obrisati.";
        header("Location: igraci.php?error=1");
        exit();
    }

    // Brisanje igrača
    $sql_delete_igrac = "DELETE FROM igraci WHERE ID_igraca = ?";
    $stmt_igrac = $conn->prepare($sql_delete_igrac);
    $stmt_igrac->bind_param("i", $igrac_ID);

    if ($stmt_igrac->execute()) {
        $_SESSION['success'] = "Igrač je uspješno obrisan.";
        header("Location: igraci.php?success=1");
        exit();
    } else {
        $_SESSION['error'] = "Greška pri brisanju igrača: " . $stmt_igrac->error;
        header("Location: igraci.php?error=1");
        exit();
    }
} else {
    header("Location: igraci.php");
    exit();
}
?>