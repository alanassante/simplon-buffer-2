<?php
add_action('acf/init', 'my_acf_init');

function my_acf_init()
{
    // Bail out if function doesn’t exist.
    
    // Register a new block.

    acf_register_block(
        array(
            'name'            => 'hero-section',
            'title'           => __('Bloc hero section', 'your-text-domain'),
            'render_callback' => 'block_hero_section_render_callback',
            'category'        => 'formatting',
            'icon'            => 'admin-comments',
            'mode'            => 'auto',
            
            'keywords'        => array('hero', 'section'),

        ),
    );
    
    
    acf_register_block(
        array(
            'name'            => 'media-carousel',
            'title'           => __('Bloc carousel média', 'your-text-domain'),
            'render_callback' => 'block_media_carousel_render_callback',
            'category'        => 'formatting',
            'icon'            => 'admin-comments',
            'mode'            => 'auto',
            'keywords'        => array('example'),
            
        ),
    );
    acf_register_block(
        array(
            'name'            => 'tabs',
            'title'           => __('Bloc onglets', 'your-text-domain'),
            'render_callback' => 'block_tabs_render_callback',
            'category'        => 'formatting',
            'icon'            => 'admin-comments',
            'mode'            => 'auto',
            'keywords'        => array('example'),
        ),
    );
    acf_register_block(
        array(
            'name'            => 'listing-cards',
            'title'           => __('Bloc liste de cartes', 'your-text-domain'),
            'render_callback' => 'block_listing_cards_render_callback',
            'category'        => 'formatting',
            'icon'            => 'admin-comments',
            'mode'            => 'auto',
            'keywords'        => array('example'),
        ),
    );
    acf_register_block(
        array(
            'name'            => 'courses',
            'title'           => __('Bloc parcours de formation', 'your-text-domain'),
            'render_callback' => 'block_courses_render_callback',
            'category'        => 'formatting',
            'icon'            => 'admin-comments',
            'mode'            => 'auto',
            'keywords'        => array('example'),
        ),
    );
    acf_register_block(
        array(
            'name'            => 'courses-v2',
            'title'           => __('Bloc parcours de formation v2', 'your-text-domain'),
            'render_callback' => 'block_courses_v2_render_callback',
            'category'        => 'formatting',
            'icon'            => 'admin-comments',
            'mode'            => 'auto',
            'keywords'        => array('example'),
        ),
    );
    acf_register_block(
        array(
            'name'            => 'hero-form',
            'title'           => __('Bloc hero formulaire', 'your-text-domain'),
            'render_callback' => 'block_hero_form_render_callback',
            'category'        => 'formatting',
            'icon'            => 'admin-comments',
            'mode'            => 'auto',
            'keywords'        => array('example'),
        ),
    );
    acf_register_block(
        array(
            'name'            => 'hero-blog',
            'title'           => __('Bloc hero blog', 'your-text-domain'),
            'render_callback' => 'block_hero_blog_render_callback',
            'category'        => 'formatting',
            'icon'            => 'admin-comments',
            'mode'            => 'auto',
            'keywords'        => array('example'),
        ),
    );
    acf_register_block(
        array(
            'name'            => 'thumbnails',
            'title'           => __('Bloc vignettes', 'your-text-domain'),
            'render_callback' => 'block_thumbnails_render_callback',
            'category'        => 'formatting',
            'icon'            => 'admin-comments',
            'mode'            => 'auto',
            'keywords'        => array('example'),
        ),
    );
    acf_register_block(
        array(
            'name'            => 'text-image',
            'title'           => __('Bloc texte & image', 'your-text-domain'),
            'render_callback' => 'block_text_image_render_callback',
            'category'        => 'formatting',
            'icon'            => 'admin-comments',
            'mode'            => 'auto',
            'keywords'        => array('example'),
        ),
    );
    acf_register_block(
        array(
            'name'            => 'partners',
            'title'           => __('Bloc partenaire', 'your-text-domain'),
            'render_callback' => 'block_partners_render_callback',
            'category'        => 'formatting',
            'icon'            => 'admin-comments',
            'mode'            => 'auto',
            'keywords'        => array('example'),
        ),
    );
    acf_register_block(
        array(
            'name'            => 'testimony',
            'title'           => __('Bloc témoignage', 'your-text-domain'),
            'render_callback' => 'block_testimony_render_callback',
            'category'        => 'formatting',
            'icon'            => 'admin-comments',
            'mode'            => 'auto',
            'keywords'        => array('example'),
        ),
    );
    acf_register_block(
        array(
            'name'            => 'banner-carousel',
            'title'           => __('Bloc bannière carousel', 'your-text-domain'),
            'render_callback' => 'block_banner_carousel_render_callback',
            'category'        => 'formatting',
            'icon'            => 'admin-comments',
            'mode'            => 'auto',
            'keywords'        => array('example'),
        ),
    );
    acf_register_block(
        array(
            'name'            => 'key-numbers',
            'title'           => __('Bloc chiffres clefs', 'your-text-domain'),
            'render_callback' => 'block_key_numbers_render_callback',
            'category'        => 'formatting',
            'icon'            => 'admin-comments',
            'mode'            => 'auto',
            'keywords'        => array('example'),
        ),
    );
    acf_register_block(
        array(
            'name'            => 'contact-form',
            'title'           => __('Bloc formulaire de contact', 'your-text-domain'),
            'render_callback' => 'block_contact_form_render_callback',
            'category'        => 'formatting',
            'icon'            => 'admin-comments',
            'mode'            => 'auto',
            'keywords'        => array('example'),
        ),
    );
    acf_register_block(
        array(
            'name'            => 'latest-articles',
            'title'           => __('Bloc derniers articles', 'your-text-domain'),
            'render_callback' => 'block_latest_articles_render_callback',
            'category'        => 'formatting',
            'icon'            => 'admin-comments',
            'mode'            => 'auto',
            'keywords'        => array('example'),
        ),
    );
    acf_register_block(
        array(
            'name'            => 'faq',
            'title'           => __('Bloc faq', 'your-text-domain'),
            'render_callback' => 'block_faq_render_callback',
            'category'        => 'formatting',
            'icon'            => 'admin-comments',
            'mode'            => 'auto',
            'keywords'        => array('example'),
        ),
    );
    acf_register_block(
        array(
            'name'            => 'carousel-cards',
            'title'           => __('Bloc carousel cards', 'your-text-domain'),
            'render_callback' => 'block_carousel_cards_render_callback',
            'category'        => 'formatting',
            'icon'            => 'admin-comments',
            'mode'            => 'auto',
            'keywords'        => array('example'),
        ),
    );

    acf_register_block(
        array(
            'name'            => 'timeline-courses',
            'title'           => __('Bloc Timeline courses', 'your-text-domain'),
            'render_callback' => 'block_timeline_courses_render_callback',
            'category'        => 'formatting',
            'icon'            => 'admin-comments',
            'mode'            => 'auto',
            'keywords'        => array('example'),
        ),
    );
    acf_register_block(
        array(
            'name'            => 'codir',
            'title'           => __('Bloc Codir', 'your-text-domain'),
            'render_callback' => 'block_codir_render_callback',
            'category'        => 'formatting',
            'icon'            => 'admin-comments',
            'mode'            => 'auto',
            'keywords'        => array('example'),
        ),
    );
    acf_register_block(
        array(
            'name'            => 'jobs-offer',
            'title'           => __('Bloc Jobs Offers', 'your-text-domain'),
            'render_callback' => 'block_jobs_offers_render_callback',
            'category'        => 'formatting',
            'icon'            => 'admin-comments',
            'mode'            => 'auto',
            'keywords'        => array('job','offre'),
        ),
    );
    acf_register_block(
        array(
            'name'            => 'timeline-history',
            'title'           => __('Bloc Timeline History', 'your-text-domain'),
            'render_callback' => 'block_timeline_history_render_callback',
            'category'        => 'formatting',
            'icon'            => 'admin-comments',
            'mode'            => 'auto',
            'keywords'        => array('timeline','chronologie'),
        ),
    );
    acf_register_block(
        array(
            'name'            => 'video',
            'title'           => __('Bloc Video', 'your-text-domain'),
            'render_callback' => 'block_video_render_callback',
            'category'        => 'formatting',
            'icon'            => 'admin-comments',
            'mode'            => 'auto',
            'keywords'        => array('video'),
        ),
    );

    acf_register_block(
        array(
            'name'            => 'map',
            'title'           => __('Bloc map', 'your-text-domain'),
            'render_callback' => 'block_map_render_callback',
            'category'        => 'formatting',
            'icon'            => 'admin-comments',
            'mode'            => 'auto',
            'keywords'        => array('carte','map'),
        ),
    );
    acf_register_block(
        array(
            'name'            => 'quote',
            'title'           => __('Bloc citation', 'your-text-domain'),
            'render_callback' => 'block_quote_render_callback',
            'category'        => 'formatting',
            'icon'            => 'admin-comments',
            'mode'            => 'auto',
            'keywords'        => array('citation', 'quote'),
        ),
    );
    acf_register_block(
        array(
            'name'            => 'sub-nav',
            'title'           => __('Bloc sub navigation', 'your-text-domain'),
            'render_callback' => 'block_sub_nav_render_callback',
            'category'        => 'formatting',
            'icon'            => 'admin-comments',
            'mode'            => 'auto',
            'keywords'        => array('citation', 'sub-nav'),
        ),
    );
    acf_register_block(
        array(
            'name'            => 'hero-lp',
            'title'           => __('Bloc hero lp', 'your-text-domain'),
            'render_callback' => 'block_hero_lp_render_callback',
            'category'        => 'formatting',
            'icon'            => 'admin-comments',
            'mode'            => 'auto',
            'keywords'        => array('citation', 'hero-lp'),
        ),
    );
    acf_register_block(
        array(
            'name'            => 'columns-lp',
            'title'           => __('Block colonnes lp', 'your-text-domain'),
            'render_callback' => 'block_columns_lp_render_callback',
            'category'        => 'formatting',
            'icon'            => 'admin-comments',
            'mode'            => 'auto',
            'keywords'        => array('citation', 'columns-lp'),
        ),
    );
    acf_register_block(
        array(
            'name'            => 'horizontal-steps',
            'title'           => __('Block étapes horizontales', 'your-text-domain'),
            'render_callback' => 'block_horizontal_steps_render_callback',
            'category'        => 'formatting',
            'icon'            => 'admin-comments',
            'mode'            => 'auto',
            'keywords'        => array('citation', 'horizontal-steps'),
        ),
    );
    acf_register_block(
        array(
            'name'            => 'tabs-lp',
            'title'           => __('Block onglets lp', 'your-text-domain'),
            'render_callback' => 'block_tabs_lp_render_callback',
            'category'        => 'formatting',
            'icon'            => 'admin-comments',
            'mode'            => 'auto',
            'keywords'        => array('citation', 'tabs-lp'),
        ),
    );
}
