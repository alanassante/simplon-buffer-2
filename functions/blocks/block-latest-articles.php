<?php

function block_latest_articles_render_callback( $block, $content = '', $is_preview = false ) {
    $context = \Timber::context();
    $context['block'] = $block;
    $context['fields'] = get_fields();
    $context['is_preview'] = $is_preview;
    $context['posts_default_picture'] = get_field('posts_default_picture', 'options');

    
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 3,
    );
    $context['articles'] = \Timber::get_posts($args);
    $context['tags'] = \Timber::get_terms('tag', array( 'hide_empty' => true, 'parent' => 0 ));
    \Timber::render( 'blocks/block-latest-articles.twig', $context );   
}