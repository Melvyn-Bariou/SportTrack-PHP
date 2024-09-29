<?php include VIEWS_DIR . "/header.php"; ?>

<main class="main-container">
    <article class="user-actions">
        <div class="user-connect-valid">
            <?php include __ROOT__."/views/user_connect_valid.php"; ?>
        </div>
        <div class="action-buttons">
            <button class="btn" onclick="window.location.href='/user_edit'">Modifier son profil</button>
            <button class="btn" onclick="window.location.href='/activities'">Liste des activités</button>
            <button class="btn" onclick="window.location.href='/upload'">Télécharger un fichier</button>
        </div>
    </article>
</main>

<?php include __ROOT__."/views/footer.html"; ?>
