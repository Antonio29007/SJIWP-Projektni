<?php
include("db_connection.php");
include("auth.php");
requireLogin();
$isAdmin = isAdmin();

$klubovi = mysqli_fetch_all(mysqli_query($conn,
    "SELECT ID_kluba, naziv, ukupni_bodovi, logo FROM klub ORDER BY ukupni_bodovi DESC"), MYSQLI_ASSOC);
$max_b = !empty($klubovi) ? $klubovi[0]['ukupni_bodovi'] : 1;
?>
<!DOCTYPE html>
<html lang="hr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Rukometna Liga — Ljestvica</title>
<?php include("style.php"); ?>
<style>
  .team-with-logo-small {
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .team-logo-tiny {
    width: 28px;
    height: 28px;
    border-radius: 6px;
    object-fit: contain;
    background: #f8fafc;
    padding: 2px;
  }
  .podium-logo {
    width: 60px;
    height: 60px;
    margin: 0 auto 12px;
    border-radius: 12px;
    object-fit: contain;
    background: white;
    padding: 5px;
  }
</style>
</head>
<body>
<?php include("sidebar.php"); ?>
<div class="page">
<div class="page-inner">

  <div class="pg-head">
    <div>
      <h1 class="pg-title">Ljestvica</h1>
    </div>
  </div>

  <?php if(isset($_SESSION['success'])): ?>
    <div class="alert alert-ok">✓ <?=htmlspecialchars($_SESSION['success'])?></div>
    <?php unset($_SESSION['success']); ?>
  <?php endif; ?>
  <?php if(isset($_SESSION['errors'])): ?>
    <div class="alert alert-err">
      <?php foreach($_SESSION['errors'] as $e): ?><?=htmlspecialchars($e)?><br><?php endforeach; ?>
    </div>
    <?php unset($_SESSION['errors']); ?>
  <?php endif; ?>

  <?php if(!empty($klubovi)): ?>

  <!-- TOP 3 PODIUM -->
  <?php if(count($klubovi)>=3): ?>
  <div class="podium" style="animation:fadeUp .4s ease">
    <!-- 2. mjesto -->
    <div class="podium-card p2">
      <?php if(!empty($klubovi[1]['logo'])): ?>
        <img src="<?=htmlspecialchars($klubovi[1]['logo'])?>" alt="<?=htmlspecialchars($klubovi[1]['naziv'])?>" class="podium-logo">
      <?php else: ?>
        <span style="font-size:50px;display:block;margin-bottom:12px;">🛡️</span>
      <?php endif; ?>
      <span class="podium-medal">🥈</span>
      <div class="podium-name"><?=htmlspecialchars($klubovi[1]['naziv'])?></div>
      <div class="podium-pts"><?=$klubovi[1]['ukupni_bodovi']?> <span style="font-size:14px;color:var(--c-muted2)">bod.</span></div>
    </div>
    
    <!-- 1. mjesto -->
    <div class="podium-card p1" style="transform:translateY(-12px)">
      <?php if(!empty($klubovi[0]['logo'])): ?>
        <img src="<?=htmlspecialchars($klubovi[0]['logo'])?>" alt="<?=htmlspecialchars($klubovi[0]['naziv'])?>" class="podium-logo">
      <?php else: ?>
        <span style="font-size:50px;display:block;margin-bottom:12px;">🛡️</span>
      <?php endif; ?>
      <span class="podium-medal">🥇</span>
      <div class="podium-name"><?=htmlspecialchars($klubovi[0]['naziv'])?></div>
      <div class="podium-pts"><?=$klubovi[0]['ukupni_bodovi']?> <span style="font-size:14px;color:var(--c-muted2)">bod.</span></div>
    </div>
    
    <!-- 3. mjesto -->
    <div class="podium-card p3">
      <?php if(!empty($klubovi[2]['logo'])): ?>
        <img src="<?=htmlspecialchars($klubovi[2]['logo'])?>" alt="<?=htmlspecialchars($klubovi[2]['naziv'])?>" class="podium-logo">
      <?php else: ?>
        <span style="font-size:50px;display:block;margin-bottom:12px;">🛡️</span>
      <?php endif; ?>
      <span class="podium-medal">🥉</span>
      <div class="podium-name"><?=htmlspecialchars($klubovi[2]['naziv'])?></div>
      <div class="podium-pts"><?=$klubovi[2]['ukupni_bodovi']?> <span style="font-size:14px;color:var(--c-muted2)">bod.</span></div>
    </div>
  </div>
  <?php endif; ?>

  <!-- FULL TABLE -->
  <div class="card" style="animation:fadeUp .4s .15s ease both">
    <div class="card-head">
      <span class="card-head-title">Poredak svih klubova</span>
    </div>
    <div style="overflow-x:auto">
      <table class="tbl">
        <thead>
          <tr>
            <th style="width:54px">Pos.</th>
            <th>Klub</th>
            <th>Bodovi</th>
            <th style="width:200px">Omjer</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($klubovi as $pos=>$k): ?>
          <tr>
            <td>
              <?php if($pos===0): ?>
                <span style="font-family:'Anton',sans-serif;font-size:20px;color:#fbbf24">1</span>
              <?php elseif($pos===1): ?>
                <span style="font-family:'Anton',sans-serif;font-size:18px;color:#94a3b8">2</span>
              <?php elseif($pos===2): ?>
                <span style="font-family:'Anton',sans-serif;font-size:18px;color:#cd7f32">3</span>
              <?php else: ?>
                <span style="font-family:'Anton',sans-serif;font-size:16px;color:var(--c-muted)"><?=$pos+1?></span>
              <?php endif; ?>
            </td>
            <td>
              <div class="team-with-logo-small">
                <?php if(!empty($k['logo'])): ?>
                  <img src="<?=htmlspecialchars($k['logo'])?>" alt="<?=htmlspecialchars($k['naziv'])?>" class="team-logo-tiny">
                <?php else: ?>
                  <span style="font-size:20px;">🛡️</span>
                <?php endif; ?>
                <span style="font-weight:600;font-size:14px"><?=htmlspecialchars($k['naziv'])?></span>
                <?php if($pos===0): ?><span style="margin-left:8px;font-size:11px">🏆</span><?php endif; ?>
              </div>
            </td>
            <td>
              <span style="display:inline-block;background:rgba(37,99,235,0.1);border:1px solid rgba(37,99,235,0.2);
                color:var(--c-primary);font-family:'Anton',sans-serif;font-size:16px;
                padding:3px 14px;border-radius:100px">
                <?=$k['ukupni_bodovi']?>
              </span>
            </td>
            <td>
              <div style="height:5px;background:var(--c-border2);border-radius:3px;overflow:hidden">
                <div style="height:5px;background:<?=$pos===0?'var(--c-primary)':($pos===1?'#94a3b8':($pos===2?'#cd7f32':'var(--c-muted)'))?>; 
                  border-radius:3px;width:<?=round(($k['ukupni_bodovi']/max($max_b,1))*100)?>%"></div>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <?php else: ?>
    <div style="text-align:center;padding:60px;color:var(--c-muted2)">Nema podataka o klubovima</div>
  <?php endif; ?>

</div>
</div>
</body>
</html>
<?php mysqli_close($conn); ?>