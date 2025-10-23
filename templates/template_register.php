<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1> Formulaire d'inscription</h1>

    <form action="" method="POST">

        <input type="text" name="firstname" id="" placeholder="firstname">

        <input type="text" name="lastname" id="" placeholder="lastname">

        <input type="text" name="email" id="" placeholder="monEmail@email.com...">

        <input type="text" name="password" id="" placeholder="password">

        <input type="submit" name="submit">
        <p style="color:red;"><?= $data[0] ?? '' ?></p>

    </form>

</body>

</html>