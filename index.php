<?php

require_once('TwitterAPI.php');

$credentials = array();
$credentials["consumerKey"] = "";
$credentials["consumerSecret"] = "";
$credentials["accessToken"] = "";
$credentials["accessTokenSecret"] = "";

require_once('credentials.php');

$api = new TwitterAPI($credentials);

$name = $_GET['name'];

$url = "https://api.twitter.com/1.1/users/show.json";
$field = "?screen_name=$name";

$user = $api->query($url, "GET", $field);
$userID = $user['id'];

$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
$field = "?user_id=$userID&count=10";

$tweets = $api->query($url, "GET", $field);

$view = "profile";

include('layout.php');