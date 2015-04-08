<?php

// Checamos se o modulo já existe
if (!class_exists('StartrSlider')) :

class StartrSlider {
  
  /**
   * Inicio do Modulo
   * Use o construct para adicionar todos os hook que envolvem o modulo, e abaixo adicione os metodos,
   * preferencialmente por ordem de declaração no __construct
   * @return null
   */
  public function __construct() {
    
    // Adiciona os Scripts no frontend
    add_action('wp_enqueue_scripts', array($this, 'frontendScripts'));
    
    // Criamos slider post type, para podermos escolher tudo
    add_action('init', array($this, 'addSliderPostType'));
    
  }
  
  /**
   * Adiciona os JS e CSSs no frontend
   * @return null
   */
  public function frontendScripts() {
    global $Tema;
    
    // Adiciona os scripts
    wp_enqueue_script('startr-slider-js', $Tema->URL('modules/slider/assets/idangerous.swiper.min.js'));
    
    // Adicionamos o CSS também
    wp_enqueue_style('startr-slider-css', $Tema->URL('modules/slider/assets/idangerous.swiper.css'));
    
  }
  
  /**
   * Criamos nosso novo custom post type
   * @return null
   */
  public function addSliderPostType() {
    global $Tema;
    
    // Labels 
    $labels = array(
      'name'          => __('Sliders', $Tema->textDomain),
      'singular_name' => __('Slider', $Tema->textDomain)
    );
      
    // Criamos nosso post type slider, para criamos os sliders do projeto
    register_post_type('slider', array(
      'labels'      => $labels,
      'menu_icon'   => 'dashicons-images-alt'
      'public'      => true,
      'has_archive' => false,
      'publicly_queryable' => false,
      )
    );
    
  }
  
}

// Rodamos o Modulo
new StartrSlider;

// Check da classe
endif;