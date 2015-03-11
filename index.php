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
                $error = "URI seems wrong...";
                break;
            }
            $view = 'profile';
            $user = Controller::profile($_GET['name']);
            $tweets = Controller::tweets($user['id']);
            break;
        /*case 'search':
            if(!isset($_GET['q'])) {
                $view = 'error';
                $error = "URI seems wrong...";
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
            $tweets = Controller::home();
            break;
    }
}

include('layout.php');
