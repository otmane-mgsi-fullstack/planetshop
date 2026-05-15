
<!DOCTYPE html>
<html lang="fr" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopAdmin — Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>

        /* ══════════════════════════════════════
           TOKENS — LIGHT
        ══════════════════════════════════════ */
        [data-theme="light"] {
            --bg:           #eef1f8;
            --surface:      #ffffff;
            --surface2:     #f4f6fb;
            --border:       #e5e9f2;
            --text-1:       #1a2540;
            --text-2:       #5a6880;
            --text-3:       #a8b3c8;
            --sidebar:      #ffffff;
            --topbar:       #ffffff;
            --row-hover:    #f8f9fd;
            --input-bg:     #f4f6fb;
            --shadow:       0 1px 12px rgba(26,37,64,.07);
            --shadow-lg:    0 6px 28px rgba(26,37,64,.12);
        }

        /* ══════════════════════════════════════
           TOKENS — DARK
        ══════════════════════════════════════ */
        [data-theme="dark"] {
            --bg:           #0f1623;
            --surface:      #1a2335;
            --surface2:     #141e2e;
            --border:       #283044;
            --text-1:       #e8edf7;
            --text-2:       #8a97b0;
            --text-3:       #3d4d65;
            --sidebar:      #141e2e;
            --topbar:       #1a2335;
            --row-hover:    #1f2d42;
            --input-bg:     #141e2e;
            --shadow:       0 1px 12px rgba(0,0,0,.28);
            --shadow-lg:    0 6px 28px rgba(0,0,0,.38);
        }

        /* ══════════════════════════════════════
           GLOBALS
        ══════════════════════════════════════ */
        :root {
            --orange:    #ff6b00;
            --orange-lt: #ff8c33;
            --o-dim:     rgba(255,107,0,.11);
            --blue:      #3b82f6;
            --green:     #10b981;
            --purple:    #8b5cf6;
            --red:       #ef4444;
            --r:         14px;
            --sw:        258px;
            --fh:        'Syne', sans-serif;
            --fb:        'DM Sans', sans-serif;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: var(--fb);
            background: var(--bg);
            color: var(--text-1);
            min-height: 100vh;
            display: flex;
            transition: background .3s, color .3s;
            overflow-x: hidden;
        }

        a { text-decoration: none; color: inherit; }

        /* ══════════════════════════════════════
           BOOTSTRAP OVERRIDES — DARK MODE FIX
           Force toutes les couleurs via variables
        ══════════════════════════════════════ */

        /* Tables Bootstrap */
        .table {
            --bs-table-bg:            var(--surface);
            --bs-table-striped-bg:    var(--surface2);
            --bs-table-hover-bg:      var(--row-hover);
            --bs-table-color:         var(--text-1);
            --bs-table-border-color:  var(--border);
            color: var(--text-1) !important;
        }

        /* Inputs & Selects Bootstrap */
        .form-control,
        .form-select {
            background-color: var(--input-bg) !important;
            border-color:     var(--border) !important;
            color:            var(--text-1) !important;
            transition: background-color .3s, border-color .25s, color .3s, box-shadow .25s;
        }
        .form-control:focus,
        .form-select:focus {
            background-color: var(--input-bg) !important;
            border-color:     var(--orange) !important;
            color:            var(--text-1) !important;
            box-shadow: 0 0 0 3px var(--o-dim) !important;
        }
        .form-control::placeholder { color: var(--text-3) !important; }
        .form-select option {
            background-color: var(--surface) !important;
            color:            var(--text-1) !important;
        }

        /* Cards Bootstrap */
        .card {
            background-color: var(--surface) !important;
            border-color:     var(--border) !important;
            color:            var(--text-1) !important;
        }
        .card-header,
        .card-footer {
            background-color: var(--surface2) !important;
            border-color:     var(--border) !important;
            color:            var(--text-1) !important;
        }

        /* Modals Bootstrap */
        .modal-content {
            background-color: var(--surface) !important;
            border-color:     var(--border) !important;
            color:            var(--text-1) !important;
        }
        .modal-header,
        .modal-footer {
            background-color: var(--surface2) !important;
            border-color:     var(--border) !important;
        }

        /* Dropdowns Bootstrap */
        .dropdown-menu {
            background-color: var(--surface) !important;
            border-color:     var(--border) !important;
            box-shadow:       var(--shadow-lg) !important;
        }
        .dropdown-item {
            color: var(--text-2) !important;
        }
        .dropdown-item:hover,
        .dropdown-item:focus {
            background-color: var(--o-dim) !important;
            color: var(--orange) !important;
        }
        .dropdown-divider { border-color: var(--border) !important; }

        /* Badges Bootstrap */
        .badge.bg-light { background-color: var(--surface2) !important; color: var(--text-2) !important; }

        /* Alerts Bootstrap */
        .alert {
            background-color: var(--surface2) !important;
            border-color:     var(--border) !important;
            color:            var(--text-1) !important;
        }

        /* List groups Bootstrap */
        .list-group-item {
            background-color: var(--surface) !important;
            border-color:     var(--border) !important;
            color:            var(--text-1) !important;
        }
        .list-group-item:hover {
            background-color: var(--row-hover) !important;
        }

        /* Pagination Bootstrap */
        .page-link {
            background-color: var(--surface) !important;
            border-color:     var(--border) !important;
            color:            var(--text-2) !important;
        }
        .page-link:hover {
            background-color: var(--o-dim) !important;
            color: var(--orange) !important;
        }
        .page-item.active .page-link {
            background-color: var(--orange) !important;
            border-color:     var(--orange) !important;
            color: #fff !important;
        }
        .page-item.disabled .page-link {
            background-color: var(--surface2) !important;
            color: var(--text-3) !important;
        }

        /* Nav tabs Bootstrap */
        .nav-tabs {
            border-color: var(--border) !important;
        }
        .nav-tabs .nav-link {
            color: var(--text-2) !important;
        }
        .nav-tabs .nav-link:hover {
            border-color: var(--border) !important;
            color: var(--orange) !important;
        }
        .nav-tabs .nav-link.active {
            background-color: var(--surface) !important;
            border-color: var(--border) var(--border) var(--surface) !important;
            color: var(--orange) !important;
        }
        .nav-pills .nav-link { color: var(--text-2) !important; }
        .nav-pills .nav-link.active,
        .nav-pills .show > .nav-link {
            background-color: var(--orange) !important;
            color: #fff !important;
        }

        /* Offcanvas Bootstrap */
        .offcanvas {
            background-color: var(--surface) !important;
            color: var(--text-1) !important;
        }
        .offcanvas-header { border-color: var(--border) !important; }

        /* Toast Bootstrap */
        .toast {
            background-color: var(--surface) !important;
            border-color:     var(--border) !important;
            color:            var(--text-1) !important;
        }
        .toast-header {
            background-color: var(--surface2) !important;
            border-color:     var(--border) !important;
            color:            var(--text-1) !important;
        }

        /* Accordion Bootstrap */
        .accordion-item {
            background-color: var(--surface) !important;
            border-color:     var(--border) !important;
        }
        .accordion-button {
            background-color: var(--surface2) !important;
            color:            var(--text-1) !important;
        }
        .accordion-button:not(.collapsed) {
            background-color: var(--o-dim) !important;
            color:            var(--orange) !important;
            box-shadow: none !important;
        }
        .accordion-button::after {
            filter: none;
        }
        [data-theme="dark"] .accordion-button::after {
            filter: invert(1) brightness(0.7);
        }
        .accordion-body {
            background-color: var(--surface) !important;
            color: var(--text-2) !important;
        }

        /* Input group Bootstrap */
        .input-group-text {
            background-color: var(--surface2) !important;
            border-color:     var(--border) !important;
            color:            var(--text-2) !important;
        }

        /* Close button Bootstrap */
        .btn-close {
            filter: none;
        }
        [data-theme="dark"] .btn-close {
            filter: invert(1) brightness(0.8);
        }

        /* ══════════════════════════════════════
           SIDEBAR
        ══════════════════════════════════════ */
        .sidebar {
            width: var(--sw);
            min-height: 100vh;
            background: var(--sidebar);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 200;
            transition: background .3s, border-color .3s, transform .3s;
        }

        .s-logo {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 26px 22px 22px;
            border-bottom: 1px solid var(--border);
            transition: border-color .3s;
        }
        .s-logo-ico {
            width: 36px; height: 36px; border-radius: 10px;
            background: var(--orange); color: #fff;
            display: grid; place-items: center; font-size: 17px; flex-shrink: 0;
        }
        .s-logo-txt {
            font-family: var(--fh);
            font-size: 17px;
            font-weight: 800;
            color: var(--text-1);
            transition: color .3s;
        }
        .s-logo-txt span { color: var(--orange); }

        .s-group { padding: 18px 14px 4px; }

        .s-lbl {
            font-size: 9.5px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 1.4px;
            color: var(--text-3);
            padding: 0 10px; margin-bottom: 5px;
            transition: color .3s;
        }

        .s-link {
            display: flex; align-items: center; gap: 11px;
            padding: 9px 12px; border-radius: 10px;
            color: var(--text-2);
            font-size: 13.5px; font-weight: 500;
            cursor: pointer;
            transition: background .18s, color .18s;
            margin-bottom: 1px;
        }
        .s-link i { font-size: 16px; width: 18px; text-align: center; flex-shrink: 0; }
        .s-link:hover  { background: var(--o-dim); color: var(--orange); }
        .s-link.on     { background: var(--orange); color: #fff; font-weight: 600; box-shadow: 0 4px 16px rgba(255,107,0,.28); }

        .s-badge {
            margin-left: auto;
            font-size: 10px; font-weight: 700;
            padding: 2px 8px; border-radius: 20px;
            background: var(--o-dim); color: var(--orange);
            transition: background .3s, color .3s;
        }
        .s-link.on .s-badge { background: rgba(255,255,255,.22); color: #fff; }

        .s-foot {
            margin-top: auto; padding: 14px;
            border-top: 1px solid var(--border);
            transition: border-color .3s;
        }

        .u-tile {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 12px; border-radius: 12px;
            background: var(--surface2);
            cursor: pointer;
            transition: background .2s;
        }
        .u-tile:hover { background: var(--border); }

        .u-av {
            width: 34px; height: 34px; border-radius: 50%;
            background: var(--orange); color: #fff;
            display: grid; place-items: center;
            font-family: var(--fh); font-weight: 700; font-size: 13px; flex-shrink: 0;
        }
        .u-name { font-size: 12.5px; font-weight: 600; color: var(--text-1); transition: color .3s; }
        .u-role { font-size: 11px; color: var(--text-3); transition: color .3s; }
        .u-tile .ch { margin-left: auto; font-size: 11px; color: var(--text-3); }

        /* ══════════════════════════════════════
           MAIN
        ══════════════════════════════════════ */
        .main { margin-left: var(--sw); flex: 1; display: flex; flex-direction: column; }

        /* ══════════════════════════════════════
           TOPBAR
        ══════════════════════════════════════ */
        .topbar {
            background: var(--topbar);
            border-bottom: 1px solid var(--border);
            height: 64px; padding: 0 28px;
            display: flex; align-items: center; gap: 14px;
            position: sticky; top: 0; z-index: 100;
            transition: background .3s, border-color .3s;
        }

        .tb-title {
            font-family: var(--fh);
            font-size: 18px; font-weight: 800;
            color: var(--text-1); flex: 1;
            transition: color .3s;
        }

        /* Search */
        .s-wrap { position: relative; }
        .s-wrap i {
            position: absolute; left: 11px; top: 50%;
            transform: translateY(-50%);
            color: var(--text-3); font-size: 13px;
        }
        .s-wrap input {
            background: var(--surface2) !important;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            padding: 8px 14px 8px 34px;
            font-size: 13px; font-family: var(--fb);
            color: var(--text-1) !important;
            width: 210px; outline: none;
            transition: background .3s, color .3s, border-color .25s, width .25s, box-shadow .25s;
        }
        .s-wrap input::placeholder { color: var(--text-3) !important; }
        .s-wrap input:focus {
            width: 260px;
            border-color: var(--orange);
            box-shadow: 0 0 0 3px var(--o-dim);
        }

        /* Topbar actions */
        .tb-acts { display: flex; align-items: center; gap: 7px; }

        .tbb {
            width: 36px; height: 36px; border-radius: 10px;
            background: var(--surface2); border: 1.5px solid var(--border);
            color: var(--text-2); font-size: 15px; cursor: pointer;
            display: grid; place-items: center;
            position: relative;
            transition: background .2s, color .2s, border-color .2s;
        }
        .tbb:hover { background: var(--o-dim); color: var(--orange); border-color: transparent; }

        .ndot {
            position: absolute; top: 6px; right: 6px;
            width: 6px; height: 6px;
            background: var(--orange); border-radius: 50%;
            border: 1.5px solid var(--topbar);
            transition: border-color .3s;
        }

        /* Theme switch */
        .t-sw {
            width: 50px; height: 26px;
            background: var(--surface2); border: 1.5px solid var(--border);
            border-radius: 20px; cursor: pointer; position: relative;
            display: flex; align-items: center; padding: 0 3px;
            transition: background .3s, border-color .3s;
            flex-shrink: 0;
        }
        [data-theme="dark"] .t-sw {
            background: var(--orange);
            border-color: var(--orange);
        }
        .t-knob {
            width: 20px; height: 20px; border-radius: 50%;
            background: #fff;
            box-shadow: 0 1px 4px rgba(0,0,0,.18);
            transition: transform .28s cubic-bezier(.4,0,.2,1);
            display: grid; place-items: center; font-size: 11px;
        }
        [data-theme="dark"] .t-knob { transform: translateX(22px); }
        .t-knob .i-sun  { display: block;  color: var(--orange); }
        .t-knob .i-moon { display: none;   color: #334155; }
        [data-theme="dark"] .t-knob .i-sun  { display: none; }
        [data-theme="dark"] .t-knob .i-moon { display: block; }

        /* ══════════════════════════════════════
           CONTENT WRAPPER
        ══════════════════════════════════════ */
        .content { padding: 26px 28px; flex: 1; }
        .section { display: none; }
        .section.active { display: block; }

        /* ══════════════════════════════════════
           KPI CARDS
        ══════════════════════════════════════ */
        .kpi-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 24px;
        }

        .kpi {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--r);
            overflow: hidden;
            box-shadow: var(--shadow);
            display: flex; flex-direction: column;
            transition: transform .2s, box-shadow .2s, background .3s, border-color .3s;
        }
        .kpi:hover { transform: translateY(-3px); box-shadow: var(--shadow-lg); }

        .kpi-band { height: 3px; background: var(--kc, var(--orange)); flex-shrink: 0; }
        .kpi-body { padding: 20px 20px 16px; display: flex; flex-direction: column; flex: 1; }

        .kpi-row1 {
            display: flex; align-items: flex-start; justify-content: space-between;
            margin-bottom: 16px;
        }
        .kpi-ico {
            width: 46px; height: 46px; border-radius: 13px;
            display: grid; place-items: center; font-size: 20px;
            background: var(--kd, var(--o-dim));
            color: var(--kc, var(--orange));
            flex-shrink: 0;
        }
        .kpi-right { text-align: right; }
        .kpi-label {
            font-size: 11.5px; font-weight: 600;
            text-transform: uppercase; letter-spacing: .9px;
            color: var(--text-3); line-height: 1; margin-bottom: 4px;
            transition: color .3s;
        }
        .kpi-trend {
            display: inline-flex; align-items: center; gap: 2px;
            font-size: 11.5px; font-weight: 700;
            padding: 3px 8px; border-radius: 6px;
        }
        .up   { background: rgba(16,185,129,.13); color: #10b981; }
        .down { background: rgba(239,68,68,.13);  color: #ef4444; }

        .kpi-val {
            font-family: var(--fh);
            font-size: 34px; font-weight: 800;
            color: var(--text-1); line-height: 1;
            letter-spacing: -.6px;
            margin-bottom: 14px;
            transition: color .3s;
        }

        .kpi-bar {
            height: 5px;
            background: var(--surface2);
            border-radius: 10px; overflow: hidden;
            margin-bottom: 10px;
            transition: background .3s;
        }
        .kpi-bar-fill { height: 100%; border-radius: 10px; background: var(--kc, var(--orange)); opacity: .55; }

        .kpi-sub { font-size: 12px; color: var(--text-2); transition: color .3s; }

        /* ══════════════════════════════════════
           CHARTS GRID
        ══════════════════════════════════════ */
        .charts-grid {
            display: grid;
            grid-template-columns: 1fr 370px;
            gap: 18px;
            margin-bottom: 24px;
            align-items: start;
        }

        .card-panel {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--r);
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: background .3s, border-color .3s;
        }

        .c-head {
            padding: 17px 22px 13px;
            display: flex; align-items: center; justify-content: space-between;
            border-bottom: 1px solid var(--border);
            transition: border-color .3s;
        }
        .c-title {
            font-family: var(--fh);
            font-size: 14.5px; font-weight: 700;
            color: var(--text-1);
            transition: color .3s;
        }
        .c-title small {
            font-family: var(--fb); font-weight: 400;
            font-size: 12px; color: var(--text-3);
            margin-left: 6px; transition: color .3s;
        }
        .c-body { padding: 20px 22px; }

        .pills { display: flex; gap: 4px; }
        .pill {
            font-size: 11.5px; font-weight: 600; font-family: var(--fb);
            padding: 5px 13px; border-radius: 20px;
            border: 1.5px solid var(--border);
            background: transparent; color: var(--text-2);
            cursor: pointer;
            transition: background .18s, color .18s, border-color .18s;
        }
        .pill.on, .pill:hover { background: var(--orange); color: #fff; border-color: var(--orange); }

        /* Donut */
        .donut-outer { max-width: 210px; margin: 0 auto 18px; position: relative; }
        .donut-center {
            position: absolute; inset: 0;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            pointer-events: none;
        }
        .donut-big { font-family: var(--fh); font-size: 24px; font-weight: 800; color: var(--text-1); transition: color .3s; }
        .donut-tiny { font-size: 11px; color: var(--text-3); transition: color .3s; }

        .d-legend { display: flex; flex-direction: column; gap: 9px; }
        .d-row { display: flex; align-items: center; gap: 8px; }
        .d-dot { width: 10px; height: 10px; border-radius: 3px; flex-shrink: 0; }
        .d-name { font-size: 12.5px; color: var(--text-2); flex: 1; transition: color .3s; }
        .d-pct  { font-size: 12.5px; font-weight: 700; color: var(--text-1); transition: color .3s; }

        /* ══════════════════════════════════════
           TABLES (custom, pas Bootstrap)
        ══════════════════════════════════════ */
        .table-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--r);
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 24px;
            transition: background .3s, border-color .3s;
        }
        .t-head {
            padding: 16px 22px;
            display: flex; align-items: center; justify-content: space-between;
            border-bottom: 1px solid var(--border);
            transition: border-color .3s;
        }

        table { width: 100%; border-collapse: collapse; }

        thead th {
            background: var(--surface2) !important;
            color: var(--text-3) !important;
            font-size: 10.5px; font-weight: 700;
            text-transform: uppercase; letter-spacing: .8px;
            padding: 10px 18px; text-align: left;
            transition: background .3s, color .3s;
        }

        tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background .15s;
        }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: var(--row-hover); }

        tbody td {
            padding: 11px 18px;
            font-size: 13.5px;
            color: var(--text-1);
            vertical-align: middle;
            transition: color .3s;
        }

        /* Avatars */
        .av {
            width: 30px; height: 30px; border-radius: 50%;
            display: inline-grid; place-items: center;
            font-family: var(--fh); font-weight: 700; font-size: 12px;
            color: #fff; flex-shrink: 0;
        }
        .ao { background: var(--orange); }
        .ab { background: var(--blue); }
        .ag { background: var(--green); }
        .ap { background: var(--purple); }
        .at { background: #14b8a6; }

        /* Status badges */
        .bx {
            font-size: 11px; font-weight: 600;
            padding: 3px 10px; border-radius: 6px; display: inline-block;
        }
        .bg-s { background: rgba(16,185,129,.12); color: #10b981; }
        .bo-s { background: rgba(255,107,0,.12);  color: var(--orange); }
        .bb-s { background: rgba(59,130,246,.12); color: var(--blue); }
        .br-s { background: rgba(239,68,68,.12);  color: var(--red); }
        .bs-s { background: var(--surface2); color: var(--text-2); }

        /* Buttons */
        .btn-o {
            background: var(--orange); color: #fff; border: none;
            border-radius: 10px; padding: 8px 16px;
            font-size: 12.5px; font-weight: 600; font-family: var(--fb);
            cursor: pointer; display: flex; align-items: center; gap: 6px;
            transition: background .2s, box-shadow .2s;
        }
        .btn-o:hover { background: var(--orange-lt); box-shadow: 0 4px 16px rgba(255,107,0,.3); }

        .ib {
            width: 32px; height: 32px; border-radius: 8px;
            background: var(--surface2); border: 1px solid var(--border);
            display: grid; place-items: center; font-size: 14px;
            color: var(--text-2); cursor: pointer;
            transition: background .18s, color .18s, border-color .18s;
        }
        .ib:hover { background: var(--o-dim); color: var(--orange); border-color: transparent; }

        /* ══════════════════════════════════════
           BOTTOM GRID
        ══════════════════════════════════════ */
        .bot-grid {
            display: grid;
            grid-template-columns: 1.1fr 1fr 1fr;
            gap: 18px;
            margin-bottom: 24px;
        }

        /* Progress bars */
        .prog { margin-bottom: 13px; }
        .pg-lbl {
            display: flex; justify-content: space-between;
            font-size: 12.5px; color: var(--text-2);
            margin-bottom: 5px; transition: color .3s;
        }
        .pg-lbl b { font-weight: 700; color: var(--text-1); transition: color .3s; }
        .pg-track {
            height: 6px; background: var(--surface2);
            border-radius: 4px; overflow: hidden;
            transition: background .3s;
        }
        .pg-fill { height: 100%; border-radius: 4px; }

        /* Activity feed */
        .act {
            display: flex; gap: 11px;
            padding: 10px 0;
            border-bottom: 1px solid var(--border);
            transition: border-color .3s;
        }
        .act:last-child { border-bottom: none; }
        .act-ic {
            width: 32px; height: 32px; border-radius: 9px;
            display: grid; place-items: center;
            font-size: 14px; flex-shrink: 0;
        }
        .act-txt { font-size: 12.5px; color: var(--text-1); line-height: 1.55; transition: color .3s; }
        .act-txt strong { font-weight: 600; }
        .act-time { font-size: 11px; color: var(--text-3); margin-top: 2px; transition: color .3s; }

        /* Top products */
        .prod {
            display: flex; align-items: center; gap: 11px;
            padding: 10px 0;
            border-bottom: 1px solid var(--border);
            transition: border-color .3s;
        }
        .prod:last-child { border-bottom: none; }
        .prod-th {
            width: 38px; height: 38px; border-radius: 10px;
            background: var(--surface2);
            display: grid; place-items: center;
            font-size: 18px; flex-shrink: 0;
            transition: background .3s;
        }
        .prod-n { font-size: 13px; font-weight: 600; color: var(--text-1); transition: color .3s; }
        .prod-c { font-size: 11px; color: var(--text-3); transition: color .3s; }
        .prod-n2 {
            margin-left: auto;
            font-family: var(--fh); font-size: 15px; font-weight: 800;
            color: var(--text-1); transition: color .3s;
        }
        .prod-s { font-size: 11px; color: var(--text-3); text-align: right; transition: color .3s; }

        /* Placeholder sections */
        .ph {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--r);
            padding: 70px 40px; text-align: center;
            box-shadow: var(--shadow);
            transition: background .3s, border-color .3s;
        }
        .ph-ic {
            width: 66px; height: 66px; border-radius: 18px;
            background: var(--o-dim); color: var(--orange);
            display: inline-grid; place-items: center;
            font-size: 28px; margin-bottom: 18px;
        }
        .ph h2 {
            font-family: var(--fh); font-size: 20px; font-weight: 800;
            color: var(--text-1); margin-bottom: 8px; transition: color .3s;
        }
        .ph p {
            font-size: 13.5px; color: var(--text-2);
            max-width: 380px; margin: 0 auto 22px;
            transition: color .3s;
        }

        .chips { display: flex; flex-wrap: wrap; gap: 8px; justify-content: center; }
        .chip {
            background: var(--surface2); border: 1.5px solid var(--border);
            border-radius: 9px; padding: 7px 14px;
            font-size: 12.5px; color: var(--text-2); font-weight: 500;
            transition: background .3s, border-color .3s, color .3s;
        }

        /* ══════════════════════════════════════
           SCROLLBAR
        ══════════════════════════════════════ */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 8px; }

        /* ══════════════════════════════════════
           RESPONSIVE
        ══════════════════════════════════════ */
        @media (max-width: 1280px) {
            .charts-grid { grid-template-columns: 1fr; }
            .kpi-row { grid-template-columns: repeat(2, 1fr); }
            .bot-grid { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 768px) {
            :root { --sw: 0px; }
            .sidebar { transform: translateX(-258px); --sw: 258px; }
            .sidebar.open { transform: translateX(0); }
            .kpi-row { grid-template-columns: 1fr; }
            .bot-grid { grid-template-columns: 1fr; }
            .content { padding: 18px 16px; }
            .topbar { padding: 0 16px; }
        }


        /* ══ NOTIFICATIONS ══ */
        .notif-wrap { position: relative; }

        .notif-drop {
            display: none;
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            width: 320px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--r);
            box-shadow: var(--shadow-lg);
            z-index: 9999;
            overflow: hidden;
        }
        .notif-drop.open { display: block; }

        .notif-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 13px 16px;
            border-bottom: 1px solid var(--border);
            font-family: var(--fh);
            font-size: 13px;
            font-weight: 700;
            color: var(--text-1);
        }

        .notif-count {
            background: var(--orange);
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 20px;
        }

        .notif-list { max-height: 320px; overflow-y: auto; }

        .notif-item {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 11px 16px;
            border-bottom: 1px solid var(--border);
            transition: background .15s;
            cursor: default;
        }
        .notif-item:last-child { border-bottom: none; }
        .notif-item:hover { background: var(--row-hover); }

        .notif-ico {
            width: 36px; height: 36px; border-radius: 10px;
            background: var(--o-dim);
            color: var(--orange);
            display: grid; place-items: center;
            font-size: 16px; flex-shrink: 0;
        }

        .notif-body { flex: 1; min-width: 0; }
        .notif-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-1);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .notif-meta { font-size: 11px; color: var(--text-3); margin-top: 2px; }

        .notif-amount {
            font-family: var(--fh);
            font-size: 13px;
            font-weight: 800;
            color: var(--orange);
            flex-shrink: 0;
        }

        .notif-empty {
            padding: 24px 16px;
            text-align: center;
            font-size: 13px;
            color: var(--text-3);
        }

        .notif-footer {
            padding: 10px 16px;
            border-top: 1px solid var(--border);
            text-align: center;
            font-size: 12px;
            font-weight: 600;
            background: var(--surface2);
        }
        .notif-footer a { color: var(--orange); }
        .notif-footer a:hover { text-decoration: underline; }

        /* badge statut */
        .ns-badge {
            font-size: 10px;
            font-weight: 700;
            padding: 1px 7px;
            border-radius: 5px;
            margin-left: 5px;
        }
        .ns-en_attente  { background: rgba(255,107,0,.12); color: var(--orange); }
        .ns-confirme    { background: rgba(59,130,246,.12); color: var(--blue); }
        .ns-expedie     { background: rgba(139,92,246,.12); color: var(--purple); }
        .ns-livre       { background: rgba(16,185,129,.12); color: var(--green); }
        .ns-annule      { background: rgba(239,68,68,.12); color: var(--red); }
    </style>
</head>

<body>


@php

    $sidebar_products_count = \App\Models\Product::count();
    $sidebar_categories_count = class_exists('\App\Models\Category') ? \App\Models\Category::count() : 0;
    $sidebar_orders_count = \App\Models\Order::count();
    $sidebar_clients_count = \App\Models\Client::count();
@endphp




    <!-- ══ SIDEBAR ══ -->
<aside class="sidebar" id="sidebar">
    <div class="s-logo">
        <div class="s-logo-ico"><i class="bi bi-bag-heart-fill"></i></div>
        <span class="s-logo-txt">Shop<span>Admin</span></span>
    </div>

    <div class="s-group">
        <div class="s-lbl">Principal</div>
        <a class="s-link on" href="{{ Route('dash.index') }}">
            <i class="bi bi-grid-1x2-fill"></i> Dashboard
        </a>
    </div>

    <div class="s-group">
        <div class="s-lbl">Catalogue</div>
        <a class="s-link" href="{{ Route('dash.product') }}">
            <i class="bi bi-box-seam-fill"></i> Produits <span class="s-badge">{{$sidebar_products_count}}</span>
        </a>
        <a class="s-link" href="{{ Route('dash.category') }}">
            <i class="bi bi-tags-fill"></i> Catégories <span class="s-badge">{{$sidebar_categories_count}}</span>
        </a>
    </div>

    <div class="s-group">
        <div class="s-lbl">Ventes</div>
        <a class="s-link" href="{{ Route('dash.order') }}">
            <i class="bi bi-receipt-cutoff"></i> Commandes <span class="s-badge">{{$sidebar_orders_count}}</span>
        </a>
        <a class="s-link" href="{{ Route('dash.client') }}">
            <i class="bi bi-people-fill"></i> Clients <span class="s-badge">{{$sidebar_clients_count}}</span>
        </a>
    </div>

    <div class="s-group">
        <div class="s-lbl">Gestion</div>
        <a class="s-link" onclick="go('utilisateurs', this)">
            <i class="bi bi-person-badge-fill"></i> Utilisateurs
        </a>
        <a class="s-link" href="{{ Route('dash.support') }}">
            <i class="bi bi-headset"></i> Support <span class="s-badge">5</span>
        </a>
    </div>

    <div class="s-foot">

        <div class="u-tile">
            <div class="u-av">A</div>

            <div>
                <div class="u-name">Admin Principal</div>
                <div class="u-role">Super Admin</div>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="s-link border-0 bg-transparent text-start w-100">
                <i class="bi bi-box-arrow-right"></i>
                Logout
            </button>
        </form>

    </div>


</aside>

<!-- ══ MAIN ══ -->
<div class="main">
    <header class="topbar">
        <span class="tb-title" id="pg-title">Dashboard</span>

        <div class="s-wrap">
            <i class="bi bi-search"></i>
            <input type="text" placeholder="Rechercher…">
        </div>

        <div class="tb-acts">
            <div class="notif-wrap" id="notifWrap">
                <button class="tbb" id="notifBtn" onclick="toggleNotif()" title="Notifications">
                    <i class="bi bi-bell-fill"></i>
                    <span class="ndot" id="notifDot"></span>
                </button>

                <div class="notif-drop" id="notifDrop">
                    <div class="notif-header">
                        <span>Dernières commandes</span>
                        <span class="notif-count" id="notifCount">0</span>
                    </div>
                    <div class="notif-list" id="notifList">
                        <div class="notif-empty">Chargement...</div>
                    </div>
                    <div class="notif-footer">
                        <a href="{{ Route('dash.order') }}">Voir toutes les commandes →</a>
                    </div>
                </div>
            </div>

            <button class="t-sw" id="themeBtn" title="Changer le thème">
                <div class="t-knob">
                    <i class="bi bi-sun-fill i-sun"></i>
                    <i class="bi bi-moon-fill i-moon"></i>
                </div>
            </button>

            <!-- <button class="tbb"><i class="bi bi-gear-fill"></i></button>  -->


            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="s-link border-0 bg-transparent text-start w-100">
                    <i class="bi bi-box-arrow-right"></i>

                </button>
            </form>


        </div>
    </header>

    <div class="content">
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>

<script>

    /* ══════════════════════════════════════
       THEME SYSTEM
    ══════════════════════════════════════ */
    const html      = document.documentElement;
    const themeBtn  = document.getElementById('themeBtn');

    /* Appliquer le thème sauvegardé immédiatement */
    let dark = localStorage.getItem('sa-theme') === 'dark';
    html.setAttribute('data-theme', dark ? 'dark' : 'light');

    themeBtn.addEventListener('click', () => {
        dark = !dark;
        html.setAttribute('data-theme', dark ? 'dark' : 'light');
        localStorage.setItem('sa-theme', dark ? 'dark' : 'light');
        rebuildCharts();
    });

    /* ══════════════════════════════════════
       NAVIGATION
    ══════════════════════════════════════ */
    const TITLES = {
        dashboard:    'Dashboard',
        produits:     'Gestion Produits',
        categories:   'Catégories',
        commandes:    'Commandes',
        clients:      'Clients',
        utilisateurs: 'Utilisateurs',
        support:      'Support Client'
    };

    function go(id, el) {
        document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
        document.querySelectorAll('.s-link').forEach(l => l.classList.remove('on'));

        const target = document.getElementById('sec-' + id);
        if (target) target.classList.add('active');
        if (el) el.classList.add('on');

        document.getElementById('pg-title').textContent = TITLES[id] || id;
    }

    /* ══════════════════════════════════════
       CSS VARIABLE HELPER
    ══════════════════════════════════════ */
    function cv(v) {
        return getComputedStyle(html).getPropertyValue(v).trim();
    }

    /* ══════════════════════════════════════
       LINE CHART
    ══════════════════════════════════════ */
    let LC;

    function buildLine() {
        if (LC) LC.destroy();

        const grid = cv('--border');
        const tick = cv('--text-3');
        const txt  = cv('--text-2');

        LC = new Chart(document.getElementById('lineChart'), {
            type: 'line',
            data: {
                labels: ['Jan','Fév','Mar','Avr','Mai','Jun','Jul','Aoû','Sep','Oct','Nov','Déc'],
                datasets: [
                    {
                        label: '2025',
                        data: [42,58,45,73,84,82,94,78,88,102,115,84],
                        borderColor: '#ff6b00',
                        backgroundColor: (ctx) => {
                            const g = ctx.chart.ctx.createLinearGradient(0,0,0,230);
                            g.addColorStop(0, dark ? 'rgba(255,107,0,.25)' : 'rgba(255,107,0,.18)');
                            g.addColorStop(1, 'rgba(255,107,0,0)');
                            return g;
                        },
                        borderWidth: 2.5, fill: true, tension: .42,
                        pointRadius: 0, pointHoverRadius: 5,
                        pointHoverBackgroundColor: '#ff6b00',
                        pointHoverBorderColor: '#fff', pointHoverBorderWidth: 2,
                    },
                    {
                        label: '2024',
                        data: [30,42,38,55,65,62,70,60,72,80,90,65],
                        borderColor: '#3b82f6', backgroundColor: 'transparent',
                        borderWidth: 2, fill: false, tension: .42,
                        borderDash: [5,4], pointRadius: 0, pointHoverRadius: 4,
                        pointHoverBackgroundColor: '#3b82f6',
                    }
                ]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: {
                        labels: {
                            font: { family: 'DM Sans', size: 12 },
                            color: txt, usePointStyle: true, pointStyleWidth: 16, padding: 20
                        }
                    },
                    tooltip: {
                        backgroundColor: dark ? '#1a2335' : '#fff',
                        borderColor:     dark ? '#283044' : '#e5e9f2',
                        borderWidth: 1,
                        titleColor: dark ? '#e8edf7' : '#1a2540',
                        bodyColor:  dark ? '#8a97b0' : '#5a6880',
                        titleFont: { family: 'Syne', weight: '700' },
                        bodyFont:  { family: 'DM Sans' },
                        padding: 12, cornerRadius: 10,
                        callbacks: { label: c => ` ${c.dataset.label}: ${c.parsed.y}k €` }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        border: { display: false },
                        ticks: { font: { family: 'DM Sans', size: 11 }, color: tick }
                    },
                    y: {
                        grid: { color: grid },
                        border: { display: false },
                        ticks: { font: { family: 'DM Sans', size: 11 }, color: tick, callback: v => v + 'k' }
                    }
                }
            }
        });
    }

    /* ══════════════════════════════════════
       DONUT CHART
    ══════════════════════════════════════ */
    let DC;

    function buildDonut() {
        if (DC) DC.destroy();

        DC = new Chart(document.getElementById('donutChart'), {
            type: 'doughnut',
            data: {
                labels: ['Informatique','Téléphones','Audio','Wearables','Autres'],
                datasets: [{
                    data: [38,27,16,12,7],
                    backgroundColor: ['#ff6b00','#3b82f6','#10b981','#8b5cf6','#a8b3c8'],
                    borderWidth: dark ? 2 : 3,
                    borderColor: dark ? '#1a2335' : '#ffffff',
                    hoverOffset: 10,
                }]
            },
            options: {
                cutout: '74%', responsive: true, maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: dark ? '#1a2335' : '#fff',
                        borderColor:     dark ? '#283044' : '#e5e9f2',
                        borderWidth: 1,
                        titleColor: dark ? '#e8edf7' : '#1a2540',
                        bodyColor:  dark ? '#8a97b0' : '#5a6880',
                        titleFont: { family: 'Syne', weight: '700' },
                        bodyFont:  { family: 'DM Sans' },
                        padding: 10, cornerRadius: 10,
                        callbacks: { label: c => ` ${c.label}: ${c.parsed}%` }
                    }
                }
            }
        });
    }

    /* ══════════════════════════════════════
       REBUILD CHARTS
    ══════════════════════════════════════ */
    function rebuildCharts() {
        if (document.getElementById('lineChart'))  buildLine();
        if (document.getElementById('donutChart')) buildDonut();
    }

    rebuildCharts();

    /* ══════════════════════════════════════
       PILL TABS
    ══════════════════════════════════════ */
    document.querySelectorAll('.pill').forEach(btn => {
        btn.addEventListener('click', function () {
            this.closest('.pills').querySelectorAll('.pill').forEach(x => x.classList.remove('on'));
            this.classList.add('on');
        });
    });





    /* ══ NOTIFICATIONS LIVE ══ */
    let notifOpen = false;
    let lastOrderId = null;

    function toggleNotif() {
        notifOpen = !notifOpen;
        document.getElementById('notifDrop').classList.toggle('open', notifOpen);
        if (notifOpen) fetchNotifs();
    }

    document.addEventListener('click', function(e) {
        if (!document.getElementById('notifWrap').contains(e.target)) {
            notifOpen = false;
            document.getElementById('notifDrop').classList.remove('open');
        }
    });

    const STATUS_LABELS = {
        en_attente: 'En attente',
        confirme:   'Confirmé',
        expedie:    'Expédié',
        livre:      'Livré',
        annule:     'Annulé'
    };

    function timeAgo(dateStr) {
        const diff = Math.floor((Date.now() - new Date(dateStr)) / 1000);
        if (diff < 60)  return 'À l\'instant';
        if (diff < 3600) return Math.floor(diff / 60) + ' min';
        if (diff < 86400) return Math.floor(diff / 3600) + 'h';
        return Math.floor(diff / 86400) + 'j';
    }

    function fetchNotifs() {
        fetch('{{ Route("dash.notifications") }}')
            .then(r => r.json())
            .then(orders => {
                const list = document.getElementById('notifList');
                const dot  = document.getElementById('notifDot');
                const cnt  = document.getElementById('notifCount');

                if (!orders.length) {
                    list.innerHTML = '<div class="notif-empty">Aucune commande</div>';
                    return;
                }

                // Nouvelle commande détectée → faire clignoter le dot
                if (lastOrderId && orders[0].id !== lastOrderId) {
                    dot.style.animation = 'pulse 1s ease 3';
                }
                lastOrderId = orders[0].id;

                cnt.textContent = orders.length;

                list.innerHTML = orders.map(o => {
                    const statut = o.statut_commande || 'en_attente';
                    const label  = STATUS_LABELS[statut] || statut;
                    const cls    = 'ns-' + statut;
                    return `
                <div class="notif-item">
                    <div class="notif-ico"><i class="bi bi-receipt-cutoff"></i></div>
                    <div class="notif-body">
                        <div class="notif-name">
                            ${o.nom_client}
                            <span class="ns-badge ${cls}">${label}</span>
                        </div>
                        <div class="notif-meta">#${o.id} · ${timeAgo(o.created_at)}</div>
                    </div>
                    <div class="notif-amount">${parseFloat(o.montant_total).toLocaleString('fr-MA')} MAD</div>
                </div>`;
                }).join('');
            })
            .catch(() => {
                document.getElementById('notifList').innerHTML =
                    '<div class="notif-empty">Erreur de chargement</div>';
            });
    }

    /* Polling toutes les 30 secondes */
    fetchNotifs();
    setInterval(fetchNotifs, 30000);
</script>
</body>
</html>
