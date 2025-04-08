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

    // Obrada podataka iz forme
    $errors = [];
    
    // Obavezni podaci
    $datum_i_vrijeme_utakmice = $_POST['datum_i_vrijeme_utakmice'] ?? null;
    $domaci_golovi = intval($_POST['domaci_golovi'] ?? 0);
    $gosti_golovi = intval($_POST['gosti_golovi'] ?? 0);
    $broj_gledatelja = 0; // Default vrijednost
    
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
    
    // Ako ima grešaka, preusmjeri natrag
    if(!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: utakmice.php?error=1");
        exit();
    }

    // Unos utakmice
    $sql = "INSERT INTO utakmica 
            (datum_i_vrijeme_utakmice, dvorana_ID, sudac_ID, klub_ID_domaci, klub_ID_gosti, domaci_golovi, gosti_golovi, broj_gledatelja) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    if($stmt === false) {
        die("Greška u pripremi upita: " . $conn->error);
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
        $utakmica_ID = $conn->insert_id;
        
        // Unos strijelaca ako su uneseni svi potrebni podaci
        if(!empty($_POST['igrac_ime']) && !empty($_POST['igrac_prezime']) && !empty($_POST['broj_golova'])) {
            $igrac_ime = $_POST['igrac_ime'];
            $igrac_prezime = $_POST['igrac_prezime'];
            $broj_golova = intval($_POST['broj_golova']);
            
            // Provjera postoji li igrač u bazi
            $igrac_query = $conn->prepare("SELECT ID_igraca FROM igraci WHERE ime = ? AND prezime = ?");
            $igrac_query->bind_param("ss", $igrac_ime, $igrac_prezime);
            $igrac_query->execute();
            $igrac_result = $igrac_query->get_result();
            
            if($igrac_result->num_rows > 0) {
                $igrac_row = $igrac_result->fetch_assoc();
                $igrac_ID = $igrac_row['ID_igraca'];
                
                $strijelac_sql = "INSERT INTO strijelci (utakmica_ID, igrac_ID, broj_golova) VALUES (?, ?, ?)";
                $strijelac_stmt = $conn->prepare($strijelac_sql);
                $strijelac_stmt->bind_param("iii", $utakmica_ID, $igrac_ID, $broj_golova);
                
                if(!$strijelac_stmt->execute()) {
                    $_SESSION['warning'] = "Utakmica je spremljena, ali nije uspio unos strijelca: " . $strijelac_stmt->error;
                }
                $strijelac_stmt->close();
            } else {
                $_SESSION['warning'] = "Utakmica je spremljena, ali strijelac '" . htmlspecialchars($igrac_ime . " " . $igrac_prezime) . "' nije pronađen u bazi";
            }
            $igrac_query->close();
        }
        
        header("Location: utakmice.php?success=1");
        exit();
    } else {
        $_SESSION['error'] = "Greška pri unosu utakmice: " . $stmt->error;
        header("Location: utakmice.php?error=1");
        exit();
    }
} else {
    header("Location: utakmice.php");
    exit();
}
?>