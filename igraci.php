<?php
include("db_connection.php");
include("auth.php");
requireLogin();
$isAdmin = isAdmin();

$result = mysqli_query($conn,
    "SELECT i.ID_igraca, i.ime, i.prezime, i.datum_rodenja, i.pozicija,
<<<<<<< HEAD
     k.naziv AS klub_naziv, k.ID_kluba, k.logo AS klub_logo
=======
     k.naziv AS klub_naziv, k.ID_kluba
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
     FROM igraci i JOIN klub k ON i.klub_ID=k.ID_kluba
     ORDER BY k.naziv, i.prezime");

$igraci=[];
while($r=mysqli_fetch_assoc($result)) $igraci[$r['klub_naziv']][]=$r;

<<<<<<< HEAD
$kl_opts = mysqli_query($conn,"SELECT ID_kluba, naziv FROM klub");
=======
$kl_opts = mysqli_query($conn,"SELECT ID_kluba,naziv FROM klub");
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0

function pb($p){
    $p=trim($p); $l=strtolower($p);
    if($l==='golman') return "badge-golman";
    if($l==='pivot')  return "badge-pivot";
    if(str_contains($l,'krilo')) return "badge-krilo";
    if(str_contains($l,'vanjski')) return "badge-vanjski";
    return "badge-default";
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Rukometna Liga — Igrači</title>
<?php include("style.php"); ?>
<<<<<<< HEAD
<style>
  .club-header {
    display: flex;
    align-items: center;
    gap: 12px;
  }
  .club-logo-small {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    object-fit: contain;
    background: white;
    padding: 3px;
  }
</style>
=======
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
</head>
<body>
<?php include("sidebar.php"); ?>
<div class="page">
<div class="page-inner">

  <div class="pg-head">
    <div>
<<<<<<< HEAD
      <h1 class="pg-title">Igrači</h1>
    </div>
    <?php if($isAdmin): ?>
    <button class="btn btn-primary" onclick="document.getElementById('mo-dodaj').classList.add('open')">
      <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
      Dodaj igrača
    </button>
    <?php endif; ?>
=======
      <div class="pg-eyebrow">Registrirani igrači</div>
      <h1 class="pg-title">Igrači</h1>
    </div>
    <button class="btn btn-lime" onclick="document.getElementById('mo-dodaj').classList.add('open')">
      <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
      Dodaj igrača
    </button>
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
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

  <?php if(empty($igraci)): ?>
<<<<<<< HEAD
    <div style="text-align:center;padding:60px;color:var(--c-muted)">Nema igrača u bazi</div>
  <?php else: ?>
    <?php $di=0; foreach($igraci as $kn=>$players): 
      $klub_logo = $players[0]['klub_logo'] ?? null;
    ?>
    <div class="card" style="margin-bottom:18px;animation:fadeUp .4s <?=$di*80?>ms ease both">
      <div class="card-head">
        <div class="club-header">
          <?php if(!empty($klub_logo)): ?>
            <img src="<?=htmlspecialchars($klub_logo)?>" alt="<?=htmlspecialchars($kn)?>" class="club-logo-small">
          <?php else: ?>
            <span style="font-size:24px;">🛡️</span>
          <?php endif; ?>
          <span class="card-head-title"><?=htmlspecialchars($kn)?></span>
        </div>
        <span style="font-size:12px;color:var(--c-muted);font-weight:500"><?=count($players)?> igrača</span>
=======
    <div style="text-align:center;padding:60px;color:var(--c-muted2)">Nema igrača u bazi</div>
  <?php else: ?>
    <?php $di=0; foreach($igraci as $kn=>$players): ?>
    <div class="card" style="margin-bottom:18px;animation:fadeUp .4s <?=$di*80?>ms ease both">
      <div class="card-head">
        <div style="display:flex;align-items:center;gap:12px">
          <span style="font-size:20px">🛡️</span>
          <span class="card-head-title"><?=htmlspecialchars($kn)?></span>
        </div>
        <span style="font-size:12px;color:var(--c-muted2);font-weight:500"><?=count($players)?> igrača</span>
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
      </div>
      <div style="overflow-x:auto">
        <table class="tbl">
          <thead>
            <tr>
              <th>Ime i prezime</th>
              <th>Datum rođenja</th>
              <th>Pozicija</th>
<<<<<<< HEAD
              <?php if($isAdmin): ?><th style="text-align:right">Akcije</th><?php endif; ?>
=======
              <th style="text-align:right">Akcije</th>
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
            </tr>
          </thead>
          <tbody>
          <?php foreach($players as $ig): ?>
            <tr>
              <td>
                <div style="font-weight:600;font-size:14px">
                  <?=htmlspecialchars(trim($ig['ime']).' '.trim($ig['prezime']))?>
                </div>
              </td>
<<<<<<< HEAD
              <td style="color:var(--c-muted);font-size:13px">
=======
              <td style="color:var(--c-muted2);font-size:13px">
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
                <?=date('d.m.Y.',strtotime($ig['datum_rodenja']))?>
              </td>
              <td>
                <span class="badge <?=pb($ig['pozicija'])?>"><?=htmlspecialchars(trim($ig['pozicija']))?></span>
              </td>
<<<<<<< HEAD
             <?php if($isAdmin): ?>
<td style="text-align:right">
    <a href="obrisi_igrac.php?id=<?=$ig['ID_igraca']?>" class="icon-btn del" title="Obriši igrača"
       onclick="return confirm('Obrisati igrača? Ova radnja je nepovratna.')">
        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <polyline points="3 6 5 6 21 6"/>
            <path d="M19 6l-1 14H6L5 6"/>
            <path d="M9 6V4h6v2"/>
        </svg>
    </a>
</td>
<?php endif; ?>
=======
              <td style="text-align:right">
                <div style="display:flex;gap:6px;justify-content:flex-end">
                  <a href="edit_igrac.php?id=<?=$ig['ID_igraca']?>" class="icon-btn edit" title="Uredi">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                  </a>
                  <a href="obrisi_igrac.php?id=<?=$ig['ID_igraca']?>" class="icon-btn del" title="Obriši"
                     onclick="return confirm('Obrisati igrača?')">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M9 6V4h6v2"/></svg>
                  </a>
                </div>
              </td>
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
    <?php $di++; endforeach; ?>
  <?php endif; ?>

</div>
<<<<<<< HEAD
</div>

<?php if($isAdmin): ?>
<!-- MODAL: Dodaj igrača -->
<div class="overlay" id="mo-dodaj" onclick="if(event.target===this)this.classList.remove('open')">
  <div class="modal">
    <div class="modal-title">Novi igrač</div>
    <button class="modal-close" onclick="document.getElementById('mo-dodaj').classList.remove('open')">✕</button>
    <form action="dohvati_igraca.php" method="POST">
      <div class="fg-row">
        <div class="fg"><label>Ime</label><input type="text" name="ime" required></div>
        <div class="fg"><label>Prezime</label><input type="text" name="prezime" required></div>
      </div>
      <div class="fg"><label>Datum rođenja</label><input type="date" name="datum_rodenja" required></div>
      <div class="fg">
        <label>Pozicija</label>
        <select name="pozicija" required>
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
      <div class="fg">
        <label>Klub</label>
        <select name="klub_ID" required>
          <option value="">Odaberi klub</option>
          <?php while($k=mysqli_fetch_assoc($kl_opts)): ?>
            <option value="<?=$k['ID_kluba']?>"><?=htmlspecialchars($k['naziv'])?></option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-ghost" onclick="document.getElementById('mo-dodaj').classList.remove('open')">Odustani</button>
        <button type="submit" name="dodaj_igraca" class="btn btn-primary">Spremi igrača</button>
      </div>
    </form>
  </div>
</div>

<!-- MODAL: Uredi igrača -->
<div class="overlay" id="mo-uredi" onclick="if(event.target===this)this.classList.remove('open')">
  <div class="modal">
    <div class="modal-title">Uredi igrača</div>
    <button class="modal-close" onclick="document.getElementById('mo-uredi').classList.remove('open')">✕</button>
    <form action="edit_igrac.php" method="POST">
      <input type="hidden" name="ID_igraca" id="e_id">
      <div class="fg-row">
        <div class="fg"><label>Ime</label><input type="text" name="ime" id="e_ime" required></div>
        <div class="fg"><label>Prezime</label><input type="text" name="prezime" id="e_prz" required></div>
      </div>
      <div class="fg"><label>Datum rođenja</label><input type="date" name="datum_rodenja" id="e_dat" required></div>
      <div class="fg">
        <label>Pozicija</label>
        <select name="pozicija" id="e_poz" required>
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
      <div class="fg">
        <label>Klub</label>
        <select name="klub_ID" id="e_kl" required>
          <option value="">Odaberi klub</option>
          <?php mysqli_data_seek($kl_opts,0); while($k=mysqli_fetch_assoc($kl_opts)): ?>
            <option value="<?=$k['ID_kluba']?>"><?=htmlspecialchars($k['naziv'])?></option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-ghost" onclick="document.getElementById('mo-uredi').classList.remove('open')">Odustani</button>
        <button type="submit" name="azuriraj_igraca" class="btn btn-primary">Spremi promjene</button>
      </div>
    </form>
  </div>
</div>
<?php endif; ?>

<script>
<?php if($isAdmin): ?>
=======
</div>

<!-- MODAL: Dodaj igrača -->
<div class="overlay" id="mo-dodaj" onclick="if(event.target===this)this.classList.remove('open')">
  <div class="modal">
    <div class="modal-title">Novi igrač</div>
    <button class="modal-close" onclick="document.getElementById('mo-dodaj').classList.remove('open')">✕</button>
    <form action="dohvati_igraca.php" method="POST">
      <div class="fg-row">
        <div class="fg"><label>Ime</label><input type="text" name="ime" required></div>
        <div class="fg"><label>Prezime</label><input type="text" name="prezime" required></div>
      </div>
      <div class="fg"><label>Datum rođenja</label><input type="date" name="datum_rodenja" required></div>
      <div class="fg">
        <label>Pozicija</label>
        <select name="pozicija" required>
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
      <div class="fg">
        <label>Klub</label>
        <select name="klub_ID" required>
          <option value="">Odaberi klub</option>
          <?php while($k=mysqli_fetch_assoc($kl_opts)): ?>
            <option value="<?=$k['ID_kluba']?>"><?=htmlspecialchars($k['naziv'])?></option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-ghost" onclick="document.getElementById('mo-dodaj').classList.remove('open')">Odustani</button>
        <button type="submit" name="dodaj_igraca" class="btn btn-lime">Spremi igrača</button>
      </div>
    </form>
  </div>
</div>

<!-- MODAL: Uredi igrača -->
<div class="overlay" id="mo-uredi" onclick="if(event.target===this)this.classList.remove('open')">
  <div class="modal">
    <div class="modal-title">Uredi igrača</div>
    <button class="modal-close" onclick="document.getElementById('mo-uredi').classList.remove('open')">✕</button>
    <form action="edit_igrac.php" method="POST">
      <input type="hidden" name="ID_igraca" id="e_id">
      <div class="fg-row">
        <div class="fg"><label>Ime</label><input type="text" name="ime" id="e_ime" required></div>
        <div class="fg"><label>Prezime</label><input type="text" name="prezime" id="e_prz" required></div>
      </div>
      <div class="fg"><label>Datum rođenja</label><input type="date" name="datum_rodenja" id="e_dat" required></div>
      <div class="fg">
        <label>Pozicija</label>
        <select name="pozicija" id="e_poz" required>
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
      <div class="fg">
        <label>Klub</label>
        <select name="klub_ID" id="e_kl" required>
          <option value="">Odaberi klub</option>
          <?php mysqli_data_seek($kl_opts,0); while($k=mysqli_fetch_assoc($kl_opts)): ?>
            <option value="<?=$k['ID_kluba']?>"><?=htmlspecialchars($k['naziv'])?></option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-ghost" onclick="document.getElementById('mo-uredi').classList.remove('open')">Odustani</button>
        <button type="submit" name="azuriraj_igraca" class="btn btn-lime">Spremi promjene</button>
      </div>
    </form>
  </div>
</div>

<script>
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
document.querySelectorAll('a[href^="edit_igrac.php"]').forEach(a=>{
  a.addEventListener('click',function(e){
    e.preventDefault();
    const id=new URL(this.href).searchParams.get('id');
    fetch(`dohvati_igraca.php?id=${id}`).then(r=>r.json()).then(d=>{
      document.getElementById('e_id').value=d.ID_igraca;
      document.getElementById('e_ime').value=d.ime;
      document.getElementById('e_prz').value=d.prezime;
      document.getElementById('e_dat').value=d.datum_rodenja;
      document.getElementById('e_poz').value=d.pozicija;
      document.getElementById('e_kl').value=d.klub_ID;
      document.getElementById('mo-uredi').classList.add('open');
    });
  });
});
<?php endif; ?>
</script>
</body>
</html>
<?php mysqli_close($conn); ?>