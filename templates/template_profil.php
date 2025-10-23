<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title??""?></title>
</head>
<body>
    <h1>Bienvenue <?= $_SESSION['firstname'] ?> </h1>
    <p>Ton email : <?= $_SESSION['email']?></p>
    <p>Ton prénom : <?= $_SESSION['firstname']?></p>
    <p>Ton nom : <?= $_SESSION['lastname']?></p>
    <p>Ton grant/role : <?= $_SESSION['grant']?></p>
    <p>Ton pseudo : <?= $_SESSION['pseudo']?? ''?></p>
    <p>Ton status : <?= $_SESSION['status']?></p>
    <p>Ton image : <?= $_SESSION['imgProfil']?></p>
    
    <a href="/logout"><button>deconnexion</button></a>
</body>
</html>