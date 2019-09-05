<?php
$i = 0;
$kelime = $search;
if ($kelime == '') {
	$kelime = 'atif+aslam';
}
$video_detail_only = false;
if (isset($id) && $id != '') {
	$video_detail_only = true;
}
if ($video_detail_only == false) {
	$request = "https://www.googleapis.com/youtube/v3/search?part=snippet&q=$kelime&type=video&maxResults=$result&key=$api_key_yt";
//echo $request;
	//$request = "http://gdata.youtube.com/feeds/api/videos?alt=json&q=".$kelime."+song&orderby=relevance&start-index=1&max-results=11&v=2";
	$response = cache_url($request);
	$result = array();
	$final_result = array();
	$jsonobj = json_decode($response);
//echo '<pre>';
	//print_r($jsonobj);
	//echo '</pre>';
	$vid_id = array();
	foreach ($jsonobj->items as $video_id) {
		$vid_id[] = $video_id->id->videoId;
	}
	$video_id_list = implode(',', $vid_id);
//echo $video_id_list;
	unset($jsonobj);
	$jsonobj = '';
	unset($vid_id);
	$vid_id = '';
	unset($video_id);
	$video_id = '';
	unset($request);
	$request = '';
	unset($response);
	$response = '';
} else {
	$video_id_list = $id;
}
$request2 = "https://www.googleapis.com/youtube/v3/videos?part=snippet,contentDetails,statistics&id=$video_id_list&key=$api_key_yt";
//      echo $request2;
$response = cache_url($request2);
$jsonobj = json_decode($response);
//echo '<pre>';
//print_r($jsonobj);
//echo '</pre>';
//die();
if (count($jsonobj->items) > 0) {
	if (is_array($jsonobj->items)) {
		$results_count = 0;
		foreach ($jsonobj->items as $value) {

			$title = htmlspecialchars(ucwords(toAscii($value->snippet->title)), ENT_QUOTES);
			$live = $value->snippet->liveBroadcastContent;
			$thumbnail = $value->snippet->thumbnails->default->url;
			$thumbnail_large = $value->snippet->thumbnails->medium->url;
			$id = $value->id;
			$uploader = htmlspecialchars(ucwords(toAscii($value->snippet->channelTitle)), ENT_QUOTES);
			$duration = $value->contentDetails->duration;
			$duration_format = covtime($duration);
			$duration_sec = timeinsec($duration_format);
// echo $duration_sec;
			$like = number_shorten(@$value->statistics->likeCount);
			$size = fsz($duration_sec * (23 * 1000));
			$bitss = ('192 Kbps');

			if ($title != '' && $live == 'none') {
				$final_result[] = array('title' => $title, 'bits' => $bitss, 'duration' => $duration_format, 'milisec' => $duration_sec * (1000), 'uploader' => $uploader,
					'cover' => $thumbnail, 'cover_large' => $thumbnail_large, 'vid_id' => $id, 'like' => $like, 'size' => $size);
				$results_count++;

			}
		}
	}
}