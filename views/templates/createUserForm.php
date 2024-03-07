<?php
/**
 * Template pour afficher le formulaire de connexion.
 */
?>
<div class="formConnection">
    <form action="index.php?action=createUser" method="post" class="foldedCorner">
        <h2>Inscription</h2>
        <div class="formGrid">
            <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" id="pseudo" required>
            <label for="email">E-mail</label>
            <input type="text" name="email" id="email" required>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required>
            <button class="submit">Se connecter</button>
        </div>
    </form>
</div>