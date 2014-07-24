module.exports = function( grunt ) {
  'use strict';
  //
  // Grunt configuration:
  //
  // https://github.com/cowboy/grunt/blob/master/docs/getting_started.md
  //

  require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);


  var config = {
    sassFiles: ['scss/style.scss', 'scss/editor-style.scss'],
    uglify: []
  };

  grunt.initConfig({
    compass: {
      dist: {
        options: {
          sassDir: 'scss',
          imagesDir: 'img',
          cssDir: '.',
          javascriptsDir: 'js',
          fontsDir: 'fonts',
          relativeAssets: true,
          environment: 'development',
          specify: config.sassFiles
        }
      }
    },

    // default watch configuration
    watch: {
      compass: {
        files: '**/*.scss',
        tasks: ['compass', 'autoprefixer', 'csso']
      },
      livereload: {
        options: {
          livereload: true
        },
        files: ['**/*.css', '**/*.js', '**/*.php', '**/*.twig']
      },
    },

    autoprefixer: {
      options: {
        browsers: ['last 2 version', 'ie 8', 'ie 9']
      },
      dist: {
        options: {
          // Target-specific options go here.
        },
        src: '*.css',
        dest: ''
      }
    },

    csso: {
      compress: {
        options: {
          report: 'min'
        },
        files: {
          'main.css': ['style.css'],
          'editor-style.css': ['editor-style.css']
        }
      }
    },

    bowercopy: {
      js: {
        options: {
          destPrefix: 'js/vendor'
        },
        files: {
          'require.js': 'requirejs/require.js',
          'footable/footable.js': 'footable/dist/footable.min.js',
          'footable/footable.filter.js': 'footable/dist/footable.filter.min.js',
          'footable/footable.paginate.js': 'footable/dist/footable.paginate.min.js',
          'footable/footable.sort.js': 'footable/dist/footable.sort.min.js',
          // 'bxslider.js': 'bxslider-4/jquery.bxslider.min.js'
        }
      },
      scss: {
        options: {
          destPrefix: 'scss/vendor'
        },
        files: {
          '_normalize.scss': 'normalize.scss/_normalize.scss',
          '_scut.scss': 'scut/dist/_scut.scss',
          '_typecsset.scss': 'typecsset/typecsset.scss',
          '_breakpoint.scss': 'breakpoint-sass/stylesheets/_breakpoint.scss',
          'breakpoint': 'breakpoint-sass/stylesheets/breakpoint',
          '_susy.scss': 'susy/sass/_susy.scss',
          'susy': 'susy/sass/susy',
          '_modular-scale.scss': 'modular-scale/stylesheets/_modular-scale.scss',
          'modular-scale': 'modular-scale/stylesheets/modular-scale',
          '_animate.sass': 'animate.sass/stylesheets/_animate.sass',
          'animate': 'animate.sass/stylesheets/animate',
          '_sassybuttons.sass': 'sassy-buttons/_sassybuttons.sass',
          'sassy-buttons': 'sassy-buttons/sassy-buttons',
          '_hint.scss': 'hint.css/hint.css',
          '_footable.scss': 'footable/css/footable.core.css',
        }
      },
      fonts: {
        options: {
          destPrefix: 'fonts'
        },
        files: {
          'footable.eot': 'footable/css/fonts/footable.eot',
          'footable.svg': 'footable/css/fonts/footable.svg',
          'footable.ttf': 'footable/css/fonts/footable.ttf',
          'footable.woff': 'footable/css/fonts/footable.woff'
        }
      }
    },

    favicons: {
      options: {
        // Task-specific options go here.
        appleTouchBackgroundColor: '#FFFFFF',
        tileColor: '#FF702E',
        androidHomescreen: true,
        html: 'views/partials/head.twig',
        HTMLPrefix: '{{icon_path}}',
        trueColor: true,
      },
      your_target: {
        src: 'icons/icon.png',
        dest: 'icons'
      },
    },

    requirejs: {
      compile: {
        options: {
          baseUrl: "js",
          mainConfigFile: "js/main.js",
          name: "main",
          out: "js/main.min.js"
        }
      }
    }

});


grunt.registerTask('default', ['watch']);
grunt.registerTask('build', ['bowercopy', 'compass', 'autoprefixer', 'csso', 'requirejs']);

};
