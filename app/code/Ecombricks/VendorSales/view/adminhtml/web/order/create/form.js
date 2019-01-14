/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
define([
    'jquery',
    'Ecombricks_VendorSales/order/create/scripts'
], function (jQuery) {
    'use strict';
    
    var $el = jQuery('#edit_form'),
        config,
        baseUrl,
        order,
        payment;
    
    if (!$el.length || !$el.data('order-config')) {
        return;
    }

    config = $el.data('order-config');
    baseUrl = $el.data('load-base-url');

    order = new AdminOrder(config);
    order.setLoadBaseUrl(baseUrl);

    payment = {
        switchMethod: order.switchPaymentMethod.bind(order)
    };
    
    window.order = order;
    window.payment = payment;
    
});