<?php
/**
 * Template Name: Template domain single
 * Description: A Page Template for domain.
 */

$context = Timber::context();
$context['post'] = new Timber\Post();

$queried_object = get_queried_object();
var_dump( $queried_object );
$context['this_tax'] = $queried_object;

$context['fields'] = get_fields();

Timber::render( 'taxonomy-domains.twig', $context );