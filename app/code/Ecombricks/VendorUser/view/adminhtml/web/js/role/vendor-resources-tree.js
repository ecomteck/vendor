/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
define([
    'jquery',
    'rolesTree',
    'jquery/jstree/jquery.jstree'
], function($){
    'use strict';

    $.widget('mage.userRoleVendorResourcesTree', $.mage.rolesTree, {
        
        _create: function() {
            this.element.jstree({
                plugins: ['themes', 'json_data', 'ui', 'crrm', 'types', 'vcheckbox', 'hotkeys'],
                vcheckbox: {
                    two_state: true,
                    real_checkboxes: true,
                    real_checkboxes_names: function(n) { return ['vendor_resource[]', $(n).data('id')] }
                },
                json_data: { data: this.options.treeInitData },
                ui: { select_limit: 0 },
                hotkeys: {
                    space: this._changeState,
                    return: this._changeState
                },
                types: {
                    types: {
                        disabled: {
                            check_node: false,
                            uncheck_node: false
                        }
                    }
                }
            });
            this._bind();
        }
        
    });
    
    return $.mage.userRoleVendorResourcesTree;
});