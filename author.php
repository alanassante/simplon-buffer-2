<?php
$context = Timber::context();
$context['post'] = new Timber\Post();

$context['author'] = is_author();
$author_id = $post->post_author;
$user_ID = get_the_author_meta('ID');
$author_avatar = get_avatar($user_ID, 184);
$context['picture'] = $author_avatar;
$context['description'] = get_the_author_meta('description', $author_id);
$context['count'] = count_user_posts($author_id);
$context['first_name'] = get_the_author_meta( 'first_name' );
$context['last_name'] = get_the_author_meta( 'last_name' );


// Pagination
global $paged;
if (!isset($paged) || !$paged){
    $paged = 1;
}
global $post;

// Get all posts
$args = array(
    'post_type' => 'post',
    'author__in' => $author_id,
    'posts_per_page' => 12,
    'paged' => $paged,
);

$context['listposts'] = Timber::get_posts($args);


Timber::render( 'author.twig', $context );
