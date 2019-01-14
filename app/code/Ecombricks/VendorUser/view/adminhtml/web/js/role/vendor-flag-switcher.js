/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */

define([
    'jquery',
    'responsivePlugin'
], function(jQuery) {

/**
 * User role vendor flag switcher
 */
+function($) {
    'use strict';
    
    var VendorFlagSwitcher = function(element, options) {
        this.$element = $(element);
        this.options = $.extend({}, VendorFlagSwitcher.DEFAULTS, options);
        this.create();
    };
    
    VendorFlagSwitcher.DEFAULTS = {
        namespace: 'user.role.vendor.flag.switcher'
    };
    
    VendorFlagSwitcher.CLASSES = {};
    
    VendorFlagSwitcher.prototype = {
        
        constructor: VendorFlagSwitcher,
        
        create: function() {
            this.createResourcesTabContainer();
            this.createVendorResourcesTabContainer();
            this.$element.on('change', $.proxy(this.onChange, this));
            this.$element.trigger('change');
            return this;
        },
        
        hasResourcesTabId: function() {
            return ('resourcesTabId' in this.options) ? true : false;
        },
        
        getResourcesTabId: function() {
            return (this.hasResourcesTabId()) ? this.options.resourcesTabId : null;
        },
        
        hasVendorResourcesTabId: function() {
            return ('vendorResourcesTabId' in this.options) ? true : false;
        },
        
        getVendorResourcesTabId: function() {
            return (this.hasVendorResourcesTabId()) ? this.options.vendorResourcesTabId : null;
        },
        
        createResourcesTabContainer: function()
        {
            if (!this.hasResourcesTabId()) {
                return this;
            }
            var resourcesTab = $('#' + this.getResourcesTabId());
            if (!resourcesTab) {
                return this;
            }
            this.$resourcesTabContainer = resourcesTab.parent();
            return this;
        },
        
        createVendorResourcesTabContainer: function()
        {
            if (!this.hasVendorResourcesTabId()) {
                return this;
            }
            var vendorResourcesTab = $('#' + this.getVendorResourcesTabId());
            if (!vendorResourcesTab) {
                return this;
            }
            this.$vendorResourcesTabContainer = vendorResourcesTab.parent();
            return this;
        },
        
        onChange: function(event) {
            this.change();
            return this;
        },
        
        change: function() {
            if (this.$element.val() === '1') {
                this.$vendorResourcesTabContainer.show();
                this.$resourcesTabContainer.hide();
            } else {
                this.$vendorResourcesTabContainer.hide();
                this.$resourcesTabContainer.show();
            }
            return this;
        },
        
        remove: function() {
            this.$element.off('change');
            if (this.$vendorResourcesTabContainer) {
                delete this.$vendorResourcesTabContainer;
            }
            if (this.$resourcesTabContainer) {
                delete this.$resourcesTabContainer;
            }
            delete this.$element.data(this.options.namespace);
            return this;
        }
        
    };
    
    $.fn.userRoleVendorFlagSwitcher = function() {
        return $.responsivePlugin(
            this,
            VendorFlagSwitcher.DEFAULTS.namespace,
            VendorFlagSwitcher,
            arguments
        );
    };
    $.fn.userRoleVendorFlagSwitcher.constructor = VendorFlagSwitcher;
    
}(jQuery);

});