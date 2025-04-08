<?php
include("db_connection.php");
session_start();

// Dohvaćanje igrača iz baze podataka
$sql = "SELECT 
            i.ID_igraca,
            i.ime, 
            i.prezime, 
            i.datum_rodenja, 
            i.pozicija, 
            k.naziv AS klub_naziv,
            k.ID_kluba
        FROM igraci i
        JOIN klub k ON i.klub_ID = k.ID_kluba
        ORDER BY k.naziv, i.prezime";

$result = mysqli_query($conn, $sql);
$igraci = [];

while ($row = mysqli_fetch_assoc($result)) {
    $igraci[$row['klub_naziv']][] = $row;
}

// Dohvaćanje klubova za formu
$klubovi_options = mysqli_query($conn, "SELECT ID_kluba, naziv FROM klub");
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rukometna Liga - Igrači</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <style>
        .table-responsive { overflow-x: auto; }
        .card { transition: transform 0.2s; }
        .card:hover { transform: translateY(-5px); }
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
                        <a href="igraci.php" class="nav-link text-white bg-dark active">
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

                <?php if (isset($_SESSION['errors'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show mt-3">
                        <?php foreach($_SESSION['errors'] as $error): ?>
                            <?= htmlspecialchars($error) ?><br>
                        <?php endforeach; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php unset($_SESSION['errors']); ?>
                <?php endif; ?>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1><i class="bi bi-person-badge"></i> Popis Igrača</h1>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dodajIgracaModal">
                        <i class="bi bi-plus-circle"></i> Dodaj igrača
                    </button>
                </div>

                <?php if (empty($igraci)): ?>
                    <div class="alert alert-info">Nema podataka o igračima u bazi.</div>
                <?php else: ?>
                    <?php foreach ($igraci as $klub_naziv => $igraci_kluba): ?>
                        <div class="card mb-4 shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><?= htmlspecialchars($klub_naziv) ?></h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Ime</th>
                                                <th>Prezime</th>
                                                <th>Datum rođenja</th>
                                                <th>Pozicija</th>
                                                <th>Akcije</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($igraci_kluba as $igrac): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($igrac['ime']) ?></td>
                                                    <td><?= htmlspecialchars($igrac['prezime']) ?></td>
                                                    <td><?= date('d.m.Y', strtotime($igrac['datum_rodenja'])) ?></td>
                                                    <td><?= htmlspecialchars($igrac['pozicija']) ?></td>
                                                    <td>
                                                        <a href="edit_igrac.php?id=<?= $igrac['ID_igraca'] ?>" class="btn btn-sm btn-warning me-2">
                                                            <i class="bi bi-pencil"></i> Uredi
                                                        </a>
                                                        <a href="obrisi_igrac.php?id=<?= $igrac['ID_igraca'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Jeste li sigurni da želite obrisati ovog igrača?')">
                                                            <i class="bi bi-trash"></i> Obriši
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Modal za dodavanje novog igrača -->
    <div class="modal fade" id="dodajIgracaModal" tabindex="-1" aria-labelledby="dodajIgracaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dodajIgracaModalLabel"><i class="bi bi-plus-circle"></i> Dodaj novog igrača</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="dohvati_igraca.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="ime" class="form-label">Ime</label>
                            <input type="text" class="form-control" id="ime" name="ime" required>
                        </div>
                        <div class="mb-3">
                            <label for="prezime" class="form-label">Prezime</label>
                            <input type="text" class="form-control" id="prezime" name="prezime" required>
                        </div>
                        <div class="mb-3">
                            <label for="datum_rodenja" class="form-label">Datum rođenja</label>
                            <input type="date" class="form-control" id="datum_rodenja" name="datum_rodenja" required>
                        </div>
                        <div class="mb-3">
                            <label for="pozicija" class="form-label">Pozicija</label>
                            <select class="form-select" id="pozicija" name="pozicija" required>
                                <option value="">Odaberi poziciju</option>
                                <option value="golman">Golman</option>
                                <option value="lijevo krilo">Lijevo krilo</option>
                                <option value="desno krilo">Desno krilo</option>
                                <option value="lijevi vanjski">Lijevi vanjski</option>
                                <option value="desni vanjski">Desni vanjski</option>
                                <option value="srednji vanjski">Srednji vanjski</option>
                                <option value="pivot">Pivot</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="klub_ID" class="form-label">Klub</label>
                            <select class="form-select" id="klub_ID" name="klub_ID" required>
                                <option value="">Odaberi klub</option>
                                <?php while ($klub = mysqli_fetch_assoc($klubovi_options)): ?>
                                    <option value="<?= htmlspecialchars($klub['ID_kluba']) ?>"><?= htmlspecialchars($klub['naziv']) ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Zatvori</button>
                        <button type="submit" name="dodaj_igraca" class="btn btn-primary"><i class="bi bi-save"></i> Spremi igrača</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
mysqli_close($conn);
?>