/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
define([
    'jquery'
], function(jQuery) {
/**
 * Responsive Plugin
 */
+function($) {
    'use strict';
    
    $.responsivePlugin = function(_object, _namespace, _constructor, _arguments) {
        var args = Array.apply(null, _arguments);
        var option = args.shift();
        var result;
        var data = _object.data(_namespace);
        if (!data && (!option || ($.type(option) === 'object'))) {
            _object.data(_namespace, (data = new _constructor(_object, option)));
        }
        if (!data) {
            return null;
        }
        if (data && ($.type(option) === 'string') && ($.type(data[option]) === 'function')) {
            result = data[option].apply(data, args);
        }
        if ((result !== undefined) && (!(result instanceof _constructor))) {
            return result;
        } else {
            return _object;
        }
    };
    
}(jQuery);

});