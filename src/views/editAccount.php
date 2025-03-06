<?php ob_start() ?>
        <!-- <?=var_dump($_SESSION['user']);?> -->
        <div class="forms-container">
            <form action="" method="POST">
                <input type="hidden" name="edit" value="user">
                <h2>Informations de l'utilisateur : </h2>
                <div class="firstname">
                    <label for="firstname">Prénom : </label>
                    <input id="firstname" name="firstname" type="text" placeholder="<?=$_SESSION['user']['firstname'];?>">
                </div>
                <div class="lastname">
                    <label for="lastname">Nom : </label>
                    <input id="lastname" name="lastname" type="text" placeholder="<?=$_SESSION['user']['lastname'];?>">
                </div>
                <div class="email">
                    <label for="email">E-mail : </label>
                    <input id="email" name="email" type="email" placeholder="<?=$_SESSION['user']['email'];?>">
                </div>
                <div class="password">
                    <label for="password">Mot de passe : </label>
                    <input id="password" name="password" type="password" placeholder="••••••••••">
                </div>
                <div class="phone">
                    <label for="phone">Téléphone : </label>
                    <input id="phone" name="phone" type="tel" placeholder="<?=$_SESSION['user']['phone'];?>">
                </div>
                <div class="communication">
                    <label for="communication">Mode de communication : </label>
                    <select id="communication" name="communication">
                        <option value="email">Email</option>    <!-- add auto-add selected attribute according to $_SESSION['user']['communication'] -->
                        <option value="sms">SMS</option>
                        <option value="both">Email et SMS</option>
                        <option value="none">Aucune</option>
                    </select>
                </div>
                <div class="newsletter">
                    <label for="newsletter">Je souhaite recevoir la newsletter : </label>
                    <select id="newsletter" name="newsletter">  <!-- add auto-add selected attribute according to $_SESSION['user']['newsletter'] -->
                        <option value="true">Oui</option>
                        <option value="false">Non</option>
                    </select>
                </div>
            </form>
            
            <form action="" method="POST">
                <input type="hidden" name="edit" value="address">
                <h2>Adresse(s) de livraison : </h2>
                <div class="address">
                    <label for="address">Adresse : </label>
                    <input id="address" name="address" type="text" placeholder="<?=$_SESSION['user']['address'];?>">
                </div>
                <div class="complement">
                    <label for="complement">Complément : </label>
                    <input id="complement" name="complement" type="text" placeholder="<?=$_SESSION['user']['complement'];?>">
                </div>
                <div class="zipcode">
                    <label for="zipcode">Code postal : </label>
                    <input id="zipcode" name="zipcode" type="text" placeholder="<?=$_SESSION['user']['zipcode'];?>">
                </div>
                <div class="city">
                    <label for="city">Ville : </label>
                    <input id="city" name="city" type="text" placeholder="<?=$_SESSION['user']['city'];?>">
                </div>
            </form>
        </div>
            
<?php
$content = ob_get_clean();
$description = "Éditez vos informations personnelles";

render ('layout', true, [
    'description' => $description,
    'title' => "Le Grenier du Joueur - Mise à jour des informations de compte",
    'css' => ['/assets/css/styles.css', '/assets/css/editAccount.css'],
    'content' => $content,
    'js' => ['/assets/js/main.js']
])

?>
