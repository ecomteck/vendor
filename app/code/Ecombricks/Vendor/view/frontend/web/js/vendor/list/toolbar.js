/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
define([
    'jquery',
    'jquery/ui'
], function ($) {
    'use strict';
    
    $.widget('mage.vendorListToolbarForm', {
        
        options: {
            directionControl: '[data-role="direction-switcher"]',
            orderControl: '[data-role="sorter"]',
            limitControl: '[data-role="limiter"]',
            direction: 'vendor_list_dir',
            order: 'vendor_list_order',
            limit: 'vendor_list_limit',
            directionDefault: 'asc',
            orderDefault: 'name',
            limitDefault: 5,
            url: ''
        },
        
        _create: function () {
            this._bind($(this.options.directionControl), this.options.direction, this.options.directionDefault);
            this._bind($(this.options.orderControl), this.options.order, this.options.orderDefault);
            this._bind($(this.options.limitControl), this.options.limit, this.options.limitDefault);
        },
        
        _bind: function (element, paramName, defaultValue) {
            if (element.is('select')) {
                element.on('change', { paramName: paramName, default: defaultValue }, $.proxy(this._processSelect, this));
            } else {
                element.on('click', { paramName: paramName, default: defaultValue }, $.proxy(this._processLink, this));
            }
        },
        
        _processLink: function (event) {
            event.preventDefault();
            this.changeUrl(event.data.paramName, $(event.currentTarget).data('value'), event.data.default);
        },
        
        _processSelect: function (event) {
            this.changeUrl(event.data.paramName, event.currentTarget.options[event.currentTarget.selectedIndex].value, event.data.default);
        },
        
        changeUrl: function (paramName, paramValue, defaultValue) {
            var decode = window.decodeURIComponent,
                urlPaths = this.options.url.split('?'),
                baseUrl = urlPaths[0],
                urlParams = urlPaths[1] ? urlPaths[1].split('&') : [],
                paramData = {},
                parameters, i;
            for (i = 0; i < urlParams.length; i++) {
                parameters = urlParams[i].split('=');
                paramData[decode(parameters[0])] = parameters[1] !== undefined ? decode(parameters[1].replace(/\+/g, '%20')) : '';
            }
            paramData[paramName] = paramValue;
            if (paramValue == defaultValue) {
                delete paramData[paramName];
            }
            paramData = $.param(paramData);
            location.href = baseUrl + (paramData.length ? '?' + paramData : '');
        }
        
    });
    return $.mage.vendorListToolbarForm;
});