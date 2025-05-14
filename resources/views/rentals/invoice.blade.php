<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture Location Vélo</title>
    <style>
        body { font-family: Arial, sans-serif; color: #222; }
        .header { text-align: center; }
        .section { margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        .table th { background: #f5f5f5; }
        .total { font-weight: bold; }
        .right { text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Facture de Location Vélo 🚲</h1>
    </div>
    <div class="section">
        <strong>Client :</strong> {{ $rental->renter->name ?? 'N/A' }}<br>
        <strong>Vélo :</strong> {{ $rental->bike->title }}<br>
        <strong>Propriétaire :</strong> {{ $rental->bike->owner->name }}<br>
        <strong>Période :</strong> du {{ $rental->start_date->format('d/m/Y') }} au {{ $rental->end_date->format('d/m/Y') }}<br>
    </div>
    <table class="table">
        <tr><th>Désignation</th><th class="right">Montant (€)</th></tr>
        <tr><td>Prix location</td><td class="right">{{ number_format($locationPrice, 2) }}</td></tr>
        <tr><td>Caution (sécurité)</td><td class="right">{{ number_format($security, 2) }}</td></tr>
        <tr class="total"><td>Total à payer</td><td class="right">{{ number_format($total, 2) }}</td></tr>
    </table>
    <div class="section">
        <h3>Détail du partage :</h3>
        <ul>
            <li>Montant pour le propriétaire : <strong>{{ number_format($owner, 2) }} €</strong></li>
            <li>Montant pour la plateforme (10%) : <strong>{{ number_format($platform, 2) }} €</strong></li>
        </ul>
    </div>
    <div class="section" style="font-size: 0.9em; color: #888;">
        Facture générée le {{ now()->format('d/m/Y H:i') }}
    </div>
</body>
</html>
