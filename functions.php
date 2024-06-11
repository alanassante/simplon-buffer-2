<?php
require_once(__DIR__ . '/vendor/autoload.php');
$timber = new \Timber\Timber();
$context['ajax_url'] = admin_url('admin-ajax.php');
$context['site_url'] = home_url(add_query_arg(array(), $wp->request));


function seopress_theme_slug_setup()
{
    add_theme_support('title-tag');
}

add_action('after_setup_theme', 'seopress_theme_slug_setup');
add_post_type_support('page', 'excerpt');


 // Load style in gutenberg editor 
 function theme_name_scripts() {
    wp_enqueue_script('script', get_template_directory_uri() . '/main.js', true);
    wp_dequeue_script( 'jquery' );
 }
 add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );




// Roles

function add_region_team_role() {
    $baseCaps = get_role( 'administrator' )->capabilities;
    $pluginCaps = array(
        // Add here the specific capabilities you want to remove
        
        'install_plugins',
        'activate_plugins',
        'deactivate_plugins',
        'update_plugins',
        'delete_plugins',
        'edit_plugins',
        'edit_theme_options', // This one is required to edit theme and plugin options
    );

    foreach ($pluginCaps as $cap) {
        if (isset($baseCaps[$cap])) {
            unset($baseCaps[$cap]);
        }
    }
    add_role( 'region_team', 'Equipe région', $baseCaps);
}
add_action( 'init', 'add_region_team_role' );

function add_region_admin_role() {
    $baseCaps = get_role( 'administrator' )->capabilities;
    $pluginCaps = array(
        // Add here the specific capabilities you want to remove
        'publish_posts',
        'install_plugins',
        'activate_plugins',
        'deactivate_plugins',
        'update_plugins',
        'delete_plugins',
        'edit_plugins',
        'edit_theme_options', // This one is required to edit theme and plugin options
    );

    foreach ($pluginCaps as $cap) {
        if (isset($baseCaps[$cap])) {
            unset($baseCaps[$cap]);
        }
    };
    add_role( 'region_admin', 'Admin region', $baseCaps );
}
add_action( 'init', 'add_region_admin_role' );
// Roles


//OPTIONS PAGE

  if(function_exists('acf_register_block')){
  acf_add_options_page(array(
      'page_title'     => 'Paramètres',
      'menu_title'    => 'Paramètres',
      'menu_slug'     => 'parametres',
      'capability'    => 'edit_posts',
      'redirect'        => true,
  ));
  }

//OPTIONS PAGE

//MENU

function menus_theme_setup() {
    register_nav_menus( array( 
      'menuprincipal' => 'Menu principal',
      'menufooter' => 'Menu footer', 
      'menusubfooter' => 'Menu sub footer', 
      'menufooterlp' => 'Menu footer lp',  
    ) );
}
add_action( 'after_setup_theme', 'menus_theme_setup' );
//MENU

//MENU & OPTIONS
add_filter('timber/context', 'add_to_context');
function add_to_context($context)
{
    $context['menuprincipal'] = new \Timber\Menu('menuprincipal');
    $context['menufooter'] = new \Timber\Menu('menufooter');
    $context['menusubfooter'] = new \Timber\Menu('menusubfooter');
    $context['menufooterlp'] = new \Timber\Menu('menufooterlp'); 
    $context['logo_header'] = get_field('logo_header','options');
    $context['logo_footer'] = get_field('logo_footer','options');
    $context['cta_header'] = get_field('cta_header','options'); 
    $context['socials'] = get_field('socials', 'options');
    return $context;
}



// ALL FUNCTIONS

  $dir =  get_stylesheet_directory() . '/functions/blocks';
  $files = glob($dir . '/*.php');

  foreach ($files as $file) {
      require_once($file);
  }

  add_theme_support( 'post-thumbnails' );

// ALL FUNCTIONS

// ALLOW SVG

  add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

    global $wp_version;
    if ( $wp_version !== '4.7.1' ) {
       return $data;
    }
  
    $filetype = wp_check_filetype( $filename, $mimes );
  
    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];
  
  }, 10, 4 );
  
  function cc_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
  }
  add_filter( 'upload_mimes', 'cc_mime_types' );
  
  function fix_svg() {
    echo '<style type="text/css">
          .attachment-266x266, .thumbnail img {
               width: 100% !important;
               height: auto !important;
          }
          </style>';
  }
  add_action( 'admin_head', 'fix_svg' );

// ALLOW SVG
 

add_action('wp_ajax_nopriv_get_formations', 'get_formations');
add_action('wp_ajax_get_formations', 'get_formations');
function get_formations()
{
    $context = Timber::get_context();
    $today = date("Ymd");
    $args = array(
        'post_type' => 'formations',
        'posts_per_page' => -1,
        'lang' =>  pll_current_language('slug'),
        'meta_query' => array(
            array(
                'key' => 'limit_date',
                'compare' => '>=',
                'value' => $today,
            ),
        ),
    );
    
    $context['formations'] = \Timber::get_posts($args);
    \Timber::render('blocks/block-filtered-formations.twig', $context);

    die();
}
add_action('wp_ajax_nopriv_get_events', 'get_events');
add_action('wp_ajax_get_events', 'get_events');
function get_events()
{
    $context = Timber::get_context();
    $today = date("Ymd");
    $args = array(
        'post_type' => 'events',
        'posts_per_page' => -1,
        'lang' =>  pll_current_language('slug'),
        'meta_query' => array(
            array(
                'key' => 'limit_date',
                'compare' => '>=',
                'value' => $today,
            ),
        ), 
    );
    $context['events'] = \Timber::get_posts($args);
    \Timber::render('blocks/block-filtered-events.twig', $context);

    die();
}

add_action('wp_ajax_nopriv_get_formations_filter', 'get_formations_filter');
add_action('wp_ajax_get_formations_filter', 'get_formations_filter');
function get_formations_filter()
{
    
    $context = Timber::get_context();
    $today = date("Ymd");
    // formations filter values
    $formations = $_POST['linked_formations'];
    $levels = $_POST['levels'];
    $domains = $_POST['domains'];
    $rythms = $_POST['rythms'];
    $regions = $_POST['regions'];
    $duree = $_POST['duree'];
    $distant = $_POST['distant'];
    
    $args = array(
        'post_type' => 'formations',
        'posts_per_page' => 12,
        'paged' => $paged,
        'meta_query' => array(
            array(
                'key' => 'limit_date',
                'compare' => '>=',
                'value' => $today,
            ),
        ),
    );
    // formations filter values
    
    if($formations){
        $args['tax_query'][] = [
            array(

                'taxonomy' => 'linked_formations',
                'field' => 'slug',
                'terms' => $formations,
            )
        ]; 
    }
    if($duree){
        $args['meta_query'][] = [array(
            
                'key'       => 'duree',
                'value'     => $duree,
                'type'      => 'NUMERIC',
                'compare'   => '<',
            ),
            
        ];
    };
    if ($levels) {
        $args['tax_query'][] = [
            array (
                'taxonomy' => 'levels',
                'field' => 'slug',
                'terms' => $levels,
            ),
        ];
    };
    if ($domains) {
        $args['tax_query'][] = [
            array (
                'taxonomy' => 'domains',
                'field' => 'slug',
                'terms' => $domains,
            ),
        ];
    };
    if ($distant) {
        $args['tax_query'][] = [
            array (
                'taxonomy' => 'distant',
                'field' => 'slug',
                'terms' => $distant,
            ),
        ];
    }
    if ($regions) {
        $args['tax_query'][] = [
  
            'relation' => 'OR',
              array(
                  'taxonomy' => 'regions',
                  'field' => 'slug',
                  'terms' => $regions,
              ),
              array( 
                  'taxonomy' => 'distant',
                  'field'    => 'slug',
                  'terms'    => 'distant', 
              ),
        ];
    };
    if ($rythms) {
      $args['tax_query'][] = [
          array (
              'taxonomy' => 'rythms',
              'field' => 'slug',
              'terms' => $rythms,
          ),
      ];
    };
    $context['formations_default_picture'] = get_field('formations_default_picture', 'options');
    $context['curated_formations'] = \Timber::get_posts($args);
    \Timber::render('blocks/block-filtered-formations.twig', $context);
    die();
}

add_action('wp_ajax_nopriv_get_events_filter', 'get_events_filter');
add_action('wp_ajax_get_events_filter', 'get_events_filter');
function get_events_filter()
{
    $context = Timber::get_context();
    $today = date("Ymd");
    $months = $_POST['months'];
    $countries = $_POST['countries'];
    $regions = $_POST['regions'];
    $types = $_POST['types'];
    $distant = $_POST['distant'];
    
    $args = array(
        'post_type' => 'events',
        'posts_per_page' => 12,
        'paged' => $paged,
        'meta_query' => array(
            array(
                'key' => 'limit_date',
                'compare' => '>=',
                'value' => $today,
            ),
        ),

    );
    if ($distant) {
        $args['tax_query'][] = [
            array (
                'taxonomy' => 'distant',
                'field' => 'slug',
                'terms' => $distant,
            ),
        ];
    };
    if ($regions) {
        $args['tax_query'][] = [
  
            'relation' => 'OR',
              array(
                  'taxonomy' => 'regions',
                  'field' => 'slug',
                  'terms' => $regions,
              ),
              array( 
                  'taxonomy' => 'distant',
                  'field'    => 'slug',
                  'terms'    => 'distant', 
              ),
        ];
    };
    if($months){
        $monthOnly = array_shift($months);
        $start_date = date('Y'.$monthOnly.'01'); // First day of the month
        $end_date = date('Y'.$monthOnly.'t'); // 't' gets the last day of the month

        $args['meta_query'][] = [array(
            'relation' => 'AND',
            array(
                'key'     => 'start_date', // Replace with your ACF field key
                'value'   => $start_date,
                'compare' => '>=',
                'type'    => 'DATE',
            ),
            array(
                'key'     => 'start_date', // Replace with your ACF field key
                'value'   => $end_date,
                'compare' => '<=',
                'type'    => 'DATE',
            ),
        ),];
    };
    if ($countries) {
      $args['tax_query'][] = [
          array (
              'taxonomy' => 'countries',
              'field' => 'slug',
              'terms' => $countries,
          ),
      ];
    };
    if ($types) {
      $args['tax_query'][] = [
          array (
              'taxonomy' => 'event_types',
              'field' => 'slug',
              'terms' => $types,
          ),
      ];
    };
    $context['events_default_picture'] = get_field('events_default_picture', 'options');
    $context['curated_events'] = \Timber::get_posts($args);
    \Timber::render('blocks/block-filtered-events.twig', $context);
    die();
}

function my_pagination( $args = array() ) {
    global $wp_query;
    $output = '';

    if ( $wp_query->max_num_pages <= 1 ) {
        return;
    }

    $pagination_args = array(
        'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
        'total'        => $wp_query->max_num_pages,
        'current'      => max( 1, get_query_var( 'paged' ) ),
        'format'       => '?paged=%#%',
        'show_all'     => false,
        'type'         => 'plain',
        'end_size'     => 2,
        'mid_size'     => 1,
        'prev_next'    => true,
        //'prev_text'    => __( '&laquo; Prev', 'text-domain' ),
        //'next_text'    => __( 'Next &raquo;', 'text-domain' ),
        //'prev_text'    => __( '&lsaquo; Prev', 'text-domain' ),
        //'next_text'    => __( 'Next &rsaquo;', 'text-domain' ),
        'prev_text'    => sprintf( '<i></i> %1$s',
            apply_filters( 'my_pagination_page_numbers_previous_text',
            __( 'Newer Posts', 'text-domain' ) )
        ),
        'next_text'    => sprintf( '%1$s <i></i>',
            apply_filters( 'my_pagination_page_numbers_next_text',
            __( 'Older Posts', 'text-domain' ) )
        ),
        'add_args'     => false,
        'add_fragment' => '',

        // Custom arguments not part of WP core:
        'show_page_position' => false, // Optionally allows the "Page X of XX" HTML to be displayed.
    );

    $pagination_args = apply_filters( 'my_pagination_args', array_merge( $pagination_args, $args ), $pagination_args );

    $output .= paginate_links( $pagination_args );

    // Optionally, show Page X of XX.
    if ( true == $pagination_args['show_page_position'] && $wp_query->max_num_pages > 0 ) {
        $output .= '<span class="page-of-pages">' .
                                    sprintf( __( 'Page %1s of %2s', 'text-domain' ), $pagination_args['current'], $wp_query->max_num_pages ) .
                '</span>';
    }

    return $output;
}

//  AJAX

//  CPT
//          formations
function codex_custom_init()
{
    register_post_type(
        'campuses',
        array(
            'label'                 => __('Campus'),
            'singular_label'        => __('campus'),
            'add_new_item'          => __('Ajouter un campus'),
            'edit_item'             => __('Modifier un campus'),
            'new_item'              => __('Nouveau campus'),
            'view_item'             => __('Voir le campus'),
            'search_items'          => __('Rechercher un campus'),
            'not_found'             => __('Aucun campus trouvé'),
            'not_found_in_trash'    => __('Aucun campus trouvé'),
            'public'                => true,
            'show_ui'               => true,
            'show_in_rest'          => true,
            'capability_type'       => 'post',
            'has_archive'           => true,
            'hierarchical'          => true,
            'menu_icon'             => 'dashicons-groups',
            'supports'              => array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'),
            'rewrite'               => array('slug' => 'campus', 'with_front' => false),
            'template_lock'         => 'insert',
            
        )
    );

}
// Sessions
{
    register_post_type(
        'sessions',
        array(
            'label'                 => __('Sessions'),
            'singular_label'        => __('Session'),
            'add_new_item'          => __('Ajouter une session'),
            'edit_item'             => __('Modifier une session'),
            'new_item'              => __('Nouvelle session'),
            'view_item'             => __('Voir la session'),
            'search_items'          => __('Rechercher une session'),
            'not_found'             => __('Aucune session trouvée'),
            'not_found_in_trash'    => __('Aucune session trouvé'),
            'public'                => true,
            'show_ui'               => true,
            'show_in_rest'          => true,
            'capability_type'       => 'post',
            'has_archive'           => true,
            'hierarchical'          => true,
            'menu_icon'             => 'dashicons-welcome-learn-more',
            'supports'              => array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'),
            'rewrite'               => array('slug' => 'sessions', 'with_front' => false),
            'template_lock'         => 'insert',
            
        )
    );
}

// events
{
  register_post_type(
      'events',
      array(
          'label'                 => __('Evènements'),
          'singular_label'        => __('Evènement'),
          'add_new_item'          => __('Ajouter un évènement'),
          'edit_item'             => __('Modifier un évènement'),
          'new_item'              => __('Nouvel évènement'),
          'view_item'             => __("Voir l'évènement"),
          'search_items'          => __('Rechercher un évènement'),
          'not_found'             => __('Aucun évènement trouvée'),
          'not_found_in_trash'    => __('Aucun évènement trouvé'),
          'public'                => true,
          'show_ui'               => true,
          'show_in_rest'          => true,
          'capability_type'       => 'post',
          'has_archive'           => true,
          'hierarchical'          => true,
          'menu_icon'             => 'dashicons-calendar-alt',
          'supports'              => array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'),
          'rewrite'               => array('slug' => 'events', 'with_front' => false),
          'template_lock'         => 'insert',
          
      )
  );
}
// Formation
{
    register_post_type(
        'formations',
        array(
            'label'                 => __('Formations'),
            'singular_label'        => __('Formation'),
            'add_new_item'          => __('Ajouter une formation'),
            'edit_item'             => __('Modifier une formation'),
            'new_item'              => __('Nouvelle formation'),
            'view_item'             => __("Voir la formation"),
            'search_items'          => __('Rechercher une formation'),
            'not_found'             => __('Aucune formation trouvée'),
            'not_found_in_trash'    => __('Aucune formation trouvé'),
            'public'                => true,
            'show_ui'               => true,
            'show_in_rest'          => true,
            'capability_type'       => 'post',
            'has_archive'           => true,
            'hierarchical'          => true,
            'menu_icon'             => 'dashicons-media-document',
            'supports'              => array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'),
            'rewrite'               => array('slug' => 'formations', 'with_front' => false),
            'template_lock'         => 'insert',
            
        )
    );
  }
// landing
{
    register_post_type(
        'landing-pages',
        array(
            'label'                 => __('Formations old'),
            'singular_label'        => __('Formation old'),
            'add_new_item'          => __('Ajouter une landing page'),
            'edit_item'             => __('Modifier une landing page'),
            'new_item'              => __('Nouvel landing page'),
            'view_item'             => __("Voir la landing page"),
            'search_items'          => __('Rechercher une landing page'),
            'not_found'             => __('Aucune landing page trouvée'),
            'not_found_in_trash'    => __('Aucune landing page trouvé'),
            'public'                => true,
            'show_ui'               => true,
            'show_in_rest'          => true,
            'capability_type'       => 'post',
            'has_archive'           => true,
            'hierarchical'          => true,
            'menu_icon'             => 'dashicons-media-document',
            'supports'              => array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'),
            'rewrite'               => array('slug' => 'landing-pages', 'with_front' => false),
            'template_lock'         => 'insert',
            
        )
    );
  }
add_action('init', 'codex_custom_init');

//taxonomies

register_taxonomy(
  'event_types',       // SLUG OF TAX
  'events',      // POST TYPE TO ATTACH
  array(
      'hierarchical' => true,
      'label' => "Types d'évènements",
      'singular_label' => "Type d'évènement",
      'show_ui'               => true,
      'show_in_rest'          => true,
      'query_var' => true,
      'rewrite' => array(
          'slug' => 'event_types',
          'with_front' => false
      )
  )
);

register_taxonomy(
    'countries',       // SLUG OF TAX
    'events',      // POST TYPE TO ATTACH
    array(
        'hierarchical' => true,
        'label' => 'Pays',
        'singular_label' => 'Pays',
        'show_ui'               => true,
        'show_in_rest'          => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'countries',
            'with_front' => false
        )
    )
);
register_taxonomy(
    'regions',       // SLUG OF TAX
    array( 'events', 'sessions' ),      // POST TYPE TO ATTACH
    array(
        'hierarchical' => true,
        'label' => 'Regions',
        'singular_label' => 'Region',
        'show_ui'               => true,
        'show_in_rest'          => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'regions',
            'with_front' => false
        )
    )
);
register_taxonomy(
'organizers',       // SLUG OF TAX
'events',      // POST TYPE TO ATTACH
array(
    'hierarchical' => true,
    'label' => 'Organisateurs',
    'singular_label' => 'Organisateur',
    'show_ui'               => true,
    'show_in_rest'          => true,
    'query_var' => true,
    'rewrite' => array(
        'slug' => 'organizers',
        'with_front' => false
    )
)
);

register_taxonomy(
'domains',       // SLUG OF TAX
array( 'sessions' ),      // POST TYPE TO ATTACH
array(
    'hierarchical' => true,
    'label' => 'Domaines',
    'singular_label' => 'Domaine',
    'show_ui'               => true,
    'show_in_rest'          => true,
    'query_var' => true,
    'rewrite' => array(
        'slug' => 'domains',
        'with_front' => false
    ),
    )
);
    register_taxonomy(
        'linked_formations',       // SLUG OF TAX
        array( 'sessions' ),       // POST TYPE TO ATTACH
        array(
            'hierarchical' => true,
            'label' => 'Formations associées',
            'singular_label' => 'Formation associée',
            'show_ui'               => true,
            'show_in_rest'          => true,
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'linked_formations',
                'with_front' => false
            ),
        )
    );
    register_taxonomy(
        'levels',       // SLUG OF TAX
        array(  'sessions' ),     // POST TYPE TO ATTACH
        array(
            'hierarchical' => true,
            'label' => 'Niveaux',
            'singular_label' => 'Niveau',
            'show_ui'               => true,
            'show_in_rest'          => true,
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'levels',
                'with_front' => false
            )
        )
    );
    register_taxonomy(
        'rythms',       // SLUG OF TAX
        array(  'sessions' ),       // POST TYPE TO ATTACH
        array(
            'hierarchical' => true,
            'label' => 'Rythmes',
            'singular_label' => 'Rythme',
            'show_ui'               => true,
            'show_in_rest'          => true,
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'rythms',
                'with_front' => false
            )
        )
    );
    register_taxonomy(
        'distant',       // SLUG OF TAX
        array( 'events', 'sessions' ),      // POST TYPE TO ATTACH
        array(
            'hierarchical' => true,
            'label' => 'Distanciel',
            'singular_label' => 'Distanciel',
            'show_ui'               => true,
            'show_in_rest'          => true,
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'distant',
                'with_front' => false
            )
        )
    );

  
  
  








