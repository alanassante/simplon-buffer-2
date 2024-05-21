<?php

function block_carousel_cards_render_callback( $block, $content = '', $is_preview = false ) {
    $context = \Timber::context();
    $context['block'] = $block;
    $context['fields'] = get_fields();
    $context['is_preview'] = $is_preview;

    \Timber::render( 'blocks/block-carousel-cards.twig', $context ); 
    // if(is_admin()){
    //     add_admin_script("block-carousel-cards");  
    // }      
}

