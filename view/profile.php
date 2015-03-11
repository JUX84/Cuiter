<div class="jumbotron"
     style="
         background: url(<?=$user['profile_background_image_url']?>) no-repeat;
         background-color: #<?=$user['profile_background_color']?>;
         color: #<?=$user['profile_text_color']?>;
         ">
    <?php
    if(isset($user['profile_image_url']) && !empty($user['profile_image_url'])) {
        ?>
        <img src="<?= $user['profile_image_url'] ?>"/>
    <?php
    }
    ?>
    <h1><?=$user['name']?></h1>
    <h3><a href="#">@<?=$user['screen_name']?></a></h3>
    <?php
    if(isset($user['description']) && !empty($user['description'])) {
        ?>
        <p class="lead"><?=$user['description']?></p>
    <?php
    }
    ?>
    <?php
    if(isset($user['url']) && !empty($user['url'])) {
        ?>
        <p><a class="btn btn-lg btn-success" href="#" role="button"><?=$user['url']?></a></p>
    <?php
    }
    ?>

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