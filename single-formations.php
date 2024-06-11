<?php
$context = Timber::context();

$post = new Timber\Post();
$context['post'] = $post;
$context['fields'] = get_fields();

Timber::render( 'single-formations.twig', $context );