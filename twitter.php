<?php
ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "2198384834-gUxPDhf2j3GgLFO8PxcBwr6Wxtnk5kgLbrj7PTz",
    /** 'oauth_access_token_secret' => "", **/
    'consumer_key' => "YuMXV7jzeMijE7PoInlTd5aFi",
   /**  'consumer_secret' => "" **/
);
echo "<div class='twitter-id'>";
$currentTrend = $_POST['currentTrend'];
echo $currentTrend;
$url = 'https://api.twitter.com/1.1/search/tweets.json';
$getfield = '?q=' . $currentTrend;
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$statusData = json_decode($twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest(), $assoc = TRUE);
echo "</div>";
foreach($statusData['statuses'] as $items)
    {
        echo "<div class='row post-container'>";
        echo "<div class='twitter-pic-div col-xs-2'><a href='http://twitter.com/" . $items['user']['screen_name'] . "'><img class='twitter-pic' src='" . $items['user']['profile_image_url'] . "'></a></div>";
        echo "<div class='col-xs-10'><a href='http://twitter.com/" . $items['user']['screen_name'] . "'><p class='twitter-name'>" . $items['user']['name'] . "</p>";
        echo "<p class='twitter-scrn gray'>" . " @" . $items['user']['screen_name'] . "</p></a></br>";
        echo "<div class='twitter-tweet tweet'>" . $items['text'] . "'</div>";
        echo "<p class='gray'>" . $items['created_at'] . "</p></div>";
        echo "</div>";
    }

echo "<script>pageComplete();</script>";
?>