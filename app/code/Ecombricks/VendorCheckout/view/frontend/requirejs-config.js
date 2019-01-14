/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
var config = {
    config: {
        mixins: {
            'Magento_Checkout/js/model/url-builder': {
                'Ecombricks_VendorCheckout/js/model/url-builder-mixin': true
            },
            'Magento_Checkout/js/sidebar': {
                'Ecombricks_VendorCheckout/js/sidebar-mixin': true
            },
            'Magento_Checkout/js/view/checkout/minicart/subtotal/totals': {
                'Ecombricks_VendorCheckout/js/view/checkout/minicart/subtotal/totals-mixin': true
            }
        }
    }
};