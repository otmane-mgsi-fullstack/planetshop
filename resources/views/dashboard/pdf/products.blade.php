<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Produits</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #ff6b00;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #1a2540;
        }
        .header p {
            margin: 5px 0 0;
            color: #666;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background-color: #f8f9fa;
            color: #1a2540;
            font-weight: bold;
            padding: 10px;
            text-align: left;
            border-bottom: 2px solid #ddd;
            text-transform: uppercase;
            font-size: 11px;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            color: #fff;
        }
        .bg-success { background-color: #198754; }
        .bg-warning { background-color: #ffc107; color: #000; }
        .bg-danger { background-color: #dc3545; }

        .footer {
            position: fixed;
            bottom: -30px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #999;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>PLANETSHOP - Liste des Produits</h1>
    <p>Généré le {{ now()->format('d/m/Y à H:i') }}</p>
</div>

<table>
    <thead>
    <tr>
        <th>Référence</th>
        <th>Nom du Produit</th>
        <th>Catégorie</th>
        <th class="text-right">Prix (MAD)</th>
        <th class="text-center">Stock</th>
        <th class="text-center">Statut</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td>{{ $product->reference ?? '--' }}</td>
            <td>
                <strong>{{ $product->nom }}</strong><br>
                <span style="font-size: 10px; color: #666;">{{ $product->marque }}</span>
            </td>
            <td>{{ $product->category->nom ?? 'Non classé' }}</td>
            <td class="text-right">{{ number_format($product->prix, 2, ',', ' ') }}</td>
            <td class="text-center">{{ $product->stock }}</td>
            <td class="text-center">
                @if($product->stock == 0)
                    <span class="badge bg-danger">Rupture</span>
                @elseif($product->stock < 5)
                    <span class="badge bg-warning">Faible</span>
                @else
                    <span class="badge bg-success">En stock</span>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="footer">
    NEXCORE Gaming Store - Document généré automatiquement
</div>

</body>
</html>
