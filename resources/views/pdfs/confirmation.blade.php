<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="10;url=/pdf/list">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Confirmation de Commande</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            color: #28a745;
            text-align: center;
        }
        p {
            font-size: 16px;
            color: #555;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .total {
            font-weight: bold;
            color: #28a745;
        }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Paiement Réussi !</h1>
    <p>Merci pour votre commande. Votre paiement a été traité avec succès.</p>
    <p>Votre numéro de commande est : <strong>#123456</strong></p>

    <h2>Détails de la commande :</h2>

    <table>
        <thead>
            <tr>
                <th>Nom du PDF</th>
                <th>Lien de téléchargement</th>
                <th>Prix</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $panier)
                <tr>
                    <td>{{ $panier['name'] }}</td>
                    <td><a href="{{ $panier['pdf_link'] }}" target="_blank">Télécharger</a></td>
                    <td>{{ $panier['price'] }} €</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" style="text-align: right;" class="total">Total :</td>
                <td class="total">{{ $total }} €</td>
            </tr>
        </tfoot>
    </table>

    <p>Un email de confirmation avec les détails de votre commande vous a été envoyé. Vous pouvez télécharger les PDF directement via les liens ci-dessus ou depuis votre email.</p>

</div>

</body>
</html>
