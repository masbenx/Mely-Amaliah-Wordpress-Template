<?php 
require_once ( dirname( __FILE__ ) . '/theme-options.php' );
require_once( dirname( __FILE__ ) .'/lib/wcs_tud.php');

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'automatic-feed-links' );
	
	//menus
	add_theme_support( 'menus' );
	register_nav_menu( 'header-menu', __( 'Header Menu' ) );
	register_nav_menu( 'footer-menu', __( 'Footer Menu' ) );
	
	//image
	add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 540, 270 ); // default Post Thumbnail dimensions   
}

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'homepage-thumb', 540, 270, true ); //(cropped)
}

register_sidebar(array(
  'name' => 'LeftSidebar',
  'description' => 'Widgets in this area will be shown on the left-hand side.',
  'before_title' => '<h2>',
  'after_title' => '</h2>'
));

function menu_list($menu_name='', $class='') {
	
	// Get the nav menu based on $menu_name (same as 'theme_location' or 'menu' arg to wp_nav_menu)
    // This code based on wp_nav_menu's code to get Menu ID from menu slug

    
    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
	$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
	$menu_items = wp_get_nav_menu_items($menu->term_id);
	$menu_list = '';
	
	foreach ( (array) $menu_items as $key => $menu_item ) {
	    $title = $menu_item->title;
	    $url = $menu_item->url;
	    $menu_list .= '<li class="'.$class.'"><a href="' . $url . '">' . $title . '</a></li>';
	}
	$menu_list .= '';
    } else {
	$menu_list = '<li class="'.$class.'"></li>';
    }
    // $menu_list now ready to output

    echo $menu_list;
}


function mely_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'twentyeleven' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<div class="comment-author vcard">
				<?php echo get_avatar($comment,$size='32'); ?>
				<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
			</div>
			<div class="comment-meta commentmetadata">
				<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?></a>
			</div>
			<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentyeleven' ); ?></em>
			<br />
			<?php endif; ?>
			<?php comment_text() ?>			
			<div class="reply">
		    	<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		  	</div>
		</div>

	<?php
			break;
	endswitch;
}

/** twitter client **/
/**
* A simple Twitter status display script.
* Useful as a status badge for JavaScript non-compliant browsers, where the
* insertion of the status message must be performed on the server.
*
* @author Manas Tungare, manas@tungare.name
* @version 1.1
* @copyright Manas Tungare, 2007 - 2009 and onwards.
* @license Creative Commons Attribution ShareAlike 3.0.
*/
function getTwitterStatus($howMany = 1) {
  $user = get_option('MA_twitter');
  $url = sprintf("http://twitter.com/statuses/user_timeline/%s.xml?count=%d", $user, $howMany);
  $parsed = new SimpleXMLElement(file_get_contents($url));

  $tweets = array();
  foreach($parsed->status as $status) {
    $message = preg_replace("/http:\/\/(.*?)\/[^ ]*/", '<a href="\\0">\\0</a>', $status->text);
    //$message = $status->text;
  	$time = niceTime(strtotime(str_replace("+0000", "", $status->created_at)));
    $tweets[] = array('message' => $message, 'time' => $time);
  }
  return $tweets;
}

/**
* Formats a timestamp nicely with an adaptive "x units of time ago" message.
* Based on the original Twitter JavaScript badge. Only handles past dates.
* @return string Nicely-formatted message for the timestamp.
* @param $time Output of strtotime() on your choice of timestamp.
*/
function niceTime($time) {
  $delta = time() - $time;
  if ($delta < 60) {
    return 'less than a minute ago.';
  } else if ($delta < 120) {
    return 'about a minute ago.';
  } else if ($delta < (45 * 60)) {
    return floor($delta / 60) . ' minutes ago.';
  } else if ($delta < (90 * 60)) {
    return 'about an hour ago.';
  } else if ($delta < (24 * 60 * 60)) {
    return 'about ' . floor($delta / 3600) . ' hours ago.';
  } else if ($delta < (48 * 60 * 60)) {
    return '1 day ago.';
  } else {
    return floor($delta / 86400) . ' days ago.';
  }
}
/** end twitter client **/

function flickr_gallery (){
	require_once(dirname( __FILE__ ) . '/lib/phpFlickr/phpFlickr.php');
	
	$flickr_username = get_option('MA_flickr');
	$result = '';
	if (!empty($flickr_username)):
		$phpFlickrObj = new phpFlickr('9616622114d6c8bc5994695fb0fd87d0');
	
		$user = $phpFlickrObj->people_findByUsername($flickr_username);
		$user_url = $phpFlickrObj->urls_getUserPhotos($user['id']);
		$photos = $phpFlickrObj->people_getPublicPhotos($user['id'], NULL, NULL, 4);
		
		$result = '<ul class="flickrPhotos">';
		foreach ($photos['photos']['photo'] as $photo) :
			$result .= '<li><a class="lightbox" rel="flickr" href="'.$phpFlickrObj->buildPhotoURL($photo, "large").'" title="'.$photo['title'].' (on Flickr)">';
		  	$result .= '<img src="'.$phpFlickrObj->buildPhotoURL($photo, "square").'" alt="'.$photo['title'].'" title="'.$photo['title'].'" />';
			$result .= '</a></li>';
		endforeach;
		$result .= '</ul>';
				
	endif;
	echo $result;
}


?>