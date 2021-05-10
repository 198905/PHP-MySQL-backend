<?php
require "connect.php";
require "helpers.php";

$stmt = $db->query("SELECT * from articles");
$articles = $stmt->fetchAll();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    
    <div class="container">
            <div class="d-flex justify-content-between mt-3 mb-3">
                <h1>Liste des articles</h1>
                <a class="btn btn-primary d-flex align-items-center" href="form.php">Ajouter </a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Date de création</th>
                        <th>Statut</th>
                        <th>Catégorie</th>
                        <th>Tags</th>
                    </tr>
                </thead>
                <?php foreach($articles as $article){ ?>
                    <tr>
                        <td><?= $article["titreArticle"] ?></td>
                        <td><?= $article["contenuArticle"] ?></td>
                        <td><?= $article["dateCreationArticle"] ?></td>
                        <td><?= $article["datePublicationArticle"] ?></td>
                        <td><?= $article["idCategorie"] ?></td>
                            
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </body>
</html>
