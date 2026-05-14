<?php
include("db_connection.php");
// NEMA session_start() OVDJE - auth.php će to riješiti ako treba

// ── POST: Dodavanje novog igrača ──────────────────────────────────────────
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['dodaj_igraca'])) {

    $ime      = trim($_POST['ime'] ?? '');
    $prezime  = trim($_POST['prezime'] ?? '');
    $datum    = $_POST['datum_rodenja'] ?? '';
    $pozicija = $_POST['pozicija'] ?? '';
    $klub_ID  = intval($_POST['klub_ID'] ?? 0);

    $errors = [];
    if (empty($ime))      $errors[] = "Ime je obavezno.";
    if (empty($prezime))  $errors[] = "Prezime je obavezno.";
    if (empty($datum))    $errors[] = "Datum rođenja je obavezan.";
    if (empty($pozicija)) $errors[] = "Pozicija je obavezna.";
    if ($klub_ID <= 0)    $errors[] = "Klub je obavezan.";

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: igraci.php?error=1");
        exit();
    }

    $sql  = "INSERT INTO igraci (ime, prezime, datum_rodenja, pozicija, klub_ID) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $ime, $prezime, $datum, $pozicija, $klub_ID);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Igrač {$ime} {$prezime} je uspješno dodan!";
        header("Location: igraci.php?success=1");
        exit();
    } else {
        $_SESSION['errors'] = ["Greška pri dodavanju igrača: " . $stmt->error];
        header("Location: igraci.php?error=1");
        exit();
    }
}

// ── GET: Dohvat podataka o igraču (AJAX za edit modal) ───────────────────
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    header('Content-Type: application/json');
    $id   = intval($_GET['id']);
    $sql  = "SELECT *, DATE_FORMAT(datum_rodenja, '%Y-%m-%d') AS formatted_datum FROM igraci WHERE ID_igraca = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $data['datum_rodenja'] = $data['formatted_datum'];
        echo json_encode($data);
    } else {
        echo json_encode(['error' => 'Igrač nije pronađen']);
    }
    exit();
}
?>