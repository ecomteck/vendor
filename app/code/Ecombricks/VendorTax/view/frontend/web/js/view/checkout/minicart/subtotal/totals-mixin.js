/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
define([
    'jquery'
], function ($) {
    'use strict';
    
    return function (target) {
        return target.extend({
            displaySubtotal: function (vendor) {
                return true;
            }
        });
    };
});