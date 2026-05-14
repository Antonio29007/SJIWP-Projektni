<?php
include("db_connection.php");
include("auth.php");
requireLogin();
$isAdmin = isAdmin();

$utakmice = mysqli_fetch_all(mysqli_query($conn,
    "SELECT u.ID_utakmice, u.datum_i_vrijeme_utakmice,
     k1.naziv AS domaci_klub, k1.logo AS domaci_logo,
     k2.naziv AS gosti_klub, k2.logo AS gosti_logo,
     u.domaci_golovi, u.gosti_golovi
     FROM utakmica u
     JOIN klub k1 ON u.klub_ID_domaci=k1.ID_kluba
     JOIN klub k2 ON u.klub_ID_gosti=k2.ID_kluba
     ORDER BY u.datum_i_vrijeme_utakmice DESC LIMIT 6"), MYSQLI_ASSOC);

$n_klubova  = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) c FROM klub"))['c'];
$n_igraca   = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) c FROM igraci"))['c'];
$n_utakmica = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) c FROM utakmica"))['c'];

$lider = mysqli_fetch_assoc(mysqli_query($conn,"SELECT naziv, ukupni_bodovi, logo FROM klub ORDER BY ukupni_bodovi DESC LIMIT 1"));
$user = getCurrentUser();
?>
<!DOCTYPE html>
<html lang="hr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Rukometna Liga — Početna</title>
<?php include("style.php"); ?>
<style>
  .team-with-logo-small {
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .team-logo-tiny {
    width: 24px;
    height: 24px;
    border-radius: 6px;
    object-fit: contain;
    background: #f8fafc;
    padding: 2px;
  }
  .result-team {
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .result-team-right {
    display: flex;
    align-items: center;
    gap: 8px;
    justify-content: flex-end;
  }
</style>
</head>
<body>
<?php include("sidebar.php"); ?>

<div class="page">
<div class="page-inner">

  <!-- HERO -->
 <!-- HERO -->
<div class="hero">
  
  <h1>Dobrodošli,<br><em><?= htmlspecialchars($user['ime'] ?: $user['korisnicko_ime']) ?></em>!</h1>
  <p>Pratite rezultate, statistike igrača i ljestvicu naše rukometne lige na jednom mjestu.</p>
  <div class="hero-actions">
    <a href="utakmice.php" class="btn btn-primary">
      <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
        <rect x="3" y="4" width="18" height="18" rx="2"/>
        <line x1="3" y1="10" x2="21" y2="10"/>
      </svg>
      Sve utakmice
    </a>
    <a href="ljestvica.php" class="btn btn-hero">
      <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <line x1="18" y1="20" x2="18" y2="10"/>
        <line x1="12" y1="20" x2="12" y2="4"/>
        <line x1="6" y1="20" x2="6" y2="14"/>
      </svg>
      Ljestvica
    </a>
  </div>
</div>

  <!-- STATS -->
  <div class="stats-row">
    <div class="stat-box" data-icon="🛡️">
      <div class="stat-label">Klubovi</div>
      <div class="stat-num"><?= $n_klubova ?></div>
    </div>
    <div class="stat-box" data-icon="👤">
      <div class="stat-label">Igrači</div>
      <div class="stat-num"><?= $n_igraca ?></div>
    </div>
    <div class="stat-box" data-icon="🗓️">
      <div class="stat-label">Utakmice</div>
      <div class="stat-num"><?= $n_utakmica ?></div>
    </div>
    <?php if($lider): ?>
    <div class="stat-box" data-icon="🏆" style="border-color:var(--c-primary-light)">
      <div class="stat-label">Vodeći klub</div>
      <div style="display:flex;align-items:center;gap:8px;margin-top:4px;">
        <?php if(!empty($lider['logo'])): ?>
          <img src="<?=htmlspecialchars($lider['logo'])?>" alt="<?=htmlspecialchars($lider['naziv'])?>" style="width:36px;height:36px;border-radius:8px;object-fit:contain;background:white;padding:3px;">
        <?php else: ?>
          <span style="font-size:30px;">🛡️</span>
        <?php endif; ?>
        <div>
          <div style="font-family:'Anton',sans-serif;font-size:20px;color:var(--c-primary);text-transform:uppercase;line-height:1.2;">
            <?= htmlspecialchars($lider['naziv']) ?>
          </div>
          <div style="font-size:13px;color:var(--c-muted);"><?= $lider['ukupni_bodovi'] ?> bodova</div>
        </div>
      </div>
    </div>
    <?php endif; ?>
  </div>

  <!-- LATEST RESULTS -->
  <div class="card" style="animation:fadeUp .5s .2s ease both">
    <div class="card-head">
      <span class="card-head-title">Posljednji rezultati</span>
      <a href="utakmice.php" class="btn btn-ghost btn-sm">Sve utakmice →</a>
    </div>
    <?php if(empty($utakmice)): ?>
      <div style="padding:48px;text-align:center;color:var(--c-muted)">Nema podataka</div>
    <?php else: ?>
      <?php foreach($utakmice as $i=>$u):
        $dg=$u['domaci_golovi']; $gg=$u['gosti_golovi'];
        $hc = $dg>$gg?'win':($dg<$gg?'loss':'draw');
        $ac = $gg>$dg?'win':($gg<$dg?'loss':'draw');
      ?>
      <div class="result-feed-item" style="animation-delay:<?=$i*60?>ms">
        <div class="rf-date"><?=date('d.m.Y',$t=strtotime($u['datum_i_vrijeme_utakmice']))?><br><?=date('H:i',$t)?></div>
        <div class="rf-home">
          <div class="result-team-right">
            <span><?=htmlspecialchars($u['domaci_klub'])?></span>
            <?php if(!empty($u['domaci_logo'])): ?>
              <img src="<?=htmlspecialchars($u['domaci_logo'])?>" alt="<?=htmlspecialchars($u['domaci_klub'])?>" class="team-logo-tiny">
            <?php else: ?>
              <span style="font-size:18px;">🛡️</span>
            <?php endif; ?>
          </div>
        </div>
        <div>
          <div class="score">
            <span class="score-h <?=$hc?>"><?=$dg?></span>
            <span class="score-sep">:</span>
            <span class="score-a <?=$ac?>"><?=$gg?></span>
          </div>
        </div>
        <div class="rf-away">
          <div class="result-team">
            <?php if(!empty($u['gosti_logo'])): ?>
              <img src="<?=htmlspecialchars($u['gosti_logo'])?>" alt="<?=htmlspecialchars($u['gosti_klub'])?>" class="team-logo-tiny">
            <?php else: ?>
              <span style="font-size:18px;">🛡️</span>
            <?php endif; ?>
            <span><?=htmlspecialchars($u['gosti_klub'])?></span>
          </div>
        </div>
        <div class="rf-arrow">
          <?php if($isAdmin): ?>
          <a href="edit_utakmica.php?id=<?=$u['ID_utakmice']?>" class="icon-btn edit" title="Uredi">
            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
          </a>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

</div>
</div>
</body>
</html>
<?php mysqli_close($conn); ?>   