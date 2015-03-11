<div class="jumbotron">
    <h1><?=$user['name']?></h1>
    <p class="lead"><?=$user['description']?></p>
    <p><a class="btn btn-lg btn-success" href="#" role="button"><?=$user['url']?></a></p>
</div>

<div class="row marketing">
    <div class="col-lg-3">
        <?php
        foreach($tweets as $tweet) {
        ?>
            <h4>Sender</h4>
            <p><?=$tweet['text']?></p>
        <?php
        }
        ?>
    </div>
</div>