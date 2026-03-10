<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300&display=swap" rel="stylesheet">

<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --c-bg:       #08090c;
    --c-surface:  #0f1117;
    --c-surface2: #161a24;
    --c-border:   #1e2333;
    --c-border2:  #252c3f;
    --c-lime:     #c8f135;
    --c-lime2:    #daf75a;
    --c-white:    #f0f2f7;
    --c-muted:    #4a5068;
    --c-muted2:   #6b7494;
    --c-red:      #ff4757;
    --c-blue:     #4a9eff;
    --c-green:    #2ecc71;
    --nav-w:      240px;
    --r:          12px;
  }

  html { scroll-behavior: smooth; }

  body {
    font-family: 'DM Sans', sans-serif;
    background: var(--c-bg);
    color: var(--c-white);
    min-height: 100vh;
    display: flex;
    overflow-x: hidden;
  }

  /* noise texture overlay */
  body::before {
    content: '';
    position: fixed;
    inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
    pointer-events: none;
    z-index: 0;
    opacity: 0.4;
  }

  /* ── SIDEBAR ───────────────────────────────── */
  .nav {
    width: var(--nav-w);
    min-height: 100vh;
    background: var(--c-surface);
    border-right: 1px solid var(--c-border);
    display: flex;
    flex-direction: column;
    position: fixed;
    top: 0; left: 0; bottom: 0;
    z-index: 200;
  }

  .nav-brand {
    padding: 28px 24px 22px;
    border-bottom: 1px solid var(--c-border);
    text-decoration: none;
    display: block;
  }

  .nav-brand-badge {
    display: inline-flex;
    align-items: center;
    gap: 3px;
    background: var(--c-lime);
    color: #0a0b0e;
    font-family: 'Anton', sans-serif;
    font-size: 10px;
    letter-spacing: 2px;
    padding: 3px 8px;
    border-radius: 3px;
    margin-bottom: 10px;
    text-transform: uppercase;
  }

  .nav-brand-name {
    font-family: 'Anton', sans-serif;
    font-size: 22px;
    letter-spacing: 1px;
    color: var(--c-white);
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
    font-weight: 600;
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
    border-radius: 9px;
    text-decoration: none;
    color: var(--c-muted2);
    font-size: 14px;
    font-weight: 500;
    transition: all 0.2s;
    position: relative;
    overflow: hidden;
  }

  .nav-link::before {
    content: '';
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 3px;
    background: var(--c-lime);
    border-radius: 0 2px 2px 0;
    transform: scaleY(0);
    transition: transform 0.2s;
  }

  .nav-link:hover {
    background: var(--c-surface2);
    color: var(--c-white);
  }

  .nav-link.active {
    background: rgba(200, 241, 53, 0.08);
    color: var(--c-lime);
    font-weight: 600;
  }

  .nav-link.active::before { transform: scaleY(1); }

  .nav-link .nl-icon {
    width: 32px; height: 32px;
    display: flex; align-items: center; justify-content: center;
    background: var(--c-surface2);
    border-radius: 7px;
    flex-shrink: 0;
    font-size: 15px;
    transition: background 0.2s;
  }

  .nav-link.active .nl-icon {
    background: rgba(200, 241, 53, 0.15);
  }

  .nav-footer {
    padding: 16px 20px;
    border-top: 1px solid var(--c-border);
    font-size: 11px;
    color: var(--c-muted);
    letter-spacing: 0.5px;
  }

  /* ── MAIN ───────────────────────────────────── */
  .page {
    margin-left: var(--nav-w);
    flex: 1;
    position: relative;
    z-index: 1;
  }

  /* top accent line */
  .page::before {
    content: '';
    display: block;
    height: 3px;
    background: linear-gradient(90deg, var(--c-lime) 0%, transparent 60%);
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
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--c-lime);
    margin-bottom: 6px;
  }

  .pg-title {
    font-family: 'Anton', sans-serif;
    font-size: 52px;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: var(--c-white);
    line-height: 1;
  }

  /* ── CARDS ───────────────────────────────────── */
  .card {
    background: var(--c-surface);
    border: 1px solid var(--c-border);
    border-radius: var(--r);
    overflow: hidden;
  }

  .card-head {
    padding: 18px 22px;
    border-bottom: 1px solid var(--c-border);
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .card-head-title {
    font-family: 'Anton', sans-serif;
    font-size: 13px;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--c-white);
  }

  /* ── STATS ROW ───────────────────────────────── */
  .stats-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
    gap: 14px;
    margin-bottom: 28px;
  }

  .stat-box {
    background: var(--c-surface);
    border: 1px solid var(--c-border);
    border-radius: var(--r);
    padding: 22px 24px;
    position: relative;
    overflow: hidden;
    animation: fadeUp 0.5s ease both;
  }

  .stat-box::after {
    content: attr(data-icon);
    position: absolute;
    right: 16px; top: 50%;
    transform: translateY(-50%);
    font-size: 36px;
    opacity: 0.06;
  }

  .stat-box:nth-child(1) { animation-delay: 0.05s; }
  .stat-box:nth-child(2) { animation-delay: 0.1s; }
  .stat-box:nth-child(3) { animation-delay: 0.15s; }

  .stat-label {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--c-muted2);
    margin-bottom: 10px;
  }

  .stat-num {
    font-family: 'Anton', sans-serif;
    font-size: 44px;
    color: var(--c-lime);
    line-height: 1;
  }

  /* ── TABLE ───────────────────────────────────── */
  .tbl { width: 100%; border-collapse: collapse; }

  .tbl thead tr { background: var(--c-surface2); }

  .tbl th {
    padding: 13px 18px;
    text-align: left;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--c-muted);
    white-space: nowrap;
    border-bottom: 1px solid var(--c-border2);
  }

  .tbl td {
    padding: 15px 18px;
    border-bottom: 1px solid var(--c-border);
    vertical-align: middle;
    font-size: 14px;
  }

  .tbl tbody tr:last-child td { border-bottom: none; }

  .tbl tbody tr {
    transition: background 0.15s;
  }
  .tbl tbody tr:hover { background: rgba(255,255,255,0.022); }

  /* ── SCORE ───────────────────────────────────── */
  .score {
    display: inline-flex;
    align-items: center;
    background: var(--c-surface2);
    border: 1px solid var(--c-border2);
    border-radius: 8px;
    overflow: hidden;
    font-family: 'Anton', sans-serif;
    font-size: 20px;
    letter-spacing: 1px;
  }

  .score-h, .score-a {
    padding: 5px 14px;
    min-width: 44px;
    text-align: center;
  }

  .score-sep {
    padding: 5px 4px;
    color: var(--c-muted);
    font-size: 14px;
    border-left: 1px solid var(--c-border2);
    border-right: 1px solid var(--c-border2);
  }

  .win   { color: var(--c-lime); }
  .loss  { color: var(--c-muted); }
  .draw  { color: #fbbf24; }

  /* ── BUTTONS ─────────────────────────────────── */
  .btn {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 10px 20px;
    border-radius: 9px;
    font-family: 'DM Sans', sans-serif;
    font-weight: 600;
    font-size: 13px;
    letter-spacing: 0.3px;
    cursor: pointer;
    border: none;
    text-decoration: none;
    transition: all 0.18s ease;
    white-space: nowrap;
  }

  .btn-lime {
    background: var(--c-lime);
    color: #08090c;
  }
  .btn-lime:hover {
    background: var(--c-lime2);
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(200,241,53,0.25);
    color: #08090c;
  }

  .btn-ghost {
    background: transparent;
    color: var(--c-muted2);
    border: 1px solid var(--c-border2);
  }
  .btn-ghost:hover {
    background: var(--c-surface2);
    color: var(--c-white);
    border-color: var(--c-muted);
  }

  .btn-danger {
    background: transparent;
    color: var(--c-red);
    border: 1px solid rgba(255,71,87,0.4);
  }
  .btn-danger:hover {
    background: rgba(255,71,87,0.12);
    border-color: var(--c-red);
  }

  .btn-sm { padding: 7px 14px; font-size: 12px; border-radius: 7px; }

  .icon-btn {
    width: 34px; height: 34px;
    display: inline-flex; align-items: center; justify-content: center;
    border-radius: 8px;
    border: 1px solid var(--c-border2);
    background: var(--c-surface2);
    color: var(--c-muted2);
    cursor: pointer;
    transition: all 0.15s;
    text-decoration: none;
  }
  .icon-btn:hover { background: var(--c-surface); color: var(--c-white); border-color: var(--c-muted); }
  .icon-btn.edit:hover { color: var(--c-lime); border-color: var(--c-lime); background: rgba(200,241,53,0.08); }
  .icon-btn.del:hover  { color: var(--c-red);  border-color: var(--c-red);  background: rgba(255,71,87,0.08);  }

  /* ── BADGE ───────────────────────────────────── */
  .badge {
    display: inline-block;
    padding: 3px 9px;
    border-radius: 5px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.8px;
    text-transform: uppercase;
  }
  .badge-default  { background: var(--c-surface2); border: 1px solid var(--c-border2); color: var(--c-muted2); }
  .badge-golman   { background: rgba(138,101,255,0.12); border:1px solid rgba(138,101,255,0.3); color: #a78bfa; }
  .badge-pivot    { background: rgba(200,241,53,0.1);   border:1px solid rgba(200,241,53,0.25); color: var(--c-lime); }
  .badge-krilo    { background: rgba(74,158,255,0.1);   border:1px solid rgba(74,158,255,0.25); color: var(--c-blue); }
  .badge-vanjski  { background: rgba(46,204,113,0.1);   border:1px solid rgba(46,204,113,0.25); color: var(--c-green); }

  /* ── ALERTS ───────────────────────────────────── */
  .alert {
    border-radius: 9px;
    padding: 13px 18px;
    font-size: 14px;
    margin-bottom: 22px;
    border: 1px solid;
    display: flex; align-items: center; gap: 10px;
    animation: fadeUp 0.3s ease;
  }
  .alert-ok   { background: rgba(46,204,113,0.08); border-color: rgba(46,204,113,0.3); color: var(--c-green); }
  .alert-err  { background: rgba(255,71,87,0.08);  border-color: rgba(255,71,87,0.3);  color: var(--c-red); }
  .alert-warn { background: rgba(251,191,36,0.08); border-color: rgba(251,191,36,0.3); color: #fbbf24; }

  /* ── MODAL ───────────────────────────────────── */
  .overlay {
    display: none;
    position: fixed; inset: 0;
    background: rgba(0,0,0,0.75);
    z-index: 500;
    align-items: center; justify-content: center;
    backdrop-filter: blur(6px);
  }
  .overlay.open { display: flex; }

  .modal {
    background: var(--c-surface);
    border: 1px solid var(--c-border2);
    border-radius: 16px;
    width: 100%; max-width: 520px;
    max-height: 90vh;
    overflow-y: auto;
    padding: 32px;
    position: relative;
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
    color: var(--c-white);
    margin-bottom: 24px;
    padding-right: 30px;
  }

  .modal-close {
    position: absolute; top: 18px; right: 18px;
    width: 32px; height: 32px;
    background: var(--c-surface2);
    border: 1px solid var(--c-border2);
    border-radius: 8px;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    color: var(--c-muted2);
    font-size: 16px;
    transition: all 0.15s;
  }
  .modal-close:hover { color: var(--c-white); border-color: var(--c-muted); }

  .modal-footer {
    display: flex; gap: 10px; justify-content: flex-end;
    margin-top: 26px;
    padding-top: 20px;
    border-top: 1px solid var(--c-border);
  }

  /* ── FORMS ───────────────────────────────────── */
  .fg { margin-bottom: 16px; }
  .fg-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
  .fg-row3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 14px; }

  .fg label {
    display: block;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: var(--c-muted2);
    margin-bottom: 7px;
  }

  .fg input, .fg select, .fg textarea {
    width: 100%;
    background: var(--c-surface2);
    border: 1px solid var(--c-border2);
    border-radius: 9px;
    color: var(--c-white);
    padding: 10px 14px;
    font-size: 14px;
    font-family: 'DM Sans', sans-serif;
    outline: none;
    transition: border-color 0.15s, box-shadow 0.15s;
    -webkit-appearance: none;
  }
  .fg input:focus, .fg select:focus {
    border-color: var(--c-lime);
    box-shadow: 0 0 0 3px rgba(200,241,53,0.1);
  }
  .fg select option { background: var(--c-surface2); }

  /* ── TEAM GRID ───────────────────────────────── */
  .team-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px,1fr)); gap: 16px; }

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
  }

  .team-card::before {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 2px;
    background: linear-gradient(90deg, var(--c-lime), transparent);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.25s;
  }

  .team-card:hover {
    border-color: rgba(200,241,53,0.3);
    transform: translateY(-4px);
    box-shadow: 0 16px 40px rgba(0,0,0,0.4);
  }
  .team-card:hover::before { transform: scaleX(1); }

  .team-card-rank {
    font-family: 'Anton', sans-serif;
    font-size: 11px;
    letter-spacing: 2px;
    color: var(--c-muted);
    text-transform: uppercase;
    margin-bottom: 8px;
  }

  .team-card-name {
    font-family: 'Anton', sans-serif;
    font-size: 21px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    color: var(--c-white);
    margin-bottom: 6px;
    line-height: 1.1;
  }

  .team-card-meta {
    font-size: 13px;
    color: var(--c-muted2);
    margin-bottom: 18px;
    display: flex; gap: 14px; flex-wrap: wrap;
  }

  .team-pts {
    font-family: 'Anton', sans-serif;
    font-size: 38px;
    color: var(--c-lime);
    line-height: 1;
  }

  .pts-bar-bg { height: 3px; background: var(--c-border2); border-radius: 2px; margin-top: 10px; }
  .pts-bar    { height: 3px; background: var(--c-lime); border-radius: 2px; }

  /* ── LJESTVICA ───────────────────────────────── */
  .podium { display: grid; grid-template-columns: 1fr 1.1fr 1fr; gap: 12px; margin-bottom: 30px; }

  .podium-card {
    border-radius: var(--r);
    padding: 26px 22px;
    text-align: center;
    position: relative;
    overflow: hidden;
    animation: fadeUp 0.4s ease both;
  }

  .podium-card.p1 { background: linear-gradient(135deg, #1a1600 0%, #211c00 100%); border: 1px solid #fbbf2440; animation-delay: 0.1s; }
  .podium-card.p2 { background: linear-gradient(135deg, #111318 0%, #161a22 100%); border: 1px solid #94a3b840; animation-delay: 0.05s; }
  .podium-card.p3 { background: linear-gradient(135deg, #130e08 0%, #1a1209 100%); border: 1px solid #cd7f3240; animation-delay: 0.15s; }

  .podium-medal { font-size: 34px; margin-bottom: 10px; display: block; }
  .podium-name  { font-family: 'Anton', sans-serif; font-size: 18px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
  .podium-pts   { font-family: 'Anton', sans-serif; font-size: 30px; }
  .p1 .podium-pts { color: #fbbf24; }
  .p2 .podium-pts { color: #94a3b8; }
  .p3 .podium-pts { color: #cd7f32; }

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
  .result-feed-item:hover { background: rgba(255,255,255,0.02); }

  .rf-date { font-size: 12px; color: var(--c-muted2); line-height: 1.4; }
  .rf-home { text-align: right; font-weight: 600; font-size: 14px; color: var(--c-blue); }
  .rf-away { text-align: left; font-weight: 600; font-size: 14px; color: var(--c-muted2); }
  .rf-arrow { text-align: center; color: var(--c-muted); font-size: 12px; }

  /* ── HERO BANNER ─────────────────────────────── */
  .hero {
    background: var(--c-surface);
    border: 1px solid var(--c-border);
    border-radius: 16px;
    padding: 48px 52px;
    margin-bottom: 30px;
    position: relative;
    overflow: hidden;
    animation: fadeUp 0.5s ease;
  }

  .hero::before {
    content: '';
    position: absolute;
    right: -80px; top: -80px;
    width: 360px; height: 360px;
    background: radial-gradient(circle, rgba(200,241,53,0.07) 0%, transparent 65%);
    pointer-events: none;
  }

  .hero::after {
    content: '🤾';
    position: absolute;
    right: 48px; bottom: -10px;
    font-size: 140px;
    opacity: 0.06;
    pointer-events: none;
  }

  .hero-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(200,241,53,0.1);
    border: 1px solid rgba(200,241,53,0.2);
    border-radius: 100px;
    padding: 5px 14px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--c-lime);
    margin-bottom: 18px;
  }

  .hero-eyebrow span { width: 6px; height: 6px; background: var(--c-lime); border-radius: 50%; display: inline-block; animation: pulse 1.5s ease-in-out infinite; }

  @keyframes pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:0.5;transform:scale(0.8)} }

  .hero h1 {
    font-family: 'Anton', sans-serif;
    font-size: 64px;
    text-transform: uppercase;
    letter-spacing: 2px;
    line-height: 1;
    margin-bottom: 14px;
    color: var(--c-white);
  }

  .hero h1 em { color: var(--c-lime); font-style: normal; }
  .hero p { font-size: 16px; color: var(--c-muted2); max-width: 480px; line-height: 1.6; margin-bottom: 28px; }
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
  ::-webkit-scrollbar { width: 5px; height: 5px; }
  ::-webkit-scrollbar-track { background: var(--c-bg); }
  ::-webkit-scrollbar-thumb { background: var(--c-border2); border-radius: 3px; }
  ::-webkit-scrollbar-thumb:hover { background: var(--c-muted); }
</style>