<?php
$currentTrendTumblr = $_POST['currentTrendTumblr'];
$tumblrurl = "https://api.tumblr.com/v2/tagged?tag=" . $currentTrendTumblr . //**"&api_key=" secret**/;
//echo $tumblrurl;
$tumblrData = file_get_contents($tumblrurl);
$feed = json_decode($tumblrData, true);
$tumblrCount = 0;
//print_r($feed);
if (empty($feed['response'])) {
    echo "No tumblr posts tagged '" . $currentTrendTumblr . "' found on Tumblr.";
} else {
    for ($i = 0; $i < 15; $i++) {
      $tumblrPost = $feed['response'][$tumblrCount];
      $content = $tumblrPost['trail'][0]['content'];
      $blogName = $tumblrPost['blog_name'];
      //if(array_key_exists('photos', $tumblrPost)) {
      if ($tumblrPost['type'] == 'text'){
        writeTumblrhead($blogName, $tumblrPost);
        echo '<p class="tumblr-text">' . $content . '</p>';
        writeTumblrfoot($tumblrPost);
      } elseif ($tumblrPost['type'] == 'photo'){
        writeTumblrhead($blogName, $tumblrPost);
        foreach ($tumblrPost['photos'] as $photos) {
          echo '<img class="tumblr-pic" src="' . $photos['alt_sizes'][3]['url'] . '">';
        };
        echo '<p class="tumblr-text">' . $tumblrPost['caption'] . '</p>';
        writeTumblrfoot($tumblrPost);
      } elseif ($tumblrPost['type'] == 'video') {
        writeTumblrhead($blogName, $tumblrPost);
        echo $tumblrPost['player'][2]['embed_code'];
        echo '<p class="tumblr-text">' . $tumblrPost['caption'] . '</p>';
        writeTumblrfoot($tumblrPost);
      };
       $tumblrCount++;
    };
};

function writeTumblrhead ($blogName, $tumblrPost) {
    echo '<div class="tumblr-div">';
    echo '<div class="tumblr-head"><p class="tumblr-scrn">User: <a href= "http://' .$blogName . '.tumblr.com">' . $blogName . '</a></p>';
    echo '<p class="tumblr-date gray">' . $tumblrPost['date'] . '</p></div>';
}

function writeTumblrfoot ($tumblrPost) {
    foreach ($tumblrPost['tags'] as $tags) {
            echo '<p class="tumblr-tags gray">#' . $tags . '</p>';
    };
    echo '</div>';
    echo '</br>';
}
?>