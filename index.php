<htmL>
<head>
    <title>Stay in the Loop</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Satisfy' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <p id="desktop">This app is only made for mobile screens. Please either view this page on your phone or narrow your browser.</p>
    <div class="container">
    <h1>Stay in the Loop</h1>
    <div id="line"></div>
    <h2>See what people are posting about current top trends in America.</h2>
    <p id="disclaimer">Caution: Trends are pulled from Twitter. Content comes directly from Twitter, Instagram, and Tumblr and is not monitored or filtered.</p>
    <h4>Pick a trend:</h4>
<?php
ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "2198384834-gUxPDhf2j3GgLFO8PxcBwr6Wxtnk5kgLbrj7PTz",
    'oauth_access_token_secret' => "GLK02T7aiE6B3otcYi0WHDbwuvdRwvazO8wnZLlgq0Bdg",
    'consumer_key' => "YuMXV7jzeMijE7PoInlTd5aFi",
    'consumer_secret' => "cLW8jtMxBx4taIO7XhQdCQIKq3I5mVdKHWgNxdGvNMBVjuLH6M"
);

$url = 'https://api.twitter.com/1.1/trends/place.json';
$getfield = '?id=23424977';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$tweetData = json_decode($twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest(), $assoc = TRUE);
$trendParent = $tweetData[0]['trends'];
$trendCount = 0;
for ($x = 0; $x < 5; $x++) {
    $trendName = $trendParent[$trendCount]['name'];
    echo "<button onclick= 'trendClick(event)' title='" . $trendName . "' class= 'trend-button btn-info' id='trend-" . $x . "'>" . $trendName . "</button></br>";
    $trendCount++;
};

?>
    
<div>
    <ul class="nav nav-tabs" role="tablist">
	 <li role="presentation" class="active"><a href="#twitter-tab" aria-controls="Twitter" role="tab" data-toggle="tab">Twitter</a></li>
	 <li role="presentation"><a href="#instagram-tab" aria-controls="Instagram" role="tab" data-toggle="tab">Instagram</a></li>
	<li role="presentation"><a href="#tumblr-tab" aria-controls="Tumblr" role="tab" data-toggle="tab">Tumblr</a></li>
    </ul>
</div>

<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="twitter-tab">
	    <div id="twitter-container">Pick a trend to see recent tweets.</div>
    </div>
    <div role="tabpanel" class="tab-pane" id="instagram-tab">
	    <div id="instagram-container">Pick a trend to see recent Instagram posts.</div>
    </div>
    <div role="tabpanel" class="tab-pane" id="tumblr-tab">
	    <div id="tumblr-container">Pick a trend to see recent Tumblr posts.</div>
    </div>
</div>
	    
    </div> <!-- closes container -->
<a href="#" id="top-button">
    <div id="top-button-div">
	<span class="glyphicon glyphicon-menu-up"></span>
    </div>
</a>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
<script src="tweetLinkIt.js"></script>
<script src="script.js"></script>
</body>
</html>