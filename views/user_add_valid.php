<?php include VIEWS_DIR . "/header.php"; ?>

<main class="main-container">
    <article class="form-article">
        <h2>Utilisateur créé</h2>
        <hr>
        <p>Félicitations <?php echo htmlspecialchars($data['lastname']); ?>. Votre compte utilisateur a été créé.</p>
        <p>Vous pouvez maintenant vous connecter <a href="/">ici</a>.</p>
    </article>
</main>

<?php include __ROOT__ . "/views/footer.html"; ?>
