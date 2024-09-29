<?php include VIEWS_DIR . "/header.php"; ?>

<main class="main-container">
    <section class="form-container">
        <article class="form-article">
            <form action="/user_add" method="post">
                <h2>S'enregistrer</h2>
                <hr>
                <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="text" id="name" placeholder="Nom" name="lastname" required>
                </div>
                <div class="form-group">
                    <label for="surname">Prénom</label>
                    <input type="text" id="surname" placeholder="Prénom" name="firstname" required>
                </div>
                <div class="form-group">
                    <label for="birthdate">Date de Naissance</label>
                    <input type="date" id="birthdate" name="birthdate" required>
                </div>
                <div class="form-group">
                    <label for="sex">Sexe</label>
                    <select id="sex" name="gender" required>
                        <option value="" selected="selected">Choisir votre sexe</option>
                        <option value="M">Homme</option>
                        <option value="F">Femme</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="height">Taille (en centimètres)</label>
                    <input type="number" id="height" placeholder="0" min="0" name="height" required>
                </div>
                <div class="form-group">
                    <label for="weight">Poids (en kg)</label>
                    <input type="number" id="weight" placeholder="0" min="0" name="weight" required>
                </div>
                <div class="form-group">
                    <label for="email">Adresse Email</label>
                    <input type="email" id="email" placeholder="exemple@domaine.bzh" name="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Veuillez entrer une adresse email valide au format : exemple@domaine.bzh" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de Passe</label>
                    <input type="password" id="password" placeholder="Mot de passe" name="password" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}" title="Le mot de passe doit comporter au moins 8 caractères, incluant au moins une majuscule, une minuscule, un chiffre et un caractère spécial (@$!%*?&)." required minlength="8">
                </div>
                <div class="form-actions">
                    <?php include __ROOT__."/views/error.php"; ?>
                    <button type="submit" class="submit-button">S'enregistrer</button> <!-- Classe pour les boutons -->
                    <p>Vous avez déjà un compte? <a href="/">Se connecter</a></p>
                </div>
            </form>
        </article>
    </section>
</main>

<?php include __ROOT__."/views/footer.html"; ?>
