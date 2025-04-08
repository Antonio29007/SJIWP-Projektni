<?php
include("db_connection.php");
session_start();

// Dohvaćanje podataka o utakmicama
$sql = "SELECT 
    u.ID_utakmice,
    u.datum_i_vrijeme_utakmice,
    d.naziv AS dvorana_naziv,
    CONCAT(s.ime, ' ', s.prezime) AS sudac,
    k1.naziv AS domaci_klub,
    k2.naziv AS gosti_klub,
    u.domaci_golovi,
    u.gosti_golovi
FROM utakmica u
INNER JOIN dvorana d ON u.dvorana_ID = d.ID_dvorane
INNER JOIN sudci s ON u.sudac_ID = s.ID_sudca
INNER JOIN klub k1 ON u.klub_ID_domaci = k1.ID_kluba
INNER JOIN klub k2 ON u.klub_ID_gosti = k2.ID_kluba
ORDER BY u.datum_i_vrijeme_utakmice DESC";

$result = mysqli_query($conn, $sql);
$utakmice = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Dohvaćanje podataka za formu
$klubovi = mysqli_query($conn, "SELECT ID_kluba, naziv FROM klub");
$dvorane = mysqli_query($conn, "SELECT ID_dvorane, naziv FROM dvorana");
$sudci = mysqli_query($conn, "SELECT ID_sudca, CONCAT(ime, ' ', prezime) AS puno_ime FROM sudci");
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rukometna Liga - Utakmice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <style>
        .table-responsive { overflow-x: auto; }
        .match-result { font-weight: bold; text-align: center; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Lijeva navigacija -->
            <div class="col-md-3 col-lg-2 d-flex flex-column flex-shrink-0 p-3 bg-primary text-white" style="height: 100vh;">
                <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <i class="bi bi-trophy-fill fs-4 me-2"></i>
                    <span class="fs-4">Rukometna Liga</span>
                </a>
                <hr class="border border-white">
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link text-white">
                            <i class="bi bi-house-door me-2"></i>
                            Početna
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="utakmice.php" class="nav-link text-white bg-dark active">
                            <i class="bi bi-calendar-event me-2"></i>
                            Utakmice
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="timovi.php" class="nav-link text-white">
                            <i class="bi bi-people-fill me-2"></i>
                            Timovi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="igraci.php" class="nav-link text-white">
                            <i class="bi bi-person-badge me-2"></i>
                            Igrači
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="ljestvica.php" class="nav-link text-white">
                            <i class="bi bi-list-ol me-2"></i>
                            Ljestvica
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Glavni sadržaj -->
            <div class="col-md-9 col-lg-10 ms-sm-auto px-md-4 py-4">
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show mt-3">
                        <?= isset($_SESSION['success']) ? $_SESSION['success'] : 'Operacija uspješno izvršena!' ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['warning'])): ?>
                    <div class="alert alert-warning alert-dismissible fade show mt-3">
                        <?= $_SESSION['warning'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php unset($_SESSION['warning']); ?>
                <?php endif; ?>

                <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
                    <h1><i class="bi bi-calendar-event"></i> Utakmice</h1>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dodajUtakmicuModal">
                        <i class="bi bi-plus-circle"></i> Dodaj utakmicu
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Datum i Vrijeme</th>
                                <th>Domaći</th>
                                <th>Rezultat</th>
                                <th>Gosti</th>
                                <th>Sudac</th>
                                <th>Dvorana</th>
                                <th>Akcije</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($utakmice)): ?>
                                <?php foreach ($utakmice as $utakmica): ?>
                                    <tr>
                                        <td><?= date('d.m.Y H:i', strtotime($utakmica['datum_i_vrijeme_utakmice'])) ?></td>
                                        <td><?= htmlspecialchars($utakmica['domaci_klub']) ?></td>
                                        <td class="match-result">
                                            <?= htmlspecialchars($utakmica['domaci_golovi']) ?> : <?= htmlspecialchars($utakmica['gosti_golovi']) ?>
                                        </td>
                                        <td><?= htmlspecialchars($utakmica['gosti_klub']) ?></td>
                                        <td><?= htmlspecialchars($utakmica['sudac']) ?></td>
                                        <td><?= htmlspecialchars($utakmica['dvorana_naziv']) ?></td>
                                        <td>
                                            <a href="edit_utakmica.php?id=<?= $utakmica['ID_utakmice'] ?>" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil"></i> Uredi
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">Nema podataka o utakmicama</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal za dodavanje nove utakmice -->
    <div class="modal fade" id="dodajUtakmicuModal" tabindex="-1" aria-labelledby="dodajUtakmicuModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dodajUtakmicuModalLabel"><i class="bi bi-plus-circle"></i> Dodaj novu utakmicu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="dohvati_utakmicu.php" method="POST" id="utakmicaForm">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="domaci_klub" class="form-label">Domaći klub</label>
                                <select class="form-select" id="domaci_klub" name="domaci_klub" required>
                                    <option value="">Odaberi domaći klub</option>
                                    <?php while ($klub = mysqli_fetch_assoc($klubovi)): ?>
                                        <option value="<?= htmlspecialchars($klub['naziv']) ?>"><?= htmlspecialchars($klub['naziv']) ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="gosti_klub" class="form-label">Gosti klub</label>
                                <select class="form-select" id="gosti_klub" name="gosti_klub" required>
                                    <option value="">Odaberi gostujući klub</option>
                                    <?php mysqli_data_seek($klubovi, 0); ?>
                                    <?php while ($klub = mysqli_fetch_assoc($klubovi)): ?>
                                        <option value="<?= htmlspecialchars($klub['naziv']) ?>"><?= htmlspecialchars($klub['naziv']) ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="datum_i_vrijeme_utakmice" class="form-label">Datum i vrijeme</label>
                                <input type="datetime-local" class="form-control" id="datum_i_vrijeme_utakmice" name="datum_i_vrijeme_utakmice" required>
                            </div>
                            <div class="col-12">
                                <label for="dvorana_naziv" class="form-label">Dvorana</label>
                                <select class="form-select" id="dvorana_naziv" name="dvorana_naziv" required>
                                    <option value="">Odaberi dvoranu</option>
                                    <?php while ($dvorana = mysqli_fetch_assoc($dvorane)): ?>
                                        <option value="<?= htmlspecialchars($dvorana['naziv']) ?>"><?= htmlspecialchars($dvorana['naziv']) ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="sudac" class="form-label">Sudac</label>
                                <select class="form-select" id="sudac" name="sudac" required>
                                    <option value="">Odaberi suca</option>
                                    <?php while ($sudac = mysqli_fetch_assoc($sudci)): ?>
                                        <option value="<?= htmlspecialchars($sudac['puno_ime']) ?>"><?= htmlspecialchars($sudac['puno_ime']) ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="domaci_golovi" class="form-label">Golovi - domaći</label>
                                <input type="number" class="form-control" id="domaci_golovi" name="domaci_golovi" min="0" required>
                            </div>
                            <div class="col-md-3">
                                <label for="gosti_golovi" class="form-label">Golovi - gosti</label>
                                <input type="number" class="form-control" id="gosti_golovi" name="gosti_golovi" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Zatvori</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Spremi utakmicu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const forma = document.getElementById('utakmicaForm');
            
            forma.addEventListener('submit', function(e) {
                const domaci = document.getElementById('domaci_klub').value;
                const gosti = document.getElementById('gosti_klub').value;
                
                if (domaci === gosti) {
                    e.preventDefault();
                    alert('Domaći i gostujući klub ne mogu biti isti!');
                    return false;
                }
                
                return true;
            });
        });
    </script>
</body>
</html>
<?php
mysqli_close($conn);
?>