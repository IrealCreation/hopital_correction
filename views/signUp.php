<h1>Formulaire d'inscription d'un employé</h1>

<form action="#" method="POST">

    <?php if (count($messages) > 0) {
        foreach ($messages as $message) {
            if ($message["success"]) { ?>
                <p class="alert alert-success"><?= $message["text"] ?></p>
            <?php } 
            else { ?>
                <p class="alert alert-danger"><?= $message["text"] ?></p>
            <?php }
        }
    }?>

    <label for="username">Nom d'utilisateur</label>
    <input type="text" name="username" id="username" class="form-control">

    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" class="form-control">

    <label for="passwordVerify">Vérifier le mot de passe</label>
    <input type="password" name="passwordVerify" id="passwordVerify" class="form-control">

    <button type="submit" name="submit" class="btn btn-success">Envoyer</button>

</form>