<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<<<<<<< HEAD
<link href="https://fonts.googleapis.com/css2?family=Anton&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,300&display=swap" rel="stylesheet">
=======
<link href="https://fonts.googleapis.com/css2?family=Anton&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300&display=swap" rel="stylesheet">
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0

<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
<<<<<<< HEAD
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
=======
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
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
  }

  html { scroll-behavior: smooth; }

  body {
    font-family: 'DM Sans', sans-serif;
    background: var(--c-bg);
<<<<<<< HEAD
    color: var(--c-text);
=======
    color: var(--c-white);
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
    min-height: 100vh;
    display: flex;
    overflow-x: hidden;
  }

<<<<<<< HEAD
=======
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

>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
  /* ── SIDEBAR ───────────────────────────────── */
  .nav {
    width: var(--nav-w);
    min-height: 100vh;
<<<<<<< HEAD
    background: linear-gradient(180deg, #ffffff 0%, #fafbfc 100%);
=======
    background: var(--c-surface);
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
    border-right: 1px solid var(--c-border);
    display: flex;
    flex-direction: column;
    position: fixed;
    top: 0; left: 0; bottom: 0;
    z-index: 200;
<<<<<<< HEAD
    box-shadow: var(--shadow-sm);
=======
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
  }

  .nav-brand {
    padding: 28px 24px 22px;
    border-bottom: 1px solid var(--c-border);
    text-decoration: none;
    display: block;
<<<<<<< HEAD
    background: linear-gradient(to bottom, #ffffff, #fafbfc);
=======
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
  }

  .nav-brand-badge {
    display: inline-flex;
    align-items: center;
    gap: 3px;
<<<<<<< HEAD
    background: var(--c-primary);
    color: white;
    font-family: 'Anton', sans-serif;
    font-size: 10px;
    letter-spacing: 2px;
    padding: 4px 10px;
    border-radius: 20px;
=======
    background: var(--c-lime);
    color: #0a0b0e;
    font-family: 'Anton', sans-serif;
    font-size: 10px;
    letter-spacing: 2px;
    padding: 3px 8px;
    border-radius: 3px;
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
    margin-bottom: 10px;
    text-transform: uppercase;
  }

  .nav-brand-name {
    font-family: 'Anton', sans-serif;
    font-size: 22px;
    letter-spacing: 1px;
<<<<<<< HEAD
    color: var(--c-text);
=======
    color: var(--c-white);
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
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
<<<<<<< HEAD
    font-weight: 700;
=======
    font-weight: 600;
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
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
<<<<<<< HEAD
    border-radius: 10px;
    text-decoration: none;
    color: var(--c-muted);
=======
    border-radius: 9px;
    text-decoration: none;
    color: var(--c-muted2);
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
    font-size: 14px;
    font-weight: 500;
    transition: all 0.2s;
    position: relative;
<<<<<<< HEAD
=======
    overflow: hidden;
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
  }

  .nav-link::before {
    content: '';
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 3px;
<<<<<<< HEAD
    background: var(--c-primary);
=======
    background: var(--c-lime);
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
    border-radius: 0 2px 2px 0;
    transform: scaleY(0);
    transition: transform 0.2s;
  }

  .nav-link:hover {
<<<<<<< HEAD
    background: #eef2ff;
    color: #000000;
  }

  .nav-link.active {
    background: #dbeafe;
    color: var(--c-primary);
=======
    background: var(--c-surface2);
    color: var(--c-white);
  }

  .nav-link.active {
    background: rgba(200, 241, 53, 0.08);
    color: var(--c-lime);
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
    font-weight: 600;
  }

  .nav-link.active::before { transform: scaleY(1); }

  .nav-link .nl-icon {
    width: 32px; height: 32px;
    display: flex; align-items: center; justify-content: center;
<<<<<<< HEAD
    background: #e2e8f0;
    border-radius: 8px;
=======
    background: var(--c-surface2);
    border-radius: 7px;
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
    flex-shrink: 0;
    font-size: 15px;
    transition: background 0.2s;
  }

  .nav-link.active .nl-icon {
<<<<<<< HEAD
    background: #bfdbfe;
=======
    background: rgba(200, 241, 53, 0.15);
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
  }

  .nav-footer {
    padding: 16px 20px;
    border-top: 1px solid var(--c-border);
    font-size: 11px;
    color: var(--c-muted);
    letter-spacing: 0.5px;
  }

<<<<<<< HEAD
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

=======
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
  /* ── MAIN ───────────────────────────────────── */
  .page {
    margin-left: var(--nav-w);
    flex: 1;
    position: relative;
    z-index: 1;
  }

<<<<<<< HEAD
  .page::before {
    content: '';
    display: block;
    height: 4px;
    background: linear-gradient(90deg, var(--c-primary) 0%, var(--c-accent) 60%, transparent 100%);
=======
  /* top accent line */
  .page::before {
    content: '';
    display: block;
    height: 3px;
    background: linear-gradient(90deg, var(--c-lime) 0%, transparent 60%);
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
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
<<<<<<< HEAD
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--c-primary);
=======
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--c-lime);
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
    margin-bottom: 6px;
  }

  .pg-title {
    font-family: 'Anton', sans-serif;
<<<<<<< HEAD
    font-size: 48px;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: #000000;
=======
    font-size: 52px;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: var(--c-white);
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
    line-height: 1;
  }

  /* ── CARDS ───────────────────────────────────── */
  .card {
    background: var(--c-surface);
    border: 1px solid var(--c-border);
    border-radius: var(--r);
    overflow: hidden;
<<<<<<< HEAD
    box-shadow: var(--shadow-sm);
  }

  .card-head {
    padding: 18px 24px;
=======
  }

  .card-head {
    padding: 18px 22px;
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
    border-bottom: 1px solid var(--c-border);
    display: flex;
    align-items: center;
    justify-content: space-between;
<<<<<<< HEAD
    background: #fafbfc;
=======
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
  }

  .card-head-title {
    font-family: 'Anton', sans-serif;
<<<<<<< HEAD
    font-size: 14px;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: #000000;
=======
    font-size: 13px;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--c-white);
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
  }

  /* ── STATS ROW ───────────────────────────────── */
  .stats-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
<<<<<<< HEAD
    gap: 16px;
=======
    gap: 14px;
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
    margin-bottom: 28px;
  }

  .stat-box {
    background: var(--c-surface);
    border: 1px solid var(--c-border);
    border-radius: var(--r);
<<<<<<< HEAD
    padding: 24px;
    position: relative;
    overflow: hidden;
    animation: fadeUp 0.5s ease both;
    box-shadow: var(--shadow-sm);
=======
    padding: 22px 24px;
    position: relative;
    overflow: hidden;
    animation: fadeUp 0.5s ease both;
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
  }

  .stat-box::after {
    content: attr(data-icon);
    position: absolute;
<<<<<<< HEAD
    right: 20px; top: 50%;
    transform: translateY(-50%);
    font-size: 40px;
    opacity: 0.08;
=======
    right: 16px; top: 50%;
    transform: translateY(-50%);
    font-size: 36px;
    opacity: 0.06;
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
  }

  .stat-box:nth-child(1) { animation-delay: 0.05s; }
  .stat-box:nth-child(2) { animation-delay: 0.1s; }
  .stat-box:nth-child(3) { animation-delay: 0.15s; }

  .stat-label {
<<<<<<< HEAD
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: #333333;
=======
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--c-muted2);
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
    margin-bottom: 10px;
  }

  .stat-num {
    font-family: 'Anton', sans-serif;
    font-size: 44px;
<<<<<<< HEAD
    color: var(--c-primary);
=======
    color: var(--c-lime);
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
    line-height: 1;
  }

  /* ── TABLE ───────────────────────────────────── */
  .tbl { width: 100%; border-collapse: collapse; }

<<<<<<< HEAD
  .tbl thead tr { background: #eef2f6; }

  .tbl th {
    padding: 14px 18px;
    text-align: left;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: #222222;
=======
  .tbl thead tr { background: var(--c-surface2); }

  .tbl th {
    padding: 13px 18px;
    text-align: left;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--c-muted);
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
    white-space: nowrap;
    border-bottom: 1px solid var(--c-border2);
  }

  .tbl td {
<<<<<<< HEAD
    padding: 16px 18px;
    border-bottom: 1px solid var(--c-border);
    vertical-align: middle;
    font-size: 14px;
    color: #1a1a1a;
    font-weight: 500;
=======
    padding: 15px 18px;
    border-bottom: 1px solid var(--c-border);
    vertical-align: middle;
    font-size: 14px;
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
  }

  .tbl tbody tr:last-child td { border-bottom: none; }

<<<<<<< HEAD
  .tbl tbody tr { transition: background 0.15s; }
  .tbl tbody tr:hover { background: #f8fafc; }
=======
  .tbl tbody tr {
    transition: background 0.15s;
  }
  .tbl tbody tr:hover { background: rgba(255,255,255,0.022); }
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0

  /* ── SCORE ───────────────────────────────────── */
  .score {
    display: inline-flex;
    align-items: center;
<<<<<<< HEAD
    background: #f1f5f9;
    border: 1px solid var(--c-border);
    border-radius: 10px;
    overflow: hidden;
    font-family: 'Anton', sans-serif;
    font-size: 18px;
=======
    background: var(--c-surface2);
    border: 1px solid var(--c-border2);
    border-radius: 8px;
    overflow: hidden;
    font-family: 'Anton', sans-serif;
    font-size: 20px;
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
    letter-spacing: 1px;
  }

  .score-h, .score-a {
<<<<<<< HEAD
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
=======
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
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
    cursor: pointer;
    border: none;
    text-decoration: none;
    transition: all 0.18s ease;
    white-space: nowrap;
  }

<<<<<<< HEAD
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
=======
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
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
  }

  .btn-danger {
    background: transparent;
<<<<<<< HEAD
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
=======
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
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
    cursor: pointer;
    transition: all 0.15s;
    text-decoration: none;
  }
<<<<<<< HEAD
  .icon-btn:hover { background: var(--c-surface2); color: #000000; border-color: #666666; }
  .icon-btn.edit:hover { color: var(--c-primary); border-color: var(--c-primary); background: #eff6ff; }
  .icon-btn.del:hover  { color: var(--c-danger); border-color: var(--c-danger); background: #fef2f2; }
=======
  .icon-btn:hover { background: var(--c-surface); color: var(--c-white); border-color: var(--c-muted); }
  .icon-btn.edit:hover { color: var(--c-lime); border-color: var(--c-lime); background: rgba(200,241,53,0.08); }
  .icon-btn.del:hover  { color: var(--c-red);  border-color: var(--c-red);  background: rgba(255,71,87,0.08);  }
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0

  /* ── BADGE ───────────────────────────────────── */
  .badge {
    display: inline-block;
<<<<<<< HEAD
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
=======
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
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0

  /* ── MODAL ───────────────────────────────────── */
  .overlay {
    display: none;
    position: fixed; inset: 0;
<<<<<<< HEAD
    background: rgba(0,0,0,0.3);
    z-index: 500;
    align-items: center; justify-content: center;
    backdrop-filter: blur(4px);
=======
    background: rgba(0,0,0,0.75);
    z-index: 500;
    align-items: center; justify-content: center;
    backdrop-filter: blur(6px);
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
  }
  .overlay.open { display: flex; }

  .modal {
    background: var(--c-surface);
<<<<<<< HEAD
    border: 1px solid var(--c-border);
    border-radius: 20px;
=======
    border: 1px solid var(--c-border2);
    border-radius: 16px;
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
    width: 100%; max-width: 520px;
    max-height: 90vh;
    overflow-y: auto;
    padding: 32px;
    position: relative;
<<<<<<< HEAD
    box-shadow: var(--shadow-lg);
=======
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
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
<<<<<<< HEAD
    color: #000000;
=======
    color: var(--c-white);
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
    margin-bottom: 24px;
    padding-right: 30px;
  }

  .modal-close {
<<<<<<< HEAD
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
=======
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
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
    padding-top: 20px;
    border-top: 1px solid var(--c-border);
  }

  /* ── FORMS ───────────────────────────────────── */
<<<<<<< HEAD
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
=======
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
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
    margin-bottom: 7px;
  }

  .fg input, .fg select, .fg textarea {
    width: 100%;
<<<<<<< HEAD
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
=======
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
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0

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
<<<<<<< HEAD
    box-shadow: var(--shadow-sm);
=======
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
  }

  .team-card::before {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
<<<<<<< HEAD
    height: 3px;
    background: linear-gradient(90deg, var(--c-primary), var(--c-accent));
=======
    height: 2px;
    background: linear-gradient(90deg, var(--c-lime), transparent);
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.25s;
  }

  .team-card:hover {
<<<<<<< HEAD
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
=======
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
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
  }

  .team-card-name {
    font-family: 'Anton', sans-serif;
<<<<<<< HEAD
    font-size: 22px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    color: #000000;
=======
    font-size: 21px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    color: var(--c-white);
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
    margin-bottom: 6px;
    line-height: 1.1;
  }

  .team-card-meta {
    font-size: 13px;
<<<<<<< HEAD
    color: #333333;
    margin-bottom: 18px;
    display: flex; gap: 14px; flex-wrap: wrap;
    font-weight: 500;
=======
    color: var(--c-muted2);
    margin-bottom: 18px;
    display: flex; gap: 14px; flex-wrap: wrap;
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
  }

  .team-pts {
    font-family: 'Anton', sans-serif;
    font-size: 38px;
<<<<<<< HEAD
    color: var(--c-primary);
    line-height: 1;
  }

  .pts-bar-bg { height: 4px; background: #e2e8f0; border-radius: 2px; margin-top: 10px; }
  .pts-bar    { height: 4px; background: var(--c-primary); border-radius: 2px; }
=======
    color: var(--c-lime);
    line-height: 1;
  }

  .pts-bar-bg { height: 3px; background: var(--c-border2); border-radius: 2px; margin-top: 10px; }
  .pts-bar    { height: 3px; background: var(--c-lime); border-radius: 2px; }
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0

  /* ── LJESTVICA ───────────────────────────────── */
  .podium { display: grid; grid-template-columns: 1fr 1.1fr 1fr; gap: 12px; margin-bottom: 30px; }

  .podium-card {
    border-radius: var(--r);
    padding: 26px 22px;
    text-align: center;
    position: relative;
    overflow: hidden;
    animation: fadeUp 0.4s ease both;
<<<<<<< HEAD
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
=======
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
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0

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
<<<<<<< HEAD
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
=======
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
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
    padding: 48px 52px;
    margin-bottom: 30px;
    position: relative;
    overflow: hidden;
    animation: fadeUp 0.5s ease;
<<<<<<< HEAD
    color: white;
=======
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
  }

  .hero::before {
    content: '';
    position: absolute;
    right: -80px; top: -80px;
    width: 360px; height: 360px;
<<<<<<< HEAD
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 65%);
=======
    background: radial-gradient(circle, rgba(200,241,53,0.07) 0%, transparent 65%);
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
    pointer-events: none;
  }

  .hero::after {
    content: '🤾';
    position: absolute;
    right: 48px; bottom: -10px;
    font-size: 140px;
<<<<<<< HEAD
    opacity: 0.1;
=======
    opacity: 0.06;
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
    pointer-events: none;
  }

  .hero-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
<<<<<<< HEAD
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
=======
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
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0

  @keyframes pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:0.5;transform:scale(0.8)} }

  .hero h1 {
    font-family: 'Anton', sans-serif;
<<<<<<< HEAD
    font-size: 56px;
=======
    font-size: 64px;
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
    text-transform: uppercase;
    letter-spacing: 2px;
    line-height: 1;
    margin-bottom: 14px;
<<<<<<< HEAD
    color: white;
  }

  .hero h1 em { color: #fbbf24; font-style: normal; }
  .hero p { font-size: 16px; color: #e2e8f0; max-width: 480px; line-height: 1.6; margin-bottom: 28px; font-weight: 500; }
=======
    color: var(--c-white);
  }

  .hero h1 em { color: var(--c-lime); font-style: normal; }
  .hero p { font-size: 16px; color: var(--c-muted2); max-width: 480px; line-height: 1.6; margin-bottom: 28px; }
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
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
<<<<<<< HEAD
    .user-section { justify-content: center; padding: 12px 8px; }
    .user-info, .user-role { display: none; }
    .user-logout { margin-left: 0; }
=======
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
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
<<<<<<< HEAD
  ::-webkit-scrollbar { width: 6px; height: 6px; }
  ::-webkit-scrollbar-track { background: #f1f5f9; }
  ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
  ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
=======
  ::-webkit-scrollbar { width: 5px; height: 5px; }
  ::-webkit-scrollbar-track { background: var(--c-bg); }
  ::-webkit-scrollbar-thumb { background: var(--c-border2); border-radius: 3px; }
  ::-webkit-scrollbar-thumb:hover { background: var(--c-muted); }
>>>>>>> 741770cfa397667c211fc0e61fb819268addbee0
</style>