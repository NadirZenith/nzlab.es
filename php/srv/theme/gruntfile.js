'use strict';

const sass = require('node-sass');

module.exports = function(grunt) {
    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        env: {
            all: {
                src: '../.env'
            }
        },
        concat: {
            options: {
                banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n',
                process: function(src, filepath) {
                    return '// Source: ' + filepath + '\n' +
                        src.replace(/(^|\n)[ \t]*('use strict'|"use strict");?\s*/g, '$1');
                }
            },
            src: {
                src: [
                    'src/App.js',
                    'src/Component.js',
                    'src/Component/*.js',
                    'src/Service/*.js'
                ],
                dest: 'dist/js/theme.js'
            },
            dist: {
                src: [
                    'dist/js/vendor.js',
                    'dist/js/theme.js',
                ],
                dest: 'dist/js/app.js'
            },
            vendors: {
                src: [
                    'node_modules/jquery/dist/jquery.js',
                    'node_modules/bootstrap/dist/js/bootstrap.bundle.js',
                    // 'node_modules/popper.js/dist/popper.js',
                    'node_modules/izimodal/js/iziModal.js',
                    'node_modules/slick-carousel/slick/slick.js',
                ],
                dest: 'dist/js/vendor.js'
            }
        },
        uglify: {
            options: {
                banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
            },
            theme: {
                src: [
                    'dist/js/theme.js'
                ],
                dest: 'dist/js/theme.min.js'
            },
            dist: {
                src: [
                    'dist/js/app.js'
                ],
                dest: 'dist/js/app.min.js'
            },
            vendors: {
                src: [
                    'dist/js/vendor.js'
                ],
                dest: 'dist/js/vendor.min.js'
            }
        },
        sass: {
            options: {
                implementation: sass,
                // functions: {
                //     getenv: function(variable) {
                //         const env = grunt.config.get('ENV');
                //         const value = env[variable.getValue()];
                //
                //         if (value) {
                //             return sass.types.String(value);
                //         }
                //
                //         throw new Error('You should define the ' + variable.getValue() + ' .env variable. amigo');
                //     }
                // }
            },
            compile: {
                files: {
                    'dist/css/theme.css': 'var/scss/theme.scss'
                }
            }
        },
        postcss: {
            options: {
                map: false, // inline sourcemaps
                processors: [
                    require('autoprefixer')({browsers: 'last 2 versions'}), // add vendor prefixes
                    require('cssnano')() // minify the result
                ]
            },
            dist: {
                src: 'dist/css/*.css'
            }
        },
        imagemin: {                          // Task
            dynamic: {                         // Target
                options: {                       // Target options
                    optimizationLevel: 3,
                    progressive: true
                },
                files: [{
                    expand: true,                  // Enable dynamic expansion
                    cwd: 'var/img/',                   // Src matches are relative to this path
                    src: ['**/*.{png,jpg,gif}'],   // Actual patterns to match
                    dest: 'dist/img/'                  // Destination path prefix
                }]
            }
        },
        watch: {
            grunt: {
                files: [
                    "gruntfile.js"
                ],
                tasks: ['build:all']
            },
            sass: {
                files: [
                    "var/scss/**/*"
                ],
                tasks: ['build:css']
            },
            js: {
                files: [
                    'src/**/*.js'
                ],
                tasks: ['build:src']
            },
            icon: {
                files: [
                    "var/icon/**/*"
                ],
                tasks: ['copy:icons']
            },
            font: {
                files: [
                    "var/font/**/*"
                ],
                tasks: ['copy:fonts']
            },
            img: {
                files: [
                    "var/img/**/*"
                ],
                tasks: ['imagemin:dynamic']
            },
            php: {
                files: [
                    "var/php/**/*"
                ],
                tasks: ['copy:php']
            }
        },
        copy: {
            fonts: {
                cwd: 'var/font',
                src: '**',
                dest: 'dist/font',
                expand: true,
                flatten: false
            },
            icons: {
                cwd: 'var/icon',
                src: '**',
                dest: 'dist/icon',
                expand: true,
                flatten: true
            },
            php: {
                src: 'var/php/index.php',
                dest: 'dist/php/index.php',
            },
            vendors: {
                files: [
                    {
                        expand: true,
                        cwd: 'node_modules/bootstrap/scss/',
                        src: ['**'],
                        dest: 'var/scss/vendor/bootstrap/'
                    },{
                        expand: true,
                        cwd: 'node_modules/bootswatch/dist/',
                        src: ['**'],
                        dest: 'var/scss/vendor/bootswatch/'
                    },
                    {
                        expand: true,
                        src: ['node_modules/izimodal/css/iziModal.css'],
                        dest: 'var/scss/vendor/modal/',
                        flatten: true,
                        filter: 'isFile',

                        rename: function(dest, src) {
                            return dest + src.replace('.css','.scss');
                        }
                    },
                    {
                        expand: true,
                        src: ['node_modules/slick-carousel/slick/slick.css'],
                        dest: 'var/scss/vendor/slider/',
                        flatten: true,
                        filter: 'isFile',

                        rename: function(dest, src) {
                            return dest + src.replace('.css','.scss');
                        }
                    },
                    {
                        expand: true,
                        src: ['node_modules/slick-carousel/slick/slick-theme.css'],
                        dest: 'var/scss/vendor/slider/',
                        flatten: true,
                        filter: 'isFile',

                        rename: function(dest, src) {
                            return dest + src.replace('.css','.scss');
                        }
                    }
                ]
            }
        }
    });

    // Loads
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-env');
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-postcss');
    grunt.loadNpmTasks('grunt-contrib-imagemin');
    grunt.loadNpmTasks('grunt-newer');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-concat');

    // Default task(s).
    grunt.registerTask('env:load', 'Load .env variables', function() {
        grunt.config('ENV', process.env);
    });

    grunt.registerTask('build:env', [
        'env:all',
        'env:load'
    ]);

    grunt.registerTask('build:asset', [
        'build:env',
        'imagemin:dynamic',
        'copy:fonts',
        'copy:icons',
        'copy:php'
    ]);

    grunt.registerTask('build:css', [
        'build:env',
        'sass:compile',
        'postcss:dist'
    ]);

    grunt.registerTask('build:vendors', [
        'build:env',
        'concat:vendors',
        'uglify:vendors',
    ]);

    grunt.registerTask('build:src', [
        'build:env',
        'concat:src',
        'uglify:theme',
        'concat:dist',
        'uglify:dist',
    ]);

    grunt.registerTask('build:js', [
        'build:vendors',
        'build:src',
    ]);

    grunt.registerTask('build:all', [
        'build:asset',
        'build:css',
        'build:js'
    ]);

    // Default task(s).
    grunt.registerTask('default', [
        'build:all',
        'watch'
    ]);
};