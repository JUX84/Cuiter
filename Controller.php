<?php

class Controller
{
    static function processTweet($tweet)
    {
        $tweet = str_replace('RT', '<b>RT</b>', $tweet);
        $tweet = preg_replace_callback(
            '/@[A-Z0-9_]*/i',
            function ($matches) {
                return '<a href="/?name=' . substr($matches[0], 1) . '">' . $matches[0] . '</a>';
            },
            $tweet
        );
        $tweet = preg_replace_callback(
            '/#[A-Z0-9_]*/i',
            function ($matches) {
                return '<a href="/?tag=' . substr($matches[0], 1) . '">' . $matches[0] . '</a>';
            },
            $tweet
        );
        $tweet = preg_replace(
            '/((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)/',
            '<a href="$0">$0</a>',
            $tweet
        );
        return $tweet;
    }
}