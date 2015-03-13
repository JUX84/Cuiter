<div class="jumbotron">
	<h1>Settings</h1>
</div>

<?php

	function showSetting($key, $value) {
		if (is_bool($value))
			$value = ($value ? 'true' : 'false');
		if ($key == 'screen_name')
			$value = '<input style="text-align:center;" type="text" name="screen_name" placeholder="'.$value.'" />';
		else if ($key == 'language')
			$value = '<select name="language">
						<option value="fr"'.($value == 'fr' ? ' selected' : '').'>
							Francais
						</option>
						<option value="en"'.($value == 'en' ? ' selected' : '').'>
							English
						</option>
					</select>';
		return $value;
	}

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
				<input class="settingsinput" type="text" name="url" placeholder="<?= $user['entities']['url']['urls'][0]['expanded_url'] ?>" />
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
