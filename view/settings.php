<div class="jumbotron">
	<h1>Settings</h1>
</div>

<?php
	$url = '';
	if(isset($user['entities']['url']['urls'][0]['expanded_url']))
		$url = $user['entities']['url']['urls'][0]['expanded_url'];
?>

<div class="row marketing">
	<div style="text-align: center;"class="col-lg-12">
		<form method="get">
			<input type="hidden" name="action" value="update_settings" />
			<input class="settings" type="submit" />
			<div class="settingsdiv">
				<h4>Name</h4>
				<input class="settingsinput" type="text" name="name" placeholder="<?= $user['name'] ?>" />
			</div>
			<div class="settingsdiv">
				<h4>URL</h4>
				<input class="settingsinput" type="text" name="url" placeholder="<?= $url ?>" />
			</div>
			<div class="settingsdiv">
				<h4>Location</h4>
				<input class="settingsinput" type="text" name="location" placeholder="<?= $user['location'] ?>" />
			</div>
			<div class="settingsdiv">
				<h4>Description</h4>
				<input class="settingsinput" type="text" name="description" placeholder="<?= $user['description'] ?>" />
			</div>
			<input class="settings" style="margin-top: 10px;" type="submit" />
		</form>
	</div>
</div>
