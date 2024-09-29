<form action="/connect" method="post">
    <h2>Se connecter</h2>
    <hr>
    <div class="mb-3 mt-3">
        <label for="email" class="form-label">Adresse Email:</label>
        <input id="email" type="email" class="form-control" placeholder="nom.e0000000@etud.univ-ubs.fr" name="email" required>
    </div>
    <div>
        <label for="password" class="form-label">Mot de passe:</label>
        <input id="password" type="password" class="form-control" placeholder="Password" name="password" required>
    </div>
    <?php include VIEWS_DIR . "/error.php"; ?>
    <div class="text-center mt-4">
        <button type="submit" class="btn btn-primary w-100">Se connecter</button>
        <p class="mt-2 mb-0">Pas de compte? <a href="/user_add">S'enregistrer</a></p>
    </div>
</form>