<?php include VIEWS_DIR . "/header.php"; ?>

<main class="main-container">
    <article class="activity-container">
        <section class="activity-list">
            <form action="/activities" method="post">
                <h2>Liste des activités</h2>
                <hr>
                <!-- Ajout d'un conteneur avec overflow pour gérer le défilement horizontal -->
                <div class="table-wrapper">
                    <table class="activity-table">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Heure Début</th>
                                <th>Heure Fin</th>
                                <th>Durée (seconde)</th>
                                <th>Distance (mètre)</th>
                                <th>Fréq. Cardiaque Min.</th>
                                <th>Fréq. Cardiaque Max.</th>
                                <th>Fréq. Cardiaque Moy.</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data['activities'] as $activity): ?>
                                <tr>
                                    <td><?= $activity->getDescription() ?></td>
                                    <td><?= $activity->getActivityDate() ?></td>
                                    <td><?= $activity->getStartTime() ?></td>
                                    <td><?= $activity->getEndTime() ?></td>
                                    <td><?= $activity->getDuration() ?></td>
                                    <td><?= $activity->getDistance() ?></td>
                                    <td><?= $activity->getCardioFrequencyMin() ?></td>
                                    <td><?= $activity->getCardioFrequencyMax() ?></td>
                                    <td><?= $activity->getCardioFrequencyAverage() ?></td>
                                    <td>
                                        <button type="submit" name="delete_activity" value="<?= $activity->getActivityId() ?>" class="btn-danger">Supprimer</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </section>
        <div class="return-button-container">
            <button onclick="location.href='/dashboard'" class="btn">Retour</button>
        </div>
    </article>
</main>

<?php include __ROOT__."/views/footer.html"; ?>
