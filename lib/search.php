<?php
/**
 * List all the custom fields for inclusion in search query
 * @since 2.0.0
 * @return (array) $fields The list of custom fields
 **/

function list_searcheable_acf() {
	$fields = array(
		'col_1_content',
		'col_2_content',
		'col_3_content',
		'col_4_content',
		'title_text'
	);

	return $fields;
}



/**
 * Avanced search function that includes ACF-fields and taxonomies and split expression before request
 * @since 2.0.0
 * @param  [query-part/string] $where    The initial "where" part of the search query
 * @param  [object]            $wp_query 
 * @return [query-part/string] $where    The "where" part of the search query as we customized
 **/

function advanced_custom_search( $where, &$wp_query ) {

	global $wpdb;

	$prefix = $wpdb->base_prefix;

	if ( empty( $where ))
		return $where;
 
		// get search expression
		$terms = $wp_query->query_vars[ 's' ];

		// explode search expression to get search terms
		$exploded = explode( ' ', $terms );
		if ( $exploded === FALSE || count( $exploded ) == 0 )
			$exploded = array( 0 => $terms );

		// reset search in order to rebuilt it as we whish
		$where = '';

		// get searcheable_acf, a list of advanced custom fields you want to search content in
		$list_searcheable_acf = list_searcheable_acf();

		foreach( $exploded as $tag ) :
			$where .= " 
					AND (
						(" . $prefix . "posts.post_title LIKE '%$tag%')
						OR (" . $prefix . "posts.post_content LIKE '%$tag%')
						OR EXISTS (
							SELECT * FROM " . $prefix . "postmeta
								WHERE post_id = " . $prefix . "posts.ID
									AND (";

				foreach ($list_searcheable_acf as $searcheable_acf) :
					if ($searcheable_acf == $list_searcheable_acf[0]):
						$where .= " (meta_key LIKE '%" . $searcheable_acf . "%' AND meta_value LIKE '%$tag%') ";
					else :
						$where .= " OR (meta_key LIKE '%" . $searcheable_acf . "%' AND meta_value LIKE '%$tag%') ";
					endif;
				endforeach;

					$where .= ")
						)
						OR EXISTS (
							SELECT * FROM " . $prefix . "comments
							WHERE comment_post_ID = " . $prefix . "posts.ID
								AND comment_content LIKE '%$tag%'
						)
						OR EXISTS (
							SELECT * FROM " . $prefix . "terms
							INNER JOIN " . $prefix . "term_taxonomy
								ON " . $prefix . "term_taxonomy.term_id = " . $prefix . "terms.term_id
							INNER JOIN " . $prefix . "term_relationships
								ON " . $prefix . "term_relationships.term_taxonomy_id = " . $prefix . "term_taxonomy.term_taxonomy_id
							WHERE (
							taxonomy = 'post_tag'
								OR taxonomy = 'category'          		
							)
								AND object_id = " . $prefix . "posts.ID
								AND " . $prefix . "terms.name LIKE '%$tag%'
						)
				)";
	endforeach;
	return $where;
}

add_filter( 'posts_search', 'advanced_custom_search', 500, 2 );

?>