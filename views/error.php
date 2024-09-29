<?php
if (isset($data['error'])) {
    echo '<span style="color: red;">' . htmlspecialchars($data['error']) . '</span>'; // Message d'erreur
    if (isset($data['errorlog'])) {
        echo '</button>';
        echo '<div id="errorLog" style="color: red;">' . htmlspecialchars($data['errorlog']) . '</div>';
    }
    echo '</div>';
}
?>
