<!-- filepath: c:\xampp\htdocs\cleaner.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat du nettoyage</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
        .result-container {
            background: #fff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .result-container h1 {
            margin-bottom: 20px;
            color: #333;
        }
        .result-container p {
            font-size: 16px;
            color: #555;
        }
        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .back-btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="result-container">
        <h1>Résultat du nettoyage</h1>
        <?php
        // Fonctions de nettoyage
        function removeNonNumeric($input) {
            return preg_replace('/[^\d,.]/', '', $input);
        }

        function removeAllExcept($input) {
            return preg_replace('/[^a-zA-Z0-9]/', '', $input);
        }

        function extractbracket($input) {
            preg_match_all('/\[(.*?)\]/', $input, $matches);
            return implode(', ', $matches[1]);
        }

        // Traitement des données
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            // Debugging: Afficher les données reçues
            echo "<pre>";
            print_r($_POST);
            echo "</pre>";

            $inputString = $_POST["inputString"] ?? '';
            $cleaningMethod = $_POST["cleaningMethod"] ?? '';
            $result = "";

            // Appliquer la méthode choisie
            switch ($cleaningMethod) {
                case "removeNonNumeric":
                    $result = removeNonNumeric($inputString);
                    break;
                case "removeAllExcept":
                    $result = removeAllExcept($inputString);
                    break;
                case "extractbracket":
                    $result = extractbracket($inputString);
                    break;
                default:
                    $result = "Méthode de nettoyage invalide.";
            }

            echo "<p><strong>Chaîne originale :</strong> $inputString</p>";
            echo "<p><strong>Résultat :</strong> $result</p>";
        } else {
            echo "<p>Aucune donnée reçue.</p>";
        }
        ?>
        <a href="cleaner.html" class="back-btn">Retour</a>
    </div>
</body>
</html>