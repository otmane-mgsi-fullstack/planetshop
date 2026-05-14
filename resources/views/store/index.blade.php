@extends('layouts.store')

@section('content')

    <!-- HERO -->
    <section class="hero">
        <div class="hbg" id="hbg"></div>

        <!-- floating particles -->
        <div class="pt" style="width:5px;height:5px;background:var(--accent);left:14%;top:72%;--dur:4s;--del:0s;position:absolute"></div>
        <div class="pt" style="width:3px;height:3px;background:#ff9a45;left:24%;top:56%;--dur:5.5s;--del:1s;position:absolute"></div>
        <div class="pt" style="width:4px;height:4px;background:var(--accent);left:79%;top:64%;--dur:3.8s;--del:.5s;position:absolute"></div>
        <div class="pt" style="width:3px;height:3px;background:#ffb347;left:87%;top:38%;--dur:5s;--del:1.5s;position:absolute"></div>
        <div class="pt" style="width:5px;height:5px;background:#6c3fc5;opacity:.5;left:58%;top:20%;--dur:6s;--del:.3s;position:absolute"></div>

        <div class="container py-5">
            <div class="row align-items-center gy-5">

                <!-- LEFT -->
                <div class="col-lg-5 hcontent">
                    <div class="eyebrow reveal">Collection 2025</div>
                    <h1 class="htitle reveal d1">Domine<br>le <span class="acc">jeu.</span><br>Dominez tout.</h1>
                    <p class="hsub reveal d2">PCs gaming ultra-performants, assemblés à la main en France. GPU RTX dernière génération. Livraison express 48h.</p>
                    <div class="d-flex flex-wrap gap-3 reveal d3">
                        <a href="#shop" class="bta bta-fill"><i class="bi bi-grid-fill"></i> Explorer le store</a>
                        <a href="{{Route('login')}}" class="bta bta-out"><i class="bi bi-sliders"></i> S'inscrire</a>
                    </div>
                    <div class="hstats reveal d4">
                        <div><div class="sval" id="cnt">+0</div><div class="slbl">Clients</div></div>
                        <div><div class="sval">4.9★</div><div class="slbl">Note</div></div>
                        <div><div class="sval">48H</div><div class="slbl">Livraison</div></div>
                    </div>
                </div>

                <!-- RIGHT — SVG PC BANNER -->
                <div class="col-lg-7 pc-banner-container p-0 reveal-r d1">
                    <div class="pc-anim ">
                        <svg viewBox="0 0 620 490" xmlns="http://www.w3.org/2000/svg" style="width:80%;">
                            <defs>
                                <linearGradient id="tg" x1="0" y1="0" x2="1" y2="1"><stop offset="0%" stop-color="#1e2535"/><stop offset="100%" stop-color="#0f1420"/></linearGradient>
                                <linearGradient id="gg" x1="0" y1="0" x2="1" y2="1"><stop offset="0%" stop-color="#232b3e" stop-opacity=".9"/><stop offset="100%" stop-color="#131824" stop-opacity=".95"/></linearGradient>
                                <linearGradient id="sg" x1="0" y1="0" x2="0" y2="1"><stop offset="0%" stop-color="#0f1b2e"/><stop offset="100%" stop-color="#080d18"/></linearGradient>
                                <linearGradient id="rgb" x1="0" y1="0" x2="1" y2="0"><stop offset="0%" stop-color="#ff2d55"/><stop offset="33%" stop-color="#ff6b00"/><stop offset="66%" stop-color="#6c3fc5"/><stop offset="100%" stop-color="#ff6b00"/></linearGradient>
                                <linearGradient id="al" x1="0" y1="0" x2="1" y2="0"><stop offset="0%" stop-color="#ff6b00" stop-opacity="0"/><stop offset="40%" stop-color="#ff6b00"/><stop offset="100%" stop-color="#ff6b00" stop-opacity="0"/></linearGradient>
                                <radialGradient id="go" cx="50%" cy="50%" r="50%"><stop offset="0%" stop-color="#ff6b00" stop-opacity=".2"/><stop offset="100%" stop-color="#ff6b00" stop-opacity="0"/></radialGradient>
                                <filter id="glow"><feGaussianBlur stdDeviation="3" result="b"/><feMerge><feMergeNode in="b"/><feMergeNode in="SourceGraphic"/></feMerge></filter>
                                <clipPath id="sc"><rect x="28" y="36" width="344" height="200" rx="6"/></clipPath>
                            </defs>

                            <!-- floor shadow -->
                            <ellipse cx="310" cy="478" rx="245" ry="13" fill="#000" opacity=".4"/>

                            <!-- glow orb behind tower -->
                            <ellipse cx="320" cy="260" rx="130" ry="160" fill="url(#go)"/>

                            <!-- ===== MONITOR ===== -->
                            <g transform="translate(18,42)">
                                <!-- Stand -->
                                <rect x="145" y="248" width="110" height="10" rx="5" fill="#1a2030"/>
                                <rect x="191" y="240" width="18" height="12" rx="3" fill="#1a2030"/>
                                <!-- Shell -->
                                <rect x="20" y="28" width="360" height="220" rx="14" fill="#141924" stroke="#2a3348" stroke-width="1.5"/>
                                <!-- Screen bg -->
                                <rect x="28" y="36" width="344" height="200" rx="6" fill="url(#sg)"/>
                                <!-- Screen content -->
                                <g clip-path="url(#sc)">
                                    <rect x="28" y="36" width="344" height="200" fill="#05090f"/>
                                    <!-- horizon glow -->
                                    <ellipse cx="200" cy="145" rx="185" ry="65" fill="#ff6b00" opacity=".05"/>
                                    <!-- perspective grid floor -->
                                    <line x1="28" y1="195" x2="372" y2="195" stroke="#ff6b00" stroke-width=".5" opacity=".3"/>
                                    <line x1="28" y1="210" x2="372" y2="210" stroke="#ff6b00" stroke-width=".35" opacity=".2"/>
                                    <line x1="28" y1="225" x2="372" y2="225" stroke="#ff6b00" stroke-width=".25" opacity=".15"/>
                                    <line x1="200" y1="128" x2="28" y2="236" stroke="#ff6b00" stroke-width=".4" opacity=".18"/>
                                    <line x1="200" y1="128" x2="115" y2="236" stroke="#ff6b00" stroke-width=".3" opacity=".14"/>
                                    <line x1="200" y1="128" x2="280" y2="236" stroke="#ff6b00" stroke-width=".3" opacity=".14"/>
                                    <line x1="200" y1="128" x2="372" y2="236" stroke="#ff6b00" stroke-width=".4" opacity=".18"/>
                                    <!-- stars -->
                                    <circle cx="78" cy="58" r="1" fill="#fff" opacity=".55"/>
                                    <circle cx="148" cy="44" r=".8" fill="#fff" opacity=".4"/>
                                    <circle cx="255" cy="54" r="1" fill="#fff" opacity=".48"/>
                                    <circle cx="318" cy="68" r=".8" fill="#fff" opacity=".35"/>
                                    <circle cx="52" cy="88" r=".6" fill="#fff" opacity=".5"/>
                                    <circle cx="338" cy="48" r=".7" fill="#fff" opacity=".42"/>
                                    <circle cx="190" cy="70" r=".5" fill="#fff" opacity=".3"/>
                                    <!-- Stylised ship/character -->
                                    <g transform="translate(175,82)">
                                        <polygon points="25,-18 0,20 50,20" fill="none" stroke="#ff6b00" stroke-width="1.5" opacity=".88" filter="url(#glow)"/>
                                        <polygon points="25,-10 8,14 42,14" fill="#ff6b00" opacity=".12"/>
                                        <line x1="25" y1="-18" x2="25" y2="-28" stroke="#ff6b00" stroke-width="1" opacity=".65"/>
                                        <circle cx="25" cy="2" r="3" fill="#ff6b00" opacity=".78" filter="url(#glow)"/>
                                        <line x1="18" y1="20" x2="13" y2="31" stroke="#ff6b00" stroke-width="1.5" stroke-linecap="round" opacity=".45"/>
                                        <line x1="25" y1="20" x2="25" y2="34" stroke="#ff8533" stroke-width="2.2" stroke-linecap="round" opacity=".65"/>
                                        <line x1="32" y1="20" x2="37" y2="31" stroke="#ff6b00" stroke-width="1.5" stroke-linecap="round" opacity=".45"/>
                                    </g>
                                    <!-- HUD -->
                                    <text x="42" y="60" font-family="Orbitron,monospace" font-size="11" font-weight="700" fill="#ff6b00" opacity=".9">240 FPS</text>
                                    <text x="42" y="73" font-family="Orbitron,monospace" font-size="7" fill="#ff6b00" opacity=".5">ULTRA · 4K</text>
                                    <!-- health bar -->
                                    <rect x="284" y="53" width="70" height="5" rx="2" fill="#1a2030"/>
                                    <rect x="284" y="53" width="56" height="5" rx="2" fill="#ff6b00" opacity=".78"/>
                                    <text x="284" y="49" font-family="Orbitron,monospace" font-size="7" fill="#ff6b00" opacity=".5">HP</text>
                                    <!-- crosshair -->
                                    <g opacity=".38" transform="translate(295,150)">
                                        <line x1="-10" y1="0" x2="10" y2="0" stroke="#ff6b00" stroke-width="1"/>
                                        <line x1="0" y1="-10" x2="0" y2="10" stroke="#ff6b00" stroke-width="1"/>
                                        <circle cx="0" cy="0" r="6" fill="none" stroke="#ff6b00" stroke-width=".8"/>
                                    </g>
                                </g>
                                <!-- power LED -->
                                <circle cx="200" cy="253" r="2.5" fill="#ff6b00" opacity=".88" filter="url(#glow)"><animate attributeName="opacity" values=".88;.4;.88" dur="2.5s" repeatCount="indefinite"/></circle>
                                <!-- glow reflection -->
                                <ellipse cx="200" cy="254" rx="90" ry="7" fill="#ff6b00" opacity=".04"/>
                            </g>

                            <!-- ===== PC TOWER ===== -->
                            <g transform="translate(422,80)">
                                <rect x="0" y="0" width="124" height="340" rx="10" fill="url(#tg)" stroke="#2a3448" stroke-width="1.5"/>
                                <!-- top bar -->
                                <rect x="0" y="0" width="124" height="5" rx="3" fill="#ff6b00" opacity=".88"/>
                                <!-- glass panel -->
                                <rect x="8" y="18" width="66" height="304" rx="6" fill="url(#gg)" stroke="#2d3650" stroke-width=".8"/>
                                <!-- FAN 1 -->
                                <g transform="translate(41,62)">
                                    <circle cx="0" cy="0" r="23" fill="#1a2235" stroke="#2d3a55" stroke-width=".8"/>
                                    <circle cx="0" cy="0" r="17" fill="none" stroke="url(#rgb)" stroke-width="3" opacity=".72" filter="url(#glow)"><animateTransform attributeName="transform" type="rotate" from="0" to="360" dur="2s" repeatCount="indefinite"/></circle>
                                    <circle cx="0" cy="0" r="10" fill="#141924" stroke="#2d3a55" stroke-width=".6"/>
                                    <circle cx="0" cy="0" r="3.5" fill="#ff6b00" opacity=".65"/>
                                    <g opacity=".28"><line x1="0" y1="-17" x2="0" y2="17" stroke="#5a6880" stroke-width="1.5"/><line x1="-17" y1="0" x2="17" y2="0" stroke="#5a6880" stroke-width="1.5"/><line x1="-12" y1="-12" x2="12" y2="12" stroke="#5a6880" stroke-width="1.1"/><line x1="12" y1="-12" x2="-12" y2="12" stroke="#5a6880" stroke-width="1.1"/></g>
                                </g>
                                <!-- FAN 2 -->
                                <g transform="translate(41,155)">
                                    <circle cx="0" cy="0" r="23" fill="#1a2235" stroke="#2d3a55" stroke-width=".8"/>
                                    <circle cx="0" cy="0" r="17" fill="none" stroke="url(#rgb)" stroke-width="3" opacity=".68" filter="url(#glow)"><animateTransform attributeName="transform" type="rotate" from="360" to="0" dur="2.2s" repeatCount="indefinite"/></circle>
                                    <circle cx="0" cy="0" r="10" fill="#141924" stroke="#2d3a55" stroke-width=".6"/>
                                    <circle cx="0" cy="0" r="3.5" fill="#ff6b00" opacity=".6"/>
                                    <g opacity=".28"><line x1="0" y1="-17" x2="0" y2="17" stroke="#5a6880" stroke-width="1.5"/><line x1="-17" y1="0" x2="17" y2="0" stroke="#5a6880" stroke-width="1.5"/><line x1="-12" y1="-12" x2="12" y2="12" stroke="#5a6880" stroke-width="1.1"/><line x1="12" y1="-12" x2="-12" y2="12" stroke="#5a6880" stroke-width="1.1"/></g>
                                </g>
                                <!-- FAN 3 -->
                                <g transform="translate(41,248)">
                                    <circle cx="0" cy="0" r="23" fill="#1a2235" stroke="#2d3a55" stroke-width=".8"/>
                                    <circle cx="0" cy="0" r="17" fill="none" stroke="url(#rgb)" stroke-width="3" opacity=".62" filter="url(#glow)"><animateTransform attributeName="transform" type="rotate" from="0" to="360" dur="1.8s" repeatCount="indefinite"/></circle>
                                    <circle cx="0" cy="0" r="10" fill="#141924" stroke="#2d3a55" stroke-width=".6"/>
                                    <circle cx="0" cy="0" r="3.5" fill="#ff6b00" opacity=".55"/>
                                    <g opacity=".28"><line x1="0" y1="-17" x2="0" y2="17" stroke="#5a6880" stroke-width="1.5"/><line x1="-17" y1="0" x2="17" y2="0" stroke="#5a6880" stroke-width="1.5"/><line x1="-12" y1="-12" x2="12" y2="12" stroke="#5a6880" stroke-width="1.1"/><line x1="12" y1="-12" x2="-12" y2="12" stroke="#5a6880" stroke-width="1.1"/></g>
                                </g>
                                <!-- power button -->
                                <circle cx="99" cy="22" r="7" fill="#1a2235" stroke="#2d3a55" stroke-width=".8"/>
                                <circle cx="99" cy="22" r="4" fill="#ff6b00" opacity=".85" filter="url(#glow)"><animate attributeName="opacity" values=".85;.4;.85" dur="2.5s" repeatCount="indefinite"/></circle>
                                <!-- IO ports -->
                                <rect x="83" y="40" width="32" height="6" rx="2" fill="#111824" stroke="#2d3a55" stroke-width=".6"/>
                                <rect x="83" y="50" width="32" height="6" rx="2" fill="#111824" stroke="#2d3a55" stroke-width=".6"/>
                                <rect x="83" y="62" width="14" height="9" rx="2" fill="#111824" stroke="#2d3a55" stroke-width=".6"/>
                                <rect x="101" y="62" width="14" height="9" rx="2" fill="#111824" stroke="#2d3a55" stroke-width=".6"/>
                                <!-- vents -->
                                <g opacity=".38"><line x1="82" y1="280" x2="114" y2="280" stroke="#3a4560" stroke-width=".8"/><line x1="82" y1="286" x2="114" y2="286" stroke="#3a4560" stroke-width=".8"/><line x1="82" y1="292" x2="114" y2="292" stroke="#3a4560" stroke-width=".8"/><line x1="82" y1="298" x2="114" y2="298" stroke="#3a4560" stroke-width=".8"/><line x1="82" y1="304" x2="114" y2="304" stroke="#3a4560" stroke-width=".8"/><line x1="82" y1="310" x2="114" y2="310" stroke="#3a4560" stroke-width=".8"/></g>
                                <!-- RGB bottom -->
                                <rect x="5" y="330" width="114" height="4" rx="2" fill="url(#rgb)" opacity=".78" filter="url(#glow)"><animate attributeName="opacity" values=".78;.45;.78" dur="3s" repeatCount="indefinite"/></rect>
                                <!-- brand -->
                                <text x="62" y="173" text-anchor="middle" font-family="Orbitron,monospace" font-size="7" font-weight="700" fill="#ff6b00" opacity=".45" letter-spacing="2">NEXCORE</text>
                            </g>

                            <!-- ===== KEYBOARD ===== -->
                            <g transform="translate(28,400)">
                                <rect x="0" y="0" width="372" height="56" rx="7" fill="#141924" stroke="#2a3448" stroke-width="1"/>
                                <g fill="#1e2840" stroke="#2d3a55" stroke-width=".5">
                                    <rect x="8" y="8" width="20" height="14" rx="3"/><rect x="32" y="8" width="20" height="14" rx="3"/><rect x="56" y="8" width="20" height="14" rx="3"/><rect x="80" y="8" width="20" height="14" rx="3"/><rect x="104" y="8" width="20" height="14" rx="3"/><rect x="128" y="8" width="20" height="14" rx="3"/><rect x="152" y="8" width="20" height="14" rx="3"/><rect x="176" y="8" width="20" height="14" rx="3"/><rect x="200" y="8" width="20" height="14" rx="3"/><rect x="224" y="8" width="20" height="14" rx="3"/><rect x="248" y="8" width="20" height="14" rx="3"/><rect x="272" y="8" width="20" height="14" rx="3"/><rect x="296" y="8" width="20" height="14" rx="3"/><rect x="320" y="8" width="44" height="14" rx="3"/>
                                    <!-- row 2 with WASD orange highlight -->
                                    <rect x="8" y="26" width="30" height="14" rx="3" fill="#ff6b00" opacity=".88"/>
                                    <rect x="42" y="26" width="20" height="14" rx="3"/><rect x="66" y="26" width="20" height="14" rx="3" fill="#ff6b00" opacity=".55"/><rect x="90" y="26" width="20" height="14" rx="3"/><rect x="114" y="26" width="20" height="14" rx="3" fill="#ff6b00" opacity=".55"/><rect x="138" y="26" width="20" height="14" rx="3"/><rect x="162" y="26" width="20" height="14" rx="3"/><rect x="186" y="26" width="20" height="14" rx="3"/><rect x="210" y="26" width="20" height="14" rx="3"/><rect x="234" y="26" width="20" height="14" rx="3"/><rect x="258" y="26" width="20" height="14" rx="3"/><rect x="282" y="26" width="82" height="14" rx="3"/>
                                    <!-- row 3 -->
                                    <rect x="8" y="38" width="22" height="12" rx="3"/><rect x="34" y="38" width="22" height="12" rx="3"/><rect x="60" y="38" width="112" height="12" rx="3"/><rect x="176" y="38" width="62" height="12" rx="3"/><rect x="242" y="38" width="52" height="12" rx="3"/><rect x="298" y="38" width="20" height="12" rx="3"/><rect x="322" y="38" width="20" height="12" rx="3"/><rect x="346" y="38" width="22" height="12" rx="3"/>
                                </g>
                                <rect x="0" y="52" width="372" height="2" rx="1" fill="url(#al)" opacity=".55"><animate attributeName="opacity" values=".55;.25;.55" dur="2s" repeatCount="indefinite"/></rect>
                            </g>

                            <!-- MOUSE -->
                            <g transform="translate(422,400)">
                                <rect x="0" y="0" width="60" height="78" rx="18" fill="#141924" stroke="#2a3448" stroke-width="1"/>
                                <rect x="23" y="14" width="14" height="22" rx="7" fill="#1e2840" stroke="#2d3a55" stroke-width=".7"/>
                                <rect x="27" y="17" width="6" height="16" rx="3" fill="#ff6b00" opacity=".48"/>
                                <line x1="30" y1="0" x2="30" y2="40" stroke="#2d3a55" stroke-width=".8"/>
                                <rect x="23" y="41" width="14" height="7" rx="3" fill="#1a2235" stroke="#2d3a55" stroke-width=".5"/>
                                <ellipse cx="30" cy="76" rx="18" ry="4" fill="#ff6b00" opacity=".2" filter="url(#glow)"/>
                            </g>

                            <!-- ===== Floating spec tags ===== -->
                            <g>
                                <g opacity=".92"><rect x="28" y="68" width="92" height="30" rx="8" fill="#1a2030" stroke="#ff6b00" stroke-width=".8" stroke-opacity=".38"/><text x="38" y="79" font-family="Orbitron,monospace" font-size="6" fill="#ff6b00" opacity=".6">GPU</text><text x="38" y="91" font-family="Orbitron,monospace" font-size="8" font-weight="700" fill="#eef1f8">RTX 5090</text><animateTransform attributeName="transform" additive="sum" type="translate" values="0,0;0,-5;0,0" dur="5s" repeatCount="indefinite"/></g>
                                <g opacity=".88"><rect x="28" y="112" width="98" height="30" rx="8" fill="#1a2030" stroke="#6c3fc5" stroke-width=".8" stroke-opacity=".38"/><text x="38" y="123" font-family="Orbitron,monospace" font-size="6" fill="#a78bfa" opacity=".6">RAM</text><text x="38" y="135" font-family="Orbitron,monospace" font-size="8" font-weight="700" fill="#eef1f8">64 Go DDR5</text><animateTransform attributeName="transform" additive="sum" type="translate" values="0,0;0,-4;0,0" dur="6.5s" repeatCount="indefinite"/></g>
                                <g opacity=".84"><rect x="28" y="156" width="92" height="30" rx="8" fill="#1a2030" stroke="#ff6b00" stroke-width=".8" stroke-opacity=".3"/><text x="38" y="167" font-family="Orbitron,monospace" font-size="6" fill="#ff6b00" opacity=".55">CPU</text><text x="38" y="179" font-family="Orbitron,monospace" font-size="8" font-weight="700" fill="#eef1f8">i9-15900K</text><animateTransform attributeName="transform" additive="sum" type="translate" values="0,0;0,-6;0,0" dur="4.5s" repeatCount="indefinite"/></g>
                            </g>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BRAND STRIP -->
    <div style="background:var(--midnight)"><div class="container"><div class="bstrip">
                <span class="blogo">NVIDIA</span><span class="blogo">Intel</span><span class="blogo">AMD</span>
                <span class="blogo">ASUS ROG</span><span class="blogo">Corsair</span><span class="blogo">NZXT</span><span class="blogo">Samsung</span>
            </div></div></div>

    <!-- SHOP -->
    <section class="sec sec-base" id="shop">
        <div class="container">
            <div class="shdr reveal"><div><div class="sey">Catalogue</div><h2 class="stitle">PCs Gaming <span class="gt">Bestsellers</span></h2></div><a href="#" class="sa">Tout voir <i class="bi bi-arrow-right"></i></a></div>
            <div class="pills reveal d1">
                <button class="pill active">Tous</button>
                @if(isset($categories) && $categories->count() > 0)
                    @foreach($categories as $category)
                        <button class="pill">{{ $category->nom ?? $category->name ?? 'Catégorie' }}</button>
                    @endforeach
                @else
                    <button class="pill">Entrée de gamme</button><button class="pill">1080p Max</button><button class="pill">1440p Gaming</button><button class="pill">4K Ultra</button><button class="pill">Streaming</button>
                @endif
            </div>
            <div class="row g-4">
                @if(isset($products) && $products->count() > 0)
                    @foreach($products as $index => $product)
                        @php $delay = ($index % 4) + 1; @endphp
                        <div class="col-sm-6 col-lg-3 reveal d{{ $delay }}">
                            <div class="pcard" {{ isset($product->is_featured) && $product->is_featured ? 'style="border-color:rgba(255,107,0,.22)"' : '' }}>
                                <div class="cimg">
                                    @if(isset($product->is_new) && $product->is_new)
                                        <span class="cbg bnew">NOUVEAU</span>
                                    @elseif(isset($product->prix_promo))
                                        <span class="cbg bpromo">PROMO</span>
                                    @endif
                                    <button class="wbt"><i class="bi bi-heart"></i></button>
                                    <div class="pemo">
                                        <img src="{{ isset($product->miniature) && $product->miniature ? asset('storage/'.$product->miniature) : asset('R.png') }}" height="150px" width="170px" style="margin-top: 8%; object-fit: contain;">
                                    </div>
                                </div>
                                <div class="cbody">
                                    <div class="ccat">{{ $product->category->nom ?? $product->category->name ?? 'Catégorie' }}</div>
                                    <div class="ctit">{{ $product->nom ?? 'Produit' }}</div>

                                    <div class="sps">
                                        @if(isset($product->specifications) && is_array($product->specifications))
                                            @foreach($product->specifications as $spec)
                                                <div class="sl"><span class="sd"></span>{{ $spec }}</div>
                                            @endforeach
                                        @else
                                            <div class="sl"><span class="sd"></span>Haute performance</div>
                                        @endif
                                    </div>

                                    <div class="pr">
                                        @if(isset($product->prix_promo))
                                            <div>
                                                <span class="price">{{ number_format($product->prix_promo, 2, ',', ' ') }} MAD</span>
                                                <span class="pold">{{ number_format($product->prix ?? 0, 2, ',', ' ') }} MAD</span>
                                            </div>
                                            @if($product->prix > 0)
                                                <span class="psave">−{{ round((1 - ($product->prix_promo / $product->prix)) * 100) }}%</span>
                                            @endif
                                        @else
                                            <span class="price">{{ number_format($product->prix ?? 0, 2, ',', ' ') }} MAD</span>
                                        @endif

                                        @if(isset($product->stock) && $product->stock > 0)
                                            <span style="font-size:.65rem;background:rgba(74,222,128,.1);color:#4ade80;border:1px solid rgba(74,222,128,.25);padding:.13rem .48rem;border-radius:4px">En stock</span>
                                        @else
                                            <span style="font-size:.66rem;color:var(--text-dim)">Sur commande</span>
                                        @endif
                                    </div>
                                    <button class="badd" {{ isset($product->is_featured) && $product->is_featured ?
                                        'style="background:var(--accent);color:#000;border-color:var(--accent)"' : '' }}>
                                        <a href="{{ route('product.show', $product->slug) }}"><i class="bi bi-bag-plus"></i>Voir le produit</a> </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-sm-6 col-lg-3 reveal d1">
                        <div class="pcard">
                            <div class="cimg"><span class="cbg bnew">NOUVEAU</span><button class="wbt"><i class="bi bi-heart"></i></button><div class="pemo"><img src="{{ asset('R.png') }}" height="150px" width="170px" style="margin-top: 8%;"></div></div>
                            <div class="cbody">
                                <div class="ccat">PC Tower · 4K Ultra</div><div class="ctit">NexCore TITAN X Pro</div>
                                <div class="sps"><div class="sl"><span class="sd"></span>RTX 5090 24 Go</div><div class="sl"><span class="sd"></span>Intel i9-15900K</div><div class="sl"><span class="sd"></span>64 Go DDR5 6000 MHz</div><div class="sl"><span class="sd"></span>2 To SSD NVMe Gen5</div></div>
                                <div class="pr"><div><span class="price">3 499 MAD</span><span class="pold">3 899 MAD</span></div><span class="psave">−10%</span></div>
                                <button class="badd"><i class="bi bi-bag-plus"></i> Ajouter</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 reveal d2">
                        <div class="pcard" style="border-color:rgba(255,107,0,.22)">
                            <div class="cimg"><span class="cbg bnew">NOUVEAU</span><button class="wbt"><i class="bi bi-heart"></i></button><div class="pemo"><img src="{{ asset('R.png') }}" height="150px" width="170px" style="margin-top: 8%;"></div></div>
                            <div class="cbody">
                                <div class="ccat">PC Tour · 1440p Gaming</div><div class="ctit">NexCore PHANTOM Elite</div>
                                <div class="sps"><div class="sl"><span class="sd"></span>RTX 4080 Super 16 Go</div><div class="sl"><span class="sd"></span>AMD Ryzen 9 9900X</div><div class="sl"><span class="sd"></span>32 Go DDR5 5600 MHz</div><div class="sl"><span class="sd"></span>1 To SSD NVMe Gen4</div></div>
                                <div class="pr"><span class="price">2 199 MAD</span><span style="font-size:.65rem;background:rgba(74,222,128,.1);color:#4ade80;border:1px solid rgba(74,222,128,.25);padding:.13rem .48rem;border-radius:4px">En stock</span></div>
                                <button class="badd" style="background:var(--accent);color:#000;border-color:var(--accent)"><i class="bi bi-bag-plus"></i> Ajouter</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 reveal d3">
                        <div class="pcard">
                            <div class="cimg"><span class="cbg bnew">NOUVEAU</span><button class="wbt"><i class="bi bi-heart"></i></button><div class="pemo"><img src="{{ asset('R.png') }}" height="150px" width="170px" style="margin-top: 8%;"></div></div>
                            <div class="cbody">
                                <div class="ccat">PC Tour · 1080p Max</div><div class="ctit">NexCore STRIKER V2</div>
                                <div class="sps"><div class="sl"><span class="sd"></span>RTX 4070 Ti 12 Go</div><div class="sl"><span class="sd"></span>Intel Core i7-14700K</div><div class="sl"><span class="sd"></span>32 Go DDR5 5200 MHz</div><div class="sl"><span class="sd"></span>1 To SSD NVMe Gen4</div></div>
                                <div class="pr"><div><span class="price">1 599 MAD</span><span class="pold">1 999 MAD</span></div><span class="psave">−400 MAD</span></div>
                                <button class="badd"><i class="bi bi-bag-plus"></i> Ajouter</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 reveal d4">
                        <div class="pcard">
                            <div class="cimg"><span class="cbg bnew">NOUVEAU</span><button class="wbt"><i class="bi bi-heart"></i></button><div class="pemo"><img src="{{ asset('R.png') }}" height="150px" width="170px" style="margin-top: 8%;"></div></div>
                            <div class="cbody">
                                <div class="ccat">PC Tour · Streaming Pro</div><div class="ctit">NexCore CREATOR S1</div>
                                <div class="sps"><div class="sl"><span class="sd"></span>RTX 4090 24 Go</div><div class="sl"><span class="sd"></span>AMD Ryzen 9 7950X</div><div class="sl"><span class="sd"></span>128 Go DDR5 6000 MHz</div><div class="sl"><span class="sd"></span>4 To SSD NVMe Gen4</div></div>
                                <div class="pr"><span class="price">4 999 MAD</span><span style="font-size:.66rem;color:var(--text-dim)">Sur commande</span></div>
                                <button class="badd"><i class="bi bi-bag-plus"></i> Ajouter</button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>



    <!-- FEATURED SLIDER -->
    <section class="sec sec-dark" style="padding:0;overflow:hidden">
        <style>
            #hero-slider .slide{position:absolute;inset:0;opacity:0;transition:opacity 1s ease;transform:scale(1.04);transition:opacity .9s ease,transform .9s ease}
            #hero-slider .slide.active{opacity:1;transform:scale(1)}
            #hero-slider .hs-dot{width:28px;height:4px;border-radius:2px;background:rgba(255,255,255,.3);cursor:pointer;transition:background .3s,width .3s}
            #hero-slider .hs-dot.active{background:#fff;width:48px}
            #hero-slider .hs-nav{position:absolute;top:50%;transform:translateY(-50%);z-index:10;background:rgba(0,0,0,.3);border:1px solid rgba(255,255,255,.2);color:#fff;width:44px;height:44px;border-radius:50%;cursor:pointer;font-size:1.2rem;display:flex;align-items:center;justify-content:center;backdrop-filter:blur(8px);transition:background .2s}
            #hero-slider .hs-nav:hover{background:rgba(0,0,0,.6)}
        </style>

        <div style="position:relative;width:100%;height:520px;overflow:hidden;background:#000" id="hero-slider">
            <!-- IMAGE 1 -->
            <div class="slide active"
                 style="position:absolute;inset:0;
        background:url('{{ asset('storage/images/slid1.jpeg') }}') center/contain no-repeat">
            </div>

            <!-- IMAGE 2 -->
            <div class="slide"
                 style="position:absolute;inset:0;
        background:url('{{ asset('storage/images/slid2.jpeg') }}') center/contain no-repeat">
            </div>

            <!-- IMAGE 3 -->
            <div class="slide"
                 style="position:absolute;inset:0;
        background:url('{{ asset('storage/images/slid3.jpeg') }}') center/contain no-repeat">
            </div>


            <!-- Flèches -->
            <button class="hs-nav" style="left:1.2rem" id="hs-prev">&#8592;</button>
            <button class="hs-nav" style="right:1.2rem" id="hs-next">&#8594;</button>

            <!-- Dots -->
            <div style="position:absolute;bottom:1.4rem;left:50%;transform:translateX(-50%);display:flex;gap:.5rem;z-index:10">
                <div class="hs-dot active" data-i="0"></div>
                <div class="hs-dot" data-i="1"></div>
                <div class="hs-dot" data-i="2"></div>
            </div>

            <!-- Barre -->
            <div id="hs-bar"
                 style="position:absolute;bottom:0;left:0;height:3px;background:#fff;z-index:10;width:0%">
            </div>

        </div>
    </section>

    <script>
        (function(){
            const slides=document.querySelectorAll('#hero-slider .slide');
            const dots=document.querySelectorAll('#hero-slider .hs-dot');
            const bar=document.getElementById('hs-bar');
            let cur=0,autoT,progT,prog=0;
            const DELAY=5000;
            function go(n){
                slides[cur].classList.remove('active');
                dots[cur].classList.remove('active');
                cur=(n+slides.length)%slides.length;
                slides[cur].classList.add('active');
                dots[cur].classList.add('active');
                resetProg();
            }
            function resetProg(){
                clearInterval(progT);prog=0;bar.style.width='0%';
                progT=setInterval(()=>{prog+=100/(DELAY/100);bar.style.width=Math.min(prog,100)+'%';if(prog>=100)clearInterval(progT);},100);
            }
            function play(){clearInterval(autoT);autoT=setInterval(()=>go(cur+1),DELAY);}
            document.getElementById('hs-prev').onclick=()=>{go(cur-1);play();};
            document.getElementById('hs-next').onclick=()=>{go(cur+1);play();};
            dots.forEach(d=>d.onclick=()=>{go(+d.dataset.i);play();});
            let tx=0;
            const sl=document.getElementById('hero-slider');
            sl.addEventListener('touchstart',e=>tx=e.touches[0].clientX,{passive:true});
            sl.addEventListener('touchend',e=>{if(Math.abs(e.changedTouches[0].clientX-tx)>40){go(e.changedTouches[0].clientX<tx?cur+1:cur-1);play();}});
            play();resetProg();
        })();
    </script>









    <!-- PÉRI -->
    <section class="sec sec-dp">
        <div class="container">
            <div class="shdr reveal"><div><div class="sey">Accessoires</div><h2 class="stitle">Périphériques <span class="gt">Gaming</span></h2></div><a href="#" class="sa">Tout voir <i class="bi bi-arrow-right"></i></a></div>
            <div class="row g-4">
                <div class="col-6 col-md-3 reveal d1"><div class="pcard"><div class="cimg" style="min-height:125px"><button class="wbt"><i class="bi bi-heart"></i></button><div class="pemo" style="font-size:3rem">🖱️</div></div><div class="cbody"><div class="ccat">Souris FPS</div><div class="ctit">Ghost M1 Sans Fil</div><div class="rat"><span class="rc">(341)</span></div><div class="pr"><span class="price">890 MAD</span><span class="pold">1190 MAD</span></div><button class="badd"><i class="bi bi-bag-plus"></i> Ajouter</button></div></div></div>
                <div class="col-6 col-md-3 reveal d2"><div class="pcard"><div class="cimg" style="min-height:125px"><button class="wbt"><i class="bi bi-heart"></i></button><div class="pemo" style="font-size:3rem">⌨️</div></div><div class="cbody"><div class="ccat">Clavier Mécanique</div><div class="ctit">Blade K75 RGB</div><div class="rat"><span class="rc">(205)</span></div><div class="pr"><span class="price">1290 MAD</span></div><button class="badd"><i class="bi bi-bag-plus"></i> Ajouter</button></div></div></div>
                <div class="col-6 col-md-3 reveal d3"><div class="pcard"><div class="cimg" style="min-height:125px"><span class="cbg bpromo">−15%</span><button class="wbt"><i class="bi bi-heart"></i></button><div class="pemo" style="font-size:3rem">🎧</div></div><div class="cbody"><div class="ccat">Casque 7.1</div><div class="ctit">Echo H9 Surround</div><div class="rat"><span class="rc">(178)</span></div><div class="pr"><span class="price">1090 MAD</span><span class="pold">1290 MAD</span></div><button class="badd"><i class="bi bi-bag-plus"></i> Ajouter</button></div></div></div>
                <div class="col-6 col-md-3 reveal d4"><div class="pcard"><div class="cimg" style="min-height:125px"><button class="wbt"><i class="bi bi-heart"></i></button><div class="pemo" style="font-size:3rem">🖥️</div></div><div class="cbody"><div class="ccat">Écran 4K 144Hz</div><div class="ctit">Vision 27Q IPS HDR</div><div class="rat"><span class="rc">(90)</span></div><div class="pr"><span class="price">5490 MAD</span></div><button class="badd"><i class="bi bi-bag-plus"></i> Ajouter</button></div></div></div>
            </div>
        </div>
    </section>

    <!-- TRUST -->
    <section class="sec sec-dark">
        <div class="container"><div class="row g-3">
                <div class="col-6 col-md-3 reveal d1"><div class="tcrd"><div class="tico"><i class="bi bi-truck"></i></div><div class="ttit">Livraison rapide</div><div class="tdesc">Expédié 24h, livré 48h partout en France</div></div></div>
                <div class="col-6 col-md-3 reveal d2"><div class="tcrd"><div class="tico"><i class="bi bi-shield-check"></i></div><div class="ttit">Garantie 6 mois</div><div class="tdesc">Prise en charge totale pièces & main d'œuvre</div></div></div>
                <div class="col-6 col-md-3 reveal d3"><div class="tcrd"><div class="tico"><i class="bi bi-cpu"></i></div><div class="ttit">Assemblé Au Maroc</div><div class="tdesc">Chaque PC testé 24h avant expédition</div></div></div>
                <div class="col-6 col-md-3 reveal d4"><div class="tcrd"><div class="tico"><i class="bi bi-headset"></i></div><div class="ttit">Support 7j/7</div><div class="tdesc">Experts par chat, mail ou téléphone</div></div></div>
            </div></div>
    </section>

    <!-- NEWSLETTER -->
    <section class="sec sec-base"><div class="container"><div class="nls reveal">
                <div class="sey" style="margin-bottom:.35rem">Communauté</div>
                <h2 style="font-size:1.42rem;font-weight:700;margin-bottom:.45rem">Ne rate aucune promo ⚡</h2>
                <p style="color:var(--text-mid);margin-bottom:1.3rem;font-size:.86rem">Offres exclusives, lancements et guides gaming dans ta boîte mail.</p>
                <div class="nlw"><input type="email" class="nli" placeholder="ton@email.com"><button class="bta bta-fill">S'inscrire</button></div>
                <p style="font-size:.7rem;color:var(--text-dim);margin-top:.65rem">Pas de spam. Désinscription en 1 clic.</p>
            </div></div></section>

@endsection

@push('scripts')
    <script>
        // ===== INTERSECTION OBSERVER — scroll reveal =====
        const io = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); }
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.reveal,.reveal-l,.reveal-r').forEach(el => io.observe(el));

        // Hero elements visible on load
        requestAnimationFrame(() => {
            document.querySelectorAll('.hero .reveal,.hero .reveal-l,.hero .reveal-r').forEach((el,i) => {
                setTimeout(() => el.classList.add('in'), 80 + i * 40);
            });
        });

        // ===== COUNTER =====
        function counter(el, target, dur=1800) {
            let v = 0, step = target / (dur / 16);
            const t = setInterval(() => {
                v = Math.min(v + step, target);
                el.textContent = '+' + Math.floor(v).toLocaleString('fr');
                if (v >= target) clearInterval(t);
            }, 16);
        }
        setTimeout(() => counter(document.getElementById('cnt'), 12000), 900);

        // ===== PILLS =====
        document.querySelectorAll('.pill').forEach(b => {
            b.addEventListener('click', () => {
                document.querySelectorAll('.pill').forEach(x => x.classList.remove('active'));
                b.classList.add('active');
            });
        });

        // ===== ADD TO CART =====
        let cart = 3;
        document.querySelectorAll('.badd').forEach(btn => {
            btn.addEventListener('click', () => {
                cart++;
                document.getElementById('ccount').textContent = cart;
                const orig = btn.innerHTML;
                btn.innerHTML = '<i class="bi bi-check-lg"></i> Ajouté !';
                btn.style.cssText = 'background:rgba(74,222,128,.15);color:#4ade80;border-color:#4ade80';
                setTimeout(() => { btn.innerHTML = orig; btn.removeAttribute('style'); }, 1800);
            });
        });

        // ===== WISHLIST =====
        document.querySelectorAll('.wbt').forEach(btn => {
            btn.addEventListener('click', () => {
                const i = btn.querySelector('i');
                i.classList.toggle('bi-heart'); i.classList.toggle('bi-heart-fill');
                i.style.color = i.classList.contains('bi-heart-fill') ? '#e63946' : '';
            });
        });

        // ===== HERO PARALLAX (mouse) =====
        document.addEventListener('mousemove', e => {
            const dx = (e.clientX / innerWidth - .5) * 18;
            const dy = (e.clientY / innerHeight - .5) * 10;
            const b = document.getElementById('hbg');
            if (b) b.style.transform = `translate(${dx}px,${dy}px) scale(1.04)`;
        });
    </script>
@endpush
