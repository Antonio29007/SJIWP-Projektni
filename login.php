<?php
include("db_connection.php");
session_start();

if (isset($_SESSION['korisnik_id'])) {
    header("Location: pocetna.php");
    exit();
}

$error = '';
$success = '';

// Registracija
if (isset($_POST['register'])) {
    $username = trim($_POST['reg_username'] ?? '');
    $password = $_POST['reg_password'] ?? '';
    $password_confirm = $_POST['reg_password_confirm'] ?? '';
    $ime = trim($_POST['reg_ime'] ?? '');
    $prezime = trim($_POST['reg_prezime'] ?? '');
    
    $errors = [];
    
    if (empty($username)) $errors[] = "Korisničko ime je obavezno.";
    if (strlen($username) < 3) $errors[] = "Korisničko ime mora imati najmanje 3 znaka.";
    if (empty($password)) $errors[] = "Lozinka je obavezna.";
    if (strlen($password) < 6) $errors[] = "Lozinka mora imati najmanje 6 znakova.";
    if ($password !== $password_confirm) $errors[] = "Lozinke se ne podudaraju.";
    if (empty($ime)) $errors[] = "Ime je obavezno.";
    if (empty($prezime)) $errors[] = "Prezime je obavezno.";
    
    if (empty($errors)) {
        $check = $conn->prepare("SELECT ID_korisnika FROM korisnici WHERE korisnicko_ime = ?");
        $check->bind_param("s", $username);
        $check->execute();
        if ($check->get_result()->num_rows > 0) {
            $errors[] = "Korisničko ime već postoji.";
        }
        $check->close();
    }
    
    if (empty($errors)) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO korisnici (korisnicko_ime, lozinka, ime, prezime, uloga) VALUES (?, ?, ?, ?, 'korisnik')");
        $stmt->bind_param("ssss", $username, $hashed, $ime, $prezime);
        
        if ($stmt->execute()) {
            // Automatska prijava nakon registracije
            $_SESSION['korisnik_id'] = $stmt->insert_id;
            $_SESSION['korisnicko_ime'] = $username;
            $_SESSION['ime'] = $ime;
            $_SESSION['prezime'] = $prezime;
            $_SESSION['uloga'] = 'korisnik';
            
            header("Location: pocetna.php");
            exit();
        } else {
            $error = "Greška pri registraciji: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $error = implode("<br>", $errors);
    }
}

// Prijava
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        $error = "Unesite korisničko ime i lozinku.";
    } else {
        $stmt = $conn->prepare("SELECT ID_korisnika, korisnicko_ime, lozinka, ime, prezime, uloga FROM korisnici WHERE korisnicko_ime = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['lozinka'])) {
                $_SESSION['korisnik_id'] = $user['ID_korisnika'];
                $_SESSION['korisnicko_ime'] = $user['korisnicko_ime'];
                $_SESSION['ime'] = $user['ime'];
                $_SESSION['prezime'] = $user['prezime'];
                $_SESSION['uloga'] = $user['uloga'];
                
                header("Location: pocetna.php");
                exit();
            } else {
                $error = "Neispravno korisničko ime ili lozinka.";
            }
        } else {
            $error = "Neispravno korisničko ime ili lozinka.";
        }
        $stmt->close();
    }
}

$showRegister = isset($_GET['register']) || isset($_POST['register']);
?>
<!DOCTYPE html>
<html lang="hr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Rukometna Liga — Prijava</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }
  
  :root {
    --c-bg: #f5f7fa;
    --c-surface: #ffffff;
    --c-border: #e2e8f0;
    --c-primary: #2563eb;
    --c-primary-light: #3b82f6;
    --c-text: #1e293b;
    --c-muted: #64748b;
    --c-accent: #f59e0b;
    --c-success: #10b981;
    --c-danger: #ef4444;
    --r: 16px;
  }
  
  body {
    font-family: 'DM Sans', sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--c-text);
    padding: 20px;
  }
  
  .auth-container {
    width: 100%;
    max-width: 880px;
    display: flex;
    gap: 0;
    background: var(--c-surface);
    border-radius: 28px;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    overflow: hidden;
  }
  
  .auth-info {
    flex: 1;
    background: linear-gradient(135deg, #1e3a5f 0%, #0f172a 100%);
    padding: 48px 36px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    color: white;
  }
  
  .auth-info-badge {
    display: inline-block;
    background: var(--c-accent);
    color: white;
    font-family: 'Anton', sans-serif;
    font-size: 11px;
    letter-spacing: 2px;
    padding: 4px 12px;
    border-radius: 20px;
    margin-bottom: 20px;
    align-self: flex-start;
  }
  
  .auth-info h2 {
    font-family: 'Anton', sans-serif;
    font-size: 32px;
    line-height: 1.2;
    margin-bottom: 20px;
    color: white;
  }
  
  .auth-info h2 span {
    color: var(--c-accent);
  }
  
  .auth-info p {
    opacity: 0.8;
    line-height: 1.6;
    margin-bottom: 28px;
    font-size: 14px;
  }
  
  .auth-login-note {
    background: rgba(255, 255, 255, 0.1);
    border-left: 3px solid var(--c-accent);
    padding: 16px;
    border-radius: 12px;
    margin-top: 20px;
  }
  
  .auth-login-note p {
    margin-bottom: 0;
    font-size: 13px;
    opacity: 0.9;
  }
  
  .auth-login-note strong {
    color: var(--c-accent);
  }
  
  .auth-form {
    flex: 1;
    padding: 48px 36px;
    background: white;
  }
  
  .auth-tabs {
    display: flex;
    gap: 24px;
    margin-bottom: 28px;
    border-bottom: 2px solid var(--c-border);
    padding-bottom: 12px;
  }
  
  .auth-tab {
    font-weight: 600;
    font-size: 16px;
    color: var(--c-muted);
    cursor: pointer;
    padding-bottom: 12px;
    margin-bottom: -14px;
    border-bottom: 2px solid transparent;
    transition: all 0.2s;
  }
  
  .auth-tab.active {
    color: var(--c-primary);
    border-bottom-color: var(--c-primary);
  }
  
  .auth-tab:hover { color: var(--c-primary); }
  
  .form-panel { display: none; }
  .form-panel.active { display: block; }
  
  .form-group { margin-bottom: 18px; }
  
  .form-group label {
    display: block;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: var(--c-muted);
    margin-bottom: 6px;
  }
  
  .form-group input {
    width: 100%;
    padding: 12px 14px;
    border: 1.5px solid var(--c-border);
    border-radius: 10px;
    font-size: 14px;
    font-family: 'DM Sans', sans-serif;
    transition: all 0.2s;
    background: #fafbfc;
  }
  
  .form-group input:focus {
    outline: none;
    border-color: var(--c-primary);
    background: white;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
  }
  
  .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
  }
  
  .btn-submit {
    width: 100%;
    padding: 14px;
    background: var(--c-primary);
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    font-family: 'DM Sans', sans-serif;
    margin-top: 8px;
  }
  
  .btn-submit:hover {
    background: var(--c-primary-light);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
  }
  
  .error-message {
    background: #fef2f2;
    color: #991b1b;
    padding: 12px 14px;
    border-radius: 10px;
    font-size: 13px;
    margin-bottom: 18px;
    border: 1px solid #fecaca;
  }
  
  @media (max-width: 700px) {
    .auth-container { flex-direction: column; max-width: 420px; }
    .auth-info { padding: 32px 28px; text-align: center; }
    .auth-info-badge { align-self: center; }
    .auth-form { padding: 32px 28px; }
  }
</style>
</head>
<body>
<div class="auth-container">
  <div class="auth-info">
    <span class="auth-info-badge">🏆 Rukometna Liga</span>
    <h2>Pristup ligi<br><span>samo za prijavljene</span></h2>
    <p>Za praćenje rezultata, statistike igrača i ljestvice potrebno je imati korisnički račun.</p>
    <div class="auth-login-note">
      <p>🔐 <strong>Pristup sustavu</strong><br>
      Registrirajte se kao novi korisnik ili se prijavite s postojećim računom.</p>
    </div>
  </div>
  
  <div class="auth-form">
    <div class="auth-tabs">
      <span class="auth-tab <?= !$showRegister ? 'active' : '' ?>" onclick="switchTab('login')">Prijava</span>
      <span class="auth-tab <?= $showRegister ? 'active' : '' ?>" onclick="switchTab('register')">Registracija</span>
    </div>
    
    <?php if ($error): ?>
      <div class="error-message">⚠ <?= $error ?></div>
    <?php endif; ?>
    
    <!-- LOGIN PANEL -->
    <div class="form-panel <?= !$showRegister ? 'active' : '' ?>" id="login-panel">
      <form method="POST">
        <input type="hidden" name="login" value="1">
        <div class="form-group">
          <label>Korisničko ime</label>
          <input type="text" name="username" placeholder="" required autofocus>
        </div>
        <div class="form-group">
          <label>Lozinka</label>
          <input type="password" name="password" placeholder="" required>
        </div>
        <button type="submit" class="btn-submit">Prijavi se</button>
      </form>
    </div>
    
    <!-- REGISTER PANEL -->
    <div class="form-panel <?= $showRegister ? 'active' : '' ?>" id="register-panel">
      <form method="POST">
        <input type="hidden" name="register" value="1">
        <div class="form-row">
          <div class="form-group">
            <label>Ime</label>
            <input type="text" name="reg_ime" placeholder="" required>
          </div>
          <div class="form-group">
            <label>Prezime</label>
            <input type="text" name="reg_prezime" placeholder="" required>
          </div>
        </div>
        <div class="form-group">
          <label>Korisničko ime</label>
          <input type="text" name="reg_username" placeholder="" required>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Lozinka</label>
            <input type="password" name="reg_password" placeholder="" required>
          </div>
          <div class="form-group">
            <label>Potvrdi lozinku</label>
            <input type="password" name="reg_password_confirm" placeholder="" required>
          </div>
        </div>
        <button type="submit" class="btn-submit">Registriraj se</button>
      </form>
    </div>
  </div>
</div>

<script>
function switchTab(tab) {
  document.querySelectorAll('.auth-tab').forEach(t => t.classList.remove('active'));
  document.querySelectorAll('.form-panel').forEach(p => p.classList.remove('active'));
  
  if (tab === 'login') {
    document.querySelector('.auth-tab:first-child').classList.add('active');
    document.getElementById('login-panel').classList.add('active');
  } else {
    document.querySelector('.auth-tab:last-child').classList.add('active');
    document.getElementById('register-panel').classList.add('active');
  }
}
</script>
</body>
</html>