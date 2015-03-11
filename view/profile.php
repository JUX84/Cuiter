<div class="jumbotron" style="background: url(<?=$user['profile_background_image_url']?>) no-repeat;">
    <img src="<?=$user['profile_image_url']?>" />
    <h1><?=$user['name']?></h1>
    <p class="lead"><?=$user['description']?></p>
    <p><a class="btn btn-lg btn-success" href="#" role="button"><?=$user['url']?></a></p>
</div>

<div class="row marketing">
    <div class="col-lg-12">
        <?php
        foreach($tweets as $tweet) {
        ?>
            <h4><?=$tweet['user']['name']?></h4>
            <p><?=$tweet['text']?></p>
        <?php
        }
        ?>
    </div>
</div>