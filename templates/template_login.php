<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>connexion</h1>
    <form action="" method="POST">
        <input type="email" name="email" placeholder="email">
        <input type="text" name="password" placeholder="mdp">

        <input type="submit" name="submit">
        <p><?=$data[0] ?? '' ?></p>
    </form>
</body>
</html>