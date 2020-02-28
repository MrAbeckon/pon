<?php
include 'acf.php';

// THEME SETUP
if ( ! function_exists( 'pomocobetiam_setup' ) ):
  function pomocobetiam_setup() {
    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    // Add new Image Sizing
    add_image_size('detail', 260, 195, true);
    add_image_size('partners', 200, 122);
    // Creating medium cropping
    if (!get_option('medium_crop')) {
      add_option('medium_crop', '1');
    } else {
      update_option('medium_crop', '1');
    }
    // Register Navigation Menus
    register_nav_menus(
      array(
        'header' => 'hlmenu',
        )
    );
  }
endif;
add_action('after_setup_theme', 'pomocobetiam_setup');

// ENQUEUE
$js_v = '0.1';
$css_v = '0.1';
function enqueueGoogleApi(){
  // wp_enqueue_script ( 'google-api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyD8wff3dxcoXHYSJHnZNGMiXTctffRYwzU', array());
}
function enqueue_admin_styles_scripts() {
  enqueueGoogleApi();
  // wp_enqueue_style ('admin-style', get_template_directory_uri().'/css/admin-style.css', array());
}
add_action( 'admin_enqueue_scripts', 'enqueue_admin_styles_scripts');
function enqueue_styles_scripts() {
  // scripts
  if(is_single() && ('custom_post_type' == get_post_type())):
    enqueueGoogleApi();
    wp_enqueue_script ( 'google-map', get_template_directory_uri() . '/js/google-map.js', array('jquery'), $js_v);
  endif;
  // wp_enqueue_script ('cookie-consent', 'https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js', array());
  wp_enqueue_script ( 'core-script', get_template_directory_uri() . '/js/core.min.js', array('jquery'), $js_v);
  wp_enqueue_script ( 'script', get_template_directory_uri() . '/js/script.js', array('jquery'), $js_v);
  // styles
  wp_enqueue_style( 'bootstrap-css', get_template_directory_uri().'/stylesheets/bootstrap.min.css');
  wp_enqueue_style ('style', get_template_directory_uri().'/stylesheets/main.css', array(), $css_v);
  // wp_enqueue_style ('style-career', get_template_directory_uri().'/css/style-career.css', array(), $css_v);
  // wp_enqueue_style ('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
}
add_action( 'wp_enqueue_scripts', 'enqueue_styles_scripts' );

// RESET DEFAULTS
// Skryti menu itemu pro spravce webu
function remove_default_post_type() {
  global $current_user;
  if (in_array('editor', $current_user->roles)) {
    remove_menu_page('wpcf7');
    remove_menu_page('tools.php');
    remove_submenu_page( 'index.php', 'update-core.php' );
  }
  remove_menu_page('edit.php');
  remove_submenu_page('tools.php', 'import.php');
  remove_submenu_page('options-general.php', 'options-discussion.php');
}
add_action('admin_menu','remove_default_post_type');
// favicon settings
function favicon($rootPath) {
  echo '<link rel="apple-touch-icon" sizes="180x180" href="/'. $rootPath .'wp-content/themes/pomocobetiam/apple-touch-icon.png">';
  echo '<link rel="icon" type="image/png" sizes="32x32" href="/'. $rootPath .'wp-content/themes/pomocobetiam/favicon-32x32.png">';
  echo '<link rel="icon" type="image/png" sizes="16x16" href="/'. $rootPath .'wp-content/themes/pomocobetiam/favicon-16x16.png">';
  echo '<link rel="manifest" href="/'. $rootPath .'wp-content/themes/pomocobetiam/site.webmanifest">';
  echo '<link rel="mask-icon" href="/'. $rootPath .'wp-content/themes/pomocobetiam/safari-pinned-tab.svg" color="#5bbad5">';
  echo '<meta name="msapplication-TileColor" content="#da532c">';
  echo '<meta name="theme-color" content="#ffffff">';
}
// add_action('admin_head', 'favicon', '../');
// add_action('wp_enqueue_scripts', 'favicon', '');

// Skryti stranek ako homepage, organizacni pokyny
function hide_posts_pages() {
  global $current_user;
  if (in_array('editor', $current_user->roles)) {
      ?>
      <style>
          #post-49, #post-89{
              display:none;
          }
      </style>
      <?php
  }
}
// add_action('admin_head', 'hide_posts_pages');

// Smazani roli a zmena nazvu
function majales_change_role_name() {
  global $wp_roles;

  if ( ! isset( $wp_roles ) )
    $wp_roles = new WP_Roles();

  remove_role("subscriber");
  remove_role("author");
  remove_role("contributor");

  $wp_roles->roles['editor']['name'] = 'Správce webu';
  $wp_roles->role_names['editor'] = 'Správce webu';
}
add_action('init', 'majales_change_role_name');

// Zrušíme detailní výpis kde je chyba při přihlašování
function no_wordpress_errors() {
  return 'Chybné údaje!';
}
add_filter('login_errors', 'no_wordpress_errors');

// Odstranění zbytečných tagů z <head>
remove_action( 'wp_head', 'wp_generator' ) ;
remove_action( 'wp_head', 'wlwmanifest_link' ) ;
remove_action( 'wp_head', 'rsd_link' ) ;
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'gllr_add_for_ios', 10 ); //iOS inicializace Gallery
remove_action( 'wp_enqueue_scripts', 'gllr_wp_head',10 );//zbylé tagy od Gallery
remove_action( 'template_redirect', 'wp_shortlink_header', 11 );

//povolit při zapnutí debbugu
add_filter('show_admin_bar', '__return_false');


// POSTTYPES
/******************************  PREZENCNE KURZY  ******************************/
function prezencni_kurzy_init() {
  $labels = array(
    'name' => 'Prezenční kurzy',
    'singular_name' => 'Prezenční kurz',
    'add_new' => 'Přidat prezenční kurz',
    'add_new_item' => 'Přidat nový prezenční kurz',
    'edit_item' => 'Změnit prezenční kurz',
    'new_item' => 'Přidat prezenční kurz',
    'all_items' => 'Seznam',
    'view_item' => 'Zobrazit prezenční kurz',
    'search_items' => 'Hledat',
    'not_found' => 'Žádné prezenční kurzy nenalezeny',
    'not_found_in_trash' => 'Žádné prezenční kurzy nenalezeny',
    'parent_item_colon' => '',
    'menu_name' => 'Prezenční kurzy'
    );

  $info = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'prezencni-kurzy'),
    'capability_type' => 'post',
    'has_archive' => false,
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title'),
    'taxonomies' => array(),
    );

  register_post_type('prezencni-kurzy', $info);

  $labels = array(
    'name' => 'Kategorie prezenčních kurzů',
    'singular_name' => 'Kategorie prezenčního kurzu',
    'add_new' => 'Přidat kategorii prezenčního kurzu',
    'add_new_item' => 'Přidat novou kategorii prezenčního kurzu',
    'edit_item' => 'Změnit kategorii prezenčního kurzu',
    'new_item' => 'Přidat kategorii prezenčního kurzu',
    'all_items' => 'Seznam kategorii',
    'view_item' => 'Zobrazit kategorii prezenčního kurzu',
    'search_items' => 'Hledat kategorii',
    'not_found' => 'Žádné kategorie prezenčních kurzů nenalezeny',
    'not_found_in_trash' => 'Žádné kategorie prezenčních kurzů nenalezeny',
    'parent_item_colon' => '',
    'menu_name' => 'Kategorie prezenčních kurzů'
    );

  register_taxonomy('kategorie-prezencnich-kurzu', array('prezencni-kurzy'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'kategorie-prezencnich-kurzu'),
  ));

}
// add_action('init', 'prezencni_kurzy_init');
/******************************  end PREZENCNE KURZY  ******************************/

//Změna slova pro stránkování
  function my_custom_page_word() {
    global $wp_rewrite;
    $wp_rewrite->pagination_base = "strana";
  }
add_action('init', 'my_custom_page_word');

// function for sorting a dates for courses
function compareByTimeStamp($time1, $time2) 
{ 
    if (strtotime($time1) < strtotime($time2)) 
        return 1; 
    else if (strtotime($time1) > strtotime($time2))  
        return -1; 
    else
        return 0; 
} 

?>
