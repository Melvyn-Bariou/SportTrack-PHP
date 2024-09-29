<?php include VIEWS_DIR . "/header.php"; ?>

<main class="main-container">
    <article class="upload-section">
        <section class="form-section">
            <div class="form-wrapper">
                <form action="/upload" method="post" enctype="multipart/form-data" class="upload-form">
                    <h2>Télécharger un fichier</h2>
                    <hr>
                    <label for="file">Fichier (JSON)</label>
                    <input id="file" type="file" name="file" accept=".json" required>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                    <?php include __ROOT__."/views/error.php"; ?>
                </form>
            </div>
        </section>
        <div class="action-buttons">
            <button type="button" class="btn btn-primary" onclick="window.location.href='/dashboard';">Retour</button>
        </div>
    </article>
</main>

<?php include __ROOT__."/views/footer.html"; ?>
