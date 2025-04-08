<?php
include("db_connection.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obrada podataka iz forme
    $errors = [];
    $igrac_ID = intval($_POST['igrac_ID'] ?? 0);

    // Provjera postoji li igrač
    if ($igrac_ID <= 0) {
        $errors[] = "Nevažeći ID igrača.";
    }

    // Obavezni podaci
    $ime = trim($_POST['ime'] ?? '');
    $prezime = trim($_POST['prezime'] ?? '');
    $datum_rodjenja = $_POST['datum_rodjenja'] ?? null;
    $visina = intval($_POST['visina'] ?? 0);
    $tezina = intval($_POST['tezina'] ?? 0);
    $pozicija = trim($_POST['pozicija'] ?? '');
    $broj_dresa = intval($_POST['broj_dresa'] ?? 0);
    $klub_ID = null;

    // Dohvaćanje ID-a kluba ako je naziv kluba poslan
    if (!empty($_POST['klub_naziv'])) {
        $klub_query = $conn->prepare("SELECT ID_kluba FROM klub WHERE naziv = ?");
        $klub_query->bind_param("s", $_POST['klub_naziv']);
        $klub_query->execute();
        $klub_result = $klub_query->get_result();
        if ($klub_result->num_rows > 0) {
            $klub_row = $klub_result->fetch_assoc();
            $klub_ID = $klub_row['ID_kluba'];
        } else {
            $errors[] = "Nepoznat klub: " . htmlspecialchars($_POST['klub_naziv']);
        }
        $klub_query->close();
    }

    // Provjera obaveznih podataka
    if (empty($ime)) $errors[] = "Ime je obavezno.";
    if (empty($prezime)) $errors[] = "Prezime je obavezno.";
    if (empty($datum_rodjenja)) $errors[] = "Datum rođenja je obavezan.";
    if (empty($pozicija)) $errors[] = "Pozicija je obavezna.";

    // Ako ima grešaka, preusmjeri natrag
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: igraci.php?error=1");
        exit();
    }

    // Ažuriranje igrača
    $sql = "UPDATE igraci 
            SET ime = ?, 
                prezime = ?, 
                datum_rodjenja = ?, 
                visina = ?, 
                tezina = ?, 
                pozicija = ?, 
                broj_dresa = ?, 
                klub_ID = ? 
            WHERE ID_igraca = ?";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Greška u pripremi upita: " . $conn->error);
    }

    // Povezivanje parametara
    $stmt->bind_param(
        "sssiisiii",
        $ime,
        $prezime,
        $datum_rodjenja,
        $visina,
        $tezina,
        $pozicija,
        $broj_dresa,
        $klub_ID,
        $igrac_ID
    );

    if ($stmt->execute()) {
        $_SESSION['success'] = "Igrač je uspješno ažuriran.";
        header("Location: igraci.php?success=1");
        exit();
    } else {
        $_SESSION['error'] = "Greška pri ažuriranju igrača: " . $stmt->error;
        header("Location: igraci.php?error=1");
        exit();
    }
} else {
    header("Location: igraci.php");
    exit();
}
?>