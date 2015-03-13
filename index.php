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
	if(isset($user['errors'])) {
		$error = $user['errors'][0]['message'];
		$view = 'error';
		break;
	}
	$tweets = Controller::home();
	if(isset($tweets['errors'])) {
		$error = $tweets['errors'][0]['message'];
		$view = 'error';
		break;
	}
} else {
	switch ($_GET['action']) {
		case 'profile':
			if (!isset($_GET['name'])) {
				$view = 'error';
				break;
			}
			$view = 'profile';
			$user = Controller::profile($_GET['name']);
			if(isset($user['errors'])) {
				$error = $user['errors'][0]['message'];
				$view = 'error';
				break;
			}
			$tweets = Controller::tweets($user['id']);
			if(isset($tweets['errors'])) {
				$error = $tweets['errors'][0]['message'];
				$view = 'error';
			}
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
		case 'update_settings':
			$settings = $_GET;
			Controller::update_settings($settings);
			header('location: ?action=settings');
			break;
		case 'settings':
			$view = 'settings';
			$user = Controller::profile();
			if(isset($settings['errors'])) {
				$error = $user['errors'][0]['message'];
				$view = 'error';
			}
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
			if(isset($user['errors'])) {
				$error = $user['errors'][0]['message'];
				$view = 'error';
				break;
			}
			$tweets = Controller::home();
			if(isset($tweets['errors'])) {
				$error = $tweets['errors'][0]['message'];
				$view = 'error';
			}
			break;
	}
}

include('layout.php');
