<?php

function get_theme_name() {
  $theme = wp_get_theme();
  return $theme->name;
}

function registrarTipo($nome, $tipo, $icon, $supports = false) {

  $thisModule = THEME_DIR . "/modules/custom-post-types";
  $theme_name = get_theme_name();

  $labels = array (
    'name' => __($nome, $theme_name),
    'singular_name' => __($nome, $theme_name),
    'add_new' => __('Novo', $theme_name),
    'add_new_item' => __('Novo ' . $nome, $theme_name),
    'edit_item' => __('Editar ' . $nome, $theme_name),    
    'new_item' => __('Novo ' . $nome, $theme_name),
    'all_items' => __('Todos ' . $nome, $theme_name),
    'view_item' => __('Ver este curso' . $nome, $theme_name),
    'search_items' => __('Buscar ' . $nome, $theme_name),
    'not_found' => __('Novo ' . $nome, $theme_name),
    'not_found_in_trash' => __('No ' . $nome . ' in Trash', $theme_name),
    'parent_item_colon' => '',    'menu_name' => __($nome, $theme_name)
    );

  /* If Supports */
  if(!$supports) {
    $supports = array (
      'title',
      'editor',
      'author',
      'thumbnail',
      'excerpt',
      'comments',
      'revisions', 
      'trackbacks'
    );
  }

  $args = array (
    'post_tag'=>true,
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
    'menu_icon' => $thisModule . '/assets/admin-icons/' . $icon,
    'supports' => $supports,    
    'taxonomies' => array('post_tag')
  );

  register_post_type($tipo, $args);
  flush_rewrite_rules();

}

/* RUN */
require_once "config.php";
?>