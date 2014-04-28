<?php
if (!class_exists("ModuleCanvas")) {
    /**
     * Essa classe é uma facilitadora da crriação de módulos
     *
     * Ela funciona basicamente astraindo tarefas repetitivas na criação de plugins e módulos,
     * como enqueue de scripts, de css, hooks e etc.
     *
     * @category   Modules
     * @version    Release: 1.0.0
     * @see        LoadModules
     * @since      Class available since Release 1.0.0
     */
    class ModuleCanvas
    {
        /**
         * @var $config
         */
        private $config;

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
                'redux' => false,
                'scripts' => false,
                'adminScripts' => false,
                'shortcode' => false,
                'widget' => false,
                /* Switch: can be either false or the wordkit option to check */
                'switch' => false,
            );
        }

        /**
         * Handles automatic CSS and JS hooks, defined by those respective methods
         *
         * @return null
         *
         * @access public
         * @since Method available since Release 1.0.0
         */
        public function __construct()
        {
            /* Sets config */
            $this->config = $this->config();

            /*
             * If has switch, checks it
             */
            if (isset($this->config['switch']) && $this->config['switch']) {
                $wordkit_options = get_option('wordkit_options');

                if (isset($wordkit_options[$this->config['switch']]) && !$wordkit_options[$this->config['switch']]) {
                    //var_dump('you shall not pass!');
                    return;
                }
            }

            /*
             * Handles hooks, when necessary
             */

            /* Admin Scripts */
            if ($this->config['adminScripts']) {
                add_action('admin_enqueue_scripts', array($this, 'adminScripts'));
            }

            /* FrontendScripts */
            if ($this->config['scripts']) {
                add_action('wp_enqueue_scripts', array($this, 'scripts'));
            }

            /* Additional Hooks */
            $this->hooks();
            /* Runs */
            $this->run();
            /* After Run */
            $this>afterRun();
        }

        /**
         * Contains JS & CSS scripts to be enqueue in the admin dashboard
         *
         * @return null
         *
         * @access public
         * @since Method available since Release 1.0.0
         */
        public function adminScripts()
        {
            return;
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
            return;
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

        }

        /**
         * Creates the shortcodes
         *
         * @return null
         *
         * @access public
         * @since Method available since Release 1.0.0
         */
        public function shortcode()
        {

        }

        /**
         * Sets Default options for every shortcode and rturn options to extract
         *
         * @return array
         *
         * @access public
         * @since Method available since Release 1.0.0
         */
        public function shortcodeOptionsHelper($getCommon = array(), $settings = array())
        {
            /*
             * Common Settings ($common)
             * you can add these settings on the shortcode, by calling then in the $common param
             */
            $common = array(
                /* Type | Possible values: default, success, info, warning, danger */
                "type" => "default",
                /* Size | Possible values: small, normal, big, huge */
                "size" => "normal",
                /* Url | Possible values: any valid url */
                "url" => "#",
                /* Src | Possible values: any valid url to search, usually in iframes and so */
                "src" => "#",
                /* Width | Possible values: interger */
                "width" => "",
                /* height | Possible values: interger */
                "height" => "",
                /* Title | Possible values: a string */
                "title" => __('Title missing =(', 'wordkit'),
                /* Text | Possible values: string */
                "text" => __('Text missing =(', 'wordkit'),
                /* Style | Possible values: normal, light, dark */
                "style" => "normal"
            );

            /*
             * Default settings ($default = array())
             * The obrigatory options that every shortcode must have
             */

            $default = array(
                /* Extra Classes */
                "class" => ""
            );

            /*
             * Additional settings ($settings = array())
             * In addition to those common settings listed above, you can set specific settings, used only in certain
             * shortcodes.
             * You can also enter some of the common settings here (and only here), if its possible values are different
             * from the one previously setted.
             */

            /*
             * Now we return an array, containing the common settings selected, merged with additional settings and
             * the default ones.
             */

            if (!is_array($settings)) throw new Exception("Settings must be an array!");
            if (!is_array($getCommon)) throw new Exception("getCommon must be an array!");

            $return = array();
            foreach ($getCommon as $get) {
                if (array_key_exists($get, $common)) {
                    $return[$get] = $common[$get];
                }
            }

            /* Add custom Settings */
            $return = array_merge($return, $settings, $default);
            return $return;
        }

        /**
         * Initializes and handles the WP_Widget object or objects
         *
         * @return null
         *
         * @access public
         * @since Method available since Release 1.0.0
         */
        public function widget()
        {

        }

        /**
         * Handles the redux injections on the config, in order to keep priority
         * Available Filters:
         * - inject_redux_config
         * - inject_redux_sections
         *
         * @return null
         *
         * @access public
         * @since Method available since Release 1.0.0
         */
        public function redux()
        {
            /* Apply filters */
            add_filter('inject_redux_sections', array($this, "reduxInjectSections"));
            add_filter('inject_redux_configs', array($this, "reduxInjectConfigs"));
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

        /**
         * Changes Redux Settings (useful for themes)
         *
         * @return null
         *
         * @access public
         * @since Method available since Release 1.0.0
         */
        public function reduxInjectConfigs($args)
        {
            return $args;
        }

        /**
         * Hook the shortcodes and widgets methods to the wordpress
         *
         * @return null
         *
         * @access public
         * @since Method available since Release 1.0.0
         */
        public function run()
        {
            /* If it injects settings on redux */
            if ($this->config['redux']) {
                /* Run Method */
                add_action('init', array($this, 'redux'), 1);
            }

            /* If defines new shortcodes */
            if ($this->config['shortcode']) {
                /* Run Method */
                $this->shortcode();
            }

            /* If defines new widgets */
            if ($this->config['widget']) {
                /* Run Method */
                add_action('widgets_init', array(&$this, 'widget'), 0);
            }
        }

        /**
         * Hook actions to be called after the Run()
         *
         * @return null
         *
         * @access public
         * @since Method available since Release 1.0.0
         */
        public function afterRun()
        {

        }
    }
    /* Class Ends */
}