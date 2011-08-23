<?php 
require_once ( dirname( __FILE__ ) . '/lib/theme-options.php' );
require_once( dirname( __FILE__ ) .'/lib/wcs_tud.php');

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-thumbnails', array( 'post', 'movie' ) );
    set_post_thumbnail_size( 540, 270 ); // default Post Thumbnail dimensions   
}

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'homepage-thumb', 540, 270, true ); //(cropped)
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


/** start flickr image function **/
class FlickrImages {
	private $xml;

	public function __construct( $rss_url ) {
		$this->xml = simplexml_load_file( $rss_url );
	}

	public function getTitle() {
		return $this->xml->channel->title;
	}

	public function getProfileLink() {
		return $this->xml->channel->link;
	}

	public function getImages() {
		$images = array();
		$regx = "/<img(.+)\/>/";

		foreach( $this->xml->channel->item as $item ) {
			preg_match( $regx, $item->description, $matches );

			$images[] = array(
					  'title' => $item->title,
					  'link' => $item->link,
					  'thumb' => $matches[ 0 ]
					);
		}

		return $images;
	}
}
/** end of flickr image function **/

?>