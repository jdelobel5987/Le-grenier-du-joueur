<div class="col-6 col-md-3 col-lg-3">
    <div class="card h-100" id="<?= 'card-' . $data['name'] ?>">
        <div class="card-image">
            <img src= <?= $data['src'] ?>
                alt= <?= $data['alt'] ?>
                class="card-img-top">
        </div>
        <div class="card-body">
            <p class="card-title"><?= $data['title'] ?></p>
        </div>
    </div>
</div>