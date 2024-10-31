<?php
/*
Plugin Name: Separate Feed Comments and Trackbacks
Version: 1.2
Plugin URI: http://superann.com/2008/10/02/wordpress-plugin-separate-feed-comments-and-trackbacks/
Author: Ann Oyama
Author URI: http://superann.com
Description: Remove trackbacks from your sitewide and individual post comment feeds, and/or have alternate feeds for comments or trackbacks only.

This plugin filters the sitewide comments feed as well as individual post comment feeds.

Upon first-time installation and activation, all trackbacks will be removed from the default WordPress comments feeds.
You can override this behavior on the options page and also use the comments or trackbacks only feeds described below.

URL for comments only feeds: add the variable "comments" to your feed query string.

- http://mysite.com/comments/feed/?comments
- http://mysite.com/?feed=rss2&withcomments=1&comments

URL for trackbacks only feeds: add the variable "trackbacks" to your feed query string.

- http://mysite.com/comments/feed/?trackbacks
- http://mysite.com/?feed=rss2&withcomments=1&trackbacks

Copyright 2009 Ann Oyama  (email : wordpress [at] superann.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function separate_comments_options_page() { ?>
	<div class="wrap">
	<h2>Separate Feed Comments and Trackbacks</h2>
	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options'); ?>

	<p><label>
	<input type="checkbox" name="feed_default_comments" value="1" <?php checked('1',get_option('feed_default_comments')); ?> />
	remove trackbacks from the default comment feeds</label>
	</p>
	
	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="feed_default_comments" />

	<p class="submit">
	<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
	</p>
	
	</form>
	</div><?php
}

function separate_comments_menu() {
	add_options_page('Feed Comments and Trackbacks', 'Feed Comments and Trackbacks', 8, __FILE__, 'separate_comments_options_page');
}

add_action('admin_menu', 'separate_comments_menu');

function separate_comments_activate() {
	add_option('feed_default_comments','1');
}
register_activation_hook( __FILE__, 'separate_comments_activate' );

function separate_comments_cleanup_options() {
	delete_option('feed_default_comments');
}

//register_deactivation_hook( __FILE__, 'separate_comments_cleanup_options' );

if ( function_exists('register_uninstall_hook') )
	register_uninstall_hook( __FILE__, 'separate_comments_cleanup_options' );

function separate_comments_trackbacks($where) {
	if(get_option('feed_default_comments')||isset($_GET['comments']))
		$where .= " AND comment_type = ''";
	elseif(isset($_GET['trackbacks']))
		$where .= " AND comment_type = 'pingback'";
	return $where;
}
add_filter('comment_feed_where','separate_comments_trackbacks');
?>