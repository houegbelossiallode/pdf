<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vos PDF Commandés</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
            color: #555;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            background-color: #f1f1f1;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #999;
            text-align: center;
        }
        h1{
            color:darkgreen;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bonjour {{ $user->name }}!</h1>
        <p>Merci pour votre commande. Voici les liens de téléchargement de vos PDF :</p>

        <ul>
            @foreach($pdfLinks as $pdf)
                <li>
                    <strong>{{ $pdf['name'] }}</strong>
                    <a href="{{ $pdf['pdf_link'] }}" target="_blank" class="ml-8">Télécharger</a>
                </li>
            @endforeach
        </ul>

        <p>Merci de votre confiance!</p>
        <div class="footer">
            <p>Cordialement,</p>
            <p>Votre Équipe</p>
        </div>
    </div>
</body>
</html>
