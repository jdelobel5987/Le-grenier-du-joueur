<div class="<?= "content card-" . $data['name'] ?>" id="<?= "user-" . $data['name'] ?>" >
    <i class="fa fa-close fa-2x"></i>
    <h3> <?= $data['title'] ?> </h3>
    <div class="data">
        <?php
            foreach($data['fields'] as $key => $value) {
                echo <<<FIELD
                <div class="field" id="$key">
                <p>$key :&nbsp;</p>
                <span>$value</span>
                </div>
                FIELD;            
            }
        ?>
    </div>
    <button type="button" id="<?= "edit-" . $data['name'] ?>" >Modifier <i
            class="fa-solid fa-edit"></i></button>
</div>