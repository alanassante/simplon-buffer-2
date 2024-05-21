<?php

function block_hero_section_render_callback( $block, $content = '', $is_preview = false ) {
    $context = \Timber::context();
    $context['block'] = $block;
    $context['fields'] = get_fields();

    $context['is_preview'] = $is_preview;
    \Timber::render( 'blocks/block-hero-section.twig', $context );   
}
