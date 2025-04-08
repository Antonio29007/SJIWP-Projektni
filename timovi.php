<?php
include("db_connection.php");

$sql = "SELECT ID_kluba, naziv, datum_osnivanja, mjesto, ukupni_bodovi FROM klub ORDER BY ukupni_bodovi DESC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $klubovi = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $klubovi = [];
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rukometna Liga - Timovi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <style>
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
                        <a href="timovi.php" class="nav-link text-white bg-dark active">
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
                <h1 class="mb-4"><i class="bi bi-people-fill"></i> Popis Timova</h1>
                
                <?php if (empty($klubovi)): ?>
                    <div class="alert alert-info">Nema podataka o klubovima u bazi.</div>
                <?php else: ?>
                    <div class="row">
                        <?php foreach ($klubovi as $klub): ?>
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-body text-center">
                                        <h5 class="card-title"><?= htmlspecialchars($klub['naziv']) ?></h5>
                                        <p class="card-text">
                                            <i class="bi bi-geo-alt"></i> <?= htmlspecialchars($klub['mjesto']) ?><br>
                                            <i class="bi bi-calendar"></i> <?= date('d.m.Y', strtotime($klub['datum_osnivanja'])) ?><br>
                                            <i class="bi bi-trophy"></i> <?= htmlspecialchars($klub['ukupni_bodovi']) ?> bodova
                                        </p>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#timModal<?= $klub['ID_kluba'] ?>">
                                            <i class="bi bi-info-circle"></i> Detalji
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal za svaki tim -->
                            <div class="modal fade" id="timModal<?= $klub['ID_kluba'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><?= htmlspecialchars($klub['naziv']) ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <i class="bi bi-geo-alt"></i> Mjesto: <?= htmlspecialchars($klub['mjesto']) ?>
                                                </li>
                                                <li class="list-group-item">
                                                    <i class="bi bi-calendar"></i> Datum osnivanja: <?= date('d.m.Y', strtotime($klub['datum_osnivanja'])) ?>
                                                </li>
                                                <li class="list-group-item">
                                                    <i class="bi bi-trophy"></i> Bodovi: <?= htmlspecialchars($klub['ukupni_bodovi']) ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
mysqli_close($conn);
?>