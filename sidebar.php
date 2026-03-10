<?php
$cur = basename($_SERVER['PHP_SELF']);
function nl($href,$label,$icon,$cur){
    $a = (basename($href)===$cur)?' active':'';
    echo "<a href=\"{$href}\" class=\"nav-link{$a}\"><span class=\"nl-icon\">{$icon}</span><span>{$label}</span></a>\n";
}
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
  <div class="nav-footer">© <?= date('Y') ?> Rukometna Liga</div>
</nav>