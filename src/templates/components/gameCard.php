<!-- <div class="col-6 col-md-4 col-lg-3">
    <a href="gamePage" class="card h-100">
        <div class="card-image">
            <img 
                class="card-img-top"
                src="<?=$fullImage?>"
                alt="image du jeu <?=$title?>"
            />
        </div>
        <div class="card-body">
            <p class="card-title"><?=$title?></p>
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-primary">consulter</button>
        </div>
    </a>
</div> -->

<div class="col-6 col-md-4 col-lg-3">
    <div class="card h-100">
        <div class="card-image">
            <img 
                class="card-img-top"
                src="<?=$fullImage?>"
                alt="image du jeu <?=$title?>"
            />
        </div>
        <div class="card-body">
            <p class="card-title"><?=$title?></p>
        </div>
        <div class="card-footer">
            <form action="gamePage", method="POST">
                <input type="hidden" name="title" value="<?=$title?>">
                <button type="submit" class="btn btn-primary">consulter</button>
            </form>
        </div>
    </div>
</div>