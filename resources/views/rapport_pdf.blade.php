<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapport des Objets Connectés</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <h1>Rapport d'utilisation des objets connectés</h1>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Nombre d'interactions</th>
                <th>Consommation énergétique (kW)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($objects as $object)
                <tr>
                    <td>{{ $object->name }}</td>
                    <td>{{ $object->nombre_interactions }}</td>
                    <td>{{ number_format($object->getConsommationTotaleAttribute(),2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
