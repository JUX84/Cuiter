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
    <h3><a href="/?name=<?=$user['screen_name']?>">@<?=$user['screen_name']?></a></h3>
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
        <p><a class="btn btn-lg btn-success" href="<?=$user['entities']['url']['urls'][0]['url']?>" role="button"><?=$user['entities']['url']['urls'][0]['expanded_url']?></a></p>
    <?php
    }
    ?>

</div>

<div class="row marketing">
    <div class="col-lg-12">
        <?php
        echo '<pre>';
        var_dump($tweets);
        echo '</pre>';
        foreach($tweets as $tweet) {
        ?>
            <h4><?=$tweet['user']['name']?> <span class="date">(<?=date('d/m/Y, H:i:s', strtotime($tweet['created_at']))?>)</span></h4>
            <p<?=(substr($tweet['text'], 0, 2) == 'RT' ? ' class="retweet"' : '')?>><?=Controller::processTweet($tweets, $tweet['text'])?></p>
        <?php
        }
        ?>
    </div>
</div>