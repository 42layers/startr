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
          // Para manter o código organizado, separaremos em um arquivo a parte
          require_once "custom-fields.php";
        }
    }
    /* Class Ends */

    /* Runs Module */
    new ModulePostTypeProduct();
}