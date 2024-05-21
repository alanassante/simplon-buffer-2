<?php 
$context = Timber::context();
$context['post'] = new Timber\Post();
$context['title'] = get_field('title_404', 'options');
$context['description'] = get_field('description_404', 'options');
Timber::render( '404.twig', $context );
