/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
define([
    'jquery',
    'Magento_Customer/js/model/customer'
], function ($, customer) {
    'use strict';
    return function (target) {
        target = $.extend({}, target, {
            vendorId: window.checkoutConfig.vendorId,
            createUrl: function(url, params) {
                var completeUrl = this.serviceUrl + url;
                if (this.vendorId && customer.isLoggedIn()) {
                    completeUrl += '/:vendorId';
                    params.vendorId = this.vendorId;
                }
                return this.bindParams(completeUrl, params);
            }
            
        });
        return target;
    };
});