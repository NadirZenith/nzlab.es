(function(global) {

    var LoadStrategy = global.LoadStrategy = {
        AS_SOON_AS_POSSIBLE: 1,
        ON_ENTER_VIEWPORT: 2
    };

    var defaultOptions = {
        async: false,
        auth: false,
        load: LoadStrategy.AS_SOON_AS_POSSIBLE
    };

    global.Component = function Component(selector, options) {
        this.element = $(selector);
        this.options = $.extend(true, defaultOptions, options);

        if (! this.element.length) {
            throw new Error('Failed to instantiate component: root element "' + selector + '" not found.');
        }
    };

    Component.prototype.isAsync = function() {
        return !! this.options.async;
    };

    Component.prototype.isLoadAsap = function() {
        return this.isAsync && this.options.load === LoadStrategy.AS_SOON_AS_POSSIBLE;
    };

    Component.prototype.isLoadOnEnterViewport = function() {
        return this.isAsync && this.options.load === LoadStrategy.ON_ENTER_VIEWPORT;
    };

    Component.prototype.isAsync = function() {
        return !! this.options.async;
    };

    Component.prototype.requiresAuth = function() {
        return !! this.options.auth;
    };

    /**
     * Concrete components should implement this method in order to initialize
     * the component. The default implementation does nothing.
     */
    Component.prototype.init =  function() {
        // Noop
    };

}(window));
