<div class="jumbotron"
     style="
	     background: url(<?= $user['profile_background_image_url'] ?>) no-repeat;
	     background-color: #<?= $user['profile_background_color'] ?>;
	     color: white;
	     ">
	<?php
	if (isset($user['profile_image_url']) && !empty($user['profile_image_url'])) {
		?>
		<img src="<?= $user['profile_image_url'] ?>"/>
	<?php
	}
	?>
	<h1><?= $user['name'] ?></h1>

	<h3><a href="/?name=<?= $user['screen_name'] ?>">@<?= $user['screen_name'] ?></a></h3>
	<?php
	if (isset($user['description']) && !empty($user['description'])) {
		?>
		<p class="lead"><?= $user['description'] ?></p>
	<?php
	}
	?>
	<?php
	if (isset($user['url']) && !empty($user['url'])) {
		?>
		<p><a class="btn btn-lg btn-success" href="<?= $user['entities']['url']['urls'][0]['url'] ?>"
		      role="button"><?= $user['entities']['url']['urls'][0]['expanded_url'] ?></a></p>
	<?php
	}
	?>
	Tweets : <?= $user['statuses_count'] ?> | Following : <?= $user['friends_count'] ?> | Followers : <?= $user['followers_count'] ?>
</div>

<div class="row marketing">
	<div class="col-lg-12">
		<?php
			if ($user['id'] == TwitterAPI::getUserID()) {
		?>
		<div class="tweet">
			<img style="padding-right: 5px;" src="<?= $user['profile_image_url'] ?>" />
			<form style="display: inline;" method="get">
			<input type="hidden" name="action" value="status" />
			<input type="hidden" name="referer" value="<?= $_SERVER['REQUEST_URI'] ?>" />
			<input class="input" type="text" name="content" placeholder="What's happening" />
			</form>
		</div>
<?php
			}
	foreach ($tweets as $tweet) {
		$class = '';
		$rt = $tweet['retweeted'];
		$fav = $tweet['favorited'];
		if($fav)
			$class = ' class="favorite"';
		else if ($rt)
			$class = ' class="retweet"';
		?>
			<h4><img style="padding-right: 10px;" src="<?= $tweet['user']['profile_image_url'] ?>" /><a href="/?action=profile&name=<?= $tweet['user']['screen_name'] ?>"><?= $tweet['user']['name'] ?></a>
				<span class="date">(<?= date('d/m/Y, H:i:s', strtotime($tweet['created_at'])) ?>)</span></h4>
			<p<?= $class ?>><?= Controller::processTweet($tweet) ?></p>
			<p style="margin-left: 20px;"><img src="resource/rt.png" width="16px" /> <strong style="text-decoration: underline;">[<?= $tweet['retweet_count'] ?>]</strong><?= $rt ? '' : ' <a href="#"><strong style="margin-right: 20px;">Retweet</strong></a>' ?> | <img style="margin-left: 20px;" src="resource/fav.png" width="16px" /> <a href="#"><strong><?= $fav ? 'Unfavorite' : 'Favorite' ?></strong></a></p>
		<?php
		}
		?>
	</div>
</div>
