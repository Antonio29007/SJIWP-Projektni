<?php
<<<<<<< HEAD
include("auth.php");
=======
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
$cur = basename($_SERVER['PHP_SELF']);
function nl($href,$label,$icon,$cur){
    $a = (basename($href)===$cur)?' active':'';
    echo "<a href=\"{$href}\" class=\"nav-link{$a}\"><span class=\"nl-icon\">{$icon}</span><span>{$label}</span></a>\n";
}
<<<<<<< HEAD

$user = getCurrentUser();
$isAdmin = isAdmin();
?>
<nav class="nav">
  <a href="pocetna.php" class="nav-brand" style="text-decoration:none">
    <div class="nav-brand-badge">🏆 Liga</div>
    <div class="nav-brand-name">Rukometna<br>Liga</div>
  </a>
  
  <!-- Korisnički info -->
  <div class="user-section">
    <div class="user-avatar">
      <?= strtoupper(substr($user['ime'] ?: $user['korisnicko_ime'], 0, 1)) ?>
    </div>
    <div class="user-info">
      <div class="user-name"><?= htmlspecialchars($user['ime'] ? $user['ime'].' '.$user['prezime'] : $user['korisnicko_ime']) ?></div>
      <div class="user-role">
        <?= $isAdmin ? '👑 Administrator' : '👤 Korisnik' ?>
      </div>
    </div>
    <a href="logout.php" class="user-logout" title="Odjava">
      <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
    </a>
  </div>
  
 <div class="nav-links">
    <div class="nav-section-label">Pregled</div>
    <?php nl('pocetna.php','Početna','🏠',$cur); ?>
    <?php nl('ljestvica.php','Ljestvica','📊',$cur); ?>
    
    <?php if($isAdmin): ?>
        <div class="nav-section-label">Upravljanje</div>
        <?php nl('utakmice.php','Utakmice','🗓️',$cur); ?>
        <?php nl('timovi.php','Klubovi','🛡️',$cur); ?>
        <?php nl('igraci.php','Igrači','👤',$cur); ?>
    <?php else: ?>
        <div class="nav-section-label">Informacije</div>
        <?php nl('utakmice.php','Utakmice','🗓️',$cur); ?>
        <?php nl('timovi.php','Klubovi','🛡️',$cur); ?>
        <?php nl('igraci.php','Igrači','👤',$cur); ?>
    <?php endif; ?>
</div>
=======
?>
<nav class="nav">
  <a href="index.php" class="nav-brand" style="text-decoration:none">
    <div class="nav-brand-badge">🏆 Liga</div>
    <div class="nav-brand-name">Rukometna<br>Liga</div>
  </a>
  <div class="nav-links">
    <div class="nav-section-label">Pregled</div>
    <?php nl('index.php','Početna','🏠',$cur); ?>
    <?php nl('ljestvica.php','Ljestvica','📊',$cur); ?>
    <div class="nav-section-label">Upravljanje</div>
    <?php nl('utakmice.php','Utakmice','🗓️',$cur); ?>
    <?php nl('timovi.php','Timovi','🛡️',$cur); ?>
    <?php nl('igraci.php','Igrači','👤',$cur); ?>
  </div>
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
  <div class="nav-footer">© <?= date('Y') ?> Rukometna Liga</div>
</nav>