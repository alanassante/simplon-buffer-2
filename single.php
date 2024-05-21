<?php
$context = Timber::context();

$post = new Timber\Post();
$context['post'] = $post;

$current_post_id = get_the_ID();
$terms = wp_get_post_terms( $current_post_id, 'domains' );
// $term_ids = array();
if (!empty($terms)) {
    $first_term = array_shift( $terms );
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 3,
        'post__not_in'   => array( $post->ID ),
        'tax_query'      => array(
            array(
                'taxonomy' => 'domains',
                'field'    => 'slug',
                'terms'    => $first_term->slug,
            ),
        ),
    );
    $context['related_posts'] =  Timber::get_posts( $args );
}


// Author
$author_id = $post->post_author;
$context['author'] = get_avatar( get_the_author_meta( 'ID' ));
$context['job'] = get_field('job', 'user_'. $author_id );

// Label for breadcrumbs
$context['home_page_label'] = get_field('home_page_label', 'options');
$context['blog_page_label'] = get_field('blog_page_label', 'options');
$context['posts_default_picture'] = get_field('posts_default_picture', 'options');
$blogUrl = esc_url(get_permalink(get_option('page_for_posts')));
$context['blogUrl'] = $blogUrl;
$context['fields'] = get_fields();

Timber::render( 'single.twig', $context );