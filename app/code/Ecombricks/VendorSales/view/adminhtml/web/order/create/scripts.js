/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
define([
    'jquery',
    'Magento_Sales/order/create/scripts'
], function(jQuery) {
    
    AdminOrderPrototype = AdminOrder.prototype;
    
    AdminOrder.prototype = jQuery.extend({}, AdminOrder.prototype, {
        
        initialize : function(data) {
            AdminOrderPrototype.initialize.call(this, data);
            if (!data) {
                data = {};
            }
            this.vendorId = data.vendor ? data.vendor : false;
        },
        
        prepareParams : function(params) {
            params = AdminOrderPrototype.prepareParams.call(this, params);
            if (!params.vendor) {
                params.vendor = this.vendorId;
            }
            return params;
        },

        setVendorId : function(vendorId) {
            this.vendorId = vendorId;
            this.loadArea(['data'], true);
        }
        
    });
    
});