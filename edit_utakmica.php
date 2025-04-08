<?php
include("db_connection.php");
session_start();

// Provera da li je prosleđen ID utakmice
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: utakmice.php");
    exit();
}

$utakmica_id = intval($_GET['id']);

// Dohvatanje podataka o utakmici
$sql_utakmica = "SELECT 
    u.ID_utakmice,
    u.datum_i_vrijeme_utakmice,
    u.domaci_golovi,
    u.gosti_golovi,
    u.broj_gledatelja,
    d.naziv AS dvorana_naziv,
    s.ime AS sudac_ime,
    s.prezime AS sudac_prezime,
    k1.naziv AS domaci_klub,
    k2.naziv AS gosti_klub
FROM utakmica u
INNER JOIN dvorana d ON u.dvorana_ID = d.ID_dvorane
INNER JOIN sudci s ON u.sudac_ID = s.ID_sudca
INNER JOIN klub k1 ON u.klub_ID_domaci = k1.ID_kluba
INNER JOIN klub k2 ON u.klub_ID_gosti = k2.ID_kluba
WHERE u.ID_utakmice = ?";

$stmt = $conn->prepare($sql_utakmica);
$stmt->bind_param("i", $utakmica_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: utakmice.php");
    exit();
}

$utakmica = $result->fetch_assoc();
$stmt->close();

// Dohvatanje strijelaca za utakmicu
$sql_strijelci = "SELECT 
    st.broj_golova,
    i.ime AS igrac_ime,
    i.prezime AS igrac_prezime
FROM strijelci st
INNER JOIN igraci i ON st.igrac_ID = i.ID_igraca
WHERE st.utakmica_ID = ?";

$stmt_strijelci = $conn->prepare($sql_strijelci);
$stmt_strijelci->bind_param("i", $utakmica_id);
$stmt_strijelci->execute();
$strijelci_result = $stmt_strijelci->get_result();
$strijelci = $strijelci_result->fetch_all(MYSQLI_ASSOC);
$stmt_strijelci->close();

// Dohvaćanje podataka za formu
$klubovi = mysqli_query($conn, "SELECT ID_kluba, naziv FROM klub");
$dvorane = mysqli_query($conn, "SELECT ID_dvorane, naziv FROM dvorana");
$sudci = mysqli_query($conn, "SELECT ID_sudca, ime, prezime FROM sudci");
$igraci = mysqli_query($conn, "SELECT ID_igraca, ime, prezime FROM igraci");

// Obrada POST zahteva za ažuriranje
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['azuriraj'])) {
        // Obrada ažuriranja utakmice
        $errors = [];
        
        $datum_i_vrijeme_utakmice = $_POST['datum_i_vrijeme_utakmice'] ?? null;
        $domaci_golovi = intval($_POST['domaci_golovi'] ?? 0);
        $gosti_golovi = intval($_POST['gosti_golovi'] ?? 0);
        $broj_gledatelja = intval($_POST['broj_gledatelja'] ?? 0);
        
        // Dohvaćanje ID-eva
        $dvorana_ID = getID($conn, 'dvorana', 'naziv', $_POST['dvorana_naziv'] ?? '', 'ID_dvorane');
        $sudac_ID = getID($conn, 'sudci', 'ime', $_POST['sudac_ime'] ?? '', 'ID_sudca');
        $klub_ID_domaci = getID($conn, 'klub', 'naziv', $_POST['domaci_klub'] ?? '', 'ID_kluba');
        $klub_ID_gosti = getID($conn, 'klub', 'naziv', $_POST['gosti_klub'] ?? '', 'ID_kluba');
        
        // Provjera obaveznih podataka
        if(!$datum_i_vrijeme_utakmice) $errors[] = "Datum i vrijeme su obavezni";
        if(!$dvorana_ID) $errors[] = "Nepoznata dvorana: " . ($_POST['dvorana_naziv'] ?? '');
        if(!$sudac_ID) $errors[] = "Nepoznat sudac: " . ($_POST['sudac_ime'] ?? '');
        if(!$klub_ID_domaci) $errors[] = "Nepoznat domaći klub: " . ($_POST['domaci_klub'] ?? '');
        if(!$klub_ID_gosti) $errors[] = "Nepoznat gostujući klub: " . ($_POST['gosti_klub'] ?? '');
        
        if(empty($errors)) {
            // Ažuriranje utakmice
            $sql_update = "UPDATE utakmica SET 
                datum_i_vrijeme_utakmice = ?,
                dvorana_ID = ?,
                sudac_ID = ?,
                klub_ID_domaci = ?,
                klub_ID_gosti = ?,
                domaci_golovi = ?,
                gosti_golovi = ?,
                broj_gledatelja = ?
                WHERE ID_utakmice = ?";
            
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("siiiiiii", 
                $datum_i_vrijeme_utakmice, 
                $dvorana_ID, 
                $sudac_ID, 
                $klub_ID_domaci, 
                $klub_ID_gosti, 
                $domaci_golovi, 
                $gosti_golovi,
                $broj_gledatelja,
                $utakmica_id
            );
            
            if($stmt_update->execute()) {
                // Brisanje postojećih strijelaca
                $sql_delete_strijelci = "DELETE FROM strijelci WHERE utakmica_ID = ?";
                $stmt_delete = $conn->prepare($sql_delete_strijelci);
                $stmt_delete->bind_param("i", $utakmica_id);
                $stmt_delete->execute();
                $stmt_delete->close();
                
                // Dodavanje novih strijelaca
                if (!empty($_POST['strijelci'])) {
                    foreach ($_POST['strijelci'] as $strijelac) {
                        if (!empty($strijelac['ime']) && !empty($strijelac['prezime']) && !empty($strijelac['broj_golova'])) {
                            $igrac_ID = getID($conn, 'igraci', 'ime', $strijelac['ime'], 'ID_igraca');
                            if ($igrac_ID) {
                                $sql_insert_strijelac = "INSERT INTO strijelci (utakmica_ID, igrac_ID, broj_golova) VALUES (?, ?, ?)";
                                $stmt_insert = $conn->prepare($sql_insert_strijelac);
                                $stmt_insert->bind_param("iii", $utakmica_id, $igrac_ID, $strijelac['broj_golova']);
                                $stmt_insert->execute();
                                $stmt_insert->close();
                            }
                        }
                    }
                }
                
                $_SESSION['success'] = "Utakmica je uspješno ažurirana!";
                header("Location: utakmice.php?success=1");
                exit();
            } else {
                $errors[] = "Greška pri ažuriranju utakmice: " . $stmt_update->error;
            }
            $stmt_update->close();
        }
        
        if(!empty($errors)) {
            $_SESSION['errors'] = $errors;
        }
    } elseif (isset($_POST['obrisi'])) {
        // Brisanje utakmice
        // Prvo brisanje strijelaca
        $sql_delete_strijelci = "DELETE FROM strijelci WHERE utakmica_ID = ?";
        $stmt_delete = $conn->prepare($sql_delete_strijelci);
        $stmt_delete->bind_param("i", $utakmica_id);
        $stmt_delete->execute();
        $stmt_delete->close();
        
        // Zatim brisanje utakmice
        $sql_delete = "DELETE FROM utakmica WHERE ID_utakmice = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("i", $utakmica_id);
        
        if($stmt_delete->execute()) {
            $_SESSION['success'] = "Utakmica je uspješno obrisana!";
            header("Location: utakmice.php?success=1");
            exit();
        } else {
            $_SESSION['errors'] = ["Greška pri brisanju utakmice: " . $stmt_delete->error];
        }
        $stmt_delete->close();
    }
}

// Funkcija za dobivanje ID-a na osnovu naziva
function getID($conn, $table, $column, $value, $id_column) {
    $query = $conn->prepare("SELECT $id_column FROM $table WHERE $column = ?");
    $query->bind_param("s", $value);
    $query->execute();
    $result = $query->get_result();
    return $result->num_rows > 0 ? $result->fetch_assoc()[$id_column] : null;
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uredi utakmicu - Rukometna Liga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-responsive { overflow-x: auto; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Lijeva navigacija -->
            <div class="col-md-3 col-lg-2 d-flex flex-column flex-shrink-0 p-3 bg-primary" style="height: 100vh;">
                <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-4">Rukometna Liga</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="utakmice.php" class="nav-link text-white">
                            Utakmice
                        </a>
                    </li>
                    <li>
                        <a href="timovi.php" class="nav-link text-white">
                            Timovi
                        </a>
                    </li>
                    <li>
                        <a href="igraci.php" class="nav-link text-white">
                            Igrači
                        </a>
                    </li>
                    <li>
                        <a href="ljestvica.php" class="nav-link text-white">
                            Ljestvica
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Glavni sadržaj -->
            <div class="col-md-9 col-lg-10 ms-sm-auto px-md-4">
                <?php if (isset($_SESSION['errors'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show mt-3">
                        <?php foreach($_SESSION['errors'] as $error): ?>
                            <?= htmlspecialchars($error) ?><br>
                        <?php endforeach; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php unset($_SESSION['errors']); ?>
                <?php endif; ?>

                <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
                    <h1>Uredi utakmicu</h1>
                    <form method="POST" class="d-inline">
                        <button type="submit" name="obrisi" class="btn btn-danger" onclick="return confirm('Jeste li sigurni da želite obrisati ovu utakmicu?')">Obriši utakmicu</button>
                    </form>
                </div>

                <form action="" method="POST" id="utakmicaForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="domaci_klub" class="form-label">Domaći klub</label>
                            <select class="form-select" id="domaci_klub" name="domaci_klub" required>
                                <option value="">Odaberi domaći klub</option>
                                <?php while ($klub = mysqli_fetch_assoc($klubovi)): ?>
                                    <option value="<?= htmlspecialchars($klub['naziv']) ?>" <?= $klub['naziv'] == $utakmica['domaci_klub'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($klub['naziv']) ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="gosti_klub" class="form-label">Gosti klub</label>
                            <select class="form-select" id="gosti_klub" name="gosti_klub" required>
                                <option value="">Odaberi gostujući klub</option>
                                <?php mysqli_data_seek($klubovi, 0); ?>
                                <?php while ($klub = mysqli_fetch_assoc($klubovi)): ?>
                                    <option value="<?= htmlspecialchars($klub['naziv']) ?>" <?= $klub['naziv'] == $utakmica['gosti_klub'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($klub['naziv']) ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="datum_i_vrijeme_utakmice" class="form-label">Datum i vrijeme</label>
                            <input type="datetime-local" class="form-control" id="datum_i_vrijeme_utakmice" 
                                   name="datum_i_vrijeme_utakmice" 
                                   value="<?= date('Y-m-d\TH:i', strtotime($utakmica['datum_i_vrijeme_utakmice'])) ?>" 
                                   required>
                        </div>
                        <div class="col-12">
                            <label for="dvorana_naziv" class="form-label">Dvorana</label>
                            <select class="form-select" id="dvorana_naziv" name="dvorana_naziv" required>
                                <option value="">Odaberi dvoranu</option>
                                <?php while ($dvorana = mysqli_fetch_assoc($dvorane)): ?>
                                    <option value="<?= htmlspecialchars($dvorana['naziv']) ?>" <?= $dvorana['naziv'] == $utakmica['dvorana_naziv'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($dvorana['naziv']) ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="sudac_ime" class="form-label">Sudac - ime</label>
                            <input type="text" class="form-control" id="sudac_ime" name="sudac_ime" 
                                   value="<?= htmlspecialchars($utakmica['sudac_ime']) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="sudac_prezime" class="form-label">Sudac - prezime</label>
                            <input type="text" class="form-control" id="sudac_prezime" name="sudac_prezime" 
                                   value="<?= htmlspecialchars($utakmica['sudac_prezime']) ?>" required>
                        </div>
                        <div class="col-md-3">
                            <label for="domaci_golovi" class="form-label">Golovi - domaći</label>
                            <input type="number" class="form-control" id="domaci_golovi" name="domaci_golovi" 
                                   value="<?= htmlspecialchars($utakmica['domaci_golovi']) ?>" min="0" required>
                        </div>
                        <div class="col-md-3">
                            <label for="gosti_golovi" class="form-label">Golovi - gosti