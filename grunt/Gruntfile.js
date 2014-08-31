'use strict';
module.exports = function (grunt, init) {

  grunt.initConfig({

    pkg: grunt.file.readJSON('package.json'),

    push_svn: {
      options: {
        remove: false,
        pushIgnore: ['../**/*.tmp', '../**/node_modules/'],
        removeIgnore: ['**/*.gif']
      },
      main: {
        src: './../',
        dest: 'https://svn.example.com/path/to/your/repo',
        tmp: './.build'
      },
    },

    // phplint: {
    //     options: {
    //       swapPath: '/tmp'
    //     },
    //     all: ['./../*.php', './../**/*.php']
    // },

    bumper: {
      options: {
        tasks: ['push_svn']
      }
    },

    jshint: {
      options: {
        jshintrc: '.jshintrc'
      },
      all: [
      'Gruntfile.js',
      '../assets/js/*.js',
      '!../assets/js/scripts.min.js'
      ]
    },
    less: {
      dist: {
        files: {
          '../assets/css/main.css': [
          '../assets/less/app.less'
          ]
        }
      }
    },
    cssmin: {
      options: {
        banner: '/*! <%= pkg.title %> - v<%= pkg.version %>\n' +
        ' * <%= pkg.homepage %>\n' +
        ' * Copyright (c) <%= grunt.template.today("yyyy") %>;' +
        ' */\n'
      },
      minify: {
        expand: true,

        cwd: '../assets/css/',
        src: ['main.css'],

        dest: '../assets/css/',
        ext: '.min.css'
      }
    },
    uglify: {
      dist: {
        files: {
          '../assets/js/scripts.min.js': [
          '../assets/js/plugins/bootstrap/transition.js',
          '../assets/js/plugins/bootstrap/alert.js',
          '../assets/js/plugins/bootstrap/button.js',
          '../assets/js/plugins/bootstrap/carousel.js',
          '../assets/js/plugins/bootstrap/collapse.js',
          '../assets/js/plugins/bootstrap/dropdown.js',
          '../assets/js/plugins/bootstrap/modal.js',
          '../assets/js/plugins/bootstrap/tooltip.js',
          '../assets/js/plugins/bootstrap/popover.js',
          '../assets/js/plugins/bootstrap/scrollspy.js',
          '../assets/js/plugins/bootstrap/tab.js',
          '../assets/js/plugins/bootstrap/affix.js',
          '../assets/js/plugins/*.js',
          '../assets/js/_*.js'
          ]
        },
        options: {
                    // JS source map: to enable, uncomment the lines below and update sourceMappingURL based on your install
                    // sourceMap: '../assets/js/scripts.min.js.map',
                    // sourceMappingURL: '/app/themes/roots/assets/js/scripts.min.js.map'
                  }
                }
              },
              version: {
                options: {
                  file: '../lib/scripts.php',
                  css: '../assets/css/main.min.css',
                  cssHandle: 'roots_main',
                  js: '../assets/js/scripts.min.js',
                  jsHandle: 'roots_scripts'
                }
              },
              clean: {
                options: {
                  force: true,
                },
                dist: [
                '../assets/css/main.min.css',
                '../assets/js/scripts.min.js'
                ],
                main: ['../release/<%= pkg.version %>']
              },
              copy: {
            // Copy the plugin to a versioned release directory
            main: {
              src: [
              '**',
              '!node_modules/**',
              '!../release/**',
              '!../.git/**',
              '!../.svn/**',
              '!../.idea/**',
              '!../.sass-cache/**',
              '!../assets/less/**',
              '!../assets/js/plugins/**',
              '!../assets/js/_*.js',
              '!../assets/img/src/**',
              '!Gruntfile.js',
              '!package.json',
              '!../.gitignore',
              '!../.gitmodules'
              ],
              dest: '../release/<%= pkg.version %>/'
            }
          },
          compress: {
            main: {
              options: {
                mode: 'zip',
                archive: './../release/<%= pkg.name %>.<%= pkg.version %>.zip'
              },
              expand: true,
              cwd: '../release/<%= pkg.version %>/',
              src: ['**/*'],
              dest: '<%= pkg.name %>/'
            }
          },

          watch: {

            less: {
              files: [
              '../assets/less/*.less',
              '../assets/less/**/*.less',
              ],
              tasks: ['less', 'cssmin', 'version']
            },

            js: {
              files: [
              '<%= jshint.all %>'
              ],
              tasks: ['jshint', 'uglify', 'version']
            },

            livereload: {
                // Browser live reloading
                // https://github.com/gruntjs/grunt-contrib-watch#live-reloading
                options: {
                  livereload: false
                },
                files: [
                '../assets/css/main.min.css',
                '../assets/js/scripts.min.js',
                '../templates/*.php',
                '*.php'
                ]
              }
            }
          });

    // Load tasks
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-wp-version');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-compress');
    grunt.loadNpmTasks('grunt-bumper');
    grunt.loadNpmTasks('grunt-push-svn');

    // Register tasks
    grunt.registerTask('default', [
      'clean',
      'less',
      'cssmin',
      'uglify',
      'version'
    ]);

    grunt.registerTask('dev', [
      'watch'
    ]);

    grunt.registerTask('build', ['default', 'copy', 'compress']);

  };
