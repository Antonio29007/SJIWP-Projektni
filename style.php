<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,300&display=swap" rel="stylesheet">

<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --c-bg:       #f0f4f8;
    --c-surface:  #ffffff;
    --c-surface2: #f8fafc;
    --c-border:   #d1d9e6;
    --c-border2:  #b8c5d6;
    --c-primary:  #1a56db;
    --c-primary-light: #3b82f6;
    --c-accent:   #e67e22;
    --c-accent2:  #f39c12;
    --c-text:     #000000;
    --c-text-light: #1a1a1a;
    --c-muted:    #333333;
    --c-muted2:   #444444;
    --c-success:  #059669;
    --c-danger:   #dc2626;
    --c-warning:  #d97706;
    --c-info:     #2563eb;
    --nav-w:      260px;
    --r:          14px;
    --shadow-sm:  0 1px 3px 0 rgb(0 0 0 / 0.08);
    --shadow-md:  0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
    --shadow-lg:  0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
  }

  html { scroll-behavior: smooth; }

  body {
    font-family: 'DM Sans', sans-serif;
    background: var(--c-bg);
    color: var(--c-text);
    min-height: 100vh;
    display: flex;
    overflow-x: hidden;
  }

  /* ── SIDEBAR ───────────────────────────────── */
  .nav {
    width: var(--nav-w);
    min-height: 100vh;
    background: linear-gradient(180deg, #ffffff 0%, #fafbfc 100%);
    border-right: 1px solid var(--c-border);
    display: flex;
    flex-direction: column;
    position: fixed;
    top: 0; left: 0; bottom: 0;
    z-index: 200;
    box-shadow: var(--shadow-sm);
  }

  .nav-brand {
    padding: 28px 24px 22px;
    border-bottom: 1px solid var(--c-border);
    text-decoration: none;
    display: block;
    background: linear-gradient(to bottom, #ffffff, #fafbfc);
  }

  .nav-brand-badge {
    display: inline-flex;
    align-items: center;
    gap: 3px;
    background: var(--c-primary);
    color: white;
    font-family: 'Anton', sans-serif;
    font-size: 10px;
    letter-spacing: 2px;
    padding: 4px 10px;
    border-radius: 20px;
    margin-bottom: 10px;
    text-transform: uppercase;
  }

  .nav-brand-name {
    font-family: 'Anton', sans-serif;
    font-size: 22px;
    letter-spacing: 1px;
    color: var(--c-text);
    line-height: 1.1;
    text-transform: uppercase;
  }

  .nav-links {
    flex: 1;
    padding: 20px 16px;
    display: flex;
    flex-direction: column;
    gap: 2px;
  }

  .nav-section-label {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--c-muted);
    padding: 8px 10px 4px;
    margin-top: 8px;
  }

  .nav-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 11px 14px;
    border-radius: 10px;
    text-decoration: none;
    color: var(--c-muted);
    font-size: 14px;
    font-weight: 500;
    transition: all 0.2s;
    position: relative;
  }

  .nav-link::before {
    content: '';
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 3px;
    background: var(--c-primary);
    border-radius: 0 2px 2px 0;
    transform: scaleY(0);
    transition: transform 0.2s;
  }

  .nav-link:hover {
    background: #eef2ff;
    color: #000000;
  }

  .nav-link.active {
    background: #dbeafe;
    color: var(--c-primary);
    font-weight: 600;
  }

  .nav-link.active::before { transform: scaleY(1); }

  .nav-link .nl-icon {
    width: 32px; height: 32px;
    display: flex; align-items: center; justify-content: center;
    background: #e2e8f0;
    border-radius: 8px;
    flex-shrink: 0;
    font-size: 15px;
    transition: background 0.2s;
  }

  .nav-link.active .nl-icon {
    background: #bfdbfe;
  }

  .nav-footer {
    padding: 16px 20px;
    border-top: 1px solid var(--c-border);
    font-size: 11px;
    color: var(--c-muted);
    letter-spacing: 0.5px;
  }

  /* ── USER SECTION ───────────────────────────── */
  .user-section {
    padding: 12px 16px;
    border-bottom: 1px solid var(--c-border);
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .user-avatar {
    width: 36px; height: 36px;
    background: var(--c-primary);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 14px;
  }

  .user-info {
    flex: 1;
  }

  .user-name {
    font-weight: 700;
    font-size: 13px;
    color: #000000;
  }

  .user-role {
    font-size: 10px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: var(--c-muted);
    font-weight: 600;
  }

  .user-logout {
    color: var(--c-muted);
    text-decoration: none;
    padding: 6px;
    border-radius: 6px;
    transition: all 0.15s;
  }

  .user-logout:hover {
    background: #fee2e2;
    color: var(--c-danger);
  }

  /* ── MAIN ───────────────────────────────────── */
  .page {
    margin-left: var(--nav-w);
    flex: 1;
    position: relative;
    z-index: 1;
  }

  .page::before {
    content: '';
    display: block;
    height: 4px;
    background: linear-gradient(90deg, var(--c-primary) 0%, var(--c-accent) 60%, transparent 100%);
  }

  .page-inner {
    padding: 40px 44px;
    max-width: 1400px;
  }

  /* ── PAGE HEADING ───────────────────────────── */
  .pg-head {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 36px;
    flex-wrap: wrap;
  }

  .pg-eyebrow {
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--c-primary);
    margin-bottom: 6px;
  }

  .pg-title {
    font-family: 'Anton', sans-serif;
    font-size: 48px;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: #000000;
    line-height: 1;
  }

  /* ── CARDS ───────────────────────────────────── */
  .card {
    background: var(--c-surface);
    border: 1px solid var(--c-border);
    border-radius: var(--r);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
  }

  .card-head {
    padding: 18px 24px;
    border-bottom: 1px solid var(--c-border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #fafbfc;
  }

  .card-head-title {
    font-family: 'Anton', sans-serif;
    font-size: 14px;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: #000000;
  }

  /* ── STATS ROW ───────────────────────────────── */
  .stats-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
    gap: 16px;
    margin-bottom: 28px;
  }

  .stat-box {
    background: var(--c-surface);
    border: 1px solid var(--c-border);
    border-radius: var(--r);
    padding: 24px;
    position: relative;
    overflow: hidden;
    animation: fadeUp 0.5s ease both;
    box-shadow: var(--shadow-sm);
  }

  .stat-box::after {
    content: attr(data-icon);
    position: absolute;
    right: 20px; top: 50%;
    transform: translateY(-50%);
    font-size: 40px;
    opacity: 0.08;
  }

  .stat-box:nth-child(1) { animation-delay: 0.05s; }
  .stat-box:nth-child(2) { animation-delay: 0.1s; }
  .stat-box:nth-child(3) { animation-delay: 0.15s; }

  .stat-label {
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: #333333;
    margin-bottom: 10px;
  }

  .stat-num {
    font-family: 'Anton', sans-serif;
    font-size: 44px;
    color: var(--c-primary);
    line-height: 1;
  }

  /* ── TABLE ───────────────────────────────────── */
  .tbl { width: 100%; border-collapse: collapse; }

  .tbl thead tr { background: #eef2f6; }

  .tbl th {
    padding: 14px 18px;
    text-align: left;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: #222222;
    white-space: nowrap;
    border-bottom: 1px solid var(--c-border2);
  }

  .tbl td {
    padding: 16px 18px;
    border-bottom: 1px solid var(--c-border);
    vertical-align: middle;
    font-size: 14px;
    color: #1a1a1a;
    font-weight: 500;
  }

  .tbl tbody tr:last-child td { border-bottom: none; }

  .tbl tbody tr { transition: background 0.15s; }
  .tbl tbody tr:hover { background: #f8fafc; }

  /* ── SCORE ───────────────────────────────────── */
  .score {
    display: inline-flex;
    align-items: center;
    background: #f1f5f9;
    border: 1px solid var(--c-border);
    border-radius: 10px;
    overflow: hidden;
    font-family: 'Anton', sans-serif;
    font-size: 18px;
    letter-spacing: 1px;
  }

  .score-h, .score-a {
    padding: 6px 16px;
    min-width: 48px;
    text-align: center;
    background: white;
    font-weight: 700;
    color: #000000;
  }

  .score-sep {
    padding: 6px 6px;
    color: #444444;
    font-size: 14px;
    background: #f1f5f9;
    font-weight: 700;
  }

  .win   { color: var(--c-success); font-weight: 700; }
  .loss  { color: #555555; font-weight: 700; }
  .draw  { color: var(--c-warning); font-weight: 700; }

  /* ── BUTTONS ─────────────────────────────────── */
  .btn {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 10px 20px;
    border-radius: 10px;
    font-family: 'DM Sans', sans-serif;
    font-weight: 600;
    font-size: 13px;
    cursor: pointer;
    border: none;
    text-decoration: none;
    transition: all 0.18s ease;
    white-space: nowrap;
  }

  .btn-primary {
    background: var(--c-primary);
    color: white;
    box-shadow: var(--shadow-sm);
  }
  .btn-primary:hover {
    background: var(--c-primary-light);
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
  }

  .btn-lime {
    background: var(--c-primary);
    color: white;
    box-shadow: var(--shadow-sm);
  }
  .btn-lime:hover {
    background: var(--c-primary-light);
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
  }


  .btn-hero {
  background: rgba(255, 255, 255, 0.15);
  backdrop-filter: blur(8px);
  color: white;
  border: 1px solid rgba(255, 255, 255, 0.3);
  font-weight: 600;
  transition: all 0.2s ease;
}

.btn-hero:hover {
  background: var(--c-accent);
  border-color: var(--c-accent);
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}


  .btn-ghost {
    background: transparent;
    color: #333333;
    border: 1px solid var(--c-border2);
    font-weight: 600;
  }
  .btn-ghost:hover {
    background: var(--c-surface2);
    color: #000000;
    border-color: #666666;
  }

  .btn-danger {
    background: transparent;
    color: var(--c-danger);
    border: 1px solid #fecaca;
  }
  .btn-danger:hover {
    background: #fef2f2;
    border-color: var(--c-danger);
  }

  .btn-sm { padding: 7px 14px; font-size: 12px; border-radius: 8px; }

  .icon-btn {
    width: 36px; height: 36px;
    display: inline-flex; align-items: center; justify-content: center;
    border-radius: 8px;
    border: 1px solid var(--c-border2);
    background: white;
    color: #444444;
    cursor: pointer;
    transition: all 0.15s;
    text-decoration: none;
  }
  .icon-btn:hover { background: var(--c-surface2); color: #000000; border-color: #666666; }
  .icon-btn.edit:hover { color: var(--c-primary); border-color: var(--c-primary); background: #eff6ff; }
  .icon-btn.del:hover  { color: var(--c-danger); border-color: var(--c-danger); background: #fef2f2; }

  /* ── BADGE ───────────────────────────────────── */
  .badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.5px;
    text-transform: uppercase;
  }
  .badge-default  { background: #e2e8f0; color: #333333; }
  .badge-golman   { background: #ede9fe; color: #6d28d9; font-weight: 700; }
  .badge-pivot    { background: #fef3c7; color: #b45309; font-weight: 700; }
  .badge-krilo    { background: #dbeafe; color: #1e40af; font-weight: 700; }
  .badge-vanjski  { background: #d1fae5; color: #065f46; font-weight: 700; }

  /* ── ALERTS ───────────────────────────────────── */
  .alert {
    border-radius: 12px;
    padding: 14px 20px;
    font-size: 14px;
    margin-bottom: 24px;
    border: 1px solid;
    display: flex; align-items: center; gap: 10px;
    animation: fadeUp 0.3s ease;
    font-weight: 500;
  }
  .alert-ok   { background: #ecfdf5; border-color: #a7f3d0; color: #065f46; }
  .alert-err  { background: #fef2f2; border-color: #fecaca; color: #991b1b; }
  .alert-warn { background: #fffbeb; border-color: #fde68a; color: #92400e; }

  /* ── MODAL ───────────────────────────────────── */
  .overlay {
    display: none;
    position: fixed; inset: 0;
    background: rgba(0,0,0,0.3);
    z-index: 500;
    align-items: center; justify-content: center;
    backdrop-filter: blur(4px);
  }
  .overlay.open { display: flex; }

  .modal {
    background: var(--c-surface);
    border: 1px solid var(--c-border);
    border-radius: 20px;
    width: 100%; max-width: 520px;
    max-height: 90vh;
    overflow-y: auto;
    padding: 32px;
    position: relative;
    box-shadow: var(--shadow-lg);
    animation: modalPop 0.22s cubic-bezier(0.34,1.56,0.64,1);
  }
  .modal.modal-lg { max-width: 700px; }

  @keyframes modalPop {
    from { opacity:0; transform: scale(0.93) translateY(12px); }
    to   { opacity:1; transform: none; }
  }

  .modal-title {
    font-family: 'Anton', sans-serif;
    font-size: 22px;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: #000000;
    margin-bottom: 24px;
    padding-right: 30px;
  }

  .modal-close {
    position: absolute; top: 20px; right: 20px;
    width: 32px; height: 32px;
    background: var(--c-surface2);
    border: 1px solid var(--c-border);
    border-radius: 8px;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    color: #444444;
    font-size: 16px;
    transition: all 0.15s;
  }
  .modal-close:hover { background: #fee2e2; color: var(--c-danger); border-color: #fecaca; }

  .modal-footer {
    display: flex; gap: 10px; justify-content: flex-end;
    margin-top: 28px;
    padding-top: 20px;
    border-top: 1px solid var(--c-border);
  }

  /* ── FORMS ───────────────────────────────────── */
  .fg { margin-bottom: 18px; }
  .fg-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
  .fg-row3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; }

  .fg label {
    display: block;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: #222222;
    margin-bottom: 7px;
  }

  .fg input, .fg select, .fg textarea {
    width: 100%;
    background: #fafbfc;
    border: 1px solid var(--c-border2);
    border-radius: 10px;
    color: #000000;
    padding: 11px 14px;
    font-size: 14px;
    font-family: 'DM Sans', sans-serif;
    outline: none;
    transition: all 0.15s;
    font-weight: 500;
  }
  .fg input:focus, .fg select:focus {
    border-color: var(--c-primary);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    background: white;
  }

  /* ── TEAM GRID ───────────────────────────────── */
  .team-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px,1fr)); gap: 20px; }

  .team-card {
    background: var(--c-surface);
    border: 1px solid var(--c-border);
    border-radius: var(--r);
    padding: 24px;
    cursor: pointer;
    transition: all 0.22s ease;
    position: relative;
    overflow: hidden;
    animation: fadeUp 0.4s ease both;
    box-shadow: var(--shadow-sm);
  }

  .team-card::before {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--c-primary), var(--c-accent));
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.25s;
  }

  .team-card:hover {
    border-color: var(--c-border2);
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
  }
  .team-card:hover::before { transform: scaleX(1); }

  .team-logo {
    width: 60px; height: 60px;
    background: var(--c-surface2);
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 16px;
    overflow: hidden;
    border: 1px solid var(--c-border);
  }
  
  .team-logo img {
    width: 100%; height: 100%;
    object-fit: cover;
  }

  .team-card-rank {
    font-family: 'Anton', sans-serif;
    font-size: 12px;
    letter-spacing: 2px;
    color: #333333;
    text-transform: uppercase;
    margin-bottom: 8px;
    font-weight: 600;
  }

  .team-card-name {
    font-family: 'Anton', sans-serif;
    font-size: 22px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    color: #000000;
    margin-bottom: 6px;
    line-height: 1.1;
  }

  .team-card-meta {
    font-size: 13px;
    color: #333333;
    margin-bottom: 18px;
    display: flex; gap: 14px; flex-wrap: wrap;
    font-weight: 500;
  }

  .team-pts {
    font-family: 'Anton', sans-serif;
    font-size: 38px;
    color: var(--c-primary);
    line-height: 1;
  }

  .pts-bar-bg { height: 4px; background: #e2e8f0; border-radius: 2px; margin-top: 10px; }
  .pts-bar    { height: 4px; background: var(--c-primary); border-radius: 2px; }

  /* ── LJESTVICA ───────────────────────────────── */
  .podium { display: grid; grid-template-columns: 1fr 1.1fr 1fr; gap: 12px; margin-bottom: 30px; }

  .podium-card {
    border-radius: var(--r);
    padding: 26px 22px;
    text-align: center;
    position: relative;
    overflow: hidden;
    animation: fadeUp 0.4s ease both;
    box-shadow: var(--shadow-md);
  }

  .podium-card.p1 { background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); border: 1px solid #fbbf24; animation-delay: 0.1s; }
  .podium-card.p2 { background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%); border: 1px solid #94a3b8; animation-delay: 0.05s; }
  .podium-card.p3 { background: linear-gradient(135deg, #fed7aa 0%, #fdba74 100%); border: 1px solid #f97316; animation-delay: 0.15s; }

  .podium-medal { font-size: 34px; margin-bottom: 10px; display: block; }
  .podium-name  { font-family: 'Anton', sans-serif; font-size: 18px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; color: #000000; }
  .podium-pts   { font-family: 'Anton', sans-serif; font-size: 30px; }
  .p1 .podium-pts { color: #b45309; }
  .p2 .podium-pts { color: #475569; }
  .p3 .podium-pts { color: #c2410c; }

  /* ── RESULT FEED ─────────────────────────────── */
  .result-feed-item {
    display: grid;
    grid-template-columns: 72px 1fr auto 1fr 36px;
    align-items: center;
    gap: 12px;
    padding: 16px 22px;
    border-bottom: 1px solid var(--c-border);
    transition: background 0.15s;
    animation: fadeUp 0.4s ease both;
  }
  .result-feed-item:last-child { border-bottom: none; }
  .result-feed-item:hover { background: #f8fafc; }

  .rf-date { font-size: 13px; color: #333333; line-height: 1.4; font-weight: 500; }
  .rf-home { text-align: right; font-weight: 700; font-size: 14px; color: var(--c-primary); }
  .rf-away { text-align: left; font-weight: 700; font-size: 14px; color: #222222; }
  .rf-arrow { text-align: center; color: #444444; font-size: 12px; }

  /* ── HERO BANNER ─────────────────────────────── */
  .hero {
    background: linear-gradient(135deg, #1e3a5f 0%, #0f172a 100%);
    border: 1px solid var(--c-border);
    border-radius: 20px;
    padding: 48px 52px;
    margin-bottom: 30px;
    position: relative;
    overflow: hidden;
    animation: fadeUp 0.5s ease;
    color: white;
  }

  .hero::before {
    content: '';
    position: absolute;
    right: -80px; top: -80px;
    width: 360px; height: 360px;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 65%);
    pointer-events: none;
  }

  .hero::after {
    content: '🤾';
    position: absolute;
    right: 48px; bottom: -10px;
    font-size: 140px;
    opacity: 0.1;
    pointer-events: none;
  }

  .hero-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,0.15);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 100px;
    padding: 5px 14px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: #fbbf24;
    margin-bottom: 18px;
  }

  .hero-eyebrow span { width: 6px; height: 6px; background: #10b981; border-radius: 50%; display: inline-block; animation: pulse 1.5s ease-in-out infinite; }

  @keyframes pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:0.5;transform:scale(0.8)} }

  .hero h1 {
    font-family: 'Anton', sans-serif;
    font-size: 56px;
    text-transform: uppercase;
    letter-spacing: 2px;
    line-height: 1;
    margin-bottom: 14px;
    color: white;
  }

  .hero h1 em { color: #fbbf24; font-style: normal; }
  .hero p { font-size: 16px; color: #e2e8f0; max-width: 480px; line-height: 1.6; margin-bottom: 28px; font-weight: 500; }
  .hero-actions { display: flex; gap: 10px; flex-wrap: wrap; }

  /* ── ANIMATIONS ───────────────────────────────── */
  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: none; }
  }

  /* ── RESPONSIVE ───────────────────────────────── */
  @media (max-width: 900px) {
    :root { --nav-w: 64px; }
    .nav-brand-name, .nav-brand-badge, .nav-link span, .nav-section-label, .nav-footer { display: none; }
    .nav-brand { padding: 18px 16px; text-align: center; }
    .nav-links { padding: 14px 10px; }
    .nav-link { justify-content: center; padding: 12px; }
    .nav-link .nl-icon { margin: 0; }
    .user-section { justify-content: center; padding: 12px 8px; }
    .user-info, .user-role { display: none; }
    .user-logout { margin-left: 0; }
    .page-inner { padding: 22px 18px; }
    .hero { padding: 28px 24px; }
    .hero h1 { font-size: 38px; }
    .podium { grid-template-columns: 1fr; }
  }

  @media (max-width: 600px) {
    .pg-title { font-size: 36px; }
    .fg-row, .fg-row3 { grid-template-columns: 1fr; }
    .result-feed-item { grid-template-columns: 1fr; gap: 6px; text-align: center; }
    .rf-home, .rf-away { text-align: center; }
  }

  /* scrollbar */
  ::-webkit-scrollbar { width: 6px; height: 6px; }
  ::-webkit-scrollbar-track { background: #f1f5f9; }
  ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
  ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
</style>