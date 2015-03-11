<?php

class Controller
{
	public static function profile($screen_name = '') {
		$profile = "https://api.twitter.com/1.1/users/show.json";
		if (empty($screen_name))
			$field = "?user_id=".TwitterAPI::getUserID();
		else
			$field = "?screen_name=$screen_name";
		return TwitterAPI::query($profile, 'GET', $field); 
	}

	public static function home() {
		$tweets = "https://api.twitter.com/1.1/statuses/home_timeline.json";
		$field = "?count=10";
		return TwitterAPI::query($tweets, 'GET', $field);
	}

	public static function tweets($userID) {
		$tweets = "https://api.twitter.com/1.1/statuses/user_timeline.json";
		$field = "?user_id=$userID&count=10";
		return TwitterAPI::query($tweets, 'GET', $field);
	}

	public static function search($query, $type) {
	}

    public static function processTweet(&$tweet)
    {
        $text = $tweet['text'];
        $text = str_replace('RT', '<span class="rt">RT</span>', $text);
        $text = preg_replace_callback(
            '/@[A-Z0-9_]*/i',
            function ($matches) {
                return '<a href="/?action=profile&name=' . substr($matches[0], 1) . '">' . $matches[0] . '</a>';
            },
            $text
        );
        $text = preg_replace_callback(
            '/#[A-Z0-9_]*/i',
            function ($matches) {
                return '<a href="/?tag=' . substr($matches[0], 1) . '">' . $matches[0] . '</a>';
            },
            $text
        );
        $text = preg_replace(
            '/((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)/',
            '<a href="$0">$0</a>',
            $text
        );
        return $text;
    }
}
