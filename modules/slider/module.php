<?php
if (class_exists("ModuleCanvas") && !class_exists("ModuleSlider")) {
    /**
     * Classe que cria slider
     *
     * @category   Modules
     * @version    Release: 1.0.0
     * @see        LoadModules
     * @since      Class available since Release 1.0.0
     */
    class ModuleSlider extends ModuleCanvas
    {
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
                'template' => array('theme_slider', THEME_PATH . "/modules/slider/templates/slider.php")
            );
        }

        /**
         * Contains JS & CSS scripts to be enqueue in the theme's frontend
         *
         * @return null
         *
         * @access public
         * @since Method available since Release 1.0.0
         */
        public function scripts()
        {
            wp_enqueue_script('swiper', THEME_DIR . "/modules/slider/assets/idangerous.swiper.min.js", false, "2.6.0", true);
            wp_enqueue_style('swiper', THEME_DIR . "/modules/slider/assets/idangerous.swiper.css", false, "2.6.0");
        }

        /**
         * Injects new Settings
         *
         * @return null
         *
         * @access public
         * @since Method available since Release 1.0.0
         */
        public function reduxInjectSections($sections)
        {
            return $sections;
        }
    }
    /* Class Ends */

    /* Runs Module */
    new ModuleSlider();
}