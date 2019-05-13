# Front-End Framework


## Installation

Install the project from the repository:

tbd

To serve the assets, just build and run the Docker container:

```bash
$ docker build . -t nombre-del-contenedor
Sending build context to Docker daemon  3.986MB
Step 1/20 : (...)
Successfully built b5334e3e6605

$ docker run -p 8081:80 \
    -v /path/to/frontend/dist/:/var/www/html \
    -v /path/to/frontend/var/template/:/var/template \
    -v /path/to/frontend/vendor/:/var/vendor 
    nombre-del-contenedor
```

Change the port ``8081`` in the statement above to suit your needs.

## Directory Layout

We use the following directory layout:

- ``bin``contains binary files and scripts
- ``dist`` contains thge distribution (built files)
- ``etc`` contains configuration files
- ``src`` contains source code (SCSS, PHP, JS)
- ``var`` contains variable files, which may vary from package to package 
  (e.g., templates, images, fonts, icons, etc.)
- ``node_modules`` contains the required JS dependencies.
- ``vendor`` contains the required PHP dependencies used to test the mock-ups.

## Build process

The ``default`` Grunt task builds all package assets. This task just invokes, 
in turn, the following tasks:

- Task ``build:img`` just pre-processes all images placed in ``var/img``and
  places the processed images in ``dist/img``.

- Task ``build:css`` builds the package CSS assets. See Building Stylesheets below.

- Task ``build:js`` builds the package JS assets. See Building JavaScript below.

### Building Stylesheets

The ``build:css`` invokes the following sub-tasks:

1. The sub-task ``sass:compile`` compiles the source SCSS code located at
   ``src/scss`` to ``dist/css/cam.css``. The output CSS file is already minified.

2. The sub-task ``postcss:dist`` further minifies the CSS code (via CSS nano)
   and auto-prefixes CSS rules with the last 2 version prefixes.

### Building JavaScript

The ``build:js`` task invokes the following sub-tasks:

1. Concatenates all vendors declared in the ``Gruntfile.js`` and places the 
   pack to ``dist/js/vendor.js`` (not minified). This file is intended to be
   used in the development environment.

2. Minifies the packed vendors (``dist/js/vendor.js``) to ``dist/js/vendor.min.js``.
   This file is intended to be used later, when building the production JS
   package.

3. Copies your main JavaScript code, located at ``src/js/theme.js`` to 
   ``dist/js/theme.js``. This file is intended to be used in the development
   environment.

4. Minifies the main JavaScript code (``dist/js/theme.js``) to ``dist/js/theme.js.min``.
   This file is intended to be used later, when building the production JS
   package.

5. Concatenate the packed vendors (``dist/js/vendor.js``) and your main JS
   code (``dist/js/theme.js``) to the ``dist/js/theme.js`` file. This file 
   contains all necessary JS code to run the package, and is intended to be
   used on a development environment.

6. Minifies the packed JavaScript (``dist/js/theme.js``) to ``dist/js/theme.js.min``.
   This file is intended to be used in a production environment.


## Template Engine

Twig (http://twig.sensiolabs.org/)

## Pre-Processor

Scss (http://sass-lang.com/) 

## Vendor

Materializecss (http://materializecss.com/)

### JS PLUGINS Recomended
* MODAL [https://github.com/VodkaBears/Remodal](https://github.com/VodkaBears/Remodal)
* SLIDER [https://github.com/kenwheeler/slick](https://github.com/kenwheeler/slick)
* CIRCULAR PROGRESSBARS [https://github.com/aterrien/jQuery-Knob](https://github.com/aterrien/jQuery-Knob)
* CUSTOM SCROLLBARS [https://github.com/malihu/malihu-custom-scrollbar-plugin](https://github.com/malihu/malihu-custom-scrollbar-plugin)
* CUSTOM SELECTS [https://github.com/select2/select2](https://github.com/select2/select2)
* RANGE SLIDER [https://github.com/IonDen/ion.rangeSlider](https://github.com/IonDen/ion.rangeSlider)
* TOOLTIPS [https://github.com/iamceege/tooltipster](https://github.com/iamceege/tooltipster)
* TRIGGER IN VIEWPORT [https://github.com/silvestreh/onScreen](https://github.com/silvestreh/onScreen)
* MASONRY [https://github.com/desandro/masonry](https://github.com/desandro/masonry)

## Dependencies
* grunt

##### IE (Polyfills)
* HTML5SHIV [https://github.com/aFarkas/html5shiv](https://github.com/aFarkas/html5shiv)
* RESPOND [https://github.com/scottjehl/Respond](https://github.com/scottjehl/Respond)
* PLACEHOLDERS [https://github.com/jamesallardice/Placeholders.js/](https://github.com/jamesallardice/Placeholders.js/)
  

## Grunt
* [grunt-sass](https://github.com/sindresorhus/grunt-sass)
* [grunt-contrib-uglify](https://github.com/gruntjs/grunt-contrib-uglify)
* [grunt-contrib-watch](https://github.com/gruntjs/grunt-contrib-watch)
* [grunt-contrib-imagemin](https://github.com/gruntjs/grunt-contrib-imagemin)
* [grunt-contrib-copy](https://github.com/gruntjs/grunt-contrib-copy)
* [grunt-newer](https://github.com/tschaub/grunt-newer)
* [grunt-postcss](https://github.com/nDmitry/grunt-postcss) (autoprefixer & cssnano)
