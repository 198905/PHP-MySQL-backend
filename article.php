<?php
require "connect.php";
require "helpers.php";
$stmt = $db->query("SELECT * from articles");
$articles = $stmt->fetchAll();
$stmt = $db->query("SELECT * from catégorie");
$catégories = $stmt->fetchAll();
$stmt = $db->query("SELECT * from tags");
$tags = $stmt->fetchAll();

$errors = [];
if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(validPOST("titreArticle") && validPOST("dateCréationArticle") && validPOST("datePublicationArticle") && validPOST("contenuArticle") && validPOST("idCategorie") && validPOST("statutArticle")){
        $sql = "INSERT INTO articles (Titre, Date de création, Date de publication, contenu, Statut, Catégorie, Tags) VALUES (:titreArticle, :dateCréationArticle, :datePublicationArticle, :contenuArticle, :statutArticle, :nomCategorie, :nomTag)";
        $stmt = $db->prepare($sql);
        $res = $stmt->execute([
            "Titre" => htmlspecialchars($_POST["titreArticle"]),
            "Date de création" => $_POST["dateCréationArticle"],
            "Date de publication" => ($_POST["datePublicationArticle"]),
            "Catégorie" => ($_POST["contenuArticle"]),
            'Statut' => ($_POST["statutArticle"]),
            "contenu" => htmlspecialchars($_POST["contenuArticle"]),
            "Tags" => htmlspecialchars($_POST["idTag"])
        ]);
        if($res === true){
            redirectTo("index.php");
        }else{
            $errors[] = "Erreur lors de la sauvegarde en base de données. Veuillez réessayer ultérieurement.";
        }
    }else{
        $errors[] = "Veuillez remplir tous les champs.";
    }
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un concert</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
</head>
<body>
    <div class="container d-flex flex-column align-items-center">
        <h1>Nouvel Article</h1>
        <?php foreach($errors as $error){ ?>
            <div class="alert alert-warning">
                <?= $error ?>
            </div>
        <?php } ?>
        <div class="card p-4 w-50">
            <form method="POST">
                <div class="d-flex justify-content-between">
                    <div class="form-group w-50">
                        <label for="input-lieu">Titre</label><br/>
                        <input type="text">
                    </div>
                    <div class="form-group w-50">
                        <label for="input-groupe">Text</label><br/>
                        <input type="text">
                    </div>
                </div>
                <div class="d-flex justify-content-between">


                <div class="form-group w-50">
                        <label for="input-categorie">Catégorie</label><br/>
                        <select id="input-note" name="note">
                        <?php foreach($catégories as $catégorie){ ?>
                            <option><?= $catégorie['nomCategorie']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group w-50">
                        <label for="input-categorie">Tags</label><br/>
                        <select id="input-note" name="note">
                        <?php foreach($catégories as $catégorie){ ?>
                            <option><?= $catégorie['nomCategorie']?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div><a class="btn btn-primary d-flex align-items-center" href="form.php">Publier </a></br>
                        <a class="btn btn-primary d-flex align-items-center" href="form.php">Sauvegarder </a>
                <button type="submit" class="mt-3 btn btn-primary">Valider</button>
            </form>
        </div>
    </div>
</body>
</html>
