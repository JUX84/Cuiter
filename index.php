<?php

require_once('TwitterAPI.php');
require_once('Controller.php');

$credentials = array();
$credentials["consumerKey"] = "";
$credentials["consumerSecret"] = "";
$credentials["accessToken"] = "";
$credentials["accessTokenSecret"] = "";

require_once('credentials.php');

$api = new TwitterAPI($credentials);

if(isset($_GET['name'])) {
    $name = "screen_name=" . $_GET['name'];
    $statuses = "https://api.twitter.com/1.1/statuses/user_timeline.json";
} else {
    $name = "user_id=".explode('-', $credentials["accessToken"])[0];
    $statuses = "https://api.twitter.com/1.1/statuses/home_timeline.json";
}

$profile = "https://api.twitter.com/1.1/users/show.json";
$field = "?$name";

$user = $api->query($profile, "GET", $field);
$userID = $user['id'];


$field = "?user_id=$userID&count=10";

$tweets = $api->query($statuses, "GET", $field);

$view = "profile";

include('layout.php');