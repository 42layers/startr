<?php
if (class_exists("ModuleCanvas") && !class_exists("ModulePostTypeProduct")) {
    /**
     * Classe que cria slider
     *
     * @category   Modules
     * @version    Release: 1.0.0
     * @see        LoadModules
     * @since      Class available since Release 1.0.0
     */
    class ModulePostTypeProduct extends ModuleCanvas
    {
      // Definimos o nome do custom post type
      public $name = 'product';

        /**
         * Tells construct what to hook
         *
         * @return array
         *
         * @access public
         * @since Method available since Release 1.0.0
         */
        public function config()
        {
            return array(
                'redux' => true,
                'scripts' => true,
                'adminScripts' => false,
                'shortcode' => false,
                'widget' => false,
                'switch' => false,
                'template' => false
            );
        }

        /**
         * Handles additional hooks, using another methods declared in extended classes
         *
         * @return null
         *
         * @access public
         * @since Method available since Release 1.0.0
         */
        public function hooks()
        {
          // Registramos o nosso custom post type
          // Veja os icones disponíveis em: http://melchoyce.github.io/dashicons/
          addPostType("Produtos", "Produto", $this->name, 'dashicons-cart');

          // Registramos Taxonomia Fabricante para esse custom post type
          addTaxonomy('Fabricante', array($this->name), 'fabricante');

          // Adicionamos todos os custom fields exportados de produtos
          add_action("init", array($this, 'customFields'));
        }

        public function customFields() {

          if(function_exists("register_field_group")) {
            
            register_field_group(array (
              'id' => 'acf_avaliacao',
              'title' => 'Avaliação',
              'fields' => array (
                array (
                  'key' => 'field_5415972f856df',
                  'label' => 'Avaliação do Produto',
                  'name' => 'rating',
                  'type' => 'star_rating',
                  'instructions' => 'Selecione a avaliação desse produto.',
                  'number' => 5,
                  'default_value' => 2,
                ),
              ),
              'location' => array (
                array (
                  array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => $this->name,
                    'order_no' => 0,
                    'group_no' => 0,
                  ),
                ),
              ),
              'options' => array (
                'position' => 'side',
                'layout' => 'default',
                'hide_on_screen' => array (
                ),
              ),
              'menu_order' => 0,
            ));
            register_field_group(array (
              'id' => 'acf_produtos',
              'title' => 'Produtos',
              'fields' => array (
                array (
                  'key' => 'field_5415935372427',
                  'label' => 'Especificações Técnicas',
                  'name' => 'specs',
                  'type' => 'wysiwyg',
                  'instructions' => 'Use esse campo para adicionar as Especificações técnicas de cada produto.',
                  'default_value' => '',
                  'toolbar' => 'basic',
                  'media_upload' => 'no',
                ),
              ),
              'location' => array (
                array (
                  array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => $this->name,
                    'order_no' => 0,
                    'group_no' => 0,
                  ),
                ),
              ),
              'options' => array (
                'position' => 'normal',
                'layout' => 'no_box',
                'hide_on_screen' => array (
                ),
              ),
              'menu_order' => 0,
            ));
          }

        }
    }
    /* Class Ends */

    /* Runs Module */
    new ModulePostTypeProduct();
}