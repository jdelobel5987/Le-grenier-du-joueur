<?php ob_start() ?>
        <!-- <?=var_dump($_SESSION['user']);?> -->
        <?= $error ?? '' ?>
        <div class="forms-container">
            <form id="updateUserDetails" action="updateForm" method="POST">
                <input type="hidden" name="action" value="userEdit">
                <div class="title">
                    <h2>Informations personnelles :</h2>
                </div>
                <div class="firstname">
                    <label for="firstname">Prénom : </label>
                    <input id="firstname" name="firstname" type="text" value="<?=$_SESSION['user']['firstname'];?>">
                    <button type="submit" name="field" value="firstname"> 
                        <i class="fa fa-edit"></i>
                    </button>
                </div>
                <div class="lastname">
                    <label for="lastname">Nom : </label>
                    <input id="lastname" name="lastname" type="text" value="<?=$_SESSION['user']['lastname'];?>">
                    <button type="submit" name="field" value="lastname">
                        <i class="fa fa-edit"></i>
                    </button>
                </div>
                <div class="email">
                    <label for="email">E-mail : </label>
                    <input id="email" name="email" type="email" value="<?=$_SESSION['user']['email'];?>">
                    <button type="submit" name="field" value="email">
                        <i class="fa fa-edit"></i>
                    </button>
                </div>
                <!-- <div class="password">
                    <label for="password">Mot de passe : </label>
                    <input id="password" name="password" type="password" value="<?=$_SESSION['user']['password'];?>">
                    <button type="submit" name="field" value="password">
                        <i class="fa fa-edit"></i>
                    </button>
                </div> -->
                <div class="phone">
                    <label for="phone">Téléphone : </label>
                    <input id="phone" name="phone" type="tel" value="<?=$_SESSION['user']['phone'];?>">
                    <button type="submit" name="field" value="phone">
                        <i class="fa fa-edit"></i>
                    </button>
                </div>
                <div class="communication">
                    <label for="communication">Mode de communication : </label>
                    <select id="communication" name="communication">
                        <?php
                        $options = [
                            'email' => 'Email', 
                            'sms' => 'SMS', 
                            'both' => 'Email et SMS', 
                            'none' => 'Aucune'
                        ];
                        foreach($options as $key => $value) {
                            $selected = $key === $_SESSION['user']['communication'] ? 'selected' : '';
                            echo "<option value=\"$key\" $selected>$value</option>";
                        }
                        ?>
                    </select>
                    <button type="submit" name="field" value="communication">
                        <i class="fa fa-edit"></i>
                    </button>
                </div>
                <div class="newsletter">
                    <label for="newsletter">Je souhaite recevoir la newsletter : </label>
                    <select id="newsletter" name="newsletter">  <!-- add auto-add selected attribute according to $_SESSION['user']['newsletter'] -->
                        <?php
                        $options = [
                            'true' => 'Oui', 
                            'false' => 'Non'
                        ];
                        foreach($options as $key => $value) {
                            $selected = $key === $_SESSION['user']['newsletter'] ? 'selected' : '';
                            echo "<option value=\"$key\" $selected>$value</option>";
                        }
                        ?>
                    </select>
                    <button type="submit" name="field" value="newsletter">
                        <i class="fa fa-edit"></i>
                    </button>
                </div>
                <div class="submit">
                    <button type="submit" id="submitAllDetail" name="field" value="all">Tout mettre à jour</button>
                </div>
            </form>
            
            <form id="updateUserAddress" action="updateForm" method="POST">
                <input type="hidden" name="action" value="addressEdit">
                <div class="title">
                    <h2>Adresse(s) de livraison :</h2>
                </div>
                <div class="address">
                    <label for="address">Adresse : </label>
                    <input id="address" name="address" type="text" value="<?=$_SESSION['user']['address'];?>">
                    <button type="submit" name="field" value="address">
                        <i class="fa fa-edit"></i>
                    </button>
                </div>
                <div class="complement">
                    <label for="complement">Complément : </label>
                    <input id="complement" name="complement" type="text" value="<?=$_SESSION['user']['complement'];?>">
                    <button type="submit" name="field" value="complement">
                        <i class="fa fa-edit"></i>
                    </button>
                </div>
                <div class="zipcode">
                    <label for="zipcode">Code postal : </label>
                    <input id="zipcode" name="zipcode" type="text" value="<?=$_SESSION['user']['zipcode'];?>">
                    <button type="submit" name="field" value="zipcode">
                        <i class="fa fa-edit"></i>
                    </button>
                </div>
                <div class="city">
                    <label for="city">Ville : </label>
                    <input id="city" name="city" type="text" value="<?=$_SESSION['user']['city'];?>">
                    <button type="submit" name="field" value="city">
                        <i class="fa fa-edit"></i>
                    </button>
                </div>
                <!-- <div class="filler">
                    <input id="city" name="city" type="hidden" value="<?=$_SESSION['user']['city'];?>">
                </div>
                <div class="filler">
                    <input id="city" name="city" type="hidden" value="<?=$_SESSION['user']['city'];?>">
                </div>
                <div class="filler">
                    <input id="city" name="city" type="hidden" value="<?=$_SESSION['user']['city'];?>">
                </div> -->
                <div class="submit">
                    <button type="submit" id="submitAllAddress" name="field" value="all">Tout mettre à jour</button>
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
