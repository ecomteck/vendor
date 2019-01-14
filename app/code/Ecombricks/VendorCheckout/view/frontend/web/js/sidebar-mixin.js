/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
define([
    'jquery',
    'Magento_Customer/js/model/authentication-popup',
    'Magento_Customer/js/customer-data',
    'Magento_Ui/js/modal/confirm',
    'jquery/ui',
    'mage/decorate',
    'mage/collapsible',
    'mage/cookies'
], function ($, authenticationPopup, customerData, confirm) {
    'use strict';
    
    return function (target) {
        $.widget('mage.sidebar', target, {
            
            getLoginUrl: function () {
                return this.options.url.loginUrl;
            }, 

            getVendorUrl: function (url, vendorId) {
                return url.replace(/\/+$/, '') + '/vendor/' + vendorId + '/';
            }, 

            getCheckoutUrl: function (vendorId) {
                return this.getVendorUrl(this.options.url.checkout, vendorId);
            },

            getCartUrl: function (vendorId) {
                return this.getVendorUrl(window.checkout.shoppingCartUrl, vendorId);
            },

            getRemoveUrl: function (vendorId) {
                return this.getVendorUrl(this.options.url.remove, vendorId);
            },

            getUpdateUrl: function (vendorId) {
                return this.getVendorUrl(this.options.url.update, vendorId);
            },

            removeItem: function (elem, vendorId) {
                var itemId = elem.data('cart-item');
                this._ajax(this.getRemoveUrl(vendorId), { item_id: itemId }, elem, this._removeItemAfter);
            },

            updateItemQty: function (elem, vendorId) {
                var itemId = elem.data('cart-item');
                var itemQty = $('#cart-item-' + itemId + '-qty').val();
                this._ajax(this.getUpdateUrl(vendorId), { item_id: itemId, item_qty: itemQty }, elem, this._updateItemQtyAfter);
            },

            update: function () {
                $(this.options.targetElement).trigger('contentUpdated');
                this._initContent();
            },
            
            bindCloseButton: function () {
                var self = this;
                this.element.find(this.options.button.close).each(function () {
                    $(this).off('click');
                    $(this).on('click', function (event) {
                        event.stopPropagation();
                        $(self.options.targetElement).dropdownDialog('close');
                    });
                });
                return this;
            },
            
            bindCartDeleteActionButton: function (actionsElement, vendorId) {
                var self = this;
                actionsElement.find('.action.delete').each(function () {
                    $(this).off('click');
                    $(this).on('click', function (event) {
                        event.stopPropagation();
                        confirm({
                            content: self.options.confirmMessage,
                            actions: {
                                confirm: function () {
                                    self.removeItem($(event.currentTarget), vendorId);
                                },
                                always: function (event) {
                                    event.stopImmediatePropagation();
                                }
                            }
                        });
                    });
                });
                return this;
            },
            
            bindCartViewActionButton: function (actionsElement, vendorId) {
                var self = this;
                actionsElement.find('.action.viewcart').each(function () {
                    $(this).off('click');
                    $(this).on('click', function (event) {
                        location.href = self.getCartUrl(vendorId);
                    });
                });
                return this;
            },
            
            bindCartCheckoutActionButton: function (actionsElement, vendorId) {
                var self = this;
                actionsElement.find('.action.checkout').each(function () {
                    $(this).off('click');
                    $(this).on('click', function (event) {
                        var cart = customerData.get('cart'),
                            customer = customerData.get('customer');
                        if (!customer().firstname && cart().isGuestCheckoutAllowed === false) {
                            $.cookie('login_redirect', self.getCheckoutUrl(vendorId));
                            if (self.options.url.isRedirectRequired) {
                                $(this).prop('disabled', true);
                                location.href = self.getLoginUrl();
                            } else {
                                authenticationPopup.showModal();
                            }
                            return false;
                        }
                        $(this).prop('disabled', true);
                        location.href = self.getCheckoutUrl(vendorId);
                    });
                });
                return this;
            },
            
            bindCartActionButtons: function (cartElement, vendorId) {
                var self = this;
                cartElement.find('.actions').each(function () {
                    self.bindCartDeleteActionButton($(this), vendorId);
                    self.bindCartViewActionButton($(this), vendorId);
                    self.bindCartCheckoutActionButton($(this), vendorId);
                });
                return this;
            },
            
            bindCartQtyInput: function (cartElement, vendorId) {
                var self = this;
                cartElement.find(self.options.item.qty).each(function () {
                    $(this).off('keyup');
                    $(this).on('keyup', function (event) {
                        self._showItemButton($(event.target));
                    });
                    $(this).off('change');
                    $(this).on('change', function (event) {
                        self._showItemButton($(event.target));
                    });
                    $(this).off('focusout');
                    $(this).on('focusout', function (event) {
                        self._validateQty($(event.currentTarget));
                    });
                });
                return this;
            },
            
            bindCartUpdateQtyButton: function (cartElement, vendorId) {
                var self = this;
                cartElement.find(self.options.item.button).each(function () {
                    $(this).off('click');
                    $(this).on('click', function (event) {
                        event.stopPropagation();
                        self.updateItemQty($(event.currentTarget), vendorId);
                    });
                });
                return this;
            },
            
            _initContent: function () {
                var self = this;
                this.element.decorate('list', this.options.isRecursive);
                this.bindCloseButton();
                this.element.find('.vendor-cart').each(function () {
                    var vendorId = $(this).data('vendor-id');
                    self.bindCartActionButtons($(this), vendorId);
                    self.bindCartQtyInput($(this), vendorId);
                    self.bindCartUpdateQtyButton($(this), vendorId);
                });
                this._calcHeight();
                this._isOverflowed();
            },

            _isOverflowed: function () {
                var list = this.element.find('.vendor-carts').first(),
                    cssOverflowClass = 'overflowed';
                if (this.scrollHeight > list.innerHeight()) {
                    list.parent().addClass(cssOverflowClass);
                } else {
                    list.parent().removeClass(cssOverflowClass);
                }
            }, 

            _calcHeight: function () {
                var self = this,
                    height = 0,
                    counter = this.options.minicart.maxItemsVisible,
                    target = this.element.find('.vendor-carts').first(),
                    outerHeight;
                self.scrollHeight = 0;
                target.children().each(function () {
                    $(this).find('.minicart-items').first().children().each(function () {
                        if ($(this).find('.options').length > 0) {
                            $(this).collapsible();
                        }
                    });
                    outerHeight = $(this).outerHeight();
                    if (counter-- > 0) {
                        height += outerHeight;
                    }
                    self.scrollHeight += outerHeight;
                });
                target.parent().height(height);
            }
            
        });
        return target;
    };
});