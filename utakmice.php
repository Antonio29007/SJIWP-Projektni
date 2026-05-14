<?php
include("db_connection.php");
include("auth.php");
requireLogin();
$isAdmin = isAdmin();

$utakmice = mysqli_fetch_all(mysqli_query($conn,
    "SELECT u.ID_utakmice, u.datum_i_vrijeme_utakmice,
     d.naziv AS dvorana, CONCAT(s.ime,' ',s.prezime) AS sudac,
     k1.naziv AS domaci, k1.logo AS domaci_logo,
     k2.naziv AS gosti, k2.logo AS gosti_logo,
     u.domaci_golovi, u.gosti_golovi
     FROM utakmica u
     JOIN dvorana d ON u.dvorana_ID=d.ID_dvorane
     JOIN sudci s ON u.sudac_ID=s.ID_sudca
     JOIN klub k1 ON u.klub_ID_domaci=k1.ID_kluba
     JOIN klub k2 ON u.klub_ID_gosti=k2.ID_kluba
     ORDER BY u.datum_i_vrijeme_utakmice DESC"), MYSQLI_ASSOC);

$klubovi = mysqli_query($conn,"SELECT ID_kluba, naziv, logo FROM klub");
$dvorane = mysqli_query($conn,"SELECT ID_dvorane, naziv FROM dvorana");
$sudci   = mysqli_query($conn,"SELECT ID_sudca, CONCAT(ime,' ',prezime) AS puno_ime FROM sudci");
?>
<!DOCTYPE html>
<html lang="hr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Rukometna Liga — Utakmice</title>
<?php include("style.php"); ?>
<style>
  .team-with-logo {
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .team-with-logo-right {
    display: flex;
    align-items: center;
    gap: 8px;
    justify-content: flex-end;
  }
  .team-logo-small {
    width: 28px;
    height: 28px;
    border-radius: 6px;
    object-fit: contain;
    background: #f8fafc;
    padding: 2px;
  }
</style>
</head>
<body>
<?php include("sidebar.php"); ?>
<div class="page">
<div class="page-inner">

  <div class="pg-head">
    <div>
   
      <h1 class="pg-title">Utakmice</h1>
    </div>
    <?php if($isAdmin): ?>
    <button class="btn btn-primary" onclick="document.getElementById('mo-dodaj').classList.add('open')">
      <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
      Nova utakmica
    </button>
    <?php endif; ?>
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

  <div class="card" style="animation:fadeUp .4s ease">
    <div style="overflow-x:auto">
      <table class="tbl">
        <thead>
          <tr>
            <th>Datum</th>
            <th>Domaći</th>
            <th style="text-align:center">Rezultat</th>
            <th>Gosti</th>
            <th>Dvorana</th>
            <th>Sudac</th>
            <?php if($isAdmin): ?><th style="text-align:right"></th><?php endif; ?>
          </tr>
        </thead>
        <tbody>
        <?php if(empty($utakmice)): ?>
          <tr><td colspan="<?= $isAdmin ? '7' : '6' ?>" style="text-align:center;padding:50px;color:var(--c-muted)">Nema utakmica</td></tr>
        <?php else: ?>
          <?php foreach($utakmice as $u):
            $dg=$u['domaci_golovi']; $gg=$u['gosti_golovi'];
            $hc=$dg>$gg?'win':($dg<$gg?'loss':'draw');
            $ac=$gg>$dg?'win':($gg<$dg?'loss':'draw');
          ?>
          <tr>
            <td>
              <div style="font-size:13px;font-weight:500;color:var(--c-text)"><?=date('d.m.Y.',strtotime($u['datum_i_vrijeme_utakmice']))?></div>
              <div style="font-size:11px;color:var(--c-muted)"><?=date('H:i',strtotime($u['datum_i_vrijeme_utakmice']))?></div>
            </td>
            <td>
              <div class="team-with-logo-right">
                <span style="font-weight:600;color:var(--c-primary)"><?=htmlspecialchars($u['domaci'])?></span>
                <?php if(!empty($u['domaci_logo'])): ?>
                  <img src="<?=htmlspecialchars($u['domaci_logo'])?>" alt="<?=htmlspecialchars($u['domaci'])?>" class="team-logo-small">
                <?php else: ?>
                  <span style="font-size:20px;">🛡️</span>
                <?php endif; ?>
              </div>
            </td>
            <td style="text-align:center">
              <div class="score">
                <span class="score-h <?=$hc?>"><?=$dg?></span>
                <span class="score-sep">:</span>
                <span class="score-a <?=$ac?>"><?=$gg?></span>
              </div>
            </td>
            <td>
              <div class="team-with-logo">
                <?php if(!empty($u['gosti_logo'])): ?>
                  <img src="<?=htmlspecialchars($u['gosti_logo'])?>" alt="<?=htmlspecialchars($u['gosti'])?>" class="team-logo-small">
                <?php else: ?>
                  <span style="font-size:20px;">🛡️</span>
                <?php endif; ?>
                <span style="font-weight:500;color:var(--c-text-light)"><?=htmlspecialchars($u['gosti'])?></span>
              </div>
            </td>
            <td style="font-size:13px;color:var(--c-muted)"><?=htmlspecialchars($u['dvorana'])?></td>
            <td style="font-size:13px;color:var(--c-muted)"><?=htmlspecialchars($u['sudac'])?></td>
            <?php if($isAdmin): ?>
            <td style="text-align:right">
              <a href="edit_utakmica.php?id=<?=$u['ID_utakmice']?>" class="icon-btn edit" title="Uredi">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
              </a>
            </td>
            <?php endif; ?>
          </tr>
          <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>
</div>

<?php if($isAdmin): ?>
<!-- MODAL: Nova utakmica -->
<div class="overlay" id="mo-dodaj" onclick="if(event.target===this)this.classList.remove('open')">
  <div class="modal modal-lg">
    <div class="modal-title">Nova utakmica</div>
    <button class="modal-close" onclick="document.getElementById('mo-dodaj').classList.remove('open')">✕</button>
    <form action="dohvati_utakmicu.php" method="POST" id="fUtakmica">
      <div class="fg-row">
        <div class="fg">
          <label>Domaći klub</label>
          <select name="domaci_klub" required>
            <option value="">Odaberi klub</option>
            <?php mysqli_data_seek($klubovi, 0); while($k=mysqli_fetch_assoc($klubovi)): ?>
              <option value="<?=htmlspecialchars($k['naziv'])?>"><?=htmlspecialchars($k['naziv'])?></option>
            <?php endwhile; ?>
          </select>
        </div>
        <div class="fg">
          <label>Gostujući klub</label>
          <select name="gosti_klub" required>
            <option value="">Odaberi klub</option>
            <?php mysqli_data_seek($klubovi, 0); while($k=mysqli_fetch_assoc($klubovi)): ?>
              <option value="<?=htmlspecialchars($k['naziv'])?>"><?=htmlspecialchars($k['naziv'])?></option>
            <?php endwhile; ?>
          </select>
        </div>
      </div>
      <div class="fg-row">
        <div class="fg">
          <label>Datum i vrijeme</label>
          <input type="datetime-local" name="datum_i_vrijeme_utakmice" required>
        </div>
        <div class="fg">
          <label>Dvorana</label>
          <select name="dvorana_naziv" required>
            <option value="">Odaberi dvoranu</option>
            <?php while($d=mysqli_fetch_assoc($dvorane)): ?>
              <option value="<?=htmlspecialchars($d['naziv'])?>"><?=htmlspecialchars($d['naziv'])?></option>
            <?php endwhile; ?>
          </select>
        </div>
      </div>
      <div class="fg-row3">
        <div class="fg">
          <label>Sudac</label>
          <select name="sudac" required>
            <option value="">Odaberi</option>
            <?php while($s=mysqli_fetch_assoc($sudci)): ?>
              <option value="<?=htmlspecialchars($s['puno_ime'])?>"><?=htmlspecialchars($s['puno_ime'])?></option>
            <?php endwhile; ?>
          </select>
        </div>
        <div class="fg">
          <label>Golovi domaći</label>
          <input type="number" name="domaci_golovi" min="0" required>
        </div>
        <div class="fg">
          <label>Golovi gosti</label>
          <input type="number" name="gosti_golovi" min="0" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-ghost" onclick="document.getElementById('mo-dodaj').classList.remove('open')">Odustani</button>
        <button type="submit" class="btn btn-primary">Spremi utakmicu</button>
      </div>
    </form>
  </div>
</div>
<?php endif; ?>

<script>
document.getElementById('fUtakmica')?.addEventListener('submit',function(e){
  const s=this.querySelectorAll('select[name="domaci_klub"],select[name="gosti_klub"]');
  if(s[0].value&&s[0].value===s[1].value){e.preventDefault();alert('Klubovi ne mogu biti isti!');}
});
</script>
</body>
</html>
<?php mysqli_close($conn); ?>