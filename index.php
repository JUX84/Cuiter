<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once('TwitterAPI.php');
require_once('Controller.php');

$credentials = array();
$credentials['consumerKey'] = '';
$credentials['consumerSecret'] = '';
$credentials['accessToken'] = '';
$credentials['accessTokenSecret'] = '';

require_once('credentials.php');

TwitterAPI::init($credentials);

if (!isset($_GET['action'])) {
	$view = 'profile';
	$user = Controller::profile();
	$tweets = Controller::home();
} else {
	switch ($_GET['action']) {
		case 'profile':
			if (!isset($_GET['name'])) {
				$view = 'error';
				break;
			}
			$view = 'profile';
			$user = Controller::profile($_GET['name']);
			if($user['message'] == "Rate limit exceeded")
				$view = 'error';
			$tweets = Controller::tweets($user['id']);
			if($tweets['message'] == "Rate limit exceeded")
				$view = 'error';
			break;
		case 'status':
			if (!isset($_GET['content'])) {
				$view = 'error';
				break;
			}
			$content = $_GET['content'];
			Controller::tweet($content);
			header('location: /');
			break;
		/*case 'search':
			if(!isset($_GET['q'])) {
				$view = 'error';
				break;
			}
			$view = 'search';
			$type = 'all';
			if (isset($_GET['type']))
				$type = $_GET['type'];
			$results = Controller::search($_GET['q'], $type);
			break;*/
		default:
			$view = 'profile';
			$user = Controller::profile();
			if($user['message'] == "Rate limit exceeded")
				$view = 'error';
			$tweets = Controller::home();
			if($tweets['message'] == "Rate limit exceeded")
				$view = 'error';
			break;
	}
}

include('layout.php');
