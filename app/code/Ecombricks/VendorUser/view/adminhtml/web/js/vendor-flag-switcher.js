/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */

define([
    'jquery',
    'responsivePlugin'
], function(jQuery) {

/**
 * User vendor flag switcher
 */
+function($) {
    'use strict';
    
    var VendorFlagSwitcher = function(element, options) {
        this.$element = $(element);
        this.options = $.extend({}, VendorFlagSwitcher.DEFAULTS, options);
        this.create();
    };
    
    VendorFlagSwitcher.DEFAULTS = {
        namespace: 'user.vendor.flag.switcher'
    };
    
    VendorFlagSwitcher.CLASSES = {};
    
    VendorFlagSwitcher.prototype = {
        
        constructor: VendorFlagSwitcher,
        
        create: function() {
            this.createVendorSelectorContainer();
            this.createUserRolesTabContainer();
            this.createVendorUserRolesTabContainer();
            this.$element.on('change', $.proxy(this.onChange, this));
            this.$element.trigger('change');
            return this;
        },
        
        hasVendorSelectorId: function() {
            return ('vendorSelectorId' in this.options) ? true : false;
        },
        
        getVendorSelectorId: function() {
            return (this.hasVendorSelectorId()) ? this.options.vendorSelectorId : null;
        },
        
        hasUserRolesTabId: function() {
            return ('userRolesTabId' in this.options) ? true : false;
        },
        
        getUserRolesTabId: function() {
            return (this.hasUserRolesTabId()) ? this.options.userRolesTabId : null;
        },
        
        hasVendorUserRolesTabId: function() {
            return ('vendorUserRolesTabId' in this.options) ? true : false;
        },
        
        getVendorUserRolesTabId: function() {
            return (this.hasVendorUserRolesTabId()) ? this.options.vendorUserRolesTabId : null;
        },
        
        createVendorSelectorContainer: function()
        {
            if (!this.hasVendorSelectorId()) {
                return this;
            }
            var vendorSelector = $('#' + this.getVendorSelectorId());
            if (!vendorSelector) {
                return this;
            }
            this.$vendorSelectorContainer = vendorSelector.parent().parent();
            return this;
        },
        
        removeVendorSelectorContainer: function()
        {
            if (!this.$vendorSelectorContainer) {
                return this;
            }
            delete this.$vendorSelectorContainer;
            return this;
        },
        
        createUserRolesTabContainer: function()
        {
            if (!this.hasUserRolesTabId()) {
                return this;
            }
            var userRolesTab = $('#' + this.getUserRolesTabId());
            if (!userRolesTab) {
                return this;
            }
            this.$userRolesTabContainer = userRolesTab.parent();
            return this;
        },
        
        removeUserRolesTabContainer: function()
        {
            if (!this.$userRolesTabContainer) {
                return this;
            }
            delete this.$userRolesTabContainer;
            return this;
        },
        
        createVendorUserRolesTabContainer: function()
        {
            if (!this.hasVendorUserRolesTabId()) {
                return this;
            }
            var vendorUserRolesTab = $('#' + this.getVendorUserRolesTabId());
            if (!vendorUserRolesTab) {
                return this;
            }
            this.$vendorUserRolesTabContainer = vendorUserRolesTab.parent();
            return this;
        },
        
        removeVendorUserRolesTabContainer: function()
        {
            if (!this.$vendorUserRolesTabContainer) {
                return this;
            }
            delete this.$vendorUserRolesTabContainer;
            return this;
        },
        
        onChange: function(event) {
            this.change();
            return this;
        },
        
        change: function() {
            if (this.$element.val() === '1') {
                this.$vendorSelectorContainer.show();
                this.$userRolesTabContainer.hide();
                this.$vendorUserRolesTabContainer.show();
            } else {
                this.$vendorSelectorContainer.hide();
                this.$userRolesTabContainer.show();
                this.$vendorUserRolesTabContainer.hide();
            }
            return this;
        },
        
        remove: function() {
            this.$element.off('change');
            this.removeVendorUserRolesTabContainer();
            this.removeUserRolesTabContainer();
            delete this.$element.data(this.options.namespace);
            return this;
        }
        
    };
    
    $.fn.userVendorFlagSwitcher = function() {
        return $.responsivePlugin(
            this,
            VendorFlagSwitcher.DEFAULTS.namespace,
            VendorFlagSwitcher,
            arguments
        );
    };
    $.fn.userVendorFlagSwitcher.constructor = VendorFlagSwitcher;
    
}(jQuery);

});
