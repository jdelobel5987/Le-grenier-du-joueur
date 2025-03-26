<div class="col-6 col-md-4 col-lg-3">
    <div class="card h-100">
        <div class="card-image card-img-container">
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
                <input type="hidden" name="gameId" value="<?=$gameId?>">
                <!-- <input type="hidden" name="title" value="<?=$title?>"> -->
                <button type="submit" class="btn btn-primary">consulter</button>
            </form>
        </div>
    </div>
</div>