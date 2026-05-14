

@extends('layouts.store')

@section('content')
    <div class="container sec">
        <!-- Fil d'Ariane -->
        <nav aria-label="breadcrumb" class="mb-4 reveal">
            <ol class="breadcrumb" style="font-family: var(--ff-d); font-size: 0.75rem; letter-spacing: 0.1em; text-transform: uppercase;">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-dim" style="transition: color 0.2s;">Accueil</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-dim" style="transition: color 0.2s;">Boutique</a></li>
                <li class="breadcrumb-item active" style="color: var(--accent)" aria-current="page">{{ $product->nom }}</li>
            </ol>
        </nav>

        <div class="row gx-5">
            <!-- Section Image Produit -->
            <div class="col-lg-6 mb-5 mb-lg-0 reveal-l d1">
                <div class="pcard" style="height: auto; padding: 2rem; position: sticky; top: 100px;">
                    <!-- Badges -->
                    @if($product->prix_promotion)
                        <span class="cbg bpromo" style="top: 1.5rem; left: 1.5rem; font-size: 0.75rem; padding: 0.4rem 0.8rem; z-index: 2;">PROMO</span>
                    @elseif($product->mis_en_avant)
                        <span class="cbg bhot" style="top: 1.5rem; left: 1.5rem; font-size: 0.75rem; padding: 0.4rem 0.8rem; z-index: 2;">HOT</span>
                    @endif

                    <div class="cimg" style="min-height: 450px; background: transparent;">
                        <!-- Si vous n'avez pas d'image, un fallback est nécessaire. Ici on suppose que miniature est un lien/path -->
                        <img src="{{ $product->miniature ? asset('storage/' . $product->miniature) : 'https://placehold.co/600x600/141926/ff6b00?text=PC+GAMER' }}"
                             alt="{{ $product->nom }}"
                             class="img-fluid pemo"
                             style="width: 100%; max-height: 400px; object-fit: contain; filter: drop-shadow(0 30px 40px rgba(255,107,0,0.15));">
                    </div>
                </div>
            </div>

            <!-- Section Détails Produit -->
            <div class="col-lg-6 reveal-r d2">

                <div class="d-flex align-items-center gap-3 mb-2">
                    @if($product->marque)
                        <span class="pill active" style="font-size: 0.65rem;">{{ $product->marque }}</span>
                    @endif
                    <span class="text-dim" style="font-family: var(--ff-b); font-size: 0.85rem;">Réf: {{ $product->reference ?? 'N/A' }}</span>
                </div>

                <h1 class="htitle mb-3" style="font-size: clamp(2rem, 4vw, 3.2rem); line-height: 1.1;">{{ $product->nom }}</h1>

                <!-- Étoiles (Statique pour le design) -->
                <div class="d-flex align-items-center gap-2 mb-4">
                    <div class="stars" style="font-size: 0.9rem;">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
                    </div>
                    <span class="text-dim" style="font-size: 0.85rem;">(24 Avis)</span>
                </div>

                <!-- Bloc Prix -->
                <div class="price-box mb-4 p-4" style="background: var(--deep); border: 1px solid var(--border); border-radius: var(--r);">
                    @if($product->prix_promotion)
                        <div class="d-flex align-items-baseline gap-3">
                            <span class="price" style="font-size: 2.5rem; color: var(--accent);">{{ number_format($product->prix_promotion, 2, ',', ' ') }} MAD</span>
                            <span class="pold" style="font-size: 1.2rem;">{{ number_format($product->prix, 2, ',', ' ') }} €</span>
                            <span class="psave" style="font-size: 0.85rem; padding: 0.2rem 0.6rem; background: rgba(230,57,70,0.1); border-radius: 4px;">
                            Économisez {{ number_format($product->prix - $product->prix_promotion, 2, ',', ' ') }} MAD
                        </span>
                        </div>
                    @else
                        <span class="price" style="font-size: 2.5rem; color: var(--accent);">{{ number_format($product->prix, 2, ',', ' ') }} MAD</span>
                    @endif
                </div>

                <!-- Courte Description -->
                <p class="hsub mb-4" style="color: var(--ghost); font-size: 1.05rem; max-width: 100%;">
                    {{ $product->courte_description }}
                </p>

                <!-- Statut du Stock -->
                <div class="mb-4">
                    @if($product->stock > 0)
                        <span class="d-inline-flex align-items-center gap-2" style="color: #10b981; font-family: var(--ff-d); font-size: 0.85rem; font-weight: 700; letter-spacing: 0.05em;">
                        <i class="bi bi-check-circle-fill"></i> EN STOCK ({{ $product->stock }} pièces)
                    </span>
                    @else
                        <span class="d-inline-flex align-items-center gap-2" style="color: var(--red); font-family: var(--ff-d); font-size: 0.85rem; font-weight: 700; letter-spacing: 0.05em;">
                        <i class="bi bi-x-circle-fill"></i> RUPTURE DE STOCK
                    </span>
                    @endif
                </div>

                <!-- Actions (Boutons) -->
                <div class="d-flex gap-3 mb-5">





                    <!-- Message de réussite (à mettre juste au-dessus du bouton) -->
                    @if(session('success'))
                        <div style="color: #10b981; margin-bottom: 15px; font-weight: bold;">
                            ✅ {{ session('success') }}
                        </div>
                    @endif

                    <!-- Le Bouton pour passer la commande -->
                    @auth
                        <form action="{{ route('commander.directement', $product->id) }}" method="POST" class="flex-grow-1">
                            @csrf
                            <button type="submit" class="bta bta-fill w-100 py-3" style="font-size: 1rem;">
                                <i class="bi bi-bag-check-fill me-2"></i> Commander
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="bta bta-fill w-100 py-3 text-center" style="font-size: 1rem;">
                            Connectez-vous pour commander
                        </a>

                        @if(session('success'))
                            <div class="alert alert-success" style="background: #10b981; color: white; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger" style="background: #ef4444; color: white; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                            </div>
                        @endif
                    @endauth


                    @php
                        $message = "Bonjour, je souhaite avoir plus d'informations sur le produit : $product->nom ";
                        $url = "https://wa.me/212610568581?text=" . urlencode($message);
                    @endphp


                    <a href="{{ $url }}" target="_blank">
                        <i class="bi bi-whatsapp" style="font-size: 2rem; color:#25D366;"></i>
                    </a>


                    <button class="wbt position-relative" style="width: 54px; height: 54px; top: 0; right: 0; font-size: 1.3rem;">
                        <i class="bi bi-heart"></i>
                    </button>

                </div>

                <!-- Aperçu Caractéristiques (Feat Box de votre CSS) -->
                <div class="feat p-4">
                    <h4 class="stitle mb-3" style="font-size: 1.1rem;"><i class="bi bi-cpu-fill me-2" style="color: var(--accent);"></i>Spécifications clés</h4>
                    <table class="stbl">
                        <tbody>
                        @if($product->processeur)
                            <tr><td>Processeur</td><td><span class="hi">{{ $product->processeur }}</span></td></tr>
                        @endif
                        @if($product->carte_graphique)
                            <tr><td>Carte Graphique</td><td><span class="hi">{{ $product->carte_graphique }}</span></td></tr>
                        @endif
                        @if($product->memoire_ram)
                            <tr><td>Mémoire RAM</td><td><span class="hi">{{ $product->memoire_ram }}</span></td></tr>
                        @endif
                        @if($product->stockage)
                            <tr><td>Stockage</td><td><span class="hi">{{ $product->stockage }}</span></td></tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Onglets: Description Détaillée & Fiche Technique complète -->
        <div class="row mt-5 pt-5 border-top reveal d3" style="border-color: var(--border) !important;">
            <div class="col-12">

                <ul class="nav nav-pills pills mb-4" id="productTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="pill active" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc" type="button" role="tab">Description Détaillée</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="pill" id="specs-tab" data-bs-toggle="tab" data-bs-target="#specs" type="button" role="tab">Fiche Technique Complète</button>
                    </li>
                </ul>

                <div class="tab-content" id="productTabsContent">
                    <!-- Tab Description -->
                    <div class="tab-pane fade show active" id="desc" role="tabpanel" tabindex="0">
                        <div class="p-4 p-md-5" style="background: var(--midnight); border: 1px solid var(--border); border-radius: var(--r); color: var(--text-mid); line-height: 1.8; font-size: 1.05rem;">
                            @if($product->description)
                                {!! nl2br(e($product->description)) !!}
                            @else
                                <p class="text-center text-dim mb-0">Aucune description détaillée disponible pour ce produit.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Tab Specs -->
                    <div class="tab-pane fade" id="specs" role="tabpanel" tabindex="0">
                        <div class="p-4 p-md-5" style="background: var(--midnight); border: 1px solid var(--border); border-radius: var(--r);">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="stbl w-100">
                                        <tbody>
                                        @if($product->marque)<tr><td>Marque</td><td><span style="color: var(--ghost)">{{ $product->marque }}</span></td></tr>@endif
                                        @if($product->processeur)<tr><td>Processeur</td><td><span style="color: var(--ghost)">{{ $product->processeur }}</span></td></tr>@endif
                                        @if($product->carte_graphique)<tr><td>Carte Graphique</td><td><span style="color: var(--ghost)">{{ $product->carte_graphique }}</span></td></tr>@endif
                                        @if($product->memoire_ram)<tr><td>Mémoire RAM</td><td><span style="color: var(--ghost)">{{ $product->memoire_ram }}</span></td></tr>@endif
                                        @if($product->stockage)<tr><td>Stockage</td><td><span style="color: var(--ghost)">{{ $product->stockage }}</span></td></tr>@endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6 mt-3 mt-md-0">
                                    <table class="stbl w-100">
                                        <tbody>
                                        @if($product->carte_mere)<tr><td>Carte Mère</td><td><span style="color: var(--ghost)">{{ $product->carte_mere }}</span></td></tr>@endif
                                        @if($product->alimentation)<tr><td>Alimentation</td><td><span style="color: var(--ghost)">{{ $product->alimentation }}</span></td></tr>@endif
                                        @if($product->systeme_refroidissement)<tr><td>Refroidissement</td><td><span style="color: var(--ghost)">{{ $product->systeme_refroidissement }}</span></td></tr>@endif
                                        @if($product->boitier)<tr><td>Boitier</td><td><span style="color: var(--ghost)">{{ $product->boitier }}</span></td></tr>@endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .breadcrumb-item + .breadcrumb-item::before {
            content: "›";
            color: var(--text-dim);
        }
        .breadcrumb-item a:hover {
            color: var(--accent) !important;
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Activation simple des animations Reveal
        document.addEventListener("DOMContentLoaded", function() {
            const reveals = document.querySelectorAll('.reveal, .reveal-l, .reveal-r');
            reveals.forEach(el => el.classList.add('in'));
        });
    </script>
@endpush
