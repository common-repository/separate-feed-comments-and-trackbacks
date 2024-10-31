=== Plugin Name ===
Contributors: superann
Donate link: http://superann.com/donate/?id=WP+Separate+Feed+Comments+Trackbacks+plugin
Tags: comments, trackbacks, feeds, rss
Requires at least: 2.5
Tested up to: 2.7.1
Stable tag: trunk

Remove trackbacks from your sitewide and individual post comment feeds, and/or have alternate feeds for comments or trackbacks only.

== Description ==

This plugin filters the sitewide comments feed as well as individual post comment feeds.

Upon first-time installation and activation, all trackbacks will be removed from the default WordPress comments feeds.
You can override this behavior on the options page and also use the comments or trackbacks only feeds described below.

URL for comments only feeds: add the variable "comments" to your feed query string.

- http://mysite.com/comments/feed/?comments
- http://mysite.com/?feed=rss2&withcomments=1&comments

URL for trackbacks only feeds: add the variable "trackbacks" to your feed query string.

- http://mysite.com/comments/feed/?trackbacks
- http://mysite.com/?feed=rss2&withcomments=1&trackbacks

== Installation ==

1. Upload `separate-feed-comments-trackbacks.php` to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.

== Frequently Asked Questions ==

None.

== Screenshots ==

None.