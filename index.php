<?php
    function verif($valeur) {
        if(isset($valeur) && !empty($valeur) && !is_null(($valeur))) {
            return true;
        }
        return false;
    }

    $user = "chef";
    $pass = "chefchef";
    $bdd = new PDO('mysql:host=localhost;dbname=testphp', $user, $pass);

    if(isset($_POST['delete'])) {
        $sql_delete = "DELETE FROM livres WHERE id=:id";
        $stmt = $bdd->prepare($sql_delete);
        $stmt->execute(['id' => $_POST["delete"]]);
    }

    if( verif($_POST) ) {
        if( verif($_POST["titre"]) ) {
            $sql_insert_livre = "INSERT INTO livres VALUES (NULL, :titre, 1, 1)";
            $stmt_livre = $bdd->prepare($sql_insert_livre);
            $stmt_livre->execute(['titre' => $_POST["titre"]]);
        }
    }
    if( verif($_POST) ) {
        if( verif($_POST["auteur"]) ) {
            $sql_insert_auteur = "INSERT INTO auteurs VALUES (NULL, :nom, :prenom)";
            $stmt_auteur = $bdd->prepare($sql_insert_auteur);
            $stmt_auteur->execute(['auteur' => $_POST["nom"], 'auteur'=>$_POST["prenom"]]);
        }
    }

    

    $sql = "SELECT * FROM livres INNER JOIN auteurs ON livres.auteur_id = auteurs.id_auteur INNER JOIN genres ON livres.genre_id = genres.id_genre;";
    $livres = $bdd->query($sql)->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BAZOUZOUUUU</title>
</head>
<body style="padding: 0 100px;">
<h2>Livres</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Genre</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($livres as $livre): ?>
                <tr>
                    <td><?php echo($livre["titre"]); ?></td>
                    <td><?php echo($livre["prenom"]); ?>
                        <?php echo($livre["nom"]); ?></td>
                    <td><?php echo($livre["genre"]); ?></td>
                    <td>
                        <form action="" method="POST">
                            <button type="submit" name="update">Modifier</button>
                            <button type="submit" name="delete" value=<?php echo($livre["id"]); ?>>Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    

    <form action="" method="POST">
        <input type="text" name="titre" placeholder="Titre">
        <input type="submit" value="Envoyer !">
    </form>

<h2>Auteurs</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($auteurs as $auteur): ?>
                <tr>
                    <td><?php echo($auteur["nom"]); ?></td>
                    <td><?php echo($auteur["prenom"]);?></td>
                    <td>
                        <form action="" method="POST">
                            <button type="submit" name="update">Modifier</button>
                            <button type="submit" name="delete" value=<?php echo($livre["id"]); ?>>Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <form action="" method="POST">
        <input type="text" name="nom" placeholder="Nom">
        <input type="text" name="prenom" placeholder="Prénom">
        <input type="submit" value="Envoyer !">
    </form>
</body>
</html