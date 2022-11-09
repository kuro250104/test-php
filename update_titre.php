<?php

    $user = "chef";
    $pass = "chefchef";
    $bdd = new PDO('mysql:host=localhost;dbname=testphp', $user, $pass);

    $id_livre = $_POST['update_livre'];

    $sql_livre = "SELECT id, titre FROM livres WHERE id=" . $id_livre . ";";
    $livre = $bdd->query($sql_livre)->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Livre</title>
</head>
<body>

    <form action="index.php" method="POST">
        <input type="text" name="txt_livre" value=<?php echo($livre["titre"]); ?>>
        <input type="hidden" name="id_livre" value=<?php echo($livre["id"]); ?>>
        <input type="submit" name="btn_livre" value="Modifier !"/>
    </form>

</body>
</html>