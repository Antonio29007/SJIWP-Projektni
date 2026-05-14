<?php
include("db_connection.php");
include("auth.php");
requireAdmin(); // SAMO ADMIN MOZE UREDIVATI

if(!isset($_GET['id'])||!is_numeric($_GET['id'])){ 
    header("Location: utakmice.php"); 
    exit(); 
}
$uid=intval($_GET['id']);

function getID($conn,$tbl,$col,$val,$id_col){
    $q=$conn->prepare("SELECT $id_col FROM $tbl WHERE $col=?");
    $q->bind_param("s",$val); 
    $q->execute();
    $r=$q->get_result();
    return $r->num_rows>0?$r->fetch_assoc()[$id_col]:null;
}

function getSudacID($conn, $ime, $prezime){
    $q=$conn->prepare("SELECT ID_sudca FROM sudci WHERE ime = ? AND prezime = ?");
    $q->bind_param("ss", $ime, $prezime); 
    $q->execute();
    $r=$q->get_result();
    return $r->num_rows>0?$r->fetch_assoc()['ID_sudca']:null;
}

// Dohvati podatke utakmice
$su=$conn->prepare("SELECT u.*,d.naziv AS dvorana_naziv,s.ime AS sudac_ime,s.prezime AS sudac_prezime,
    k1.naziv AS domaci_klub,k2.naziv AS gosti_klub
    FROM utakmica u
    JOIN dvorana d ON u.dvorana_ID=d.ID_dvorane
    JOIN sudci s ON u.sudac_ID=s.ID_sudca
    JOIN klub k1 ON u.klub_ID_domaci=k1.ID_kluba
    JOIN klub k2 ON u.klub_ID_gosti=k2.ID_kluba
    WHERE u.ID_utakmice=?");
$su->bind_param("i",$uid); 
$su->execute();
$r=$su->get_result();
if($r->num_rows===0){ 
    header("Location: utakmice.php"); 
    exit(); 
}
$u=$r->fetch_assoc(); 
$su->close();

$klubovi=mysqli_query($conn,"SELECT ID_kluba,naziv FROM klub");
$dvorane=mysqli_query($conn,"SELECT ID_dvorane,naziv FROM dvorana");

// OBRADA FORME
if($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST['azuriraj'])){
    $errors=[];
    
    // Dohvati podatke iz forme
    $dat=$_POST['datum_i_vrijeme_utakmice']??null;
    $dg=intval($_POST['domaci_golovi']??0);
    $gg=intval($_POST['gosti_golovi']??0);
    $bg=intval($_POST['broj_gledatelja']??0);
    
    $sudac_ime=trim($_POST['sudac_ime']??'');
    $sudac_prezime=trim($_POST['sudac_prezime']??'');
    
    // Dohvati ID-eve
    $dv=getID($conn,'dvorana','naziv',$_POST['dvorana_naziv']??'','ID_dvorane');
    $sc=getSudacID($conn, $sudac_ime, $sudac_prezime);
    $kd=getID($conn,'klub','naziv',$_POST['domaci_klub']??'','ID_kluba');
    $kg=getID($conn,'klub','naziv',$_POST['gosti_klub']??'','ID_kluba');
    
    // Validacija
    if(!$dat) $errors[]="Datum je obavezan";
    if(!$dv)  $errors[]="Nepoznata dvorana";
    if(!$sc)  $errors[]="Nepoznat sudac (provjeri ime i prezime)";
    if(!$kd)  $errors[]="Nepoznat domaći klub";
    if(!$kg)  $errors[]="Nepoznat gostujući klub";
    if($kd == $kg) $errors[]="Domaći i gostujući klub ne mogu biti isti";
    
    if(empty($errors)){
        // UPDATE utakmice
        $upd=$conn->prepare("UPDATE utakmica SET 
            datum_i_vrijeme_utakmice=?,
            dvorana_ID=?,
            sudac_ID=?,
            klub_ID_domaci=?,
            klub_ID_gosti=?,
            domaci_golovi=?,
            gosti_golovi=?,
            broj_gledatelja=? 
            WHERE ID_utakmice=?");
        
        // ISPRAVLJEN bind_param - svi INT osim prvog (string)
        $upd->bind_param("siiiiiiii", 
            $dat,      // string
            $dv,       // int
            $sc,       // int
            $kd,       // int
            $kg,       // int
            $dg,       // int
            $gg,       // int
            $bg,       // int
            $uid       // int
        );
        
        if($upd->execute()){
            $_SESSION['success'] = "Utakmica je uspješno ažurirana!";
            header("Location: utakmice.php?success=1");
            exit();
        } else {
            $errors[] = "Greška pri ažuriranju: " . $upd->error;
        }
        $upd->close();
    }
    
    if(!empty($errors)){
        $_SESSION['errors'] = $errors;
        // Refresh stranice da pokaže greške
        header("Location: edit_utakmica.php?id=" . $uid);
        exit();
    }
}

// Brisanje utakmice
if($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST['obrisi'])){
    // Prvo obriši strijelce (ako ih ima - foreign key constraint)
    $d1=$conn->prepare("DELETE FROM strijelci WHERE utakmica_ID=?");
    $d1->bind_param("i",$uid);
    $d1->execute();
    $d1->close();
    
    // Onda obriši utakmicu
    $d2=$conn->prepare("DELETE FROM utakmica WHERE ID_utakmice=?");
    $d2->bind_param("i",$uid);
    if($d2->execute()){
        $_SESSION['success'] = "Utakmica je uspješno obrisana!";
        header("Location: utakmice.php?success=1");
        exit();
    } else {
        $_SESSION['errors'] = ["Greška pri brisanju utakmice."];
        header("Location: edit_utakmica.php?id=" . $uid);
        exit();
    }
    $d2->close();
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Uredi utakmicu — Rukometna Liga</title>
<?php include("style.php"); ?>
<style>
    .two-col { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
    @media(max-width:700px){ .two-col { grid-template-columns:1fr; } }
</style>
</head>
<body>
<?php include("sidebar.php"); ?>
<div class="page">
<div class="page-inner">

    <div class="pg-head">
        <div>
            <div class="pg-eyebrow">Uređivanje utakmice</div>
            <h1 class="pg-title" style="font-size:38px">
                <?=htmlspecialchars($u['domaci_klub'])?> 
                <span style="color:var(--c-muted);font-size:24px">vs</span> 
                <?=htmlspecialchars($u['gosti_klub'])?>
            </h1>
        </div>
        <div style="display:flex;gap:10px;align-items:center">
            <a href="utakmice.php" class="btn btn-ghost">← Natrag</a>
            <form method="POST" style="display:inline" onsubmit="return confirm('Obrisati ovu utakmicu? Ova radnja je nepovratna.')">
                <button type="submit" name="obrisi" class="btn btn-danger">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="3 6 5 6 21 6"/>
                        <path d="M19 6l-1 14H6L5 6"/>
                        <path d="M9 6V4h6v2"/>
                    </svg>
                    Obriši utakmicu
                </button>
            </form>
        </div>
    </div>

    <?php if(isset($_SESSION['errors'])): ?>
        <div class="alert alert-err">
            <?php foreach($_SESSION['errors'] as $e): ?>
                • <?=htmlspecialchars($e)?><br>
            <?php endforeach; ?>
        </div>
        <?php unset($_SESSION['errors']); ?>
    <?php endif; ?>

    <form method="POST">
        <div class="two-col" style="margin-bottom:18px">
            <!-- LIJEVA KOLONA - Klubovi i rezultat -->
            <div class="card" style="padding:26px">
                <div style="font-size:10px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--c-muted2);margin-bottom:18px">
                    📋 Klubovi i rezultat
                </div>
                <div class="fg">
                    <label>Domaći klub</label>
                    <select name="domaci_klub" required>
                        <option value="">Odaberi klub</option>
                        <?php mysqli_data_seek($klubovi,0); while($k=mysqli_fetch_assoc($klubovi)): ?>
                            <option value="<?=htmlspecialchars($k['naziv'])?>" 
                                <?=$k['naziv']==$u['domaci_klub']?'selected':''?>>
                                <?=htmlspecialchars($k['naziv'])?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="fg">
                    <label>Gostujući klub</label>
                    <select name="gosti_klub" required>
                        <option value="">Odaberi klub</option>
                        <?php mysqli_data_seek($klubovi,0); while($k=mysqli_fetch_assoc($klubovi)): ?>
                            <option value="<?=htmlspecialchars($k['naziv'])?>" 
                                <?=$k['naziv']==$u['gosti_klub']?'selected':''?>>
                                <?=htmlspecialchars($k['naziv'])?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="fg-row">
                    <div class="fg">
                        <label>Golovi domaći</label>
                        <input type="number" name="domaci_golovi" value="<?=$u['domaci_golovi']?>" min="0" required>
                    </div>
                    <div class="fg">
                        <label>Golovi gosti</label>
                        <input type="number" name="gosti_golovi" value="<?=$u['gosti_golovi']?>" min="0" required>
                    </div>
                </div>
                <div class="fg">
                    <label>Broj gledatelja</label>
                    <input type="number" name="broj_gledatelja" value="<?=$u['broj_gledatelja']?>" min="0">
                </div>
            </div>

            <!-- DESNA KOLONA - Detalji utakmice -->
            <div class="card" style="padding:26px">
                <div style="font-size:10px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--c-muted2);margin-bottom:18px">
                    🏟️ Detalji utakmice
                </div>
                <div class="fg">
                    <label>Datum i vrijeme</label>
                    <input type="datetime-local" name="datum_i_vrijeme_utakmice"
                        value="<?=date('Y-m-d\TH:i',strtotime($u['datum_i_vrijeme_utakmice']))?>" required>
                </div>
                <div class="fg">
                    <label>Dvorana</label>
                    <select name="dvorana_naziv" required>
                        <option value="">Odaberi dvoranu</option>
                        <?php mysqli_data_seek($dvorane,0); while($d=mysqli_fetch_assoc($dvorane)): ?>
                            <option value="<?=htmlspecialchars($d['naziv'])?>" 
                                <?=$d['naziv']==$u['dvorana_naziv']?'selected':''?>>
                                <?=htmlspecialchars($d['naziv'])?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="fg-row">
                    <div class="fg">
                        <label>Sudac — Ime</label>
                        <input type="text" name="sudac_ime" value="<?=htmlspecialchars($u['sudac_ime'])?>" required>
                    </div>
                    <div class="fg">
                        <label>Sudac — Prezime</label>
                        <input type="text" name="sudac_prezime" value="<?=htmlspecialchars($u['sudac_prezime'])?>" required>
                    </div>
                </div>
            </div>
        </div>

        <!-- NEMA STRIJELACA - UKLONJENO -->

        <div style="display:flex;gap:10px;justify-content:flex-end">
            <a href="utakmice.php" class="btn btn-ghost">Odustani</a>
            <button type="submit" name="azuriraj" class="btn btn-primary">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                    <polyline points="17 21 17 13 7 13 7 21"/>
                    <polyline points="7 3 7 8 15 8"/>
                </svg>
                Spremi promjene
            </button>
        </div>
    </form>

</div>
</div>
</body>
</html>
<?php mysqli_close($conn); ?>