<?php

/**
 * Add theme support
 * @since 1.0.0
 **/

// Post thumbnails
add_theme_support( 'post-thumbnails', array( 'post' ) );


// Title tag (SEO)
add_theme_support( 'title-tag' );


// HTML markup and tags
add_theme_support( 'html5', array(
	'search-form',
	'comment-form',
	'comment-list',
	'gallery',
	'caption'
));


/**
 * Number of post revisions stored
 * @since 2.4.0
 */

function leafMedia_revisions_to_keep( $num, $post ) {
	return 10;
}

add_filter( 'wp_revisions_to_keep', 'leafMedia_revisions_to_keep', 10, 2 );


/**
 * Adds our custom .htaccess data on permalink save
 * @since 2.4.0
 * @param $rules adds the default rules
 **/

function leafMedia_htaccess( $rules ) {
$at_content = <<<EOD
\n # BEGIN leafMedia Added Content
# Protect wpconfig.php
<IfModule mod_expires.c>
# Enable expirations
ExpiresActive On
# Default directive
ExpiresDefault "access plus 1 month"
# My favicon
ExpiresByType image/x-icon "access plus 1 year"
# Images
ExpiresByType image/gif "access plus 1 month"
ExpiresByType image/png "access plus 1 month"
ExpiresByType image/jpg "access plus 1 month"
ExpiresByType image/jpeg "access plus 1 month"
# CSS
ExpiresByType text/css "access plus 1 month"
# Javascript
ExpiresByType application/javascript "access plus 1 year"
</IfModule>

# Compression
<ifModule mod_deflate.c>
<filesMatch "\\.(js|css|html|svg|xml)$">
SetOutputFilter DEFLATE
</filesMatch>
</ifModule>

# END Atweb Added Content\n
EOD;
    return $at_content . $rules;
}
add_filter('mod_rewrite_rules', 'leafMedia_htaccess');


/**
 * Add 'defer' or 'async' attribute to specified scripts
 * @since 1.1.0
 * @link http://diywpblog.com/add-defer-or-async-attribute-to-wordpress-scripts/
 **/

function add_defer_async_attributes( $tag ) {

	// Array of scripts to defer
	$scripts_to_defer = array();

	foreach( $scripts_to_defer as $defer_script ) {
		if ( true == strpos( $tag, $defer_script ) )
			$tag = str_replace( ' src', ' defer src', $tag );
	}

	// Array of scripts to async
	$scripts_to_async = array();

	foreach( $scripts_to_async as $async_script ) {
		if ( true == strpos( $tag, $async_script ) )
			$tag = str_replace( ' src', ' async src', $tag );
	}

	return $tag;
}

add_filter('script_loader_tag', 'add_defer_async_attributes', 10, 2);



/**
 * TypeKit enqueueing and caching
 * @since 1.0.3
 **/

function enqueue_typekit_with_cache() {
	ob_start(); ?>

		<script>
		!function(e,t,n,a,c,l,m,o,d,f,h,i){c[l]&&(d=e.createElement(t),d[n]=c[l],e[a]("head")[0].appendChild(d),e.documentElement.className+=" wf-cached"),function s(){for(d=e[a](t),f="",h=0;h<d.length;h++)i=d[h][n],i.match(m)&&(f+=i);f&&(c[l]="/**/"+f),setTimeout(s,o+=o)}()}(document,"style","innerHTML","getElementsByTagName",localStorage,"tk",/^@font|^\.tk-/,100);
		</script>


		<script>
			(function(d) {
				var config = {
					kitId: "<?= TYPEKIT_ID ?>",
					scriptTimeout: 3000,
					async: true
				},
				h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src="https://use.typekit.net/"+config.kitId+".js";tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
			})(document);
		</script>

	<?php
	$typekit = ob_get_clean();
	echo $typekit;
}



/**
 * Enable shortcodes in widgets
 * @since 1.0.1
 **/

add_filter('widget_text', 'do_shortcode');

?>
