<?php

function get_theme_name() {
  $theme = wp_get_theme();
  return $theme->name;
}

function addTaxonomy($name, $type, $slug, $show = null) {
  // create a new taxonomy
  register_taxonomy(
    $slug,
    $type,
    array(
      'label' => $name,
      'rewrite' => array('slug' => $slug),
      'meta_box_cb' => $show
    )
  );
}


function addPostType($nome, $singular, $tipo, $icon, $supports = false) {

  $thisModule = THEME_DIR . "/modules/custom-post-types";
  $theme_name = get_theme_name();

  $labels = array (
    'name' => __($nome, $theme_name),
    'singular_name' => __($singular, $theme_name),
    'add_new' => __('Novo', $theme_name),
    'add_new_item' => __('Novo ' . $singular, $theme_name),
    'edit_item' => __('Editar ' . $singular, $theme_name),    
    'new_item' => __('Novo ' . $singular, $theme_name),
    'all_items' => __('Todos os ' . $nome, $theme_name),
    'view_item' => __('Ver este ' . $singular, $theme_name),
    'search_items' => __('Buscar ' . $nomes, $theme_name),
    'not_found' => __('Novo ' . $nome, $theme_name),
    'not_found_in_trash' => __('No ' . $nome . ' in Trash', $theme_name),
    'parent_item_colon' => '',    'menu_name' => __($nome, $theme_name)
    );

  /* If Supports */
  if(!$supports) {
    $supports = array (
      'title',
      'editor',
      //'author',
      'thumbnail',
      //'excerpt',
      //'comments',
      'revisions', 
      //'trackbacks'
    );
  }

  $args = array (
    'post_tag'=> false,
    'labels' => $labels,
    'public' => true,
    'exclude_from_search' => false,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'capability_type' => 'post',
    'rewrite' => array ('slug' => 'pt-' . $tipo),
    'hierarchical' => true, 
    'menu_position' => null,
    'menu_icon' => $icon,
    'supports' => $supports,    
    'taxonomies' => array('')
  );

  register_post_type($tipo, $args);
  flush_rewrite_rules();

}
?>