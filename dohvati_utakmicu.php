<?php
include("db_connection.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Funkcija za dobivanje ID-a na osnovu naziva
    function getID($conn, $table, $column, $value, $id_column) {
        $query = $conn->prepare("SELECT $id_column FROM $table WHERE $column = ?");
        $query->bind_param("s", $value);
        $query->execute();
        $result = $query->get_result();
        return $result->num_rows > 0 ? $result->fetch_assoc()[$id_column] : null;
    }

    // Funkcija za dobivanje ID suca na osnovu punog imena
    function getSudacID($conn, $puno_ime) {
        $parts = explode(' ', $puno_ime, 2);
        if(count($parts) < 2) return null;
        
        $query = $conn->prepare("SELECT ID_sudca FROM sudci WHERE ime = ? AND prezime = ?");
        $query->bind_param("ss", $parts[0], $parts[1]);
        $query->execute();
        $result = $query->get_result();
        return $result->num_rows > 0 ? $result->fetch_assoc()['ID_sudca'] : null;
    }

    // Obrada podataka iz forme
    $errors = [];
    
    // Obavezni podaci
    $datum_i_vrijeme_utakmice = $_POST['datum_i_vrijeme_utakmice'] ?? null;
    $domaci_golovi = intval($_POST['domaci_golovi'] ?? 0);
    $gosti_golovi = intval($_POST['gosti_golovi'] ?? 0);
    $broj_gledatelja = 0; // Default vrijednost
    
    // Dohvaćanje ID-eva
    $dvorana_ID = getID($conn, 'dvorana', 'naziv', $_POST['dvorana_naziv'] ?? '', 'ID_dvorane');
    $sudac_ID = getSudacID($conn, $_POST['sudac'] ?? '');
    $klub_ID_domaci = getID($conn, 'klub', 'naziv', $_POST['domaci_klub'] ?? '', 'ID_kluba');
    $klub_ID_gosti = getID($conn, 'klub', 'naziv', $_POST['gosti_klub'] ?? '', 'ID_kluba');
    
    // Provjera obaveznih podataka
    if(!$datum_i_vrijeme_utakmice) $errors[] = "Datum i vrijeme su obavezni";
    if(!$dvorana_ID) $errors[] = "Nepoznata dvorana: " . htmlspecialchars($_POST['dvorana_naziv'] ?? '');
    if(!$sudac_ID) $errors[] = "Nepoznat sudac: " . htmlspecialchars($_POST['sudac'] ?? '');
    if(!$klub_ID_domaci) $errors[] = "Nepoznat domaći klub: " . htmlspecialchars($_POST['domaci_klub'] ?? '');
    if(!$klub_ID_gosti) $errors[] = "Nepoznat gostujući klub: " . htmlspecialchars($_POST['gosti_klub'] ?? '');
    
    // Ako ima grešaka, preusmjeri natrag
    if(!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $_POST; // Spremi unesene podatke za ponovno prikazivanje
        header("Location: utakmice.php?error=1");
        exit();
    }

    // Unos utakmice
    $sql = "INSERT INTO utakmica 
            (datum_i_vrijeme_utakmice, dvorana_ID, sudac_ID, klub_ID_domaci, klub_ID_gosti, domaci_golovi, gosti_golovi, broj_gledatelja) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    if($stmt === false) {
        $_SESSION['error'] = "Greška u pripremi upita: " . htmlspecialchars($conn->error);
        header("Location: utakmice.php?error=1");
        exit();
    }

    // Povezivanje parametara
    $stmt->bind_param("siiiiiii", 
        $datum_i_vrijeme_utakmice, 
        $dvorana_ID, 
        $sudac_ID, 
        $klub_ID_domaci, 
        $klub_ID_gosti, 
        $domaci_golovi, 
        $gosti_golovi,
        $broj_gledatelja
    );

    if($stmt->execute()) {
        $_SESSION['success'] = "Utakmica uspješno dodana!";
        header("Location: utakmice.php?success=1");
        exit();
    } else {
        $_SESSION['error'] = "Greška pri unosu utakmice: " . htmlspecialchars($stmt->error);
        header("Location: utakmice.php?error=1");
        exit();
    }
} else {
    header("Location: utakmice.php");
    exit();
}
?>