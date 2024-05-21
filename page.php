<?php
$context = Timber::context();
$context['post'] = new Timber\Post();
$context['corp'] = get_field('corp');

Timber::render( 'page.twig', $context );