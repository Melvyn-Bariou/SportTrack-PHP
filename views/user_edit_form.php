<?php include VIEWS_DIR . "/header.php"; ?>

<main class="main-container">
    <article class="edit-profile">
        <section class="form-section">
            <form action="/user_edit" method="post" class="profile-form">
                <h2>Modifier votre profil</h2>
                <hr>
                <div class="form-group">
                    <label for="name">Nom *</label>
                    <input type="text" id="name" value="<?php echo $data['user']->getLastName()?>" name="lastname" required>
                </div>
                <div class="form-group">
                    <label for="surname">Prénom *</label>
                    <input type="text" id="surname" value="<?php echo $data['user']->getFirstName()?>" name="firstname" required>
                </div>
                <div class="form-group">
                    <label for="birthdate">Date de Naissance *</label>
                    <input type="date" id="birthdate" value="<?php echo $data['user']->getBirthdate()?>" name="birthdate" required>
                </div>
                <div class="form-group">
                    <label for="sex">Sexe *</label>
                    <select id="sex" name="gender" required>
                        <option value="" selected="selected">Changer de genre ?</option>
                        <option value="M" <?php echo ($data['user']->getGender() == 'male') ? 'selected="selected"' : ''; ?>>Homme</option>
                        <option value="F" <?php echo ($data['user']->getGender() == 'female') ? 'selected="selected"' : ''; ?>>Femme</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="height">Taille (en centimètres) *</label>
                    <input type="number" id="height" value="<?php echo $data['user']->getHeight()?>" min="0" name="height" required>
                </div>
                <div class="form-group">
                    <label for="weight">Poids (en kg) *</label>
                    <input type="number" id="weight" value="<?php echo $data['user']->getWeight()?>" min="0" name="weight" required>
                </div>
                <div class="form-group">
                    <label for="email">Adresse Email *</label>
                    <input type="email" id="email" disabled value="<?php echo $data['user']->getEmail()?>" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de Passe</label>
                    <input type="password" id="password" placeholder="Mot de passe" name="password" minlength="8">
                </div>
                <div class="error-message">
                    <?php include __ROOT__."/views/error.php"; ?>
                </div>
                <div class="action-buttons">
                    <button type="submit" name="action" value="delete" class="btn btn-danger">Supprimer le compte</button>
                    <button type="submit" name="action" value="save" class="btn btn-primary">Enregistrer</button>
                    <button type="button" class="btn btn-primary" onclick="window.location.href='/dashboard';">Retour</button>
                </div>
            </form>
        </section>
    </article>
</main>

<?php include __ROOT__."/views/footer.html"; ?>
