<?php
// require 'utils/session.php'; 
// $message = '';
// if(isset($_SESSION['error_message'])) {
//     $message = $_SESSION['error_message'];
//     unset($_SESSION['error_message']);
// }

ob_start(); ?>
        
        <!-- <small style="color: red; margin-bottom: 20px;">
            <?= $message ? htmlspecialchars($message) : "" ?>
        </small> -->
        <form class="container-login" action="" method="POST">
            <input type="hidden" name="action" value="login">
            <h2>Connectez-vous</h2>
            <div class="login">
                <label for="emailConnect">E-mail * : </label>
                <i class="fa fa-envelope" id="login-envelope"></i>
                <input id="emailConnect" name="email" type="email" placeholder="exemple@email.com" required
                    autocomplete="on">
            </div>
            <div class="login">
                <label for="password">Mot de passe * : </label>
                <i class="fa fa-lock" id="login-lock"></i>
                <input id="passwordConnect" name="password" type="password" placeholder="Mot de passe" required>
            </div>
            <?= isset($data['error']['login']) ? $data['error']['login'] : ''; ?>
            <button type="submit" id="loginBtn">Se connecter</button>
            <!-- <?= isset($data['user']) ? var_dump($data['user']) : ''; ?> to remove -->
        </form>
        <!-- <div class="separator">
            <span>ou</span>
        </div> -->
        <form class="container-register" action="" method="POST">
            <input type="hidden" name="action" value="register">
            <h2>Créez votre compte</h2>
            <div class="step-indicator">
                <span class="active">1</span>
                <span>2</span>
                <span>3</span>
            </div>
            <div class="step active" id="step1">
                <p>informations obligatoires</p>
                <small>* Ces champs sont requis</small><br><br>
                <div class="field">
                    <label for="firstName">Prénom * : </label>
                    <input id="firstName" name="firstName" type="text" placeholder="Frédéric" required>
                </div>
                <div class="field">
                    <label for="lastName">Nom * : </label>
                    <input id="lastName" name="lastName" type="text" placeholder="Molas" required>
                </div>
                <p class="filler"></p>
                <div class="field">
                    <label for="email">E-mail * : </label>
                    <input id="email" name="email" type="email" placeholder="exemple@email.com" autocomplete="on"
                        required>
                </div>
                <p class="filler"></p>
                <div class="field">
                    <label for="password">Mot de passe * : </label>
                    <i class="fa fa-eye" id="pwd-eye"></i>
                    <input id="password" name="password" type="password" placeholder="Mot de passe" autocomplete="on"
                        required>
                </div>
                <div class="field">
                    <label for="pwdConfirm">Confirmation * : </label>
                    <i class="fa fa-eye" id="pwdConfirm-eye"></i>
                    <input id="pwdConfirm" name="pwdConfirm" type="password" placeholder="Mot de passe"
                        autocomplete="on" required>
                </div>
                <i class="fa fa-question-circle" id="pwdHelpIcon"></i>
                <small class="pwdRules hidden"
                    title="Règles de sécurité: 8 à 15 caractères dont au moins une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial parmi: @, $, !, %, *, ?, &">Règles
                    de sécurité</small>
            </div>
            <div class="step" id="step2">
                <p>informations facultatives</p>
                <div class="field">
                    <label for="address">Adresse : </label>
                    <input id="address" name="address" type="text" placeholder="7 rue des Français Libres"
                        autocomplete="on">
                </div>
                <div class="field">
                    <label for="addressComplement">Compléments : </label>
                    <input id="addressComplement" name="addressComplement" type="text"
                        placeholder="Résidence, étage, appartement...">
                </div>
                <div class="field">
                    <label for="zipcode">Code Postal : </label>
                    <input id="zipcode" name="zipcode" type="text" placeholder="35300">
                </div>
                <div class="field">
                    <label for="city">Ville : </label>
                    <input id="city" name="city" type="text" placeholder="Fougères">
                </div>
                <div class="field">
                    <label for="phone">Téléphone : </label>
                    <input id="phone" name="phone" type="tel" placeholder="0123456789" autocomplete="on">
                </div>
            </div>
            <div class="step" id="step3">
                <p>préférences</p>
                <div class="field">
                    <label for="communication">Mode de communication</label>
                    <select name="communication" id="communication">
                        <option value="email" selected>Email</option>
                        <option value="sms">SMS</option>
                        <option value="both">Email et SMS</option>
                        <option value="none">Aucune</option>
                    </select>
                </div>
                <div class="field">
                    <label for="newsletter">Je souhaite recevoir la newsletter</label>
                    <select name="newsletter" id="newsletter">
                        <option value="true" selected>Oui</option>
                        <option value="false">Non</option>
                    </select>
                </div>
            </div>
            <div class="buttons">
                <button type="button" id="prevButton" disabled>Préc.</button>
                <button type="button" id="nextButton">Suiv.</button>
            </div>
            <span id="result" style="color: green"><i fa-solid fa-circle-check></i></span>
        </form>               

<?php 

$content = ob_get_clean();
$description = "Créez votre compte utilisateur et connectez-vous pour une expérience personnalisée.";

render('layout', true, [
    'description' => $description,
    'title' => "Le Grenier du Joueur - Connexion",
    'css' => ['/lib/bootstrap/css/bootstrap.min.css', '/assets/css/styles.css', 'assets/css/connection.css'],
    'content' => $content,
    'js' => ['/lib/bootstrap/js/bootstrap.bundle.min.js', '/assets/js/main.js', '/assets/js/connection.js']
]);

?>