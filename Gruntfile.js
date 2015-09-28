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
    sassPartials: ['scss/**/_*.scss', 'scss/*.scss'],
    cssFiles: ['style.css', 'main.css'],
    jsFiles: ['js/**/*.js'],
    templateFiles: ['**/*.php', 'views/**/*.twig']
  };
  config.allSassFiles = config.sassFiles.concat(config.sassPartials);
  config.bsFiles = config.cssFiles.concat(config.jsFiles).concat(config.templateFiles);

  grunt.initConfig({
    sass: {
      options: {
        sourceMap: true
      },
      dist: {
        files: {
          'style.css': 'scss/style.scss',
          'editor-style.css': 'scss/editor-style.scss'
        }
      }
    },

    watch: {
        js: {
          files: 'js/**/*.js',
          // tasks: ['jsCompileDev']
        },
        sass: {
          files: 'scss/**/*.scss',
          tasks: ['cssCompileDev']
        }
      },

    browserSync: {
      dev: {
        bsFiles: {
          src: config.bsFiles
        },
        options: {
          watchTask: true,
          debugInfo: true,
          open: false,
          proxy: 'https://local.dms.dev',
        }
      }
    },

    autoprefixer: {
      options: {
        browsers: ['last 2 version']
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
          'footable/footable.js': 'footable/dist/footable.min.js',
          'footable/footable.filter.js': 'footable/dist/footable.filter.min.js',
          'footable/footable.paginate.js': 'footable/dist/footable.paginate.min.js',
          'footable/footable.sort.js': 'footable/dist/footable.sort.min.js',
          'leaflet.js': 'leaflet/dist/leaflet.js',
          'slideout.js': 'slideout.js/dist/slideout.min.js'
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
          '_hint.scss': 'hint.css/hint.css',
          '_footable.scss': 'footable/css/footable.core.css',
          '_leaflet.scss': 'leaflet/dist/leaflet.css',
          '_slideout.scss': 'slideout.js/index.css',
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
        html: 'views/partials/icons.twig',
        HTMLPrefix: '{{icon_path}}',
        trueColor: true,
      },
      your_target: {
        src: 'icons/icon.png',
        dest: 'icons'
      },
    },

    clean: {
      icons: ['views/partials/icons.twig']
    },

});


  grunt.registerTask('cssCompileDev', ['sass']);
  grunt.registerTask('cssCompileDist', ['sass', 'autoprefixer', 'csso']);
  grunt.registerTask('iconsCompile', ['clean:icons', 'favicons']);
  grunt.registerTask('default', ['browserSync', 'watch']);
  grunt.registerTask('serve', ['default']);
  grunt.registerTask('build', ['bowercopy', 'cssCompileDist', 'iconsCompile']);

};
