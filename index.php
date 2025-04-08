<?php
include("db_connection.php");

// Dohvaćanje posljednjih utakmica
$sql_utakmice = "SELECT 
    u.ID_utakmice,
    u.datum_i_vrijeme_utakmice,
    k1.naziv AS domaci_klub,
    k2.naziv AS gosti_klub,
    u.domaci_golovi,
    u.gosti_golovi
FROM utakmica u
INNER JOIN klub k1 ON u.klub_ID_domaci = k1.ID_kluba
INNER JOIN klub k2 ON u.klub_ID_gosti = k2.ID_kluba
ORDER BY u.datum_i_vrijeme_utakmice DESC
LIMIT 3";

$result_utakmice = mysqli_query($conn, $sql_utakmice);
$utakmice = mysqli_fetch_all($result_utakmice, MYSQLI_ASSOC);

// Dohvaćanje broja klubova
$sql_klubovi = "SELECT COUNT(*) AS broj_klubova FROM klub";
$result_klubovi = mysqli_query($conn, $sql_klubovi);
$broj_klubova = mysqli_fetch_assoc($result_klubovi)['broj_klubova'];

// Dohvaćanje broja igrača
$sql_igraci = "SELECT COUNT(*) AS broj_igraca FROM igraci";
$result_igraci = mysqli_query($conn, $sql_igraci);
$broj_igraca = mysqli_fetch_assoc($result_igraci)['broj_igraca'];
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rukometna Liga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <style>
        .card {
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body class="bg-light">
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
                        <a href="index.php" class="nav-link text-white bg-dark active">
                            <i class="bi bi-house-door me-2"></i>
                            Početna
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="utakmice.php" class="nav-link text-white">
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
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dobrodošli u Rukometnu Ligu</h1>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-calendar-event text-primary" style="font-size: 3rem;"></i>
                                <h3 class="card-title mt-3">Nadolazeće utakmice</h3>
                                <p class="card-text">Pogledajte raspored sljedećih utakmica u ligi.</p>
                                <a href="utakmice.php" class="btn btn-primary">Prikaži utakmice</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-list-ol text-success" style="font-size: 3rem;"></i>
                                <h3 class="card-title mt-3">Ljestvica</h3>
                                <p class="card-text">Trenutni poredak timova u ligi.</p>
                                <a href="ljestvica.php" class="btn btn-success">Prikaži ljestvicu</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-trophy text-warning" style="font-size: 3rem;"></i>
                                <h3 class="card-title mt-3">Statistike</h3>
                                <p class="card-text">
                                    <?= $broj_klubova ?> klubova<br>
                                    <?= $broj_igraca ?> igrača
                                </p>
                                <a href="igraci.php" class="btn btn-warning">Prikaži igrače</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Posljednji rezultati</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Datum</th>
                                                <th>Domaći</th>
                                                <th>Rezultat</th>
                                                <th>Gosti</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($utakmice)): ?>
                                                <?php foreach ($utakmice as $utakmica): ?>
                                                    <tr>
                                                        <td><?= date('d.m.Y.', strtotime($utakmica['datum_i_vrijeme_utakmice'])) ?></td>
                                                        <td><?= htmlspecialchars($utakmica['domaci_klub']) ?></td>
                                                        <td><?= htmlspecialchars($utakmica['domaci_golovi']) ?> - <?= htmlspecialchars($utakmica['gosti_golovi']) ?></td>
                                                        <td><?= htmlspecialchars($utakmica['gosti_klub']) ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="4" class="text-center">Nema podataka o utakmicama</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
mysqli_close($conn);
?>