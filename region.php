<?php
/**
 * Template Name: Template region single
 * Description: A Page Template for region.
 */

$context = Timber::context();
$context['post'] = new Timber\Post();


Timber::render( 'region.twig', $context );