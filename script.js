
var instaurl = "";
var currentTrend = "";

function trendClick(event) {
    currentTrend = event.target.title;
    $("#twitter-container").load("twitter.php?", {"currentTrend": currentTrend});
    var currentTrendTumblr = currentTrend.replace(/ /g, '+').replace(/#/, '');
    $("#tumblr-container").load("tumblr.php?", {"currentTrendTumblr": currentTrendTumblr});
    var currentTrendPhoto = currentTrend.replace(/ /g, '').replace(/#/, '');
    var instaurl = "https://api.instagram.com/v1/tags/" + currentTrendPhoto + "/media/recent?access_token=" + /** secret **/ + "&callback=?"
    var access_token = location.hash.split('=')[1];
	
		$.ajax({
			type: "GET",
			dataType: "json",
			cache: false,
			url: instaurl,
			success: parseData
		});

}

function parseData(json){
    var instahtml = "";
    console.log(json);
    if (json.data.length === 0) {
        instahtml += '<p>No posts tagged "' + currentTrend  + '" found on Instagram.</p>';
    } else {
    $.each(json.data,function(i,data){
	    instahtml += '<div class="post-container instagram-div">' + '<a href="http://instagram.com/' + data.user.username + '">';
            instahtml += '<div><img class="instagram-propic" src="' + data.user.profile_picture + '"></a>';
            instahtml += '<p class="instagram-name">' + data.user.username + '</p></div></a>';
            instahtml += '<img class="instagram-img" src ="' + data.images.low_resolution.url + '">';
            instahtml += '<p class="instagram-caption">' + data.caption.text + '</p>';
            instahtml += '<p class="instagram-date gray">' + new Date(data.created_time * 1000) + '</p></div><br>';
	    });
    };
    $("#instagram-container").html(instahtml);
    instahtml = "";
}

function pageComplete(){
        $('.tweet').tweetLinkify();
    }


//Back to top code from http://html-tuts.com/back-to-top-button-jquery/
var amountScrolled = 30;

$(window).scroll(function() {
	if ( $(window).scrollTop() > amountScrolled ) {
		$('#top-button-div').fadeIn('slow');
	} else {
		$('#top-button-div').fadeOut('slow');
	}
});

$('#top-button-div').click(function() {
	$('html, body').animate({
		scrollTop: 0
	}, 700);
	return false;
});