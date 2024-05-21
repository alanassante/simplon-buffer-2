<?php
$context = Timber::context();
$context['post'] = new Timber\Post();

$context['categories'] = \Timber::get_terms('category', array( 'hide_empty' => true, 'parent' => 0 ));
// Label for breadcrumbs
$context['home_page_label'] = get_field('home_page_label', 'options');
$context['blog_page_label'] = get_field('blog_page_label', 'options');
$context['posts_default_picture'] = get_field('posts_default_picture', 'options');
$blogUrl = esc_url(get_permalink(get_option('page_for_posts')));
$context['blogUrl'] = $blogUrl;

$category = get_queried_object();
$context['page_category'] = $category->term_id;
$context['page_category_name'] = $category->name;

// Pagination
global $paged;
if (!isset($paged) || !$paged){
    $paged = 1;
}
global $post;

// Get all posts
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 6,
    'paged' => $paged,
    'tax_query' => array(
        
        array(
            'taxonomy' => 'category',
            'field'    => 'term_id',
            'terms'    => $context['page_category'],
        ),
    )
);

$context['listposts'] = Timber::get_posts($args);


Timber::render( 'category.twig', $context );
