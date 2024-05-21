<?php
$context = Timber::context();
$context['post'] = new Timber\Post();
$context['search_page_title'] = get_field('search_page_title', 'options');
$context['formations_default_picture'] = get_field('formations_default_picture', 'options');
$context['events_default_picture'] = get_field('events_default_picture', 'options');
$context['posts_default_picture'] = get_field('posts_default_picture', 'options');
$context['is_preview'] = $is_preview;

global $paged;
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

$s = get_search_query();
$context['title'] = $s;
$sticky = get_option( 'sticky_posts' );

global $args;
$args = array(
    'post_type' => 'any',
    'posts_per_page' => 12,
    'paged' => $paged,
    's' => $s
);

$the_query = new WP_Query($args);
$context['listPosts'] = Timber::get_posts($args);

$pagination =  paginate_links( array(
    'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
    'total'        => $the_query->max_num_pages,
    'current'      => max( 1, get_query_var( 'paged' ) ),
    'format'       => '?paged=%#%',
    'show_all'     => false,
    'type'         => 'plain',
    'end_size'     => 2,
    'mid_size'     => 1,
    'prev_next'    => true,
    'prev_text'    => '',
    'next_text'    => '',
    'add_args'     => false,
    'add_fragment' => '',
) );
$context['pagination'] = $pagination;

Timber::render( 'search.twig', $context );