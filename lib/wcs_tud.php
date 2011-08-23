<?php 
function wcs_curl_get_contents($url, $fresh_connect=true)
{
	$result = false;
	$url = str_replace(' ', '%20', $url);
	$handle = curl_init($url);

	if (is_resource($handle) === true)
	{
		curl_setopt($handle, CURLOPT_FAILONERROR, true);
		curl_setopt($handle, CURLOPT_FOLLOWLOCATION, false);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($handle, CURLOPT_FRESH_CONNECT, $fresh_connect);

		$result = curl_exec($handle);
		curl_close($handle);
	}

	return $result;
}


function wcs_twitter_get_xml_element($item_name, $xml)
{
	preg_match("/<$item_name>(.*)</", $xml, $matches);
	$data = $matches[1];
	return $data;
}


function wcs_twitter_get_xml_section($tag, $xml)
{
	// init
	$xml = ' ' . $xml;
	$tag_open = '<' . $tag . '>';
	$tag_close = '</' . $tag . '>';

	// process
	$ini = strpos($xml, $tag_open);
	if ($ini == 0) {return '';}
	$ini += strlen($tag_open);
	$len = strpos($xml, $tag_close, $ini) - $ini;

	// exit
	return substr($xml, $ini, $len);
}


function wcs_twitter_make_links($status)
{
	// creates links in text-based twitter status

	// convert #hashtags
	$status = preg_replace('/\#([a-z0-9_]+)/i', '<a href="http://twitter.com/search?q=%23$1">#$1</a>', $status);
	// convert @mention
	$status = preg_replace('/\@([a-z0-9_]+)/i', '<a href="http://twitter.com/$1">@$1</a>', $status);
	// normal links
	$status = make_clickable($status);
	// force all links to open in a new tab/window
	$status = popuplinks($status);

	// exit
	return $status;
}


function wcs_lang_code_to_name($code)
{
	// init
	$lines = array();
	$line_items = array();
	$language = '';
	$code = strtolower($code);

	// strip any possible sub-language
	$pos = strpos($code, '-');
	if ($pos) {$code = substr($code, 0, $pos);}

	// get code list from Library of Congress
	// format: five elements per line, separated by |
	// ISO 639-2 Alpha-3 bibliographic code|ISO 639-2 Alpha-3 terminology code|ISO 639-1 Alpha-2 code|English language name(s)|French language name(s)
	$url = 'http://loc.gov/standards/iso639-2/ISO-639-2_utf-8.txt';
	$list = wcs_curl_get_contents($url, false);

	if (!$list) {return $language;}

	// read the file
	$lines = explode("\n", $list);
	for ($i; $i < sizeof($lines); $i++)
	{
		$line_item = explode("|", $lines[$i]);
		if (($line_item[0] == $code) || ($line_item[1] == $code) || ($line_item[2] == $code))
		{
			$language = $line_item[3];
			break;
		}
	}

	// exit
	return $language;
}


function wcs_twitter_get_user_data($user, $time_format='F j, Y (g:i a)', $conv_lang_name=true)
{
	// returns an array of twitter user data (does not require external PHP libraries)
	// reference: http://apiwiki.twitter.com/w/page/22554755/Twitter-REST-API-Method:-users%C2%A0show

	// $time_format codes: http://php.net/manual/en/function.date.php
	// lang iso codes: http://www.w3schools.com/tags/ref_language_codes.asp

	// init
	$tud = array();

	// get the xml data; return FALSE if no such user
	$url = 'http://twitter.com/users/show.xml?screen_name=';
	$xml = wcs_curl_get_contents($url . $user);
	if (!$xml) {return false;}

	// counts
	$tud['followers'] = wcs_twitter_get_xml_element('followers_count', $xml);
	$tud['followers'] = $tud['followers']!=0 ? $tud['followers'] : 0;
	$tud['followers'] = number_format_i18n($tud['followers']);

	$tud['following'] = wcs_twitter_get_xml_element('friends_count', $xml);
	$tud['following'] = $tud['following']!=0 ? $tud['following'] : 0;
	$tud['following'] = number_format_i18n($tud['following']);

	$tud['tweets'] = wcs_twitter_get_xml_element('statuses_count', $xml);
	$tud['tweets'] = $tud['tweets']!=0 ? $tud['tweets'] : 0;
	$tud['tweets'] = number_format_i18n($tud['tweets']);

	$tud['listed'] = wcs_twitter_get_xml_element('listed_count', $xml);
	$tud['listed'] = $tud['listed']!=0 ? $tud['listed'] : 0;
	$tud['listed'] = number_format_i18n($tud['listed']);

	$tud['favorites'] = wcs_twitter_get_xml_element('favourites_count', $xml);
	$tud['favorites'] = $tud['favorites']!=0 ? $tud['favorites'] : 0;
	$tud['favorites'] = number_format_i18n($tud['favorites']);

	// latest tweet info
	// if the user has tweet_privacy is enabled, there is NO status data
	$status_block = wcs_twitter_get_xml_section('status', $xml);
	$tud['status'] = wcs_twitter_get_xml_element('text', $status_block);
	if ($tud['status'])
	{
		$tud['status_id'] = wcs_twitter_get_xml_element('id', $status_block);
		$tud['status_timestamp'] = wcs_twitter_get_xml_element('created_at', $status_block);
		$tud['status_timestamp_formatted'] = date($time_format, strtotime($tud['status_timestamp']));
		$tud['status_timestamp_ago'] = human_time_diff(time(), strtotime($tud['status_timestamp'])) . ' ago';
		$tud['status_source'] = wcs_twitter_get_xml_element('source', $status_block);
		$tud['status_source'] = strip_tags(html_entity_decode($tud['status_source']));
		if ($tud['status_source'] == 'web') {$tud['status_source'] = 'Twitter';}
		$tud['status_favorited'] = wcs_twitter_get_xml_element('favorited', $status_block);
		$tud['status_retweets'] = wcs_twitter_get_xml_element('retweet_count', $status_block);
		$tud['status_retweets'] = $tud['status_retweets']!=0 ? $tud['status_retweets'] : 0;
	}

	// id info
	$tud['id'] = wcs_twitter_get_xml_element('id', $xml);
	$tud['name'] = wcs_twitter_get_xml_element('name', $xml);
	$tud['screen_name'] = wcs_twitter_get_xml_element('screen_name', $xml);
	$tud['description'] = wcs_twitter_get_xml_element('description', $xml);
	$tud['website'] = wcs_twitter_get_xml_element('url', $xml);
	$tud['image_url'] = wcs_twitter_get_xml_element('profile_image_url', $xml);
	$tud['location'] = wcs_twitter_get_xml_element('location', $xml);

	// other data
	$tud['created_timestamp'] = wcs_twitter_get_xml_element('created_at', $xml);
	$tud['created_timestamp_formatted'] = date($time_format, strtotime($tud['created_timestamp']));
	$tud['created_timestamp_ago'] = human_time_diff(time(), strtotime($tud['created_timestamp'])) . ' ago';
	$tud['time_zone'] = wcs_twitter_get_xml_element('time_zone', $xml);
	$tud['geo_enabled'] = wcs_twitter_get_xml_element('geo_enabled', $xml);
	$tud['tweet_media'] = wcs_twitter_get_xml_element('show_all_inline_media', $xml);
	$tud['tweet_privacy'] = wcs_twitter_get_xml_element('protected', $xml);
	$tud['language_iso_code'] = wcs_twitter_get_xml_element('lang', $xml);
	if ($conv_lang_name) {$tud['language'] = wcs_lang_code_to_name($tud['language_iso_code']);}

	// exit
	return $tud;
}

add_shortcode('wcs_twitter_user_data', 'wcs_twitter_user_data_shortcode_handler');
add_shortcode('wcs_tud', 'wcs_twitter_user_data_shortcode_handler');
function wcs_twitter_user_data_shortcode_handler($atts)
{
	// extract parameters
	$parms = shortcode_atts(array(
		'user' => 'wordpress',
		'data' => 'status',
		'time_format' => 'F j, Y (g:i a)',
		'conv_lang_name' => 'true',
		'cache_hours' => '1',
		'force_update' => 'false',
		), $atts);

	$user = strtolower($parms['user']);
	$data = strtolower($parms['data']);
	$time_format = $parms['time_format'];
	$conv_lang_name = $parms['conv_lang_name'];
	$cache_hours = intval($parms['cache_hours']);
	$force_update = strtolower($parms['force_update']);

	// process t/f options
	$b_conv_lang_name = false;
	if (($conv_lang_name == 'yes') || ($conv_lang_name == 'y') ||
		($conv_lang_name == 'true') || ($conv_lang_name == '1'))
	{$b_conv_lang_name = true;}

	$b_force_update = false;
	if (($force_update == 'yes') || ($force_update == 'y') ||
		($force_update == 'true') || ($force_update == '1'))
	{$b_force_update = true;}

	// prepare to get data
	$transient_name = '_wcs_tud_' . $user;
	$tud = array();

	// get the data
	if (($b_force_update == true) || (get_transient($transient_name) === false))
	{
		// fill the array
		$tud = wcs_twitter_get_user_data(
				$user,
				$time_format,
				$b_conv_lang_name);
		// save in the transient cache
		$cache = urlencode(serialize($tud));
		set_transient($transient_name, $cache, 60*60*$cache_hours);
	}
	else
	{
		$cache = get_transient($transient_name);
		$tud = unserialize(urldecode($cache));
	}

	// return the data (with some additional processing)
	$output = '';
	switch ($data)
	{
		case 'status': // enable links
			$output = wcs_twitter_make_links($tud[$data]);
			break;
		case 'link': // twitter link
			$output = '<a href="http://twitter.com/' . $user;
			$output .= '" target="_blank" rel="nofollow">';
			$output .= $tud['name'] . '</a>';
			break;
		case 'website_link':
			if ($tud['website'])
			{
				$output = '<a href="' . $tud['website'];
				$output .= '" target="_blank" rel="nofollow">';
				$output .= $tud['website'] . '</a>';
			}
			break;
		case 'image': // profile image display html
			$output = '<img src="' . $tud['image_url'];
			$output .= '" width="48" height="48" class="wcs_tud_image" />';
			break;
		default:
			$output = $tud[$data];
	}

	return $output;
}