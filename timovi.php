<?php
include("db_connection.php");
$klubovi = mysqli_fetch_all(mysqli_query($conn,
    "SELECT ID_kluba,naziv,datum_osnivanja,mjesto,ukupni_bodovi FROM klub ORDER BY ukupni_bodovi DESC"),
    MYSQLI_ASSOC);
$max_b = !empty($klubovi) ? max(array_column($klubovi,'ukupni_bodovi')) : 1;
?>
<!DOCTYPE html>
<html lang="hr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Rukometna Liga — Timovi</title>
<?php include("style.php"); ?>
</head>
<body>
<?php include("sidebar.php"); ?>
<div class="page">
<div class="page-inner">

  <div class="pg-head">
    <div>
      <div class="pg-eyebrow"><?=count($klubovi)?> klubova u ligi</div>
      <h1 class="pg-title">Timovi</h1>
    </div>
  </div>

  <?php if(empty($klubovi)): ?>
    <div style="text-align:center;padding:60px;color:var(--c-muted2)">Nema klubova</div>
  <?php else: ?>
  <div class="team-grid">
    <?php foreach($klubovi as $i=>$k): ?>
    <div class="team-card" style="animation-delay:<?=$i*50?>ms" onclick="document.getElementById('tm-<?=$k['ID_kluba']?>').classList.add('open')">
      <div class="team-card-rank">#<?=$i+1?> <?=$i===0?'· 🏆 Lider':''?></div>
      <div class="team-card-name"><?=htmlspecialchars($k['naziv'])?></div>
      <div class="team-card-meta">
        <span>📍 <?=htmlspecialchars($k['mjesto'])?></span>
        <span>📅 od <?=date('Y.',strtotime($k['datum_osnivanja']))?></span>
      </div>
      <div style="display:flex;align-items:baseline;gap:8px">
        <div class="team-pts"><?=$k['ukupni_bodovi']?></div>
        <div style="font-size:13px;color:var(--c-muted2);font-weight:500">bod.</div>
      </div>
      <div class="pts-bar-bg">
        <div class="pts-bar" style="width:<?=round(($k['ukupni_bodovi']/max($max_b,1))*100)?>%"></div>
      </div>
    </div>

    <!-- Modal -->
    <div class="overlay" id="tm-<?=$k['ID_kluba']?>" onclick="if(event.target===this)this.classList.remove('open')">
      <div class="modal" style="max-width:400px">
        <div class="modal-title"><?=htmlspecialchars($k['naziv'])?></div>
        <button class="modal-close" onclick="document.getElementById('tm-<?=$k['ID_kluba']?>').classList.remove('open')">✕</button>
        <div style="display:grid;gap:10px">
          <div style="background:var(--c-surface2);border:1px solid var(--c-border2);border-radius:9px;padding:14px 16px">
            <div style="font-size:10px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--c-muted2);margin-bottom:5px">Grad</div>
            <div style="font-weight:600"><?=htmlspecialchars($k['mjesto'])?></div>
          </div>
          <div style="background:var(--c-surface2);border:1px solid var(--c-border2);border-radius:9px;padding:14px 16px">
            <div style="font-size:10px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--c-muted2);margin-bottom:5px">Osnovano</div>
            <div style="font-weight:600"><?=date('d.m.Y.',strtotime($k['datum_osnivanja']))?></div>
          </div>
          <div style="background:rgba(200,241,53,0.07);border:1px solid rgba(200,241,53,0.2);border-radius:9px;padding:18px 16px;text-align:center">
            <div style="font-size:10px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--c-muted2);margin-bottom:8px">Ukupni bodovi</div>
            <div style="font-family:'Anton',sans-serif;font-size:46px;color:var(--c-lime);line-height:1"><?=$k['ukupni_bodovi']?></div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-ghost" onclick="document.getElementById('tm-<?=$k['ID_kluba']?>').classList.remove('open')">Zatvori</button>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>

</div>
</div>
</body>
</html>
<?php mysqli_close($conn); ?>