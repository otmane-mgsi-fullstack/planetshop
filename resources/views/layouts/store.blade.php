<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEXCORE — Gaming Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Rajdhani:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root{
            --void:#080b14;--midnight:#0e1220;--deep:#141926;--panel:#1a2030;
            --accent:#ff6b00;--accent-dim:rgba(255,107,0,.14);--accent-glow:rgba(255,107,0,.28);
            --red:#e63946;--violet:#6c3fc5;
            --ghost:#eef1f8;--text-dim:#5a6880;--text-mid:#8a9bb8;
            --border:rgba(255,255,255,.065);--border-acc:rgba(255,107,0,.3);
            --ff-d:'Orbitron',monospace;--ff-b:'Rajdhani',sans-serif;--r:10px;
        }
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        html{scroll-behavior:smooth}
        body{background:var(--void);color:var(--ghost);font-family:var(--ff-b);font-size:16px;line-height:1.6;overflow-x:hidden}
        ::selection{background:var(--accent);color:#000}
        ::-webkit-scrollbar{width:5px;background:var(--midnight)}
        ::-webkit-scrollbar-thumb{background:var(--panel);border-radius:3px}
        h1,h2,h3,h4{font-family:var(--ff-d);letter-spacing:.04em}
        a{text-decoration:none;color:inherit}

        /* SCROLL REVEAL */
        .reveal{opacity:0;transform:translateY(38px);transition:opacity .7s cubic-bezier(.22,1,.36,1),transform .7s cubic-bezier(.22,1,.36,1)}
        .reveal.in{opacity:1;transform:translateY(0)}
        .reveal-l{opacity:0;transform:translateX(-45px);transition:opacity .7s cubic-bezier(.22,1,.36,1),transform .7s cubic-bezier(.22,1,.36,1)}
        .reveal-l.in{opacity:1;transform:translateX(0)}
        .reveal-r{opacity:0;transform:translateX(45px);transition:opacity .7s cubic-bezier(.22,1,.36,1),transform .7s cubic-bezier(.22,1,.36,1)}
        .reveal-r.in{opacity:1;transform:translateX(0)}
        .d1{transition-delay:.1s}.d2{transition-delay:.2s}.d3{transition-delay:.32s}.d4{transition-delay:.44s}

        /* PROMO STRIP */
        .promo-strip{background:var(--accent);padding:.42rem 0;overflow:hidden}
        .ps{display:flex;gap:2.5rem;animation:scrollX 22s linear infinite;white-space:nowrap}
        @keyframes scrollX{from{transform:translateX(0)}to{transform:translateX(-50%)}}
        .pi{font-family:var(--ff-d);font-size:.58rem;font-weight:700;letter-spacing:.13em;color:#000;display:flex;align-items:center;gap:.45rem;flex-shrink:0}

        /* NAVBAR */
        .navbar{background:rgba(8,11,20,.93);backdrop-filter:blur(20px);border-bottom:1px solid var(--border);padding:.68rem 0;position:sticky;top:0;z-index:1000}
        .navbar-brand{font-family:var(--ff-d);font-size:1.42rem;font-weight:900;letter-spacing:.1em;color:var(--ghost)!important}
        .navbar-brand span{color:var(--accent)}
        .nav-link{font-family:var(--ff-b);font-weight:600;letter-spacing:.06em;font-size:.82rem;color:var(--text-mid)!important;text-transform:uppercase;padding:.38rem .72rem!important;transition:color .2s}
        .nav-link:hover,.nav-link.active{color:var(--accent)!important}
        .srch{position:relative}
        .si{position:absolute;left:.6rem;top:50%;transform:translateY(-50%);color:var(--text-dim);font-size:.82rem}
        .srch input{background:var(--deep);border:1px solid var(--border);border-radius:6px;color:var(--ghost);font-family:var(--ff-b);font-size:.82rem;padding:.33rem .8rem .33rem 2rem;width:205px;outline:none;transition:border-color .2s,box-shadow .2s}
        .srch input::placeholder{color:var(--text-dim)}
        .srch input:focus{border-color:var(--accent);box-shadow:0 0 0 3px var(--accent-dim)}
        .nico{color:var(--text-mid);font-size:1.08rem;margin-left:.85rem;transition:color .2s;position:relative}
        .nico:hover{color:var(--accent)}
        .cart-dot{position:absolute;top:-5px;right:-7px;background:var(--accent);color:#000;font-size:8px;font-weight:700;width:14px;height:14px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-family:var(--ff-d)}

        /* HERO */
        .hero{position:relative;min-height:100vh;display:flex;align-items:center;overflow:hidden;background:var(--void)}
        .hbg{position:absolute;inset:0;z-index:0}
        .hbg::before{content:'';position:absolute;inset:0;background-image:linear-gradient(rgba(255,107,0,.03) 1px,transparent 1px),linear-gradient(90deg,rgba(255,107,0,.03) 1px,transparent 1px);background-size:68px 68px;animation:gridD 24s linear infinite;transition:transform .1s ease-out}
        @keyframes gridD{from{background-position:0 0}to{background-position:68px 68px}}
        .hbg::after{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 58% 58% at 72% 50%,rgba(255,107,0,.09) 0%,transparent 70%),radial-gradient(ellipse 38% 48% at 10% 80%,rgba(108,63,197,.08) 0%,transparent 60%)}
        .hcontent{position:relative;z-index:2}
        .eyebrow{font-family:var(--ff-d);font-size:.62rem;letter-spacing:.28em;color:var(--accent);text-transform:uppercase;margin-bottom:1rem;display:flex;align-items:center;gap:.55rem}
        .eyebrow::before{content:'';display:block;width:26px;height:1px;background:var(--accent)}
        .htitle{font-size:clamp(2.1rem,5.5vw,4.2rem);font-weight:900;line-height:1.07;letter-spacing:.02em;margin-bottom:1.3rem}
        .htitle .acc{color:var(--accent)}
        .hsub{font-size:1.02rem;color:var(--text-mid);max-width:460px;margin-bottom:2rem;font-weight:500}
        .bta{font-family:var(--ff-d);font-size:.67rem;font-weight:700;letter-spacing:.13em;text-transform:uppercase;padding:.82rem 1.7rem;border-radius:7px;border:none;cursor:pointer;transition:all .25s;display:inline-flex;align-items:center;gap:.42rem}
        .bta-fill{background:var(--accent);color:#000}
        .bta-fill:hover{background:#ff8533;transform:translateY(-2px);box-shadow:0 8px 26px var(--accent-glow);color:#000}
        .bta-out{background:transparent;color:var(--accent);border:1.5px solid var(--accent)}
        .bta-out:hover{background:var(--accent-dim);transform:translateY(-2px);color:var(--accent)}
        .hstats{display:flex;gap:1.8rem;margin-top:2.8rem;padding-top:1.6rem;border-top:1px solid var(--border)}
        .sval{font-family:var(--ff-d);font-size:1.45rem;font-weight:700;color:var(--accent);line-height:1}
        .slbl{font-size:.68rem;color:var(--text-dim);letter-spacing:.07em;text-transform:uppercase;margin-top:.18rem}

        /* PARTICLE */
        .pt{position:absolute;border-radius:50%;animation:sparkle var(--dur,4s) ease-in-out infinite var(--del,0s)}
        @keyframes sparkle{0%,100%{opacity:0;transform:translateY(0) scale(0)}50%{opacity:1;transform:translateY(-28px) scale(1)}}

        /* PC BANNER */
        .pc-banner-container {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding-right: 2%;
            margin-left: 0%;
            overflow: visible;
        }
        .pc-anim {
            width: 110%;
            max-width: 900px;
            animation: floatPC 7s ease-in-out infinite;
            filter: drop-shadow(0 28px 55px rgba(255,107,0,.18)) drop-shadow(0 0 35px rgba(255,107,0,.07));
            transform-origin: center right;
        }
        .svg-banner { width: 100%; height: auto; display: flex; }
        @keyframes floatPC {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-25px) scale(1.02); }
        }
        @media (max-width: 991px) {
            .pc-banner-container { justify-content: center; padding-right: 0; }
            .pc-anim { width: 100%; margin-top: 50px; }
        }

        /* SECTION */
        .sec{padding:4.5rem 0}
        .sec-dark{background:var(--midnight)}
        .sec-base{background:var(--void)}
        .sec-dp{background:#0b0f1c}
        .sey{font-size:.6rem;letter-spacing:.22em;text-transform:uppercase;color:var(--accent);margin-bottom:.38rem}
        .stitle{font-size:1.45rem;font-weight:700;color:var(--ghost);margin:0}
        .shdr{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:1.8rem}
        .sa{font-family:var(--ff-d);font-size:.62rem;letter-spacing:.1em;color:var(--text-dim);text-transform:uppercase;display:flex;align-items:center;gap:.32rem;transition:color .2s}
        .sa:hover{color:var(--accent)}
        .gt{background:linear-gradient(90deg,var(--accent),#ff9a45);-webkit-background-clip:text;-webkit-text-fill-color:transparent}

        /* PILLS */
        .pills{display:flex;gap:.4rem;flex-wrap:wrap;margin-bottom:1.8rem}
        .pill{font-family:var(--ff-b);font-weight:600;font-size:.76rem;letter-spacing:.06em;text-transform:uppercase;padding:.38rem .95rem;border-radius:50px;border:1px solid var(--border);background:transparent;color:var(--text-dim);cursor:pointer;transition:all .2s}
        .pill:hover,.pill.active{border-color:var(--accent);color:var(--accent);background:var(--accent-dim)}

        /* PRODUCT CARD */
        .pcard{background:var(--midnight);border:1px solid var(--border);border-radius:var(--r);overflow:hidden;transition:transform .35s cubic-bezier(.22,1,.36,1),border-color .3s,box-shadow .3s;height:100%;display:flex;flex-direction:column;position:relative}
        .pcard:hover{transform:translateY(-7px);border-color:rgba(255,107,0,.25);box-shadow:0 22px 55px rgba(0,0,0,.44),0 0 28px rgba(255,107,0,.06)}
        .cimg{position:relative;background:var(--deep);padding:1.4rem;display:flex;align-items:center;justify-content:center;min-height:165px;overflow:hidden}
        .cimg::before{content:'';position:absolute;inset:0;background:radial-gradient(circle at 50% 110%,rgba(255,107,0,.07) 0%,transparent 62%)}
        .pemo{font-size:4.2rem;line-height:1;filter:drop-shadow(0 0 10px rgba(255,107,0,.22));position:relative;z-index:1;transition:transform .35s}
        .pcard:hover .pemo{transform:scale(1.07) rotate(-2deg)}
        .cbg{position:absolute;top:.65rem;left:.65rem;font-family:var(--ff-d);font-size:.57rem;font-weight:700;letter-spacing:.1em;padding:.2rem .58rem;border-radius:4px}
        .bnew{background:var(--violet);color:#ddd0ff}
        .bpromo{background:var(--red);color:#fff}
        .bhot{background:var(--accent);color:#000}
        .wbt{position:absolute;top:.65rem;right:.65rem;background:rgba(8,11,20,.75);border:1px solid var(--border);border-radius:6px;width:29px;height:29px;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .2s;color:var(--text-dim);font-size:.78rem}
        .wbt:hover{color:var(--red);border-color:var(--red)}
        .cbody{padding:.95rem 1.15rem 1.15rem;display:flex;flex-direction:column;flex:1}
        .ccat{font-size:.63rem;letter-spacing:.14em;text-transform:uppercase;color:var(--text-dim);margin-bottom:.25rem}
        .ctit{font-family:var(--ff-d);font-size:.86rem;font-weight:700;color:var(--ghost);line-height:1.3;margin-bottom:.6rem}
        .sps{display:flex;flex-direction:column;gap:3px;margin-bottom:.85rem}
        .sl{display:flex;gap:.32rem;align-items:center;font-size:.77rem;color:var(--text-dim)}
        .sd{width:3px;height:3px;border-radius:50%;background:var(--accent);flex-shrink:0}
        .pr{display:flex;align-items:baseline;justify-content:space-between;margin-top:auto;margin-bottom:.85rem}
        .price{font-family:var(--ff-d);font-size:1.12rem;font-weight:700;color:var(--accent)}
        .pold{font-size:.78rem;color:var(--text-dim);text-decoration:line-through;margin-left:.38rem}
        .psave{font-size:.68rem;color:var(--red);font-weight:700}
        .stars{color:#f59e0b;font-size:.67rem}
        .rc{font-size:.68rem;color:var(--text-dim)}
        .rat{display:flex;align-items:center;gap:.25rem;margin-bottom:.42rem}
        .badd{width:100%;background:transparent;border:1.5px solid var(--accent);color:var(--accent);font-family:var(--ff-d);font-size:.63rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;padding:.58rem;border-radius:6px;cursor:pointer;transition:all .25s;display:flex;align-items:center;justify-content:center;gap:.42rem}
        .badd:hover{background:var(--accent);color:#000;box-shadow:0 4px 18px var(--accent-glow)}

        /* FEATURED */
        .feat{background:linear-gradient(135deg,#0d1020,#111826 60%,#0e1320);border:1px solid rgba(255,107,0,.18);border-radius:14px;overflow:hidden;position:relative;padding:2.8rem 2.2rem}
        .feat::before{content:'';position:absolute;top:0;right:0;width:55%;height:100%;background:radial-gradient(ellipse at 85% 40%,rgba(255,107,0,.12) 0%,transparent 65%);pointer-events:none}
        .ftag{display:inline-flex;align-items:center;gap:.38rem;background:rgba(255,107,0,.12);border:1px solid rgba(255,107,0,.28);color:var(--accent);font-family:var(--ff-d);font-size:.58rem;letter-spacing:.15em;padding:.25rem .68rem;border-radius:50px;margin-bottom:.85rem}
        .stbl{width:100%}
        .stbl tr{border-bottom:1px solid var(--border)}
        .stbl tr:last-child{border-bottom:none}
        .stbl td{padding:.52rem 0;font-size:.84rem}
        .stbl td:first-child{color:var(--text-dim);width:44%}
        .stbl td .hi{color:var(--accent)}

        /* TRUST */
        .tcrd{background:var(--deep);border:1px solid var(--border);border-radius:var(--r);padding:1.35rem 1.1rem;text-align:center;transition:border-color .25s,transform .25s}
        .tcrd:hover{border-color:rgba(255,107,0,.2);transform:translateY(-3px)}
        .tico{font-size:1.55rem;color:var(--accent);margin-bottom:.6rem}
        .ttit{font-family:var(--ff-d);font-size:.7rem;font-weight:700;letter-spacing:.05em;color:var(--ghost);margin-bottom:.25rem}
        .tdesc{font-size:.76rem;color:var(--text-dim);line-height:1.45}

        /* BRAND */
        .bstrip{display:flex;align-items:center;justify-content:center;gap:1.8rem;flex-wrap:wrap;padding:1.3rem 0;border-top:1px solid var(--border);border-bottom:1px solid var(--border)}
        .blogo{font-family:var(--ff-d);font-size:.68rem;font-weight:700;letter-spacing:.15em;color:var(--text-dim);text-transform:uppercase;transition:color .2s;padding:.3rem .6rem}
        .blogo:hover{color:var(--accent)}

        /* NEWSLETTER */
        .nls{background:linear-gradient(135deg,var(--midnight),var(--deep));border:1px solid var(--border);border-radius:14px;padding:2.8rem 1.8rem;text-align:center;position:relative;overflow:hidden}
        .nls::before{content:'';position:absolute;top:-55%;left:50%;transform:translateX(-50%);width:340px;height:190px;background:radial-gradient(ellipse,rgba(255,107,0,.1) 0%,transparent 65%);pointer-events:none}
        .nlw{display:flex;gap:.48rem;max-width:390px;margin:0 auto}
        .nli{flex:1;background:var(--void);border:1px solid var(--border);border-radius:6px;color:var(--ghost);font-family:var(--ff-b);font-size:.88rem;padding:.62rem .95rem;outline:none;transition:border-color .2s}
        .nli:focus{border-color:var(--accent)}
        .nli::placeholder{color:var(--text-dim)}

        /* FOOTER */
        footer{background:#050810;border-top:1px solid var(--border);padding:2.8rem 0 1.3rem}
        .ftbr{font-family:var(--ff-d);font-size:1.22rem;font-weight:900;letter-spacing:.1em;margin-bottom:.6rem}
        .ftbr span{color:var(--accent)}
        .ftdesc{font-size:.82rem;color:var(--text-dim);max-width:220px;line-height:1.6}
        .fthdr{font-family:var(--ff-d);font-size:.63rem;letter-spacing:.2em;text-transform:uppercase;color:var(--accent);margin-bottom:.85rem}
        .ftl{list-style:none;padding:0;margin:0}
        .ftl li{margin-bottom:.42rem}
        .ftl a{font-size:.82rem;color:var(--text-dim);transition:color .2s}
        .ftl a:hover{color:var(--ghost)}
        .ftbot{margin-top:1.8rem;padding-top:1.3rem;border-top:1px solid var(--border);display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:.7rem}
        .ftcp{font-size:.73rem;color:var(--text-dim)}
        .socs{display:flex;gap:.55rem}
        .sb{width:33px;height:33px;border:1px solid var(--border);border-radius:7px;display:flex;align-items:center;justify-content:center;color:var(--text-dim);font-size:.82rem;transition:all .2s}
        .sb:hover{border-color:var(--accent);color:var(--accent)}
        .pchip{background:var(--deep);border:1px solid var(--border);border-radius:5px;padding:.25rem .52rem;font-size:.68rem;color:var(--text-mid)}

        @media(max-width:768px){.hero{min-height:auto;padding:3.5rem 0}.hstats{gap:1.1rem}.pc-wrap{margin-top:2.2rem}.nlw{flex-direction:column}}
    </style>
    @stack('styles')
</head>
<body>

<!-- PROMO STRIP -->
<div class="promo-strip">
    <div class="ps">
        <span class="pi"><i class="bi bi-lightning-charge-fill"></i> LIVRAISON GRATUITE dès 299€</span>
        <span class="pi"><i class="bi bi-shield-check-fill"></i> Garantie 3 ans incluse</span>
        <span class="pi"><i class="bi bi-cpu-fill"></i> PC assemblé & testé en France</span>
        <span class="pi"><i class="bi bi-headset"></i> Support 7j/7</span>
        <span class="pi"><i class="bi bi-arrow-repeat"></i> Retours 30 jours</span>
        <span class="pi"><i class="bi bi-lightning-charge-fill"></i> LIVRAISON GRATUITE dès 299€</span>
        <span class="pi"><i class="bi bi-shield-check-fill"></i> Garantie 3 ans incluse</span>
        <span class="pi"><i class="bi bi-cpu-fill"></i> PC assemblé & testé en France</span>
        <span class="pi"><i class="bi bi-headset"></i> Support 7j/7</span>
        <span class="pi"><i class="bi bi-arrow-repeat"></i> Retours 30 jours</span>
    </div>
</div>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}"><span>NEX</span>CORE</a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navM" style="color:var(--text-mid)">
            <i class="bi bi-list" style="font-size:1.5rem"></i>
        </button>
        <div class="collapse navbar-collapse" id="navM">
            <ul class="navbar-nav mx-auto gap-1">
                <li><a class="nav-link active" href="{{ url('/') }}">Accueil</a></li>
                <li><a class="nav-link" href="#shop">PCs Gaming</a></li>
                <li><a class="nav-link" href="#">Composants</a></li>
                <li><a class="nav-link" href="#">Périphériques</a></li>
                <li><a class="nav-link" href="#">Configurateur</a></li>
                <li><a class="nav-link" href="#">Promo</a></li>
            </ul>
            <div class="d-flex align-items-center gap-3">
                <div class="srch d-none d-lg-block">
                    <i class="bi bi-search si"></i>
                    <input type="text" placeholder="Rechercher...">
                </div>
            <!--    <div class="d-flex">
                    <a class="nico" href="#"><i class="bi bi-person"></i></a>
                    <a class="nico" href="#"><i class="bi bi-heart"></i></a>
                    <a class="nico" href="#" style="position:relative"><i class="bi bi-bag"></i><span class="cart-dot" id="ccount">3</span></a>
                </div> -->
                <div class="d-flex flex-wrap gap-3 reveal d3">
                    <a href="{{Route('login')}}" class="bta bta-out"><i class="bi bi-sliders"></i> S'inscrire</a>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="s-link border-0 bg-transparent text-start w-100 " style="background-color: white">
                        <i class="bi bi-box-arrow-right"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

@yield('content')

<!-- FOOTER -->
<footer><div class="container">
        <div class="row gy-4">
            <div class="col-lg-4">
                <div class="ftbr"><span>NEX</span>CORE</div>
                <p class="ftdesc">PCs gaming assemblés en France par des passionnés. Performance, fiabilité, style.</p>
                <div class="socs mt-3">
                    <a class="sb" href="#"><i class="bi bi-twitter-x"></i></a><a class="sb" href="#"><i class="bi bi-twitch"></i></a><a class="sb" href="#"><i class="bi bi-youtube"></i></a><a class="sb" href="#"><i class="bi bi-discord"></i></a><a class="sb" href="#"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
            <div class="col-6 col-lg-2"><div class="fthdr">Store</div><ul class="ftl"><li><a href="#">PCs Gaming</a></li><li><a href="#">Composants</a></li><li><a href="#">Périphériques</a></li><li><a href="#">Promotions</a></li><li><a href="#">Nouveautés</a></li></ul></div>
            <div class="col-6 col-lg-2"><div class="fthdr">Services</div><ul class="ftl"><li><a href="#">Configurateur</a></li><li><a href="#">SAV & Garantie</a></li><li><a href="#">Financement</a></li><li><a href="#">Pro & Entreprise</a></li></ul></div>
            <div class="col-6 col-lg-2"><div class="fthdr">Aide</div><ul class="ftl"><li><a href="#">Mon compte</a></li><li><a href="#">Suivi commande</a></li><li><a href="#">Retours</a></li><li><a href="#">FAQ</a></li><li><a href="#">Contact</a></li></ul></div>
            <div class="col-6 col-lg-2"><div class="fthdr">Paiement</div><div style="display:flex;flex-wrap:wrap;gap:5px"><span class="pchip">VISA</span><span class="pchip">Mastercard</span><span class="pchip">PayPal</span><span class="pchip">Apple Pay</span><span class="pchip">3× sans frais</span></div></div>
        </div>
        <div class="ftbot"><span class="ftcp">© 2025 NexCore SAS · Tous droits réservés · Mentions légales · CGV</span><span class="ftcp">Fait avec ⚡ en France</span></div>
    </div></footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
