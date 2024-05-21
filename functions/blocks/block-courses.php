<?php

function block_courses_render_callback( $block, $content = '', $is_preview = false ) {
    $context = \Timber::context();
    $context['block'] = $block;
    $context['fields'] = get_fields();

    //Globaux
    $context['formations_default_picture'] = get_field('formations_default_picture', 'options');
    $context['events_default_picture'] = get_field('events_default_picture', 'options');
    
    $context['is_preview'] = $is_preview;

    
    \Timber::render( 'blocks/block-courses.twig', $context );   
}