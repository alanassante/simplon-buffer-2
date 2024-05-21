<?php

function block_partners_render_callback( $block, $content = '', $is_preview = false ) {
    $context = \Timber::context();
    $context['block'] = $block;
    $context['fields'] = get_fields();


    
    $context['is_preview'] = $is_preview;
    \Timber::render( 'blocks/block-partners.twig', $context );   
}