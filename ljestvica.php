<?php
include("db_connection.php");
session_start();

// SQL query to get clubs with total points
$sql = "SELECT naziv, ukupni_bodovi FROM klub ORDER BY ukupni_bodovi DESC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $klubovi = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $klubovi[] = $row;
    }
} else {
    $klubovi = [];
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rukometna Liga - Ljestvica</title>
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
                        <a href="igraci.php" class="nav-link text-white">
                            <i class="bi bi-person-badge me-2"></i>
                            Igrači
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="ljestvica.php" class="nav-link text-white bg-dark active">
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

                <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
                    <h1><i class="bi bi-list-ol"></i> Ljestvica Klubova</h1>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Mjesto</th>
                                        <th>Tim</th>
                                        <th>Bodovi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($klubovi)): ?>
                                        <?php $position = 1; ?>
                                        <?php foreach ($klubovi as $klub): ?>
                                            <tr>
                                                <th scope="row"><?= $position++ ?></th>
                                                <td><?= htmlspecialchars($klub['naziv']) ?></td>
                                                <td><?= htmlspecialchars($klub['ukupni_bodovi']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3" class="text-center">Nema podataka o klubovima</td>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
mysqli_close($conn);
?>