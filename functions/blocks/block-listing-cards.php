<?php

function block_listing_cards_render_callback( $block, $content = '', $is_preview = false ) {
    $context = \Timber::context();
    $context['block'] = $block;
    $context['fields'] = get_fields();
    $context['ajax_url'] = admin_url('admin-ajax.php');

    //Globaux
    $context['formations_default_picture'] = get_field('formations_default_picture', 'options');
    $context['events_default_picture'] = get_field('events_default_picture', 'options');
    $context['posts_default_picture'] = get_field('posts_default_picture', 'options');
    
    // Formations taxo for filters
    $context['levels'] = \Timber::get_terms('levels', array( 'hide_empty' => true, 'parent' => 0 ));
    $context['domains'] = \Timber::get_terms('domains', array( 'hide_empty' => true, 'parent' => 0 ));
    $context['rythms'] = \Timber::get_terms('rythms', array( 'hide_empty' => true, 'parent' => 0 ));
    $context['distant'] = \Timber::get_terms('distant', array( 'hide_empty' => true, 'parent' => 0 ));
    $context['linked_formations'] = \Timber::get_terms('linked_formations', array( 'hide_empty' => true, 'parent' => 0 )); 

    // Events taxo for filters
    $context['event_types'] = \Timber::get_terms('event_types', array( 'hide_empty' => true, 'parent' => 0 ));
    $context['countries'] = \Timber::get_terms('countries', array( 'hide_empty' => true, 'parent' => 0 ));
    $context['organizers'] = \Timber::get_terms('organizers', array( 'hide_empty' => true, 'parent' => 0 ));
    
    // Taxo communes
    $context['regions'] = \Timber::get_terms('regions', array( 'hide_empty' => true, 'parent' => 0 ));

    // Regular tags
    $context['categories'] = \Timber::get_terms('category', array( 'hide_empty' => true, 'parent' => 0 )); 

    $context['is_preview'] = $is_preview;
    
    global $paged;
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

    $postType = get_field( "listing_type" );

    $domain = get_field("domain");
    $region = get_field("region");
    $formation = get_field("formation");

   
    $args = array(
        'post_type' => $postType,
        'posts_per_page' => 12,
        'paged' => $paged,
    );

    // Query Articles
    if($domain){   
        $args['tax_query'][] = [
            array (
                'taxonomy' => 'domains',
                'field' => 'id',
                'terms' => array($domain),
            ),
        ];   
    }
    if($region){
        $args['tax_query'][] = [
            array (
                'taxonomy' => 'regions',
                'field' => 'id',
                'terms' => array($region),
            ),
        ];  
    }
    if($formation){
        $args['tax_query'][] = [
            array (
                'taxonomy' => 'linked_formations',
                'field' => 'id',
                'terms' => array($formation),
            ),
        ];  
    }
  

    $the_query = new WP_Query($args);
    $context['listPosts'] = Timber::get_posts($args);

    $pagination =  paginate_links( array(
        'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
        'total'        => $the_query->max_num_pages,
        'current'      => max( 1, get_query_var( 'paged' ) ),
        'format'       => '?paged=%#%',
        'show_all'     => false,
        'type'         => 'plain',
        'end_size'     => 2,
        'mid_size'     => 1,
        'prev_next'    => true,
        'prev_text'    => '',
        'next_text'    => '',
        'add_args'     => false,
        'add_fragment' => '',
    ) );
    $context['pagination'] = $pagination;
    \Timber::render( 'blocks/block-listing-cards.twig', $context );   
}