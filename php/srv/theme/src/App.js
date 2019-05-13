(function(global) {

    var SCROLL_TIMEOUT = 100;
    var defaultOptions = {
        autoRun: true,
        authority: null,
        pageId: null
    };

    /**
     * App constructor.
     *
     * @param {Object} options
     */
    global.App = function App(options) {
        var self = this;

        this.scope = {};
        this.components = [];
        this.options = $.extend(true, defaultOptions, options);

        if (this.options.autoRun) {
            $(document).ready(function() {
                self.run();
            });
        }
    };

    App.createComponent = function(name, prototype) {
        var subClass = function(selector, options) {
            global.Component.call(this, selector, options);
        };

        subClass.name = name;
        subClass.superClass = global.Component.prototype;
        subClass.prototype = $.extend(Object.create(global.Component.prototype), prototype);
        subClass.prototype.constructor = subClass;

        return subClass;
    };

    /**
     * Registers a component.
     *
     * @param {Component} component
     *
     * @returns {undefined}
     *
     * @throws {Error} if the component type is already registered
     */
    App.prototype.register = function(component) {
        if (! (component instanceof Component)) {
            throw new TypeError('The component should be a Component instance, amigo.');
        }

        if (this.components.indexOf(component) > -1) {
            throw new Error('Component ' + component + ' is already registered, amigo');
        }

        this.components.push(component);
    };

    /**
     * Initializes the app, before initializing the app components. You can use
     * this method to initialize your services, for instance.
     *
     * @returns {undefined}
     */
    App.prototype.init = function() {
        // objectFitPolyfill();

        // if (! this.options.googleMapsApiKey) {
        //     throw new Error('You SHOULD provide a "googleMapsApiKey" option, amigo.');
        // }

        // this.scope.maps = new GoogleMaps(this.options.googleMapsApiKey);
    };

    /**
     * Runs the app.
     *
     * This method just initializes all declared components. If the component
     * is synchronous initialization consists in invoking the component's
     * init() method. In other case (if the component is asynchronous) its
     * initialization will be delayed, according to the component options.
     *
     * @returns {undefined}
     */
    App.prototype.run = function() {
        var self = this;
        var toLoadAsap = [];
        var toLoadOnEnterViewport = [];

        this.init();

        // Register all components that have been queued while this is
        // script was loading (this may happen if the script was embedded
        // using the "async" attribute)
        if (window.appQueue && window.appQueue.length) {
            window.appQueue.map(function(component) {
                self.register(component);
            });
        }

        // Initialize all synchronous components, and queue
        // asynchronous ones
        this.components.map(function(component) {
            component.scope = self.scope;

            if (component.isAsync()) {
                if (component.isLoadAsap()) {
                    toLoadAsap.push(component);
                } else {
                    toLoadOnEnterViewport.push({
                        component: component,
                        scrollTop: $(component.element).offset().top,
                        loaded: false
                    });
                }
            } else {
                component.init();
            }
        });

        // Request the asynchronous components which should be loaded
        // as soon as possible, perform just one request
        if (toLoadAsap.length) {
            this.loadPageBlocks(toLoadAsap);
        }

        // Note that components to be requested on enter viewport may
        // never be rendered
        if (toLoadOnEnterViewport) {
            this.loadOnEnterViewport(toLoadAsap);
        }
    };

    /**
     * Loads asynchronous blocks by page ID.
     *
     * @param {Function} [callback]
     * @param {Function} [errback]
     *
     * @returns {undefined}
     */
    App.prototype.loadPageBlocks = function(callback, errback) {
        if (! this.options.authority) {
            throw new Error('Cannot load page blocks: the backend authority is not set, amigo.');
        }

        if (! this.options.pageId) {
            throw new Error('Cannot load page blocks: the current page ID is not set, amigo.');
        }

        var url = this.options.authority + '/wp-json/async/page/' + this.options.pageId;

        $.ajax({
            url: url,
            method: 'GET',
            withCredentials: true
        }).then(function(data) {
            for (var blockId in data) {
                if (data.hasOwnProperty(blockId)) {
                    $('#component-' + blockId).html(data[blockId].html);
                }
            }

            callback && callback(data);
        }).fail(function(error) {
            console && console.warn('Failed to load block data, amigo');
            errback && errback(error);
        });
    };

    /**
     * Loads a block asynchronously, given a block type and a block identifier.
     *
     * @param {String} blockType
     * @param {String} blockId
     * @param {Function} [callback]
     * @param {Function} [errback]
     *
     * @returns {undefined}
     */
    App.prototype.loadBlock = function(blockType, blockId, callback, errback) {
        if (! blockType) {
            throw new Error('Cannot load block: the block type is required, amigo.');
        }

        if (! blockId) {
            throw new Error('Cannot load block: the block ID is required, amigo.');
        }

        var url = this.options.authority + '/wp-json/async/block/' + blockType + '/' + blockId;

        $.ajax({
            url: url,
            method: 'GET',
            withCredentials: true
        }).then(function(data) {
            for (var blockId in data) {
                if (data.hasOwnProperty(blockId)) {
                    $('#component-' + blockId).html(data[blockId].html);
                }
            }

            callback && callback(data);
        }).fail(function(error) {
            console && console.warn('Failed to load block data, amigo');
            errback && errback(error);
        });
    };

    /**
     * Set-ups the appropriate window scroll event listeners, to auto-load
     * asynchronous blocks when they enter the viewport.
     *
     * @param {Component[]} components
     *
     * @returns {undefined}
     */
    App.prototype.loadOnEnterViewport = function(components) {
        var self = this;
        var scrollTimer;

        $(window).scroll(function(e) {
            clearTimeout(scrollTimer);
            scrollTimer = setTimeout(function() {
                var toLoad = [];
                var scrollTop = $(window).scrollTop();
                var scrollBottom = scrollTop + window.innerHeight;

                components.map(function(component) {
                    if (! component.loaded && component.scrollTop >= scrollTop && component.scrollTop < scrollBottom) {
                        toLoad.push(component);
                    }
                });

                if (toLoad.lenght) {
                    self.loadBlock(toLoad);
                }
            }, SCROLL_TIMEOUT);
        });
    };

}(this));